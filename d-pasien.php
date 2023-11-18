<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Download</title>
    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> -->
    <!-- Font Awesome -->
    <link href="assets/fontawesome/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <script src="bootstrap-4/js/bootstrap.min.js"></script>
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script> -->
    <link rel="stylesheet" type="text/css" href="template.css">
    <link
      rel="stylesheet"
      href="assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css"
    />
    <style>
      .notfound{
        display: none;
      }
      th{
        background-color: #788;
        color: #fff;
      }
    </style>
</head>
<body>
  <center>
  <h4>Daftar Pasien Rumah Sakit Medika</h4><hr><br>
  </center>
<table class="table table-bordered nowrap" style="width:100%" id="example1">
        <thead>
            <tr>
              <th>NIK</th>
              <th>Nama</th>
              <th>Alamat</th>
              <th>Jenis Kelamin</th>
              <th>Usia</th>
              <th>No. Telephone</th>
              <th>Tanggal Pendafaran</th>
              <th>Tempat Pemeriksaan</th>
            </tr>
        </thead>
        <tbody>
          <?php $koneksi = new mysqli("localhost","root","","rumahsakit"); ?>
          <?php $ambil = $koneksi->query("SELECT * FROM reg_pasien"); ?>
          <?php while($aray = $ambil->fetch_assoc()) : ?>
          <tr>
            <td><?php echo $aray['nik']; ?></td>
            <td><?php echo $aray['nama_pasien']; ?></td>
            <td><?php echo $aray['alamat_pasien'] ?></td>
            <td><?php echo $aray['jeniskel']; ?></td>
            <td><?php echo $aray['usia']; ?></td>
            <td><?php echo $aray['no_telp']; ?></td>
            <td><?php echo $aray['tgl_daftar']; ?></td>
            <td><?php echo $aray['tempat_pemeriksaan']; ?></td>
            <!-- <td><input type="checkbox" name="idpas[]" value="<?= $aray['kode_reg_pasien']; ?>"></td> -->
          </tr>
          <?php endwhile;?>
        </tbody>
    </table>
</body>
<script>
		 window.load = print_d();
		 function print_d(){
		 window.print();
		 }
	 </script>
</html>