<?php
include('includes/conexion.php');
session_start();
if(isset($_REQUEST['e']) && !empty($_REQUEST['e'])){
	$e=$_REQUEST['e'];
	$p=md5($_REQUEST['p']);
	$siesta=mysql_num_rows(mysql_query("SELECT * FROM usuario WHERE usu_user='".$e."' AND usu_password='".$p."'"));
	if($siesta==1){
	$_SESSION["autenticado"] = "SI";
    $_SESSION['user']=$e;
header("Location: inicio.php");
}else{
		echo '<script language="javascript">alert("usuario o contraseña incorrectos");</script>';
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>YOUTIFY</title>
	<link rel="stylesheet"  href="css/style.css">
</head>
<?php include('includes/head.php'); ?>
<body >
<section>
<article>
<center>
<form class="Log" action="index.php" method="post" >
	<dd><h1>Inciar sesion</h1>
	<label for="usuario">Usuario</label><br>
	<input type="text" name="e" placeholder="Introduzca usuario" required><br>
	<label for="pass">Password</label><br>
	<input type="password" name="p" placeholder="Introduce Password" required><br><br>
	<input class="button" type="submit"  value="Iniciar">	</dd>
	<br><br>No tienes cuenta, <a class="button" href="reg.php">Registrese</a>
</form></center>
</article>
</section>
</body>
</html>