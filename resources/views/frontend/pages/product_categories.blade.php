@extends('frontend.layout.template')
@section('page','Product Category')
@section('content')
    
<!-- ========================= SECTION PAGETOP ========================= -->
<section class="section-pagetop bg">
    <div class="container">
        <h2 class="title-page">Category products</h2>
        <nav>
        <ol class="breadcrumb text-white">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active"><a href="#">{{$products->name}}</a></li>
        </ol>  
        </nav>
    </div> <!-- container //  -->
</section>
    <!-- ========================= SECTION INTRO END// ========================= -->
    
    <!-- ========================= SECTION CONTENT ========================= -->
<section class="section-content padding-y">
    <div class="container">
    
    <div class="row">
        <aside class="col-md-3">
            
    <div class="card">
        <article class="filter-group">
            
            <div class="filter-content collapse show" id="collapse_3" style="">
                <div class="card-body">
                    <div class="form-row">
                    <div class="form-group col-md-6">
                      <label>Min</label>
                      <input class="form-control" placeholder="Min" type="number" id="inpt-min">
                    </div>
                    <div class="form-group text-right col-md-6">
                      <label>Max</label>
                      <input class="form-control" placeholder="Max" type="number" id="inp-max">
                    </div>
                    </div> <!-- form-row.// -->
                    <button class="btn btn-block btn-primary" id="btn-apply">Apply</button>
                </div><!-- card-body.// -->
            </div>
        </article> <!-- filter-group .// -->
       
        <article class="filter-group">
            <header class="card-header">
                <a href="#" data-toggle="collapse" data-target="#collapse_5" aria-expanded="false" class="">
                    <i class="icon-control fa fa-chevron-down"></i>
                    <h6 class="title">More filter </h6>
                </a>
            </header>
            <div class="filter-content collapse in" id="collapse_5" style="">
                <div class="card-body">
                    <label class="custom-control custom-radio">
                      <input type="radio" name="myfilter_radio" checked="" class="custom-control-input">
                      <div class="custom-control-label">Any condition</div>
                    </label>
    
                    <label class="custom-control custom-radio">
                      <input type="radio" name="myfilter_radio" class="custom-control-input">
                      <div class="custom-control-label">Brand new </div>
                    </label>
    
                    <label class="custom-control custom-radio">
                      <input type="radio" name="myfilter_radio" class="custom-control-input">
                      <div class="custom-control-label">Used items</div>
                    </label>
    
                    <label class="custom-control custom-radio">
                      <input type="radio" name="myfilter_radio" class="custom-control-input">
                      <div class="custom-control-label">Very old</div>
                    </label>
                </div><!-- card-body.// -->
            </div>
        </article> <!-- filter-group .// -->
    </div> <!-- card.// -->
    
        </aside> <!-- col.// -->
        <main class="col-md-9">
    
    <header class="border-bottom mb-4 pb-3">
            <div class="form-inline">
                <span class="mr-md-auto">{{$countProduct}} Items found </span>
               
            </div>
    </header><!-- sect-heading -->
    
    <div class="row">
        @foreach($products->product as $rowProduct)
        <div class="col-md-4">
            <figure class="card card-product-grid">
                <div class="img-wrap"> 
                    <span class="badge badge-danger"> NEW </span>
                    <img src="{{asset('images/products')}}/{{$rowProduct->image}}">
                    <a class="btn-overlay" href="{{route('fe.product_detail',$rowProduct->slug)}}"><i class="fa fa-search-plus"></i> Quick view</a>
                </div> <!-- img-wrap.// -->
                <figcaption class="info-wrap">
                    <div class="fix-height">
                        <a href="{{route('fe.product_detail',$rowProduct->slug)}}" class="title">{{$rowProduct->name}}</a>
                        <div class="price-wrap mt-2">
                            <span class="price">Rp. {{number_format($rowProduct->selling_price)}}</span>
                            {{-- <del class="price-old">$1980</del> --}}
                        </div> <!-- price-wrap.// -->
                    </div>
                    <a href="#" class="btn btn-primary" id="btn-add-cart" data-kode="{{$rowProduct->id}}"><i class="fa fa-shopping-cart"  ></i> Add to cart </a>
                    <a href="{{route('fe.product_detail',$rowProduct->slug)}}" class="btn btn-warning"><i class="fa fa-list"></i> Detail</a>
                </figcaption>
            </figure>
        </div> <!-- col.// -->
        @endforeach
    </div> <!-- row end.// -->
    
    
    
    
    </div>
    <input type="hidden" value="{{Request::segment(2)}}" id="slug-hidden">
</section>
<script>
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).on('click','#btn-add-cart',function(){
            $.ajax({
                url : "{{route('add_to_cart')}}",
                method : "POST",
                dataType : "json",
                data : {
                    product_id : $(this).data('kode'),
                    qty : 1,
                },
                beforeSend:function(){
                    Swal.fire({
                        title: 'Loading .....',
                        allowEscapeKey: false,
                        allowOutsideClick: false,
                        timer: 2000,
                        onOpen: () => {
                            Swal.showLoading()
                        }
                    })
                },
                success:function(response){
                    if(response == "success"){
                        Swal.fire( 'Success!','Sukses menambahkan ke keranjang', 'success').then(function(){
                            location.reload();
                        });
                    }else{
                        Swal.fire('Error!', 'Product Berbeda Toko','error');
                    }
                },
                error:function(request,status,error){
                    Swal.fire( 'Error!',request.responseText, 'error');
                }
            });
        });
    });
</script>
@endsection