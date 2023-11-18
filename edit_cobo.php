<?php
$koneksi = new mysqli("localhost","root","","rumahsakit");
$id = $_GET['id'];
$nik = $_GET['nik'];
$nama = $_GET['nama'];
$alamat = $_GET['alamat'];
$jeniskel = $_GET['jeniskel'];
$telp = $_GET['telepon'];
$usia = $_GET['usia'];
$daftar = $_GET['daftar'];
$priksa = $_GET['tempat_periksa'];
//query update
$query = $koneksi->query("UPDATE reg_pasien SET nik='$nik', nama_pasien='$nama', alamat_pasien='$alamat', jeniskel='$jeniskel', no_telp='$telp', usia='$usia', tgl_daftar='$daftar', tempat_pemeriksaan='$priksa' WHERE kode_reg_pasien = '$id'");
	header("location:cobo tabel.php");

// if (mysql_query($query)) {
//     # credirect ke page index
//     header("location:cobo tabel.php");    
// }
// else{
//     echo "ERROR, data gagal diupdate". mysql_error();
// }
//mysql_close($host);
?>