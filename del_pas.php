<?php
$koneksi = new mysqli("localhost","root","","rumahsakit");
// echo "tes";
if (isset($_POST["id"])) {
    foreach ($_POST["id"] as $id) {
        $koneksi->query("DELETE FROM reg_pasien WHERE kode_reg_pasien = '".$id."'");
        header('location: index.php?halaman=pasien');
    }
}
?>