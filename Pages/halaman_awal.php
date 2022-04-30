<!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h2 class="h4 mb-0 text-gray-800">Dashboard Admin</h2>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="">Dashboard</li>
            </ol>
          </div>
          <?php
              if(isset($_GET['notif'])){
                if($_GET['notif']=="login-sukses"){
                  echo "<div class='alert alert-success alert-dismissible'>
                        <a style='text-decoration:none;' href='dashboard.php?p=halaman_awal' type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</a>
                          <i class='icon fa fa-check'></i> Anda Berhasil Login.</b>
                        </div>";
                }
              }
              ?>

          <div class="row mb-12">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-12 col-md-6 mb-4">
              <div class="card mb-12">
                <div class="card-body" style="text-align: center;">
                  <h4>Selamat Datang Di Sistem Peramalan Penjualan Pada Toko Citra</h4>
                </div>
              </div>
            </div>
            </div>
          <div class="row mb-12">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-12 col-md-6 mb-4">
              <div class="card mb-12">
                <div class="card-body" style="text-align: center;">
                  <?php
                  //koneksi
                  include"koneksi.php";

                  //untuk mengambil nilai pencapaian solo
                  $sql_aktual="select hasil from tbl_grafik where status='Aktual'";
                  $query_aktual=mysqli_query($connect,$sql_aktual);

                  //untuk mengambil nilai pencapaian jakarta
                  $sql_ramal="select hasil from tbl_grafik where status='Forecast'";
                  $query_ramal=mysqli_query($connect,$sql_ramal);

                  //untuk mengambil bulan dari januari sampai juni
                  $sql_label="select * from tbl_grafik Group by bulan order by id_grafik ";
                  $query_label=mysqli_query($connect,$sql_label);
                  ?>
                  <h4>Grafik Perbandingan Aktual Dan Forecast</h4>
                  <canvas id="kotaChart"></canvas>
                  <script src="chart/Chart.min.js"></script>
                    <script>
                      var kotaCanvas = document.getElementById("kotaChart");

                      Chart.defaults.global.defaultFontFamily = "Lato";
                      Chart.defaults.global.defaultFontColor = "black";
                      Chart.defaults.global.defaultFontSize = 12;

                      var dataFirst = {
                          label: "Aktual",
                          data: [<?php foreach($query_aktual as $key){  echo  '"'.$key['hasil'].'",';}?> ],
                          lineTension: 0.3,
                          fill: false,
                          borderColor: 'red',
                          backgroundColor: 'transparent',
                          pointBorderColor: 'red',
                          pointBackgroundColor: 'red',
                          pointRadius: 5,
                          pointHoverRadius: 7,
                          pointHitRadius: 7,
                          pointBorderWidth: 2,
                          pointStyle: 'rect'
                        };

                      var dataSecond = {
                          label: "Forecast",
                          data: [<?php foreach($query_ramal as $key){  echo  '"'.$key['hasil'].'",';}?> ],
                          lineTension: 0.3,
                          fill: false,
                          borderColor: 'blue',
                          backgroundColor: 'transparent',
                          pointBorderColor: 'blue',
                          pointBackgroundColor: 'blue',
                          pointRadius: 5,
                          pointHoverRadius: 7,
                          pointHitRadius: 7,
                          pointBorderWidth: 2,
                          pointStyle: 'cross'
                        };

                      var kotaData = {
                        labels:  [<?php foreach($query_label as $key){  echo  '"'.$key['bulan'].'",';}?> ] ,
                        datasets: [dataFirst, dataSecond]
                      };

                      var chartOptions = {
                        legend: {
                          display: true,
                          position: 'top',
                          labels: {
                            boxWidth: 80,
                            fontColor: 'black'
                          }
                        },
                        scales: {
                               yAxes: [{
                                   ticks: {
                                       beginAtZero: true,
                                       userCallback: function(label, index, labels) {
                                           // when the floored value is the same as the value we have a whole number
                                           if (Math.floor(label) === label) {
                                               return label;
                                           }

                                       },
                                   }
                               }],
                               xAxes: [{
                              ticks: {
                                autoSkip: false,
                                maxRotation: 90,
                                minRotation: 0,
                              }
                            }]
                               
                           },

                          
                      };

                      var lineChart = new Chart(kotaCanvas, {
                        type: 'line',
                        data: kotaData,
                        options: chartOptions
                      });

                          </script>
                </div>
              </div>
            </div>
          </div>
        </div>
        </div>
      </div>
    </div>
  </div>
        <!---Container Fluid-->