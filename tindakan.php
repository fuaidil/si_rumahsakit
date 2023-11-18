<h4>Data Tindakan</h4><hr>

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
                <label>Nama Tindakan : </label>
                <input type="text" name="nama" required class="form-control">

                <label>Biaya Tindakan : </label>
                <input type="number" name="biaya" required class="form-control">
          </div>
          <div class="modal-footer">
            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
            <input type="submit" name="save" class="btn btn-success" value="Add">
          </div>
        </form>
        <?php 
        if (isset($_POST["save"])) 
        {

          $koneksi->query("INSERT INTO tindakan VALUES(NULL, '$_POST[nama]',$_POST[biaya])");
          echo "<script> location.href='?halaman=tindakan'; </script> ";
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
              <th>Nama Tindakan</th>
              <th>Biaya Tindakan</th>
              <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
          <?php $ambil = $koneksi->query("SELECT * FROM tindakan"); ?>
          <?php while($aray = $ambil->fetch_assoc()) : ?>
          <tr>
            <td><?php echo $aray['kode_tindakan']; ?></td>
            <td><?php echo $aray['nama_tindakan']; ?></td>
            <td>IDR <?php echo number_format($aray['biaya_tindakan']); ?></td>
            <td>
              <button data-target="#editEmployeeModal<?= $aray['kode_tindakan']; ?>" class="btn-sm btn-success" data-toggle="modal" title="Edit" style="cursor: pointer;"><i class="fas fa-pencil-alt"></i></button>
              <button data-target="#deleteEmployeeModal<?= $aray['kode_tindakan']; ?>" class="btn-sm btn-danger" data-toggle="modal" title="Delete" style="cursor: pointer;"><i class="fas fa-trash-alt" data-toggle="tooltip"></i></button>
            </td>
          </tr>
  <!-- Edit Modal HTML -->
  <div id="editEmployeeModal<?= $aray['kode_tindakan']; ?>" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="post">
          <div class="modal-header">            
            <h4 class="modal-title">Edit Data</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">
          <?php
            $id = $aray['kode_tindakan'];
            $edit = $koneksi->query("SELECT * FROM tindakan WHERE kode_tindakan = '$id' ");
            while ($row = $edit->fetch_assoc()) : ?>
          <input type="hidden" name="id" value="<?php echo $row['kode_tindakan']; ?>">
            <label>Nama tindakan : </label>
                <input type="text" name="nama" class="form-control" value="<?php echo $row['nama_tindakan']; ?>">

                <label>Biaya Tindakan : </label>
                <input type="number" name="biaya" class="form-control" value="<?php echo $row['biaya_tindakan']; ?>">
          </div>
          <div class="modal-footer">
            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
            <input type="submit" name="update" class="btn btn-info" value="Update">
          </div>
        </form>
        <?php endwhile; ?>
        <?php  
          if (isset($_POST["update"])) {
            $koneksi->query("UPDATE tindakan SET nama_tindakan='$_POST[nama]',biaya_tindakan='$_POST[biaya]' WHERE kode_tindakan = '$_POST[id]' ");
            echo "<script>location.href='?halaman=tindakan';</script>";
          }
        ?>
      </div>
    </div>
  </div>
  <!-- Delete Modal HTML -->
  <div id="deleteEmployeeModal<?= $aray['kode_tindakan']; ?>" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="post">
          <div class="modal-header">            
            <h4 class="modal-title">Delete Data '<?php echo $aray['kode_tindakan']; ?>'</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">          
          <?php
          $id_del = $aray['kode_tindakan'];
          $del = $koneksi->query("SELECT * FROM tindakan WHERE kode_tindakan='$id_del'");
          $rows = $del->fetch_assoc(); ?>
            <input type="hidden" name="id" value="<?php echo $rows['kode_tindakan']; ?>">
            <p>Are you sure want to <b class="text-danger">Delete</b> ?</p>
            <p class="text-warning"><small>This action cannot be undone.</small></p>
          </div>
          <div class="modal-footer">
            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
            <button type="submit" name="del" class="btn btn-danger">Delete</button>
          </div>
        </form>
        <?php  
          if (isset($_POST["del"])) {
            $id = $_POST["id"];
            $koneksi->query("DELETE FROM tindakan WHERE kode_tindakan = '$id' ");
            echo "<script>location.href='?halaman=tindakan';</script>";
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