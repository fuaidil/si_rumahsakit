      <h4>Data User</h4><hr>
    
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
                <label>Username : </label>
                <input type="text" name="username" required class="form-control">

                <label>Password : </label>
                <input type="text" name="password" required class="form-control">

                <label>Nama : </label>
                <input type="text" name="nama" required class="form-control">

                <label>Level : </label>
                <select class="form-control" name="level" required>
                  <option value="Operator">Operator</option>
                  <option value="Dokter">Dokter</option>
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
          $username = $_POST["username"];
          $password = $_POST["password"];
          $nama = $_POST["nama"];
          $level = $_POST["level"];

          $koneksi->query("INSERT INTO user(username,password,nama,level) VALUES('$username','$password','$nama','$level')");
          echo "<script> location.href='?halaman=user'; </script> ";
        }
      ?>
      </div>
    </div>
  </div>
    <div class="col-3 ml-auto">
    <input type="text" id="cari" placeholder="Search" class="form-control">
    </div>
  </div>
    <br>
    <table class="table table-hover table-striped nowrap" style="width:100%">
        <thead>
            <tr>
              <th>ID User</th>
              <th>Username</th>
              <th>Nama</th>
              <th>Level</th>
              <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
          <?php $ambil = $koneksi->query("SELECT * FROM user"); ?>
          <?php while($aray = $ambil->fetch_assoc()) : ?>
          <tr>
            <td><?php echo $aray['id_user']; ?></td>
            <td><?php echo $aray['username']; ?></td>
            <td><?php echo $aray['nama'] ?></td>
            <td><?php echo $aray['level']; ?></td>
            <td>
              <button data-target="#showEmployeeModal<?= $aray['id_user']; ?>" class="btn-sm btn-info" data-toggle="modal" title="Show data" style="cursor: pointer;"><i class="fas fa-eye"></i></button>
              <button data-target="#editEmployeeModal<?= $aray['id_user']; ?>" class="btn-sm btn-success" data-toggle="modal" title="Edit" style="cursor: pointer;"><i class="fas fa-pencil-alt"></i></button>
              <button data-target="#deleteEmployeeModal<?= $aray['id_user']; ?>" class="btn-sm btn-danger" data-toggle="modal" title="Delete" style="cursor: pointer;"><i class="fas fa-trash-alt" data-toggle="tooltip"></i></button>
            </td>
          </tr>
    <div id="showEmployeeModal<?= $aray['id_user']; ?>" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="post" enctype="multipart/form-data">
          <div class="modal-header">            
            <h4 class="modal-title">Data <?php echo $aray['nama']; ?></h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">
          <?php
            $id = $aray['id_user'];
            $edit = $koneksi->query("SELECT * FROM user WHERE id_user = '$id'");
            while ($row = $edit->fetch_assoc()) : ?>
            <input type="hidden" name="id" value="<?php echo $row['id_user']; ?>">
            <label>Username : </label>
            <input disabled class="form-control" value="<?php echo $row['username']; ?>">

            <label>Password : </label>
            <input type="text" disabled class="form-control" value="<?php echo $row['password']; ?>">

            <label>Nama : </label>
            <input class="form-control" value="<?php echo $row['nama']; ?>" disabled>

            <label>Level : </label>
            <input value="<?php echo $row['level']; ?>" class="form-control" disabled>
          </div>
        </form>
      <?php endwhile; ?>
      </div>
    </div>
  </div>
  
    <div id="editEmployeeModal<?= $aray['id_user']; ?>" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="post" enctype="multipart/form-data">
          <div class="modal-header">            
            <h4 class="modal-title">Edit Data '<?php echo $aray['nama']; ?>'</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">
          <?php
            $id = $aray['id_user'];
            $edit = $koneksi->query("SELECT * FROM user WHERE id_user = '$id'");
            while ($row = $edit->fetch_assoc()) : ?>
            <input type="hidden" name="id" value="<?php echo $row['id_user']; ?>">
            <label>Username : </label>
            <input type="text" class="form-control" name="username" value="<?php echo $row['username']; ?>" required>

            <label>Password : </label>
            <input type="password" class="form-control" name="password" value="<?php echo $row['password']; ?>" required>

            <label>Nama : </label>
            <input type="text" class="form-control" name="nama" value="<?php echo $row['nama']; ?>" required>

            <label>Level : </label>
            <input type="text" class="form-control" value="<?php echo $row['level']; ?>" required disabled>
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
          $id = $_POST['id'];
          $username = $_POST['username'];
          $password = $_POST['password'];
          $nama = $_POST['nama'];
          
          $koneksi->query("UPDATE user SET username='$username', password='$password', nama='$nama' WHERE id_user = '$id'");
            echo "<script> location.href='?halaman=user'; </script>";
        }
        ?>
      </div>
    </div>
  </div>
      <div id="deleteEmployeeModal<?= $aray['id_user']; ?>" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="post">
          <div class="modal-header">            
            <h4 class="modal-title">Delete Data '<?php echo $aray['nama']; ?>'</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">          
          <?php
          $id_del = $aray['id_user'];
          $del = $koneksi->query("SELECT * FROM user WHERE id_user='$id_del'");
          $rows = $del->fetch_assoc(); ?>
            <input type="hidden" name="id" value="<?php echo $rows['id_user']; ?>">
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
            $koneksi->query("DELETE FROM user WHERE id_user = '$id' ");
            echo "<script>location.href='?halaman=user';</script>";
          }
        ?>
      </div>
    </div>
  </div>
        <?php endwhile; ?>
        <tr class="notfound">
          <td colspan="5">
            <div class='alert alert-danger' style="text-align: center;">Data tidak ditemukan !</div>
          </td>
        </tr>
        </tbody>
    </table>