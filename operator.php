<?php 
  session_start();
  $koneksi = new mysqli("localhost","root","","rumahsakit");
  if (!isset($_SESSION['level'])) {
    echo 
    "<script> alert('Anda harus login');
      location='login.php';
    </script>";
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Responsive sidebar template with sliding effect and dropdown menu based on bootstrap 3">
    <title>Rumah Sakit</title>
    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <!-- Font Awesome -->
    <link href="assets/fontawesome/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <script src="bootstrap-4/js/bootstrap.min.js"></script>
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script> -->
    <link rel="stylesheet" type="text/css" href="template.css">

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
<div class="page-wrapper chiller-theme toggled">
  <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
    <i class="fas fa-bars"></i>
  </a>
  <nav id="sidebar" class="sidebar-wrapper">
    <div class="sidebar-content">
      <div class="sidebar-brand">
        <a href="#">Rumah Sakit Medika</a>
        <div id="close-sidebar">
          <i class="fas fa-times"></i>
        </div>
      </div>
      <div class="sidebar-header">
        <div class="user-pic">
          <img class="img-responsive img-rounded" src="user.jpg"
            alt="User picture">
        </div>
        <div class="user-info">
          <span class="user-name"><b><?php echo $_SESSION["nama"]; ?></b></span>
          <span class="user-role"><?php echo $_SESSION["level"]; ?></span>
          <span class="user-status">
            <i class="fa fa-circle"></i>
            <span>Online</span>
          </span>
        </div>
      </div>
      <!-- sidebar-search  -->
      <div class="sidebar-menu">
        <ul>
          <li>
            <a href="?halaman=home">
              <i class="fa fa-home"></i>
              <span>Dashboard</span>
            </a>
          </li>
          <li>
            <a href="?halaman=pasien">
              <i class="fa fa-user-injured"></i>
              <span>Pasien</span>
            </a>
          </li>
          <li>
            <a href="?halaman=dokter">
              <i class="fa fa-user-md"></i>
              <span>Dokter</span>
            </a>
          </li>
          <li>
            <a href="?halaman=perawat">
              <i class="fa fa-user-nurse"></i>
              <span>Perawat</span>
            </a>
          </li>
          <li>
            <a href="?halaman=obat">
              <i class="fa fa-capsules"></i>
              <span>Obat</span>
            </a>
          </li>
          <li>
            <a href="?halaman=ruangan">
              <i class="fa fa-procedures"></i>
              <span>Ruangan</span>
            </a>
          </li>
          <li>
            <a href="?halaman=administrasi">
              <i class="fa fa-book-medical"></i>
              <span>Administrasi</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="sidebar-footer">
      <a href="?halaman=logout" style="background-color: #b12f15; color: white;">Logout</a>
    </div>
  </nav>
  <!-- sidebar-wrapper  -->
  <main class="page-content">
    <div class="container-fluid">
      <?php 
                    if(isset($_GET['halaman']))
                    {  
                        if ($_GET['halaman']=='home') {
                            include 'home.php';
                        }
                        elseif ($_GET['halaman']=='pasien') 
                        {
                            include 'pasien.php';
                        }
                        elseif ($_GET['halaman']=="dokter") 
                        {
                            include 'dokter.php';
                        }
                        elseif ($_GET['halaman']=="perawat") 
                        {
                            include 'perawat.php';
                        }
                        elseif ($_GET['halaman']=="obat") 
                        {
                            include 'obat.php';
                        }   
                        elseif ($_GET['halaman']=="ruangan") 
                        {
                            include 'ruangan.php';
                        }
                        elseif ($_GET['halaman']=='administrasi') 
                        {
                          include 'administrasi.php';
                        }
                        elseif ($_GET['halaman']=="logout") 
                        {
                            include 'logout.php';
                        }
                    }
                    else
                    {
                        include 'home.php';
                    }
                 ?>
    </div>
  </main>
  <!-- page-content" -->
</div>
<!-- page-wrapper -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script> -->
    <script>
      jQuery(function ($) {

    $(".sidebar-dropdown > a").click(function() {
  $(".sidebar-submenu").slideUp(200);
  if (
    $(this)
      .parent()
      .hasClass("active")
  ) {
    $(".sidebar-dropdown").removeClass("active");
    $(this)
      .parent()
      .removeClass("active");
  } else {
    $(".sidebar-dropdown").removeClass("active");
    $(this)
      .next(".sidebar-submenu")
      .slideDown(200);
    $(this)
      .parent()
      .addClass("active");
  }
});

$("#close-sidebar").click(function() {
  $(".page-wrapper").removeClass("toggled");
});
$("#show-sidebar").click(function() {
  $(".page-wrapper").addClass("toggled");
});   
});
    </script>
   <script>
    $(document).ready(function(){

  // Search all columns
  $('#cari').keyup(function(){
    // Search Text
    var search = $(this).val();

    // Hide all table tbody rows
    $('table tbody tr').hide();

    // Count total search result
    var len = $('table tbody tr:not(.notfound) td:contains("'+search+'")').length;

    if(len > 0){
      // Searching text in columns and show match row
      $('table tbody tr:not(.notfound) td:contains("'+search+'")').each(function(){
        $(this).closest('tr').show();
      });
    }else{
      $('.notfound').show();
    }

  });

  // Case-insensitive searching (Note - remove the below script for Case sensitive search )
$.expr[":"].contains = $.expr.createPseudo(function(arg) {
   return function( elem ) {
     return $(elem).text().toUpperCase().indexOf(arg.toUpperCase()) >= 0;
   };
});
});
  </script> 
</body>

</html>