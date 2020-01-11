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
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="month">Month</label>
                                            <select name="month" id="month" class="form-control">
                                                <option disabled selected>-- Choose Month --</option>
                                                <option value="1" <?php echo set_selected_month(1); ?>>January</option>
                                                <option value="2" <?php echo set_selected_month(2); ?>>February</option>
                                                <option value="3"  <?php echo set_selected_month(3); ?>>March</option>
                                                <option value="4" <?php echo set_selected_month(4); ?>>April</option>
                                                <option value="5" <?php echo set_selected_month(5); ?>>May</option>
                                                <option value="6" <?php echo set_selected_month(6); ?>>June</option>
                                                <option value="7" <?php echo set_selected_month(7); ?>>July</option>
                                                <option value="8" <?php echo set_selected_month(8); ?>>August</option>
                                                <option value="9" <?php echo set_selected_month(9); ?>>September</option>
                                                <option value="10" <?php echo set_selected_month(10); ?>>October</option>
                                                <option value="11" <?php echo set_selected_month(11); ?>>November</option>
                                                <option value="12" <?php echo set_selected_month(12); ?>>December</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="year">Year</label>
                                            <select name="year" id="year" class="form-control">
                                                <option disabled selected>-- Choose Year --</option>
                                                @foreach ($years as $year)
                                                    <option value="{{$year->year}}" <?php echo set_selected_year($year->year); ?>>{{$year->year}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="submit" class="btn btn-info" value="Filter" style="margin-top:27px;">
                                        <a href="#" class="btn btn-primary btn-print" style="margin-top:27px;">Print</a>
                                        <a href="#" class="btn btn-warning btn-excel" style="margin-top:27px;">Excel</a>
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
                                                    <td>{{rupiah($subItem)}}</td>
                                                    
                                                    <td>{{rupiah($row->transactionCourier->value)}}</td>
                                                    <td>{{rupiah($row->transactionCourier->value+$subItem)}}</td>
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
                                                    <td colspan="6" align="right"><b>Total Product Price :</b></td>
                                                    <td colspan="2"><b>{{rupiah($finalSubItem)}}</b></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="6" align="right"><b>Total Price Shipment :</b></td>
                                                    <td colspan="2"><b>{{rupiah($finalOngkir)}}</b></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="6" align="right"><b>Total :</b></td>
                                                    <td colspan="2"><b>{{rupiah($finalTotal)}}</b></td>
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
        $('.btn-print').click(function(){
            const year = $('#year').val();
            const month = $('#month').val();
            if(month == null || year == null){
                alert('Oke');
            }else{
                window.open("{{ route('admin.report_transaction_print') }}" + `?month=${month}&year=${year}`);
            }
        });
        $('.btn-excel').click(function(){
            const year = $('#year').val();
            const month = $('#month').val();
            if(month == null || year == null){
                alert('Oke');
            }else{
                window.open("{{ route('admin.report_transaction_excel') }}" + `?month=${month}&year=${year}`);
            }
        });
    });
</script>
@endsection