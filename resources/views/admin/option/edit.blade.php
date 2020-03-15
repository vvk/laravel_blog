@extends('admin.public.master')

@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-12">
                <form method="" class="form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">表单类型</label>
                        <div class="col-sm-2">
                            <select class="form-control form_type" name="form_type">
                                @foreach($formTypeList as $formType => $formName)
                                    <option @if(isset($option) && $option['form_type'] == $formType) selected @endif value="{{$formType}}">{{$formName}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">显示名称</label>
                        <div class="col-sm-2">
                            <input type="text" name="name" placeholder="显示名称" value="{{$option['name'] or ''}}" class="form-control name">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">配置字段</label>
                        <div class="col-sm-2">
                            <input type="text" name="title" placeholder="配置字段" value="{{$option['title'] or ''}}" class="form-control title">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">placeholder</label>
                        <div class="col-sm-2">
                            <input type="text" name="placeholder" placeholder="placeholder" value="{{$option['placeholder'] or ''}}" class="form-control placeholder">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">form class</label>
                        <div class="col-sm-2">
                            <input type="text" name="form_class" placeholder="form class" value="{{$option['form_class'] or ''}}" class="form-control form_class">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">配置项</label>
                        <div class="col-sm-4">
                            <input type="text" name="form_option" placeholder="配置项" value="{{$option['form_option'] or ''}}" class="form-control form_option">
                            <span class="help-block m-b-none">单选框、筛选框、下拉框不能为空，一维数组json格式</span>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">排序值</label>
                        <div class="col-sm-2">
                            <input type="number" name="order" placeholder="排序值" value="{{$option['order'] or 100}}" class="form-control order">
                            <span class="help-block m-b-none">配置页面显示顺序，越小越靠前，0-255</span>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <input type="hidden" class="_token" name="_token" value="{{csrf_token()}}">
                            <input type="hidden" class="id" name="id" value="{{$id}}">
                            <button class="btn btn-white" type="button" onclick="history.go(-1)">取消</button>
                            <button class="btn btn-primary save-btn" type="button">保 存</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('after_js')
    <script src="{{asset('static/js/ajaxfileupload.js')}}"></script>
    <script src="{{asset('static/js/admin/base.js')}}"></script>
    <script type="text/javascript">
        var saveOptionUrl = "{{url('admin/option')}}";
        $(function(){
            $('.save-btn').click(function(){
                saveOption();
            });
        });

        function saveOption(){
            var saveBtn = $('.save-btn');
            saveBtn.text('保存中...').attr('disabled', true);
            var data = {};
            data.form_type = parseInt($('.form_type').val());
            data.name = $.trim($('.name').val());
            data.title = $.trim($('.title').val());
            data.form_class = $.trim($('.form_class').val());
            data.placeholder = $.trim($('.placeholder').val());
            data.form_option = $.trim($('.form_option').val());
            data._token = $.trim($('._token').val());
            data.order = parseInt($('.order').val());
            data.id = parseInt($('.id').val());

            if (!data.name) {
                swal({title:"保存失败",text:"显示名称不能为空", 'type':'error', 'confirmButtonText':'确定'});
                saveBtn.text('保 存').attr('disabled', false);
                return false;
            }

            if (!data.title) {
                swal({title:"保存失败",text:"配置字段不能为空", 'type':'error', 'confirmButtonText':'确定'});
                saveBtn.text('保 存').attr('disabled', false);
                return false;
            }

            if ($.inArray(data.form_type, [2, 4, 6]) != -1 && !data.form_option) {
                swal({title:"保存失败",text:"配置项不能为空", 'type':'error', 'confirmButtonText':'确定'});
                saveBtn.text('保 存').attr('disabled', false);
                return false;
            }

            if (data.order < 0 || data.order > 255) {
                swal({title:"保存失败",text:"排序值取值范围为0-255", 'type':'error', 'confirmButtonText':'确定'});
                saveBtn.text('保 存').attr('disabled', false);
                return false;
            }

            $.ajax({
                type:'POST',
                dataType:'JSON',
                url: saveOptionUrl,
                data: data,
                success: function(response){
                    if(response.status==0){
                        window.location.href = "{{url('admin/option')}}";
                    }else{
                        swal({title:"保存失败",text:response.msg, 'type':'error', 'confirmButtonText':'确定'});
                        saveBtn.text('保 存').attr('disabled', false);
                        return false;
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR, textStatus, errorThrown)
                    swal({title:"保存失败",text:'系统错误，请稍后再试', 'type':'error', 'confirmButtonText':'确定'});
                    saveBtn.text('保 存').attr('disabled', false);
                }
            });
        }
    </script>
@endsection
