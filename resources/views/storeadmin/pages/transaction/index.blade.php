@extends('storeadmin.layout.template')
@section('page','Transaction / Order')
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
                <h4 id="basic-forms" class="card-title">Transaction / Order</h4>
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
                                                <th>Total</th>
                                                <th>Payment Status</th>
                                                <th>Order Status</th>
                                                <th>Courier</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($transactions as $row)
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
                                                    <td>{{$row->total_amount}}</td>
                                                    <td>
                                                        
                                                        {!!payment_label($row->invoice->payment_status,$row->id)!!}<br>
                                                        <p class="tag tag-success" style="cursor:pointer;" id="rowPaymentStatus" data-kode="{{$row->id}}"> 
                                                            <i class="icon-edit2" ></i> 
                                                            Set Status</p>
                                                    </td>
                                                    <td>
                                                        {!!transaction_label($row->transaction_status,$row->id)!!}<br>
                                                        <p class="tag tag-success" data-payment="{{$row->invoice->payment_status}}" id="rowTransactionStatus" data-kode="{{$row->id}}" <?=($row->invoice->payment_status == "unpaid")?' style="cursor:not-allowed;"':' style="cursor:pointer;"';?>> 
                                                            <i class="icon-edit2" ></i> 
                                                            Set Status</p>
                                                    </td>
                                                    <td>{{$row->courier->title}}</td>
                                                    <td>
                                                        <a href="{{route('admin.transaction_detail',$row->id)}}" target="_blank" class="btn btn-info"><i class="icon-eye4"></i> Detail</a>
                                                        @if ($row->invoice->attachment == null)
                                                            <a href="#" class="btn btn-danger" style="margin-top:3px;"><i class="icon-ban"></i> No Payment Receipt</a>
                                                        @else
                                                            <a href="#" class="btn btn-warning viewAttachment" style="margin-top:3px;" data-url="{{asset('images')}}/attachments/{{$row->invoice->attachment}}"><i class="icon-search-plus"></i> Payment Receipt</a>
                                                        @endif
                                                    </td>
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
        $(document).on('click','#rowTransactionStatus',function(){
            var kode = $(this).data('kode');
            if($(this).data('payment') == "unpaid"){
                Swal.fire('Error!', 'Unpaid Payment!','error')
            }else{
                Swal.fire({
                    title : 'Choose Order Status',
                    html : '<select id="input2" style="width:50%;margin: 10px;padding: 5px;">' +
                        '<option value="proccess">Proccess</option>' +
                        '<option value="shipped">Shipped</option>' +
                        '<option value="in_shipping">In Shipping</option>' +
                        '<option value="arrived">Arrived</option>' +
                        '</select>',
                    focusConfirm:false,
                    showLoaderOnConfirm:true,
                    preConfirm:()=>{
                        return [
                            document.getElementById('input2').value,
                        ]
                    }
                }).then((result)=>{
                    if(result.value[0] == "in_shipping"){
                        Swal.fire({
                            title: 'Enter Receipt Number',
                            html : '<input type="text" style="width:50%;margin: 10px;padding: 5px;>" id="inputText">',
                            focusConfirm :false,
                            showLoaderOnConfirm : true,
                            preConfirm:()=>{
                                return [
                                    document.getElementById('inputText').value,
                                ]
                            }
                        }).then((result2) => {
                            $.ajax({
                                url : "{{route('admin.transaction_ajxtransaction')}}",
                                method : "post",
                                data :{
                                    transaction_id :kode,
                                    status : result.value[0],
                                    receipt_number : result2.value[0],
                                },
                                success:function(response){
                                    if(response == "success"){
                                        Swal.fire( 'Success!','Update Success!', 'success').then(function () {  
                                            location.reload();
                                        });
                                    }else{
                                        Swal.fire('Error!', 'Error!','error').then(function(){
                                            location.reload();
                                        });
                                    }
                                },
                                beforeSend:function(){
                                    Swal.fire({
                                        title: 'Loading .....',
                                        allowEscapeKey: false,
                                        allowOutsideClick: false,
                                        timer: 2000,
                                        onOpen: () => {
                                            Swal.showLoading()
                                        }
                                    })
                                },
                                error:function(request,status,error){
                                    Swal.fire( 'Error!',request.responseText, 'error');
                                }
                            });
                        });
                    }else{
                        $.ajax({
                            url : "{{route('admin.transaction_ajxtransaction')}}",
                            method : "post",
                            data :{
                                transaction_id :kode,
                                status : result.value[0]
                            },
                            success:function(response){
                                if(response == "success"){
                                    Swal.fire( 'Success!','Update Success!', 'success').then(function () {  
                                        location.reload();
                                    });
                                }else{
                                    Swal.fire('Error!', 'Error!','error').then(function(){
                                        location.reload();
                                    });
                                }
                            },
                            beforeSend:function(){
                                Swal.fire({
                                    title: 'Loading .....',
                                    allowEscapeKey: false,
                                    allowOutsideClick: false,
                                    timer: 2000,
                                    onOpen: () => {
                                        Swal.showLoading()
                                    }
                                })
                            },
                            error:function(request,status,error){
                                Swal.fire( 'Error!',request.responseText, 'error');
                            }
                        });
                    }
                });
            }
        });

        $(document).on('click','.viewAttachment',function(){
            url = $(this).data('url');
            Swal.fire({
                imageUrl: url,
            })
        });

        $(document).on('click','#rowPaymentStatus',function(){
            var kode = $(this).data('kode');
            Swal.fire({
				title: 'Choose Payment Status',
				html: '<select id="input1" style="width:50%;margin: 10px;padding: 5px;">' +
					'<option value="unpaid">Unpaid</option>' +
					'<option value="paid">Paid</option>' +
					'<option value="rejected">Rejected</option>' +
					'<option value="waiting_confirmation">Waiting Confirmation</option>' +
					'</select>',
				focusConfirm: false,
				showLoaderOnConfirm: true,
				preConfirm: () => {
					return [
						document.getElementById('input1').value,
					]
				}
			}).then((result) => {
                $.ajax({
                    url : "{{route('admin.transaction_ajxpayment')}}",
                    method : "post",
                    data :{
                        transaction_id :kode,
                        status : result.value[0]
                    },
                    success:function(response){
                        if(response == "success"){
                            Swal.fire( 'Success!','Update Success!', 'success').then(function () {  
                                location.reload();
                            });
                        }else{
                            Swal.fire('Error!', 'Error!','error').then(function(){
                                location.reload();
                            });
                        }
                    },
                    beforeSend:function(){
                        Swal.fire({
                            title: 'Loading .....',
                            allowEscapeKey: false,
                            allowOutsideClick: false,
                            timer: 2000,
                            onOpen: () => {
                                Swal.showLoading()
                            }
                        })
                    },
                    error:function(request,status,error){
                        Swal.fire( 'Error!',request.responseText, 'error');
                    }
                });
            });

        });
    });
</script>
@endsection