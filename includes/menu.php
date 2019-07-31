<?php
	if(isset($_REQUEST['cat'])){
		$_SESSION['categoria']=$_REQUEST['cat'];
	}
?>
<link rel="stylesheet"  href="css/style.css">
<aside >
<a href="inicio.php">VIDEOS</a>
<a href="subir.php">Descargar Videos</a>
<a href="escuchar.php">Musica</a>
<a href="upsound.php">Descargar Musica</a>
<br><br><br>
			<select name="categoria" onChange="cambiarCategoria('parent',this,1)">
			<option value=" ">Selecciona categoria</option>
					<?php
						$cat=mysql_query("SELECT * FROM categoria");
						$acat=mysql_fetch_assoc($cat);
						do{
							echo "<option value='inicio.php?cat=".$acat['cat_id']."'>".$acat['cat_categoria']."</option>";
						}while($acat=mysql_fetch_assoc($cat));
						?>
				</select>
				<script>
					function cambiarCategoria(targ,selObj, restore){
						eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
						if(restore)selObj.selectedIndex=0;
					}
				</script>
</aside>