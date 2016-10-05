<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<link href="<?php echo PATH_CSS . '/bootstrap.min.css';?>"
	rel="stylesheet">
<link href="<?php echo PATH_CSS; ?>/font-awesome.min.css"
	rel="stylesheet" type="text/css" />
</head>

<body class="tooltips">
	<div class="table-responsive">
		<div class="col-sm-12 hidden-print" style="text-align: right;">
			<a href="javascript:window.print()"> <span
				class="glyphicon glyphicon-print"></span>&nbsp;Imprimir
			</a>
		</div>
		<div class="col-sm-12 rows divHeader" >
			<table style="width: 100%">
				<tbody>
					<tr>
						<td width="8%"><img width="60px"
							src="<?php echo PATH_IMAGES . '/ejercito.jpg';?>"></td>
						<td width="82%" align="center">
						<p style="font-size: 18px;  margin-bottom: 0px;"><b>TABLA DE CONSUMO DE CONFRONTA DE <?php echo $parametros['unidad']; ?></b></p>
						
						<td width="5%"></td>
					</tr>
				</tbody>
			</table>
			<hr>
		</div>
		<div class="col-sm-12 rows">
			<table class="table table-bordered ">

<tr><td><b>Nombre</b></td><td><?php echo $item->nombres ." ". $item->apellidos; ?></td><td><b>Identificación</b></td><td><?php echo $item->identificacion?></td></tr>
<?php foreach ($datos as $item):?>
<tr>
<td colspan="4">
<div style="font-weight: bold; padding: 5px">Mes <?php $total = 0; $fecha = explode('-', $item->fecha); echo $meses[$fecha[1]-1]." del ".$fecha[0];?></div>
<table class="table table-bordered " style="width: 40%">
<tr><th></th><th style="text-align: center;">Cantidad</th><th style="text-align: center;">Total</th></tr>
<tr><td>Desayuno</td><td style="text-align: center;"><?php echo $item->desayuno;?></td><td style="text-align: center;"><?php $total = $total + $item->costo_desayuno; echo $item->costo_desayuno; ?></td></tr>
<tr><td>Almuerzo</td><td style="text-align: center;"><?php echo $item->almuerzo;?></td><td style="text-align: center;"><?php $total = $total + $item->costo_almuerzo; echo $item->costo_almuerzo; ?></td></tr>
<tr><td>Merienda</td><td style="text-align: center;"><?php echo $item->merienda;?></td><td style="text-align: center;"><?php $total = $total + $item->costo_merienda; echo $item->costo_merienda; ?></td></tr>
<tr><td>Total</td><td></td><td style="text-align: center;"><?php echo $total; ?></td></tr>
</table>
</td>
</tr>
<?php endforeach;?>
</table>
		</div>
	</div>
	<!-- /.table-responsive -->

	<style type="text/css" media="print">
@media print {
	div.divFooter {
		position: fixed;
		display: block !important;
		bottom: 0;
	}
	div.divHeader {
		display: block !important;
	}
}

@page {
	size: auto A4 landscape;
	margin: 5mm;
}
</style>
</body>
</html>

