@extends('backoffice.layout.template')
@section('page','Create User')
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
                <h4 id="basic-forms" class="card-title">Store Create</h4>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
                        <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="card-body collapse in" aria-expanded="true">
                <div class="card-block">
                    <form action="{{route('backoffice.store_store')}}" method="post">
                            @csrf
                            <input type="hidden" name="province_name" id="province_name">
                            <input type="hidden" name="city_name" id="city_name">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" id="name" class="form-control" placeholder="Name" name="name" value="{{old('name')}}">
                                        @error('name')
                                            <p class="text-danger">{{$errors->first('name')}}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="user">Users</label>
                                        <select name="user" id="user" class="form-control">
                                            <option disabled selected>-- Choose Users Store --</option>
                                            @foreach ($users as $item)
                                                <option value="{{$item['id']}}">{{$item['name']}}</option>
                                            @endforeach
                                        </select>
                                        @error('user')
                                            <p class="text-danger">{{$errors->first('user')}}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
        
                                    <div class="form-group">
                                        <label for="province">Province</label>
                                        <select name="province" id="province" class="form-control" required>
                                            <option disabled selected>-- Choose Province --</option>
                                            @foreach ($provinces['rajaongkir']['results'] as $rowP)
                                                <option value="{{$rowP['province_id']}}">{{$rowP['province']}}</option>
                                            @endforeach
                                        </select>
                                        @error('province')
                                            <p class="text-danger">{{$errors->first('province')}}</p>
                                        @enderror
                                    </div>
                                    
                                </div>
                                <div class="col-md-4">
        
                                    <div class="form-group">
                                        <label for="city">City</label>
                                        <select name="city" id="city" class="form-control @error('city') is-invalid @enderror" required>
                                            <option disabled selected>-- Choose City --</option>
                                            
                                        </select>
                                        
                                        @error('city')
                                            <p class="text-danger">{{$errors->first('city')}}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
                                        @error('description')
                                            <p class="text-danger">{{$errors->first('description')}}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <textarea name="address" id="address" cols="30" rows="10" class="form-control"></textarea>
                                        @error('address')
                                            <p class="text-danger">{{$errors->first('address')}}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="postal_code">Postal Code</label>
                                        <input type="text" name="postal_code" id="postal_code" class="form-control">
                                        @error('postal_code')
                                            <p class="text-danger">{{$errors->first('postal_code')}}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="submit" name="submit" id="submit" class="btn btn-info">
                                    <a href="{{route('backoffice.user_index')}}" class="btn btn-warning">Back</a>
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
        ClassicEditor
            .create(document.querySelector('#address'))
            .catch(error => {
                console.error('error')
            });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).on('change','#province',function(){
            $('#city').html('<option disabled selected>-- Choose City --</option>');
            $.ajax({
                url : "{{route('getCityProvince')}}",
                method : "POST",
                dataType : "json",
                data : {
                    province_id : $(this).val()
                },
                success:function(response){
                    data = response.rajaongkir.results;
                    html_city = '<option disabled selected>-- Choose City -- </option>';
                    $.each(data,function(i,item){
                        html_city += `<option value="` + item.city_id + `" data-postal="`+item.postal_code+`">` + item.city_name + `</option>`;
                    });
                    $('#city').html(html_city);
                },
                error:function(error){
                    alert(error);
                }
            })
        });
        $(document).on('click','#city',function(){
            $('#province_name').val($('#province').find('option:selected').text());
            $('#city_name').val($('#city').find('option:selected').text());
            $('#postal_code').val($('#city').find('option:selected').data('postal'));
        });
    });
</script>
@endsection