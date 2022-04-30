<?php
include"koneksi.php";
$id=$_POST['id'];
$periode=$_POST['periode'];
$tgl=$_POST['tgl'];
$qty=$_POST['qty'];
$slope=$_POST['slope'];
$intercept=$_POST['intercept'];
$forecast=$_POST['forecast'];
$rsfe=$_POST['rsfe'];
$error=$_POST['error'];
$mad=$_POST['mad'];

$count=count($id);
$sql="INSERT INTO `tbl_peramalan` (`id_peramalan`, `kode_barang`, `tanggal`, `bulan`, `qty`, `slope`, `intercept`, `forecast`, `rsfe`, `error`, `mad`) VALUES ";
for ($i=0; $i <$count ; $i++) { 
  $sql.="('', '{$id[$i]}', '{$tgl[$i]}', '{$periode[$i]}', '{$qty[$i]}', '{$slope[$i]}', '{$intercept[$i]}', '{$forecast[$i]}', '{$rsfe[$i]}', '{$error[$i]}', '{$mad[$i]}')";
  $sql.=",";
}

$sql=rtrim($sql,",");
      $insert=$connect->query($sql);
      if (!$insert) {
        echo "<script>alert('Opss!, Data Hasil Peramalan Gagal Disimpan');
        document.location.href='dashboard.php?p=input_hk'</script>\n";
      }else{
      echo "<script>alert('Data Hasil Peramalan Berhasil Disimpan');
        document.location.href='dashboard.php?p=data_peramalan'</script>\n"; 
      }
?>