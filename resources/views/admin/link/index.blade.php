@extends('admin.public.master')

@section('breadcrumb_button')
    <a href="{{url('admin/link/create')}}" class="btn btn-sm btn-success fa fa-plus-square"> 添加友情链接</a>
@endsection

@section('content')

    <div class="panel-body">
        <table class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
                <th>名称</th>
                <th>链接</th>
                <th>图片</th>
                <th>状态</th>
                <th>排序</th>
                <th>添加时间</th>
                <th>修改时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @if($data->items())
                @foreach($data as $item)
                    <tr>
                        <td><span title="{{$item->description}}">{{$item->name}}</span></td>
                        <td><a href="{{$item->url}}" target="_blank">{{$item->url}}</a></td>
                        <td>@if($item->image)<img src="{{url($item->image)}}" height="50" />@endif</td>
                        <td>@if($item->status==1)显示@else<span style="color: #f00;">不显示</span>@endif</td>
                        <td>{{$item->rank}}</td>
                        <td>{{date('Y-m-d H:i:s', $item->create_time)}}</td>
                        <td>@if($item->modify_time){{date('Y-m-d H:i:s', $item->modify_time)}}@else @endif</td>
                        <td>
                            <a href="{{url('admin/link/'.$item->id)}}/edit" class="fa fa-edit btn btn-primary btn-sm">&nbsp;修改</a>
                            <button class="fa fa-trash btn btn-danger btn-sm delete-item" value="{{$item['id']}}">&nbsp;删除</button>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr><td colspan="8" class="text-center">暂无数据</td></tr>
            @endif
            </tbody>
        </table>

        <div class="row">
            <div class="col-sm-12" style="text-align: right">
                {!! $data->links() !!}
            </div>
        </div>
    </div>

@endsection

@section('after_js')

<script type="text/javascript">
    var delete_link_url = "{{url('admin/link/destory')}}";
    var _token = "{{ csrf_token() }}";

</script>
<script type="text/javascript" src="{{asset('static/js/admin/link.js')}}"></script>
<script type="text/javascript" src="{{asset('static/js/admin/link.js')}}"></script>

@endsection

