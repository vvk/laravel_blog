@extends('admin.public.master')

@section('after_css')
    <link href="{{asset('static/css/plugins/iCheck/custom.css')}}" rel="stylesheet"/>
<style type="text/css">
    .category-content select{width: 200px !important;}
    .category-content:not(:first-child){margin-top:3px;}
    .category-content span{display:inline-block}
    .category-content span button{margin-left: 5px !important;}
    .btn{border-radius:3px !important;}
    .error{color:red}
</style>
@endsection

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
                            <span class="help-block m-b-none error name-error"></span>
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
                        <div class="col-sm-8">
                            <textarea class="form-control description" placeholder="描述" rows="3" name="description">{{$data['description'] or ''}}</textarea>
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">分类</label>
                        <div class="col-sm-3">
                            @foreach($categoryTree['list'] as $key=>$val)
                                <div class="category-content input-group">
                                    <select class="form-control category_id" name="category_id">
                                        <option value="0">--请选择分类--</option>
                                        {!! $val !!}
                                    </select>
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-primary add-category" @if($data && ($key < count($categoryTree['list'])-1))style="display: none" @endif><i class="fa fa-plus-square"></i> 添加</button>
                                        <button type="button" class="btn btn-danger delete-category" @if($key < 1)style="display: none" @endif ><i class="fa fa-trash"></i> 删除</button>
                                    </span>
                                </div>
                            @endforeach
                        </div>

                    </div>

                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">是否推荐</label>
                        <div class="col-sm-3">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" @if($id!=0 && $data['recommend']==1) checked @endif class="checkbox recommend" name="recommend">
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
                                    <input type="checkbox" class="checkbox is_reprint" name="is_reprint" @if($id!=0 && $data['is_reprint']==1) checked @endif>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group reprint_url_box"  @if($id==0 || $data['is_reprint']==0)style="display: none"@endif>
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

                        <div class="col-sm-4 image-input-box" @if($data && $data['thumb'])style="display:none"@endif>
                            <input type="file" name="file" id="file" class="form-control file image-img-input" onchange="uploadImg()">
                        </div>
                        <div class="col-sm-8 image-box" @if(!$data || !$data['thumb'])style="display:none"@endif>
                            <div class="col-sm-8">
                                <div style="width: 220px;float: left">
                                    <img src="{{isset($data['thumb']) ? asset($data['thumb']) : ''}}" width="200" />
                                </div>

                                <input type="hidden" value="{{$data['thumb'] or ''}}" name="image" class="image" />
                                <div style="width: 100px;float: left">
                                    <button type="button" class="btn btn-sm btn-danger delete-image">删除图片</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">文章内容</label>
                        <div class="col-sm-8">
                            <script id="editor" type="text/plain" style="height:500px;">{!! $data['content'] or '' !!}</script>
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">标签</label>
                        <div class="col-sm-10 checkbox">
                            @foreach($tag as $item)
                                <label class="checkbox-inline i-checks" style="width:100px">
                                    <input type="checkbox" name="tag[]" @if(isset($ArticleTagId) && in_array($item->id, $ArticleTagId)) checked @endif class="tag" value="{{$item->id}}">{{$item->name}}
                                </label>
                            @endforeach

                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <div class="col-sm-8 col-sm-offset-2 article-save-btn-box">
                            <input type="hidden" class="_token" name="_token" value="{{csrf_token()}}">
                            <input type="hidden" class="id" name="id" value="{{$id}}">
                            <button class="btn btn-white save" type="button" onclick="history.go(-1)">取消</button>
                            <button class="btn btn-primary article-draft" value="1" type="button">保存</button>
                            <button class="btn btn-success article-release" value="2" type="button">
                                @if($data && $data['status'] == 2) 更新 @else 发布 @endif
                            </button>
                            @if($data && $id)
                                <a href="{{url('archives/'.$id)}}?type=view" target="_blank" class="btn btn-info">查看</a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('after_js')
<script src="{{asset('static/js/ajaxfileupload.js')}}"></script>
<script src="{{asset('static/js/plugins/ueditor/ueditor.config.js')}}"></script>
<script src="{{asset('static/js/plugins/ueditor/ueditor.all.js')}}"></script>
<script src="{{asset('static/js/plugins/ueditor/lang/zh-cn/zh-cn.js')}}"></script>
<script src="{{asset('static/js/plugins/iCheck/icheck.min.js')}}"></script>
<script type="text/javascript">
    var category = '{!! $categoryTree['default'] !!}';
    var base_url = "{{url('/')}}";
    var article_list_url = "{{url('admin/article')}}";
    var upload_image_url = "{{url('upload/thumb')}}";
    var save_article_url = "{{url('admin/article')}}"
</script>
<script src="{{asset('static/js/ajaxfileupload.js')}}"></script>
<script src="{{asset('static/js/admin/base.js')}}"></script>
<script src="{{asset('static/js/admin/article.js')}}"></script>

@endsection

