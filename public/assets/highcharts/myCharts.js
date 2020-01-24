function ajaxChartPenjualan() {
    $.ajax({
        url: "admin/getChartPenjualan",
        method: "GET",
        dataType: "json",
        error: (error) => {
            console.log(error)
        },
        success: (response) => {
            var chart = Highcharts.chart('chartPenjualan', {
                title: {
                    text: 'Grafik Pendapatan'
                },
                xAxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                },
                yAxis: {
                    labels: {
                        formatter: function () {
                            return this.value;
                        }
                    }
                },
                series: [{
                    type: 'column',
                    data: response,
                    showInLegend: false
                }]

            });


            $('#plain').click(function () {
                chart.update({
                    chart: {
                        inverted: false,
                        polar: false
                    },
                    subtitle: {
                        text: 'Plain'
                    }
                });
            });

            $('#inverted').click(function () {
                chart.update({
                    chart: {
                        inverted: true,
                        polar: false
                    },
                    subtitle: {
                        text: 'Inverted'
                    }
                });
            });

            $('#polar').click(function () {
                chart.update({
                    chart: {
                        inverted: false,
                        polar: true
                    },
                    subtitle: {
                        text: 'Polar'
                    }
                });
            });
        }
    });
}

function ajaxPenjualanProdukTertinggi() {
    $.ajax({
        url: "admin/getPenjualanProdukTertinggi",
        method: "GET",
        dataType: "json",
        error: (error) => {
            console.log(error);
        },
        success: (response) => {
            product = response[0];
            price = response[1];
            var chartPenjualanProdukTertinggi = Highcharts.chart('penjualanProdukTertinggi', {
                title: {
                    text: 'Penjualan Produk Tertinggi'
                },
                xAxis: {
                    categories: product
                },
                yAxis: {
                    labels: {
                        formatter: function () {
                            return this.value;
                        }
                    }
                },
                series: [{
                    type: 'column',
                    data: price,
                    showInLegend: false
                }],
                data: {
                    datasets: [{
                        label: 'Penjualan Product Tertinggi',
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255,99,132,1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                }

            });
        }
    });
}
ajaxChartPenjualan();
ajaxPenjualanProdukTertinggi();
