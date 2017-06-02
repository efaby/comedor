<?php $title = "Confronta";?>
<?php include_once PATH_TEMPLATE.'/header.php';?>

<!-- Main row -->
<div class="row">
	<div class="col-lg-12">
    	<h1 class="page-header">Confrontas</h1>
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
			name='fecha' id='fecha' class='form-control'
			value="<?php echo $fecha; ?>">

	</div>
		<div class="form-group col-sm-3" style="padding-top: 25px;">
		
		<input type='hidden' name='imprimir' id='imprimir' class='form-control' value="0">
			<button type="submit" class="btn btn-success boton" id="boton">Generar</button>

		</div>
	</div>
	
</form>

<div class="col-sm-12 rows" style="text-align: right; padding: 10px;">
				<button class="btn btn-primary btn-xs" id="imprimirBtn">Imprimir</button>								
			</div>


<?php if(count($datos)>0):?>
	<table class="table table-striped table-bordered table-hover" id="dataTables-example">
    <thead>
    <tr><th colspan="16" style="text-align: center;">CONFRONTA CONSOLIDADA DEL MES DE <?php $fecha1 = explode('-', $fecha); echo $meses[$fecha1[1]-1]." del ".$fecha1[0];?></th></tr>
	    <tr>
	    	<th rowspan="2">Unidad</th>
		    <th colspan="5" style="text-align: center;">Desayunos</th>
		    <th colspan="5" style="text-align: center;">Almuerzos</th>
		    <th colspan="5" style="text-align: center;">Meriendas</th>
		   
	    </tr>
	    <tr>
	    	<th >OFI</th>
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
    
    <?php endif;?>
</div>

<?php include_once PATH_TEMPLATE.'/footer.php';?>   
<script src="<?php echo PATH_JS; ?>/formValidation.js"></script>
<script src="<?php echo PATH_JS; ?>/bootstrap.js"></script>
<link href="<?php echo PATH_CSS; ?>/bootstrapValidator.min.css" rel="stylesheet">

<script type="text/javascript">

function imprimir(url,valor){
	var posicion_x; 
	var posicion_y; 
	var ancho = 900;
	var alto = 550;
	posicion_x=(screen.width/2)-(ancho/2); 
	posicion_y=(screen.height/2)-(alto/2); 
	var accion = "../"+url+"/" + "?fecha=" + valor; 
	
	var opciones="toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width="+ancho+",height="+alto+",left="+posicion_x+",top="+posicion_y;
	window.open(accion,"",opciones);
}






$(document).ready(function() {
	
	$('#imprimirBtn').click(function() {
		imprimir('imprimirReporteConsolidado',$('#fecha').val());
	});
	
	jQuery( "#fecha" ).datepicker({  
		changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        dateFormat: 'yy-mm',
        onClose: function(dateText, inst) { 
            $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
            $('#frmUsuario').formValidation('revalidateField', 'fecha');
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

					fecha: {
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