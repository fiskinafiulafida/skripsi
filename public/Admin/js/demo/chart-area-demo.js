// Set new default font family and font color to mimic Bootstrap's default styling
(Chart.defaults.global.defaultFontFamily = "Nunito"),
  '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = "#858796";

function number_format(number, decimals, dec_point, thousands_sep) {
  // *     example: number_format(1234.56, 2, ',', ' ');
  // *     return: '1 234,56'
  number = (number + "").replace(",", "").replace(" ", "");
  var n = !isFinite(+number) ? 0 : +number,
    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
    sep = typeof thousands_sep === "undefined" ? "," : thousands_sep,
    dec = typeof dec_point === "undefined" ? "." : dec_point,
    s = "",
    toFixedFix = function (n, prec) {
      var k = Math.pow(10, prec);
      return "" + Math.round(n * k) / k;
    };
  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
  s = (prec ? toFixedFix(n, prec) : "" + Math.round(n)).split(".");
  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || "").length < prec) {
    s[1] = s[1] || "";
    s[1] += new Array(prec - s[1].length + 1).join("0");
  }
  return s.join(dec);
}

// Area Chart Example
var ctx = document.getElementById("myAreaChart");
var myLineChart = new Chart(ctx, {
  type: "line",
  data: {
    labels: [
      "Jan",
      "Feb",
      "Mar",
      "Apr",
      "May",
      "Jun",
      "Jul",
      "Aug",
      "Sep",
      "Oct",
      "Nov",
      "Dec",
    ],
    datasets: [
      {
        label: "Produksi telur",
        lineTension: 0.3,
        backgroundColor: "rgba(78, 115, 223, 0.05)",
        borderColor: "rgba(78, 115, 223, 1)",
        pointRadius: 3,
        pointBackgroundColor: "rgba(78, 115, 223, 1)",
        pointBorderColor: "rgba(78, 115, 223, 1)",
        pointHoverRadius: 3,
        pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
        pointHoverBorderColor: "rgba(78, 115, 223, 1)",
        pointHitRadius: 10,
        pointBorderWidth: 2,
        data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
      },
    ],
  },
  options: {
    maintainAspectRatio: false,
    layout: {
      padding: {
        left: 10,
        right: 25,
        top: 25,
        bottom: 0,
      },
    },
    scales: {
      xAxes: [
        {
          time: {
            unit: "date",
          },
          gridLines: {
            display: false,
            drawBorder: false,
          },
          ticks: {
            maxTicksLimit: 7,
          },
        },
      ],
      yAxes: [
        {
          ticks: {
            maxTicksLimit: 5,
            padding: 10,
            // Include a dollar sign in the ticks
            callback: function (value, index, values) {
              return number_format(value);
            },
          },
          gridLines: {
            color: "rgb(234, 236, 244)",
            zeroLineColor: "rgb(234, 236, 244)",
            drawBorder: false,
            borderDash: [2],
            zeroLineBorderDash: [2],
          },
        },
      ],
    },
    legend: {
      display: false,
    },
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      titleMarginBottom: 10,
      titleFontColor: "#6e707e",
      titleFontSize: 14,
      borderColor: "#dddfeb",
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      intersect: false,
      mode: "index",
      caretPadding: 10,
      callbacks: {
        label: function (tooltipItem, chart) {
          var datasetLabel =
            chart.datasets[tooltipItem.datasetIndex].label || "";
          return (
            datasetLabel + " " + number_format(tooltipItem.yLabel)
          );
        },
      },
    },
  },
});

// // Ambil elemen form
// var formFilter = document.getElementById("formFilter");

// // Tambahkan event listener untuk event submit form
// formFilter.addEventListener("submit", function (event) {
//     event.preventDefault(); // Mencegah form untuk melakukan submit

//     // Panggil fungsi untuk memperbarui grafik
//     updateChart();
// });

// var kandang = document.getElementById("kandang").value;
// var tahun = document.getElementById("tahun").value;

// // Kirim permintaan HTTP ke endpoint
// fetch(
//     "{{ route('filterGrafik') }}?tahunProduksi_id=" +
//         tahun +
//         "&kandang_id=" +
//         kandang
// )
//     .then(function (response) {
//         return response.json(); // Mengonversi respons menjadi JSON
//     })
//     .then(function (data) {
//         // Tangani respons dari server

//         // Perbarui data di dalam grafik
//         myLineChart.data.labels = data.map(function (item) {
//             return item.bulan; // Ubah sesuai dengan nama kolom untuk label
//         });
//         myLineChart.data.datasets[0].data = data.map(function (item) {
//             return item.jumlah; // Ubah sesuai dengan nama kolom untuk nilai
//         });

//         // Perbarui grafik
//         myLineChart.update();
//     })
//     .catch(function (error) {
//         // Tangani kesalahan jika ada
//         console.log(error);
//     });

// Ambil elemen form
var formFilter = document.getElementById("formFilter");

// Tambahkan event listener untuk event submit form
formFilter.addEventListener("submit", function (event) {
  event.preventDefault(); // Mencegah form untuk melakukan submit

  // Panggil fungsi untuk memperbarui grafik
  updateChart();
  updateChartPemilik();
});

function updateChart() {
  var kandang = document.getElementById("kandang").value;
  var tahun = document.getElementById("tahun").value;

  // Tentukan URL rute secara langsung
  var url = "/filterGrafik?tahun=" + tahun + "&kandang=" + kandang;

  // Kirim permintaan HTTP ke endpoint
  fetch(url)
    .then(function (response) {
      return response.json(); // Mengonversi respons menjadi JSON
    })
    .then(function (data) {
      // Tangani respons dari server

      // Perbarui data di dalam grafik
      myLineChart.data.labels = data.map(function (item) {
        return item.bulan; // Ubah sesuai dengan nama kolom untuk label
      });
      myLineChart.data.datasets[0].data = data.map(function (item) {
        return item.jumlah; // Ubah sesuai dengan nama kolom untuk nilai
      });

      // Perbarui grafik
      myLineChart.update();
    })
    .catch(function (error) {
      // Tangani kesalahan jika ada
      console.log(error);
    });
}

function updateChartPemilik() {
  var kandang = document.getElementById("kandang").value;
  var tahun = document.getElementById("tahun").value;

  // Tentukan URL rute secara langsung
  var url = "/filterGrafikowner?tahun=" + tahun + "&kandang=" + kandang;

  // Kirim permintaan HTTP ke endpoint
  fetch(url)
    .then(function (response) {
      return response.json(); // Mengonversi respons menjadi JSON
    })
    .then(function (data) {
      // Tangani respons dari server

      // Perbarui data di dalam grafik
      myLineChart.data.labels = data.map(function (item) {
        return item.bulan; // Ubah sesuai dengan nama kolom untuk label
      });
      myLineChart.data.datasets[0].data = data.map(function (item) {
        return item.jumlah; // Ubah sesuai dengan nama kolom untuk nilai
      });

      // Perbarui grafik
      myLineChart.update();
    })
    .catch(function (error) {
      // Tangani kesalahan jika ada
      console.log(error);
    });
}
