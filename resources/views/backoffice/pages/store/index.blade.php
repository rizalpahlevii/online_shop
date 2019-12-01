@extends('backoffice.layout.template')
@section('page','Store')
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
                <h4 id="basic-forms" class="card-title">Store List</h4>
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
                    <a href="{{route('backoffice.store_create')}}" class="btn btn-success mb-2">Add</a>
                    <table class="table" id="table-backend">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>User</th>
                                <th>Description</th>
                                <th>Province</th>
                                <th>City</th>
                                <th>Address</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($stores as $key=>$row)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td><p class="tag tag-success">{{$row->name}}</p></td>
                                    <td>{{$row->user->name}}</td>
                                    <td>{!!str_limit($row->store_description,'150','...')!!}</td>
                                    <td>{{$row->province_name}}</td>
                                    <td>{{$row->districts_name}}</td>
                                    <td>{{$row->address}}</td>
                                    <td>
                                        <a href="{{route('backoffice.store_edit',$row->id)}}" class="btn btn-warning"><i class="icon-edit2"></i></a>
                                        <a href="{{route('backoffice.store_delete',$row->id)}}" class="btn btn-danger"><i class="icon-trash2"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>User</th>
                                <th>Description</th>
                                <th>Province</th>
                                <th>City</th>
                                <th>Address</th>
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