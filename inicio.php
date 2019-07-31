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
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>YOUTIFY</title>
	<link rel="stylesheet"  href="css/style.css">	
</head>
<header class="head">
<?php include('includes/head.php'); ?>
<hr>
<?php
include('includes/menu.php');?>
<hr>
<?php
$m=mysql_query("SELECT * FROM usuario WHERE usu_user='".$_SESSION['user']."'");
$a=mysql_fetch_assoc($m);
echo "".$a['usu_nombre'];
echo "<br><img src='archivos/".$a['usu_foto']."' width=90 height=69>";
?><br><a class="butonz" href="inicio.php?cerrar=1">Cerrar Sesion</a><br>
<hr>
</header>
<body>
	<section class="contenedor">
	<?php 
	if(!isset($_SESSION['categoria'])){
	$vid=mysql_query("SELECT * FROM video") ;
	$nv=mysql_num_rows($vid);
	$avid=mysql_fetch_assoc($vid);
}else{
	$vid=mysql_query("SELECT * FROM video WHERE vid_categoria=".$_SESSION['categoria']);
	$nv=mysql_num_rows($vid);
	$avid=mysql_fetch_assoc($vid);
}
if(isset($_REQUEST['vid'])){
		$video=mysql_query("SELECT * FROM video WHERE vid_id=".$_REQUEST['vid']);
		$avideo=mysql_fetch_assoc($video);
}else{
	$video=mysql_query("SELECT * FROM video LIMIT 0 , 1");
	$avideo=mysql_fetch_assoc($video);
}
	?>
	<marquee><h1 class="one">Pagina de Inicio</h1></marquee>
		<table>
		<?php 
		$i=0;
		if($nv>0){
			do{
				?>
				<tr>
					<td>
						<b><a href="inicio.php?vid=<?php echo $avid['vid_id'];?>"><?php echo $avid['vid_nombre'];?></a></b><br>
					<i><?php echo $avid['vid_user'];?></i><br>
					<h3><?php echo $avid['vid_fecha'];?></h3><hr>
					</td>
					<?php
					$i++;
				}while($avid=mysql_fetch_assoc($vid));
				}else{
					echo "No hay videos para esta categoria";
				}					
				?></tr>
					<td>
						<video id='video<?php echo $i;?>' width="450" height="300" controls>
						<source src="video/<?php echo $avideo['vid_id']."_".$avideo['vid_nombrearchivo'];?>" type="video/mp4">
						<source src="video/<?php echo $avideo['vid_id']."_".$avideo['vid_nombrearchivo'];?>" type="video/avi">
						</video>
							<div>
							<button onclick="document.getElementById('video<?php echo $i;?>').play()">Play</button>
							<button onclick="document.getElementById('video<?php echo $i;?>').pause()">Pausa</button>
							<button onclick="document.getElementById('video<?php echo $i;?>').volume+=0.2"> + </button>
							<button onclick="document.getElementById('video<?php echo $i;?>').volume-=0.2"> - </button>
							</div>
					</td>
		</table>
	</section>
<?include('includes/footer.php');?>
</body>
</html>