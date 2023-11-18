<?php 
if ($_POST['idpas'] == 0) {
    echo "<script>alert('checklist minimal 1 pasien'); location.href='?halaman=pasien'</script>";
} else { ?>
<h4>Edit Data Pasien</h4><hr>
<div class="container">
    <?php
        $ide = $_POST['idpas'];
        $jum = count($ide);
        $no = 1;
        for ($i=0; $i < $jum; $i++) :
        $id = $ide[$i];
        $sql = $koneksi->query("SELECT * FROM reg_pasien WHERE kode_reg_pasien = '$id'");
        $hasil = $sql->fetch_array();
    ?>
    <form method="post" action="act-edit.php">
        <h5>Data ke-<?= $no++?></h5><hr>
        <div class="form-group">
            <label>NIK : </label>
            <input type="hidden" name="idPas[]" value="<?= $id?>">
            <input type="number" name="nik[]" required class="form-control" value="<?= $hasil['nik'] ?>">
        </div>

        <div class="form-group">
            <label>Nama Pasien : </label>
            <input type="text" name="nama[]" required class="form-control" value="<?= $hasil['nama_pasien'] ?>">
        </div>

        <div class="form-group">
            <label>Alamat Pasien : </label>
            <input type="text" name="alamat[]" required class="form-control" value="<?= $hasil['alamat_pasien'] ?>">
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
            <input type="number" name="telepon[]" required class="form-control" value="<?= $hasil['no_telp'] ?>">
        </div>

        <div class="form-group">
            <label>Usia : </label>
            <input type="text" name="usia[]" required class="form-control" value="<?= $hasil['usia'] ?>">
        </div>

        <div class="form-group">
            <label>Tanggal Daftar : </label>
            <input type="date" name="daftar[]" required class="form-control" value="<?= $hasil['tgl_daftar'] ?>">
        </div>

        <div class="form-group">
            <label>Tempat Pemeriksaan :</label>
            <input type="text" name="tempat_periksa[]" required class="form-control" value="<?= $hasil['tempat_pemeriksaan'] ?>"> <br>
        </div>

        <?php endfor; ?>
        <input type="submit" name="update" class="btn btn-success" value="Update">
    </form>
</div>
<?php } ?>