  <h4>Data Perawat</h4>
  <hr>
  <div class="row">
  &nbsp;&nbsp;&nbsp;<button class="btn-sm btn-primary" data-toggle="modal" data-target="#addEmployeeModal" style="cursor: pointer;"><i class="fas fa-plus"></i>&nbsp;&nbsp;Tambah Data</button></center><br>
  <!-- <button type="button" class="btn-sm btn-danger" name="del_per" id="del_per">Hapus</button> -->
  <div id="addEmployeeModal" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="post">
          <div class="modal-header">            
            <h4 class="modal-title">Tambah Data</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">
                <label>Nama Perawat : </label>
                <input type="text" name="nama" required class="form-control">

                Jenis Kelamin : 
                <select name="jeniskel" class="form-control">
                  <option value="Laki-Laki">Laki-Laki</option>
                  <option value="Perempuan">Perempuan</option>
                </select>
                
                <label>Alamat Perawat : </label>
                <input type="text" name="alamat" required class="form-control">

                <label>Tanggal Lahir : </label>
                <input type="date" name="lahir" required class="form-control">

                <label>No.Telp Perawat : </label>
                <input type="number" name="telepon" required class="form-control">

                <label>Kode Ruang : </label>
                <select name="kode" class="form-control" required>
                  <option value="">Select Ruangan</option>
                <?php $ambil1 = $koneksi->query("SELECT * FROM ruangan"); ?>
                <?php while($pecah1 = $ambil1->fetch_assoc()) : ?>
                  <option value="<?php echo $pecah1["kode_ruang"]; ?>"><?php echo $pecah1["nama_ruang"]; ?></option>
                <?php endwhile; ?>
                </select>

                <label>Jam Jaga :</label>
                <input type="time" name="jam" required class="form-control">      
          </div>
          <div class="modal-footer">
            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
            <input type="submit" name="save" class="btn btn-success" value="Add">
          </div>
        </form>
        <?php 
        if (isset($_POST["save"])) 
        {
          $koneksi->query("INSERT INTO perawat VALUES(NULL, '$_POST[nama]','$_POST[jeniskel]','$_POST[alamat]','$_POST[lahir]','$_POST[telepon]','$_POST[kode]','$_POST[jam]')");
          echo "<script>location.href='?halaman=perawat'; </script>";
        }
      ?>
      </div>
    </div>
  </div>
  <div class="col-3 ml-auto">
    <input type="text" id="cari" class="form-control" placeholder="Search">
  </div>
