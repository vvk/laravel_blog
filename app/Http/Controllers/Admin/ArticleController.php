<?php

namespace App\Http\Controllers\Admin;

use App\Http\Models\Article;
use App\Http\Models\ArticleTag;
use App\Http\Models\Category;
use App\Http\Models\Content;
use App\Http\Models\Tag;
use Symfony\Component\HttpFoundation\Request;
use DB;

class ArticleController extends CommonController
{
    public function index(Request $request,Article $article){
        $status = $request->input('status', -1);
        $articleStatus = array('0'=>'草稿', '1'=>'未发布', '已发布');

        if($status!=-1 && !in_array($status, array_keys($articleStatus))){
            $status = -1;
        }

        if($status==-1){
            $data = $article::whereIn('status', array(0, 1, 2))->orderBy('publish_time', 'desc')->paginate(20);
        }else{
            $data = $article::where('status', $status)->orderBy('publish_time', 'desc')->paginate(20);
        }

        $breadcrumb = array('文章管理', '文章列表');
        return view('admin.article.index', compact('data', 'breadcrumb', 'articleStatus', 'status'));
    }

    public function edit(Category $category, Tag $tag, $id=0){
        $breadcrumb = array('文章管理');
        $data = array('thumb'=>'');
        if ($id) {
            $data = Article::whereIn('status', array(0, 1, 2))->find($id);
            $articleTags = $data->tags->toArray();

            $articleTagsId = array();
            if($articleTags){
                foreach($articleTags as $item){
                    $articleTagsId[] = $item['tag_id'];
                }
            }

            if (!$data) {
                //@todo 不存在
                die('文章不存在');
            }
            $breadcrumb[] = '修改文章';
        } else {
            $breadcrumb[] = '写文章';
            $data['category_id'] = 0;
            $articleTagsId = array();
        }

        //分类
        $categoryTree = $category->getCategoryTree();
        $categoryOptions = $category->setCategoryOptions($categoryTree, $data['category_id']);

        //标签
        $tagList = $tag::where('status', 1)->get();

        return view('admin.article.edit_article', compact('id', 'data', 'breadcrumb', 'categoryOptions', 'tagList', 'articleTagsId'));
    }

    public function store(Request $request){
        $data['category_id'] = $request->input('category_id', 0);
        $data['is_reprint'] = $request->input('is_reprint', 0);
        $data['name'] = $request->input('name', '');
        $data['keywords'] = $request->input('keywords', '');
        $data['description'] = $request->input('description', '');
        $data['thumb'] = $request->input('thumb', '');
        $data['status'] = $request->input('status', 0);
        $data['recommend'] = $request->input('recommend', 0);
        $data['is_reprint'] = $request->input('is_reprint', 0);
        $data['reprint_url'] = $request->input('reprint_url', '');
        $data['content'] = $request->input('content', '');
        $tag = $request->input('tag', array());
        $id = $request->input('id', 0);

        if(!in_array($data['status'], array(0, 1, 2))){
            return $this->_return('1', '系统状态错误，请稍后重试');
        }

        if(!$data['name']){
            return $this->_return('1', '文章名称不能为空');
        }
        if(!$data['category_id']){
            return $this->_return('1', '请选择分类');
        }
        if(!$data['content']){
            return $this->_return('1', '请输入文章内容');
        }

        if($data['is_reprint']==1 && $data['reprint_url']){
            $par = '/^http(s?):\/\/(?:[A-za-z0-9-]+\.)+[A-za-z]{2,4}(:\d+)?(?:[\/\?#][\/=\?%\-&~`@[\]\':+!\.#\w]*)?$/';
            if(!preg_match($par, $data['reprint_url'])){
                return $this->_return('1', '转载地址输入不合法，请重新输入');
            }
        }

        DB::beginTransaction();
        if($id==0){
            $data['create_time'] = time();

            //如果是发布，添加发布时间
            if($data['status']==2){
                $data['publish_time'] = time();
            }
            $id = DB::table('article')->insertGetId($data);
            if(!$id){
                DB::rollBack();
                return $this->_return('1', '保存文章失败');
            }
        }else{
            $art = Article::where('id', $id)->whereIn('status', array(0, 1, 2))->first();
            if(!$art){
                return $this->_return('1', '原文件不存在或已删除');
            }else{
                if($art->status!=2 && $data['status']==2){
                    $data['publish_time'] = time();
                }
            }

            $data['modify_time'] = time();
            $res = Article::where('id', $id)->update($data);
            if(!$res){
                DB::rollBack();
                return $this->_return('1', '更新文章失败');
            }

            //存在标签则删除
            if(ArticleTag::where('article_id', $id)->first()){
                $res = ArticleTag::where('article_id', $id)->delete();
                if(!$res){
                    DB::rollBack();
                    return $this->_return('1', '更新文章标签失败');
                }
            }
        }

        if($tag){
            $tags = array();
            foreach($tag as $k=>$v){
                $tags[] = array('article_id'=>$id, 'tag_id'=>$v);
            }
            $res = DB::table('article_tag')->insert($tags);
            if(!$res){
                DB::rollBack();
                return $this->_return('1', '更新文章标签失败');
            }
        }

        DB::commit();
        return $this->_return('0', 'success');
    }

    public function delete(Request $request){
        $id = $request->input('id', 0);

        $article = Article::whereIn('status', array(0, 1, 2))
            ->where('id', $id)->first();

        if(!$article){
            return $this->_return('1', '要删除的文章不存在');
        }

        $data['status'] = 3;
        $data['delete_time'] = time();

        $res = Article::where('id', $id)->update($data);
        if($res){
            return $this->_return('0', 'success');
        }else{
            return $this->_return('1', '删除失败，请稍后重试');
        }
    }
}
