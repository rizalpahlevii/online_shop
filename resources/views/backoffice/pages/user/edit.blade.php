@extends('backoffice.layout.template')
@section('page','Edit User')
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
                <h4 id="basic-forms" class="card-title">User Edit</h4>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
                        <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="card-body collapse in" aria-expanded="true">
                <div class="card-block">
                    <form action="{{route('backoffice.user_update',$user->id)}}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name_user">Name</label>
                                        <input type="text" id="name_user" class="form-control" placeholder="Name" name="name_user" value="{{$user->name}}">
                                        @error('name_user')
                                            <p class="text-danger">{{$errors->first('name_user')}}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email" value="{{$user->email}}" readonly>
                                        @error('email')
                                            <p class="text-danger">{{$errors->first('email')}}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
        
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" id="username" class="form-control @error('username') is-invalid @enderror" placeholder="username" name="username" value="{{$user->username}}">
                                        @error('username')
                                            <p class="text-danger">{{$errors->first('username')}}</p>
                                        @enderror
                                    </div>
                                    
                                </div>
                                <div class="col-md-4">
        
                                    <div class="form-group">
                                        <label for="role">Role</label>
                                        <select name="role" id="role" class="form-control @error('role') is-invalid @enderror">
                                            <option disabled selected>Choose Role</option>
                                            @foreach ($role as $row)
                                            <option value="{{$row->id}}" <?= ($user->user_type_id == $row->id) ? "selected":""; ?>>{{$row->name}}</option>
                                            @endforeach
                                        </select>
                                        
                                        @error('role')
                                            <p class="text-danger">{{$errors->first('role')}}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="submit" name="submit" id="submit" class="btn btn-info">
                                    <a href="{{route('backoffice.user_index')}}" class="btn btn-warning">Back</a>
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
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error('error')
            });
    });
</script>
@endsection