</div>
<br>
      <table id="table" class="table table-striped table-hover nowrap" style="width: 100%;">
        <thead>
          <tr>
            <th>Kode</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Tanggal Lahir</th>
            <th>Nama Ruang</th>
            <!-- <th>checkbox</th> -->
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $ambil = $koneksi->query("SELECT * FROM perawat JOIN ruangan ON ruangan.kode_ruang=perawat.kode_ruang"); ?>
          <?php while($pecah = $ambil->fetch_assoc()) : ?>
          <tr>
            <td><?php echo $pecah['kode_perawat']; ?></td>
            <td><?php echo $pecah['nama_perawat']; ?></td>
            <td><?php echo $pecah['alamat_perawat'] ?></td>
            <td><?php echo $pecah['tgl_lahir']; ?></td>
            <td><?php echo $pecah['nama_ruang']; ?></td>
            <!-- <td><input type="checkbox" name="idd[]" value="<?php echo $pecah['kode_perawat']; ?>"></td> -->
            <td>
              <button data-target="#showEmployeeModal<?= $pecah['kode_perawat']; ?>" class="btn-sm btn-info" data-toggle="modal" data-code="code" data-company="company name" title="Show data" style="cursor: pointer;"><i class="fas fa-eye"></i></button>
              <button data-target="#editEmployeeModal<?= $pecah['kode_perawat']; ?>" class="btn-sm btn-success" data-toggle="modal" data-code="code" data-company="company name" title="Edit" style="cursor: pointer;"><i class="fas fa-pencil-alt"></i></button>
              <button data-target="#deleteEmployeeModal<?= $pecah['kode_perawat']; ?>" class="btn-sm btn-danger" data-toggle="modal" title="Delete" style="cursor: pointer;"><i class="fas fa-trash-alt"></i></button>
            </td>
          </tr>

    <div id="showEmployeeModal<?= $pecah['kode_perawat']; ?>" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="post">
          <div class="modal-header">            
            <h4 class="modal-title">Show Data</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">
          <?php
            $id = $pecah['kode_perawat'];
            $edit = $koneksi->query("SELECT * FROM perawat JOIN ruangan ON ruangan.kode_ruang=perawat.kode_ruang WHERE kode_perawat = '$id' ");
            while ($row = $edit->fetch_assoc()) : ?>
          <input type="hidden" name="id" value="<?php echo $row['kode_perawat']; ?>">
          <label>Nama Perawat : </label>
          <input type="text" class="form-control" name="nama" value="<?php echo $row['nama_perawat']; ?>" required disabled>

          <label>Jenis Kelamin</label>
          <input class="form-control" value="<?php echo $row['jeniskel']; ?>" disabled>

          <label>Alamat Perawat : </label>
          <input type="text" class="form-control" name="alamat" value="<?php echo $row['alamat_perawat']; ?>" required disabled>

          <label>Tanggal Lahir : </label>
          <input type="date" class="form-control" name="lahir" value="<?php echo $row['tgl_lahir']; ?>" required disabled>

          <label>No.Telp Perawat : </label>
          <input type="number" class="form-control" name="telepon" value="<?php echo $row['no_telp']; ?>" required disabled>

          <label>Nama Ruang : </label>
          <input type="text" class="form-control" name="kode" value="<?php echo $row['nama_ruang']; ?>" required disabled>

          <label>Jam Jaga :</label>
          <input type="text" class="form-control" name="jam" value="<?php echo $row['jam_jaga']; ?>" required disabled>
          </div>
        </form>
        <?php endwhile; ?>
      </div>
    </div>
  </div>
          <!-- Edit Modal HTML -->
  <div id="editEmployeeModal<?= $pecah['kode_perawat']; ?>" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="post">
          <div class="modal-header">            
            <h4 class="modal-title">Edit Data</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">
          <?php
            $id = $pecah['kode_perawat'];
            $edit = $koneksi->query("SELECT * FROM perawat WHERE kode_perawat = '$id' ");
            while ($row = $edit->fetch_assoc()) : ?>
          <input type="hidden" name="id" value="<?php echo $row['kode_perawat']; ?>">
          <label>Nama Perawat : </label>
          <input type="text" class="form-control" name="nama" value="<?php echo $row['nama_perawat']; ?>" required>

          <label>Jenis Kelamin : </label>
          <select name="jeniskel" class="form-control">
            <option value="<?php echo $row['jeniskel']; ?>"><?php echo $row['jeniskel']; ?></option>
            <option value="Laki-Laki">Laki-Laki</option>
            <option value="Perempuan">Perempuan</option>
          </select>

          <label>Alamat Perawat : </label>
          <input type="text" class="form-control" name="alamat" value="<?php echo $row['alamat_perawat']; ?>" required>

          <label>Tanggal Lahir : </label>
          <input type="date" class="form-control" name="lahir" value="<?php echo $row['tgl_lahir']; ?>" required>

          <label>No.Telp Perawat : </label>
          <input type="number" class="form-control" name="telepon" value="<?php echo $row['no_telp']; ?>" required>

          <label>Kode Ruang : </label>
          <select class="form-control" name="kode" value="<?php echo $row['kode_ruang']; ?>" required>
            <option value=" ">Select Ruangan</option>
          <?php $ambil1 = $koneksi->query("SELECT * FROM ruangan"); ?>
          <?php while($pecah1 = $ambil1->fetch_assoc()) : ?>
            <option value="<?php echo $pecah1["kode_ruang"]; ?>"><?php echo $pecah1["nama_ruang"]; ?></option>
          <?php endwhile; ?>
          </select>

          <label>Jam Jaga :</label>
          <input type="text" class="form-control" name="jam" value="<?php echo $row['jam_jaga']; ?>" required>
          </div>
          <div class="modal-footer">
            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
            <input type="submit" name="update" class="btn btn-info" value="Update">
          </div>
        </form>
        <?php endwhile; ?>
        <?php  
          if (isset($_POST["update"])) {

            $koneksi->query("UPDATE perawat SET nama_perawat='$_POST[nama]', jeniskel='$_POST[jeniskel]', alamat_perawat='$_POST[alamat]', tgl_lahir='$_POST[lahir]', no_telp='$_POST[telepon]', kode_ruang='$_POST[kode]', jam_jaga='$_POST[jam]' WHERE kode_perawat = '$_POST[id]'");
            echo "<script>location.href='?halaman=perawat'; </script>";
          }
        ?>
      </div>
    </div>
  </div>
  <div id="deleteEmployeeModal<?= $pecah['kode_perawat']; ?>" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="post">
          <div class="modal-header">            
            <h4 class="modal-title">Delete Data '<?php echo $pecah['nama_perawat'] ?>'</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">          
          <?php
          $id_del = $pecah['kode_perawat'];
          $del = $koneksi->query("SELECT * FROM perawat WHERE kode_perawat='$id_del'");
          $rows = $del->fetch_assoc(); ?>
            <input type="hidden" name="id" value="<?php echo $rows['kode_perawat']; ?>">
            <p class="text-warning">Are you sure want to <b class="text-danger">Delete</b> ?</p>
            <p class="text-secondary"><small>This action cannot be undone.</small></p>
          </div>
          <div class="modal-footer">
            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
            <button type="submit" name="del" class="btn btn-danger">Delete</button>
          </div>
        </form>
        <?php  
          if (isset($_POST["del"])) {
            $id = $_POST["id"];
            $koneksi->query("DELETE FROM perawat WHERE kode_perawat = '$id' ");
            echo "<script>location.href='?halaman=perawat';</script>";
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