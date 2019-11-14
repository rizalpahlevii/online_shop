@extends('storeadmin.layout.template')
@section('page','Store Setting')
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
                <h4 id="basic-forms" class="card-title">Store Setting</h4>
             
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
                        <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="card-body collapse in" aria-expanded="true">
                <div class="card-block">
                    <form action="#">
                        <div class="row">
                            <div class="col-md-6">
                                @if (Session::has('status'))
                                    {!!Session::get('status')!!}
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <a href="{{route('admin.setting_store_edit')}}" class="btn btn-warning">Edit</a>
                            </div>
                        </div>
                        <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="code">Store Name</label>
                                        <input type="text" id="code" class="form-control" name="code" value="{!!$store->name!!}" readonly>

                                    </div>
                                </div>                                
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="code">Created at</label>
                                        <input type="text" id="code" class="form-control" name="code" value="{{$store->created_at->format('d M Y')}}" readonly>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="code">Address</label>
                                        <input type="text" id="code" class="form-control" name="code" value="{{$store->address}}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea name="description" id="description" cols="30" rows="10" readonly class="form-control">
                                            {{$store->store_description}}
                                        </textarea>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="province">Province</label>
                                        <input type="text" name="province" id="province" class="form-control" readonly value="{{$store->province_name}}">
                                        @if ($store->province_code == null)
                                            <p class="text-info">Province not set</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="city">City</label>
                                        <input type="text" name="city" id="city" class="form-control" readonly value="{{$store->districts_name}}">
                                        @if ($store->districts_code == null)
                                            <p class="text-info">City not set</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="active_courier">Active Courier</label>
                                        <input type="text" name="active_courier" id="active_courier" class="form-control" readonly value="{{$value}}">

                                    </div>
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
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error('error')
            });
    });
</script>
@endsection