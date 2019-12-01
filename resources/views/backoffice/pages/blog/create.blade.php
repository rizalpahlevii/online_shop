@extends('backoffice.layout.template')
@section('page','Create Post')
@section('content')
<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-xs-12 mb-1">
          <h2 class="content-header-title">@yield('page')</h2>
        </div>
        <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-xs-12">
            <div class="breadcrumb-wrapper col-xs-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="index.html">Home</a></li>
                </ol>
            </div>
        </div>
    </div>
    <div class="content-body">
        <div class="card">
            <div class="card-header">
                <h4 id="basic-forms" class="card-title">Post Create</h4>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
                        <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="card-body collapse in" aria-expanded="true">
                <div class="card-block">
                    <form action="{{route('backoffice.blog_store')}}" method="post">
                            @csrf
                            <input type="hidden" name="province_name" id="province_name">
                            <input type="hidden" name="city_name" id="city_name">
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <label for="title">title</label>
                                        <input type="text" id="title" class="form-control" placeholder="title" name="title" value="{{old('title')}}">
                                        @error('title')
                                            <p class="text-danger">{{$errors->first('title')}}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <label for="name">Content</label>
                                        <textarea class="form-control" name="content" id="content" cols="30" rows="10">{{old('content')}}</textarea>
                                        @error('content')
                                            <p class="text-danger">{{$errors->first('content')}}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    <input type="submit" name="submit" class="btn btn-primary" value="Save">
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        ClassicEditor
            .create(document.querySelector('#content'))
            .catch(error => {
                console.error('error')
            });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });
</script>
@endsection