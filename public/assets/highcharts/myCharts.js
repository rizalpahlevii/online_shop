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
ajaxChartPenjualan();
