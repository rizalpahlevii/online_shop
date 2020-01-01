@extends('auth.template.layout')

@section('content')
<div class="card mx-auto" style="max-width:520px; margin-top:40px;">
    <article class="card-body">
      <header class="mb-4"><h4 class="card-title">Sign up</h4></header>
    <form method="POST" action="{{route('register')}}">
           @csrf  
              <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Name" name="name" id="name" value="{{ old('name') }}" required>
                  @error('name')
                    <small class="text-danger">{{$message}}</small>
                  @enderror
              </div> <!-- form-group end.// -->
             
              <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email" id="email" value="{{ old('email') }}" required>
                  @error('email')
                    <small class="text-danger">{{$message}}</small>
                  @enderror
              </div> <!-- form-group end.// -->
              <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control @error('username') is-invalid @enderror" placeholder="Username" name="username" id="username" value="{{ old('username') }}" required>
                @error('username')
                  <small class="text-danger">{{$message}}</small>
                @enderror
            </div> <!-- form-group end.// -->
              <div class="form-group">
                  <label class="custom-control custom-radio custom-control-inline">
                    <input class="custom-control-input" checked="" type="radio" name="gender" value="male">
                    <span class="custom-control-label"> Male </span>
                  </label>
                  <label class="custom-control custom-radio custom-control-inline">
                    <input class="custom-control-input" type="radio" name="gender" value="female">
                    <span class="custom-control-label"> Female </span>
                  </label>
              </div> <!-- form-group end.// -->
             
              <div class="form-row">
                  <div class="form-group col-md-6">
                      <label for="password">Create password</label>
                      <input class="form-control" type="password" name="password" id="password">
                      @error('password')
                        <small class="text-danger">{{$message}}</small>
                      @enderror
                  </div> <!-- form-group end.// --> 
                  <div class="form-group col-md-6">
                      <label for="password_confirmation">Repeat password</label>
                      <input class="form-control" type="password" name="password_confirmation" id="password_confirmation">
                  </div> <!-- form-group end.// -->  
              </div>
              <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" class="form-control @error('phone') is-invalid @enderror" placeholder="Phone" name="phone" id="phone" value="{{old('phone')}}">
                @error('phone')
                  <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
              <div class="form-group">
                  <button type="submit" class="btn btn-primary btn-block"> Register  </button>
              </div> <!-- form-group// -->      
              <div class="form-group"> 
                  <label class="custom-control custom-checkbox"> <input type="checkbox" class="custom-control-input" checked=""> <div class="custom-control-label"> I am agree with <a href="#">terms and contitions</a>  </div> </label>
              </div> <!-- form-group end.// -->           
          </form>
      </article><!-- card-body.// -->
  </div> <!-- card .// -->
  <p class="text-center mt-4">Have an account? <a href="">Log In</a></p>
  <br><br>
@endsection
