<?php

namespace App\Repositories\Option;

use App\Http\Requests\Request;
use App\Models\Option;
use App\Repositories\Repository;
use Illuminate\Pagination\Paginator;
use Illuminate\Validation\Rule;
use Validator;
use DB;

class OptionRepository extends Repository
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        //自动验证json，如果是整数也可以验证通过
        $formType = $request->input('form_type', 0);
        $formOption = $request->input('form_option');
        if (in_array($formType, Option::MUST_FORM_OPTION_FORM_OPTION) || !empty($formOption)) {
            $formOptionArr = json_decode($formOption, true);
            if (empty($formOptionArr) || !is_array($formOptionArr) || json_last_error()) {
                return ajaxResponse(400, trans('error.option_form_option_invalid'));
            }
        }

        $id = $request->input('id', 0);
        $data = $request->input();
        $errorMessages = [
            'name.unique' => trans('error.option_name_unique'),
            'title.unique' => trans('error.option_title_unique'),
        ];
        $validator = Validator::make($data, [
            'name' => Rule::unique(Option::getTableName())->where(function ($query) use($id) {
                if ($id != 0) {
                    $query->where('id', '!=', $id);
                }
                return $query->where('status', '!=', Option::$deleteStatus);
            }),
            'title' => Rule::unique(Option::getTableName())->where(function ($query) use($id) {
                if ($id != 0) {
                    $query->where('id', '!=', $id);
                }
                return $query->where('status', '!=', Option::$deleteStatus);
            }),
        ], $errorMessages);

        if ($validator->fails()) {
            $request->failedValidation($validator);
        }

        unset($data['_token'], $data['id']);
        if ($id == 0) {
            $data['value'] = '';
            $data['create_time'] = time();
            $result = Option::create($data);
        } else {
            $optopn = $this->getOptionById($id);
            if ($optopn['form_type'] != $data['form_type']) {
                $data['value'] = '';
            }
            $data['modify_time'] = time();
            $result = Option::where('id', $id)->update($data);
        }

        if ($result) {
            return ajaxResponse(0, 'success');
        } else {
            return ajaxResponse(1, trans('error.save_fail'));
        }
    }

    /**
     * @param $id
     * @return array
     */
    public function getOptionById($id)
    {
        $avaliableStatus = [Option::$enableStatus, Option::$disabledStatus];
        $option = Option::where('id', $id)->whereIn('status', $avaliableStatus)->first();
        return empty($option) ? [] : $option->toArray();
    }

    /**
     * @param  $params
     * @return mixed
     */
    public function getOptionList($params = [])
    {
        $avaliabledStatus = [Option::$enableStatus];
        $optionModel = Option::whereIn('status', $avaliabledStatus);
        if (!empty($fields)) {
            $optionModel->select($fields);
        }
        $option = $optionModel->orderBy('order', 'asc')->get();
        if (empty($option)) {
            return $option;
        }

        if (!isset($params['format']) || $params['format'] == true) {
            $option = $option->map(function ($item, $key){
                if (in_array($item->form_type, Option::MUST_FORM_OPTION_FORM_OPTION)) {
                    $item->form_option = json_decode($item->form_option);
                }

                if ($item->form_type == Option::FORM_TYPE_CHECKBOX) {//checkbox
                    $item->value = json_decode($item->value);
                    if (empty($item->value) && !is_array($item->value)) {
                        $item->value = [];
                    }
                } elseif ($item->form_type == Option::FORM_TYPE_SWITCH) {
                    $item->value = intval($item->value);
                }
                return $item;
            });
        }

        return $option;
    }

    public function storeOption(Request $request)
    {
        $data = $request->input();
        try {
            $params = ['format' => false];
            $optionList = $this->getOptionList($params);
            if (empty($optionList)) {

            }
            if (empty($optionList)) {
                return ajaxResponse(500, trans('error.system_error'));
            }

            $count = 0;
            DB::beginTransaction();
            $time = time();
            foreach ($optionList as $item) {
                if (!isset($data[$item->title]) || empty($data[$item->title])) {
                    $newValue = '';
                } else {
                    if ($item->form_type == Option::FORM_TYPE_SWITCH) {
                        $newValue = $data[$item->title] ? 1 : 0;
                    } elseif ($item->form_type == Option::FORM_TYPE_CHECKBOX) {
                        $newValue = json_encode($data[$item->title]);
                    } else {
                        $newValue = $data[$item->title];
                    }
                }

                if ($newValue == $item->value) {
                    continue;
                }

                $item->value = $newValue;
                $res = Option::where('id', $item->id)->update(['value' => $newValue, 'modify_time' => $time]);
                if (!$res) {
                    DB::rollBack();
                    return ajaxResponse(1, trans('error.save_fail'));
                }
                $count++;
            }
            DB::commit();
            return ajaxResponse(0, '成功保存 '.$count.' 条数据');
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage().PHP_EOL;
            echo $e->getFile().PHP_EOL;
            echo $e->getLine().PHP_EOL;
            print_r($item);
        }
        return ajaxResponse(500, trans('error.system_error'));
    }
}