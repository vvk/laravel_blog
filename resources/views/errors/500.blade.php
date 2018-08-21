@extends(config('web.theme').'.public.master')

@section('title')服务器错误 - {{config('web.web_title')}}@endsection

@section('content')
    <section class="container">
        <div class="f404">
            <img src="{{asset('static/image/500.png')}}">
        </div>
    </section>
@endsection
