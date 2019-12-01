@extends('frontend.layout.template')
@section('page','Blog')
@section('content')
    <div class="container">
        <div class="row mt-3 mb-3">
            @foreach ($blogs as $row)
                <div class="col-md-8 offset-md-2">
                    <div class="card <?=($loop->iteration == $countBlog) ? 'mb-3':'';?>">
                        <div class="card-body">
                            <h5 class="card-title">{{$row->title}}</h5>
                            <span class="badge badge-info">{{$row->publish_date}}</span>
                            <hr>
                            <p class="card-text">{!!Str::limit($row->content, 400)!!}</p>
                            <hr>
                            <strong><a href="{{route('fe.blog_view',$row->slug)}}">Read More. . .</a></strong>
                        </div>
                    </div>
                </div>
            @endforeach
            {{$blogs->links()}}
        </div>
    </div>
@endsection