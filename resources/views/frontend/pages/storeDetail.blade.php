@extends('frontend.layout.template')
@section('page',$store->name)
@section('content')
<section class="section-content">
    <div class="container">	
        <header class="section-heading">
            <h3 class="section-title">{{$store->name}}</h3>
            <p>{!!$store->address!!}</p>
        </header><!-- sect-heading -->
        <div class="row">
            @if (count($products) > 0)
                @foreach($products as $rowProduct)
                    <div class="col-md-3">
                        <div href="#" class="card card-product-grid">
                            <a href="{{route('fe.product_detail',$rowProduct->slug)}}" class="img-wrap"> 
                                <img src="{{asset('images')}}/products/{{$rowProduct->image}}"> 
                            </a>
                            <figcaption class="info-wrap">
                                <a href="#" class="title">{{$rowProduct->name}}</a>
                                
                                <div class="price mt-1">{{rupiah($rowProduct->selling_price)}}</div> <!-- price-wrap.// -->
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

@endsection