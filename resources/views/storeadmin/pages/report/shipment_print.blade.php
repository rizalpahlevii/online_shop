<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Shipment {{date('Y-m-d')}}</title>
    <link rel="stylesheet" type="text/css" href="{{asset('backend')}}/css/bootstrap.css">

</head>
<body>
    <div class="container mt-3">
        <h3 class="text-center">Report Shipment {{date('Y-m-d')}}</h3>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered table-hover">
                    <thead>
                        <th>#</th>
                        <th>Number</th>
                        <th>Order Date</th>
                        <th>Name \ Emails</th>
                        <th>Destination</th>
                        <th>Courier</th>
                        <th>Service</th>
                        <th>Etd</th>
                        <th>Value</th>
                    </thead>
                    <tbody>
                        @php
                            $finalValue = 0;
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
                                <td>{{$row->transactionAddress->province_name . ', ' . $row->transactionAddress->city_name}}</td>
                                
                                <td>{{$row->transactionCourier->courier}}</td>
                                <td>{{$row->transactionCourier->service}}</td>
                                <td>{{$row->transactionCourier->etd}}</td>
                                <td>{{rupiah($row->transactionCourier->value)}}</td>
                            </tr>
                            @php
                                $finalValue +=$row->transactionCourier->value;
                            @endphp
                        @endforeach
                            <tr>
                                <td colspan="6" align="right"><b>Total Value :</b></td>
                                <td colspan="2"><b>{{rupiah($finalValue)}}</b></td>
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