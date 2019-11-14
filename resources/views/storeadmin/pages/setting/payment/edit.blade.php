@extends('storeadmin.layout.template')
@section('page','Payment Edit')
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
                <h4 id="basic-forms" class="card-title">Payment Edit</h4>
             
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
                        <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="card-body collapse in" aria-expanded="true">
                <div class="card-block">
                    <form action="{{route('admin.setting_payment_update')}}" method="post">
                        @method('PUT')
                        @csrf
                        <br>
                            <div class="row">
                                <div class="col-md-6 col-sm-10 col-12">
                                    <div class="form-group">
                                        <label for="bank_name">Bank Name</label>
                                        <input type="text" id="bank_name" class="form-control" name="bank_name" value="{{$payment->bank_name}}">
                                        @error('bank_name')
                                            <p class="text-danger">{{$errors->first('bank_name')}}</p>
                                        @enderror
                                    </div>
                                </div>                                
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-10 col-12">
                                    <div class="form-group">
                                        <label for="account_name">Account Name</label>
                                        <input type="text" id="account_name" class="form-control" name="account_name" value="{{$payment->account_name}}">
                                        @error('account_name')
                                            <p class="text-danger">{{$errors->first('account_name')}}</p>
                                        @enderror
                                    </div>
                                </div>                                
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 col-sm-10 col-12">
                                    <div class="form-group">
                                        <label for="account_number">Account Number</label>
                                        <input type="text" id="account_number" class="form-control" name="account_number"  value="{{$payment->account_number}}">
                                        @error('account_number')
                                            <p class="text-danger">{{$errors->first('account_number')}}</p>
                                        @enderror
                                    </div>
                                </div>                                
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 col-sm-10 col-12">
                                    <div class="form-group">
                                        <label for="swift_code">Swift Code</label>
                                        <input type="text" id="swift_code" class="form-control" name="swift_code" value="{{$payment->swift_code}}">
                                        @error('swift_code')
                                            <p class="text-danger">{{$errors->first('swift_code')}}</p>
                                        @enderror
                                    </div>
                                </div>                                
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-10 col-12">
                                    <div class="form-group">
                                        <label for="detail">Detail</label>
                                        <textarea name="detail" id="detail" cols="10" rows="30" class="form-control">{{$payment->detail}}</textarea>
                                        @error('swift_code')
                                            <p class="text-danger">{{$errors->first('swift_code')}}</p>
                                        @enderror
                                    </div>
                                </div>                                
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <input type="submit" name="submit" value="Save" class="btn btn-info">
                                    <a href="{{route('admin.setting_payment')}}" class="btn btn-danger">Back</a>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        ClassicEditor
            .create(document.querySelector('#detail'))
            .catch(error => {
                console.error('error')
        });
    });
</script>
@endsection