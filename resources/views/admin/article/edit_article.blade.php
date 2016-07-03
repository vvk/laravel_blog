@extends('admin.public.master')

@section('content')

    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-sm-12">
                <form method="" class="form-horizontal">

                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">文章名称</label>
                        <div class="col-sm-3">
                            <input type="text" name="name" placeholder="文章名称" value="{{$data['name'] or ''}}" class="form-control name">
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">关键字</label>
                        <div class="col-sm-4">
                            <input type="text" name="keywords" placeholder="关键字" value="{{$data['keywords'] or ''}}" class="form-control keywords">
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
                        <label class="col-sm-2 control-label">分类</label>
                        <div class="col-sm-2">
                            <select class="form-control category_id" name="category_id">
                                <option value="0">--请选择分类--</option>
                                {!! $categoryOptions !!}
                            </select>
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">是否推荐</label>
                        <div class="col-sm-3">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" class="checkbox recommend" @if($id!=0 && $data['recommend']==1) checked @endif name="recommend">
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">是否为转载</label>
                        <div class="col-sm-3">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" class="checkbox is_reprint" @if($id!=0 && $data['is_reprint']==1) checked @endif name="is_reprint">
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group reprint_url_box" @if($id==0 || $data['is_reprint']==0)style="display: none"@endif>
                        <div class="hr-line-dashed "></div>
                        <label class="col-sm-2 control-label">转载地址</label>
                        <div class="col-sm-10">
                            <input type="text" name="reprint_url" placeholder="转载地址" value="{{$data['reprint_url'] or ''}}" class="form-control reprint_url">
                            <span class="help-block m-b-none">转载文章请注明转载地址</span>
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">缩略图</label>

                        <div class="col-sm-4 thumb-input-box" @if($data && $data['thumb'])style="display:none"@endif>
                            <input type="file" name="file" id="file" class="form-control file" onchange="uploadImg()">
                        </div>
                        <div class="col-sm-8 thumb-box" @if(!$data || !$data['thumb'])style="display:none"@endif >
                            <div class="col-sm-8">
                                <div style="width: 220px;float: left">
                                    <img src="{{isset($data['thumb']) ? asset($data['thumb']) : ''}}" width="200" />
                                </div>

                                <input type="hidden" value="{{$data['thumb'] or ''}}" name="thumb" class="thumb" />
                                <div style="width: 100px;float: left">
                                    <button type="button" class="btn btn-sm btn-danger delete-thumb">删除图片</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">文章内容</label>
                        <div class="col-sm-8">
                            <script id="editor" type="text/plain" style="height:500px;">
                                @if($id && $data['content'])
                                    {!! $data['content'] !!}
                                @endif
                            </script>
                        </div>
                    </div>


                    @if($tagList)
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">标签</label>
                        <div class="col-sm-10 checkbox">
                            @foreach($tagList as $item)
                                <label style="margin-right: 30px">
                                    <input type="checkbox" @if(in_array($item->id, $articleTagsId)) checked @endif style="display: inline-block" value="{{$item->id}}" class="checkbox tag" name="tag[]">{{$item->name}}
                                </label>
                            @endforeach

                        </div>
                    </div>
                    @endif

                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <div class="col-sm-8 col-sm-offset-2">
                            <input type="hidden" class="_token" name="_token" value="{{csrf_token()}}">
                            <input type="hidden" class="id" name="id" value="{{$id}}">
                            <button class="btn btn-white save" type="button" onclick="history.go(-1)">取消</button>
                            @if(!$id ||  $id && $data['status']==0)<button class="btn btn-info save" value="0" type="button">保存草稿</button>@endif
                            <button class="btn btn-primary save" value="1" type="button">保存</button>
                            <button class="btn btn-success save" value="2" type="button">
                                @if($id && $data['status']==2)更新@else发布@endif
                            </button>
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
    <script src="{{asset('plugins/ueditor/ueditor.config.js')}}"></script>
    <script src="{{asset('plugins/ueditor/ueditor.all.js')}}"></script>
    <script src="{{asset('plugins/ueditor/lang/zh-cn/zh-cn.js')}}"></script>
    <script type="text/javascript">
        $(function(){
            $('.save').click(function(){
                var type = parseInt($(this).val());
                save(type);
            })

            $('.delete-thumb').click(function(){
                deleteThumb();
            })

            $('.is_reprint').click(function(){
                if($(this).is(':checked')){
                    $('.reprint_url_box').show().find('reprint_url').val('');
                }else{
                    $('.reprint_url_box').hide().find('reprint_url').val('');
                }
            })

            var ue = UE.getEditor('editor');
        })

        function save(type){
            var id = parseInt($('.id').val());
            var category_id = parseInt($('.category_id').val());

            var name = $.trim($('.name').val());
            var keywords = $.trim($('.keywords').val());
            var description = $.trim($('.description').val());
            var thumb = $.trim($('.thumb').val());
            var _token = $.trim($('._token').val());
            var status=  type;

            var is_reprint = 0;
            if($('.is_reprint').is(':checked')){
                is_reprint=  1;
                var reprint_url = $.trim($('.reprint_url').val());
            }else{
                var reprint_url = '';
            }

            var tag = Array();
            $.each($('.tag'), function(k, v){
                if($(this).is(':checked')){
                    tag.push($(this).val());
                }
            });

            var recommend = 0;
            if($('.recommend').is(':checked')){
                recommend=  1;
            }

            var content = UE.getEditor('editor').getContent();

            if(!name){
                swal({title:"保存失败",text:"文章名称不能为空", 'type':'error'});
                return false;
            }
            if(category_id==0){
                swal({title:"保存失败",text:"请选择分类", 'type':'error'});
                return false;
            }
            if(!content){
                swal({title:"保存失败",text:"请输入文章内容", 'type':'error'});
                return false;
            }

            var data = {id:id, category_id:category_id, is_reprint:is_reprint, reprint_url:reprint_url, name:name, keywords:keywords, description:description,thumb:thumb, _token:_token, status:status, tag:tag, content:content,recommend:recommend};

            var url = "{{url('admin/article/store')}}";
            $.ajax({
                type:'POST',
                dataType:'JSON',
                url:url,
                data:data,
                success:function(response){
                    if(response.status==0){
                        if(status==0){
                            swal({title:"保存成功", 'type':'success'});
                        }else{
                            window.location.href = "{{url('admin/article')}}";
                        }
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
            var url = "{{url('upload/thumb')}}";
            $.ajaxFileUpload({
                url:url,
                secureuri:false,
                fileElementId:"file",        //file的id
                dataType:"json",                  //返回数据类型为文本
                success:function(response){
                    if(response.status==0){
                        var url = response.data.url;
                        $('.thumb').val(url);
                        $('.thumb-box').show().find('img').attr('src', url);
                        $('.thumb-input-box').hide();
                    }else{
                        swal({title:"文件上传失败",text:response.msg, 'type':'error'});
                    }
                }
            })
        }

        //删除图片
        function deleteThumb(){
            $('.thumb-input-box').show();
            $('.thumb-box').hide().find('.thumb').val('').siblings('img').attr('src', '');
        }


    </script>
@endsection
