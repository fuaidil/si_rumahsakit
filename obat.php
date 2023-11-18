 <h4>Data Obat</h4>
  <hr>
  <div class="row">
  &nbsp;&nbsp;&nbsp;<button data-target="#addEmployeeModal" class="btn-sm btn-primary" data-toggle="modal" style="cursor: pointer;"><i class="fas fa-plus"></i>&nbsp;&nbsp;Tambah Data</button>
  <br>
  <!-- Add Modal HTML -->
  <div id="addEmployeeModal" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="post">
          <div class="modal-header">            
            <h4 class="modal-title">Tambah Data</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">          
            <label>Kategori Obat : </label>
                <select name="kategori" class="form-control" required>
                  <option value="">Pilih Kategori</option>
                  <option value="Obat bebas beredar">Bebas Beredar</option>
                  <option value="Obat bebas terbatas">Bebas Terbatas</option>
                  <option value="Obat keras">Obat Keras</option>
                </select>

                <label>Jenis Obat : </label>
                <select name="jenis" class="form-control" required>
                  <option value="">Pilih Jenis Obat</option>
                  <option value="Tablet">Tablet</option>
                  <option value="Kapsul">Kapsul</option>
                  <option value="Sirup">Sirup</option>
                </select>

                <label>Nama Obat : </label>
                <input type="text" name="nama" required class="form-control">

                <label>Tanggal Expired : </label>
                <input type="date" name="tgl_exp" required class="form-control">

                <label>Harga Obat : </label>
                <input type="number" name="harga" required class="form-control">

                <label>Jumlah Obat : </label>
                <input type="number" name="jumlah" required class="form-control">
          </div>
          <div class="modal-footer">
            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
            <input type="submit" name="add" class="btn btn-success" value="Add">
          </div>
        </form>
        <?php
          if (isset($_POST["add"])) {
            $koneksi->query("INSERT INTO obat VALUES (NULL, '$_POST[kategori]','$_POST[jenis]','$_POST[nama]','$_POST[tgl_exp]', '$_POST[harga]', '$_POST[jumlah]')");
            echo "<script>location.href='?halaman=obat';</script>";
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
        <th>Kategori Obat</th>
        <th>Nama Obat</th>
        <th>Jenis Obat</th>
        <th>Harga Obat</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        $no=1;
        $ambil = $koneksi->query("SELECT * FROM obat");
          while($pecah = $ambil->fetch_assoc()) : ?>
          <tr>
            <td><?php echo $pecah['kode_obat']; ?></td>
            <td><?php echo $pecah['kategori_obat']; ?></td>
            <td><?php echo $pecah['nama_obat']; ?></td>
            <td><?php echo $pecah['jenis_obat'] ?></td>
            <td>IDR <?php echo number_format($pecah['harga_obat']); ?></td>
            <td>
              <button data-target="#showEmployeeModal<?= $pecah['kode_obat']; ?>" class="btn-sm btn-info" data-toggle="modal" data-code="code" data-company="company name" title="Show data" style="cursor: pointer;"><i class="fas fa-eye"></i></button>
              <button data-target="#editEmployeeModal<?= $pecah['kode_obat']; ?>" class="btn-sm btn-success" data-toggle="modal" data-code="code" data-company="company name" title="Edit" style="cursor: pointer;"><i class="fas fa-pencil-alt"></i></button>
              <button data-target="#deleteEmployeeModal<?= $pecah['kode_obat']; ?>" class="btn-sm btn-danger" data-toggle="modal" title="Delete" style="cursor: pointer;"><i class="fas fa-trash-alt"></i></button>
            </td>
          </tr>
          <div id="showEmployeeModal<?= $pecah['kode_obat']; ?>" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="post">
          <div class="modal-header">            
            <h4 class="modal-title">Show Data</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">
          <?php
            $id = $pecah['kode_obat'];
            $edit = $koneksi->query("SELECT * FROM obat WHERE kode_obat = '$id' ");
            while ($row = $edit->fetch_assoc()) : ?>
          <input type="hidden" name="id" value="<?php echo $row['kode_obat']; ?>">
            <label>Kategori Obat : </label>
                <input disabled class="form-control" value="<?php echo $row['kategori_obat']; ?>">

                <label>Nama Obat : </label>
                <input type="text" name="nama" required class="form-control" value="<?php echo $row['nama_obat']; ?>" disabled>

                <label>Jenis Obat : </label>
                <input disabled class="form-control" value="<?php echo $row['jenis_obat']; ?>">

                <label>Tanggal Expired : </label>
                <input type="date" name="tgl_exp" required class="form-control" value="<?php echo $row['tgl_exp']; ?>" disabled>

                <label>Harga Obat : </label>
                <input type="number" name="harga" required class="form-control" value="<?php echo $row['harga_obat']; ?>" disabled>

                <label>Jumlah Obat : </label>
                <input type="number" name="jumlah" required class="form-control" value="<?php echo $row['jml_obat']; ?>" disabled>
          </div>
        </form>
        <?php endwhile; ?>
      </div>
    </div>
  </div>
  <!-- Edit Modal HTML -->
  <div id="editEmployeeModal<?= $pecah['kode_obat']; ?>" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="post">
          <div class="modal-header">            
            <h4 class="modal-title">Edit Data</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">
          <?php
            $id = $pecah['kode_obat'];
            $edit = $koneksi->query("SELECT * FROM obat WHERE kode_obat = '$id' ");
            while ($row = $edit->fetch_assoc()) : ?>
          <input type="hidden" name="id" value="<?php echo $row['kode_obat']; ?>">
            <label>Kategori Obat : </label>
                <select name="kategori" class="form-control" required>
                  <option value="<?php echo $row['kategori_obat']; ?>"><?php echo $row['kategori_obat']; ?></option>
                  <option value="Obat bebas beredar">Bebas beredar</option>
                  <option value="Obat bebas terbatas">Bebas terbatas</option>
                  <option value="Obat keras">Obat keras</option>
                </select>

                <label>Nama Obat : </label>
                <input type="text" name="nama" required class="form-control" value="<?php echo $row['nama_obat']; ?>">

                <label>Jenis Obat : </label>
                <select name="jenis" class="form-control" required>
                  <option value="<?php echo $row['jenis_obat']; ?>"><?php echo $row['jenis_obat'] ?></option>
                  <option value="Tablet">Tablet</option>
                  <option value="Kapsul">Kapsul</option>
                  <option value="Sirup">Sirup</option>
                </select>

                <label>Tanggal Expired : </label>
                <input type="date" name="tgl_exp" required class="form-control" value="<?php echo $row['tgl_exp']; ?>">

                <label>Harga Obat : </label>
                <input type="number" name="harga" required class="form-control" value="<?php echo $row['harga_obat']; ?>">

                <label>Jumlah Obat : </label>
                <input type="number" name="jumlah" required class="form-control" value="<?php echo $row['jml_obat']; ?>">
          </div>
          <div class="modal-footer">
            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
            <input type="submit" name="update" class="btn btn-info" value="Update">
          </div>
        </form>
        <?php endwhile; ?>
        <?php  
          if (isset($_POST["update"])) {
            $koneksi->query("UPDATE obat SET kategori_obat='$_POST[kategori]', jenis_obat='$_POST[jenis]', nama_obat='$_POST[nama]', tgl_exp='$_POST[tgl_exp]', harga_obat='$_POST[harga]', jml_obat='$_POST[jumlah]' WHERE kode_obat = '$_POST[id]' ");
            echo "<script>location.href='?halaman=obat';</script>";
          }
        ?>
      </div>
    </div>
  </div>
  <!-- Delete Modal HTML -->
  <div id="deleteEmployeeModal<?= $pecah['kode_obat']; ?>" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="post">
          <div class="modal-header">            
            <h4 class="modal-title">Delete Data '<?php echo $pecah['nama_obat'] ?>'</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">
            <?php
              $id_del = $pecah["kode_obat"];
              $del = $koneksi->query("SELECT * FROM obat WHERE kode_obat = '$id_del'");
              while($rows = $del->fetch_assoc()) : ?>
            <input type="hidden" name="id" value="<?php echo $rows['kode_obat']; ?>">
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
            $koneksi->query("DELETE FROM obat WHERE kode_obat = '$_POST[id]'");
            echo "<script>location.href='?halaman=obat';</script>";
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