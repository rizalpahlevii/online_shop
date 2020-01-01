@extends('frontend.layout.template')
@section('page','INVOICE PAYMENT')
@section('content')
<div class="container">
    <div class="row mt-3 mb-3">
        <div class="col-md-8 offset-md-2">
            <form id="invoice_payment" method="post" enctype="multipart/form-data" action="">
                <div class="card">
                    <h6 class="card-header">Invoice Payment</h6>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <strong>Invoice #{{$invoice->transaction_number}}</strong>
                                <br><br>
                                <div class="error-alert">
                                    <div class='alert alert-warning'>
                                        <!-- <a href='#'' class='close' data-dismiss='alert' aria-label='close' title='close'>×</a> -->
                                        <strong>Invoice ID number must be used as transfer reference</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="media">
                                    <div class="media-body">
                                        <p>We are accepting manual bank transfer too, if you wish to pay this invoice with a manual transfer bank, you should follow this step:</p>
                                        <ol>
                                            <li>
                                                Transfer into listed bank account
                                                <br>
                                                <b>{{$owner->store->payment->bank_name}} - {{$owner->store->payment->account_number}}</b>
                                                <br>
                                                <b>A.N : {{$owner->store->payment->account_name}}</b>
                                                <br>
                                            </li>
                                            <li>Upload the Receipt into Proof of Payment</li>
                                        </ol>
                                        <hr>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <input type="hidden" name="transaction_id" id="transaction_id" value="{{$invoice->id}}">
                            <div class="col-md-2">
                            <input type="file" name="file" id="file" class="btn btn-light submitProof">
                                <small><span>&nbsp;Max. File : 1MB</span></small>
                            </div>
                        </div>
                        <hr>
                            <div class="media-footer">
                                <button type="submit" class="btn btn-primary btn-submit">Submit</button>
                                <button class="btn btn-primary btn-load" style="display:none;">
                                    <i class="fa fa-spinner fa-spin"></i> Loading...
                                </button>
                            </div>
                    </div>
                </div>
            </form>
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
        $('.btn-submit').click(function(e) {
            e.preventDefault();
            $("#invoice_payment").submit();
        });
        $('#invoice_payment').submit(function(e){
            transaction_id = $('#transaction_id').val();
            proof_file = $('input.submitProof');
            data = new FormData();
            data.append('proof_file', proof_file[0].files[0]);
            data.append('transaction_id', transaction_id);

            var reader = new FileReader();
            reader.readAsDataURL(proof_file[0].files[0]);
            reader.onload = function(e){
                $.ajax({
                    data : data,
                    type : "POST",
                    url : "{{route('fe.upload_proof')}}",
                    cache : false,
                    contentType : false,
                    processData : false,
                    beforeSend:function(){
                        $('.btn-submit').attr('disabled', true);
                        $('.btn-submit').hide();
                        $('.btn-load').attr('disabled', true);
                        $('.btn-load').show();
                    },
                    success:function(response){
                        Swal.fire( 'Success!',response, 'success').then(function(){
                            location.href = "{{route('fe.invoice')}}";
                        });
                        $('.btn-submit').attr('disabled', false);
                        $('.btn-load').hide();
                        $('.btn-submit').show();
                    },
                    error:function(response){
                        Swal.fire( 'Error!',request.responseText, 'error');
                    }
                });
            }
            e.preventDefault();
        });
    });
</script>
@endsection