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
                            <input type="text" name="name" placeholder="文章名称" value="" class="form-control name">
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">关键字</label>
                        <div class="col-sm-4">
                            <input type="text" name="keywords" placeholder="关键字" value="" class="form-control keywords">
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">描述</label>
                        <div class="col-sm-10">
                            <textarea class="form-control description" placeholder="描述" rows="3" name="description"></textarea>
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">分类</label>
                        <div class="col-sm-2">
                            <select class="form-control category_id" name="category_id">
                                <option value="0">--请选择分类--</option>
                                {!! $category !!}
                            </select>
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">是否推荐</label>
                        <div class="col-sm-3">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" class="checkbox recommend" name="recommend">
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
                                    <input type="checkbox" class="checkbox is_reprint" name="is_reprint">
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group reprint_url_box">
                        <div class="hr-line-dashed "></div>
                        <label class="col-sm-2 control-label">转载地址</label>
                        <div class="col-sm-10">
                            <input type="text" name="reprint_url" placeholder="转载地址" value="" class="form-control reprint_url">
                            <span class="help-block m-b-none">转载文章请注明转载地址</span>
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">缩略图</label>

                        <div class="col-sm-4 thumb-input-box">
                            <input type="file" name="file" id="file" class="form-control file" onchange="uploadImg()">
                        </div>
                        <div class="col-sm-8 thumb-box">
                            <div class="col-sm-8">
                                <div style="width: 220px;float: left">
                                    <img src="" width="200" />
                                </div>

                                <input type="hidden" value="" name="thumb" class="thumb" />
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

                            </script>
                        </div>
                    </div>


                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <div class="col-sm-8 col-sm-offset-2">
                            <input type="hidden" class="_token" name="_token" value="{{csrf_token()}}">
                            <input type="hidden" class="id" name="id" value="">
                            <button class="btn btn-white save" type="button" onclick="history.go(-1)">取消</button>
                           <button class="btn btn-info save" value="0" type="button">保存草稿</button>
                            <button class="btn btn-primary save" value="1" type="button">保存</button>
                            <button class="btn btn-success save" value="2" type="button">
                                更新 发布
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('after_js')
<script src="{{asset('static/js/ajaxfileupload.js')}}"></script>
<script type="text/javascript">
    $(function () {

    })

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
</script>
@endsection

