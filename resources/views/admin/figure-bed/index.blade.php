@extends('admin.public.master')

@section('after_css')
    <link href="{{asset('static/bootstrap/css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet">
@endsection

@section('breadcrumb_button')
@endsection

@section('content')
    <div class="panel-body">

        <form class="form-inline">
            <div class="row">
                <div class="form-group col-lg-4">
                    <label>时间：</label>
                    <input type="text" class="form-control start_date" value="{{$params['start_date']}}" readonly name="start_date" autocapitalize="off" placeholder="开始时间">
                    <span>至</span>
                    <input type="text" class="form-control end_date" value="{{$params['end_date']}}" readonly name="end_date" autocapitalize="off" placeholder="结束时间">
                </div>
                <div class="form-group col-lg-2">
                    <label>IP：</label>
                    <input type="text" class="form-control" value="{{$params['ip']}}" name="ip" placeholder="ip地址">
                </div>
                <div class="col-md-1 form-group">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> 查询</button>
                </div>
            </div>
        </form>

        <table class="table table-striped table-bordered table-hover" style="margin-top: 20px">
            <thead>
                <tr>
                    <th>时间</th>
                    <th>图片</th>
                    <th>ip</th>
                </tr>
            </thead>
            <tbody>
                @if($imageData->items())
                    @foreach($imageData->items() as $item)
                        <tr>
                            <td>{{date('Y-m-d H:i:s', $item->ctime)}}</td>
                            <td><a href="{{getUpyunCdnUrl($item->url)}}" target="_blank">{{getUpyunCdnUrl($item->url)}}</td>
                            <td>{{long2ip($item->ip)}}</td>
                        </tr>
                    @endforeach
                @else
                    <tr><td colspan="8" class="text-center">暂无数据</td></tr>
                @endif
            </tbody>
        </table>

        @if($imageData)
            <div class="row">
                <div class="col-sm-12 text-center">
                    {!! $imageData->links() !!}
                </div>
            </div>
        @endif
    </div>

@endsection

@section('after_js')
    <script src="{{asset('static/bootstrap/js/bootstrap-datetimepicker.min.js')}}"></script>
    <script src="{{asset('static/bootstrap/js/bootstrap-datetimepicker.zh-CN.js')}}"></script>
    <script type="text/javascript">
        $(function () {
            $('.start_date, .end_date').datetimepicker({
                language: 'zh-CN',
                autoclose: true,
                todayBtn: true,
                format: 'yyyy-mm-dd',
                minView: 'month',
                endDate: "{{date('Y-m-d')}}"
            });

            // 时间选择器互动（结束时间不得早于开始时间）
            $('.start_date').on('changeDate', function(ev){
                $('.end_date').datetimepicker('setStartDate', ev.date);
                var d = $('.end_dime').val();
                if (d) {
                    var date = new Date(d.replace(/-/g, '/'));
                    if(date != 'Invalid Date' && date < ev.date){
                        $('.end_date').datetimepicker('setDate', ev.date)
                    }
                }
            });
        });
    </script>
@endsection

