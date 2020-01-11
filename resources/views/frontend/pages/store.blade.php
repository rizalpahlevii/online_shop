@extends('frontend.layout.template')
@section('content')
@section('page','Store')	
<section class="section-content">
		<div class="container">	
            <header class="section-heading">
				<h3 class="section-title">Stores</h3>
			</header><!-- sect-heading -->
				
			<div class="row mb-3">
				@if (count($stores) > 1)
					@foreach($stores as $store)
                    <div class="col-md-3 col-6">
                        <article class="card card-body">
                            <figure class="text-center">
                                <span class="rounded-circle icon-md bg-primary"><i class="fa fa-store white"></i></span>
                                <figcaption class="pt-4">
                                <h5 class="title">{{$store->name}}</h5>
                                <p>{!!Str::limit($store->store_description,100)!!}</p>
                                </figcaption>
                            </figure> <!-- iconbox // -->
                            <a href="{{route('fe.store_detail',$store->slug)}}" class="btn btn-primary mt-1">See</a>
                        </article> <!-- panel-lg.// -->
                    </div><!-- col // -->
					@endforeach
				@else
				<div class="col-md-12">
					<h6 class="text-center">0 Store found</h6>
				</div>
				@endif
			</div>
		</div>
</section>
	






@endsection


