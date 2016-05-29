@extends('admin.public.master')

@section('css')
    @parent
    <link href="{{asset('static/css/plugins/treeview/bootstrap-treeview.css')}}" rel="stylesheet">
@endsection

@section('breadcrumb_button')
    <a href="{{url('admin/category/add')}}" class="btn btn-sm btn-success fa fa-plus-square"> 添加分类</a>
@endsection

@section('content')

<div class="panel-body">
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>分类名称</th>
                <th>状态</th>
                <th>添加时间</th>
                <th>修改时间</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            {!!$categoryTree!!}
        </tbody>
    </table>
</div>

@endsection

@section('js')
     @parent
    <script src="{{asset('static/js/plugins/treeview/bootstrap-treeview.js')}}"></script>

    <script type="text/javascript">
        $(function(){
            $('.delete-item').click(function(){
                var id = parseInt($(this).val());
                deleteCategory(id)
            })
        })

        function deleteCategory(id){
            swal({
                title: "您确定要删除此分类吗？",
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
                    var url = "{{url('admin/category/delete')}}";
                    var data = {id:id,_token:'{!! csrf_token() !!}'}
                    $.ajax({
                        type:'POST',
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