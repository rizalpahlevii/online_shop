const ctx = document.getElementById('chartPenjualan').getContext('2d');

function ajaxChartPenjualan() {
    $.ajax({
        url: "admin/getChartPenjualan",
        method: "GET",
        dataType: "json",
        error: (error) => {
            console.log(error)
        },
        success: (response) => {
            const chartPenjualan = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['January', 'February', 'March', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                    datasets: [{
                        label: 'Chart Penjualan',
                        data: response,

                        borderColor: [
                            "#111", "#111", "#111", "#111", "#111"
                        ],
                        borderWith: 1
                    }],

                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        }
    });
}
ajaxChartPenjualan();
