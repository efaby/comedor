<?php $title = "Consumo Listado";?>
<?php include_once PATH_TEMPLATE.'/header.php';?>

<!-- Main row -->
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Consumo Listado</h1>
	</div>
</div>
<?php if (isset($_SESSION['message'])&& ($_SESSION['message'] != '')):?>
<div class="alert alert-success fade in alert-dismissable">
	<button type="button" class="close" data-dismiss="alert"
		aria-hidden="true">&times;</button>
								  <?php echo $_SESSION['message'];$_SESSION['message'] = ''?>
								</div>
<?php endif;?>
<div class="row">
<form id="frmUsuario" method="post" action="" >
	<div class="col-lg-12">
		<div class="form-group col-sm-3">
		<label class="control-label">Mes Consolidado</label>
		<input type="text"
			name='fecha_inicio' id='fecha_inicio' class='form-control'
			value="<?php echo $fechaInicio; ?>">

	</div>
		<div class="form-group col-sm-3" style="padding-top: 25px;">
		<input type='hidden' name='imprimir' id='imprimir' class='form-control' value="0">
			<button type="submit" class="btn btn-success boton" id="boton">Buscar</button>

		</div>
	</div>
	
</form>
<?php if(count($datos)>0):?>
<div class="col-sm-12 rows" style="text-align: right; padding: 10px;">
				<button class="btn btn-primary btn-xs" id="imprimirBtn">Imprimir</button>								
			</div>

<table class="table table-bordered ">
<tr><th colspan="11" style="text-align: center;">Tabla de Consumo del Servicio de Confronta <?php echo $parametros['unidad'];?><br>Correspondiente al mes de <?php $fecha = explode('-', $fechaInicio); echo $meses[$fecha[1]-1]." del ".$fecha[0];?></th></tr>
<tr>
<th style="vertical-align: middle" rowspan="2">Indentificación</th><th style="vertical-align: middle" rowspan="2">Nombres</th><th style="vertical-align: middle" rowspan="2">Grado</th><th style="vertical-align: middle" rowspan="2">Arma</th>
	    	<th colspan="2" style='text-align: center;'>Desayuno</th><th colspan="2" style='text-align: center;'>Almuerzo</th><th colspan="2" style='text-align: center;'>Merienda</th><th style="vertical-align: middle" rowspan="2">Total</th>
<tr><td style='text-align: center;'>Cant.</td><td style='text-align: center;'>Total</td><td style='text-align: center;'>Cant</td><td style='text-align: center;'>Total</td><td style='text-align: center;'>Cant</td><td style='text-align: center;'>Total</td>
	    	
</tr>
<?php 
$totalDes = 0; $totalAlm = 0; $totalMer = 0;
$cantDes = 0; $cantAlm = 0; $cantMer = 0;
foreach ($datos as $item):
$totalItem = 0;
			echo "<tr><td>".$item->identificacion."</td>";
			echo "<td>".$item->grado."</td>";
			echo "<td>".$item->arma."</td>";
    		echo "<td>".$item->apellidos." ".$item->nombres."</td>";  
    		
    		$cantDes = $cantDes + $item->desayuno;
    		$totalDes = $totalDes + $item->costo_desayuno;
    		$totalItem = $totalItem + $item->costo_desayuno;
    		echo "<td style='text-align: center;'>".$item->desayuno."</td>";
    		echo "<td style='text-align: center;'>".$item->costo_desayuno."</td>";
    		$cantAlm = $cantAlm + $item->almuerzo;
    		$totalAlm = $totalAlm + $item->costo_almuerzo;
    		$totalItem = $totalItem + $item->costo_almuerzo;
    		echo "<td style='text-align: center;'>".$item->almuerzo."</td>";
    		echo "<td style='text-align: center;'>".$item->costo_almuerzo."</td>";
    		$cantMer = $cantMer + $item->merienda;
    		$totalMer = $totalMer + $item->costo_merienda;
    		$totalItem = $totalItem + $item->costo_merienda;
    		echo "<td style='text-align: center;'>".$item->merienda."</td>";
    		echo "<td style='text-align: center;'>".$item->costo_merienda."</td>";
    		echo "<td style='text-align: center;'>".$totalItem."</td>";
 endforeach;?>
 <tr><td colspan="4"><b>Total</b></td><td style="text-align: center; font-weight: bold;"><?php echo $cantDes;?></td><td style="text-align: center; font-weight: bold;"><?php echo $totalDes;?></td><td style="text-align: center; font-weight: bold;"><?php echo $cantAlm;?></td><td style="text-align: center; font-weight: bold;"><?php echo $totalAlm;?></td><td style="text-align: center; font-weight: bold;"><?php echo $cantMer;?></td><td style="text-align: center; font-weight: bold;"><?php echo $totalMer;?></td><td style="text-align: center; font-weight: bold;"><?php echo $totalDes + $totalAlm + $totalMer;?></td></tr>
</table>

