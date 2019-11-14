@extends('storeadmin.layout.template')
@section('page','Store Payment')
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
                <h4 id="basic-forms" class="card-title">Store Payment</h4>
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
                        <div class="col-md-3" style="margin-bottom:10px;">
                            @if (empty($payment))
                                <a href="{{route('admin.setting_payment_add')}}" class="btn btn-success">Add Payment</a>    
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Bank Name</th>
                                        <th>Account Name</th>
                                        <th>Account Number</th>
                                        <th>Swift Code</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                @if (!empty($payment))    
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>{{$payment->bank_name}}</td>
                                        <td>{{$payment->account_name}}</td>
                                        <td>{{$payment->account_number}}</td>
                                        <td>{{$payment->swift_code}}</td>
                                        <td>
                                            <a href="{{route('admin.setting_payment_edit')}}" class="btn btn-sm btn-warning">Edit</a>
                                            <a href="{{route('admin.setting_payment_delete')}}" class="btn btn-sm btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                </tbody>
                                @else
                                    <tbody>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection