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
   <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="style2.css">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

</head>

<body>

    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3>Rumah Sakit Medika</h3>
            </div>

            <ul class="list-unstyled components">
                <li>
                    <a href="?halaman=home">Home</a>
                </li>
                <li>
                    <a href="index.php?halaman=pasien">Data Pasien</a>
                </li>
                <li>
                    <a href="index.php?halaman=dokter">Data Dokter</a>
                </li>
                <li>
                    <a href="index.php?halaman=perawat">Data Perawat</a>
                </li>
                <li>
                    <a href="index.php?halaman=obat">Data Obat</a>
                </li>
                <li>
                    <a href="index.php?halaman=ruangan">Data Ruangan</a>
                </li>
            </ul>
            <!-- <buttton class="btn btn-danger btn-block">
                <a href="index.php?halaman=logout">Logout</a>
            </buttton> -->
        </nav>
        <div id="content">
            <button id="sidebarCollapse" class="btn btn-primary">
                <i class="fas fa-align-left"></i>
            </button>
            <br>
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
                        elseif ($_GET['halaman']=="resep") 
                        {
                            include 'resep.php';
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
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

    <!-- jQuery Custom Scroller CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#sidebar").mCustomScrollbar({
                theme: "minimal"
            });

            $('#sidebarCollapse').on('click', function () {
                $('#sidebar, #content').toggleClass('active');
                $('.collapse.in').toggleClass('in');
                $('a[aria-expanded=true]').attr('aria-expanded', 'false');
            });
        });
    </script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
        $('#table').DataTable( {
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
          });
        });
    </script>
</body>
</html>