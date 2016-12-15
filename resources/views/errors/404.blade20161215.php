@extends(config('web.theme').'.public.master')

@section('title')页面未找到 - {{$web_title}}@endsection

@section('content')
    <section class="container">
        <div class="f404">
            <img src="{{asset('static/image/404.png')}}">
            <h1>404 . Not Found</h1>
            <h2>您找的内容不存在或已删除！</h2>
            <p>
                <a class="btn btn-primary" href="{{url('/')}}">返回首页</a>
            </p>
        </div>
    </section>
@endsection
