<?php

include "../aplication/Database.php";

if($_POST)
{
	if(isset($_POST['add']))
	{
		echo ($db->save("usuarios", $_POST)) ? "Datos insertados correctamente." : "Error al insertar los datos" ; // condicion pequeña
	}
	else if(isset($_POST['edit']))
	{
		echo ($db->update("usuarios", $_POST)) ? "Datos actualizados correctamente." : "Error al actualizar los datos" ;
	}
}

if(isset($_GET['del']))
{
	$conditions = "id=".$_GET['id'];
	echo ($db->delete("usuarios", $conditions)) ? "Datos eliminados correctamente." : "Error al eliminar los datos" ;
}

?>