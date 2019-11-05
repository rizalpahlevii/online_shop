@extends('backoffice.layout.template')
@section('page','Add User')
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
                <h4 id="basic-forms" class="card-title">User Create</h4>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
                        <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="card-body collapse in" aria-expanded="true">
                <div class="card-block">
                    <form action="{{route('backoffice.user_store')}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name_user">Name</label>
                                        <input type="text" id="name_user" class="form-control" placeholder="Name" name="name_user" value="{{old('name_user')}}">
                                        @error('name_user')
                                            <p class="text-danger">{{$errors->first('name_user')}}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email" value="{{old('email')}}">
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
                                        <input type="text" id="username" class="form-control @error('username') is-invalid @enderror" placeholder="username" name="username" value="{{old('username')}}">
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
                                            @foreach ($role  as $row)
                                                <option value="{{$row->id}}">{{$row->name}}</option>
                                            @endforeach
                                        </select>
                                        
                                        @error('role')
                                            <p class="text-danger">{{$errors->first('role')}}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
        
                                    <div class="form-group">
                                        <label for="password1">Password</label>
                                        <input type="password" id="password1" class="form-control @error('password1') is-invalid @enderror" placeholder="Password" name="password1">
                                        @error('password1')
                                            <p class="text-danger">{{$errors->first('password1')}}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
        
                                    <div class="form-group">
                                        <label for="password1">Password Confirmation</label>
                                        <input type="password" id="password2" class="form-control @error('password2') is-invalid @enderror" placeholder="Password" name="password2">
                                        @error('password2')
                                            <p class="text-danger">{{$errors->first('password2')}}</p>
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