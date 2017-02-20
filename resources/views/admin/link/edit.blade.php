@extends('admin.public.master')

@section('after_css')
    <link href="{{asset('static/css/plugins/iCheck/custom.css')}}" rel="stylesheet"/>
@endsection

@section('content')

    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-sm-12 link-content">
                <form method="" class="form-horizontal">

                    <div class="hr-line-dashed"></div>
                    <div class="form-group ">
                        <label class="col-sm-2 control-label">名称：</label>
                        <div class="col-sm-3">
                            <input type="text" name="name" placeholder="名称" value="{{$data['name'] or ''}}" class="form-control name">
                            <span class="help-block m-b-none"></span>
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>
                    <div class="form-group ">
                        <label class="col-sm-2 control-label">链接：</label>
                        <div class="col-sm-6">
                            <input type="text" name="url" placeholder="以http或https开始" value="{{$data['url'] or ''}}" class="form-control url">
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
                            <span class="help-info">越大优先级越高，取值0-255</span>
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">图片：</label>

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
                        <label class="col-sm-2 control-label">描述：</label>
                        <div class="col-sm-6">
                            <textarea class="form-control description" placeholder="描述" rows="3" name="description">{{$data['description'] or ''}}</textarea>
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <div class="col-sm-8 col-sm-offset-2 article-save-btn-box">
                            <input type="hidden" class="_token" name="_token" value="{{csrf_token()}}">
                            <input type="hidden" class="id" name="id" value="{{$id}}">
                            <a class="btn btn-white save" href="{{url('admin/banner')}}">取消</a>
                            <button class="btn btn-primary save-link" value="1" type="button">保存</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('after_js')
    <script src="{{asset('static/js/ajaxfileupload.js')}}"></script>
    <script src="{{asset('static/js/plugins/iCheck/icheck.min.js')}}"></script>
    <script type="text/javascript">
        var upload_image_url = "{{url('upload/image')}}";
        var save_link_url = "{{url('admin/link')}}";
        var link_url = "{{url('admin/link')}}";
        $(function () {
            $(".i-checks").iCheck({checkboxClass:"icheckbox_square-green",radioClass:"iradio_square-green",});
        })
    </script>
    <script src="{{asset('static/js/admin/base.js')}}"></script>
    <script src="{{asset('static/js/admin/link.js')}}"></script>

@endsection

