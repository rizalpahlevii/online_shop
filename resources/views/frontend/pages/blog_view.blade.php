@extends('frontend.layout.template')
@section('page','Blog' . $blog->title)
@section('content')
    <div class="container">
        <div class="row mt-3 mb-3">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{$blog->title}}</h5>
                        <span class="badge badge-info">Publish At : {{$blog->publish_date}}</span>
                        <span class="badge badge-success">Created by : {{$blog->user->name}}</span>
                        <hr>
                        <p class="card-text">{!!$blog->content!!}</p>
                         <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection