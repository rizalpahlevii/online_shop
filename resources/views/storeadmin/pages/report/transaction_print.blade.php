<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Transaction {{date('Y-m-d')}}</title>
    <link rel="stylesheet" type="text/css" href="{{asset('backend')}}/css/bootstrap.css">

</head>
<body>
    <div class="container mt-3">
        <h3 class="text-center">Report Transaction {{date('Y-m-d')}}</h3>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Number</th>
                            <th>Order Date</th>
                            <th>Name / Email</th>
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
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$row->transaction_number}}</td>
                                <td>{{$row->date}}</td>
                                <td>
                                   {{$row->member->name}} / 
                                   {{$row->member->email}} 
                                   
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
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="{{asset('backend')}}/js/core/libraries/jquery.min.js" type="text/javascript"></script>
    <script src="{{asset('backend')}}/js/core/libraries/bootstrap.min.js" type="text/javascript"></script>
    <script>
        $(document).ready(()=>{
            window.print();
        });
    </script>
</body>
</html>