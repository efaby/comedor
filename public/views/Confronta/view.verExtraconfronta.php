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
						<b><p style="font-size: 18px;  margin-bottom: 0px;">EXTRACONFRONTA DE RANCHO DE <?php echo $general->unidad;?></p>
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
						<th >Unidad</th>
						<th style="text-align: center;">Desayunos</th>
						<th style="text-align: center;">Almuerzos</th>
						<th style="text-align: center;">Meriendas</th>
						<th style="text-align: center;">Total</th>
					</tr>
					
				</thead>
				<tbody>

					<tr>
						<td><?php echo $extraconfronta->unidad ?></td>
						<td style="text-align: center;"><?php echo $extraconfronta->desayuno; ?></td>
						<td style="text-align: center;"><?php echo $extraconfronta->almuerzo; ?></td>
						<td style="text-align: center;"><?php echo $extraconfronta->merienda; ?></td>
						<td style="font-weight: bold; text-align: center; font-size: 16px;"><?php echo $extraconfronta->desayuno + $extraconfronta->almuerzo + $extraconfronta->merienda; ?></td>
						
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

