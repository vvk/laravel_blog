@extends('admin.public.master')

@section('breadcrumb_button')
    <a href="{{url('admin/article/add')}}" class="btn btn-sm btn-success fa fa-edit"> 写文章</a>
@endsection

@section('content')

    <div class="panel-body">

        <div class="panel-body">
            <div class="btn-group">
                <a href="{{url('admin/article')}}?status=-1" class="btn @if($status==-1) btn-primary @else btn-default @endif">全部</a>
                @foreach($articleStatus as $k=>$v)
                    <a href="{{url('admin/article')}}?status={{$k}}" class="btn @if($status==$k) btn-primary @else btn-default @endif">{{$v}}</a>
                @endforeach
            </div>
        </div>

        <table class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
                <th>标题</th>
                <th>分类</th>
                <th>状态</th>
                <th>浏览量</th>
                <th>是否推荐</th>
                <th>是否为转载</th>
                <th>创建时间</th>
                <th>修改时间</th>
                <th>发布时间</th>

                <th>操作</th>
            </tr>
            </thead>
            <tbody>
                @if($data->items())
                    @foreach($data as $item)
                        <tr>
                            <td>{{$item->name}}</td>
                            <td>{{$item->category->name}}</td>
                            <td>{{config('web.article_status')[$item->status]}}</td>
                            <td>{{$item->view_count}}</td>
                            <td>@if($item->recommend==1)是@else否@endif</td>
                            <td>@if($item->is_reprint==1)是@else否@endif</td>
                            <td>{{date('Y-m-d H:i:s', $item->create_time)}}</td>
                            <td>
                                @if($item->modify_time){{date('Y-m-d H:i:s', $item->modify_time)}}@endif
                            </td>
                            <td>
                                @if($item->status==2){{date('Y-m-d H:i:s', $item->publish_time)}}@endif
                            </td>

                            <td>
                                <a href="{{url('admin/article/edit/')}}/{{$item['id']}}" class="fa fa-edit btn btn-primary btn-sm">&nbsp;修改</a>
                                <a href="{{url('archives').'/'.$item['id']}}?type=view" target="_blank" class="fa fa-paper-plane-o btn btn-primary btn-sm">&nbsp;修改</a>
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
                    var url = "{{url('admin/article/delete')}}";
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