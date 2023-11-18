<style>
	.txt{
		font-size: 12pt;
	}
</style>
<h2>Dashboard</h2>
<hr><br>
<!-- <h2>Selamat Datang <?php echo $_SESSION['nama']; ?></h2>
<p><small>Anda login sebagai <b><?php echo $_SESSION['level'] ?></b></small></p> -->
<div class="row">
  <div class="col-xl-4 col-md-6 mb-4">
    <div class="card border-danger">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
			<div class="col mr-2">
				<div class="txt text-xs font-weight-bold text-danger text-uppercase mb-2">Data Pasien</div>
				<div class="num">
				<?php
					$sql = $koneksi->query("SELECT * FROM reg_pasien");
					$data = array();
					while(($row = $sql->fetch_assoc()) != null){
					    $data[] = $row;
					}
					$count = count($data);
				?></div>
				<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $count; ?></div>
			</div>
			<div class="col-auto">
				<i class="fas fa-user-injured fa-3x text-gray-300"></i>
			</div>
		</div>
      </div>
    </div>
  </div>
  
  <div class="col-xl-4 col-md-6 mb-4">
    <div class="card border-success">
      <div class="card-body">
		<div class="row no-gutters align-items-center">
			<div class="col mr-2">
				<div class="txt text-xs font-weight-bold text-success text-uppercase mb-2">Data Dokter</div>
				<?php
					$sql = $koneksi->query("SELECT * FROM dokter");
					$data = array();
					while(($row = $sql->fetch_assoc()) != null){
					    $data[] = $row;
					}
					$count = count($data);
				?>
				<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $count ?></div>
			</div>
			<div class="col-auto">
				<i class="fas fa-user-md fa-3x text-gray-300"></i>
			</div>
		</div>
      </div>
    </div>
  </div>

  <div class="col-xl-4 col-md-6 mb-4">
    <div class="card border-info">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
			<div class="col mr-2">
				<div class="txt text-xs font-weight-bold text-info text-uppercase mb-2">Data Perawat</div>
				<?php
					$sql = $koneksi->query("SELECT * FROM perawat");
					$data = array();
					while(($row = $sql->fetch_assoc()) != null){
					    $data[] = $row;
					}
					$count = count($data);
				?>
				<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $count; ?></div>
			</div>
			<div class="col-auto">
				<i class="fas fa-user-nurse fa-3x text-gray-300"></i>
			</div>
		</div>
      </div>
    </div>
  </div>
</div>

<div class="row">
	<div class="col-xl-4 col-md-6 mb-4">
    <div class="card border-warning">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
			<div class="col mr-2">
				<div class="txt text-xs font-weight-bold text-warning text-uppercase mb-2">Data Ruangan</div>
				<?php
					$sql = $koneksi->query("SELECT * FROM ruangan");
					$data = array();
					while(($row = $sql->fetch_assoc()) != null){
					    $data[] = $row;
					}
					$count = count($data);
				?>
				<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $count; ?></div>
			</div>
			<div class="col-auto">
				<i class="fas fa-procedures fa-3x text-gray-300"></i>
			</div>
		</div>
      </div>
    </div>
  </div>
	<div class="col-xl-4 col-md-6 mb-4">
    <div class="card border-primary">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
			<div class="col mr-2">
				<div class="txt text-xs font-weight-bold text-primary text-uppercase mb-2">Data Obat</div>
				<?php
					$sql = $koneksi->query("SELECT * FROM obat");
					$data = array();
					while(($row = $sql->fetch_assoc()) != null){
					    $data[] = $row;
					}
					$count = count($data);
				?>
				<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $count; ?></div>
			</div>
			<div class="col-auto">
				<i class="fas fa-capsules fa-3x text-gray-300"></i>
			</div>
		</div>
      </div>
    </div>
  </div>
  <div class="col-xl-4 col-md-6 mb-4">
    <div class="card border-secondary">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
			<div class="col mr-2">
				<div class="txt text-xs font-weight-bold text-secondary text-uppercase mb-2">Data Operator</div>
				<?php
					$sql = $koneksi->query("SELECT * FROM user WHERE level='Operator'");
					$data = array();
					while(($row = $sql->fetch_assoc()) != null){
					    $data[] = $row;
					}
					$count = count($data);
				?>
				<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $count; ?></div>
			</div>
			<div class="col-auto">
				<i class="fas fa-user-cog fa-3x text-gray-300"></i>
			</div>
		</div>
      </div>
    </div>
  </div>
</div>
</div>
<!-- <div class="container">
	<div class="row">
		<table class="table table-striped table-hovered table-bordered">
			<thead>
				<tr>
					<th>x</th>
					<th>x</th>
					<th>x</th>
					<th>x</th>
					<th>x</th>
					<th>x</th>
					<th>x</th>
					<th>x</th>
					<th>x</th>
					<th>x</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>x</td>
					<td>x</td>
					<td>x</td>
					<td>x</td>
					<td>x</td>
					<td>x</td>
					<td>x</td>
					<td>x</td>
					<td>x</td>
					<td>x</td>
				</tr>
			</tbody>
		</table>
	</div>
</div> -->
