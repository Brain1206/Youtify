<?php
	if(isset($_REQUEST['gen'])){
		$_SESSION['genero']=$_REQUEST['gen'];
	}
?>
<link rel="stylesheet"  href="css/style.css">
<aside >
<a href="inicio.php">VIDEOS</a>
<a href="subir.php">Descargar Videos</a>
<a href="escuchar.php">Musica</a>
<a href="upsound.php">Descargar Musica</a>
<br><br><br>
			<select name="genero" onChange="cambiarGenero('parent',this,1)">
			<option value=" ">Selecciona Genero</option>
					<?php
						$gen=mysql_query("SELECT * FROM genero");
						$agen=mysql_fetch_assoc($gen);
						do{
							echo "<option value='escuchar.php?gen=".$agen['gen_id']."'>".$agen['gen_genero']."</option>";
						}while($agen=mysql_fetch_assoc($gen));
						?>
				</select>
				<script>
					function cambiarGenero(targ,selObj, restore){
						eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
						if(restore)selObj.selectedIndex=0;
					}
				</script>
</aside>