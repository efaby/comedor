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
						<b><p style="font-size: 18px;  margin-bottom: 0px;">CONFRONTA DE RANCHO DE <?php echo $general->unidad;?></p>
						Para el día <?php echo $fecha;?></b></td>
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
						<th rowspan="2">Unidad</th>
						<th colspan="4" style="text-align: center;">Desayunos</th>
						<th colspan="4" style="text-align: center;">Almuerzos</th>
						<th colspan="4" style="text-align: center;">Meriendas</th>
					</tr>
					<tr>
						<th>OFI</th>
						<th>VOL</th>
						<th>CON</th>
						<th>Total</th>
						<th>OFI</th>
						<th>VOL</th>
						<th>CON</th>
						<th>Total</th>
						<th>OFI</th>
						<th>VOL</th>
						<th>CON</th>
						<th>Total</th>
					</tr>
				</thead>
				<tbody>

					<tr>
						<td><?php echo $general->unidad ?></td>
						<td><?php echo $general->desayuno_ofi; ?></td>
						<td><?php echo $general->desayuno_vol; ?></td>
						<td><?php echo $general->desayuno_con; ?></td>
						<td style="font-weight: bold; text-align: center; font-size: 16px;"><?php echo $general->desayuno_con + $general->desayuno_vol + $general->desayuno_ofi; ?></td>
						<td><?php echo $general->almuerzo_ofi; ?></td>
						<td><?php echo $general->almuerzo_vol; ?></td>
						<td><?php echo $general->almuerzo_con; ?></td>
						<td style="font-weight: bold; text-align: center; font-size: 16px;"><?php echo $general->almuerzo_con + $general->almuerzo_vol + $general->almuerzo_ofi; ?></td>
						<td><?php echo $general->merienda_ofi; ?></td>
						<td><?php echo $general->merienda_vol; ?></td>
						<td><?php echo $general->merienda_con; ?></td>
						<td style="font-weight: bold; text-align: center; font-size: 16px;"><?php echo $general->merienda_con + $general->merienda_vol + $general->merienda_ofi; ?></td>
						</tr>

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

