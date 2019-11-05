@extends('storeadmin.layout.template')
@section('page','Profile')
@section('content')
<div class="content-wrapper">
    <div class="content-header row"></div>
    <div class="content-body">
        <section id="basic-form-layouts">
            <div class="row match-height">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title" id="basic-layout-colored-form-control">Change Password</h4>
                            <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
                                    <li><a data-action="reload"><i class="icon-reload"></i></a></li>
                                    <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                                    <li><a data-action="close"><i class="icon-cross2"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body collapse in">
                            <div class="card-block">
                                <div class="row">
                                    <div class="col-md-6">
                                        @if (Session::has('status'))
                                            {!!Session::get('status')!!}
                                        @endif
                                    </div>
                                </div>
                            <form class="form" method="POST" action="{{route('admin.profile_update_password',auth()->user()->id)}}">
                                @csrf
                                @method('PUT')
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label for="current_password">Current Password</label>
                                                    <input type="password" id="current_password" class="form-control" placeholder="Current Password" name="current_password">
                                                    @error('current_password')
                                                        <p class="text-danger">{{$errors->first('current_password')}}</p>
                                                    @enderror
                                                   
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label for="password1">New Password</label>
                                                    <input type="password" id="password1" class="form-control" placeholder="New Password" name="password1">
                                                    @error('password1')
                                                        <p class="text-danger">{{$errors->first('password1')}}</p>
                                                    @enderror
                                                   
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label for="password2">Password Confirmation</label>
                                                    <input type="password" id="password2" class="form-control" placeholder="Password Confirmation" name="password2">
                                                    @error('password2')
                                                        <p class="text-danger">{{$errors->first('password2')}}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
        
                                    <div class="form-actions right">
                                        <button type="button" class="btn btn-warning mr-1">
                                            <i class="icon-cross2"></i> Cancel
                                        </button>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="icon-check2"></i> Update
                                        </button>
                                    </div>
                                </form>
        
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
        
        </section>
    </div>
</div>
@endsection