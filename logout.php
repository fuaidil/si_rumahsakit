<?php 

session_destroy();
echo "<script>
		alert('Anda telah logout');
		location='login.php';
	</script>";
 ?>