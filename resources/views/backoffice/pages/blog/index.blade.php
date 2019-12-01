@extends('backoffice.layout.template')
@section('page','Post')
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
                <h4 id="basic-forms" class="card-title">Post List</h4>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
                        <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="card-body collapse in" aria-expanded="true">
                <div class="card-block">
                    <div class="row">
                        <div class="col-md-6">
                            @if (Session::has('status'))
                                {!!Session::get('status')!!}
                            @endif
                        </div>
                    </div>
                    <a href="{{route('backoffice.blog_create')}}" class="btn btn-success mb-2">Add</a>
                    <table class="table" id="table-backend">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Publish Date</th>
                                <th>Title</th>
                                <th>Content</th>
                                <th>Created By</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($blogs as $key=>$row)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td><p class="tag tag-success">{{$row->publish_date}}</p></td>
                                    <td>{{$row->title}}</td>
                                    <td>{!!str_limit($row->content,'150','...')!!}</td>
                                    <td>{{$row->user->name}}</td>
                                    <td>
                                        <a href="{{route('backoffice.blog_edit',$row->id)}}" class="btn btn-warning"><i class="icon-edit2"></i></a>
                                        <a href="{{route('backoffice.blog_delete',$row->id)}}" class="btn btn-danger"><i class="icon-trash2"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Publish Date</th>
                                <th>Title</th>
                                <th>Content</th>
                                <th>Created By</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection