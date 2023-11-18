<?php
    $koneksi = new mysqli("localhost","root","","rumahsakit");
    if (isset($_POST['update'])) {
        $idd = $_POST['idPas'];
        $jml = count($idd);
        for ($i=0; $i < $jml; $i++) { 
          $ide = $idd[$i];
          $nik = $_POST['nik'][$i];
          $nama = $_POST['nama'][$i];
          $alamat = $_POST['alamat'][$i];
          $jeniskel = $_POST['jeniskel'][$i];
          $telp = $_POST['telepon'][$i];
          $usia = $_POST['usia'][$i];
          $daftar = $_POST['daftar'][$i];
          $priksa = $_POST['tempat_periksa'][$i];
          
          $koneksi->query("UPDATE reg_pasien SET nik='$nik', nama_pasien='$nama', alamat_pasien='$alamat', jeniskel='$jeniskel', no_telp='$telp', usia='$usia', tgl_daftar='$daftar', tempat_pemeriksaan='$priksa' WHERE kode_reg_pasien = '$ide'");
            echo "<script> location.href='index.php?halaman=pasien'; </script>";
        }
    }
?>