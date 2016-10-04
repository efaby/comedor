<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
	<link href="<?php echo PATH_CSS . '/bootstrap.min.css';?>" rel="stylesheet">
	<link href="<?php echo PATH_CSS; ?>/font-awesome.min.css" rel="stylesheet" type="text/css" />
		</head>
 
	<body class="tooltips">
<div class="table-responsive">
<div class="col-sm-12 hidden-print" style="text-align: right;">
				<a href="javascript:window.print()"> <span class="glyphicon glyphicon-print"></span>&nbsp;Imprimir</a>								
			</div>	
			<div class="divHeader col-sm-12  rows" style="display: ;">
<table style="width: 100%">
  <tbody><tr><td width="8%"><img width="60px" src="<?php echo PATH_IMAGES . '/ejercito.jpg';?>" ></td>
  <td width="82%" align="center">
  <b><p style="font-size: 18px;  margin-bottom: 0px;">Confronta de Rancho de <?php echo $general->unidad;?></p>
  Para el dia <?php echo $fecha;?></b></td>
  <td width="5%"></td></tr>
</tbody></table>
<hr>
</div>
			<div class="col-sm-12 rows">	
	<table class="table table-th-block table-hover">
		<thead class="the-box dark full">
						<tr>
							<th>Identificación</th>
							<th>Nombres</th>
							<th>Grado</th>
							<th>Arma</th>
							<th>DES</th>
							<th>ALM</th>
							<th>MER</th>
						</tr>
					</thead>
					<tbody>
							<?php foreach ($listado as $item): ?>
						<tr>
							<td><?php echo $item->identificacion ?></td>
							<td><?php echo $item->nombres; ?> <?php echo $item->apellidos; ?></td>
							<td><?php echo $item->grado; ?></td>
							<td><?php echo $item->arma; ?></td>
							<?php if($item->nombre == ''):?>
							<td style="text-align: center;"><?php echo ($item->desayuno)?'<i class="fa fa-check">':'<i class="fa fa-times">'; ?> </i></td>
							<td style="text-align: center;"><?php echo ($item->almuerzo)?'<i class="fa fa-check">':'<i class="fa fa-times">'; ?></td>
							<td style="text-align: center;"><?php echo ($item->merienda)?'<i class="fa fa-check">':'<i class="fa fa-times">'; ?></td>
							<?php else:?>
							<td colspan='3' style='text-align: center;'><a href="../downloadFile/?nameFile=<?php echo $item->url;?>"><?php echo $item->nombre; ?></a></td>
							<?php endif;?>
						</tr>
								<?php endforeach;?>
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

@page{
        size: auto A4 landscape;
        margin: 5mm;
     }
</style>
</body>
</html>

		