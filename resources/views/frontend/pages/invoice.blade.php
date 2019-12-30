@extends('frontend.layout.template')
@section('page','My Invoice')
@section('content')
<div class="container">
    <div class="row mt-3 mb-3">
        <div class="col-md-10 offset-md-1">
            <div class="card">
                <h6 class="card-header">Invoice</h6>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                           <table class="table table-bordered text-center">
                               <tr>
                                   <th>#</th>
                                   <th>Invoice</th>
                                   <th>Date</th>
                                   <th>Total Amount</th>
                                   <th>Status</th>
                                   <th>Detail</th>
                                   <th>Expired</th>
                                   <th>Proof Of Payment</th>
                               </tr>
                               @foreach ($invoice as $key => $row)
                                   <tr>
                                       <td>{{$loop->iteration}}</td>
                                       <td>{{$row->transaction_number}}</td>
                                        <td>{{$row->created_at}}</td>
                                        <td>{{$row->total_amount}}</td>
                                        <td>{{$row->invoice->payment_status}}</td>
                                        <td><a href="#" class="btn btn-success btn-sm">Detail</a></td>
                                        <td>{{$row->invoice->expired}}</td>
                                        <td><a href="#" class="btn btn-primary btn-sm">View Attachment</a></td>
                                   </tr>
                               @endforeach
                           </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection