<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<link href="<?php echo PATH_CSS . '/bootstrap.min.css';?>"
	rel="stylesheet">
	<script type="text/javascript">
	function cerrar(){
		opener.window.location.href ='../listar/';		
		self.close(); 
		return false; 
	}
	</script>
</head>

<body class="tooltips">
	<div class="table-responsive">
		<div class="col-sm-12 hidden-print" style="text-align: right; padding-top: 10px;">
			<a href="javascript:window.print()" class="btn btn-primary"> <span
				class="glyphicon glyphicon-print"></span>&nbsp;Imprimir
			</a>
			<a href="javascript:cerrar();" class="btn btn-danger"> <span
				class="glyphicon glyphicon-log-out "></span>&nbsp;Cerrar
			</a>
		</div>

		<div class="col-sm-12 rows">
			<h3><?php echo $title;?></h3>
			<table class="table table-th-block table-bordered">				
				<tbody>
				<tr><th colspan="2"></th><th width="20%">No. Ticket:</th><th width="20%"><span style="font-size: 20px;"><?php echo 'TR-'.str_pad($reparacion['id'], 4, '0', STR_PAD_LEFT); ?></span></th></tr>
				<tr><td width="20%">Cliente:</td><td colspan="3"><?php echo $reparacion['cliente']?></td></tr>				
				<tr><td>Equipo:</td><td><?php echo $reparacion['nombre']?></td><td>Serie:</td><td><?php echo $reparacion['numero_serie'];?></td></tr>
				<tr><td>Marca:</td><td><?php echo $reparacion['marca']?></td><td>Modelo:</td><td><?php echo $reparacion['modelo'];?></td></tr>
				<tr><td>Observación Equipo:</td><td colspan="3"><?php echo $reparacion['observaciones']?></td></tr>	
				<tr><td>Técnico a Cargo</td><td><?php echo $reparacion['tecnico']?></td><td>Fecha Ingreso:</td><td><?php echo $reparacion['fecha_ingreso'];?></td></tr>					
				<tr><td>Motivo de Ingreso:</td><td colspan="3"><?php echo $reparacion['observacion']?></td></tr>					
				<?php if($reparacion['estado_id']==4):?>
				<tr><td>Usuario Entrega</td><td><?php echo $reparacion['tecnico']?></td><td>Fecha Entrega:</td><td><?php echo $reparacion['fecha_entrega'];?></td></tr>												
				<tr><td>Solución:</td><td colspan="3"><?php echo $reparacion['estado_final']?></td></tr>
				<?php endif;?>
				</tbody>
			</table>
		</div>
	</div>
	<!-- /.table-responsive -->

	<style type="text/css" media="print">
@page {
	size: auto A4 landscape;
	margin: 5mm;
}
</style>

</body>
</html>

