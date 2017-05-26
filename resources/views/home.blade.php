@extends('layouts.app')
@section('header')
    <link rel="stylesheet" href="/css/uploadImage.css">
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!
                    <upload-image filename="cover" url="{{ url('/api/upload') }}" ratio="0.6"></upload-image>

                    <upload-many-images filename="cover" url="{{ url('/api/upload') }}" ratio="1"></upload-many-images>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer')

@endsection
