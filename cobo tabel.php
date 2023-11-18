<?php  
	$koneksi = new mysqli("localhost","root","","rumahsakit");
?>
<!DOCTYPE html>
<html>
<head>
	<title>tabel</title>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
	<!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
</head>
<body>
	      <h3><center>Data Pasien</center></h3>
      
    <table id="table" class="table table-striped table-bordered nowrap" style="width:100%">
  <center><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addEmployeeModal"><i class="fas fa-plus"></i>&nbsp;Tambah Data</button></center><br>
  <div id="addEmployeeModal" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="post">
          <div class="modal-header">            
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Add Employee</h4>
          </div>
          <div class="modal-body">
                <label>NIK : </label>
                <input type="number" name="nik" required class="form-control"><br>

                <label>Nama Pasien : </label>
                <input type="text" name="nama" required class="form-control"><br>

                <label>Alamat Pasien : </label>
                <input type="text" name="alamat" required class="form-control"><br>

                Jenis Kelamin : 
                <select name="jeniskel" class="form-control">
                  <option value="Laki-Laki">Laki-Laki</option>
                  <option value="Perempuan">Perempuan</option>
                </select><br>

                <label>No.Telp Pasien : </label>
                <input type="number" name="telepon" required class="form-control"><br>

                <label>Usia : </label>
                <input type="text" name="usia" required class="form-control"><br>

                <label>Tanggal Daftar : </label>
                <input type="date" name="daftar" required class="form-control"><br>

                <label>Tempat Pemeriksaan</label>
                <input type="text" name="tempat_periksa" required class="form-control">       
          </div>
          <div class="modal-footer">
            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
            <input type="submit" name="save" class="btn btn-success" value="Add">
          </div>
        </form>
        <?php 
        if (isset($_POST["save"])) 
        {
          $nik = $_POST["nik"];
          $nama = $_POST["nama"];
          $alamat = $_POST["alamat"];
          $jeniskel = $_POST["jeniskel"];
          $telepon = $_POST["telepon"];
          $usia = $_POST["usia"];
          $daftar = $_POST["daftar"];
          $tmpt = $_POST["tempat_periksa"];

          $koneksi->query("INSERT INTO reg_pasien(nik,nama_pasien,alamat_pasien,jeniskel,no_telp,usia,tgl_daftar,tempat_pemeriksaan) VALUES('$nik','$nama','$alamat','$jeniskel','$telepon','$usia','$daftar','$tmpt')");
          echo "<script> location.href='?halaman=pasien'; </script> ";
        }
      ?>
      </div>
    </div>
  </div>
        <thead>
            <tr>
              <th>NIK</th>
              <th>Nama</th>
              <th>Alamat</th>
              <th>Jenis Kelamin</th>
              <th>No. Telepon</th>
              <th>Usia</th>
              <th>Tanggal Daftar</th>
              <th>Aksi</th>
              <th>Tempat Pemeriksaan</th>
            </tr>
        </thead>
        <tbody>
          <?php $ambil = $koneksi->query("SELECT * FROM reg_pasien"); ?>
          <?php while($aray = $ambil->fetch_assoc()) : ?>
          <tr>
            <td><?php echo $aray['nik']; ?></td>
            <td><?php echo $aray['nama_pasien']; ?></td>
            <td><?php echo $aray['alamat_pasien'] ?></td>
            <td><?php echo $aray['jeniskel']; ?></td>
            <td><?php echo $aray['no_telp']; ?></td>
            <td><?php echo $aray['usia']; ?></td>
            <td><?php echo $aray['tgl_daftar']; ?></td>
            <td>
              <button data-target="#editEmployeeModal<?= $aray['kode_reg_pasien']; ?>" class="btn btn-primary" data-toggle="modal" title="Edit"><i class="fas fa-pencil-alt" data-toggle="tooltip"></i></button>
              <button data-target="#deleteEmployeeModal<?= $aray['kode_reg_pasien']; ?>" class="btn btn-danger" data-toggle="modal" title="Delete"><i class="fas fa-trash" data-toggle="tooltip"></i></button>
            </td>
            <td><?php echo $aray['tempat_pemeriksaan']; ?></td>
          </tr>
    <div id="editEmployeeModal<?= $aray['kode_reg_pasien']; ?>" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="post" enctype="multipart/form-data">
          <div class="modal-header">            
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Edit Data</h4>
          </div>
          <div class="modal-body">
                <?php
                  $id = $aray['kode_reg_pasien'];
                  $edit = $koneksi->query("SELECT * FROM reg_pasien WHERE kode_reg_pasien = '$id'");
                  while ($row = $edit->fetch_assoc()) : ?>
                <input type="hidden" name="id" value="<?php echo $row['kode_reg_pasien']; ?>">
      <label>NIK : </label>
      <input type="number" class="form-control" name="nik" value="<?php echo $row['nik']; ?>" required><br>

      <label>Nama Pasien : </label>
      <input type="text" class="form-control" name="nama" value="<?php echo $row['nama_pasien']; ?>" required><br>

      <label>Alamat Pasien : </label>
      <input type="text" class="form-control" name="alamat" value="<?php echo $row['alamat_pasien']; ?>" required><br>

      <label>Jenis Kelamin : </label>
      <select name="jeniskel" class="form-control" required>
        <option value="Laki-Laki">Laki-Laki</option>
        <option value="Perempuan">Perempuan</option>
      </select><br>

      <label>No.Telp Pasien : </label>
      <input type="number" class="form-control" name="telepon" value="<?php echo $row['no_telp']; ?>" required><br>

      <label>Usia : </label>
      <input type="text" class="form-control" name="usia" value="<?php echo $row['usia']; ?>" required><br>

      <label>Tanggal Daftar : </label>
      <input type="date" class="form-control" name="daftar" value="<?php echo $row['tgl_daftar']; ?>" required><br>

      <label>Tempat Pemeriksaan</label>
      <input type="text" class="form-control" name="tempat_periksa" value="<?php echo $row['tempat_pemeriksaan']; ?>" required>          
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
        $nik = $_POST['nik'];
        $nama = $_POST['nama'];
        $alamat = $_POST['alamat'];
        $jeniskel = $_POST['jeniskel'];
        $telp = $_POST['telepon'];
        $usia = $_POST['usia'];
        $daftar = $_POST['daftar'];
        $priksa = $_POST['tempat_periksa'];
        //query update
        $query = $koneksi->query("UPDATE reg_pasien SET nik='$nik', nama_pasien='$nama', alamat_pasien='$alamat', jeniskel='$jeniskel', no_telp='$telp', usia='$usia', tgl_daftar='$daftar', tempat_pemeriksaan='$priksa' WHERE kode_reg_pasien = '$id'");
          echo "<script> location.href='?halaman=pasien'; </script>";
        }

        // if (mysql_query($query)) {
        //     # credirect ke page index
        //     header("location:cobo tabel.php");    
        // }
        // else{
        //     echo "ERROR, data gagal diupdate". mysql_error();
        // }
        //mysql_close($host);
        ?>
      </div>
    </div>
  </div>
      <div id="deleteEmployeeModal<?= $aray['kode_reg_pasien']; ?>" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="post">
          <div class="modal-header">            
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Delete Data</h4>
          </div>
          <div class="modal-body">          
          <?php
          $id_del = $aray['kode_reg_pasien'];
          $del = $koneksi->query("SELECT * FROM reg_pasien WHERE kode_reg_pasien='$id_del'");
          $rows = $del->fetch_assoc(); ?>
            <input type="hidden" name="id" value="<?php echo $rows['kode_reg_pasien']; ?>">
            <p>Anda yakin ingin menghapus data ini ?</p>
            <p class="text-warning"><small>Tindakan ini tidak bisa dibatalkan.</small></p>
          </div>
          <div class="modal-footer">
            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
            <button type="submit" name="submit" class="btn btn-danger">Delete</button>
          </div>
        </form>
        <?php
        	if (isset($_POST["submit"])) {
        		$id = $_POST["id"];
        		$koneksi->query("DELETE FROM reg_pasien WHERE kode_reg_pasien='$id'");
        	}
        ?>
      </div>
    </div>
  </div>
        <?php endwhile; ?>
        </tbody>
    </table>
      <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>
	<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
	<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
	<script>
		$(document).ready(function() {
    $('#example').DataTable( {
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.modal( {
                    header: function ( row ) {
                        var data = row.data();
                        return 'Details for '+data[0]+' '+data[1];
                    }
                } ),
                renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
                    tableClass: 'table'
                } )
            }
        }
    } );
} );
	</script>
</body>
</html>