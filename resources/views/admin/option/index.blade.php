@extends('admin.public.master')

@section('breadcrumb_button')
    <a href="{{url('admin/option/create')}}" class="btn btn-sm btn-success fa fa-edit"> 添加配置项</a>
@endsection

@section('after_css')
    <link href="{{asset('static/css/plugins/iCheck/custom.css')}}" rel="stylesheet">
    <link href="{{asset('static/css/plugins/switchery/switchery.css')}}" rel="stylesheet">
@endsection

@section('content')

<div class="panel-body">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-content" style="border-top: none">
                        <form method="get" class="form-horizontal option-form">
                            @foreach($option as $item)
                                <div class="form-group" data-form_type="{{$item->form_type}}" data-item-id="{{$item->id}}">
                                    <label class="col-md-2 control-label">{{$item->name}}</label>
                                    @if ($item->form_type == \App\Models\Option::FORM_TYPE_INPUT)
                                        <div class="col-md-2">
                                            <input type="text" class="form-control {{$item->form_class}} {{$item->title}}" placeholder="{{$item->placeholder}}" name="{{$item->title}}" value="{{$item->value}}">
                                        </div>
                                    @elseif ($item->form_type == \App\Models\Option::FORM_TYPE_CHECKBOX)
                                        <div class="col-sm-8">
                                            @foreach($item->form_option as $key => $val)
                                                <label class="checkbox-inline i-checks">
                                                    <input type="checkbox" @if(in_array($key, $item->value)) checked @endif name="{{$item->title}}" value="{{$key}}">{{$val}}
                                                </label>
                                            @endforeach
                                        </div>
                                    @elseif ($item->form_type == \App\Models\Option::FORM_TYPE_TEXTAREA)
                                        <div class="col-md-3">
                                            <textarea class="form-control {{$item->form_class}}" name="{{$item->title}}" placeholder="{{$item->placeholder}}" rows="5">{{$item->value}}</textarea>
                                        </div>
                                    @elseif ($item->form_type == \App\Models\Option::FORM_TYPE_SELECT)
                                        <div class="col-sm-2">
                                            <select class="form-control {{$item->form_class}}" name="{{$item->title}}">
                                                @foreach($item->form_option as $key => $val)
                                                    <option @if($item->value == $key) selected @endif value="{{$key}}">{{$val}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @elseif ($item->form_type == \App\Models\Option::FORM_TYPE_SWITCH)
                                        <div class="col-md-2 switch">
                                            <div class="onoffswitch">
                                                <input type="checkbox" name="{{$item->title}}" @if($item->value == 1)checked @endif class="onoffswitch-checkbox" id="{{md5($item->title)}}">
                                                <label class="onoffswitch-label" for="{{md5($item->title)}}">
                                                    <span class="onoffswitch-inner"></span>
                                                    <span class="onoffswitch-switch"></span>
                                                </label>
                                            </div>
                                        </div>
                                    @elseif ($item->form_type == \App\Models\Option::FORM_TYPE_RADIO)
                                        <div class="col-sm-8">
                                            @foreach($item->form_option as $key => $val)
                                                <div class="radio-inline i-checks">
                                                    <label>
                                                        <input type="radio" class="{{$item->form_class}}" @if($item->value == $key)checked @endif value="{{$key}}" name="{{$item->title}}"> <i></i> {{$val}}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                    <!--<div class="col-md-1">
                                        <a href="{{url('admin/option/'.$item['id'].'/edit')}}" class="btn btn-primary">修改</a>
                                    </div>-->
                                </div>

                                @if(!$loop->last)
                                    <div class="hr-line-dashed"></div>
                                @endif
                            @endforeach

                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    @csrf
                                    <button class="btn btn-primary save-option-btn" type="button">保存</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('after_js')
    <script type="text/javascript">
        var saveUrl = "{{url('/admin/option/save-option')}}";
    </script>
    <script type="text/javascript" src="{{asset('static/js/plugins/iCheck/icheck.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('static/js/plugins/switchery/switchery.js')}}"></script>
    <script type="text/javascript" src="{{asset('static/js/admin/option.js')}}"></script>
@endsection