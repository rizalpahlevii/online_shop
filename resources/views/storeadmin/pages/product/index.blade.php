@extends('storeadmin.layout.template')
@section('page','Product')
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
                <h4 id="basic-forms" class="card-title">Product List</h4>
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
                    <a href="{{route('admin.product_create')}}" class="btn btn-success mb-2">Add Product</a>
                    <table class="table" id="table-backend">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Code</th>
                                <th>Category</th>
                                <th>Purchase Price</th>
                                <th>Selling Price</th>
                                <th>Stok</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $row)
                                <tr id="rowPr" >
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$row->name}}</td>
                                    <td>{{$row->code}}</td>
                                    <td>{{$row->category->name}}</td>
                                    <td>{{$row->purchase_price}}</td>
                                    <td>{{$row->selling_price}}</td>
                                    <td>{{$row->stock}}</td>
                                    <td>
                                        <div>
                                            <div class="btn-group mr-1 mb-1">
                                                <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="#" id="increaseStock" data-kode="{{$row->id}}">Increase Stock</a>
                                                    <a class="dropdown-item" href="#" id="decreaseStock" data-kode="{{$row->id}}">Decrease Stock</a>
                                                    <a class="dropdown-item" href="{{route('admin.product_show',$row->id)}}" id="edit" data-kode="{{$row->id}}">Edit</a>
                                                    <a class="dropdown-item" href="#" id="changeCategory" data-kode="{{$row->id}}">Change Category</a>
                                                    <a class="dropdown-item" href="#" id="Delete" data-kode="{{$row->id}}">Delete</a>
                                                </div>
                                            </div>
        
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Code</th>
                                <th>Category</th>
                                <th>Purchase Price</th>
                                <th>Selling Price</th>
                                <th>Stok</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="modal fade text-xs-left" id="increaseStockModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabelIncrease"><i class="icon-stack"></i> Penambahan Stok</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <input type="hidden" id="product_id" name="product_id">
                    <div class="col-md-8 offset-md-2">
                        <div class="form-group">
                            <label for="product_name">Nama Produk</label>
                            <input type="text" class="form-control" name="product_name" id="product_name" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <div class="form-group">
                            <label for="current_stock">Stok Saat Ini</label>
                            <input type="text" class="form-control" name="current_stock" id="current_stock" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <div class="form-group">
                            <label for="stock_add">Tambah Stok</label>
                            <input type="number" class="form-control" name="stock_add" id="stock_add">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <div class="form-group">
                            <label for="jumlah">Jumlah</label>
                            <input type="text" class="form-control" name="jumlah" id="jumlah" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-outline-primary" id="btn-update">Update</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade text-xs-left" id="decreaseStockModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabelIncrease"><i class="icon-stack"></i> Pengurangan Stok</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <input type="hidden" id="product_id_pgr" name="product_id_pgr">
                    <div class="col-md-8 offset-md-2">
                        <div class="form-group">
                            <label for="product_name_pgr">Nama Produk</label>
                            <input type="text" class="form-control" name="product_name_pgr" id="product_name_pgr" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <div class="form-group">
                            <label for="current_stock_pgr">Stok Saat Ini</label>
                            <input type="text" class="form-control" name="current_stock_pgr" id="current_stock_pgr" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <div class="form-group">
                            <label for="kurangi_stok">Kurangi Stok</label>
                            <input type="number" class="form-control" name="kurangi_stok" id="kurangi_stok">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <div class="form-group">
                            <label for="jumlah_pgr">Jumlah</label>
                            <input type="text" class="form-control" name="jumlah_pgr" id="jumlah_pgr" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-outline-primary" id="btn-update-pgr">Update</button>
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
        $(document).on('click','#increaseStock',function(){
            productId = $(this).data('kode');
            $.ajax({
                url : "{{url('/admin/product/ajxIncreaseStock')}}"+'/'+productId,
                method : "get",
                dataType : "json",
                success:function(response){
                    showModalIncreaseStock(response);
                }
            });
        });
        function showModalIncreaseStock(data)
        {
            $('#product_id').val(data.id);
            $('#product_name').val(data.name);
            $('#current_stock').val(data.stock);
            $('#jumlah').val(data.stock);
            $('#increaseStockModal').modal('show');
        }
        $(document).on('keyup','#stock_add',function(){
            var tambah = $(this).val();
            var curr = $('#current_stock').val();
            var ttl = parseInt(tambah) + parseInt(curr);
            $('#jumlah').val(ttl);
        });
        $(document).on('click','#btn-update',function(){
            $.ajax({
                url : "{{url('/admin/product/ajxIncreaseStock')}}",
                method : "post",
                dataType : "json",
                data :{
                    id : $('#product_id').val(),
                    stock : $('#stock_add').val()
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
                    if(response == "success"){
                        Swal.fire( 'Success!','Update Success!', 'success');
                    }else{
                        Swal.fire('Error!', 'Error!','error')
                    }
                    location.reload();
                },
                error:function(request,status,error){
                    Swal.fire( 'Error!',request.responseText, 'error');
                }
            });
        });

        $(document).on('click','#decreaseStock',function(){
            productId = $(this).data('kode');
            $.ajax({
                url : "{{url('/admin/product/ajxDecreaseStock')}}"+'/'+productId,
                method : "get",
                dataType : "json",
                success:function(response){
                    showModalDecreaseStock(response);
                }
            });
        });
        function showModalDecreaseStock(data)
        {
            $('#product_id_pgr').val(data.id);
            $('#product_name_pgr').val(data.name);
            $('#current_stock_pgr').val(data.stock);
            $('#jumlah_pgr').val(data.stock);
            $('#decreaseStockModal').modal('show');
        }
        $(document).on('keyup','#kurangi_stok',function(){
            var kurang = $(this).val();
            var curr = $('#current_stock_pgr').val();
            var ttl = parseInt(curr) - parseInt(kurang);
            $('#jumlah_pgr').val(ttl);
        });
        $(document).on('click','#btn-update-pgr',function(){
            $.ajax({
                url : "{{url('/admin/product/ajxDecreaseStock')}}",
                method : "post",
                dataType : "json",
                data :{
                    id : $('#product_id_pgr').val(),
                    stock : $('#kurangi_stok').val()
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
                    if(response == "success"){
                        Swal.fire( 'Success!','Update Success!', 'success');
                    }else{
                        Swal.fire('Error!', 'Error!','error')
                    }
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