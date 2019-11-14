@extends('storeadmin.layout.template')
@section('page','Edit Product')
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
                <h4 id="basic-forms" class="card-title">Product Edit</h4>
             
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
                        <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="card-body collapse in" aria-expanded="true">
                <div class="card-block">
                    <form action="{{route('admin.product_update',$product->id)}}" method="post" enctype="multipart/form-data">
                        @method('PUT')
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="code">Code</label>
                                        <input type="text" id="code" class="form-control" placeholder="Code (Optional)" name="code" value="{{$product->code}}">
                                        @error('code')
                                            <p class="text-danger">{{$errors->first('code')}}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name_product">Product Name</label>
                                        <input type="text" id="name_product" class="form-control @error('name_product') is-invalid @enderror" placeholder="Name Product" name="name_product" value="{{$product->name}}">
                                        @error('name_product')
                                            <p class="text-danger">{{$errors->first('name_product')}}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="purchase_price">Purchase Price</label>
                                        <input type="number" id="purchase_price" class="form-control @error('purchase_price') is-invalid @enderror" placeholder="Purchase Price" name="purchase_price" value="{{$product->purchase_price}}">
                                        @error('purchase_price')
                                            <p class="text-danger">{{$errors->first('purchase_price')}}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="selling_price">Selling Price</label>
                                            <input type="number" id="selling_price" class="form-control" placeholder="Selling Price" name="selling_price" value="{{$product->selling_price}}">
                                            @error('selling_price')
                                                <p class="text-danger">{{$errors->first('selling_price')}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="weight">Weight *(gr)</label>
                                            <input type="number" id="weight" class="form-control @error('weight') is-invalid @enderror" placeholder="Weight *(gr)" name="weight" value="{{$product->weight}}">
                                            @error('weight')
                                                <p class="text-danger">{{$errors->first('weight')}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="stock">Stok</label>
                                            <input type="number" id="stock" class="form-control @error('stock') is-invalid @enderror" placeholder="Stok" name="stock" value="{{$product->stock}}">
                                            @error('stock')
                                                <p class="text-danger">{{$errors->first('stock')}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            
                                            <textarea name="description" id="description" class="form-control" cols="30" placeholder="Product Description" rows="5">{{$product->description}}</textarea>
                                            @error('description')
                                                <p class="text-danger">{{$errors->first('description')}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <figure class="col-lg-12 col-md-12 col-xs-12" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                                            <a href="#" itemprop="contentUrl" data-size="480x360">
                                            <img class="img-thumbnail img-fluid" src="{{asset('images')}}/products/{{$product->image}}" itemprop="thumbnail" alt="Image description" />
                                            </a>
                                          </figure>
                                    </div>
                                    <div class="col-md-3">
                                            <div class="form-group">
                                                    <label for="image">Image</label>
                                                    <input type="file" id="image" class="form-control @error('image') is-invalid @enderror" placeholder="Stok" name="image" value="{{old('image')}}">
                                                    @error('image')
                                                        <p class="text-danger">{{$errors->first('image')}}</p>
                                                    @enderror
                                                </div>
                                    </div>
                                </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="submit" name="submit" id="submit" class="btn btn-info">
                                    <a href="{{route('admin.product_index')}}" class="btn btn-warning">Back</a>
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