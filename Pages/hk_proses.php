      <div class="container-fluid" id="container-wrapper">
          <div class="row mb-12">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-12 col-md-6 mb-4">
               <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Form Hasil Peramalan Barang</h6>
            </div>
          <div class="card-body" style="overflow: auto;">
           <table class="table table-bordered" style="font-size: 12px;">
            <thead>
              <th>ID Barang-Nama Barang</th>
              <th>Tanggal</th>
              <th>Bulan</th>
              <th>Jml. Bln</th>
              <th>Ttl. Qty</th>
              <th>Ttl. XY</th>
              <th>Ttl. X^2</th>
              <th>Slope (b)</th>
              <th>Intercept (a)</th>
              <th>Forecast</th>
              <th>RSFE</th>
              <th>Error</th>
              <th>MAD</th>
            </thead>
            <tbody>
          <?php
          if (isset($_POST['kode_barang'])) {
                include"koneksi.php";
                $periode=$_POST['periode'];
                if (isset($_POST['simpan'])){
                foreach ($_POST['kode_barang'] as $value) {
              $cek_a = mysqli_query($connect, "SELECT * FROM tbl_training WHERE bulan = '$periode' AND kode_barang = '$value'");
                $result_a = mysqli_num_rows($cek_a);
                $data_a = mysqli_fetch_array($cek_a);
                if ($result_a > 0) {
                  echo "<script>alert('Opss!, Salah Satu / Beberapa Barang Yang Anda Pilih Sudah Terdaftar Untuk Periode Peramalan Yang Anda Pilih');
                  document.location.href='dashboard.php?p=input_hk'</script>\n";
                }else{
                  $query="SELECT * FROM tbl_barang WHERE kode_barang='$value'";
                  $sql=mysqli_query($connect, $query);
                  while ($data=mysqli_fetch_array($sql)) {
                    echo"<tr>";
                    echo"<td>".$data['kode_barang']."-".$data['nama_barang']."</td>";
                    echo"<td>".date('Y-m-d')."</td>";
                    echo"<td>".$periode."</td>";

                    $query_beli="SELECT SUM(bulan) AS x FROM tbl_training WHERE kode_barang='".$data['kode_barang']."'";
                    $sql_beli=mysqli_query($connect, $query_beli);
                    $data_beli=mysqli_fetch_array($sql_beli);
                    $x=$data_beli['x'];
                    echo"<td>".$x."</td>";

                    $query_y="SELECT SUM(qty) AS y FROM tbl_training WHERE kode_barang='".$data['kode_barang']."'";
                    $sql_y=mysqli_query($connect, $query_y);
                    $data_y=mysqli_fetch_array($sql_y);
                    $y=$data_y['y'];
                    echo"<td>".$y."</td>";

                    $query_xy="SELECT SUM(xy) AS ttl FROM tbl_training WHERE kode_barang='".$data['kode_barang']."'";
                    $sql_xy=mysqli_query($connect, $query_xy);
                    $data_xy=mysqli_fetch_array($sql_xy);
                    $xy=$data_xy['ttl'];
                    echo"<td>".$xy."</td>";

                    $query_x2="SELECT SUM(x2) AS ttl FROM tbl_training WHERE kode_barang='".$data['kode_barang']."'";
                    $sql_x2=mysqli_query($connect, $query_x2);
                    $data_x2=mysqli_fetch_array($sql_x2);
                    $x2=$data_x2['ttl'];
                    echo"<td>".$x2."</td>";  

                    $n = $periode - 1;

                    $b = (($n * $xy) - ($x * $y)) / (($n * $x2) - ($x * $x));

                    echo"<td>".$b."</td>"; 

                    $a = ($y - ($b * $x)) / $n;

                    echo"<td>".floor($a)."</td>";

                    $forecast = $a + ($b * $periode);

                    echo"<td>".floor($forecast)."</td>";

                    $query_rsfe="SELECT SUM(rsfe) AS tr FROM tbl_training WHERE kode_barang='".$data['kode_barang']."'";
                    $sql_rsfe=mysqli_query($connect, $query_rsfe);
                    $data_rsfe=mysqli_fetch_array($sql_rsfe);
                    $rsfe=$data_rsfe['tr'];
                    echo"<td>".$rsfe."</td>";

                    $query_error="SELECT SUM(error) AS ter FROM tbl_training WHERE kode_barang='".$data['kode_barang']."'";
                    $sql_error=mysqli_query($connect, $query_error);
                    $data_error=mysqli_fetch_array($sql_error);
                    $error=$data_error['ter'];
                    echo"<td>".$error."</td>";

                    $md = $periode - 3;
                    $mad = $error / $md;

                    echo"<td>".$mad."</td>";

                    
                    echo"<tr>";
                    
                  }
                }
                
              }
            }else{
              echo "<script>alert('Opss!, Nama Barang Belum Dipilih');
              document.location.href='dashboard.php?p=input_hk'</script>\n";
            }
          }
      ?>
    </tbody>
  </table>
            <form method='post' action='proses_simpan_hk.php'>
              <div class="box-body" style="height:10px; overflow: auto;">
          <?php
          if (isset($_POST['kode_barang'])) {
                include"koneksi.php";
                $periode=$_POST['periode'];
                if (isset($_POST['simpan'])){
                foreach ($_POST['kode_barang'] as $value) {
                  $query="SELECT * FROM tbl_barang WHERE kode_barang='$value'";
                  $sql=mysqli_query($connect, $query);
                  while ($data=mysqli_fetch_array($sql)) {
                    echo"<div class='row'>";
                        echo"<div class='col-sm-6'>";
                          echo"<div class='form-group'>";
                          echo"<label>Kode Barang</label>";
                            echo"<input type='text' name='id[]' readonly='readonly' class='form-control' value='".$data['kode_barang']."'>";
                          echo"</div>";
                        echo"</div>";
                        echo"<div class='col-sm-6'>";
                          echo"<div class='form-group'>";
                          echo"<label>Nama</label>";
                            echo"<input name='nama[]' type='text' readonly='readonly' class='form-control' value='".$data['nama_barang']."'>";
                          echo"</div>";
                        echo"</div>";
                      echo"</div>";
                      echo"<div class='row'>";
                        echo"<div class='col-sm-4'>";
                          echo"<div class='form-group'>";
                          echo"<label>Tgl</label>";
                            echo"<input type='text' name='tgl[]' readonly='readonly' value='".date('Y-m-d')."' class='form-control' required='required'>";
                          echo"</div>";
                        echo"</div>";
                        echo"<div class='col-sm-4'>";
                          echo"<div class='form-group'>";
                          echo"<label>Periode</label>";
                          echo"<input type='text' name='periode[]' readonly='readonly' value='".$periode."' class='form-control' required='required'>";
                          echo"</div>";
                        echo"</div>";
                      echo"</div>";
                      $query_beli="SELECT SUM(bulan) AS x FROM tbl_training WHERE kode_barang='".$data['kode_barang']."'";
                    $sql_beli=mysqli_query($connect, $query_beli);
                    $data_beli=mysqli_fetch_array($sql_beli);
                    $x=$data_beli['x'];

                    $query_y="SELECT SUM(qty) AS y FROM tbl_training WHERE kode_barang='".$data['kode_barang']."'";
                    $sql_y=mysqli_query($connect, $query_y);
                    $data_y=mysqli_fetch_array($sql_y);
                    $y=$data_y['y'];

                    $query_xy="SELECT SUM(xy) AS ttl FROM tbl_training WHERE kode_barang='".$data['kode_barang']."'";
                    $sql_xy=mysqli_query($connect, $query_xy);
                    $data_xy=mysqli_fetch_array($sql_xy);
                    $xy=$data_xy['ttl'];

                    $query_x2="SELECT SUM(x2) AS ttl FROM tbl_training WHERE kode_barang='".$data['kode_barang']."'";
                    $sql_x2=mysqli_query($connect, $query_x2);
                    $data_x2=mysqli_fetch_array($sql_x2);
                    $x2=$data_x2['ttl'];  

                    echo"<div class='row'>";
                        echo"<div class='col-sm-4'>";
                          echo"<div class='form-group'>";
                          echo"<label>Ttl. Bln</label>";
                            echo"<input type='text' name='bln[]' readonly='readonly' class='form-control' value='".$x."'>";
                          echo"</div>";
                        echo"</div>";
                        echo"<div class='col-sm-4'>";
                          echo"<div class='form-group'>";
                          echo"<label>Ttl. Qty</label>";
                            echo"<input type='text' name='qty[]' readonly='readonly' class='form-control' value='".$y."'>";
                          echo"</div>";
                        echo"</div>";
                        echo"<div class='col-sm-4'>";
                          echo"<div class='form-group'>";
                          echo"<label>Ttl. XY</label>";
                            echo"<input type='text' name='xy[]' readonly='readonly' class='form-control' value='".$xy."'>";
                          echo"</div>";
                        echo"</div>";
                        echo"<div class='col-sm-4'>";
                          echo"<div class='form-group'>";
                          echo"<label>Ttl. X^2</label>";
                            echo"<input type='text' name='x2[]' readonly='readonly' class='form-control' value='".$x2."'>";
                          echo"</div>";
                        echo"</div>";
                      echo"</div>";
                      
                    $n = $periode - 1;

                    $b = (($n * $xy) - ($x * $y)) / (($n * $x2) - ($x * $x));

                    echo"<div class='row'>";
                        echo"<div class='col-sm-4'>";
                          echo"<div class='form-group'>";
                          echo"<label>Slope (b)</label>";
                            echo"<input type='text' name='slope[]' readonly='readonly' class='form-control' value='".$b."'>";
                          echo"</div>";
                        echo"</div>";
                         $a = ($y - ($b * $x)) / $n;
                        echo"<div class='col-sm-4'>";
                          echo"<div class='form-group'>";
                          echo"<label>Intercept (a)</label>";
                            echo"<input type='text' name='intercept[]' readonly='readonly' class='form-control' value='".floor($a)."'>";
                          echo"</div>";
                        echo"</div>";
                      echo"</div>";

                    $forecast = $a + ($b * $periode);

                    $query_rsfe="SELECT SUM(rsfe) AS tr FROM tbl_training WHERE kode_barang='".$data['kode_barang']."'";
                    $sql_rsfe=mysqli_query($connect, $query_rsfe);
                    $data_rsfe=mysqli_fetch_array($sql_rsfe);
                    $rsfe=$data_rsfe['tr'];

                    $query_error="SELECT SUM(error) AS ter FROM tbl_training WHERE kode_barang='".$data['kode_barang']."'";
                    $sql_error=mysqli_query($connect, $query_error);
                    $data_error=mysqli_fetch_array($sql_error);
                    $error=$data_error['ter'];

                      echo"<div class='row'>";
                        echo"<div class='col-sm-4'>";
                          echo"<div class='form-group'>";
                          echo"<label>Forecast</label>";
                            echo"<input type='text' name='forecast[]' readonly='readonly' class='form-control' value='".floor($forecast)."'>";
                          echo"</div>";
                        echo"</div>";
                        echo"<div class='col-sm-4'>";
                          echo"<div class='form-group'>";
                          echo"<label>RSFE</label>";
                            echo"<input type='text' name='rsfe[]' readonly='readonly' class='form-control' value='".$rsfe."'>";
                          echo"</div>";
                        echo"</div>";
                        echo"<div class='col-sm-4'>";
                          echo"<div class='form-group'>";
                          echo"<label>Error</label>";
                            echo"<input type='text' name='error[]' readonly='readonly' class='form-control' value='".$error."'>";
                          echo"</div>";
                        echo"</div>";
                        $md = $periode - 3;
                        $mad = $error / $md;
                        echo"<div class='col-sm-4'>";
                          echo"<div class='form-group'>";
                          echo"<label>MAD</label>";
                            echo"<input type='text' name='mad[]' readonly='readonly' class='form-control' value='".$mad."'>";
                          echo"</div>";
                        echo"</div>";
                      echo"</div>";

                      $query2="INSERT INTO `tbl_training` (`id_training`, `kode_barang`, `nama_barang`, `bulan`, `qty`, `xy`, `x2`, `forecast`, `rsfe`, `error`) VALUES ('', '$value', '".$data['nama_barang']."', '$periode', '$y', '$xy', '$x2', '".floor($forecast)."', '$rsfe', '$error')";
                      $sql2=mysqli_query($connect, $query2);

                    }
                }
              }
              $query_aktual="SELECT SUM(qty) AS aktual FROM tbl_training";
              $sql_aktual=mysqli_query($connect, $query_aktual);
              $data_aktual=mysqli_fetch_array($sql_aktual);
              $aktual=$data_aktual['aktual'];

              $query1 = "INSERT INTO `tbl_grafik` (`id_grafik`, `bulan`, `hasil`, `status`) VALUES ('', '$periode', '$aktual', 'Aktual')";
              $sql1 = mysqli_query($connect, $query1);

              $query_forecast="SELECT SUM(forecast) AS ramal FROM tbl_training";
              $sql_forecast=mysqli_query($connect, $query_forecast);
              $data_forecast=mysqli_fetch_array($sql_forecast);
              $ramal=$data_forecast['ramal'];

              $query3 = "INSERT INTO `tbl_grafik` (`id_grafik`, `bulan`, `hasil`, `status`) VALUES ('', '$periode', '$ramal', 'Forecast')";
              $sql3 = mysqli_query($connect, $query3);

              

            }else{
              echo "<script>alert('Opss!, Nama Barang Belum Dipilih');
              document.location.href='dashboard.php?p=hk_proses'</script>\n";
            }
        
      ?>
       </div>
      <a href="dashboard.php?p=data_peramalan" class="btn btn-danger" style="margin-top: 15px;"><i class="fa fa-close"></i> Tutup</a>
      <button type='submit' class='btn btn-success' style="margin-top: 15px;"><i class='fa fa-save'></i> Simpan Proses Akhir</i></button>
      </form>
          </div>
         
        </div>
      </div>
     