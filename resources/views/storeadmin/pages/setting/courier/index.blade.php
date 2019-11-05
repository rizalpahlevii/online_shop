@extends('storeadmin.layout.template')
@section('page','Store Courier')
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
                <h4 id="basic-forms" class="card-title">Store Courier</h4>
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
                    <div class="row">
                        <div class="col-md-8">

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Code</th>
                                        <th>title</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($couriers as $row)
                                    @php
                                        $ceklis = set_checked_courier($store->id,$row->id);
                                    @endphp
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$row->code}}</td>
                                        <td>{{$row->title}}</td>
                                        <td>{!!($ceklis != "") ? '<div class="tag tag-success">Active</div>':'<div class="tag tag-danger">Nonactive</div>'!!}</td>
                                        <td><input type="checkbox" name="sts_check" id="sts_check" data-courier="{{$row->id}}" data-store="{{$store->id}}" {{$ceklis}}></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Code</th>
                                        <th>Courier</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
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
        $(document).on('click','#sts_check',function(){
            var courierId = $(this).data('courier');
            var storeId = $(this).data('store');
            $.ajax({
                url : "{{url('/admin/setting/courierUpdate')}}" ,
                method : "post",
                dataType : "json",
                data:{
                    courierId :courierId,
                    storeId:storeId
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
                success:function(response){
                    location.reload();
                },
                error:function(request,status,error){
                    Swal.fire( 'Error!',request.responseText, 'error');
                }
            });
        });
    });
</script>
@endsection