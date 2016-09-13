<!DOCTYPE html>
<html lang="es">
<head>
<link rel="shortcut icon" href="<?php echo PATH_IMAGES; ?>/favicon.ico">
<meta charset="UTF-8" />
<title>Personas</title>
<link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS.'/style.css'; ?>" media="screen" />
<link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS . '/jquery-ui.min.css'; ?>" media="screen" />
<script type="text/javascript" src="<?php echo PATH_JS.'/jquery.js'; ?>"></script>
<script type="text/javascript" src="<?php echo PATH_JS.'/jquery-ui.min.js'; ?>"></script>
<script type="text/javascript" src="<?php echo PATH_JS.'/adminUser.js'; ?>"></script>
</head>
<body>
<?php include_once PATH_TEMPLATE.'/header.php';?>
<section>
<div class="content">
<h2>Listado de Usuarios</h2>
<div id="dialogModal" title="Datos de Usuario"></div>
<?php if (isset($_SESSION['message'])&& ($_SESSION['message'] != '')):?>
<div class="message">
	<?php echo $_SESSION['message'];$_SESSION['message'] = ''?>
</div>
<?php endif;?>
<table class="table">
<tr><th width="12%">Identificación</th><th>Nombre</th><th>Apellido</th><th width="8%">Tipo</th><th width="7%">Estado</th><th width="18%">Acciones</th></tr>
<?php foreach ($datos as $dato) { ?>
<tr>
	<td><?php echo $dato["identity_card"]; ?></td>
	<td><?php echo $dato["names"]; ?></td>
	<td><?php echo $dato["lastnames"]; ?></td>
	<td><?php echo $dato["type"]; ?></td>	
	<td align="center"><?php if($dato["is_active"]==1): ?><img src="<?php echo PATH_IMAGES.'/accept.png'; ?>"><?php $label = "Desactivar";$op = 0; else: $label = "Activar"; $op = 1;?><img src="<?php echo PATH_IMAGES.'/cancel.png'; ?>"><?php endif;?></td>	
	<td align="center">
		<button onclick="openUserModal(<?php echo $dato["id"];?>)" class="buttom-inside">Ver</button>
		<button onclick="javascript:if(confirm('Est\xE1 seguro que desea cambiar de estado al elemento seleccionado?')){redirect(<?php echo $dato['id'];?>,<?php echo $op; ?>);}" class="buttom-inside"><?php echo $label; ?></button>
	</td>	
</tr>
<?php }?>
<?php if((isset($paginator))and ($totalItems>0)):?>
<tr>
<td colspan="6" align="center">
<?php $paginator->viewPaginator();?>
</td>
</tr>
<?php endif;?>
</table>
<form action="index.php?action=displayList" method="post" id="listForm" name="listForm" >
<input type="hidden" name="listForm_offset" id="listForm_offset" value="1">
</form>
</div>
</section>
<?php include_once PATH_TEMPLATE.'/footer.php';?>
</body>
</html>
