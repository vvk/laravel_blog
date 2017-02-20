@extends('admin.public.master')

@section('breadcrumb_button')
    <a href="{{url('admin/banner/create')}}" class="btn btn-sm btn-success fa fa-edit"> 添加轮播图</a>
@endsection

@section('content')

    <div class="panel-body">
        <table class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
                <th>标题</th>
                <th>轮播图</th>
                <th>新标签打开</th>
                <th>状态</th>
                <th>排序</th>
                <th>备注</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @if($data->items())
                @foreach($data as $item)
                    <tr>
                        <td>{{$item->name}}</td>
                        <td>
                            <a href="@if($item['url']){{$item['url']}}@else javascript:void(0) @endif" target="_blank">
                                <img src="{{$item->image}}" width="200">
                            </a>
                        </td>
                        <td>
                            @if($item['target'] == 1) 是 @else 否 @endif
                        </td>
                        <td>
                            @if($item['status'] == 1) 显示 @else 不显示 @endif
                        </td>
                        <td>{{$item['rank']}}</td>
                        <td>{{$item['remark']}}</td>
                        <td>
                            <a href="{{url('admin/banner/'.$item['id'].'/edit/')}}" class="fa fa-edit btn btn-primary btn-sm">&nbsp;修改</a>
                            <button class="fa fa-trash btn btn-danger btn-sm delete-item" value="{{$item['id']}}">&nbsp;删除</button>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr><td colspan="9" class="text-center">暂无数据</td></tr>
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

@section('js')
    @parent
    <script type="text/javascript">
        $(function(){
            $('.delete-item').click(function(){
                var id = parseInt($(this).val());
                deleteArticle(id)
            })
        })

        function deleteArticle(id){
            swal({
                title: "您确定要删除此文章吗？",
                text: "",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "删除",
                cancelButtonText: "取消",
                closeOnConfirm: false,
                closeOnCancel:false
            }, function (isConfirm) {
                if(!isConfirm){
                    swal({title:"已取消",text:"您取消了删除操作！",type:"error",confirmButtonText:'确定'});
                }else{
                    var url = "{{url('admin/banner/destroy')}}";
                    var data = {id:id,_token:'{!! csrf_token() !!}'}
                    $.ajax({
                        type:'DELETE',
                        dataType:'JSON',
                        url:url,
                        data:data,
                        success:function(response){
                            if(response.status==0){
                                swal({title:"删除成功!",type:"success",confirmButtonText:'确定'},
                                    function(){
                                        window.location.reload();
                                    });
                            }else{
                                swal({title:"删除失败",text:response.msg, 'type':'error'});
                            }
                        }
                    });
                }
            });
        }


    </script>


@endsection