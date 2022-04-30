<!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h2 class="h4 mb-0 text-gray-800">Data Training</h2>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Data Training</li>
            </ol>
          </div>
          <a href="dashboard.php?p=form" class="btn btn-primary" style="margin-bottom: 3px;"><i class="fa fa-upload"></i> Import Data</a>
          <div class="row mb-12">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-12 col-md-6 mb-4">
               <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Tabel Data Training</h6>
                </div>
                <div class="card-body">
                <?php
                  if(isset($_GET['notif'])){
                       if($_GET['notif']=="import-sukses"){
                        echo "<div class='alert alert-success alert-dismissible'>
                              <a style='text-decoration:none;' href='dashboard.php?p=data_training' type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</a>
                                <i class='icon fa fa-check'></i> Data Training <b> Berhasil Diimport</b>
                              </div>";
                      }
                    }
                    ?>
                  <div class="table-responsive p-3">
                  <table class="table align-items-center table-hover table-bordered" id="dataTableHover">
                    <thead class="thead-light">
                      <tr>
                        <th>NO</th>
                        <th>ID Barang(Nama Barang)</th>
                        <th>Data Training</th>
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
                    <th>Bulan</th>
                    <th>Quantity</th>
                    <th>X.Y</th>
                    <th>X^2</th>
                    <th>Forecast</th>
                    <th>RSFE</th>
                    <th>Error</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  include "koneksi.php";
                  $query="SELECT * FROM tbl_training WHERE kode_barang='".$data_user['kode_barang']."'";
                  $sql=mysqli_query($connect, $query);
                  while ($data=mysqli_fetch_array($sql)) {
                  ?>
                <tr>
                  <td><?php echo $data['bulan'];?></td>
                  <td><?php echo $data['qty'];?></td>
                  <td><?php echo $data['xy'];?></td>
                  <td><?php echo $data['x2'];?></td>
                  <td><?php echo $data['forecast'];?></td>
                  <td><?php echo $data['rsfe'];?></td>
                  <td><?php echo $data['error'];?></td>
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