<?php 
include"koneksi.php";

$id=$_GET['id'];
$nama = $_POST['nama'];
$stok = $_POST['stok'];
$satuan = $_POST['satuan'];
$rak = $_POST['rak'];
$hb = $_POST['hb'];
$hj = $_POST['hj'];
$kode = $_POST['kode'];

    $query="UPDATE tbl_barang SET nama_barang='$nama', stok='$stok', satuan='$satuan', barcode='$kode', rak='$rak', harga_beli='$hb', harga_jual='$hj' WHERE kode_barang='$id'";
    $sql=mysqli_query($connect, $query);
    if ($sql) {
      echo "<script>alert('Data Barang Berhasil Diubah');
      document.location.href='dashboard.php?p=data_barang'</script>\n";
    }else{
      echo "<script>alert('Data Barang Gagal Diubah!');
      document.location.href='dashboard.php?p=edit_data_barang&id=".$id."'</script>\n";
    }
?>
