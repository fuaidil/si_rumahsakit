<h4>Data Diagnosa</h4><hr>

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
                <label>Tanggal Pemeriksaan : </label>
                <input type="date" name="tgl_periksa" required class="form-control">

                <label>Hasil Pemeriksaan : </label>
                <input type="text" name="hasil" required class="form-control"><br>

                <select name="kode_dokter" required class="form-control">
                	<option value="">Select Dokter</option>
                 <?php $ambil1 = $koneksi->query("SELECT * FROM dokter"); ?>
		         <?php while($pecah1 = $ambil1->fetch_assoc()) : ?>
		           <option value="<?php echo $pecah1["kode_dokter"]; ?>"><?php echo $pecah1["nama_dokter"]; ?></option>
		         <?php endwhile; ?>
                </select><br>

                <select name="kode_pasien" required class="form-control">
                	<option value="">Select Pasien</option>
                <?php $ambil1 = $koneksi->query("SELECT * FROM reg_pasien"); ?>
		        <?php while($pecah1 = $ambil1->fetch_assoc()) : ?>
		           <option value="<?php echo $pecah1["kode_reg_pasien"]; ?>"><?php echo $pecah1["nama_pasien"]; ?></option>
		        <?php endwhile; ?>
                </select><br>

                <select name="kode_tindakan" required class="form-control">
                	<option value="">Select Tindakan</option>
                <?php $ambil1 = $koneksi->query("SELECT * FROM tindakan"); ?>
		        <?php while($pecah1 = $ambil1->fetch_assoc()) : ?>
		           <option value="<?php echo $pecah1["kode_tindakan"]; ?>"><?php echo $pecah1["nama_tindakan"]; ?></option>
		        <?php endwhile; ?>
                </select><br>

                <select name="status" required class="form-control">
                	<option value="">Select Status</option>
                	<option value="Sudah diperiksa">Sudah diperiksa</option>
                	<option value="Belum diperiksa">Belum diperiksa</option>
                </select><br>

                <select name="kode_ruang" required class="form-control">
                	<option value="">Select Ruangan</option>
                <?php $ambil1 = $koneksi->query("SELECT * FROM ruangan"); ?>
		        <?php while($pecah1 = $ambil1->fetch_assoc()) : ?>
		           <option value="<?php echo $pecah1["kode_ruang"]; ?>"><?php echo $pecah1["nama_ruang"]; ?></option>
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
          $tgl = $_POST["tgl_periksa"];
          $hasil = $_POST["hasil"];
          $kode_dokter = $_POST["kode_dokter"];
          $kode_pasien = $_POST["kode_pasien"];
          $kode_tindakan = $_POST["kode_tindakan"];
          $status = $_POST["status"];
          $kode_ruang = $_POST["kode_ruang"];

          $koneksi->query("INSERT INTO diagnosa VALUES(NULL,'$tgl','$hasil','$kode_dokter','$kode_pasien','$kode_tindakan','$status','$kode_ruang')");
          echo "<script> location.href='?halaman=diagnosa'; </script> ";
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
              <th>Tanggal Pemeriksaan</th>
              <th>Hasil Pemeriksaan</th>
              <th>Status Pemeriksaan</th>
              <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
          <?php $ambil = $koneksi->query("SELECT * FROM diagnosa "); ?>
          <?php while($aray = $ambil->fetch_assoc()) : ?>
          <tr>
            <td><?php echo $aray['kode_diagnosa']; ?></td>
            <td><?php echo $aray['tgl_pemeriksaan']; ?></td>
            <td><?php echo $aray['hasil_pemeriksaan']; ?></td>
            <td><?php echo $aray['status_pemeriksaan']; ?></td>
            <td>
              <button data-target="#showEmployeeModal<?= $aray['kode_diagnosa']; ?>" class="btn-sm btn-info" data-toggle="modal" title="Show data" style="cursor: pointer;"><i class="fas fa-eye"></i></button>
              <button data-target="#editEmployeeModal<?= $aray['kode_diagnosa']; ?>" class="btn-sm btn-success" data-toggle="modal" title="Edit" style="cursor: pointer;"><i class="fas fa-pencil-alt"></i></button>
              <button data-target="#deleteEmployeeModal<?= $aray['kode_diagnosa']; ?>" class="btn-sm btn-danger" data-toggle="modal" title="Delete" style="cursor: pointer;"><i class="fas fa-trash-alt" data-toggle="tooltip"></i></button>
            </td>
          </tr>
          <!-- Show Modal -->
          <div id="showEmployeeModal<?= $aray['kode_diagnosa']; ?>" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="post">
          <div class="modal-header">            
            <h4 class="modal-title">Show Data</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">
          <?php
            $id = $aray['kode_diagnosa'];
            $edit = $koneksi->query("SELECT * FROM diagnosa JOIN dokter ON dokter.kode_dokter=diagnosa.kode_dokter
            JOIN reg_pasien ON reg_pasien.kode_reg_pasien=diagnosa.kode_reg_pasien JOIN tindakan ON tindakan.kode_tindakan=diagnosa.kode_diagnosa
            JOIN ruangan ON ruangan.kode_ruang=diagnosa.kode_ruang WHERE kode_diagnosa = '$id' ");
            while ($row = $edit->fetch_assoc()) : ?>
          <input type="hidden" name="id" value="<?php echo $row['kode_diagnosa']; ?>">
            <label>Tanggal Pemeriksaan : </label>
                <input disabled class="form-control" value="<?php echo $row['tgl_pemeriksaan']; ?>">

                <label>Hasil Pemeriksaan : </label>
                <input class="form-control" value="<?php echo $row['hasil_pemeriksaan']; ?>" disabled>

                <label>Nama Dokter : </label>
                <input disabled class="form-control" value="<?php echo $row['nama_dokter']; ?>">

                <label>Nama Pasien : </label>
                <input class="form-control" value="<?php echo $row['nama_pasien']; ?>" disabled>

                <label>Nama Tindakan : </label>
                <input class="form-control" value="<?php echo $row['nama_tindakan']; ?>" disabled>

                <label>Status Pemeriksaan : </label>
                <input class="form-control" value="<?php echo $row['status_pemeriksaan']; ?>" disabled>

                <label>Nama Ruangan</label>
                <input class="form-control" value="<?php echo $row['nama_ruang']; ?>" disabled>
          </div>
        </form>
        <?php endwhile; ?>
      </div>
    </div>
  </div>
  <!-- Edit Modal HTML -->
  <div id="editEmployeeModal<?= $aray['kode_diagnosa']; ?>" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="post">
          <div class="modal-header">            
            <h4 class="modal-title">Edit Data</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">
          <?php
            $id = $aray['kode_diagnosa'];
            $edit = $koneksi->query("SELECT * FROM diagnosa WHERE kode_diagnosa = '$id' ");
            while ($row = $edit->fetch_assoc()) : ?>
          <input type="hidden" name="id" value="<?php echo $row['kode_diagnosa']; ?>">
            <label>Tanggal Pemeriksaan : </label>
                <input type="date" name="tgl" class="form-control" value="<?php echo $row['tgl_pemeriksaan']; ?>">

                <label>Hasil Pemeriksaan : </label>
                <input type="text" name="hasil" class="form-control" value="<?php echo $row['hasil_pemeriksaan']; ?>">

                <label>Dokter : </label>
                <select name="kode_dokter" required class="form-control">
                	<option value="<?php echo $row['kode_dokter']; ?>"><?php echo $row['kode_dokter']; ?></option>
                 <?php $ambil1 = $koneksi->query("SELECT * FROM dokter"); ?>
		         <?php while($pecah1 = $ambil1->fetch_assoc()) : ?>
		           <option value="<?php echo $pecah1["kode_dokter"]; ?>"><?php echo $pecah1["nama_dokter"]; ?></option>
		         <?php endwhile; ?>
                </select>

                <label>Pasien : </label>
                <select name="kode_pasien" required class="form-control">
                	<option value="<?php echo $row['kode_reg_pasien']; ?>"><?php echo $row['kode_reg_pasien']; ?></option>
                <?php $ambil1 = $koneksi->query("SELECT * FROM reg_pasien"); ?>
		        <?php while($pecah1 = $ambil1->fetch_assoc()) : ?>
		           <option value="<?php echo $pecah1["kode_reg_pasien"]; ?>"><?php echo $pecah1["nama_pasien"]; ?></option>
		        <?php endwhile; ?>
                </select>

                <label>Tindakan : </label>
                <select name="kode_tindakan" required class="form-control">
                	<option value="<?php echo $row['kode_tindakan']; ?>"><?php echo $row['kode_tindakan']; ?></option>
                <?php $ambil1 = $koneksi->query("SELECT * FROM tindakan"); ?>
		        <?php while($pecah1 = $ambil1->fetch_assoc()) : ?>
		           <option value="<?php echo $pecah1["kode_tindakan"]; ?>"><?php echo $pecah1["nama_tindakan"]; ?></option>
		        <?php endwhile; ?>
                </select>

                <label>Status : </label>
                <select name="status" required class="form-control">
                	<option value="<?php echo $row['status_pemeriksaan']; ?>"><?php echo $row['status_pemeriksaan']; ?></option>
                	<option value="Sudah diperiksa">Sudah diperiksa</option>
                	<option value="Belum diperiksa">Belum diperiksa</option>
                </select>

                <label>Ruangan : </label>
                <select name="kode_ruang" required class="form-control">
                	<option value="<?php echo $row['kode_ruang']; ?>"><?php echo $row['kode_ruang']; ?></option>
                <?php $ambil1 = $koneksi->query("SELECT * FROM ruangan"); ?>
		        <?php while($pecah1 = $ambil1->fetch_assoc()) : ?>
		           <option value="<?php echo $pecah1["kode_ruang"]; ?>"><?php echo $pecah1["nama_ruang"]; ?></option>
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
          if (isset($_POST["update"])) {
            $koneksi->query("UPDATE diagnosa SET tgl_pemeriksaan='$_POST[tgl]', hasil_pemeriksaan='$_POST[hasil]', kode_dokter='$_POST[kode_dokter]', kode_reg_pasien='$_POST[kode_pasien]', kode_tindakan='$_POST[kode_tindakan]', status_pemeriksaan='$_POST[status]', kode_ruang='$_POST[kode_ruang]' WHERE kode_diagnosa = '$_POST[id]' ");
            echo "<script>location.href='?halaman=diagnosa';</script>";
          }
        ?>
      </div>
    </div>
  </div>
  <!-- Delete Modal HTML -->
  <div id="deleteEmployeeModal<?= $aray['kode_diagnosa']; ?>" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="post">
          <div class="modal-header">            
            <h4 class="modal-title">Delete Data '<?php echo $aray['kode_diagnosa'] ?>'</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">
            <?php
              $id_del = $aray["kode_diagnosa"];
              $del = $koneksi->query("SELECT * FROM diagnosa WHERE kode_diagnosa = '$id_del'");
              while($rows = $del->fetch_assoc()) : ?>
            <input type="hidden" name="id" value="<?php echo $rows['kode_diagnosa']; ?>">
            <p>Are you sure want to <b class="text-danger">Delete</b> ?</p>
            <p class="text-warning"><small>This action cannot be undone.</small></p>
          </div>
          <div class="modal-footer">
            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
            <input type="submit" name="del" class="btn btn-danger" value="Delete">
          </div>
        </form>
        <?php endwhile; ?>
        <?php
          if (isset($_POST["del"])) {
            $koneksi->query("DELETE FROM diagnosa WHERE kode_diagnosa = '$_POST[id]'");
            echo "<script>location.href='?halaman=diagnosa';</script>";
          }
        ?>
      </div>
    </div>
  </div>
        <?php endwhile; ?>
        <tr class="notfound">
          <td colspan="6">
            <div class='alert alert-danger' style="text-align: center;">Data tidak ditemukan !</div>
          </td>
        </tr>
    </tbody>
  </table>