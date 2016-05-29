@extends('admin.public.master')

@section('content')

    <div class="wrapper wrapper-content">


        <div class="row">
            <div class="col-sm-12">
                <form method="" class="form-horizontal">

                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">配置名称</label>
                        <div class="col-sm-3">
                            <input type="text" placeholder="配置名称" value="{{$data['name'] or ''}}" class="form-control name">
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">配置字段</label>
                        <div class="col-sm-3">
                            <input type="text" placeholder="配置字段，英文或下划线" value="{{$data['title'] or ''}}" class="form-control title">
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">配置类型</label>
                        <div class="col-sm-2">
                            <select class="form-control type" name="type">
                                @foreach($optionType as $k=>$v)
                                    @if($data && $data['type']==$k)
                                        <option value="{{$k}}" selected>{{$v}}</option>
                                    @else
                                        <option value="{{$k}}">{{$v}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">表单类型</label>
                        <div class="col-sm-2">
                            <select class="form-control form_type" name="type">
                                @foreach($optionFormType as $k=>$v)
                                    @if($data && $data['form_type']==$k)
                                        <option value="{{$k}}" selected>{{$v}}</option>
                                    @else
                                        <option value="{{$k}}">{{$v}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">启用</label>
                        <div class="col-sm-3">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" class="checkbox status" @if($id==0 || $data['status']==1) checked @endif name="status">
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <input type="hidden" class="_token" name="_token" value="{{csrf_token()}}">
                            <input type="hidden" class="id" name="id" value="{{$id}}">
                            <button class="btn btn-white" type="button" onclick="history.go(-1)">取消</button>
                            <button class="btn btn-primary save" type="button">保 存</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    @parent
    <script type="text/javascript">
        $(function(){
            $('.save').click(function(){
                save();
            })
        })

        function save(){
            $('.save').text('保存中...').attr('disabled', true);
            var id = parseInt($('.id').val());
            var name = $.trim($('.name').val());
            var title = $.trim($('.title').val());
            var type = parseInt($('.type').val());
            var form_type = parseInt($('.form_type').val());
            var _token = $.trim($('._token').val());

            if(!name){
                swal({title:"保存失败",text:"配置名称不能为空", 'type':'error'});
                $('.save').text('保 存').attr('disabled', false);
                return false;
            }

            if(!title){
                swal({title:"保存失败",text:"配置字段不能为空", 'type':'error'});
                $('.save').text('保 存').attr('disabled', false);
                return false;
            }

            var par = /[^\da-zA-X_]/;
            if(par.test(title)){
                swal({title:"保存失败",text:"配置字段格式不正确", 'type':'error'});
                $('.save').text('保 存').attr('disabled', false);
                return false;
            }

            var status = 0;
            if($('.status').is(':checked')){
                status = 1;
            }

            var data = { name:name,  _token:_token, status:status, id:id, title:title, type:type, form_type:form_type};
            var url = "{{url('admin/option/storeOption')}}";

            $.ajax({
                type:'POST',
                dataType:'JSON',
                url:url,
                data:data,
                success:function(response){
                    if(response.status==0){
                        window.location.href = "{{url('admin/option/option')}}";
                    }else{
                        swal({title:"保存失败",text:response.msg, 'type':'error'});
                        $('.save').text('保 存').attr('disabled', false);
                        return false;
                    }
                }
            });
        }



    </script>


@endsection
