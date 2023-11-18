<h4>Tambah Data Pasien</h4><hr>
<div class="container">
    <?php  
        $no = 1;
        $jml = $_POST['jml'];
        // $jum = count($jml);
        for ($i=1; $i <= $jml; $i++) :
    ?>
    <form method="post">
        <h5>Form ke-<?= $no++?></h5><hr>
        <div class="form-group">
            <label>NIK : </label>
            <input type="number" name="nik[]" required class="form-control">
        </div>

        <div class="form-group">
            <label>Nama Pasien : </label>
            <input type="text" name="nama[]" required class="form-control">
        </div>

        <div class="form-group">
            <label>Alamat Pasien : </label>
            <input type="text" name="alamat[]" required class="form-control">
        </div>

        <div class="form-group">
            <label>Jenis Kelamin : </label>
            <select name="jeniskel[]" class="form-control">
                <option value="Laki-Laki">Laki-Laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
        </div>

        <div class="form-group">
            <label>No.Telp Pasien : </label>
            <input type="number" name="telepon[]" required class="form-control">
        </div>

        <div class="form-group">
            <label>Usia : </label>
            <input type="text" name="usia[]" required class="form-control">
        </div>

        <div class="form-group">
            <label>Tanggal Daftar : </label>
            <input type="date" name="daftar[]" required class="form-control">
        </div>

        <div class="form-group">
            <label>Tempat Pemeriksaan :</label>
            <input type="text" name="tempat_periksa[]" required class="form-control"> <br>
        </div>

        <div class="form-group">
            <label>Upload KTP :</label>
            <input type="file" name="ktp[]" required class="form-control"> <br>
        </div>

        <?php endfor; ?>
        <input type="hidden" name="jml" value="<?= $jml?>">
        <input type="submit" name="save" class="btn btn-success" value="Tambah">
    </form>
</div>
<?php
if (isset($_POST['save'])) {
    $juml = $_POST['jml'];
    for ($i=0; $i < $juml; $i++) { 
        $nik = $_POST["nik"][$i];
        $nama = $_POST["nama"][$i];
        $alamat = $_POST["alamat"][$i];
        $jeniskel = $_POST["jeniskel"][$i];
        $telepon = $_POST["telepon"][$i];
        $usia = $_POST["usia"][$i];
        $daftar = $_POST["daftar"][$i];
        $tmpt = $_POST["tempat_periksa"][$i];
        $ktp = $_FILES["ktp"]["name"][$i];
        $tmp = $_FILES["ktp"]["tmp_name"][$i];
        move_uploaded_file($tmp, "gambar/" . $ktp);
    
    $koneksi->query("INSERT INTO reg_pasien(nik,nama_pasien,alamat_pasien,jeniskel,no_telp,usia,tgl_daftar,tempat_pemeriksaan,ktp) 
    VALUES('$nik','$nama','$alamat','$jeniskel','$telepon','$usia','$daftar','$tmpt','$ktp')");
          echo "<script> location.href='?halaman=pasien'; </script> ";
    }
}