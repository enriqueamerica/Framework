<?php

include "../aplication/Database.php";

$option = array( 
'fields' => 'id, email, username, password, status',
'limit' => '0,3', 
'order' => 'usuarios.id desc'
);

$usuarios = $db->find("usuarios", "all", null);

$numeroUsuarios = $db->find("usuarios", "count");

echo "Numero de usuarios: ".$numeroUsuarios;

?>

<table width="200" border="1">
  <tbody>
    <tr>
      <th>Id</th>
      <th>Email</th>
      <th>Username</th>
      <th>Password</th>
      <th>Status</th>
      <th>Accion</th>
    </tr>
    <?php foreach($usuarios as $usuario): ?>
    <tr>
      <td><?php echo $usuario["id"]; ?></td>
      <td><?php echo $usuario["email"]; ?></td>
      <td><?php echo $usuario["username"]; ?></td>
      <td><?php echo $usuario["password"]; ?></td>
      <td><?php echo $usuario["status"]; ?></td>
      <td>
      <a href="edit.php?id=<?php echo $usuario['id']; ?>">Editar</a> | 
      <a href="proceso.php?del&id=<?php echo $usuario['id']; ?>">Eliminar</a>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
