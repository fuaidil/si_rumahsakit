<h4>Data Resep</h4><hr>

<div class="row">
  &nbsp;&nbsp;&nbsp;<button class="btn-sm btn-primary" data-toggle="modal" data-target="#addEmployeeModal" style="cursor: pointer;"><i class="fas fa-plus"></i>&nbsp;&nbsp;Tambah Data</button><br>
<div id="addEmployeeModal" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="post">
          <div class="modal-header">            
            <h4 class="modal-title">Tambah Data</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">
                <label>Tanggal Resep : </label>
                <input type="date" name="tgl" required class="form-control"><br>

                <select name="kode_pasien" required class="form-control">
                  <option value="">Select Pasien</option>
                <?php $ambil1 = $koneksi->query("SELECT * FROM reg_pasien"); ?>
                <?php while($pecah1 = $ambil1->fetch_assoc()) : ?>
                  <option value="<?php echo $pecah1["kode_reg_pasien"]; ?>"><?php echo $pecah1["nama_pasien"]; ?></option>
                <?php endwhile; ?>
                </select><br>

                <select name="kode_dokter" required class="form-control">
                  <option value=" ">Select Dokter</option>
                <?php $ambil1 = $koneksi->query("SELECT * FROM dokter"); ?>
                <?php while($pecah1 = $ambil1->fetch_assoc()) : ?>
                  <option value="<?php echo $pecah1["kode_dokter"]; ?>"><?php echo $pecah1["nama_dokter"]; ?></option>
                <?php endwhile; ?>
                </select><br>

                <select name="kode_obat" required class="form-control">
                  <option value="">Select Obat</option>
                <?php $ambil1 = $koneksi->query("SELECT * FROM obat"); ?>
                <?php while($pecah1 = $ambil1->fetch_assoc()) : ?>
                  <option value="<?php echo $pecah1["kode_obat"]; ?>"><?php echo $pecah1["nama_obat"]; ?></option>
                <?php endwhile; ?>
                </select>

                <label>Aturan Pakai : </label>
                <input type="text" name="aturan" required class="form-control">

                <label>Harga Obat : </label>
                <input type="number" name="harga_obat" required class="form-control">
          </div>
          <div class="modal-footer">
            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
            <input type="submit" name="save" class="btn btn-success" value="Add">
          </div>
        </form>
        <?php 
        if (isset($_POST["save"])) 
        {
          $koneksi->query("INSERT INTO resep VALUES(NULL, '$_POST[tgl]','$_POST[kode_pasien]','$_POST[kode_dokter]','$_POST[kode_obat]','$_POST[aturan]','$_POST[harga_obat]')");
          echo "<script> location.href='?halaman=resep'; </script> ";
        }
      ?>
      </div>
    </div>
  </div>
	<div class="col-3 ml-auto">
		<input type="text" id="cari" placeholder="Search" class="form-control">
	</div><br>
  </div>
    <br>
	<table class="table table-hover table-striped nowrap" style="width:100%">
        <thead>
            <tr>
              <th>Kode</th>
              <th>Tanggal Resep</th>
              <th>Aturan Pakai</th>
              <th>Harga Obat</th>
              <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
          <?php $ambil = $koneksi->query("SELECT * FROM resep JOIN reg_pasien ON reg_pasien.kode_reg_pasien=resep.kode_reg_pasien
            JOIN dokter ON dokter.kode_dokter=resep.kode_dokter JOIN obat ON obat.kode_obat=resep.kode_obat"); ?>
          <?php while($aray = $ambil->fetch_assoc()) : ?>
          <tr>
            <td><?php echo $aray['kode_resep']; ?></td>
            <td><?php echo $aray['tgl_resep']; ?></td>
            <td><?php echo $aray['aturan_pakai']; ?></td>
            <td>IDR <?php echo number_format($aray['harga_obat']); ?></td>
            <td>
              <button data-target="#showEmployeeModal<?= $aray['kode_resep']; ?>" class="btn-sm btn-info" data-toggle="modal" title="Show data" style="cursor: pointer;"><i class="fas fa-eye"></i></button>
              <button data-target="#editEmployeeModal<?= $aray['kode_resep']; ?>" class="btn-sm btn-success" data-toggle="modal" title="Edit" style="cursor: pointer;"><i class="fas fa-pencil-alt"></i></button>
              <button data-target="#deleteEmployeeModal<?= $aray['kode_resep']; ?>" class="btn-sm btn-danger" data-toggle="modal" title="Delete" style="cursor: pointer;"><i class="fas fa-trash-alt" data-toggle="tooltip"></i></button>
            </td>
          </tr>

          <div id="showEmployeeModal<?= $aray['kode_resep']; ?>" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="post" enctype="multipart/form-data">
          <div class="modal-header">            
            <h4 class="modal-title">Show Data</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">
          <?php
            $id = $aray['kode_resep'];
            $edit = $koneksi->query("SELECT * FROM resep JOIN reg_pasien ON reg_pasien.kode_reg_pasien=resep.kode_reg_pasien
            JOIN dokter ON dokter.kode_dokter=resep.kode_dokter JOIN obat ON obat.kode_obat=resep.kode_obat WHERE kode_resep = '$id'");
            while ($row = $edit->fetch_assoc()) : ?>
            <input type="hidden" name="id" value="<?php echo $row['kode_resep']; ?>">
            <label>Tanggal Resep : </label>
            <input disabled class="form-control" value="<?php echo $row['tgl_resep']; ?>">

            <label>Nama Pasien : </label>
            <input disabled class="form-control" value="<?php echo $row['nama_pasien']; ?>">

            <label>Nama Dokter : </label>
            <input class="form-control" value="<?php echo $row['nama_dokter']; ?>" disabled>

            <label>Nama Obat : </label>
            <input value="<?php echo $row['nama_obat']; ?>" class="form-control" disabled>

            <label>Aturan Pakai : </label>
            <input class="form-control" value="<?php echo $row['aturan_pakai']; ?>" required disabled>

            <label>Harga Obat : </label>
            <input class="form-control" value="<?php echo number_format($row['harga_obat']); ?>" disabled>
          </div>
        </form>
      <?php endwhile; ?>
      </div>
    </div>
  </div>

  <div id="editEmployeeModal<?= $aray['kode_resep']; ?>" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="post" enctype="multipart/form-data">
          <div class="modal-header">            
            <h4 class="modal-title">Edit Data</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">
          <?php
            $id = $aray['kode_resep'];
            $edit = $koneksi->query("SELECT * FROM resep JOIN reg_pasien ON reg_pasien.kode_reg_pasien=resep.kode_reg_pasien
            JOIN dokter ON dokter.kode_dokter=resep.kode_dokter JOIN obat ON obat.kode_obat=resep.kode_obat WHERE kode_resep = '$id' ");
            while ($row = $edit->fetch_assoc()) : ?>
            <input type="hidden" name="id" value="<?php echo $row['kode_resep']; ?>">
            
            <label>Tanggal Resep : </label>
            <input type="date" class="form-control" name="tgl" value="<?php echo $row['tgl_resep']; ?>" required>

            <label>Pasien : </label>
            <select name="pasien" required class="form-control">
                  <option value="<?php echo $row['kode_reg_pasien']; ?>"><?php echo $row["nama_pasien"]; ?></option>
                <?php $ambil1 = $koneksi->query("SELECT * FROM reg_pasien"); ?>
                <?php while($pecah1 = $ambil1->fetch_assoc()) : ?>
                  <option value="<?php echo $pecah1["kode_reg_pasien"]; ?>"><?php echo $pecah1["nama_pasien"]; ?></option>
                <?php endwhile; ?>
                </select>

                <label>Dokter : </label>
                <select name="dokter" required class="form-control">
                  <option value="<?php echo $row['kode_dokter']; ?>"><?php echo $row["nama_dokter"]; ?></option>
                <?php $ambil1 = $koneksi->query("SELECT * FROM dokter"); ?>
                <?php while($pecah1 = $ambil1->fetch_assoc()) : ?>
                  <option value="<?php echo $pecah1["kode_dokter"]; ?>"><?php echo $pecah1["nama_dokter"]; ?></option>
                <?php endwhile; ?>
                </select>

                <label>Obat : </label>
                <select name="obat" required class="form-control">
                  <option value="<?php echo $row['kode_obat']; ?>"><?php echo $row["nama_obat"]; ?></option>
                <?php $ambil1 = $koneksi->query("SELECT * FROM obat"); ?>
                <?php while($pecah1 = $ambil1->fetch_assoc()) : ?>
                  <option value="<?php echo $pecah1["kode_obat"]; ?>"><?php echo $pecah1["nama_obat"]; ?></option>
                <?php endwhile; ?>
                </select>

            <label>Aturan Pakai : </label>
            <input type="text" class="form-control" name="aturan" value="<?php echo $row['aturan_pakai']; ?>" required>

          </div>
          <div class="modal-footer">
            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
            <input type="submit" name="update" class="btn btn-info" value="Update">
          </div>
        </form>
      <?php endwhile; ?>
      <?php
        $koneksi = new mysqli("localhost","root","","rumahsakit");
        if (isset($_POST['update'])) {
          
          $koneksi->query("UPDATE resep SET tgl_resep='$_POST[tgl]', kode_reg_pasien='$_POST[pasien]', kode_dokter='$_POST[dokter]', kode_obat='$_POST[obat]', aturan_pakai='$_POST[aturan]' WHERE kode_resep = '$id'");
            echo "<script> location.href='?halaman=resep'; </script>";
        }
        ?>
      </div>
    </div>
  </div>
  <div id="deleteEmployeeModal<?= $aray['kode_resep']; ?>" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="post">
          <div class="modal-header">            
            <h4 class="modal-title">Delete Data '<?php echo $aray['kode_resep']; ?>'</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">          
          <?php
          $id_del = $aray['kode_resep'];
          $del = $koneksi->query("SELECT * FROM resep WHERE kode_resep='$id_del'");
          $rows = $del->fetch_assoc(); ?>
            <input type="hidden" name="id" value="<?php echo $rows['kode_resep']; ?>">
            <p class="text-warning">Are you sure want to <b class="text-danger">Delete</b> ?</p>
            <p class="text-info"><small>This action cannot be undone.</small></p>
          </div>
          <div class="modal-footer">
            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
            <button type="submit" name="del" class="btn btn-danger">Delete</button>
          </div>
        </form>
        <?php  
          if (isset($_POST["del"])) {
            $id = $_POST["id"];
            $koneksi->query("DELETE FROM resep WHERE kode_resep = '$id' ");
            echo "<script>location.href='?halaman=resep';</script>";
          }
        ?>
      </div>
    </div>
  </div>
      <?php endwhile; ?>
      <tr class="notfound">
        <td colspan="7">
          <div class='alert alert-danger' style="text-align: center;">Data tidak ditemukan !</div>
        </td>
      </tr>
    </tbody>
</table>