function penjualanKategoriTertinggi() {
    $.ajax({
        url: "backoffice/getKategoriTertinggi",
        method: "GET",
        dataType: 'json',
        error: (error) => {
            console.log(error);
        },
        success: (response) => {
            var kategoriTertinggi = Highcharts.chart('kategoriTertinggi', {
                title: {
                    text: 'Penjualan Produk sesuai Kategori'
                },
                xAxis: {
                    categories: response[0]
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
                    data: response[1],
                    showInLegend: false
                }],
                data: {
                    datasets: [{
                        label: 'Penjualan Produk sesuai Kategori',
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
penjualanKategoriTertinggi();
