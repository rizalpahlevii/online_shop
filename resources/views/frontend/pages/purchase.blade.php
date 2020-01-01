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

                        <main class="col-md-12">
                            <div class="card">
                                <table class="table table-hover">
                                    <thead >
                                        <tr class="small text-uppercase">
                                            <th scope="col" width="230">Product</th>
                                            <th scope="col" width="120">Quantity</th>
                                            <th scope="col" width="120">Price</th>
                                            <th scope="col" width="120">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $total=0;
                                        @endphp
                                        @foreach(\Cart::getContent() as $row)
                                        @php
                                            $product = App\Product::find($row->id);
                                        @endphp
                                        <tr>
                                            <td>
                                                <figure class="itemside">
                                                    <div class="aside"><img src="{{asset('images/products/')}}/{{$product->image}}" class="img-sm"></div>
                                                    <figcaption class="info">
                                                        <a href="#" class="title text-dark">{{$product->name}}</a>
                                                        <p class="text-muted small">Size: XL, Color: blue, <br> Brand: Gucci</p>
                                                    </figcaption>
                                                </figure>
                                            </td>
                                            <td>
                                                {{$row->quantity}}
                                            </td>
                                            <td> 
                                                <div class="price-wrap"> 
                                                    <var class="price">Rp. {{number_format($product->selling_price)}}</var> 
                                                </div> <!-- price-wrap .// -->
                                            </td>
                                            <td>
                                                @php
                                                    $subtotal = 0;
                                                    $subtotal = $row->quantity*$product->selling_price;
                                                @endphp
                                                <div class="price-wrap"> 
                                                    <var class="price">Rp. {{number_format($subtotal)}}</var> 
                                                </div>
                                            </td>
                                           
                                        </tr>
                                        @php
                                            $total += $subtotal;
                                        @endphp
                                        @endforeach
                                    </tbody>
                                </table>
            
                                {{-- <div class="card-body border-top">
                                    <a href="#" class="btn btn-primary float-md-right" id="make-purchase"> Make Purchase <i class="fa fa-chevron-right"></i> </a>
                                    <a href="{{route('fe.landing')}}" class="btn btn-light"> <i class="fa fa-chevron-left"></i> Continue shopping </a>
                                </div>	 --}}
                            </div> <!-- card.// -->
                        </main>
            </div>
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
                                                                    <option disabled selected value="">--Pilih Provinsi--</option>
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
                                                                    <option disabled selected value="">--Pilih Kabupaten--</option>
                                                                   
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="courier">Kurir</label>
                                                                <select name="courier" id="courier" class="form-control">
                                                                    <option disabled selected value="">--Pilih Kurir--</option>
                                                                   
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
                                    <div class="row kotak-pilih-kurir" style="display:none;">
                                        <div class="col-md-12">
                                            <label for="lb-kurir">Pilih Kurir</label>
                                            <select name="opt-kurir" id="opt-kurir"  class="form-control">
                                            </select>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </main>
                        <input type="hidden" id="member_id" value="{{Auth::user()->id}}">
                        <main class="col-md-12 mt-2">
                            <div class="card">
                                <h6 class="ml-3 mt-2">Total</h6>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="value-item">Item</label>
                                                <input type="text" name="value-item" id="value-item" class="form-control" readonly data-value="{{$total}}" value="{{$total}}">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="value-ongkir">Ongkir</label>
                                                <input type="text" name="value-ongkir" id="value-ongkir" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="value-total">Total</label>
                                                <input type="text" name="value-total" id="value-total" class="form-control" readonly data-value="{{$total}}" value="{{'Rp. '.number_format($total)}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-1 kotak-checkout" style="display:none;">
                                        <div class="col-md-12">
                                            <button id="btn-checkout" class="btn btn-primary">Checkout</button>
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
                $('#tmp_courier').val('');
                $('#load-asal-tujuan').html('');
                $('#load-type').html('');
                $('.kotak-pilih-kurir').css('display','none');
                $('#opt-kurir').html('');
                $('#value-ongkir').val(0);
                $('#value-total').val($('#value-item').data('value'));
                var html_city='<option disabled selected value="">-- Choose City --</option>';
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
                        Swal.close();
                    },
                    beforeSend:function(){
                        Swal.fire({
                            title: 'Loading .....',
                            allowEscapeKey: false,
                            allowOutsideClick: false,
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
                $('#tmp_courier').val('');
                $('#load-asal-tujuan').html('');
                $('#load-type').html('');
                $('.kotak-pilih-kurir').css('display','none');
                $('#opt-kurir').html('');
                $('#value-ongkir').val(0);
                $('#value-total').val($('#value-item').data('value'));
                var html_courier = '<option disabled selected value="">-- Pilih Kurir --</option>';
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
                            Swal.close();
                        }
                    },
                    beforeSend:function(){
                        Swal.fire({
                            title: 'Loading .....',
                            allowEscapeKey: false,
                            allowOutsideClick: false,
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
            $('#courier').change(function(){
                $('#tmp_courier').val('');
                $('#load-asal-tujuan').html('');
                $('#load-type').html('');
                $('.kotak-pilih-kurir').css('display','none');
                $('#opt-kurir').html('');
                $('#value-ongkir').val(0);
                $('#value-total').val($('#value-item').data('value'));
            });
            $('#btn-cek-ongkir').click(function(){
                const kabupaten = $('#kabupaten').val();
                const province = $('#province').val();
                const courier = $('#courier').val();
                if(kabupaten == null || province == null ||courier == null){
                    Swal.fire('Error!','Form error!','error');
                }else{
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
                                htmlLoadAsalTujuan += `<td id="td-weight">`+data.query.weight+`</td>`;
                                $('#load-asal-tujuan').html(htmlLoadAsalTujuan);
                            
                                $.each(data.results[0].costs,function(i,item){
                                    htmlType += `<tr><td>`+item.service+`</td><td>`+item.description+`</td><td>`+item.cost[0].etd+` Hari</td><td>Rp. `+item.cost[0].value+`</td></tr>`
                                });
                                $('#load-type').html(htmlType);
                                loadOptionCourier(data);
                                Swal.close();
                            }else{
                                Swal.fire('error','Error!','error');
                            }
                        },
                        beforeSend:function(){
                            Swal.fire({
                                title: 'Loading .....',
                                allowEscapeKey: false,
                                allowOutsideClick: false,
                                onOpen: () => {
                                    Swal.showLoading()
                                }
                            })
                        },
                        error:function(request,status,error){
                            Swal.fire( 'Error!',request.responseText, 'error');
                        }
                    })
                }
            });
            function loadOptionCourier(data){
                var html_option_courier = '';
                cost_length = data.results[0].costs.length;
                console.log(cost_length);
                $.each(data.results[0].costs,function(i,item){
                    if( cost_length > 1){
                        html_option_courier += `
                        <option value="`+item.service+`" data-service="`+ item.service +`" data-description="`+ item.description +`" data-etd="`+item.cost[0].etd+`" data-value="`+item.cost[0].value+`" >` + item.service + ` - `+ item.description +`</option>
                        `;
                    }else{
                        html_option_courier += `
                        <option value="`+item.service+`" data-service="`+ item.service +`" data-description="`+ item.description +`" data-etd="`+item.cost[0].etd+`" data-value="`+item.cost[0].value+`" selected>` + item.service + ` - `+ item.description +`</option>
                        `;
                        subItem = $('#value-item').data('value');
                        resultSum = parseInt(item.cost[0].value) + parseInt(subItem);
                        $('#value-ongkir').val(item.cost[0].value);
                        $('#value-total').val(resultSum);
                    }
                });
                $('.kotak-pilih-kurir').css('display','block');
                $('.kotak-checkout').css('display','block');
                $('.kotak-pilih-kurir').addClass('mb-2');
                $('#opt-kurir').html(html_option_courier);
            }
            $('#btn-checkout').click(function(){
                if($('#opt-kurir') == null){
                    Swal.fire('Error!','Form error!','error');
                }else{
                    var address = {
                        member_id : $('#member_id').val(),
                        provinceCode : $('#province').val(),
                        provinceName : $('#province_name').val(),
                        kabupatenCode : $('#kabupaten').val(),
                        kabupatenName : $('#kabupaten_name').val(),
                        courier_code : $('#courier').val(),
                        detail : $('#detail').val()
                    };
                    var courier = {
                        courier_name : $('#tmp_courier').val(),
                        weight : $('#td-weight').html(),
                        service : $('#opt-kurir').find('option:selected').data('service'),
                        description : $('#opt-kurir').find('option:selected').data('description'),
                        etd : $('#opt-kurir').find('option:selected').data('etd'),
                        value : $('#opt-kurir').find('option:selected').data('value')
                    };
                    
                    $.ajax({
                        url : "{{route('checkout')}}",
                        method : "POST",
                        dataType : "json",
                        data : {
                            address : JSON.stringify(address),
                            courier : JSON.stringify(courier),
                        },
                        success:function(response){
                            Swal.close();
                            console.log(response);
                            if(response[0] = 'sukses'){
                                Swal.fire( 'Success!','Transaksi Sukses', 'success').then(function(){
                                    // location.href = "{{route('fe.invoice_view',"+ response[1] +")}}";
                                    location.href = "{{url('/invoice/')}}"+"/"+response[1] + "/detail";
                                });
                            }else{
                                Swal.fire( 'Success!','Transaksi Sukses', 'error').then(function(){
                                    location.reload();
                                });
                            }
                        },
                        beforeSend:function(){
                            Swal.fire({
                                title: 'Loading .....',
                                allowEscapeKey: false,
                                allowOutsideClick: false,
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
            $(document).on('change','#opt-kurir',function(){
                ongkir = $(this).find('option:selected').data('value');
                subItem = $('#value-item').data('value');
                result = parseInt(ongkir) + parseInt(subItem);
                $('#value-ongkir').val(ongkir);
                $('#value-total').val(result);
            });
            function rupiah(angka){
                var reverse = angka.toString().split('').reverse().join(''),
                ribuan = reverse.match(/\d{1,3}/g);
                ribuan = ribuan.join('.').split('').reverse().join('');
                return ribuan;
            }
        });
    </script>
@endsection