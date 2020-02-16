<?php

namespace App\Http\Controllers\Admin;

use App\Models\FigureBed;
use Illuminate\Http\Request;
use Validator;

class FigureBedController extends CommonController
{
    protected $maxDay = 30;

    public function index(Request $request)
    {
        $params = $this->getParams($request);

        $model = FigureBed::where('ctime', '>=', strtotime($params['start_date']))
            ->where('ctime', '<=', strtotime($params['end_date'].' 23:59:59'));
        if (!empty($params['ip'])) {
            $model->where(['ip' => ip2long($params['ip'])]);
        }

        $imageData = $model->orderBy('id', 'desc')->paginate();
        if ($imageData) {
            $imageData->appends($params)->render();
        }

        $breadcrumb = ['扩展功能', '图床'];
        $data = ['breadcrumb' => $breadcrumb, 'params' => $params, 'imageData' => $imageData];
        return view('admin.figure-bed.index', $data);
    }

    protected function getParams(Request $request)
    {
        $params = $request->input();
        if (Validator::make($params, ['start_date' => 'date'])->fails()) {
            $params['start_date'] = '';
        }
        if (Validator::make($params, ['end_date' => 'date'])->fails()) {
            $params['end_date'] = '';
        }

        if (empty($params['start_date']) && empty($params['end_date'])) {
            $params['start_date'] = date('Y-m-d', strtotime('-7 day'));
            $params['end_date'] = date('Y-m-d');
        }

        if (empty($params['start_date']) && !empty($params['end_date'])) {
            $params['start_date'] = date('Y-m-d', strtotime('-7 day', strtotime($params['end_date'])));
        }

        if (Validator::make($params, ['end_date' => 'after:start_date'])->fails()) {
            $params['start_date'] = $params['end_date'];
        }

        if ($this->getDateDiff($params['start_date'], $params['end_date'])+1 > $this->maxDay) {
            $params['start_date'] = date('Y-m-d', strtotime('-'.$this->maxDay.' day', strtotime($params['end_date'])));
        }

        $params['ip'] = $params['ip'] ?? '';
        if (Validator::make($params, ['ip' => 'ip'])->fails()) {
            $params['ip'] = '';
        }

        return $params;
    }

    protected function getDateDiff($date1, $date2)
    {
        $time1 = strtotime($date1);
        $time2 = strtotime($date2);
        return abs(($time1 - $time2) / 86400);
    }
}
