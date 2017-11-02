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
						<b><p style="font-size: 18px;  margin-bottom: 0px;">CONFRONTA DE RANCHO DE <?php echo $unidad->nombre;?></p>
						Para <?php echo $fecha;?></b></td>
						<td width="5%"></td>
					</tr>
				</tbody>
			</table>
			<hr>
		</div>
		<div class="col-sm-12 rows">
			<table class="table table-th-block table-hover">
				<thead class="the-box dark full">
					<tr>
						<th >D&iacute;a</th>
						<th style="text-align: center;">Desayunos</th>
						<th style="text-align: center;">Almuerzos</th>
						<th style="text-align: center;">Meriendas</th>
					</tr>
					
				</thead>
				<tbody>
				<?php foreach ($items as $item) { ?>
					<tr>
						<td><?php echo $item->dia ?></td>
						<td style="text-align: center;"><?php echo $item->desayuno_ofi + $item->desayuno_vol + $item->desayuno_con; ?></td>
						<td style="text-align: center;"><?php echo $item->almuerzo_ofi + $item->almuerzo_vol + $item->almuerzo_con; ?></td>
						<td style="text-align: center;"><?php echo $item->merienda_vol + $item->merienda_vol + $item->merienda_con; ?></td>						
					</tr>
				<?php }?>
				</tbody>
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

