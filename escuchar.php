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
include('includes/menu2.php');?>
<hr>
<?php
$m=mysql_query("SELECT * FROM usuario WHERE usu_user='".$_SESSION['user']."'");
$a=mysql_fetch_assoc($m);
echo "".$a['usu_nombre'];
echo "<br><img src='archivos/".$a['usu_foto']."' width=90 height=69>";
?><br><a class="butonz" href="escuchar.php?cerrar=1">Cerrar Sesion</a><br>
<hr>
</header>
<body>
   <section class="contenedor">
   <?php 
   if(!isset($_SESSION['genero'])){
   $aud=mysql_query("SELECT * FROM AUDIO") ;
   $na=mysql_num_rows($aud);
   $aaud=mysql_fetch_assoc($aud);
}else{
   $aud=mysql_query("SELECT * FROM AUDIO WHERE AUD_genero=".$_SESSION['genero']);
   $na=mysql_num_rows($aud);
   $aaud=mysql_fetch_assoc($aud);
}
if(isset($_REQUEST['aud'])){
      $audio=mysql_query("SELECT * FROM AUDIO WHERE AUD_id=".$_REQUEST['aud']);
      $aaudio=mysql_fetch_assoc($audio);
}else{
   $audio=mysql_query("SELECT * FROM AUDIO LIMIT 0 , 1");
   $aaudio=mysql_fetch_assoc($audio);
}
   ?>
   <marquee><h1 class="one">Pagina de Inicio</h1></marquee>
      <table>
      <?php 
      $i=0;
      if($na>0){
         do{
            ?>
            <tr>
               <td>
                  <b><a href="escuchar.php?aud=<?php echo $aaud['AUD_id'];?>"><?php echo $aaud['AUD_nombre'];?></a></b><br>
               <i><?php echo $aaud['AUD_user'];?></i><br>
               <h3><?php echo $aaud['AUD_fecha'];?></h3><hr>
               </td>
               <?php
               $i++;
            }while($aaud=mysql_fetch_assoc($aud));
            }else{
               echo "No hay musica de ese genero";
            }              
            ?></tr>
            <td>
                  <audio id='audio<?php echo $i;?>' controls>
                  <source src="audio/<?php echo $aaudio['AUD_id']."_".$aaudio['AUD_nombrearchivo'];?>" type="audio/mp3">
                  </audio>
                     <div>
                     <button onclick="document.getElementById('audio<?php echo $i;?>').play()">Play</button>
                     <button onclick="document.getElementById('audio<?php echo $i;?>').pause()">Pausa</button>
                     <button onclick="document.getElementById('audio<?php echo $i;?>').volume+=0.2"> + </button>
                     <button onclick="document.getElementById('audio<?php echo $i;?>').volume-=0.2"> - </button>
                      <button onclick="document.getElementById('audio<?php echo $i;?>').DESCARGAR-=0.2"> Descargar</button>

                     </div>
               </td>
            </table>
   </section>
<?include('includes/footer.php');?>
</body>
</html>