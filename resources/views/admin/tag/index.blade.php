@extends('admin.public.master')

@section('breadcrumb_button')
    <a href="{{url('admin/tag/create')}}" class="btn btn-sm btn-success fa fa-plus-square"> 添加标签</a>
@endsection

@section('content')
    <div class="panel-body">
        <table class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
                <th>标签名称</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $item)
                <tr>
                    <td>{{$item['name']}}</td>
                    <td>
                        <a href="{{url('admin/tag/'.$item['id'].'/edit/')}}" class="fa fa-edit btn btn-primary btn-sm">&nbsp;修改</a>
                        <button class="fa fa-trash btn btn-danger btn-sm delete-item" value="{{$item['id']}}">&nbsp;删除</button>
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

@section('js')
    @parent

    <script type="text/javascript">
        $(function(){
            $('.delete-item').click(function(){
                var id = parseInt($(this).val());
                deleteTag(id)
            })
        })

        function deleteTag(id){
            swal({
                title: "您确定要删除此标签吗？",
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
                    var url = "{{url('admin/tag/destory')}}";
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