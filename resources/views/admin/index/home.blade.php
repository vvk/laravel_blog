@extends('admin.public.master')

@section('css')
    @parent
    <style type="text/css">
        table td{width: 100px !important;}
        table td:nth-child(odd){text-align: right;background: #efefef}
        table td:nth-child(even){font-weight: bold}
    </style>


@endsection
@section('content')
    <div class="panel-body">
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td style="width: 50px">分类数量：</td>
                    <td>{{$categoryCount}}</td>
                    <td>标签数量：</td>
                    <td>{{$tagCount}}</td>
                </tr>
                <tr>
                    <td>文章数量：</td>
                    <td>{{$arcitleCount}}</td>
                    <td>草稿文章：</td>
                    <td>{{$draftArticle}}</td>
                </tr>
                <tr>
                    <td>未发布文章：</td>
                    <td>{{$unpublishArtcile}}</td>
                    <td>已发布文章：</td>
                    <td>{{$publishArtcile}}</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
