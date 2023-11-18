<h4>Data Administrasi</h4><hr>

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
                <label>Tanggal Administrasi : </label>
                <input type="date" name="tgl_admin" required class="form-control"><br>

                <select name="kode_pasien" required class="form-control">
                  <option value="">Select Pasien</option>
                <?php $ambil1 = $koneksi->query("SELECT * FROM reg_pasien"); ?>
                <?php while($pecah1 = $ambil1->fetch_assoc()) : ?>
                   <option value="<?php echo $pecah1["kode_reg_pasien"]; ?>"><?php echo $pecah1["nama_pasien"]; ?></option>
                <?php endwhile; ?>
                </select><br>

                <select name="kode_diagnosa" required class="form-control">
                  <option value="">Select Diagnosa</option>
                <?php $ambil1 = $koneksi->query("SELECT * FROM diagnosa"); ?>
                <?php while($pecah1 = $ambil1->fetch_assoc()) : ?>
                   <option value="<?php echo $pecah1["kode_diagnosa"]; ?>"><?php echo $pecah1["kode_diagnosa"]; ?></option>
                <?php endwhile; ?>
                </select><br>

                <select name="kode_resep" required class="form-control">
                  <option value="">Select Resep</option>
                <?php $ambil1 = $koneksi->query("SELECT * FROM resep"); ?>
                <?php while($pecah1 = $ambil1->fetch_assoc()) : ?>
                   <option value="<?php echo $pecah1["kode_resep"]; ?>"><?php echo $pecah1["kode_resep"]; ?></option>
                <?php endwhile; ?>
                </select><br>

                <select name="kode_obat" required class="form-control">
                	<option value="">Select Obat</option>
                <?php $ambil1 = $koneksi->query("SELECT * FROM obat"); ?>
    		        <?php while($pecah1 = $ambil1->fetch_assoc()) : ?>
    		           <option value="<?php echo $pecah1["kode_obat"]; ?>"><?php echo $pecah1["nama_obat"]; ?></option>
    		        <?php endwhile; ?>
                </select>

                <label>Lama Menginap : </label>
                <input type="text" name="lama" class="form-control" required>

                <label>Biaya Administrasi : </label>
                <input type="number" name="biaya" class="form-control" required>

          </div>
          <div class="modal-footer">
            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
            <input type="submit" name="save" class="btn btn-success" value="Add">
          </div>
        </form>
        <?php 
        if (isset($_POST["save"])) 
        {
          $ppn = $_POST["biaya"] * (10/100);
          $total = $_POST["biaya"] + $ppn;
          $koneksi->query("INSERT INTO administrasi VALUES(NULL,'$_POST[tgl_admin]','$_POST[kode_pasien]','$_POST[kode_diagnosa]','$_POST[kode_resep]','$_POST[kode_obat]','$_POST[lama]','$_POST[biaya]','$ppn','$total')");
          echo "<script> location.href='?halaman=administrasi'; </script> ";
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
              <th>Tanggal Administrasi</th>
              <th>Biaya Administrasi</th>
              <th>PPN 10%</th>
              <th>Total Bayar</th>
              <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
          <?php $ambil = $koneksi->query("SELECT * FROM administrasi"); ?>
          <?php while($aray = $ambil->fetch_assoc()) : ?>
          <tr>
            <td><?php echo $aray['no_administrasi']; ?></td>
            <td><?php echo $aray['tgl_administrasi']; ?></td>
            <td>IDR <?php echo number_format($aray['biaya_administrasi']); ?></td>
            <td>IDR <?php echo number_format($aray['ppn']); ?></td>
            <td>IDR <?php echo number_format($aray['total_bayar']); ?></td>
            <td>
              <button data-target="#showEmployeeModal<?= $aray['no_administrasi']; ?>" class="btn-sm btn-info" data-toggle="modal" title="Show data" style="cursor: pointer;"><i class="fas fa-eye"></i></button>
              <button data-target="#editEmployeeModal<?= $aray['no_administrasi']; ?>" class="btn-sm btn-success" data-toggle="modal" title="Edit" style="cursor: pointer;"><i class="fas fa-pencil-alt"></i></button>
              <button data-target="#deleteEmployeeModal<?= $aray['no_administrasi']; ?>" class="btn-sm btn-danger" data-toggle="modal" title="Delete" style="cursor: pointer;"><i class="fas fa-trash-alt" data-toggle="tooltip"></i></button>
            </td>
          </tr>
          <!-- Show Modal -->
          <div id="showEmployeeModal<?= $aray['no_administrasi']; ?>" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="post" enctype="multipart/form-data">
          <div class="modal-header">            
            <h4 class="modal-title">Show Data</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">
          <?php
            $id = $aray['no_administrasi'];
            $edit = $koneksi->query("SELECT * FROM administrasi JOIN diagnosa ON diagnosa.kode_diagnosa=administrasi.kode_diagnosa 
            JOIN reg_pasien ON reg_pasien.kode_reg_pasien=diagnosa.kode_reg_pasien
            JOIN resep ON resep.kode_resep=administrasi.kode_resep 
            JOIN obat ON obat.kode_obat=resep.kode_obat WHERE no_administrasi = '$id'");
            while ($row = $edit->fetch_assoc()) : ?>
            <input type="hidden" name="id" value="<?php echo $row['no_administrasi']; ?>">
            <label>Tanggal Administrasi : </label>
            <input disabled class="form-control" value="<?php echo $row['tgl_administrasi']; ?>">

            <label>Nama Pasien : </label>
            <input disabled class="form-control" value="<?php echo $row['nama_pasien']; ?>">

            <label>Nama Diagnosa : </label>
            <input class="form-control" value="<?php echo $row['hasil_pemeriksaan']; ?>" disabled>

            <label>Nama Resep : </label>
            <input class="form-control" value="<?php echo $row['kode_resep']; ?>" disabled>

            <label>Nama Obat : </label>
            <input value="<?php echo $row['kode_obat']; ?>" class="form-control" disabled>

            <label>Lama Menginap : </label>
            <input class="form-control" value="<?php echo $row['lama_menginap']; ?>" disabled>

            <label>Biaya Administrasi : </label>
            <input class="form-control" value="<?php echo number_format($row['biaya_administrasi']); ?>" disabled>

            <label>PPN 10% : </label>
            <input class="form-control" value="<?php echo number_format($row['ppn']); ?>" disabled>

            <label>Total Bayar : </label>
            <input class="form-control" value="<?php echo number_format($row['total_bayar']); ?>" disabled>            
          </div>
        </form>
      <?php endwhile; ?>
      </div>
    </div>
  </div>
          <!-- Edit Modal -->
          <div id="editEmployeeModal<?= $aray['no_administrasi']; ?>" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="post" enctype="multipart/form-data">
          <div class="modal-header">            
            <h4 class="modal-title">Edit Data</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">
          <?php
            $id = $aray['no_administrasi'];
            $edit = $koneksi->query("SELECT * FROM administrasi JOIN diagnosa ON diagnosa.kode_diagnosa=administrasi.kode_diagnosa 
            JOIN reg_pasien ON reg_pasien.kode_reg_pasien=diagnosa.kode_reg_pasien
            JOIN resep ON resep.kode_resep=administrasi.kode_resep 
            JOIN obat ON obat.kode_obat=resep.kode_obat WHERE no_administrasi = '$id'");
            while ($row = $edit->fetch_assoc()) : ?>
          <input type="hidden" name="id" value="<?php echo $row['no_administrasi']; ?>">
            <label>Tanggal Administrasi : </label>
            <input name="tgl_admin" type="date" class="form-control" value="<?php echo $row['tgl_administrasi']; ?>">

            <label>Pasien : </label>
            <select name="kode_pasien" required class="form-control">
                  <option value="<?php echo $row['kode_reg_pasien'] ?>"><?php echo $row['nama_pasien'] ?></option>
                <?php $ambil1 = $koneksi->query("SELECT * FROM reg_pasien"); ?>
                <?php while($pecah1 = $ambil1->fetch_assoc()) : ?>
                   <option value="<?php echo $pecah1["kode_reg_pasien"]; ?>"><?php echo $pecah1["nama_pasien"]; ?></option>
                <?php endwhile; ?>
                </select>

                <label>Diagnosa : </label>
                <select name="kode_diagnosa" required class="form-control">
                  <option value="<?php echo $row['kode_diagnosa'] ?>"><?php echo $row['hasil_pemeriksaan'] ?></option>
                <?php $ambil1 = $koneksi->query("SELECT * FROM diagnosa"); ?>
                <?php while($pecah1 = $ambil1->fetch_assoc()) : ?>
                   <option value="<?php echo $pecah1["kode_diagnosa"]; ?>"><?php echo $pecah1["kode_diagnosa"]; ?></option>
                <?php endwhile; ?>
                </select>

                <label>Resep : </label>
                <select name="kode_resep" required class="form-control">
                  <option value="<?php echo $row['kode_resep'] ?>"><?php echo $row['kode_resep'] ?></option>
                <?php $ambil1 = $koneksi->query("SELECT * FROM resep"); ?>
                <?php while($pecah1 = $ambil1->fetch_assoc()) : ?>
                   <option value="<?php echo $pecah1["kode_resep"]; ?>"><?php echo $pecah1["kode_resep"]; ?></option>
                <?php endwhile; ?>
                </select>

                <label>Obat : </label>
                <select name="kode_obat" required class="form-control">
                  <option value="<?php echo $row['kode_obat'] ?>"><?php echo $row['nama_obat'] ?></option>
                <?php $ambil1 = $koneksi->query("SELECT * FROM obat"); ?>
                <?php while($pecah1 = $ambil1->fetch_assoc()) : ?>
                   <option value="<?php echo $pecah1["kode_obat"]; ?>"><?php echo $pecah1["nama_obat"]; ?></option>
                <?php endwhile; ?>
                </select>            

            <label>Lama Menginap : </label>
            <input type="text" name="lama" class="form-control" value="<?php echo $row['lama_menginap']; ?>">

            <label>Biaya Administrasi : </label>
            <input class="form-control" name="biaya" type="number" value="<?php echo $row['biaya_administrasi']; ?>">
          </div>
          <div class="modal-footer">
            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
            <input type="submit" name="update" class="btn btn-info" value="Update">
          </div>
        </form>
      <?php endwhile; ?>
      <?php
        if (isset($_POST["update"])) {
          
          $ppn = $_POST["biaya"] * (10/100);
          $total = $_POST["biaya"] + $ppn;
          $koneksi->query("UPDATE administrasi SET tgl_administrasi='$_POST[tgl_admin]', kode_reg_pasien='$_POST[kode_pasien]', kode_diagnosa='$_POST[kode_diagnosa]', kode_resep='$_POST[kode_resep]', kode_obat='$_POST[kode_obat]', lama_menginap='$_POST[lama]', biaya_administrasi='$_POST[biaya]', ppn='$ppn', total_bayar='$total' WHERE no_administrasi = '$id'");
          echo "<script> location.href='?halaman=administrasi'; </script> ";
        }
        ?>
      </div>
    </div>
  </div>
        
        <div id="deleteEmployeeModal<?= $aray['no_administrasi']; ?>" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="post">
          <div class="modal-header">            
            <h4 class="modal-title">Delete Data '<?php echo $aray['no_administrasi']; ?>'</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">          
          <?php
          $id_del = $aray['no_administrasi'];
          $del = $koneksi->query("SELECT * FROM administrasi WHERE no_administrasi='$id_del'");
          $rows = $del->fetch_assoc(); ?>
            <input type="hidden" name="id" value="<?php echo $rows['no_administrasi']; ?>">
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
            $koneksi->query("DELETE FROM administrasi WHERE no_administrasi = '$id' ");
            echo "<script>location.href='?halaman=administrasi';</script>";
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