<?php if(count($extraConfronta)>0):?>
<table class="table table-bordered ">
<tr><th colspan="11" style="text-align: center;">Tabla de Extra Confronta <?php echo $parametros['unidad'];?><br>Correspondiente al mes de <?php $fecha = explode('-', $fechaInicio); echo $meses[$fecha[1]-1]." del ".$fecha[0];?></th></tr>
<tr>
<th style="vertical-align: middle" rowspan="2">Indentificación</th><th style="vertical-align: middle" rowspan="2">Nombres</th><th style="vertical-align: middle" rowspan="2">Grado</th><th style="vertical-align: middle" rowspan="2">Arma</th>
	    	<th colspan="2" style='text-align: center;'>Desayuno</th><th colspan="2" style='text-align: center;'>Almuerzo</th><th colspan="2" style='text-align: center;'>Merienda</th><th style="vertical-align: middle" rowspan="2">Total</th>
<tr><td style='text-align: center;'>Cant.</td><td style='text-align: center;'>Total</td><td style='text-align: center;'>Cant</td><td style='text-align: center;'>Total</td><td style='text-align: center;'>Cant</td><td style='text-align: center;'>Total</td>
	    	
</tr>
<?php 
$totalDes = 0; $totalAlm = 0; $totalMer = 0;
$cantDes = 0; $cantAlm = 0; $cantMer = 0;
foreach ($extraConfronta as $item):
$totalItem = 0;
			echo "<tr><td>".$item->identificacion."</td>";
			echo "<td>".$item->grado."</td>";
			echo "<td>".$item->arma."</td>";
    		echo "<td>".$item->apellidos." ".$item->nombres."</td>";  
    		
    		$cantDes = $cantDes + $item->desayuno;
    		$totalDes = $totalDes + $item->costo_desayuno;
    		$totalItem = $totalItem + $item->costo_desayuno;
    		echo "<td style='text-align: center;'>".$item->desayuno."</td>";
    		echo "<td style='text-align: center;'>".$item->costo_desayuno."</td>";
    		$cantAlm = $cantAlm + $item->almuerzo;
    		$totalAlm = $totalAlm + $item->costo_almuerzo;
    		$totalItem = $totalItem + $item->costo_almuerzo;
    		echo "<td style='text-align: center;'>".$item->almuerzo."</td>";
    		echo "<td style='text-align: center;'>".$item->costo_almuerzo."</td>";
    		$cantMer = $cantMer + $item->merienda;
    		$totalMer = $totalMer + $item->costo_merienda;
    		$totalItem = $totalItem + $item->costo_merienda;
    		echo "<td style='text-align: center;'>".$item->merienda."</td>";
    		echo "<td style='text-align: center;'>".$item->costo_merienda."</td>";
    		echo "<td style='text-align: center;'>".$totalItem."</td>";
 endforeach;?>
 <tr><td colspan="4"><b>Total</b></td><td style="text-align: center; font-weight: bold;"><?php echo $cantDes;?></td><td style="text-align: center; font-weight: bold;"><?php echo $totalDes;?></td><td style="text-align: center; font-weight: bold;"><?php echo $cantAlm;?></td><td style="text-align: center; font-weight: bold;"><?php echo $totalAlm;?></td><td style="text-align: center; font-weight: bold;"><?php echo $cantMer;?></td><td style="text-align: center; font-weight: bold;"><?php echo $totalMer;?></td><td style="text-align: center; font-weight: bold;"><?php echo $totalDes + $totalAlm + $totalMer;?></td></tr>
</table>
<?php endif;?>
			<?php endif;?>
</div>

<?php include_once PATH_TEMPLATE.'/footer.php';?>
<script src="<?php echo PATH_JS; ?>/formValidation.js"></script>
<script src="<?php echo PATH_JS; ?>/bootstrap.js"></script>
<script src="<?php echo PATH_JS; ?>/currentList.js"></script>
<link href="<?php echo PATH_CSS; ?>/bootstrapValidator.min.css"
	rel="stylesheet">
	
<script type="text/javascript">

function imprimir(){
	var posicion_x; 
	var posicion_y; 
	var ancho = 900;
	var alto = 550;
	posicion_x=(screen.width/2)-(ancho/2); 
	posicion_y=(screen.height/2)-(alto/2); 
	var accion = "../imprimirListado/0" + "&fecha_inicio="+ $('#fecha_inicio').val(); 
	var opciones="toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width="+ancho+",height="+alto+",left="+posicion_x+",top="+posicion_y;
	window.open(accion,"",opciones);
}



$(document).ready(function() {
	
	$('#imprimirBtn').click(function() {
		imprimir();
	});
	
	jQuery( "#fecha_inicio" ).datepicker({  
		changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        dateFormat: 'yy-mm',
        onClose: function(dateText, inst) { 
            $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
            $('#frmUsuario').formValidation('revalidateField', 'fecha_inicio');
        }		
	});
	
    $('#frmUsuario').formValidation({
    	message: 'This value is not valid',
		feedbackIcons: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
		fields: {			

					fecha_inicio: {
						 validators: {
							 notEmpty: {
								 message: 'El mes es requerido y no puede ser vacio'
							 },							 
							 regexp: {
									regexp: /^[0-9]{4}-(0[1-9]|1[0-2])$/,
									message: 'Ingrese un mes válido.'
								},	                
							 							 
						 }
					 },	
		}
		 
	});
});
</script>
<style>
.ui-datepicker-calendar {
    display: none;
    }
</style>
</body>
</html>