@extends('voyager::master')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ voyager_asset('css/ga-embed.css') }}">
    <style>
        .user-email {
            font-size: .85rem;
            margin-bottom: 1.5em;
        }
    </style>
@stop

@section('content')
    <div style="background-size:cover; background: url({{ Voyager::image( Voyager::setting('admin_bg_image'), config('voyager.assets_path') . '/images/bg.jpg') }}) center center;position:absolute; top:0; left:0; width:100%; height:300px;"></div>
    <div style="height:160px; display:block; width:100%"></div>
    <div style="position:relative; z-index:9; text-align:center;">
        <img src="{{ Voyager::image( Auth::guard('admin')->user()->avatar ) }}" class="avatar"
             style="border-radius:50%; width:150px; height:150px; border:5px solid #fff;"
             alt="{{ Auth::guard('admin')->user()->name }} avatar">
        <h4>{{ ucwords(Auth::guard('admin')->user()->name) }}</h4>
        <div class="user-email text-muted">{{ ucwords(Auth::guard('admin')->user()->email) }}</div>
        {{--<p>{{ Auth::guard('admin')->user()->bio }}</p>--}}
        <a href="{{ route('voyager.administrators.edit', Auth::guard('admin')->user()->id) }}" class="btn btn-primary">修改我的信息</a>
    </div>
@stop
