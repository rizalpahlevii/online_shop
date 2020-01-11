<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Number</th>
            <th>Order Date</th>
            <th>Name \ Emails</th>
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
        <tr>
            <td colspan="6" align="right"><b>Total Value :</b></td>
            <td colspan="2"><b>{{rupiah($finalValue)}}</b></td>
        </tr>
        @endforeach
    </tbody>
        

</table>
