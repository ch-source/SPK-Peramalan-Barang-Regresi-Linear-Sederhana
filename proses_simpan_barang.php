<?php
include "koneksi.php";
$query = "SELECT max(kode_barang) as maxId FROM tbl_barang";
$hasil = mysqli_query($connect,$query);
$data = mysqli_fetch_array($hasil);
$idbarang = $data['maxId'];
$noUrut = (int) substr($idbarang, 3, 3);
$noUrut++;
$char = "KBR";
$idbarang= $char . sprintf("%03s", $noUrut);


$nama = $_POST['nama'];
$stok = $_POST['stok'];
$satuan = $_POST['satuan'];
$rak = $_POST['rak'];
$hb = $_POST['hb'];
$hj = $_POST['hj'];
$kode = $_POST['kode'];


	$query1 = "INSERT INTO `tbl_barang` (`kode_barang`, `barcode`, `nama_barang`, `stok`, `satuan`, `rak`, `harga_beli`, `harga_jual`) VALUES ('$idbarang', '$kode', '$nama', '$stok', '$satuan', '$rak', '$hb', '$hj')";
	$sql1 = mysqli_query($connect, $query1); 
	if ($sql1) {
			echo "<script>alert('Proses Simpan Data Barang Berhasil');
                document.location.href='dashboard.php?p=data_barang'</script>\n";
		}else{
			echo "<script>alert('Proses Simpan Data Barang Gagal');
                document.location.href='dashboard.php?p=input_data_barang'</script>\n";
		}
?>
