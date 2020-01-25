@extends('storeadmin.layout.template')
@section('page','Report Product Sold')
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
                <h4 id="basic-forms" class="card-title">Report Product Sold</h4>
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
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <a href="{{route('admin.report_shipment_print')}}" class="btn btn-primary btn-print" style="margin-top:27px;" target="_blank">Print</a>
                            <a href="{{route('admin.report_shipment_excel')}}" class="btn btn-warning btn-excel" style="margin-top:27px;" target="_blank">Excel</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-12 col-lg-8 col-md-6">
                            <table class="table" id="table-transaction">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Product Name</th>
                                            <th>Category</th>
                                            <th>Selling Price</th>
                                            <th>Sold</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($array_product as $row)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$row['name']}}</td>
                                                <td>{{$row['category']}}</td>
                                                <td>{{rupiah($row['selling_price'])}}</td>
                                                <td>{{$row['sold']}}</td>
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