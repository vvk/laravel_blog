<?php

namespace App\Repositories\Article;

use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\ArticleTag;
use App\Repositories\Repository;
use DB;

class ArticleRepository extends Repository
{

    public function store($request)
    {
        $data['name'] = $request->input('name');
        $data['keywords'] = $request->input('keywords');
        $data['description'] = $request->input('description');
        $data['is_reprint'] = $request->input('is_reprint');
        $data['reprint_url'] = $request->input('reprint_url');
        $data['thumb'] = $request->input('thumb');
        $data['content'] = $request->input('content');
        $data['recommend'] = $request->input('recommend');
        $tag = $request->input('tag');
        $categoryId = $request->input('category_id');
        $type = $request->input('type');

        if (!$categoryId) {
            return ajaxResponse(1, trans('error.article_category_not_empty'));
        }

        if (!$tag) {
            return ajaxResponse(1, trans('error.article_tag_not_empty'));
        }

        if ($data['is_reprint']) {
            if (!$data['reprint_url']) {
                return ajaxResponse(1, trans('error.reprint_url_not_empty'));
            } elseif (!isUrl($data['reprint_url'])) {
                return ajaxResponse(1, trans('error.reprint_url_invalid'));
            }
        }

        if (!in_array($data['recommend'], array(0, 1))) {
            $data['recommend'] = 0;
        }

        $id = $request->input('id');

        if ($type == 1) {
            $data['status'] = 1;
        } else {
            $data['status'] = 2;
        }

        DB::beginTransaction();

        $time = time();
        $data['modify_time'] = $time;
        if ($id == 0) {
            $data['create_time'] = $time;
            if ($data['status'] == 2) {
                $data['publish_time'] = $time;
            }

            $result = Article::create($data);  //保存文章内容
            if ($result) {
                $id = $result->id;
            }
        } else {
            $article = Article::where('id', $id)->whereIn('status', array(1, 2))->first();
            if (!$article) {
                return ajaxResponse(1, trans('error.modify_article_not_exist'));
            }

            if ($data['status'] == 2 && !$article['publish_time']) {
                $article['publish_time'] = $time;
            }

            //更新文章内容
            $result = Article::where('id', $id)->update($data);
            if ($result) {
                //查询是否有分类，有分类先删除
                if (ArticleCategory::where('article_id', $id)->first()) {
                    $result = ArticleCategory::where('article_id', $id)->delete();
                    if (!$result) {
                        return ajaxResponse(1, trans('error.save_fail'), $data);
                    }
                }

                //查询是否有标签，如果有删除
                if (ArticleTag::where('article_id', $id)->first()) {
                    $result = ArticleTag::where('article_id', $id)->delete();
                    if (!$result) {
                        return ajaxResponse(1, trans('error.save_fail'), $data);
                    }
                }
            }
        }

        $categoryList = array();
        foreach ($categoryId as $item) {
            $categoryList[] = array('article_id'=>$id, 'category_id'=>$item);
        }

        //文章分类
        $result = ArticleCategory::insert($categoryList);

        if ($result) {
            $tagList = array();
            foreach ($tag as $item) {
                $tagList[] = array('article_id'=>$id, 'tag_id'=>$item);
            }
            $result = ArticleTag::insert($tagList);  //标签
        }

        if ($result) {
            DB::commit();
            return ajaxResponse(0, 'success', array('id'=>$id));
        } else {
            DB::rollBack();
            return ajaxResponse(1, trans('error.save_fail'), $data);
        }
    }

    public function destroy($request)
    {
        $id = $request->input('id');
        if (!$request->isMethod('delete')) {
            return ajaxResponse('500', trans('error.system_error'));
        }

        $article = Article::where('id', $id)->whereNotIn('status', array(1, 2))->first();
        if ($article) {
            return ajaxResponse(1, trans('error.delete_article_not_exist'));
        }

        $result = Article::where('id', $id)->update(array('status'=>3, 'delete_time'=>time()));
        if ($result) {
            return ajaxResponse(0, 'success');
        } else {
            return ajaxResponse(1, trans('error.delete_fail'));
        }
    }
}