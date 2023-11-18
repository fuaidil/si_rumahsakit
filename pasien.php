      <h4>Data Pasien</h4><hr>
    
  <div class="row">
  &nbsp;&nbsp;&nbsp;<button class="btn-sm btn-primary" data-toggle="modal" data-target="#addEmployeeModal" style="cursor: pointer;"><i class="fas fa-plus"></i>&nbsp;&nbsp;Tambah Data</button><br>
  &nbsp;&nbsp;&nbsp;<button type="button" class="btn-sm btn-danger" name="del_pas" id="del_pas" style="cursor: pointer;">Hapus</button>
  &nbsp;&nbsp;&nbsp;<a type="button" class="btn-sm btn-secondary" role="button" href="d-pasien.php" target="_blank" style="cursor: pointer; text-decoration: none; ">Download</a>

  <div class="col-3 ml-auto">
  <input type="text" id="cari" placeholder="Search" class="form-control">
  </div>
  <form action="?halaman=edit-pasien" method="post">
  &nbsp;&nbsp;&nbsp;<button class="btn-sm btn-success" name="edit" style="cursor: pointer; position: absolute; left: 48%; height: 42px;">Edit</button>
  </div>
    <br>
    <table class="table table-hover table-striped nowrap" style="width:100%" id="example1">
        <thead>
            <tr>
              
              <th>Kode</th>
              <th>NIK</th>
              <th>Nama</th>
              <th>Alamat</th>
              <th>Jenis Kelamin</th>
              <th>Usia</th>
              <!-- <th>Aksi</th> -->
              <th>checkbox</th>
            </tr>
        </thead>
        <tbody>
          <?php $ambil = $koneksi->query("SELECT * FROM reg_pasien"); ?>
          <?php while($aray = $ambil->fetch_assoc()) : ?>
          <tr>
            
            <td><?php echo $aray['kode_reg_pasien']; ?></td>
            <td><?php echo $aray['nik']; ?></td>
            <td><?php echo $aray['nama_pasien']; ?></td>
            <td><?php echo $aray['alamat_pasien'] ?></td>
            <td><?php echo $aray['jeniskel']; ?></td>
            <td><?php echo $aray['usia']; ?></td>
            <td><input type="checkbox" name="idpas[]" value="<?= $aray['kode_reg_pasien']; ?>"></td>
          <!-- </form> -->
            <!-- <td> -->
              <!-- <button data-target="#showEmployeeModal<?= $aray['kode_reg_pasien']; ?>" class="btn-sm btn-info" data-toggle="modal" title="Show data" style="cursor: pointer;"><i class="fas fa-eye"></i></button>
              <button data-target="#editEmployeeModal<?= $aray['kode_reg_pasien']; ?>" class="btn-sm btn-success" data-toggle="modal" title="Edit" style="cursor: pointer;"><i class="fas fa-pencil-alt"></i></button> -->
              <!-- <input type="checkbox" name="del_pas[]" value="<?= $aray['kode_reg_pasien']; ?>"> -->
              <!-- <button data-target="#deleteEmployeeModal<?= $aray['kode_reg_pasien']; ?>" class="btn-sm btn-danger" data-toggle="modal" title="Delete" style="cursor: pointer;"><i class="fas fa-trash-alt" data-toggle="tooltip"></i></button> -->
            <!-- </td> -->
          </tr>



    <!-- <div id="showEmployeeModal<?= $aray['kode_reg_pasien']; ?>" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="post" enctype="multipart/form-data">
          <div class="modal-header">            
            <h4 class="modal-title">Show Data</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body"> -->
          <?php
            // $id = $aray['kode_reg_pasien'];
            // $edit = $koneksi->query("SELECT * FROM reg_pasien WHERE kode_reg_pasien = '$id'");
            // while ($row = $edit->fetch_assoc()) : ?>
            <!-- <input type="hidden" name="id" value="<?php echo $row['kode_reg_pasien']; ?>">
            <label>NIK : </label>
            <input disabled class="form-control" value="<?php echo $row['nik']; ?>">

            <label>Nama Pasien : </label>
            <input disabled class="form-control" value="<?php echo $row['nama_pasien']; ?>">

            <label>Alamat Pasien : </label>
            <input class="form-control" value="<?php echo $row['alamat_pasien']; ?>" disabled>

            <label>Jenis Kelamin : </label>
            <input value="<?php echo $row['jeniskel']; ?>" class="form-control" disabled>

            <label>Usia : </label>
            <input type="text" class="form-control" name="usia" value="<?php echo $row['usia']; ?>" required disabled>

            <label>No.Telp Pasien : </label>
            <input type="number" class="form-control" name="telepon" value="<?php echo $row['no_telp']; ?>" disabled>

            <label>Tanggal Daftar : </label>
            <input type="date" class="form-control" name="daftar" value="<?php echo $row['tgl_daftar']; ?>" required disabled>

            <label>Tempat Pemeriksaan :</label>
            <input type="text" class="form-control" name="tempat_periksa" value="<?php echo $row['tempat_pemeriksaan']; ?>" required disabled>
          </div>
        </form> -->
      <?php 
      // endwhile;
       ?>
      <!-- </div>
    </div>
  </div> -->
  
    <!-- <div id="editEmployeeModal<?= $aray['kode_reg_pasien']; ?>" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="post" enctype="multipart/form-data">
          <div class="modal-header">            
            <h4 class="modal-title">Edit Data</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body"> -->
          <?php
            // $id = $aray['kode_reg_pasien'];
            // $edit = $koneksi->query("SELECT * FROM reg_pasien WHERE kode_reg_pasien = '$id'");
            // while ($row = $edit->fetch_assoc()) : ?>
            <!-- <input type="hidden" name="id" value="<?php echo $row['kode_reg_pasien']; ?>">
            <label>NIK : </label>
            <input type="number" class="form-control" name="nik" value="<?php echo $row['nik']; ?>" required>

            <label>Nama Pasien : </label>
            <input type="text" class="form-control" name="nama" value="<?php echo $row['nama_pasien']; ?>" required>

            <label>Alamat Pasien : </label>
            <input type="text" class="form-control" name="alamat" value="<?php echo $row['alamat_pasien']; ?>" required>

            <label>Jenis Kelamin : </label>
            <select name="jeniskel" class="form-control" required>
              <option value="<?php echo $row['jeniskel']; ?>"><?php echo $row['jeniskel']; ?></option>
              <option value="Laki-Laki">Laki-Laki</option>
              <option value="Perempuan">Perempuan</option>
            </select>

            <label>No.Telp Pasien : </label>
            <input type="number" class="form-control" name="telepon" value="<?php echo $row['no_telp']; ?>" required>

            <label>Usia : </label>
            <input type="text" class="form-control" name="usia" value="<?php echo $row['usia']; ?>" required>

            <label>Tanggal Daftar : </label>
            <input type="date" class="form-control" name="daftar" value="<?php echo $row['tgl_daftar']; ?>" required>

            <label>Tempat Pemeriksaan :</label>
            <input type="text" class="form-control" name="tempat_periksa" value="<?php echo $row['tempat_pemeriksaan']; ?>" required>
          </div>
          <div class="modal-footer">
            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
            <input type="submit" name="update" class="btn btn-info" value="Update">
          </div>
        </form> -->
      <?php 
    // endwhile; 
    ?>
      <?php
        // $koneksi = new mysqli("localhost","root","","rumahsakit");
        // if (isset($_POST['update'])) {
        //   $id = $_POST['id'];
        //   $nik = $_POST['nik'];
        //   $nama = $_POST['nama'];
        //   $alamat = $_POST['alamat'];
        //   $jeniskel = $_POST['jeniskel'];
        //   $telp = $_POST['telepon'];
        //   $usia = $_POST['usia'];
        //   $daftar = $_POST['daftar'];
        //   $priksa = $_POST['tempat_periksa'];
          
        //   $koneksi->query("UPDATE reg_pasien SET nik='$nik', nama_pasien='$nama', alamat_pasien='$alamat', jeniskel='$jeniskel', no_telp='$telp', usia='$usia', tgl_daftar='$daftar', tempat_pemeriksaan='$priksa' WHERE kode_reg_pasien = '$id'");
        //     echo "<script> location.href='?halaman=pasien'; </script>";
        // }
        ?>
      <!-- </div>
    </div>
  </div> -->


      <!-- <div id="deleteEmployeeModal<?= $aray['kode_reg_pasien']; ?>" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="post">
          <div class="modal-header">            
            <h4 class="modal-title">Delete Data '<?php echo $aray['nik']; ?>'</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">           -->
          <?php
          // $id_del = $aray['kode_reg_pasien'];
          // $del = $koneksi->query("SELECT * FROM reg_pasien WHERE kode_reg_pasien='$id_del'");
          // $rows = $del->fetch_assoc(); ?>
            <!-- <input type="hidden" name="id" value="<?php echo $rows['kode_reg_pasien']; ?>">
            <p class="text-warning">Are you sure want to <b class="text-danger">Delete</b> ?</p>
            <p class="text-info"><small>This action cannot be undone.</small></p>
          </div>
          <div class="modal-footer">
            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
            <button type="submit" name="del" class="btn btn-danger">Delete</button>
          </div>
        </form> -->
        <?php  
          // if (isset($_POST["del"])) {
          //   $id = $_POST["id"];
          //   $koneksi->query("DELETE FROM reg_pasien WHERE kode_reg_pasien = '$id' ");
          //   echo "<script>location.href='?halaman=pasien';</script>";
          // }
        ?>
      <!-- </div>
    </div>
  </div> -->
        <?php endwhile; ?>
        <!-- <tr class="notfound">
          <td colspan="7">
            <div class='alert alert-danger' style="text-align: center;">Data tidak ditemukan !</div>
          </td>
        </tr> -->
        </tbody>
    </table>
          </form>


    <!-- tambah data -->
    <div id="addEmployeeModal" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="post" action="?halaman=tambah-pasien">
          <div class="modal-header">            
            <h4 class="modal-title">Tambah Data</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">
            <label>Masukkan jumlah yang akan diinput</label>
            <input type="number" name="jml" class="form-control" required>
                <!-- <label>NIK : </label>
                <input type="number" name="nik" required class="form-control">

                <label>Nama Pasien : </label>
                <input type="text" name="nama" required class="form-control">

                <label>Alamat Pasien : </label>
                <input type="text" name="alamat" required class="form-control">

                <label>Jenis Kelamin : </label>
                <select name="jeniskel" class="form-control">
                  <option value="Laki-Laki">Laki-Laki</option>
                  <option value="Perempuan">Perempuan</option>
                </select>

                <label>No.Telp Pasien : </label>
                <input type="number" name="telepon" required class="form-control">

                <label>Usia : </label>
                <input type="text" name="usia" required class="form-control">

                <label>Tanggal Daftar : </label>
                <input type="date" name="daftar" required class="form-control">

                <label>Tempat Pemeriksaan :</label>
                <input type="text" name="tempat_periksa" required class="form-control">        -->
          </div>
          <div class="modal-footer">
            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
            <input type="submit" name="save" class="btn btn-success" value="Add">
          </div>
        </form>
        <?php 
        // if (isset($_POST["save"])) 
        // {
        //   $nik = $_POST["nik"];
        //   $nama = $_POST["nama"];
        //   $alamat = $_POST["alamat"];
        //   $jeniskel = $_POST["jeniskel"];
        //   $telepon = $_POST["telepon"];
        //   $usia = $_POST["usia"];
        //   $daftar = $_POST["daftar"];
        //   $tmpt = $_POST["tempat_periksa"];

        //   $koneksi->query("INSERT INTO reg_pasien(nik,nama_pasien,alamat_pasien,jeniskel,no_telp,usia,tgl_daftar,tempat_pemeriksaan) VALUES('$nik','$nama','$alamat','$jeniskel','$telepon','$usia','$daftar','$tmpt')");
        //   echo "<script> location.href='?halaman=pasien'; </script> ";
        // }
      ?>
      </div>
    </div>
  </div>