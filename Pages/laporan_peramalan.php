<!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h2 class="h4 mb-0 text-gray-800">Laporan Peramalan</h2>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Laporan Peramalan</li>
            </ol>
          </div>
          <div class="row">
            <div class="col-md-12" style="margin-bottom: 5px;">
              <div class="card">
                <div class="card-header">
                  <b class="card-title">Laporan Peramalan</b>
                </div>
                <div class="card-body">
                   <form method="post" action="laporan/laporan_peramalan.php" target="_blank">
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Tgl. Awal</label>
                      <div class="col-sm-3">
                        <input type="date" name="tglaw" class="form-control" required="required">
                      </div>
                      <label class="col-sm-2 col-form-label">Tgl. Akhir</label>
                      <div class="col-sm-3">
                      <input type="date" name="tglak" class="form-control" required="required">
                      </div>
                      <div class="col-sm-2">
                        <button type="submit" class="btn btn-info"><i class="fa fa-print"></i> Cetak </button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <div class="row mb-12">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-12 col-md-6 mb-4">
               <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Tabel Data Laporan Hasil Klasifikasi</h6>
                </div>
                <div class="card-body">
                  <div class="table-responsive p-3">
                  <table class="table align-items-center table-hover table-bordered" id="dataTableHover">
                    <thead class="thead-light">
                      <tr>
                        <th>NO</th>
                        <th>ID Barang(Nama Barang)</th>
                        <th>Data Peramalan Barang</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                       include "koneksi.php";
                       $no=1;
                       $query_user="SELECT * FROM tbl_barang";
                       $sql_user=mysqli_query($connect, $query_user);
                       while ($data_user=mysqli_fetch_array($sql_user)) {
                      ?>
                      <tr>
                         <td><?php echo $no;?></td>
                         <td><?php echo $data_user['kode_barang'];?>-(<?php echo $data_user['nama_barang'];?>)</td>
                      <td>
                      <table class="table table-bordered" style="font-size: 12px;">
                        <thead>
                          <tr>
                              <th>Tanggal</th>
                              <th>Bulan</th>
                              <th>Qty</th>
                              <th>Slope</th>
                              <th>Intercept</th>
                              <th>Forecast</th>
                              <th>RSFE</th>
                              <th>Error</th>
                              <th>MAD</th>
                          </tr>
                        </thead>
                            <tbody>
                            <?php
                            include "koneksi.php";
                            $query="SELECT * FROM tbl_peramalan WHERE kode_barang='".$data_user['kode_barang']."'";
                            $sql=mysqli_query($connect, $query);
                            while ($data=mysqli_fetch_array($sql)) {
                            ?>
                            <tr>
                              <td><?php echo $data['tanggal'];?></td>
                              <td><?php echo $data['bulan'];?></td>
                              <td><?php echo $data['qty'];?></td>
                              <td><?php echo $data['slope'];?></td>
                              <td><?php echo $data['intercept'];?></td>
                              <td><?php echo $data['forecast'];?></td>
                              <td><?php echo $data['rsfe'];?></td>
                              <td><?php echo $data['error'];?></td>
                              <td><?php echo $data['mad'];?></td>
                            </tr>
                          <?php }?>
                        </tbody>
                      </table>
                      </td>
                      </tr>
                      <?php $no++;}
                      ?>
                    </tbody>
                  </table>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
        <!---Container Fluid-->