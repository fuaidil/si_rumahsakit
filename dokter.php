  <h4>Data Dokter</h4>
  <hr>
  <div class="row">
  &nbsp;&nbsp;&nbsp;<button data-target="#addEmployeeModal" class="btn-sm btn-primary" data-toggle="modal" style="cursor: pointer;"><i class="fas fa-plus"></i>&nbsp;&nbsp;Tambah Data</button></center>

  <div id="addEmployeeModal" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="post">
          <div class="modal-header">            
            <h4 class="modal-title">Tambah Data</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">
            <label>No. Praktek : </label>
                <input type="text" name="no_prak" required class="form-control">

                <label>Nama Dokter : </label>
                <input type="text" name="nama" required class="form-control">

                <label>Jenis Kelamin : </label>
                <select name="jeniskel" class="form-control" required>
                  <option value="Laki-Laki">Laki-Laki</option>
                  <option value="Perempuan">Perempuan</option>
                </select>

                <label>Alamat Dokter : </label>
                <input type="text" name="alamat" required class="form-control">

                <label>No.Telp Dokter : </label>
                <input type="number" name="telepon" required class="form-control">

                <label>Spesialis : </label>
                <select type="text" name="spesialis" required class="form-control">
                  <option value="">Pilih Spesialis</option>
                  <option value="Umum">Umum</option>
                  <option value="Kulit dan Kelamin">Kulit dan Kelamin</option>
                  <option value="Anak">Anak</option>
                  <option value="Mulut dan Gigi">Mulut dan Gigi</option>
                  <option value="Penyakit Dalam">Penyakit Dalam</option>
                  <option value="Mata">Mata</option>
                  <option value="Gizi">Gizi</option>
                  <option value="Jantung">Jantung</option>
                  <option value="Bedah">Bedah</option>
                  <option value="Saraf">Saraf</option>
                  <option value="Kandungan">Kandungan</option>
                  <option value="THT">THT</option>
                  <option value="Orthopedi dan Traumatologi">Orthopedi dan Traumatologi</option>
                </select>

                <label>Jam Praktek : </label>
                <input type="time" name="jam_prak" required class="form-control">
          </div>
          <div class="modal-footer">
            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
            <input type="submit" name="add" class="btn btn-success" value="Add">
          </div>
        </form>
        <?php
          if (isset($_POST["add"])) {
            $koneksi->query("INSERT INTO dokter VALUES (NULL, '$_POST[nama]','$_POST[jeniskel]','$_POST[alamat]','$_POST[telepon]', '$_POST[spesialis]', '$_POST[jam_prak]', '$_POST[no_prak]')");
            echo "<script>location.href='?halaman=dokter';</script>";
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
  <table id="table" class="table table-striped table-hover nowrap" style="width: 100%;">
    <thead>
      <tr>
        <th>Kode</th>
        <th>No. Praktek</th>
        <th>Nama</th>
        <th>Alamat</th>
        <th>Spesialis</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php $ambil = $koneksi->query("SELECT * FROM dokter"); ?>
      <?php while($pecah = $ambil->fetch_assoc()) : ?>
      <tr>
        <td><?php echo $pecah['kode_dokter']; ?></td>
        <td><?php echo $pecah['no_praktek']; ?></td>
        <td><?php echo $pecah['nama_dokter']; ?></td>
        <td><?php echo $pecah['alamat_dokter'] ?></td>
        <td><?php echo $pecah['spesialis']; ?></td>
        <td>
          <button data-target="#showEmployeeModal<?= $pecah['kode_dokter']; ?>" class="btn-sm btn-info" data-toggle="modal" data-code="code" data-company="company name" title="Show data" style="cursor: pointer;"><i class="fas fa-eye"></i></button>
          <button data-target="#editEmployeeModal<?= $pecah['kode_dokter']; ?>" class="btn-sm btn-success" data-toggle="modal" data-code="code" data-company="company name" title="Edit" style="cursor: pointer;"><i class="fas fa-pencil-alt"></i></button>
          <button data-target="#deleteEmployeeModal<?= $pecah['kode_dokter']; ?>" class="btn-sm btn-danger" data-toggle="modal" title="Delete" style="cursor: pointer;"><i class="fas fa-trash-alt"></i></button>
        </td>
      </tr>
    <div id="showEmployeeModal<?= $pecah['kode_dokter']; ?>" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="post">
          <div class="modal-header">            
            <h4 class="modal-title">Show Data</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">
          <?php
            $id = $pecah['kode_dokter'];
            $edit = $koneksi->query("SELECT * FROM dokter WHERE kode_dokter = '$id' ");
            while ($row = $edit->fetch_assoc()) : ?>
          <input type="hidden" name="id" value="<?php echo $row['kode_dokter']; ?>">
              <label>No. Praktek :</label>
              <input type="text" class="form-control" name="no_prak" value="<?php echo $row['no_praktek']; ?>" required disabled>

              <label>Nama Dokter : </label>
              <input type="text" class="form-control" name="nama" value="<?php echo $row['nama_dokter']; ?>" required disabled>

              <label>Alamat Dokter : </label>
              <input type="text" class="form-control" name="alamat" value="<?php echo $row['alamat_dokter']; ?>" required disabled>

              <label>Jenis Kelamin : </label>
              <input type="text" value="<?php echo $row['jeniskel']; ?>" class="form-control" disabled>

              <label>No.Telp Pasien : </label>
              <input type="number" class="form-control" name="telepon" value="<?php echo $row['no_telp']; ?>" required disabled>

              <label>Spesialis : </label>
              <input class="form-control" value="<?php echo $row['spesialis']; ?>" disabled>

              <label>Jam Praktek : </label>
              <input type="time" class="form-control" name="jam_prak" value="<?php echo $row['jam_praktek']; ?>" required disabled>
            </div>
          </form>
        <?php endwhile; ?>
      </div>
    </div>
  </div>
  <!-- <?php if ($_SESSION['level'] !== "Dokter"): ?> -->
    
  <!-- Edit Modal HTML -->
  <div id="editEmployeeModal<?= $pecah['kode_dokter']; ?>" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="post">
          <div class="modal-header">            
            <h4 class="modal-title">Edit Data</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">
          <?php
            $id = $pecah['kode_dokter'];
            $edit = $koneksi->query("SELECT * FROM dokter WHERE kode_dokter = '$id' ");
            while ($row = $edit->fetch_assoc()) : ?>
          <input type="hidden" name="id" value="<?php echo $row['kode_dokter']; ?>">
              <label>No. Praktek : </label>
              <input type="text" class="form-control" name="no_prak" value="<?php echo $row['no_praktek']; ?>" required>

              <label>Nama Dokter : </label>
              <input type="text" class="form-control" name="nama" value="<?php echo $row['nama_dokter']; ?>" required>

              <label>Alamat Dokter : </label>
              <input type="text" class="form-control" name="alamat" value="<?php echo $row['alamat_dokter']; ?>" required>

              <label>Jenis Kelamin : </label>
                <select name="jeniskel" class="form-control" required>
                  <option value="<?php echo $row['jeniskel']; ?>"><?php echo $row['jeniskel']; ?></option>
                  <option value="Laki-Laki">Laki-Laki</option>
                  <option value="Perempuan">Perempuan</option>
                </select>

              <label>No.Telp Pasien : </label>
              <input type="number" class="form-control" name="telepon" value="<?php echo $row['no_telp']; ?>" required>

              <label>Spesialis : </label>
                <select type="text" name="spesialis" required class="form-control">
                  <option value="<?php echo $row['spesialis']; ?>"><?php echo $row['spesialis']; ?></option>
                  <option value="Umum">Umum</option>
                  <option value="Kulit dan Kelamin">Kulit dan Kelamin</option>
                  <option value="Anak">Anak</option>
                  <option value="Mulut dan Gigi">Mulut dan Gigi</option>
                  <option value="Penyakit Dalam">Penyakit Dalam</option>
                  <option value="Mata">Mata</option>
                  <option value="Gizi">Gizi</option>
                  <option value="Jantung">Jantung</option>
                  <option value="Bedah">Bedah</option>
                  <option value="Saraf">Saraf</option>
                  <option value="Kandungan">Kandungan</option>
                  <option value="THT">THT</option>
                  <option value="Orthopedi dan Traumatologi">Orthopedi dan Traumatologi</option>
                </select>

      <label>Jam Praktek : </label>
      <input type="time" class="form-control" name="jam_prak" value="<?php echo $row['jam_praktek']; ?>" required>
          </div>
          <div class="modal-footer">
            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
            <input type="submit" name="update" class="btn btn-info" value="Update">
          </div>
        </form>
        <?php endwhile; ?>
        <?php  
          if (isset($_POST["update"])) {
            $koneksi->query("UPDATE dokter SET nama_dokter='$_POST[nama]', alamat_dokter='$_POST[alamat]', jeniskel='$_POST[jeniskel]', no_telp='$_POST[telepon]', spesialis='$_POST[spesialis]', jam_praktek='$_POST[jam_prak]', no_praktek='$_POST[no_prak]' WHERE kode_dokter = $_POST[id]");
            echo "<script>location.href='?halaman=dokter';</script>";
          }
        ?>
      </div>
    </div>
  </div>
  <!-- Delete Modal HTML -->
  <div id="deleteEmployeeModal<?= $pecah['kode_dokter']; ?>" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="post">
          <div class="modal-header">            
            <h4 class="modal-title">Delete Data '<?php echo $pecah['no_praktek']; ?>'</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">
            <?php
              $id_del = $pecah["kode_dokter"];
              $del = $koneksi->query("SELECT * FROM dokter WHERE kode_dokter = '$id_del'");
              $rows = $del->fetch_assoc(); ?>
            <input type="hidden" name="id" value="<?php echo $rows['kode_dokter']; ?>">
            <p>Are you sure want to <b class="text-danger">Delete</b> ?</p>
            <p class="text-warning"><small>This action cannot be undone.</small></p>
          </div>
          <div class="modal-footer">
            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
            <input type="submit" name="del" class="btn btn-danger" value="Delete">
          </div>
        </form>
        <?php
          if (isset($_POST["del"])) {
            $koneksi->query("DELETE FROM dokter WHERE kode_dokter = '$_POST[id]'");
            echo "<script>location.href='?halaman=dokter';</script>";
          }
        ?>
      </div>
    </div>
  </div>
  <!-- <?php endif ?> -->
        <?php endwhile; ?>
        <tr class="notfound">
          <td colspan="6">
            <div class='alert alert-danger' style="text-align: center;">Data tidak ditemukan !</div>
          </td>
        </tr>
    </tbody>
  </table>
</div>