<?php

include "../aplication/Database.php";

$conditions = array('conditions' => ' id='.$_GET['id']);

$usuario = $db->find("usuarios", "first", $conditions);

?>

<form method="post" action="proceso.php">
	<input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">
    <input type="hidden" name="edit">
    <label for="email">Correo:</label>
    <input type="email" name="email" value="<?php echo $usuario['email']; ?>">
    <label for="username">Usuario:</label>
    <input type="text" name="username" value="<?php echo $usuario['username']; ?>">
    <label for="password">Contrasena:</label>
    <input type="password" name="password" value="<?php echo $usuario['password']; ?>">
    <label for="status">Status</label>
    <input type="number" name="status" value="<?php echo $usuario['status']; ?>">
    <input type="submit" value="Enviar">
</form>