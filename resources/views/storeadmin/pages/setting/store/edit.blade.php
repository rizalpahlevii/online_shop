@extends('storeadmin.layout.template')
@section('page','Store Edit')
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
                <h4 id="basic-forms" class="card-title">Store Edit</h4>
             
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
                        <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="card-body collapse in" aria-expanded="true">
                <div class="card-block">
                    <form action="{{route('admin.setting_store_update')}}" method="post">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="province_name" id="province_name" value="{{$store->province_name}}">
                        <input type="hidden" name="city_name" id="city_name" value="{{$store->districts_name}}">
                        <br>
                            <div class="row">
                                <div class="col-md-6 col-sm-10 col-12">
                                    <div class="form-group">
                                        <label for="store_name">Store Name</label>
                                        <input type="text" id="store_name" class="form-control" name="store_name" value="{!!$store->name!!}">
                                        @error('store_name')
                                            <p class="text-danger">{{$errors->first('store_name')}}</p>
                                        @enderror
                                    </div>
                                </div>                                
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-10 col-12">
                                    <div class="form-group">
                                        <label for="code">Created at</label>
                                        <input type="text" id="code" class="form-control" name="code" value="{{$store->created_at->format('d M Y')}}" readonly>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-10 col-12">
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <input type="text" id="address" class="form-control" name="address" value="{{$store->address}}">
                                        @error('address')
                                            <p class="text-danger">{{$errors->first('address')}}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-10 col-12">
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea name="description" id="description" cols="30" rows="10" class="form-control">
                                            {{$store->store_description}}
                                        </textarea>
                                        @error('description')
                                            <p class="text-danger">{{$errors->first('description')}}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-10 col-12">
                                    <div class="form-group">
                                        <label for="province">Province</label>
                                        <select name="province" id="province" class="form-control">
                                            <option disabled selected>--Choose Province--</option>
                                            @foreach($province->rajaongkir->results as $pRow)
                                            <option value="{{$pRow->province_id}}" {{($store->province_code == $pRow->province_id) ? 'selected':''}}>{{$pRow->province}}</option>
                                            @endforeach
                                        </select>
                                        @error('province')
                                            <p class="text-danger">{{$errors->first('province')}}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-10 col-12">
                                    <div class="form-group">
                                        <label for="city">City</label>
                                        <select name="city" id="city" class="form-control" required>
                                            <option disabled selected>--Choose City--</option>
                                            @isset($cities)
                                                @foreach ($cities->rajaongkir->results as $pCity)
                                                    <option value="{{$pCity->city_id}}" {{($pCity->city_id == $store->districts_code) ? 'selected':''}}>{{$pCity->city_name}}</option>
                                                @endforeach
                                            @endisset
                                        </select>
                                        @error('city')
                                            <p class="text-danger">{{$errors->first('city')}}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md6">
                                    <input type="submit" name="submit" class="btn btn-primary">
                                    <a href="{{route('admin.setting_store')}}" class="btn btn-warning">Back</a>
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
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error('error')
        });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).on('change','#province',function(){
            var html_city='<option disabled selected>-- Choose City --</option>';
            var province_id = $(this).val();
            $.ajax({
                url : 'http://cors-anywhere.herokuapp.com/https://api.rajaongkir.com/starter/city?province='+province_id,
                method : 'get',
                dataType : 'json',
                data : {
                    'key':'4094bed72cb6d0e77f434de0940e68b0'
                },
                success:function(response){
                    data = response.rajaongkir;
                    if(data.status.code == 200){
                        $.each(data.results,function(i,item){
                            html_city += `<option value="` + item.city_id + `">` + item.city_name + `</option>`;
                        });
                        $('#city').html(html_city);
                        $('#province_name').val($('#province').find('option:selected').text());
                    }else{
                        Swal.fire( 'Error!','Error!', 'error');

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
            })
        });
        $(document).on('change','#city',function(){
            $('#province_name').val($('#province').find('option:selected').text());
            $('#city_name').val($('#city').find('option:selected').text());
        });
    });
        
</script>
@endsection