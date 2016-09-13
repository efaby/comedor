<!DOCTYPE html>
<html lang="es">
<head>
<link rel="shortcut icon" href="<?php echo PATH_IMAGES; ?>/favicon.ico">
<meta charset="UTF-8" />
<title>Personas</title>
<link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS . '/style.css'; ?>" media="screen" />
</head>
<body>

<h2>Editar Usuarios</h2>
<img src="<?php echo PATH_IMAGES . '/usuarios.png'; ?>" height="50px"/>
<form action="index.php?action=saveData" method="post">
<table class="table">
<tr>
	<td>Cédula:</td>
	<td><input name="identity_card" type="text" value="<?php echo $user['identity_card']; ?>"></td>	
</tr>
<tr>
	<td>Nombres:</td>
	<td><input name="names" type="text" value="<?php echo $user['names']; ?>"></td>	
</tr>
<tr>
	<td>Apellidos:</td>
	<td><input name="lastnames" type="text" value="<?php echo $user['lastnames']; ?>"></td>	
</tr>
<tr>
	<td>Usuario:</td>
	<td><input name="name_user" type="text" value="<?php echo $user['name_user']; ?>"></td>	
</tr>
<tr>
	<td>Tipo:</td>
	<td><select name="user_type_id">
	<option value="0">Selccione una Opción</option>
	<?php foreach ($userType as $dato) { ?>
		<option value="<?php echo $dato['id'];?>" <?php if($dato['id']==$user['user_type_id']):echo "selected"; endif;?> ><?php echo $dato['name'];?></option>
	<?php }?>
	</select></td>	
</tr>
<tr>
	<td>Cuidad:</td>
	<td><select name="city_id">
	<option value="0">Selccione una Opción</option>
	<?php foreach ($cities as $dato) { ?>
		<option value="<?php echo $dato['id'];?>" <?php if($dato['id']==$user['city_id']):echo "selected"; endif;?> ><?php echo $dato['name'];?></option>
	<?php }?>
	</select></td>	
</tr>
<tr><td colspan="2"align="center">
<input type="hidden" name="id" value="<?php echo $user['id']; ?>">
<input type="submit" value="guardar"/></td></tr>

</table>
</form>

</body>
</html>
