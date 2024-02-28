<?php 
session_start();


if($_SESSION['USERNAME']){
	session_destroy();
	echo "<script>
					alert('Sesion Cerrada',location.href='../index.php')
				 </script>";
}

else{

	header('#');

}


?>