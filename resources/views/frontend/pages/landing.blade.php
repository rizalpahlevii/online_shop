@extends('frontend.layout.template')
@section('content')
@section('page','Landing')	
<section class="section-content">
		<div class="container">	<header class="section-heading">
				<h3 class="section-title">Products</h3>
			</header><!-- sect-heading -->
	
				
			<div class="row">
				@if (count($products) > 1)
					@foreach($products as $rowProduct)
						<div class="col-md-3">
							<div href="#" class="card card-product-grid">
								<a href="{{route('fe.product_detail',$rowProduct->slug)}}" class="img-wrap"> 
									<img src="{{asset('images')}}/products/{{$rowProduct->image}}"> 
								</a>
								<figcaption class="info-wrap">
									<a href="#" class="title">{{$rowProduct->name}}</a>
									
									<div class="price mt-1">Rp. {{$rowProduct->selling_price}}</div> <!-- price-wrap.// -->
								</figcaption>
							</div>
						</div> <!-- col.// -->
					@endforeach
				@else
				<div class="col-md-12">
					<h6 class="text-center">0 Items found</h6>
				</div>
				@endif
			</div>
		</div>
</section>
	







<section class="section-specials padding-y border-bottom">
	<div class="container">	
		<div class="row">
			<div class="col-md-4">	
					<figure class="itemside">
						<div class="aside">
							<span class="icon-sm rounded-circle bg-primary">
								<i class="fa fa-money-bill-alt white"></i>
							</span>
						</div>
						<figcaption class="info">
							<h6 class="title">Reasonable prices</h6>
							<p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
							tempor incididunt ut labor </p>
						</figcaption>
					</figure> <!-- iconbox // -->
			</div><!-- col // -->
			<div class="col-md-4">
					<figure class="itemside">
						<div class="aside">
							<span class="icon-sm rounded-circle bg-danger">
								<i class="fa fa-comment-dots white"></i>
							</span>
						</div>
						<figcaption class="info">
							<h6 class="title">Customer support 24/7 </h6>
							<p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
							tempor incididunt ut labor </p>
						</figcaption>
					</figure> <!-- iconbox // -->
			</div><!-- col // -->
			<div class="col-md-4">
					<figure class="itemside">
						<div class="aside">
							<span class="icon-sm rounded-circle bg-success">
								<i class="fa fa-truck white"></i>
							</span>
						</div>
						<figcaption class="info">
							<h6 class="title">Quick delivery</h6>
							<p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
							tempor incididunt ut labor </p>
						</figcaption>
					</figure> <!-- iconbox // -->
			</div><!-- col // -->
		</div> 
	</div> <!-- container.// -->
</section>



<section class="section-name bg padding-y-sm">
	<div class="container">
		<header class="section-heading">
			<h3 class="section-title">Our Brands</h3>
		</header><!-- sect-heading -->

		<div class="row">
			<div class="col-md-2 col-6">
				<figure class="box item-logo">
					<a href="#"><img src="{{asset('frontend')}}/images/logos/logo1.png"></a>
					<figcaption class="border-top pt-2">36 Products</figcaption>
				</figure> <!-- item-logo.// -->
			</div> <!-- col.// -->
			<div class="col-md-2  col-6">
				<figure class="box item-logo">
					<a href="#"><img src="{{asset('frontend')}}/images/logos/logo2.png"></a>
					<figcaption class="border-top pt-2">980 Products</figcaption>
				</figure> <!-- item-logo.// -->
			</div> <!-- col.// -->
			<div class="col-md-2  col-6">
				<figure class="box item-logo">
					<a href="#"><img src="{{asset('frontend')}}/images/logos/logo3.png"></a>
					<figcaption class="border-top pt-2">25 Products</figcaption>
				</figure> <!-- item-logo.// -->
			</div> <!-- col.// -->
			<div class="col-md-2  col-6">
				<figure class="box item-logo">
					<a href="#"><img src="{{asset('frontend')}}/images/logos/logo4.png"></a>
					<figcaption class="border-top pt-2">72 Products</figcaption>
				</figure> <!-- item-logo.// -->
			</div> <!-- col.// -->
			<div class="col-md-2  col-6">
				<figure class="box item-logo">
					<a href="#"><img src="{{asset('frontend')}}/images/logos/logo5.png"></a>
					<figcaption class="border-top pt-2">41 Products</figcaption>
				</figure> <!-- item-logo.// -->
			</div> <!-- col.// -->
			<div class="col-md-2  col-6">
				<figure class="box item-logo">
					<a href="#"><img src="{{asset('frontend')}}/images/logos/logo2.png"></a>
					<figcaption class="border-top pt-2">12 Products</figcaption>
				</figure> <!-- item-logo.// -->
			</div> <!-- col.// -->
		</div> <!-- row.// -->
	</div><!-- container // -->
</section>
@endsection


