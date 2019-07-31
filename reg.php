<?php
include('includes/conexion.php');
session_start();
if(isset($_REQUEST['usu_user']) && !empty($_REQUEST['usu_user'])){
	$usu=$_REQUEST['usu_user'];
	$p=md5($_REQUEST['usu_password']);
	$n=	$_REQUEST['usu_nombre'];
	$f=$_FILES['usu_foto']['name'];
	$checar="SELECT * FROM usuario WHERE usu_user='".$usu."'";
	$c=mysql_query($checar);
	$numfilas=mysql_num_rows($c);
	if($numfilas==1){
		echo '<script language="javascript">alert("Registro Completo");</script>';
	}else{
		$mifoto=$usu.$f;
		move_uploaded_file($_FILES['usu_foto']['tmp_name'], "archivos/".$mifoto);
		$sql="INSERT INTO usuario VALUES('".$usu."','".$p."','".$n."','".$mifoto."')";
		mysql_query($sql);
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Youtify</title>
	<link rel="stylesheet"  href="css/style.css">
</head>
<?php include('includes/head.php'); ?>
<body > 
<section class="reg">
<article><center>
	<form class="contacto" action="reg.php" method="POST" enctype="multipart/form-data" >
		<h1>Registro</h1>
		<label for="usu_user">Nick</label><br>
		<input type="text" name="usu_user" placeholder="Introduzca usuario" required><br>
		<label for="usu_password">Password</label><br>
		<input type="password" name="usu_password" placeholder="Introduce password" required><br>
		<label for="usu_nombre">Nombre</label><br>
		<input type="text" name="usu_nombre" placeholder="Introduce nombre" required><br>
		<label for="usu_foto">Foto</label><br>
		<input type="file" name="usu_foto" placeholder="Seleccione su foto" required><br>
		<br><br><input class="button" type="submit" value="Registrar">	
		<br><br><a class="button" href="index.php">Iniciar </a>
	</form>	</center>
	</article>
</section> 
</body>
</html>