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
						<p style="font-size: 18px;  margin-bottom: 0px;"><b>TABLA DE CONSUMO DE CONFRONTA DE <?php echo $parametros['unidad']; ?></b><br>Correspondiente al mes de <?php $fecha = explode('-', $fechaInicio); echo $meses[$fecha[1]-1]." del ".$fecha[0];?></p>
						
						<td width="5%"></td>
					</tr>
				</tbody>
			</table>
			<hr>
		</div>
		<div class="col-sm-12 rows">
		
		
			<table class="table table-bordered " style="font-size: 12px;">

<tr>
<th style="vertical-align: middle" rowspan="2">Indentificación</th><th style="vertical-align: middle" rowspan="2">Nombres</th><th style="vertical-align: middle" rowspan="2">Grado</th><th style="vertical-align: middle" rowspan="2">Arma</th>
	    	<th colspan="2" style='text-align: center;'>Desayuno</th><th colspan="2" style='text-align: center;'>Almuerzo</th><th colspan="2" style='text-align: center;'>Merienda</th><th style="vertical-align: middle" rowspan="2">Total</th>
<tr><td style='text-align: center;'>Cant.</td><td style='text-align: center;'>Total</td><td style='text-align: center;'>Cant</td><td style='text-align: center;'>Total</td><td style='text-align: center;'>Cant</td><td style='text-align: center;'>Total</td>
	    	
</tr>
<?php 
$totalDes = 0; $totalAlm = 0; $totalMer = 0;
foreach ($datos as $item):
$totalItem = 0;
			echo "<tr><td>".$item->identificacion."</td>";
    		echo "<td>".$item->nombres." ".$item->apellidos."</td>";  
    		echo "<td>".$item->grado."</td>";
    		echo "<td>".$item->arma."</td>";
    		$totalDes = $totalDes + $item->desayuno * $parametros['desayuno'];
    		$totalItem = $totalItem + $item->desayuno * $parametros['desayuno'];
    		echo "<td style='text-align: center;'>".$item->desayuno."</td>";
    		echo "<td style='text-align: center;'>".$item->desayuno * $parametros['desayuno']."</td>";
    		$totalAlm = $totalAlm + $item->almuerzo * $parametros['almuerzo'];
    		$totalItem = $totalItem + $item->almuerzo * $parametros['almuerzo'];
    		echo "<td style='text-align: center;'>".$item->almuerzo."</td>";
    		echo "<td style='text-align: center;'>".$item->almuerzo * $parametros['almuerzo']."</td>";
    		$totalMer = $totalMer + $item->merienda * $parametros['merienda'];
    		$totalItem = $totalItem + $item->merienda * $parametros['merienda'];
    		echo "<td style='text-align: center;'>".$item->merienda."</td>";
    		echo "<td style='text-align: center;'>".$item->merienda * $parametros['merienda']."</td>";
    		echo "<td style='text-align: center;'>".$totalItem."</td>";
 endforeach;?>
 <tr><td colspan="4"><b>Total</b></td><td></td><td style="text-align: center; font-weight: bold;"><?php echo $totalDes;?></td><td></td><td style="text-align: center; font-weight: bold;"><?php echo $totalAlm;?></td><td></td><td style="text-align: center; font-weight: bold;"><?php echo $totalMer;?></td><td style="text-align: center; font-weight: bold;"><?php echo $totalDes + $totalAlm + $totalMer;?></td></tr>
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

