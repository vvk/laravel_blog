@extends('admin.public.master')

@section('content')
    <div class="panel-body">

         <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th>配置名称</th>
                    <th>配置字段</th>
                    <th>表单类型</th>
                    <th>状态</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $item)
                    <tr>
                        <td>{{$item['name']}}</td>
                        <td>{{$item['title']}}</td>
                        <td>{{$optionFormType[$item['form_type']]}}</td>
                        <td>
                            @if($item['status']==1)启用@else<span style="color:#f00">暂停</span>@endif
                        </td>
                        <td>
                            <a href="{{url('admin/option/editOption/')}}/{{$item['id']}}" class="fa fa-edit btn btn-primary btn-sm">&nbsp;修改</a>
                        </td>
                    </tr>
                 @endforeach
            </tbody>
        </table>
        <div class="row">
            <div class="col-sm-12" style="text-align: right">
                    {!! $data->links() !!}
            </div>
        </div>
    </div>
@endsection
