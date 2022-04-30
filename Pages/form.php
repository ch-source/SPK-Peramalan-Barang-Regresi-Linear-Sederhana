
      <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h2 class="h4 mb-0 text-gray-800">Import Data Training</h2>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Import Data Training</li>
            </ol>
          </div>
           <div class="row mb-12">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-12 col-md-6 mb-4">
               <div class="card mb-4">
                <div class="card-body">
          <!-- Buat sebuah tombol Cancel untuk kemabli ke halaman awal / view data -->
          
          <!-- Buat sebuah tag form dan arahkan action nya ke file ini lagi -->
          <form method="post" action="" enctype="multipart/form-data">

            <!--
            -- Buat sebuah input type file
            -- class pull-left berfungsi agar file input berada di sebelah kiri
            -->
            <input type="file" name="file" class="pull-left">

            <button type="submit" name="preview" class="btn btn-success">
              <i class="fa fa-eye"></i> Preview
            </button>
            <a href="dashboard.php?p=data_training" class="btn btn-danger">
            <i class="glyphicon glyphicon-remove"></i> Batal
          </a>
          </form>

          <hr>

          <!-- Buat Preview Data -->
          <?php
          // Jika user telah mengklik tombol Preview
          if(isset($_POST['preview'])){
            //$ip = ; // Ambil IP Address dari User
            $nama_file_baru = 'data.xlsx';

            // Cek apakah terdapat file data.xlsx pada folder tmp
            if(is_file('tmp/'.$nama_file_baru)) // Jika file tersebut ada
              unlink('tmp/'.$nama_file_baru); // Hapus file tersebut

            $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION); // Ambil ekstensi filenya apa
            $tmp_file = $_FILES['file']['tmp_name'];

            // Cek apakah file yang diupload adalah file Excel 2007 (.xlsx)
            if($ext == "xlsx"){
              // Upload file yang dipilih ke folder tmp
              // dan rename file tersebut menjadi data{ip_address}.xlsx
              // {ip_address} diganti jadi ip address user yang ada di variabel $ip
              // Contoh nama file setelah di rename : data127.0.0.1.xlsx
              move_uploaded_file($tmp_file, 'tmp/'.$nama_file_baru);

              // Load librari PHPExcel nya
              require_once 'PHPExcel/PHPExcel.php';
 
              $excelreader = new PHPExcel_Reader_Excel2007();
              $loadexcel = $excelreader->load('tmp/'.$nama_file_baru); // Load file yang tadi diupload ke folder tmp
              $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);

              // Buat sebuah tag form untuk proses import data ke database
              echo "<form method='post' action='import.php'>";

              // Buat sebuah div untuk alert validasi kosong
              echo "<div class='table-responsive p-3'>
              <table class='table align-items-center table-hover table-bordered' id='dataTableHover'>
              <tr>
                <th colspan='5' class='text-center'>DATA TRAINING</th>
              </tr>
              <tr>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Bulan</th>
                <th>Qty</th>
                <th>X.Y</th>
                <th>X^2</th>
                <th>Forecast</th>
                <th>RSFE</th>
                <th>Error</th>
              </tr>";
              $numrow = 1;
              $kosong = 0;
              foreach($sheet as $row){ // Lakukan perulangan dari data yang ada di excel
                // Ambil data pada excel sesuai Kolom
                // Ambil data pada excel sesuai Kolom
                $kode_barang = $row['A']; // Ambil data NIS
                $nama_barang = $row['B']; // Ambil data NIS
                $bulan = $row['C']; // Ambil data nama
                $qty = $row['D']; // Ambil data jenis kelamin
                $xy = $row['E']; // Ambil data jenis kelamin
                $x2 = $row['F']; // Ambil data jenis kelamin
                $forecast = $row['G']; // Ambil data jenis kelamin
                $rsfe = $row['H']; // Ambil data jenis kelamin
                $error = $row['I']; // Ambil data jenis kelamin

                // Cek jika semua data tidak diisi
                if($kode_barang == "" && $nama_barang == "" && $bulan == "" && $qty == "" && $xy == "" && $x2 == "" && $forecast == "" && $rsfe == "" && $error == "")
                  continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)

                // Cek $numrow apakah lebih dari 1
                // Artinya karena baris pertama adalah nama-nama kolom
                // Jadi dilewat saja, tidak usah diimport
                if($numrow > 1){
                  // Validasi apakah semua data telah diisi
                  $kode_barang_td = ( ! empty($kode_barang))? "" : " style='background: #E07171;'"; // Jika NIS kosong, beri warna merah
                  $nama_barang_td = ( ! empty($nama_barang))? "" : " style='background: #E07171;'"; // Jika NIS kosong, beri warna merah
                  $bulan_td = ( ! empty($bulan))? "" : " style='background: #E07171;'"; // Jika Nama kosong, beri warna merah
                  $qty_td = ( ! empty($qty))? "" : " style='background: #E07171;'"; // Jika Jenis Kelamin kosong, beri warna merah
                  $xy_td = ( ! empty($xy))? "" : " style='background: #E07171;'"; // Jika Jenis Kelamin kosong, beri warna merah
                  $x2_td = ( ! empty($x2))? "" : " style='background: #E07171;'"; // Jika Jenis Kelamin kosong, beri warna merah
                  $forecast_td = ( ! empty($forecast))? "" : " style='background: #E07171;'"; // Jika Jenis Kelamin kosong, beri warna merah
                  $rsfe_td = ( ! empty($rsfe))? "" : " style='background: #E07171;'"; // Jika Jenis Kelamin kosong, beri warna merah
                  $error_td = ( ! empty($error))? "" : " style='background: #E07171;'"; // Jika Jenis Kelamin kosong, beri warna merah

                  // Jika salah satu data ada yang kosong

                  if($kode_barang == "" or $nama_barang == "" or $bulan == "" or $qty == "" or $xy == "" or $x2 == "" or $forecast == "" or $rsfe == "" or $error == ""){
                    $kosong++; // Tambah 1 variabel $kosong
                  }

                  echo "<tr>";
                  echo "<td".$kode_barang_td.">".$kode_barang."</td>";
                  echo "<td".$nama_barang_td.">".$nama_barang."</td>";
                  echo "<td".$bulan_td.">".$bulan."</td>";
                  echo "<td".$qty_td.">".$qty."</td>";
                  echo "<td".$xy_td.">".$xy."</td>";
                  echo "<td".$x2_td.">".$x2."</td>";
                  echo "<td".$forecast_td.">".$forecast."</td>";
                  echo "<td".$rsfe_td.">".$rsfe."</td>";
                  echo "<td".$error_td.">".$error."</td>";
                  echo "</tr>";
                }

                $numrow++; // Tambah 1 setiap kali looping
              }

              echo "</table>";
              echo "</div>";

              // Cek apakah variabel kosong lebih dari 1
              // Jika lebih dari 1, berarti ada data yang masih kosong
             
              
                 // Jika semua data sudah diisi
                echo "<hr>";

                // Buat sebuah tombol untuk mengimport data ke database
                echo "<button type='submit' name='import' class='btn btn-primary'><i class='fa fa-upload'></i> Import</button>";
              

              echo "</form>";
            }else{ // Jika file yang diupload bukan File Excel 2007 (.xlsx)
              // Munculkan pesan validasi
              echo "<div class='alert alert-danger'>
              Hanya File Excel 2007 (.xlsx) yang diperbolehkan
              </div>";
            }
          }
          ?>
        </div>
      </div>
      </div>
    </div>
      </div>
     