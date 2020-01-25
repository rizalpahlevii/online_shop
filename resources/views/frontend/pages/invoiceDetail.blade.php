@extends('frontend.layout.template')
@section('page','My Invoice')
@section('content')
<div class="container">
    <div class="row mt-3 mb-3">
        <div class="col-md-12">
            <div class="card">
                <h6 class="card-header">MY INVOICE / @if ($invoice->invoice->payment_status == "unpaid")
                    <span class="text-muted" id="countdownTimer">12387</span>
                @endif</h6>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <b>Billed to :</b>
                                    <br>
                                    {{$invoice->member->name}} /  {{'@'.$invoice->member->username}}
                                    <br>
                                    {{$invoice->member->email}}
                                    <br>
                                    {{$invoice->member->phone}}
                                    <br><br>

                                    <b>Store :</b>
                                    <br>
                                    {{$invoice->store->name}} , <br>
                                    {!!$invoice->store->address!!} <br>
                                    {{$invoice->store->districts_name}} , {{$invoice->store->province_name}}
                                    
                                    <br><br>
                                    <b>Address :</b>
                                    <br>
                                    {{$invoice->transactionAddress->city_name}} , <br>
                                    {{$invoice->transactionAddress->province_name}} <br>
                                    <b>Note :</b> {{$invoice->transactionAddress->detail}}
                                    
                                </div>
                                <div class="col-md-6" align="right">
                                    @if ($invoice->invoice->payment_date == NULL)
                                        -
                                    @else
                                        {{$invoice->invoice->payment_date->format('d M y H:i:s')}}
                                    @endif
                                    <br>
                                    Invoice #{{$invoice->transaction_number}}
                                    <br>
                                    {!!show_status_fe($invoice->invoice->payment_status)!!}
                                    <br><br><br>
                                    <b>Order Date :</b>
                                    <br>
                                    {{$invoice->created_at->format('d M y H:i:s')}}
                                    <br><br>
                                    <b>Courier :</b>
                                    <br>
                                    <b>Courier Name : </b>{{$invoice->transactionCourier->courier}}
                                    <br>
                                    <b>Service : </b>{{$invoice->transactionCourier->service}}
                                    <br>
                                    <b>Etd : </b>{{$invoice->transactionCourier->etd}}
                                    <br>
                                    <b>Price : </b>{{$invoice->transactionCourier->value}}
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="tracking-wrap">
                                {!!show_status_transaction($invoice->transaction_status)!!}
                                
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="error-alert mt-2">
                                <div class='alert alert-warning'>
                                    <!-- <a href='#'' class='close' data-dismiss='alert' aria-label='close' title='close'>×</a> -->
                                    <strong>Invoice ID number must be used as transfer reference</strong>
                                </div>
                            </div>
                            <table class="table table-bordered text-center">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Qty</th>
                                    <th>Subtotal</th>
                                </tr>
                                @php
                                    $total=0;
                                @endphp
                                @foreach ($invoice->transactionDetail as $key => $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->product->name}}</td>
                                    <td>{{rupiah($item->price)}}</td>
                                    <td>{{$item->quantity}}</td>
                                    <td>{{rupiah($item->total)}}</td>
                                </tr>
                                @php
                                    $total+=$item->total;
                                @endphp
                                @endforeach
                                <tr>
                                    <td colspan="4"><b>Ongkir</b></td>
                                    <td>{{rupiah($invoice->transactionCourier->value)}}</td>
                                </tr>
                                @php
                                    $total += $invoice->transactionCourier->value;
                                @endphp
                                <tr>
                                    <td colspan="4"><b>Total</b></td>
                                    <td>{{rupiah($total)}}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        countDownTimer('{{$invoice->invoice->created_at}}', 'countdownTimer');
        function countDownTimer(dt,id){
            var end = new Date('{{$invoice->invoice->expired}}');
            var _second = 1000;
            var _minute = _second*60;
            var _hour = _minute * 60;
            var _day = _hour*24;
            var timer;
            function showRemaining(){
                var now = new Date;
                var distance = end - now;
                if(distance  < 0){
                    clearInterval(timer);
                    document.getElementById(id).innerHTML = 'Invoice Expired';
                    return;
                }
                var days = Math.floor(distance / _day);
                var hours = Math.floor((distance % _day) / _hour);
				var minutes = Math.floor((distance % _hour) / _minute);
				var seconds = Math.floor((distance % _minute) / _second);
                document.getElementById(id).innerHTML = days + ' days ';
                document.getElementById(id).innerHTML += hours + ' hrs ';
                document.getElementById(id).innerHTML += minutes + ' mins ';
                document.getElementById(id).innerHTML += seconds + ' secs';
            }
            timer = setInterval(showRemaining,1000);
        }
    });
</script>
@endsection