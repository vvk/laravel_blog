@extends('admin.public.master')

@section('content')

    <div class="wrapper wrapper-content">


        <div class="row">
            <div class="col-sm-12">
                <form method="" class="form-horizontal">

                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">友情链接名称</label>
                        <div class="col-sm-3">
                            <input type="text" name="name" placeholder="友情链接名称" value="{{$data['name'] or ''}}" class="form-control name">
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">链接</label>
                        <div class="col-sm-4">
                            <input type="text" name="url" placeholder="链接地址，以http或https开始" value="{{$data['url'] or ''}}" class="form-control url">
                        </div>
                    </div>


                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">描述</label>

                        <div class="col-sm-10">
                            <textarea class="form-control description" placeholder="描述" rows="3" name="description">{{$data['description'] or ''}}</textarea>
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">排序</label>
                        <div class="col-sm-3">
                            <input type="text" name="link_order" placeholder="排序" value="{{$data['link_order'] or 50}}" class="form-control link_order">
                            <span class="help-block m-b-none">0-255之间的正鷘数，越大越在前面</span>
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

                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">新标签打开</label>
                        <div class="col-sm-3">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" class="checkbox target" @if($id==0 || $data['target']==1) checked @endif name="target">
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">图片</label>

                        <div class="col-sm-4 image-input-box" @if($data && $data['image'])style="display:none"@endif>
                            <input type="file" name="file" id="file" class="form-control file" onchange="uploadImg()">
                        </div>
                        <div class="col-sm-8 image-box" @if(!$data || !$data['image'])style="display:none"@endif >
                            <div class="col-sm-3">
                                <img src="{{isset($data['image']) ? asset($data['image']) : ''}}" />
                                <input type="hidden" value="{{$data['image'] or ''}}" name="image" class="image" />
                            </div>
                            <div class="col-sm-2">
                                <button type="button" class="btn btn-sm btn-danger delte-img">删除图片</button>
                            </div>
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>
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

    <script src="{{asset('static/js/ajaxfileupload.js')}}"></script>
    <script type="text/javascript">
        $(function(){
            $('.save').click(function(){
                save();
            })

            $('.delte-img').click(function(){
                deleteImg();
            })
        })

        function save(){
            $('.save').text('保存中...').attr('disabled', true);
            var id = parseInt($('.id').val());
            var name = $.trim($('.name').val());
            var url = $.trim($('.url').val());
            var description = $.trim($('.description').val());
            var image = $.trim($('.image').val());
            var link_order = parseInt($('.link_order').val());
            var _token = $.trim($('._token').val());

            if(!name){
                swal({title:"保存失败",text:"链接名称不能为空", 'type':'error'});
                $('.save').text('保 存').attr('disabled', false);
                return false;
            }

            if(!url){
                swal({title:"保存失败",text:"链接不能为空", 'type':'error'});
                $('.save').text('保 存').attr('disabled', false);
                return false;
            }

            if(link_order<1 || link_order>255){
                swal({title:"保存失败",text:"排序为1-255之间的整数", 'type':'error'});
                $('.save').text('保 存').attr('disabled', false);
                return false;
            }

            var status = target = 0;
            if($('.status').is(':checked')){
                status = 1;
            }

            if($('.target').is(':checked')){
                target = 1;
            }

            var data = { name:name, url:url, description:description, link_order:link_order ,_token:_token, status:status, id:id, target:target, image:image};
            var url = "{{url('admin/link/store')}}";

            $.ajax({
                type:'POST',
                dataType:'JSON',
                url:url,
                data:data,
                success:function(response){
                    if(response.status==0){
                        window.location.href = "{{url('admin/link')}}";
                    }else{
                        var text = '';
                        if(response.msg=='error'){
                            $.each(response.data, function(k, v){
                                text += v+'，';
                            })
                            if(text.substr(text.length-1, 1)=='，'){
                                text = text.substr(0, text.length-1);
                            }
                        }else{
                            text = response.msg;
                        }

                        swal({title:"保存失败",text:text, 'type':'error'});
                        $('.save').text('保 存').attr('disabled', false);
                        return false;
                    }
                }
            });
        }

        //上传图片
        function uploadImg(){
            var url = "{{url('upload/linkImg')}}";
            $.ajaxFileUpload({
                url:url,
                secureuri:false,
                fileElementId:"file",        //file的id
                dataType:"json",                  //返回数据类型为文本
                success:function(response){
                    if(response.status==0){
                        var url = response.data.url;
                        $('.image').val(url);
                        url = "{{asset('')}}"+url;
                        $('.image-box').show().find('img').attr('src', url);
                        $('.image-input-box').hide();
                    }else{
                        swal({title:"文件上传失败",text:response.msg, 'type':'error'});
                    }
                }
            })
        }

        //删除图片
        function deleteImg(){
            $('.image-input-box').show();
            $('.image-box').hide().find('.image').val('').siblings('img').attr('src', '');
        }


    </script>
@endsection
