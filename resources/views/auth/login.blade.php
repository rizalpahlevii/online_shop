@extends('auth.template.layout')
@section('content')
	<div class="card mx-auto" style="max-width: 380px; margin-top:100px;">
	<div class="card-body">
	<h4 class="card-title mb-4">Sign in</h4>
	<form method="post" action="{{route('login')}}">
		@csrf
			{{-- <a href="#" class="btn btn-facebook btn-block mb-2"> <i class="fab fa-facebook-f"></i> &nbsp  Sign in with Facebook</a>
			<a href="#" class="btn btn-google btn-block mb-4"> <i class="fab fa-google"></i> &nbsp  Sign in with Google</a> --}}
		<div class="form-group">
			<input name="email" class="form-control" placeholder="Username / Email" type="text" id="email">
			@error('email')
				<small class="text-danger mb-2" role="alert">
					<strong>{{ $message }}</strong>
				</small>
			@enderror
			</div>
		<div class="form-group">
			<input id="password" name="password" class="form-control" placeholder="Password" type="password">
			@error('password')
				<span class="text-danger mb-2" role="alert">
				<strong>{{ $message }}</strong>
				</span>
			@enderror
			</div>
		
		<div class="form-group">
			@if (Route::has('password.request'))
				<a href="#" class="float-right">Forgot password?</a> 
				<label class="float-left custom-control custom-checkbox"> <input type="checkbox" class="custom-control-input" checked=""> <div class="custom-control-label"> Remember </div> </label>
			@endif
		</div>
		<div class="form-group">
			<button type="submit" class="btn btn-primary btn-block"> Login  </button>
		</div>  
	</form>
	</div>
	</div>

	<p class="text-center mt-4">Don't have account? <a href="#">Sign up</a></p>
	<br><br>
@endsection
<!-- ============================ COMPONENT LOGIN  END.// ================================= -->
