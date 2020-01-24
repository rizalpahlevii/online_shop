@extends('storeadmin.layout.template')
@section('page','Dashboard')
@section('content')
<div class="content-wrapper">
    <div class="content-header row"></div>
    <div class="content-body">
        <div class="row">
            <div class="col-xl-3 col-lg-6 col-xs-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-block">
                            <div class="media">
                                <div class="media-body text-xs-left">
                                    <h3 class="pink">{{$count['product']}}</h3>
                                    <span>Product</span>
                                </div>
                                <div class="media-right media-middle">
                                    <i class="icon-bag2 pink font-large-2 float-xs-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-xs-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-block">
                            <div class="media">
                                <div class="media-body text-xs-left">
                                    <h3 class="teal">{{$count['transaction']}}</h3>
                                    <span>Transaction</span>
                                </div>
                                <div class="media-right media-middle">
                                    <i class="icon-user1 teal font-large-2 float-xs-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-xs-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-block">
                            <div class="media">
                                <div class="media-body text-xs-left">
                                    <h3 class="deep-orange">64.89 %</h3>
                                    <span>Conversion Rate</span>
                                </div>
                                <div class="media-right media-middle">
                                    <i class="icon-diagram deep-orange font-large-2 float-xs-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-xs-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-block">
                            <div class="media">
                                <div class="media-body text-xs-left">
                                    <h3 class="cyan">423</h3>
                                    <span>Support Tickets</span>
                                </div>
                                <div class="media-right media-middle">
                                    <i class="icon-ios-help-outline cyan font-large-2 float-xs-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Cart Penjualan</div>
                    <div class="card-body collapse in" aria-expanded="true">
                        <div class="card-block">
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="chartPenjualan"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Penjualan Produk Tertinggi</div>
                    <div class="card-body collapse in" aria-expanded="true">
                        <div class="card-block">
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="penjualanProdukTertinggi"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Pengingat Stok</div>
                    <div class="card-body collapse in" aria-expanded="true">
                        <div class="card-block">

                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table" id="tbl-backend">
                                        <thead>
                                            <tr>
                                                <th>Nama Produk</th>
                                                @foreach ($product as $item)
                                                    <td>{{$item->name}}</td>
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th>Stock</th>
                                                @foreach ($product as $item)
                                                    <td><?= ($item->stock < 1) ? '<span class="text-danger">Stok kosong</span>' : $item->stock;?></td>
                                                @endforeach
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
@endsection
@push('script')
    <script type="text/javascript" src="{{url('assets')}}/highcharts/myCharts.js"></script>
    
@endpush