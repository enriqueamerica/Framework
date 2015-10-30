
<?php
//Comienza la funcion de email en donde se recibirá el Formulario.

$recipiente = "mi.mail@micompania.com";

$msg = $row_Recordset1['DESCRIPCION'] . $row_Recordset1['CARACTERISTICAS'] .$cantidad .$total ;

$mensaje = ereg_replace("\r\n","<br>", $mensaje);

$Nombre = htmlentities($Nombre);
$email = htmlentities($email);
$fono = htmlentities($fono);
$mensaje = htmlentities($mensaje);
$msg = htmlentities($msg);

//Enviar el E-mail con todos los datos.

mail("$recipiente", "Your info is ready", "$msg", "FROM: $email");

//Mensaje de envio info

echo"<font face=tahoma size=2>

<p align=center>The mail with the info was sent.<br></p>
<p align=center><br>
<a href=$sw>Back To Main</a>.</p>";

?></font></p></td>
<td class="style19 style22">&nbsp;</td>
<td class="style1">&nbsp;</td>
<td class="style1">&nbsp;</td>
</tr>
</table>
<div align="center"></div></td>
</tr>
</table>

<p align="center">&nbsp;</p>

</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
