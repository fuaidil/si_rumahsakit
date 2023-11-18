<h4>Data Rekam Medis</h4><hr>

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
                <label>Tanggal Rekam Medis : </label>
                <input type="date" name="tgl_rekam" required class="form-control"><br>

                <select name="kode_pasien" required class="form-control">
                  <option value="">Select Pasien</option>
                <?php $ambil1 = $koneksi->query("SELECT * FROM reg_pasien"); ?>
                <?php while($pecah1 = $ambil1->fetch_assoc()) : ?>
                   <option value="<?php echo $pecah1["kode_reg_pasien"]; ?>"><?php echo $pecah1["nama_pasien"]; ?></option>
                <?php endwhile; ?>
                </select><br>

                <select name="kode_dokter" required class="form-control">
                  <option value="">Select Dokter</option>
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
                </select><br>

                <select name="kode_diagnosa" required class="form-control">
                  <option value="">Select Diagnosa</option>
                <?php $ambil1 = $koneksi->query("SELECT * FROM diagnosa"); ?>
                <?php while($pecah1 = $ambil1->fetch_assoc()) : ?>
                   <option value="<?php echo $pecah1["kode_diagnosa"]; ?>"><?php echo $pecah1["kode_diagnosa"]; ?></option>
                <?php endwhile; ?>
                </select>
          </div>
          <div class="modal-footer">
            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
            <input type="submit" name="save" class="btn btn-success" value="Add">
          </div>
        </form>
        <?php 
        if (isset($_POST["save"])) 
        {
          $koneksi->query("INSERT INTO rekam_medis VALUES(NULL,'$_POST[tgl_rekam]','$_POST[kode_pasien]','$_POST[kode_dokter]','$_POST[kode_obat]','$_POST[kode_diagnosa]')");
          echo "<script> location.href='?halaman=rekam_medis'; </script> ";
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
              <th>Tanggal Rekam Medis</th>
              <th>Nama Pasien</th>
              <th>Nama Dokter</th>
              <th>Nama Diagnosa</th>
              <th>Nama Obat</th>
              <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
          <?php $ambil = $koneksi->query("SELECT * FROM rekam_medis JOIN obat ON obat.kode_obat=rekam_medis.kode_obat
          JOIN diagnosa ON diagnosa.kode_diagnosa=rekam_medis.kode_diagnosa 
          JOIN reg_pasien ON reg_pasien.kode_reg_pasien=diagnosa.kode_reg_pasien
          JOIN dokter ON dokter.kode_dokter=diagnosa.kode_dokter
           "); ?>
          <?php while($aray = $ambil->fetch_assoc()) : ?>
          <tr>
            <td><?php echo $aray['no_rekam_medis']; ?></td>
            <td><?php echo $aray['tgl_rekam_medis']; ?></td>
            <td><?php echo $aray['nama_pasien']; ?></td>
            <td><?php echo $aray['nama_dokter']; ?></td>
            <td><?php echo $aray['hasil_pemeriksaan']; ?></td>
            <td><?php echo $aray['nama_obat']; ?></td>
            <td>
              <!-- <button data-target="#showEmployeeModal<?= $aray['no_rekam_medis']; ?>" class="btn-sm btn-info" data-toggle="modal" title="Show data" style="cursor: pointer;"><i class="fas fa-eye"></i></button> -->
              <button data-target="#editEmployeeModal<?= $aray['no_rekam_medis']; ?>" class="btn-sm btn-success" data-toggle="modal" title="Edit" style="cursor: pointer;"><i class="fas fa-pencil-alt"></i></button>
              <button data-target="#deleteEmployeeModal<?= $aray['no_rekam_medis']; ?>" class="btn-sm btn-danger" data-toggle="modal" title="Delete" style="cursor: pointer;"><i class="fas fa-trash-alt" data-toggle="tooltip"></i></button>
            </td>
          </tr>
          <!-- Edit Modal -->
          <div id="editEmployeeModal<?= $aray['no_rekam_medis']; ?>" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="post" enctype="multipart/form-data">
          <div class="modal-header">            
            <h4 class="modal-title">Edit Data</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">
          <?php
            $id = $aray['no_rekam_medis'];
            $edit = $koneksi->query("SELECT * FROM rekam_medis JOIN obat ON obat.kode_obat=rekam_medis.kode_obat
            JOIN diagnosa ON diagnosa.kode_diagnosa=rekam_medis.kode_diagnosa 
            JOIN reg_pasien ON reg_pasien.kode_reg_pasien=diagnosa.kode_reg_pasien
            JOIN dokter ON dokter.kode_dokter=diagnosa.kode_dokter WHERE no_rekam_medis = '$id'");
            while ($row = $edit->fetch_assoc()) : ?>
            <input type="hidden" name="id" value="<?php echo $row['no_rekam_medis']; ?>">
            <label>Tanggal Rekam Medis : </label>
            <input type="date" class="form-control" name="tgl" value="<?php echo $row['tgl_rekam_medis']; ?>" required>

            <label>Pasien : </label>
            <select name="kode_pasien" required class="form-control">
                  <option value="<?php echo $row['kode_reg_pasien']; ?>"><?php echo $row["nama_pasien"]; ?></option>
                <?php $ambil1 = $koneksi->query("SELECT * FROM reg_pasien"); ?>
                <?php while($pecah1 = $ambil1->fetch_assoc()) : ?>
                  <option value="<?php echo $pecah1["kode_reg_pasien"]; ?>"><?php echo $pecah1["nama_pasien"]; ?></option>
                <?php endwhile; ?>
                </select>

                <label>Dokter : </label>
                <select name="kode_dokter" required class="form-control">
                  <option value="<?php echo $row['kode_dokter']; ?>"><?php echo $row["nama_dokter"]; ?></option>
                <?php $ambil1 = $koneksi->query("SELECT * FROM dokter"); ?>
                <?php while($pecah1 = $ambil1->fetch_assoc()) : ?>
                  <option value="<?php echo $pecah1["kode_dokter"]; ?>"><?php echo $pecah1["nama_dokter"]; ?></option>
                <?php endwhile; ?>
                </select>

                <label>Diagnosa : </label>
                <select name="kode_diagnosa" required class="form-control">
                  <option value="<?php echo $row['kode_diagnosa']; ?>"><?php echo $row["hasil_pemeriksaan"]; ?></option>
                <?php $ambil1 = $koneksi->query("SELECT * FROM diagnosa"); ?>
                <?php while($pecah1 = $ambil1->fetch_assoc()) : ?>
                  <option value="<?php echo $pecah1["kode_diagnosa"]; ?>"><?php echo $pecah1["hasil_pemeriksaan"]; ?></option>
                <?php endwhile; ?>
                </select>

                <label>Obat : </label>
                <select name="kode_obat" required class="form-control">
                  <option value="<?php echo $row['kode_obat']; ?>"><?php echo $row["nama_obat"]; ?></option>
                <?php $ambil1 = $koneksi->query("SELECT * FROM obat"); ?>
                <?php while($pecah1 = $ambil1->fetch_assoc()) : ?>
                  <option value="<?php echo $pecah1["kode_obat"]; ?>"><?php echo $pecah1["nama_obat"]; ?></option>
                <?php endwhile; ?>
                </select>
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
          
          $koneksi->query("UPDATE rekam_medis SET tgl_rekam_medis='$_POST[tgl]', kode_reg_pasien='$_POST[kode_pasien]', kode_dokter='$_POST[kode_dokter]', kode_obat='$_POST[kode_obat]', kode_diagnosa='$_POST[kode_diagnosa]' WHERE no_rekam_medis = '$id'");
            echo "<script> location.href='?halaman=rekam_medis'; </script>";
        }
        ?>
      </div>
    </div>
  </div>
        
        <div id="deleteEmployeeModal<?= $aray['no_rekam_medis']; ?>" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="post">
          <div class="modal-header">            
            <h4 class="modal-title">Delete Data '<?php echo $aray['no_rekam_medis']; ?>'</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">          
          <?php
          $id_del = $aray['no_rekam_medis'];
          $del = $koneksi->query("SELECT * FROM rekam_medis WHERE no_rekam_medis='$id_del'");
          $rows = $del->fetch_assoc(); ?>
            <input type="hidden" name="id" value="<?php echo $rows['no_rekam_medis']; ?>">
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
            $koneksi->query("DELETE FROM rekam_medis WHERE no_rekam_medis = '$id' ");
            echo "<script>location.href='?halaman=rekam_medis';</script>";
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