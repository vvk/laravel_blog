@extends('admin.public.master')

@section('after_css')
    <link href="{{asset('static/css/plugins/iCheck/custom.css')}}" rel="stylesheet"/>
@endsection

@section('content')

    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-sm-12 banner-content">
                <form method="" class="form-horizontal">

                    <div class="hr-line-dashed"></div>
                    <div class="form-group ">
                        <label class="col-sm-2 control-label">轮播图名称：</label>
                        <div class="col-sm-3">
                            <input type="text" name="name" placeholder="轮播图名称" value="{{$data['name'] or ''}}" class="form-control name">
                            <span class="help-block m-b-none"></span>
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>
                    <div class="form-group ">
                        <label class="col-sm-2 control-label">跳转链接：</label>
                        <div class="col-sm-6">
                            <input type="text" name="url" placeholder="跳转链接，非必填" value="{{$data['url'] or ''}}" class="form-control url">
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">新标签打开：</label>
                        <div class="col-sm-4">
                            <div class="checkbox">
                                <label class="checkbox-inline i-checks" style="padding: 0 2px">
                                    <input type="checkbox" @if($id==0 || $data['target']==1) checked @endif class="checkbox target" name="target">
                                    <span class="m-b-none help-info">跳转链接存在时生效</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">是否显示：</label>
                        <div class="col-sm-3">
                            <div class="checkbox">
                                <label class="checkbox-inline i-checks" style="width:100px;padding: 0 2px">
                                    <input type="checkbox" @if($id==0 || $data['status']==1) checked @endif class="checkbox status" name="status">
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>
                    <div class="form-group ">
                        <label class="col-sm-2 control-label">排序：</label>
                        <div class="col-sm-6">
                            <input type="text" name="rank" placeholder="排序" onkeyup="value=value.replace(/[^\d]/g, '')" value="{{$data['rank'] or '50'}}" class="form-control rank" style="display: inline;width:100px">
                            <span class="help-info">越大优先级越高</span>
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">轮播图：</label>

                        <div class="col-sm-4 image-input-box" @if($data && $data['image'])style="display:none"@endif>
                            <input type="file" name="file" id="file" class="form-control file image-img-input" onchange="uploadImg()">
                        </div>
                        <div class="col-sm-8 image-box" @if(!$data || !$data['image'])style="display:none"@endif>
                            <div class="col-sm-8">
                                <div style="width: 220px;float: left">
                                    <img src="{{isset($data['image']) ? asset($data['image']) : ''}}" width="200" />
                                </div>

                                <input type="hidden" value="{{$data['image'] or ''}}" name="image" class="image" />
                                <div style="width: 100px;float: left">
                                    <button type="button" class="btn btn-sm btn-danger delete-image">删除图片</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">备注：</label>
                        <div class="col-sm-8">
                            <textarea class="form-control remark" placeholder="描述" rows="3" name="remark">{{$data['remark'] or ''}}</textarea>
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <div class="col-sm-8 col-sm-offset-2 article-save-btn-box">
                            <input type="hidden" class="_token" name="_token" value="{{csrf_token()}}">
                            <input type="hidden" class="id" name="id" value="{{$id}}">
                            <a class="btn btn-white save" href="{{url('admin/banner')}}">取消</a>
                            <button class="btn btn-primary save-banner" value="1" type="button">保存</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('after_js')
    <script type="text/javascript">
        var upload_image_url = "{{url('upload/banner')}}";
        var save_banner_url = "{{url('admin/banner')}}";
        var banner_url = "{{url('admin/banner')}}";
    </script>
    <script src="{{asset('static/js/ajaxfileupload.js')}}"></script>
    <script src="{{asset('static/js/plugins/iCheck/icheck.min.js')}}"></script>
    <script src="{{asset('static/js/admin/base.js')}}"></script>
    <script src="{{asset('static/js/admin/banner.js')}}"></script>

@endsection

