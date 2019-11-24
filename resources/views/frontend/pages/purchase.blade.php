@extends('frontend.layout.template')
@section('page','Purchase')
@section('content')
    <section class="section-pagetop bg">
        <div class="container">
            <h2 class="title-page">Purchase</h2>
        </div>
    </section>
    <section class="section-content padding-y">
        <div class="container">
            <input type="hidden" id="province_name">
            <input type="hidden" id="kabupaten_name">
                <div class="row mb-2">
                    <div class="col-md-7">

                        <div class="row">
                                <main class="col-md-12">
                                        <div class="card">
                                            <h6 class="ml-3 mt-2">Detail Member</h6>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="member_name">Name</label>
                                                            <input type="text" name="member_name" id="member_name" class="form-control" value="{{Auth::user()->name}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="member_email">Email</label>
                                                            <input type="text" name="member_email" id="member_email" class="form-control" value="{{Auth::user()->email}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="member_telp">Telephone</label>
                                                            <input type="text" name="member_telp" id="member_telp" class="form-control" value="{{Auth::user()->phone}}">
                                                        </div>
                    
                                                    </div>
                                                </div>
                    
                                            </div>
                                        </div>
                                </main>
                                <main class="col-md-12 mt-2">
                                            <div class="card">
                                                <h6 class="ml-3 mt-2">Alamat</h6>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="province">Provinsi</label>
                                                                <select name="province" id="province" class="form-control">
                                                                    <option disabled selected>--Pilih Provinsi--</option>
                                                                    @foreach ($province as $rowP)
                                                                        <option value="{{$rowP->province_id}}">{{$rowP->province}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="kabupaten">Kabupaten</label>
                                                                <select name="kabupaten" id="kabupaten" class="form-control">
                                                                    <option disabled selected>--Pilih Kabupaten--</option>
                                                                   
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="courier">Kurir</label>
                                                                <select name="courier" id="courier" class="form-control">
                                                                    <option disabled selected>--Pilih Kurir--</option>
                                                                   
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label for="detail">Detail</label>
                                                            <div class="form-group"><textarea name="detail" id="detail" cols="30" rows="7" class="form-control"></textarea></div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <input type="button" class="btn btn-primary float-right" id="btn-cek-ongkir" value="Cek Ongkir">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </main>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <main class="col-md-12">
                            <div class="card">
                                <h6 class="ml-3 mt-2">Ongkos Kirim</h6>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="tmp_courier">Kurir</label>
                                                <input type="text" name="tmp_courier" id="tmp_courier" class="form-control" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table table-bordered">
                                                <tr>
                                                    <th>Asal</th>
                                                    <th>Tujuan</th>
                                                    <th>Berat (Gram)</th>
                                                </tr>
                                                <tr id="load-asal-tujuan"></tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table table-bordered" id="tbl-type">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th>Paket</th>
                                                        <th>Deskripsi</th>
                                                        <th>Lama Pengiriman</th>
                                                        <th>Ongkir (Rp)</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="load-type">

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </main>
                    </div>
                </div>
        </div>
    </section>
    <script>
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(document).on('change','#province',function(){
                var html_city='<option disabled selected>-- Choose City --</option>';
                var province_id = $(this).val();
                $.ajax({
                    url : "{{route('getCityProvince')}}",
                    method : 'POST',
                    dataType : 'json',
                    data : {
                        province_id:province_id
                    },
                    success:function(response){
                        data = response.rajaongkir;
                        $.each(data.results,function(i,item){
                            html_city += `<option value="` + item.city_id + `">` + item.city_name + `</option>`;
                        });
                        $('#kabupaten').html(html_city);
                        $('#province_name').val($('#province').find('option:selected').text());

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
            $(document).on('change','#kabupaten',function(){
                var html_courier = '<option disabled selected>-- Pilih Kurir --</option>';
                $('#province_name').val($('#province').find('option:selected').text());
                $('#kabupaten_name').val($('#kabupaten').find('option:selected').text());
                $.ajax({
                    url : "{{route('get_courier')}}",
                    method : "POST",
                    dataType : "json",
                    success:function(response){
                        data = response.results;
                        if(data.status = 200){
                            $.each(data, function(i,item){
                                html_courier += `<option value="`+ item.courier.code +`">`+item.courier.code+` - `+item.courier.title+`</option>`
                            })
                            $('#courier').html(html_courier);
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
            $('#btn-cek-ongkir').click(function(){
                $.ajax({
                    url : "{{route('cek_ongkir')}}",
                    method : "POST",
                    dataType : "json",
                    data : {
                        province_code : $('#province').val(),
                        province_name : $('#province_name').val(),
                        kabupaten_code : $('#kabupaten').val(),
                        kabupaten_name : $('#kabupaten_name').val(),
                        courier : $('#courier').val(),
                    },
                    success:function(response){
                        data = response.rajaongkir;
                        console.log(data);
                        if(data.status = 200){
                            $('#tmp_courier').val(data.results[0].name);
                            htmlLoadAsalTujuan = '';
                            htmlType = '';
                            htmlLoadAsalTujuan += `<td>`+data.origin_details.city_name+`</td>`;
                            htmlLoadAsalTujuan += `<td>`+data.destination_details.city_name+`</td>`;
                            htmlLoadAsalTujuan += `<td>`+data.query.weight+`</td>`;
                            $('#load-asal-tujuan').html(htmlLoadAsalTujuan);
                           
                            $.each(data.results[0].costs,function(i,item){
                                htmlType += `<tr><td></td><td>`+item.service+`</td><td>`+item.description+`</td><td>`+item.cost[0].etd+` Hari</td><td>Rp. `+item.cost[0].value+`</td></tr>`
                            });
                            $('#load-type').html(htmlType);
                        }else{
                            Swal.fire('error','Error!','error');
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
            })
        });
    </script>
@endsection