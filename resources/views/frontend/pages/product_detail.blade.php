@extends('frontend.layout.template')
@section('page',$product->name)
@section('content')

    <section class="section-content">
        <div class="container mt-3 mb-3">
            <output>
	            <div class="card">
                    <div class="row no-gutters">
                        <aside class="col-md-6">
                            <article class="gallery-wrap">
                                <div class="img-big-wrap">
                                    <div>
                                        <a href="#"><img src="{{asset('images/products')}}/{{$product->image}}"></a>
                                    </div>
                                </div> <!-- slider-product.// -->
                                
                            </article>
                        </aside>
                        <main class="col-md-6 border-left">
                            <article class="content-body">
                                <h2 class="title">{{$product->name}} / <span class="text-muted">{{$product->category->name}}</span></h2>
                                {{-- <div class="rating-wrap my-3">
                                    <ul class="rating-stars">
                                        <li style="width:80%" class="stars-active">
                                            <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </li>
                                        <li>
                                            <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </li>
                                    </ul>
                                    <small class="label-rating text-muted">132 reviews</small>
                                    <small class="label-rating text-success"> <i class="fa fa-clipboard-check"></i> 154 orders </small>
                                </div> --}}
                                <div class="mb-3">
                                    <var class="price h4">{{rupiah($product->selling_price)}}</var>
                                </div>
                                <p>{!!$product->description!!}</p>
                                <dl class="row">
                                    <dt class="col-sm-3">Store Name</dt>
                                    <dd class="col-sm-9">{{$store->name}}</dd>

                                    
                                    <dt class="col-sm-3">Delivery</dt>
                                    <dd class="col-sm-9">{{$store->province_name}}, {{$store->districts_name}}</dd> 
                                    <dt class="col-sm-3">Postal Code</dt>
                                    <dd class="col-sm-9">{{$store->postal_code}}</dd>
                                    <dt class="col-sm-3">Stock</dt>
                                    <dd class="col-sm-9">{{$product->stock}}</dd>
                                </dl>

                                <hr>
                                <div class="form-row">
                                    <div class="form-group col-md flex-grow-0">
                                        <label>Quantity</label>
                                        <div class="input-group mb-3 input-spinner">
                                            <div class="input-group-append">
                                                <button class="btn btn-light" type="button" id="button-minus"> − </button>
                                            </div>
                                            <input type="text" class="form-control" value="1" name="value_quantity" id="value_quantity">

                                            <div class="input-group-prepend">
                                                <button class="btn btn-light" type="button" id="button-plus"> + </button>
                                            </div>
                                        </div>
                                    </div> <!-- col.// -->
                                </div> <!-- row.// -->

                                <a href="#" class="btn  btn-primary"> Buy now </a>
                                <a href="#" class="btn  btn-outline-primary" id="btn-add-cart"> <span class="text">Add to cart</span> <i class="fas fa-shopping-cart"></i>  </a>
                            </article> <!-- product-info-aside .// -->
                        </main> <!-- col.// -->
                    </div> <!-- row.// -->
                </div> <!-- card.// -->
            </output>
        </div>
    </section>
    <input type="hidden" id="product_id" value="{{$product->id}}">
    <input type="hidden" id="max_stock" value="{{$product->stock}}">
    <script>
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#button-plus').click(function(){
                let max_stock = $('#max_stock').val();
                let value = $('#value_quantity').val();
                if(value == max_stock){
                    alert('Maximum quantity');
                }else{
                    let result = parseInt(value)+1;
                    $('#value_quantity').val(result);
                }
            });
            $('#button-minus').click(function(){
                let value = $('#value_quantity').val();
                if(value != 1){
                    let result = parseInt(value)-1;
                    $('#value_quantity').val(result);
                }
            });
            $(document).on('click','#btn-add-cart',function(){
                $.ajax({
                    url : "{{route('add_to_cart')}}",
                    method : "POST",
                    dataType : "json",
                    data : {
                        product_id : $('#product_id').val(),
                        qty : $('#value_quantity').val(),
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
                        }else if(response == "error"){
                            Swal.fire('Error!', 'Product Berbeda Toko','error');
                        }else{
                            Swal.fire('Error!', 'Stock Kurang','error');
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