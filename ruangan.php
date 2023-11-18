    <h4>Data Ruangan</h4>
    <hr>
    <div class="row">
    &nbsp;&nbsp;&nbsp;<button type="button" class="btn-sm btn-primary" data-toggle="modal" data-target="#exampleModalScrollable" style="cursor: pointer;"><i class="fas fa-plus"></i>&nbsp;&nbsp;Tambah Data</button>
    </center>

      <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalScrollableTitle">Tambah Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
              <form method="post">
            <div class="modal-body">
                <label>Nama Ruang : </label>
                <input type="text" name="nama" required class="form-control">
                
                <label>Kelas :</label>
                <select name="kelas" class="form-control">
                  <option value="VVIP">Kelas VVIP</option>
                  <option value="VIP">Kelas VIP</option>
                  <option value="1">Kelas 1</option>
                  <option value="2">Kelas 2</option>
                  <option value="3">Kelas 3</option>
                </select>

                <label>Jenis Kamar : </label>
                <select name="jenis" class="form-control">
                  <option value="A">A</option>
                  <option value="A-B">A-B</option>
                  <option value="A-C">A-C</option>
                  <option value="A-D">A-D</option>
                  <option value="A-E">A-E</option>
                  <option value="A-F">A-F</option>
                </select>

                <label>No. Kamar :</label>
                <select name="no" class="form-control">
                  <option value="1">1</option>
                  <option value="1-2">1-2</option>
                  <option value="1-3">1-3</option>
                  <option value="1-4">1-4</option>
                  <option value="1-5">1-5</option>
                  <option value="1-6">1-6</option>
                </select>

                <label>Tarif Kamar :</label>
                <input type="number" name="tarif" class="form-control" required>

                <label>Status Kamar :</label>
                <select name="status" class="form-control">
                  <option value="Kosong">Kosong</option>
                  <option value="Isi">Isi</option>
                </select>
            </div>
            <div class="modal-footer">
              <button class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button name="submit" class="btn btn-primary">Save</button>
            </div>
            </form>
            <?php 
              if (isset($_POST["submit"])) 
              {
                $nama = $_POST["nama"];
                $kelas = $_POST["kelas"];
                $jenis = $_POST["jenis"];
                $no = $_POST["no"];
                $tarif = $_POST["tarif"];
                $status = $_POST["status"];

                $koneksi->query("INSERT INTO ruangan(nama_ruang,kelas,jenis_kamar,no_kamar,tarif_kamar,status_kamar) VALUES('$nama','$kelas','$jenis','$no','$tarif','$status')");
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
      <table class="table table-hover table-striped">
        <thead>
          <tr>
            <th>Kode</th>
            <th>Nama Ruangan</th>
            <th>Kelas</th>
            <th>Jenis Kamar</th>
            <th>No. Kamar</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $nomor=1; ?>
          <?php $ambil = $koneksi->query("SELECT * FROM ruangan"); ?>
          <?php while($pecah = $ambil->fetch_assoc()) : ?>
          <tr>
            <td><?php echo $pecah['kode_ruang']; ?></td>
            <td><?php echo $pecah['nama_ruang']; ?></td>
            <td><?php echo $pecah['kelas']; ?></td>
            <td><?php echo $pecah['jenis_kamar'] ?></td>
            <td><?php echo $pecah['no_kamar']; ?></td>
            <td>
              <button data-target="#showModal<?= $pecah['kode_ruang']; ?>" class="btn-sm btn-info" data-toggle="modal" data-code="code" data-company="company name" title="Show" style="cursor: pointer;"><i class="fas fa-eye"></i></button>
              <button data-target="#editModal<?= $pecah['kode_ruang']; ?>" class="btn-sm btn-success" data-toggle="modal" data-code="code" data-company="company name" title="Edit" style="cursor: pointer;"><i class="fas fa-pencil-alt"></i></button>
              <!-- <button data-target="#deleteModal<?= $pecah['kode_ruang']; ?>" class="btn-sm btn-danger" data-toggle="modal" data-code="code" data-company="company name" title="Delete" style="cursor: pointer;"><i class="fas fa-trash-alt"></i></button> -->
            </td>
          </tr>
        <div id="showModal<?= $pecah['kode_ruang']; ?>" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="post">
          <div class="modal-header">            
            <h4 class="modal-title">Show Data</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">
          <?php
            $id = $pecah['kode_ruang'];
            $edit = $koneksi->query("SELECT * FROM ruangan WHERE kode_ruang = '$id' ");
            while ($row = $edit->fetch_assoc()) : ?>
          <input type="hidden" name="id" value="<?php echo $row['kode_ruang']; ?>">
            <label>Nama Ruang : </label>
                <input type="text" name="nama" required class="form-control" value="<?php echo $row['nama_ruang'] ?>" disabled>
                
                <label>Kelas :</label>
                <input type="text" class="form-control" disabled value="<?php echo $row['kelas']; ?>">

                <label>Jenis Kamar : </label>
                <input type="text" class="form-control" disabled value="<?php echo $row['jenis_kamar']; ?>">

                <label>No. Kamar :</label>
                <input type="text" class="form-control" disabled value="<?php echo $row['no_kamar']; ?>">

                <label>Tarif Kamar :</label>
                <input type="number" name="tarif" class="form-control" required value="<?php echo $row['tarif_kamar']; ?>" disabled>

                <label>Status Kamar :</label>
                <input type="text" class="form-control" disabled value="<?php echo $row['status_kamar']; ?>">
          </div>
        </form>
        <?php endwhile; ?>
      </div>
    </div>
  </div>
      <div id="editModal<?= $pecah['kode_ruang']; ?>" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="post">
          <div class="modal-header">            
            <h4 class="modal-title">Edit Data</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">
          <?php
            $id = $pecah['kode_ruang'];
            $edit = $koneksi->query("SELECT * FROM ruangan WHERE kode_ruang = '$id' ");
            while ($row = $edit->fetch_assoc()) : ?>
          <input type="hidden" name="id" value="<?php echo $row['kode_ruang']; ?>">
            <label>Nama Ruang : </label>
                <input type="text" name="nama" required class="form-control" value="<?php echo $row['nama_ruang'] ?>">
                
                <label>Kelas :</label>
                <select name="kelas" class="form-control">
                  <option value="<?php echo $row['kelas'] ?>"><?php echo $row['kelas']; ?></option>
                  <option value="VVIP">Kelas VVIP</option>
                  <option value="VIP">Kelas VIP</option>
                  <option value="1">Kelas 1</option>
                  <option value="2">Kelas 2</option>
                  <option value="3">Kelas 3</option>
                </select>

                <label>Jenis Kamar : </label>
                <select name="jenis" class="form-control">
                  <option value="<?php echo $row['jenis_kamar']; ?>"><?php echo $row['jenis_kamar']; ?></option>
                  <option value="A">A</option>
                  <option value="A-B">A-B</option>
                  <option value="A-C">A-C</option>
                  <option value="A-D">A-D</option>
                  <option value="A-E">A-E</option>
                  <option value="A-F">A-F</option>
                </select>

                <label>No. Kamar :</label>
                <select name="no" class="form-control">
                  <option value="<?php echo $row['no_kamar']; ?>"><?php echo $row['no_kamar']; ?></option>
                  <option value="1">1</option>
                  <option value="1-2">1-2</option>
                  <option value="1-3">1-3</option>
                  <option value="1-4">1-4</option>
                  <option value="1-5">1-5</option>
                  <option value="1-6">1-6</option>
                </select>

                <label>Tarif Kamar :</label>
                <input type="number" name="tarif" class="form-control" required value="<?php echo $row['tarif_kamar']; ?>">

                <label>Status Kamar :</label>
                <select name="status" class="form-control">
                  <option value="<?php echo $row['status_kamar']; ?>"><?php echo $row['status_kamar']; ?></option>
                  <option value="Kosong">Kosong</option>
                  <option value="Isi">Isi</option>
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
            $koneksi->query("UPDATE obat SET kategori_obat='$_POST[kategori]', jenis_obat='$_POST[jenis]', nama_obat='$_POST[nama]', tgl_exp='$_POST[tgl_exp]', harga_obat='$_POST[harga]', jml_obat='$_POST[jumlah]' WHERE kode_ruang = '$_POST[id]' ");
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