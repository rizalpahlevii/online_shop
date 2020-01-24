@extends('backoffice.layout.template')
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
                                    <h3 class="pink">{{$storeCount->count()}}</h3>
                                    <span>Store</span>
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
                                    <h3 class="teal">{{$memberCount->count()}}</h3>
                                    <span>Member</span>
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
                    <div class="card-header">Penjualan Kategory Tertinggi</div>
                    <div class="card-body collapse in" aria-expanded="true">
                        <div class="card-block">
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="kategoriTertinggi"></div>
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
    <script src="{{asset('assets')}}/highcharts/backofficeChart.js"></script>
@endpush