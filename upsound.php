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
   $na=$_FILES['audio']['name'];
   $gen=$_REQUEST['genero'];
   $user=$_SESSION['user'];
   mysql_query("INSERT INTO audio VALUES(NULL,'$n','$d',NULL,$gen,'$na','$user')");
   $id=mysql_insert_id();
   move_uploaded_file($_FILES['audio']['tmp_name'],"audio/".$id."_".$na);
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
<?php include('includes/menu2.php');?><hr>
<?php
$m=mysql_query("SELECT * FROM usuario WHERE usu_user='".$_SESSION['user']."'");
$a=mysql_fetch_assoc($m);
echo "".$a['usu_nombre'];
echo "<br><img src='archivos/".$a['usu_foto']."' width=90 height=69>";
?><br><a class="butonz" href="upsound.php?cerrar=1">Cerrar Sesion</a><br>
</header>
<body>
   <section class="contenedor">
   <h1>Subir Musica</h1>
      <form action="upsound.php" method="post"   enctype="multipart/form-data">
         <input type="file" name="audio" required><br>
         <input type="text" name="nombre" placeholder="nombre de la cancion" required ><br>
         <textarea name="descripcion" id="" cols="30" rows="10"   required>   </textarea><br>
         <select name="genero" id="" required >
         <?php
         $gen=mysql_query("SELECT * from genero");
         $agen=mysql_fetch_assoc($gen);
         do{
         echo "<option value='".$agen['gen_id']."'>".$agen['gen_genero']."</option>";
      }  while ($agen=mysql_fetch_assoc($gen));
      ?>
 </select>
 <input type="submit" value="subir cancion">   
</section>
<?php include('includes/footer.php'); ?>
</body>
</html>
