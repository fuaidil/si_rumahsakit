<?php 
  session_start();
  $koneksi = new mysqli("localhost","root","","rumahsakit");

 ?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Rumah Sakit</title>

    <!-- Bootstrap CSS CDN -->
    <script src="assets/js/jquery-3.3.1.min.js"></script>
   <link rel="stylesheet" href="assets/css/bootstrap.min.css">
   <script src="bootstrap-4/js/bootstrap.min.js"></script>
   <link href="assets/fontawesome/css/all.min.css" rel="stylesheet">
   <link rel="stylesheet" href="login.css">
</head>
<body>
  <div class="container">
    <!-- <div class="row text-center">
      <div class="col-md-12">
        <br><br><br>
        <h3>Login Page</h3>
        <h6>( Login yourself to get access )</h6>
        <br>
      </div>
    </div> -->
    <br>
    <section class="container-fluid">
    <section class="row justify-content-center">
      <section class="col-12 col-sm-6 col-md-3">
        <form class="form-container" method="post">
          <div class="panel-header">
          <h2><center>Login</center></h2>
          <hr>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Username</label>
            <input type="text" class="form-control" name="username" id="exampleInputEmail1" aria-describedby="emailHelp">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1">
          </div>
          <button type="submit" name="submit" class="btn btn-primary btn-block">Submit</button>
        </form>
      </section>
    </section>
  </section>
    <!-- <div class="row justify-content-center">
      <div class="col-md-4">
        <div class="panel panel-default">
          <div class="panel-heading">
            <strong>Enter Details to Login </strong>
          </div>
          <div class="panel-body" style="padding: 15px;"> -->
          
            <!-- <form role="form" method="post">
              <br>
              <div class="form-group input-group">
                <span class="input-group-addon"><i class="fas fa-tag"></i></span>
                <input type="text" class="form-control" name="username" placeholder="Username" required/>
              </div>
              <div class="form-group input-group">
                <span class="input-group-addon"><i class="fas fa-lock"></i></span>
                <input type="password" class="form-control" name="password" placeholder="Password" required/>
              </div>
              <div class="form-group input-group">
                <select name="level" class="form-control" required>
                  <option value="">Pilih Level...</option>
                  <option value="Dokter">Dokter</option>
                  <option value="Operator">Operator</option>
                </select>
              </div>
              <button class="btn btn-primary" name="submit">Login</button>
              <hr>
            </form> -->
              <?php
              if(isset($_POST["submit"])){
                $username = $_POST['username'];
                $password = $_POST['password'];
                // $level = $_POST["level"];
                if($username !== '' && $password !== ''){
                  $login = $koneksi->query("SELECT * FROM user WHERE username='$username' AND password='$password'");
                  $data = $login->fetch_array();
                  
                  if($data && $data['level']=="Administrator"){
                    $_SESSION['username'] = $username;
                    $_SESSION['password'] = $password;
                    $_SESSION['nama']     = $data['nama'];
                    $_SESSION['level']    = $data['level'];
        
                    echo "<div class='alert alert-info'>Login Sukses</div>
                    <meta http-equiv='refresh' content='1;url=index.php'>";
                  }
                  else if($data && $data['level']=="nakes"){
                      $_SESSION['username'] = $username;
                      $_SESSION['password'] = $password;
                      $_SESSION['nama']     = $data['nama'];
                      $_SESSION['level']    = $data['level'];

                      echo "<div class='alert alert-info'>Login Sukses</div>
                      <meta http-equiv='refresh' content='1;url=dokterAdmin.php'>";
                  }
                  else if($data && $data['level']=="Operator"){
                      $_SESSION['username'] = $username;
                      $_SESSION['password'] = $password;
                      $_SESSION['nama']     = $data['nama'];
                      $_SESSION['level']    = $data['level'];
                      echo "<div class='alert alert-info'>Login Sukses</div>
                      <meta http-equiv='refresh' content='1;url=operator.php'>";
                  }
                  else{
                      echo "<div class='alert alert-danger'>Login Gagal !</div>
                      <meta http-equiv='refresh' content='1;url=login.php'>";
                  }  
                }
              }
            ?>
              <!-- Not register ? <button data-toggle="modal" data-target="#addEmployeeModal" class="btn-reg">click here</button>
              <div id="addEmployeeModal" class="modal fade">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <form method="post">
                      <div class="modal-header">            
                        <h4 class="modal-title">Registration Page</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      </div>
                      <div class="modal-body">
                            <label>Username : </label>
                            <input type="text" name="username" required class="form-control">

                            <label>Password : </label>
                            <input type="password" name="password" required class="form-control">

                            <label>Nama : </label>
                            <input type="text" name="nama" required class="form-control">

                            <label>Level : </label>
                            <select name="level" class="form-control" required>
                              <option value="">Pilih Level...</option>
                              <option value="Administrator">Admin</option>
                              <option value="Dokter">Dokter</option>
                              <option value="Operator">Operator</option>
                            </select>
                      </div>
                      <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="submit" name="save" class="btn btn-success" value="Add">
                      </div>
                    </form> -->
                    <!-- <?php
                    if (isset($_POST["save"])) 
                    {
                      $username = $_POST["username"];
                      $password = $_POST["password"];
                      $nama = $_POST["nama"];
                      $level = $_POST["level"];
                    $ambil = $koneksi->query("SELECT * FROM user WHERE username='$username'");
                    $podo = $ambil->num_rows;
                      if ($podo==1) 
                      {
                        $cocok = $ambil->fetch_assoc();
                        $_SESSION["username"] = $cocok;
                        echo "<script>alert('Username telah digunakan !');</script>
                      <meta http-equiv='refresh' content='1;url=login.php'>";
                      }
                      else
                      {
                        $koneksi->query("INSERT INTO user(username,password,nama,level) VALUES('$username','$password','$nama','$level') ");
                        echo "<script>
                          alert('Registrasi sukses !');
                          location='login.php';
                          </script>";
                      }
                    }
                  ?> -->
                  <!-- </div>
                </div>
              </div> -->
          </div>
        </div>
      </div>
    </div>
  </div>

    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
   
</body>
</html>
