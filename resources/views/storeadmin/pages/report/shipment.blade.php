@extends('storeadmin.layout.template')
@section('page','Report Shipment')
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
                <h4 id="basic-forms" class="card-title">Report Shipment</h4>
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
                    <div class="row">
                        <div class="col-sm-12 col-12 col-lg-12">
                                <table class="table" id="table-transaction">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Number</th>
                                                <th>Order Date</th>
                                                <th>Member</th>
                                                <th>Destination</th>
                                                <th>Courier</th>
                                                <th>Service</th>
                                                <th>Etd</th>
                                                <th>Value</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $finalValue = 0;
                                            @endphp
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
                                                    <td>{{$row->transactionAddress->province_name . ', ' . $row->transactionAddress->city_name}}</td>
                                                    
                                                    <td>{{$row->transactionCourier->courier}}</td>
                                                    <td>{{$row->transactionCourier->service}}</td>
                                                    <td>{{$row->transactionCourier->etd}}</td>
                                                    <td>{{'Rp. '.number_format($row->transactionCourier->value)}}</td>
                                                </tr>
                                                @php
                                                    $finalValue +=$row->transactionCourier->value;
                                                @endphp
                                            @endforeach
                                        </tbody>
                                        @if ($reports)
                                            
                                            <tfoot>
                                                <tr>
                                                    <td colspan="6" align="right"><b>Total Value :</b></td>
                                                    <td colspan="2"><b>{{'Rp. '.number_format($finalValue)}}</b></td>
                                                </tr>
                                            </tfoot>
                                        @endif

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