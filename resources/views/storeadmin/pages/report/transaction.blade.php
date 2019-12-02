@extends('storeadmin.layout.template')
@section('page','Report Transaction')
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
        <div class="card">
            <div class="card-header">
                <h4 id="basic-forms" class="card-title">Report Transaction</h4>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
                        <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="card-body collapse in" aria-expanded="true">
                <div class="card-block">
                    <div class="row">
                        <div class="col-md-6">
                            @if (Session::has('status'))
                                {!!Session::get('status')!!}
                            @endif
                        </div>
                    </div>
                    <form method="get">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="payment_status">Payment Status</label>
                                            <select name="payment_status" id="payment_status" class="form-control">
                                                <option value="all" @if(isset($_GET['payment_status']))
                                                    @if ($_GET['payment_status'] == "all")
                                                        {{'selected'}}
                                                    @endif
                                                @endif>All</option>

                                                <option value="paid" @if(isset($_GET['payment_status']))
                                                @if ($_GET['payment_status'] == "paid")
                                                    {{'selected'}}
                                                @endif
                                            @endif>Paid</option>

                                                <option value="unpaid" @if(isset($_GET['payment_status']))
                                                @if ($_GET['payment_status'] == "unpaid")
                                                    {{'selected'}}
                                                @endif
                                            @endif>Unpaid</option>

                                                <option value="rejected" @if(isset($_GET['payment_status']))
                                                @if ($_GET['payment_status'] == "rejected")
                                                    {{'selected'}}
                                                @endif
                                            @endif>Rejected</option>
                                            
                                                <option value="waiting_confirmation" @if(isset($_GET['payment_status']))
                                                @if ($_GET['payment_status'] == "waiting_confirmation")
                                                    {{'selected'}}
                                                @endif
                                            @endif>Waiting Confirmation</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="transaction_status">Order Status</label>
                                            <select name="transaction_status" id="transaction_status" class="form-control">
                                                <option value="all" @if(isset($_GET['transaction_status']))
                                                @if ($_GET['transaction_status'] == "all")
                                                    {{'selected'}}
                                                @endif
                                            @endif>All</option>

                                                <option value="proccess" @if(isset($_GET['transaction_status']))
                                                @if ($_GET['transaction_status'] == "proccess")
                                                    {{'selected'}}
                                                @endif
                                            @endif>Proccess</option>

                                                <option value="shipped" @if(isset($_GET['transaction_status']))
                                                @if ($_GET['transaction_status'] == "shipped")
                                                    {{'selected'}}
                                                @endif
                                            @endif>Shipped</option>

                                                <option value="in_shipping" @if(isset($_GET['transaction_status']))
                                                @if ($_GET['transaction_status'] == "in_shipping")
                                                    {{'selected'}}
                                                @endif
                                            @endif>In Shipping</option>

                                                <option value="arrived" @if(isset($_GET['transaction_status']))
                                                @if ($_GET['transaction_status'] == "arrived")
                                                    {{'selected'}}
                                                @endif
                                            @endif>Arrived</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                            <input type="submit" class="btn btn-info" value="Filter" style="margin-top:27px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-sm-12 col-12 col-lg-12">
                                <table class="table" id="table-transaction">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Number</th>
                                                <th>Order Date</th>
                                                <th>Member</th>
                                                <th>Total Amount</th>
                                                <th>Payment Status</th>
                                                <th>Order Status</th>
                                                <th>Courier</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($reports as $row)
                                                <tr id="rowTr" data-kode="{{$row->id}}">
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$row->transaction_number}}</td>
                                                    <td>{{$row->date}}</td>
                                                    <td>
                                                        <small>
                                                            <b>{{$row->member->name}}</b><br>
                                                            <b class="tag tag-warning">{{$row->member->email}}</b><br>
                                                            <b>{{$row->member->phone}}</b>
                                                        </small>
                                                    </td>
                                                    <td>{{$row->total_amount+$row->transactionCourier->value}}</td>
                                                    <td>
                                                        {!!payment_label($row->invoice->payment_status,$row->id)!!}<br>
                                                       
                                                    </td>
                                                    <td>
                                                        {!!transaction_label($row->transaction_status,$row->id)!!}<br>
                                                        
                                                    </td>
                                                    <td>{{$row->transactionCourier->courier}}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
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
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });
</script>
@endsection