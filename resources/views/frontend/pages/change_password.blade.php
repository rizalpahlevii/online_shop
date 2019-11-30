@extends('frontend.layout.template')
@section('page','Change Password')
@section('content')
    <div class="container">
        <div class="row mt-3 mb-3">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <h6 class="card-header">Change Password</h6>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                @if(Session::get('message'))
                                    {!!Session::get('message')!!}
                                @endif
                            </div>
                        </div>
                        <form action="{{route('fe.updatePassword')}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="current_password">Password Saat ini</label>
                                    <input type="password" name="current_password" id="current_password" class="form-control @error('current_password') 'is-invalid' @enderror">
                                    @error('current_password')
                                        <span class="text-danger">{{$errors->first('current_password')}}</span>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <label for="new_password">Password baru</label>
                                    <input type="password" name="new_password" id="new_password" class="form-control @error('new_password') 'is-invalid' @enderror">
                                    @error('new_password')
                                        <span class="text-danger">{{$errors->first('new_password')}}</span>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <label for="password_confirmation">Password konfirmasi</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control @error('password_confirmation') 'is-invalid' @enderror">
                                    @error('password_confirmation')
                                        <span class="text-danger">{{$errors->first('password_confirmation')}}</span>
                                    @enderror
                                </div>
                                <div class="col-md-12 mt-2">
                                    <input type="submit" name="submit" class="btn btn-primary float-right" value="Update">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection