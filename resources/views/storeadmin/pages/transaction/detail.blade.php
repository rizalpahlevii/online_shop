@extends('storeadmin.layout.template')
@section('page','Detail Order')
@section('content')
<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-xs-12 mb-1">
          <h2 class="content-header-title">@yield('page')</h2>
        </div>
        <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-xs-12">
            <div class="breadcrumb-wrapper col-xs-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="index.html">Home</a></li>
                </ol>
            </div>
        </div>
    </div>
    <div class="content-body">
            <section class="card">
                    <div id="invoice-template" class="card-block">
                      <!-- Invoice Company Details -->
                      <div id="invoice-company-details" class="row">
                        <div class="col-md-6 col-sm-12 text-xs-center text-md-left">
                          <img src="{{asset('backend')}}/images/logo/robust-80x80.png" alt="company logo" class=""/>
                          <ul class="px-0 list-unstyled">
                            <li class="text-bold-800">{{$store->name}}</li>
                            <li>{{$store->province_name}},</li>
                            <li>{{$store->districts_name}},</li>
                            <li>{{$store->address}} {{$store->postal_code}},</li>
                            <li>Indonesia</li>
                          </ul>
                        </div>
                        <div class="col-md-6 col-sm-12 text-xs-center text-md-right">
                          <h2>INVOICE</h2>
                          <p class="pb-3"># {{$transaction->transaction_number}}</p>
                          
                        </div>
                      </div>
                      <!--/ Invoice Company Details -->
        
                      <!-- Invoice Customer Details -->
                      <div id="invoice-customer-details" class="row pt-2">
                        <div class="col-sm-12 text-xs-center text-md-left">
                          <p class="text-muted">Bill To</p>
                        </div>
                        <div class="col-md-6 col-sm-12 text-xs-center text-md-left">
                          <ul class="px-0 list-unstyled">
                            <li class="text-bold-800">{{$transaction->member->name}}</li>
                            <li>{{$transaction->transactionAddress->province_name}},</li>
                            <li>{{$transaction->transactionAddress->city_name}},</li>
                            <li>{{$transaction->transactionAddress->detail}},</li>
                            <li>Indonesia.</li>
                          </ul>
                        </div>
                        <div class="col-md-6 col-sm-12 text-xs-center text-md-right">
                          <p><span class="text-muted">Invoice Date :</span> {{$transaction->date}}</p>
                          <p><span class="text-muted">Note :</span> {{($transaction->transactionAddress->note == null) ? '-':$transaction->transactionAddress->note}}</p>
                          <p><span class="text-muted">Due Date :</span> 10/05/2016</p>
                        </div>
                      </div>
                      <!--/ Invoice Customer Details -->
        
                      <!-- Invoice Items Details -->
                      <div id="invoice-items-details" class="pt-2">
                        <div class="row">
                          <div class="table-responsive col-sm-12">
                            <table class="table">
                              <thead>
                                <tr>
                                  <th>#</th>
                                  <th>Item</th>
                                  <th class="text-xs-right">Price</th>
                                  <th class="text-xs-right">Quantity</th>
                                  <th class="text-xs-right">Subtotal</th>
                                </tr>
                              </thead>
                              <tbody>
                                @php
                                    $total = 0;
                                @endphp
                                @foreach($transaction->transactionDetail as $rowDetail)
                                <tr>
                                  <td scope="row">{{$loop->iteration}}</td>
                                  <td>{{$rowDetail->product->name}}</td>
                                  <td class="text-xs-right">{{rupiah($rowDetail->price) }}</td>
                                  <td class="text-xs-right">{{$rowDetail->quantity }}</td>
                                  <td class="text-xs-right">{{rupiah($rowDetail->quantity * $rowDetail->price)}}</td>
                                </tr>
                                @php
                                    $total += $rowDetail->quantity * $rowDetail->price;
                                @endphp
                                @endforeach
                              </tbody>
                            </table>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-7 col-sm-12 text-xs-center text-md-left">
                            <p class="lead">Payment Methods:</p>
                            <div class="row">
                              <div class="col-md-8">
                              <table class="table table-borderless table-sm">
                                <tbody>
                                  <tr>
                                    <td>Bank name:</td>
                                    <td class="text-xs-right">{{$transaction->store->payment->bank_name}}</td>
                                  </tr>
                                  <tr>
                                    <td>Acc name:</td>
                                    <td class="text-xs-right">{{$transaction->store->payment->account_name}}</td>
                                  </tr>
                                  <tr>
                                    <td>IBAN:</td>
                                    <td class="text-xs-right">{{$transaction->store->payment->account_number}}</td>
                                  </tr>
                                  <tr>
                                    <td>SWIFT code:</td>
                                    <td class="text-xs-right">{{$transaction->store->payment->swift_code}}</td>
                                  </tr>
                                </tbody>
                              </table>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-5 col-sm-12">
                            <p class="lead">Total</p>
                            <div class="table-responsive">
                              <table class="table">
                                <tbody>
                                  <tr>
                                    <td>Payment Date</td>
                                    <td class="text-xs-right">{{rupiah($transaction->transactionCourier->value)}}</td>
                                  </tr>
                                  <tr>
                                    <td>Cost Value</td>
                                    <td class="text-xs-right">{{rupiah($transaction->transactionCourier->value)}}</td>
                                  </tr>
                                
                                  <tr class="bg-grey bg-lighten-4">
                                    <td class="text-bold-800">Total</td>
                                    <td class="text-bold-800 text-xs-right">{{rupiah($transaction->transactionCourier->value+$total)}}</td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                            <div class="text-xs-center">
                              <p>Authorized person</p>
                              <img src="{{asset('backend')}}/images/pages/signature-scan.png" alt="signature" class="height-100"/>
                              <h6>{{Auth::user()->name}}</h6>
                              <p class="text-muted">{{Auth::user()->isRole(Auth::user()->user_type_id)}}</p>
                            </div>
                          </div>
                        </div>
                      </div>
        
                      <!-- Invoice Footer -->
                      <div id="invoice-footer">
                        <div class="row">
                          <div class="col-md-7 col-sm-12">
                            <h6>Terms & Condition</h6>
                            <p>You know, being a test pilot isn't always the healthiest business in the world. We predict too much for the next year and yet far too little for the next 10.</p>
                          </div>
                          <div class="col-md-5 col-sm-12 text-xs-center">
                            <button type="button" class="btn btn-primary btn-lg my-1"><i class="icon-paperplane"></i> Send Invoice</button>
                          </div>
                        </div>
                      </div>
                      <!--/ Invoice Footer -->
        
                    </div>
                  </section>
    </div>
</div>




<script>
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });
</script>
@endsection