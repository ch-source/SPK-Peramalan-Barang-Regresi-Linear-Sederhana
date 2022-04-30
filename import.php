<?php
/*
-- Source Code from My Notes Code (www.mynotescode.com)
--
-- Follow Us on Social Media
-- Facebook : http://facebook.com/mynotescode/
-- Twitter  : http://twitter.com/mynotescode
-- Google+  : http://plus.google.com/118319575543333993544
--
-- Terimakasih telah mengunjungi blog kami.
-- Jangan lupa untuk Like dan Share catatan-catatan yang ada di blog kami.
*/

// Load file koneksi.php
include "koneksi.php";

if(isset($_POST['import'])){ // Jika user mengklik tombol Import
	$nama_file_baru = 'data.xlsx';

	// Load librari PHPExcel nya
	require_once 'PHPExcel/PHPExcel.php';

	$excelreader = new PHPExcel_Reader_Excel2007();
	$loadexcel = $excelreader->load('tmp/'.$nama_file_baru); // Load file excel yang tadi diupload ke folder tmp
	$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);

	$numrow = 1;
	foreach($sheet as $row){
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
                  continue;  // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)

		// Cek $numrow apakah lebih dari 1
		// Artinya karena baris pertama adalah nama-nama kolom
		// Jadi dilewat saja, tidak usah diimport
		if($numrow > 1){
			// Buat query Insert
			$query = "INSERT INTO tbl_training VALUES('', '".$kode_barang."', '".$nama_barang."','".$bulan."','".$qty."','".$xy."','".$x2."','".$forecast."','".$rsfe."','".$error."')";

			// Eksekusi $query
			mysqli_query($connect, $query);
		}

		$numrow++; // Tambah 1 setiap kali looping
	}
}

header('location: dashboard.php?p=data_training&notif=import-sukses'); // Redirect ke halaman awal
?>
