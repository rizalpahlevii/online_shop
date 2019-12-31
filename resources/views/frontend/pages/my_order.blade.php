@extends('frontend.layout.template')
@section('page','My Order')
@section('content')
    <section class="section-pagetop bg">
        <div class="container">
            <h2 class="title-page">Shopping cart</h2>
        </div> <!-- container //  -->
    </section>
    <section class="section-content padding-y">
        <div class="container">
            <div class="row">
                <main class="col-md-9">
                    <div class="card">
                        <table class="table table-borderless table-shopping-cart">
                            <thead class="text-muted">
                                <tr class="small text-uppercase">
                                    <th scope="col">Product</th>
                                    <th scope="col" width="120">Quantity</th>
                                    <th scope="col" width="120">Price</th>
                                    <th scope="col" width="120">Subtotal</th>
                                    <th scope="col" class="text-right" width="180"> </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $total=0;
                                @endphp
                                @foreach(\Cart::getContent() as $row)
                                @php
                                    $product = App\Product::find($row->id);
                                @endphp
                                <tr>
                                    <td>
                                        <figure class="itemside">
                                            <div class="aside"><img src="{{asset('images/products/')}}/{{$product->image}}" class="img-sm"></div>
                                            <figcaption class="info">
                                                <a href="#" class="title text-dark">{{$product->name}}</a>
                                                <p class="text-muted small">Size: XL, Color: blue, <br> Brand: Gucci</p>
                                            </figcaption>
                                        </figure>
                                    </td>
                                    <td>
                                        <input type="text" value="{{$row->quantity}}" class="form-control" readonly>
                                    </td>
                                    <td> 
                                        <div class="price-wrap"> 
                                            <var class="price">{{rupiah($product->selling_price)}}</var> 
                                        </div> <!-- price-wrap .// -->
                                    </td>
                                    <td>
                                        @php
                                            $subtotal = 0;
                                            $subtotal = $row->quantity*$product->selling_price;
                                        @endphp
                                        <div class="price-wrap"> 
                                            <var class="price">{{rupiah($subtotal)}}</var> 
                                        </div>
                                    </td>
                                    <td class="text-right"> 
                                    <a href="#" class="btn btn-danger" id="btn-delete-cart" data-kode="{{$row->id}}"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                                @php
                                    $total += $subtotal;
                                @endphp
                                @endforeach
                            </tbody>
                        </table>
    
                        <div class="card-body border-top">
                            <a href="#" class="btn btn-primary float-md-right" id="make-purchase"> Make Purchase <i class="fa fa-chevron-right"></i> </a>
                            <a href="{{route('fe.landing')}}" class="btn btn-light"> <i class="fa fa-chevron-left"></i> Continue shopping </a>
                        </div>	
                    </div> 
                </main> <!-- col.// -->
                <aside class="col-md-3">
                    <div class="card mb-3">
                        <div class="card-body">
                        <form>
                            <div class="form-group">
                                <label>Have coupon?</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="" placeholder="Coupon code">
                                    <span class="input-group-append"> 
                                        <button class="btn btn-primary">Apply</button>
                                    </span>
                                </div>
                            </div>
                        </form>
                        </div> <!-- card-body.// -->
                    </div>  <!-- card .// -->
                    <div class="card">
                        <div class="card-body">
                                <dl class="dlist-align">
                                <dt>Total price:</dt>
                                <dd class="text-right">{{rupiah($total)}}</dd>
                                </dl>
                                {{-- <dl class="dlist-align">
                                <dt>Discount:</dt>
                                <dd class="text-right">USD 658</dd>
                                </dl>
                                <dl class="dlist-align">
                                <dt>Total:</dt>
                                <dd class="text-right  h5"><strong>$1,650</strong></dd>
                                </dl> --}}
                                <hr>
                                <p class="text-center mb-3">
                                <img src="{{asset('frontend')}}/images/misc/payments.png" height="26">
                                </p>
                                
                        </div> <!-- card-body.// -->
                    </div>  <!-- card .// -->
                </aside> <!-- col.// -->
            </div>
        </div> <!-- container .//  -->
    </section>
   
    <section class="section-name bg padding-y">
        <div class="container">
            <h6>Payment and refund policy</h6>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        </div><!-- container // -->
    </section>
    <script>
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(document).on('click','#make-purchase',function(){
                $.ajax({
                    url : "{{route('cek_auth')}}",
                    method : "POST",
                    dataType : "json",
                    success:function(response){
                        if(response=="login"){
                            location.href="{{route('fe.checkout')}}"
                        }else{
                            location.href="{{route('login')}}"
                        }
                    }
                });
            });
            $(document).on('click','#btn-delete-cart',function(){
                $.ajax({
                    url : "{{route('delete_cart')}}",
                    method : "POST",
                    dataType : "json",
                    data : {id : $(this).data('kode')},
                    success:function(response){
                        console.log(response);
                        if(response.sts="true"){
                            if(response.quantity > 0){
                                location.reload();
                            }else{
                                location.href="{{route('fe.landing')}}";
                            }
                        }
                    }
                });
            });
        });
    </script>
@endsection