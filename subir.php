<?php
include('includes/conexion.php');
session_start();
   $m=mysql_query("SELECT * FROM usuario WHERE usu_user='".$_SESSION['user']."'");
   $a=mysql_fetch_assoc($m);
   if (isset($_REQUEST['cerrar']) && !empty($_REQUEST['cerrar'])) {
      session_destroy();
      header("Location:index.php");
   }
   if(!$_SESSION['user']){
      header("Location:index.php");
   }
   if(isset($_REQUEST['nombre'])){
   $n=$_REQUEST['nombre'];
   $d=$_REQUEST['descripcion'];
   $na=$_FILES['video']['name'];
   $cat=$_REQUEST['categoria'];
   $user=$_SESSION['user'];
   mysql_query("INSERT INTO video VALUES(NULL,'$n','$d',NULL,'$na',$cat,'$user')");
   $id=mysql_insert_id();
   move_uploaded_file($_FILES['video']['tmp_name'],"video/".$id."_".$na);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>YOUTIFY</title>
	<link rel="stylesheet"  href="css/style.css">	
</head>
<header class="hea">

</HEADER>
<header class="head">
<?php include('includes/head.php');?><hr>
<?php include('includes/menu.php');?><hr>
<?php
$m=mysql_query("SELECT * FROM usuario WHERE usu_user='".$_SESSION['user']."'");
$a=mysql_fetch_assoc($m);
echo "".$a['usu_nombre'];
echo "<br><img src='archivos/".$a['usu_foto']."' width=90 height=69>";
?><br><a class="butonz" href="subir.php?cerrar=1">Cerrar Sesion</a><br>
</header>
<body>
	<section class="contenedor">
	<h1>Subir video</h1>
      <form action="subir.php" method="post"   enctype="multipart/form-data">
         <input type="file" name="video" required><br>
         <input type="text" name="nombre" placeholder="nombre del video" required ><br>
         <textarea name="descripcion" id="" cols="30" rows="10"   required>   </textarea><br>
         <select name="categoria" id="" required >
         <?php
         $cat=mysql_query("SELECT  * from categoria");
         $acat=mysql_fetch_assoc($cat);
         do{
         echo "<option value='".$acat['cat_id']."'>".$acat['cat_categoria']."</option>";
      }  while ($acat=mysql_fetch_assoc(  $cat));
      ?>
 </select>
 <input type="submit" value="subir video">   
</section>
<?php include('includes/footer.php'); ?>
</body>
</html>