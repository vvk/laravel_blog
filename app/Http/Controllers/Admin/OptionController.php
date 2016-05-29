<?php

namespace App\Http\Controllers\Admin;

use App\Http\Models\Option;
use Illuminate\Http\Request;
use DB;

class OptionController extends CommonController
{

    public function index(Option $option, $type=1){
        $optionType = config('web.option_type');
        $optionFormType = config('web.option_form_type');

        if(!in_array($type, array_keys($optionType))){
            $type = 1;
        }

        $data = $option::where('type', $type)->where('status', 1)->get();

        $breadcrumb = array('系统设置');
        $breadcrumb[] = $optionType[$type];

        return view('admin.option.edit', compact('data', 'breadcrumb', 'type', 'optionType', 'optionFormType'));
    }

    /**
     * 保存配置
     */
    public function store(Request $request){
        $input = $request->except('_token');
        $type = $input['type'];
        unset($input['type']);

        DB::beginTransaction();
        foreach($input as $k=>$v){
            if($v!=0 && !$v){
                continue;
            }
            $where = array('type'=>$type, 'title'=>$k, 'status'=>1);
            $option = Option::where($where)->first();
            if($option->form_type==2){  //checkbox
                if($v){
                    $v = 1;
                }else{
                    $v = 0;
                }
            }
            if($option->value==$v){
                continue;
            }
            $res = Option::where($where)->update(array('value'=>$v));
            if(!$res){
                DB::rollBack();
                return $this->_return('1', '保存'.$option->name.'失败');
            }
        }

        DB::commit();
        return $this->_return('0', 'success');
    }


    public function option(Request $request,Option $option){
        $type = $request->input('type', 0);
        $optionType = config('web.option_type');
        if(!in_array($type, array_keys($optionType))){
            $type = 0;
        }

        $query = $option::whereIn('status', array(0, 1));
        if($type){
            $query->where('type', $type);
        }
        $data = $query->paginate(20);

        $breadcrumb = array('系统设置', '配置列表');

        $optionFormType = config('web.option_form_type');

        return view('admin.option.option', compact('data', 'breadcrumb', 'optionType', 'optionFormType', 'type'));
    }

    public function editOption($id=0){
        $breadcrumb = array('系统设置');
        $data = array();
        if ($id) {
            $data = Option::whereIn('status', array(0, 1))->find($id);
            if (!$data) {
                //@todo 不存在
                die('配置不存在');
            }
            $breadcrumb[] = '修改配置';
        } else {
            $breadcrumb[] = '添加配置';
        }

        $optionType = config('web.option_type');
        $optionFormType = config('web.option_form_type');

        return view('admin.option.edit_option', compact('id', 'data', 'breadcrumb', 'optionType', 'optionFormType'));
    }

    /**
     * 保存配置选项
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeOption(Request $request){
        $id = $request->input('id', 0);
        $data['name'] = $request->input('name', '');
        $data['title'] = $request->input('title', '');
        $data['status'] = $request->input('status', 1);
        $data['type'] = $request->input('type', 1);
        $data['form_type'] = $request->input('form_type', 1);

        $optionType = config('web.option_type');
        $optionFormType = config('web.option_form_type');

        if(!$data['name']){
            return $this->_return('1', '配置名称不能为空');
        }

        if(!$data['title']){
            return $this->_return('1', '配置字段不能为空');
        }

        if(!in_array($data['type'], array_keys($optionType))){
            return $this->_return('1', '配置类型错误');
        }

        if(!in_array($data['form_type'], array_keys($optionFormType))){
            return $this->_return('1', '表单类型错误');
        }

        $isExist = Option::where('status', $data['status'])->where('title', $data['title'])->first();
        if($isExist){
            return $this->_return('1', '配置字段已存在');
        }

        if($id){
            $option = Option::where('id', $id)->first();
            if(!$option){
                return $this->_return('1', '要修改的配置不存在');
            }

            if(!$option->value && $data['form_type']==2){
                $data['value'] = 1;
            }
            $res = Option::where('id', $id)->update($data);
        }else{
            if($data['form_type']==2){
                $data['value'] = 1;
            }
            $res = Option::create($data);
        }

        if($res){
            return $this->_return('0', 'success');
        }else{
            return $this->_return('1', '保存失败');
        }
    }

    /**
     * 删除配置项
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteOption(Request $request){
        $id = $request->input('id', 0);

        $option = Option::whereIn('status', array(0, 1))
            ->where('id', $id)->first();

        if (!$option) {
            return $this->_return('1', '要删除的配置不存在');
        }

        $data['status'] = 2;

        $res = Option::where('id', $id)->update($data);
        if ($res) {
            return $this->_return('0', 'success');
        } else {
            return $this->_return('1', '删除失败，请稍后重试');
        }
    }
}
