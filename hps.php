<?php
$koneksi = new mysqli("localhost","root","","rumahsakit");
if (isset($_POST["id_pas"])) {
    foreach ($_POST["id_pas"] as $id) {
        $koneksi->query("DELETE FROM reg_pasien WHERE kode_reg_pasien = '".$id."'");
        header('location: index.php?halaman=pasien');
    }
}