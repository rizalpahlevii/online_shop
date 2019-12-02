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
                                            <label for="month">Month</label>
                                            <select name="month" id="month" class="form-control">
                                                <option disabled selected>-- Choose Month --</option>
                                                <option value="1" <?=($_GET['month'] == 1) ? 'selected':'';?>>January</option>
                                                <option value="2"<?=($_GET['month'] == 2) ? 'selected':'';?>>February</option>
                                                <option value="3"<?=($_GET['month'] == 3) ? 'selected':'';?>>March</option>
                                                <option value="4"<?=($_GET['month'] == 4) ? 'selected':'';?>>April</option>
                                                <option value="5"<?=($_GET['month'] == 5) ? 'selected':'';?>>May</option>
                                                <option value="6"<?=($_GET['month'] == 6) ? 'selected':'';?>>June</option>
                                                <option value="7"<?=($_GET['month'] == 7) ? 'selected':'';?>>July</option>
                                                <option value="8"<?=($_GET['month'] == 8) ? 'selected':'';?>>August</option>
                                                <option value="9"<?=($_GET['month'] == 9) ? 'selected':'';?>>September</option>
                                                <option value="10"<?=($_GET['month'] == 10) ? 'selected':'';?>>October</option>
                                                <option value="11"<?=($_GET['month'] == 11) ? 'selected':'';?>>November</option>
                                                <option value="12"<?=($_GET['month'] == 12) ? 'selected':'';?>>December</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="year">Year</label>
                                            <select name="year" id="year" class="form-control">
                                                <option disabled selected>-- Choose Year --</option>
                                                @foreach ($years as $year)
                                                    <option value="{{$year->year}}" <?= ($_GET['year'] == $year->year) ? 'selected' : '';?>>{{$year->year}}</option>
                                                @endforeach
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
                                                <th>Sub Item</th>
                                                <th>Ongkir</th>
                                                <th>Total Amount</th>
                                                <th>Courier</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $finalTotal = 0;
                                                $finalSubItem = 0;
                                                $finalOngkir = 0;
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
                                                    @php
                                                        $subItem = 0;
                                                        foreach($row->transactionDetail as $rowD){
                                                            $subItem += $rowD->price * $rowD->quantity;
                                                        }
                                                    @endphp
                                                    <td>{{number_format($subItem)}}</td>
                                                    
                                                    <td>{{number_format($row->transactionCourier->value)}}</td>
                                                    <td>{{number_format($row->transactionCourier->value+$subItem)}}</td>
                                                    <td>{{$row->transactionCourier->courier}}</td>
                                                </tr>
                                                @php
                                                    $finalSubItem +=$subItem;
                                                    $finalOngkir += $row->transactionCourier->value;
                                                    $finalTotal += $row->transactionCourier->value+$subItem;
                                                @endphp
                                            @endforeach
                                        </tbody>
                                        @if ($reports)
                                            
                                            <tfoot>
                                                <tr>
                                                    <td colspan="6" align="right"><b>Total Product :</b></td>
                                                    <td colspan="2"><b>{{number_format($finalSubItem)}}</b></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="6" align="right"><b>Total Price Shipment :</b></td>
                                                    <td colspan="2"><b>{{number_format($finalOngkir)}}</b></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="6" align="right"><b>Total :</b></td>
                                                    <td colspan="2"><b>{{number_format($finalTotal)}}</b></td>
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