@extends('admin.public.master')

@section('content')

    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-sm-12">
                <form method="" class="form-horizontal">
                    @foreach($data as $item)
                        @if($item->form_type==3)
                            <div class="form-group">
                                <label class="col-sm-2 control-label">{{$item->name}}</label>
                                <div class="col-sm-6">
                                   <textarea class="form-control" name="{{$item->title}}" rows="4">{!! $item['value'] or ''!!}</textarea>
                                </div>
                            </div>
                        @elseif($item->form_type==2)
                            <div class="form-group">
                                <label class="col-sm-2 control-label">{{$item->name}}</label>
                                <div class="col-sm-3">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="{{$item->title}}" @if($item->value==1) checked @endif class="checkbox">
                                        </label>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="form-group">
                                <label class="col-sm-2 control-label">{{$item->name}}</label>
                                <div class="col-sm-3">
                                    <input type="text" name="{{$item->title}}"  value="{{$item['value'] or ''}}" class="form-control">
                                </div>
                            </div>
                        @endif
                    @endforeach
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <input type="hidden" class="_token" name="_token" value="{{csrf_token()}}">
                            <input type="hidden" name="type" value="{{$type}}">
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
//            $('.save').text('保存中...').attr('disabled', true);
            var data = $('form').serializeArray();
            var url = "{{url('admin/option/store')}}";
            $('input:checkbox').each(function(){
                var name = $.trim($(this).attr('name'));
                if($(this).is(':checked')){
                    data.push({name:name,value:1})
                }else{
                    data.push({name:name,value:0})
                }
            });

            $.ajax({
                type:'POST',
                dataType:'JSON',
                url:url,
                data:data,
                success:function(response){
                    if(response.status==0){
                        $('.save').text('保 存').attr('disabled', false);
                        swal({title:"保存成功",'type':'success'});
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
