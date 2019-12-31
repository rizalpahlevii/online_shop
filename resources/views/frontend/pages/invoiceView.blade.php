@extends('frontend.layout.template')
@section('page','My Invoice')
@section('content')
<section class="section-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10 offset-1">

                <output class="mt-3 mb-3">
                  <article class="card">
                      <header class="card-header"> My Orders / Tracking </header>
                          <div class="card-body">
                              <h6>Invoice ID  : {{$invoice->transaction_number}}</h6>
                              <article class="card">
                                  <div class="card-body row no-gutters">
                                      <div class="col">
                                          <strong>Delivery Estimate time:</strong> <br> {{$invoice->transactionCourier->etd}}
                                      </div>
                                      <div class="col">
                                          <strong>Shipping company:</strong> <br> {{$owner->name}} | <i class="fa fa-phone"></i> {{$owner->phone}}
                                      </div>
                                      <div class="col">
                                          <strong>Status:</strong> <br> {{  ucfirst($invoice->transaction_status)}}
                                      </div>
                                      <div class="col">
                                          <strong>Tracking #:</strong> <br> {{$invoice->transactionCourier->receipt_number}}
                                      </div>
                                  </div>
                              </article>
                              
                              <div class="tracking-wrap">
                                  {!!show_status_transaction($invoice->transaction_status)!!}
                                  
                              </div>
                          
                          
                              <hr>
                              <ul class="row">
                                 <div class="col-md-12">
                                     <table class="table">
                                         <tr>
                                             <th>#</th>
                                            <th>Product</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Subtotal</th>
                                         </tr>
                                         @php
                                             $total = 0;
                                         @endphp
                                         @foreach ($invoice->transactionDetail as $itemProduct)
                                            
                                             <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$itemProduct->product->name}}</td>
                                                <td>{{rupiah($itemProduct->product->selling_price)}}</td>
                                                <td>{{ $itemProduct->quantity}}</td>
                                                <td>{{ rupiah($itemProduct->total)}}</td>
                                             </tr>
                                             @php
                                                 $total += $itemProduct->total;
                                             @endphp
                                         @endforeach
                                         <tr>
                                            <td colspan="4" align="center"><b>Ongkir</b></td>
                                            <td><b>{{rupiah($invoice->transactionCourier->value)}}</b></td>
                                        </tr>
                                        @php
                                            $total+=$invoice->transactionCourier->value;
                                        @endphp
                                         <tr>
                                             <td colspan="4" align="center"><b>Total</b></td>
                                             <td><b>{{rupiah($total)}}</b></td>
                                         </tr>
                                     </table>
                                 </div>
                                  <li class="col-md-4">
                                      <figure class="itemside  mb-3">
                                          <div class="aside"><img src="bootstrap-ecommerce-html/images/items/1.jpg" class="img-sm border"></div>
                                          <figcaption class="info align-self-center">
                                              <p class="title">Just name of title or <br> some name goes here</p>
                                              <span class="text-muted">$145 </span>
                                          </figcaption>
                                      </figure> 
                                  </li>
                                  <li class="col-md-4">
                                      <figure class="itemside  mb-3">
                                          <div class="aside"><img src="bootstrap-ecommerce-html/images/items/2.jpg" class="img-sm border"></div>
                                          <figcaption class="info align-self-center">
                                              <p class="title">Great demo product title <br> or name goes here</p>
                                              <span class="text-muted">$250 </span>
                                          </figcaption>
                                      </figure> 
                                  </li>
                                  <li class="col-md-4"> 
                                      <figure class="itemside mb-3">
                                          <div class="aside"><img src="bootstrap-ecommerce-html/images/items/3.jpg" class="img-sm border"></div>
                                          <figcaption class="info align-self-center">
                                              <p class="title">Another demo product title <br> or name goes here</p>
                                              <span class="text-muted">$145 </span>
                                          </figcaption>
                                      </figure> 
                                  </li>
                              </ul>
                              
                              
                              <p><strong>Note: </strong>{{$invoice->note}}</p>
                              
                              <a href="#" class="btn btn-light"> <i class="fa fa-chevron-left"></i> Back to orders</a>
                              @if ($invoice->invoice->payment_status == "unpaid" OR $invoice->invoices->payment_status == "rejected")  
                                <a href="{{route('fe.upload_payment',$invoice->id)}}" class="btn btn-success float-right"> <i class="fa fa-upload"></i> Upload Payment Proof</a>
                              @endif
                      </div> <!-- card-body.// -->
                  </article>
                </output>
            </div>
        </div>	
    </div>
</section>






@endsection