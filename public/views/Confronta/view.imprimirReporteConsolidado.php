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
						<p style="font-size: 18px;  margin-bottom: 0px;"><b>CONFRONTA CONSOLIDADA DEL MES DE <?php $fecha1 = explode('-', $fecha); echo $meses[$fecha1[1]-1]." del ".$fecha1[0];?></b></p>
						
						<td width="5%"></td>
					</tr>
				</tbody>
			</table>
			<hr>
		</div>
		<div class="col-sm-12 rows">
		

	<table class="table table-striped table-bordered table-hover" id="dataTables-example">
    <thead>
	    <tr>
	    	<th rowspan="2">Unidad</th>
		    <th colspan="5" style="text-align: center;">Desayunos</th>
		    <th colspan="5" style="text-align: center;">Almuerzos</th>
		    <th colspan="5" style="text-align: center;">Meriendas</th>
		   
	    </tr>
	    <tr>
	    	<th>OFI</th>
	    	<th>VOL</th>
	    	<th>CON</th>
	    	<th>Total</th>
	    	<th>Valor</th>
	    	<th>OFI</th>
	    	<th>VOL</th>
	    	<th>CON</th>
	    	<th>Total</th>
	    	<th>Valor</th>
	    	<th>OFI</th>
	    	<th>VOL</th>	    	
	    	<th style="border-right: 1px solid #ddd;">CON</th>	 
	    	<th>Total</th>  
	    	<th>Valor</th> 	
	    </tr>
    </thead>
    <tbody>
    	<?php 
    	    	$desOfi = $almOfi = $merOfi = 0;
    	$desVol = $almVol = $merVol = 0;
    	$desCons = $almCons = $merCons = 0;
    	$costo_desayuno = $costo_almuerzo =  $costo_merienda =0;
    	foreach ($datos as $item) {
    		echo "<tr><td>".$item->unidad."</td>";
    		$desOfi = $desOfi + $item->desayuno_ofi;
    		echo "<td style='text-align: center;'>".$item->desayuno_ofi."</td>";
    		$desVol = $desVol + $item->desayuno_vol;
    		echo "<td style='text-align: center;'>".$item->desayuno_vol."</td>";  
    		$desCons = $desCons + $item->desayuno_con;
    		echo "<td style='text-align: center;'>".$item->desayuno_con."</td>";
    		$desayunos = $item->desayuno_con + $item->desayuno_vol + $item->desayuno_ofi;
    		echo "<td style='text-align: center;  font-weight: bold;'>".$desayunos."</td>";
    		echo "<td style='text-align: center;  font-weight: bold;'>".$item->costo_desayuno."</td>";
    		echo "<td style='text-align: center;'>".$item->almuerzo_ofi."</td>";
    		$almOfi = $almOfi + $item->almuerzo_ofi;
    		echo "<td style='text-align: center;'>".$item->almuerzo_vol."</td>";
    		$almVol = $almVol + $item->almuerzo_vol;
    		echo "<td style='text-align: center;'>".$item->almuerzo_con."</td>";
    		$almCons = $almCons + $item->almuerzo_con;
    		$almuerzos = $item->almuerzo_con + $item->almuerzo_vol + $item->almuerzo_ofi;
    		echo "<td style='text-align: center;  font-weight: bold;'>".$almuerzos."</td>";    		
    		echo "<td style='text-align: center;  font-weight: bold;'>".$item->costo_almuerzo."</td>";
    		echo "<td style='text-align: center;'>".$item->merienda_ofi."</td>";
    		$merOfi = $merOfi + $item->merienda_ofi;
    		echo "<td style='text-align: center;'>".$item->merienda_vol."</td>";
    		$merVol = $merVol + $item->merienda_vol;
    		echo "<td style='text-align: center;'>".$item->merienda_con."</td>";
    		$merCons = $merCons + $item->merienda_con;
    		$meriendas = $item->merienda_con + $item->merienda_vol + $item->merienda_ofi;
    		echo "<td style='text-align: center;  font-weight: bold;'>".$meriendas."</td>";    		
    		echo "<td style='text-align: center;  font-weight: bold;'>".$item->costo_merienda."</td>";
    		echo "</tr>";
    		$costo_desayuno= $costo_desayuno + $item->costo_desayuno;
    		$costo_almuerzo= $costo_almuerzo + $item->costo_almuerzo;
    		$costo_merienda= $costo_merienda + $item->costo_merienda;
    	}?>
    	<tr><td>Total</td><td style="text-align: center; font-weight: bold;"><?php echo $desOfi;?></td><td style="text-align: center; font-weight: bold;"><?php echo $desVol;?></td><td style="text-align: center; font-weight: bold;"><?php echo $desCons;?></td><td style="text-align: center; font-weight: bold;"><?php echo $desCons+$desOfi+$desVol; ?></td><td style="text-align: center; font-weight: bold;"><?php echo number_format($costo_desayuno,2); ?></td>
    	<td style="text-align: center; font-weight: bold;"><?php echo $almOfi;?></td><td style="text-align: center; font-weight: bold;"><?php echo $almVol;?></td><td style="text-align: center; font-weight: bold;"><?php echo $almCons;?></td><td style="text-align: center; font-weight: bold;"><?php echo $almCons+$almOfi+$almVol; ?></td><td style="text-align: center; font-weight: bold;"><?php echo number_format($costo_almuerzo,2); ?></td>
    	<td style="text-align: center; font-weight: bold;"><?php echo $merOfi;?></td><td style="text-align: center; font-weight: bold;"><?php echo $merVol;?></td><td style="text-align: center; font-weight: bold;"><?php echo $merCons;?></td><td style="text-align: center; font-weight: bold;"><?php echo $merCons+$merOfi+$merVol; ?></td><td style="text-align: center; font-weight: bold;"><?php echo number_format($costo_merienda,2); ?></td>
    	</tr>
    </tbody>
    </table>
    
    <?php if(count($extraConfronta)>0):?>
    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
    <thead>
    <tr><th colspan="16" style="text-align: center;">EXTRA CONFRONTA CONSOLIDADA DEL MES DE <?php $fecha = explode('-', $fecha); echo $meses[$fecha[1]-1]." del ".$fecha[0];?></th></tr>
	    <tr>
	    	<th rowspan="2">Unidad</th>
		    <th colspan="2" style="text-align: center;">Desayunos</th>
		    <th colspan="2" style="text-align: center;">Almuerzos</th>
		    <th colspan="2" style="text-align: center;">Meriendas</th>
		   
	    </tr>
	    <tr>
	    	<th style="text-align: center;" >Cantidad</th>
	    	<th style="text-align: center;">Total</th>
	    	<th style="text-align: center;">Cantidad</th>
	    	<th style="text-align: center;">Total</th>
	    	<th style="text-align: center;">Cantidad</th>
	    	<th style="text-align: center;">Total</th>	
	    </tr>
    </thead>
    <tbody>
    	<?php 
    	$des = $alm = $mer = 0;
    	$costo_desayuno = $costo_almuerzo =  $costo_merienda =0;
    	foreach ($extraConfronta as $item) {
    		echo "<tr><td>".$item->unidad."</td>";
    		$des = $des + $item->desayuno;
    		echo "<td style='text-align: center;'>".$item->desayuno."</td>";    		
    		echo "<td style='text-align: center;  font-weight: bold;'>".$item->costo_desayuno."</td>";
    		echo "<td style='text-align: center;'>".$item->almuerzo."</td>";
    		$alm = $alm + $item->almuerzo;    		
    		echo "<td style='text-align: center;  font-weight: bold;'>".$item->costo_almuerzo."</td>";
    		echo "<td style='text-align: center;'>".$item->merienda."</td>";
    		$mer = $mer + $item->merienda;   		
    		echo "<td style='text-align: center;  font-weight: bold;'>".$item->costo_merienda."</td>";
    		echo "</tr>";
    		$costo_desayuno= $costo_desayuno + $item->costo_desayuno;
    		$costo_almuerzo= $costo_almuerzo + $item->costo_almuerzo;
    		$costo_merienda= $costo_merienda + $item->costo_merienda;
    	}?>
    	<tr><td>Total</td>
    	<td style="text-align: center; font-weight: bold;"><?php echo $des;?></td><td style="text-align: center; font-weight: bold;"><?php echo number_format($costo_desayuno,2);?></td>
    	<td style="text-align: center; font-weight: bold;"><?php echo $alm;?></td><td style="text-align: center; font-weight: bold;"><?php echo number_format($costo_almuerzo,2);?></td>
    	<td style="text-align: center; font-weight: bold;"><?php echo $mer;?></td><td style="text-align: center; font-weight: bold;"><?php echo number_format($costo_merienda,2);?></td>
    	</tr>
    </tbody>
    </table>
    <?php endif;?>
    
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

