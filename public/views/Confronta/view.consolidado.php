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
		<label class="control-label">Dia Consolidado</label>
		<input type="text"
			name='fecha' id='fecha' class='form-control'
			value="<?php echo $fecha; ?>">

	</div>
		<div class="form-group col-sm-3" style="padding-top: 25px;">
		<input type='hidden' name='id' id='id' class='form-control' value="<?php echo $item->id; ?>">
		<input type='hidden' name='imprimir' id='imprimir' class='form-control' value="0">
			<button type="submit" class="btn btn-success boton" id="boton">Buscar</button>

		</div>
	</div>
	
</form>

<div class="col-sm-12 rows" style="text-align: right; padding: 10px;">
				<button class="btn btn-primary btn-xs" id="imprimirBtn">Imprimir</button>								
			</div>



	<table class="table table-striped table-bordered table-hover" id="dataTables-example">
    <thead>
	    <tr>
	    	<th rowspan="2">Unidad</th>
		    <th colspan="4" style="text-align: center;">Desayunos</th>
		    <th colspan="4" style="text-align: center;">Almuerzos</th>
		    <th colspan="4" style="text-align: center;">Meriendas</th>
		    <th rowspan="2" style="text-align: center; width: 20%">Acciones</th>
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
	    	<th style="border-right: 1px solid #ddd;">CON</th>	 
	    	<th>Total</th>   	
	    </tr>
    </thead>
    <tbody>
    	<?php 
    	$desOfi = $almOfi = $merOfi = 0;
    	$desVol = $almVol = $merVol = 0;
    	$desCons = $almCons = $merCons = 0;
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
    		echo "<td style='text-align: center;'>".$item->almuerzo_ofi."</td>";
    		$almOfi = $almOfi + $item->almuerzo_ofi;
    		echo "<td style='text-align: center;'>".$item->almuerzo_vol."</td>";
    		$almVol = $almVol + $item->almuerzo_vol;
    		echo "<td style='text-align: center;'>".$item->almuerzo_con."</td>";
    		$almCons = $almCons + $item->almuerzo_con;
    		$almuerzos = $item->almuerzo_con + $item->almuerzo_vol + $item->almuerzo_ofi;
    		echo "<td style='text-align: center;  font-weight: bold;'>".$almuerzos."</td>";
    		echo "<td style='text-align: center;'>".$item->merienda_ofi."</td>";
    		$merOfi = $merOfi + $item->merienda_ofi;
    		echo "<td style='text-align: center;'>".$item->merienda_vol."</td>";
    		$merVol = $merVol + $item->merienda_vol;
    		echo "<td style='text-align: center;'>".$item->merienda_con."</td>";
    		$merCons = $merCons + $item->merienda_vol;
    		$meriendas = $item->merienda_con + $item->merienda_vol + $item->merienda_ofi;
    		echo "<td style='text-align: center;  font-weight: bold;'>".$meriendas."</td>";   		
    		echo "<td align='center'>
		    		<a href='javascript:imprimir(".$item->id.",\"verGeneral\",0);' class='btn btn-info btn-sm' title='Ver Resumen'><i class='fa fa-file-text-o'></i></a>  
		    		<a href='javascript:imprimir(".$item->id.",\"verListado\",".$item->unidad_id.");' class='btn btn-success btn-sm' title='Ver Listado'><i class='fa fa-book'></i></a>		    		  
		    		</td></tr>";
    	}?>
    	<tr><td>Total</td><td style="text-align: center; font-weight: bold;"><?php echo $desOfi;?></td><td style="text-align: center; font-weight: bold;"><?php echo $desVol;?></td><td style="text-align: center; font-weight: bold;"><?php echo $desCons;?></td><td style="text-align: center; font-weight: bold;"><?php echo $desCons+$desOfi+$desVol; ?></td>
    	<td style="text-align: center; font-weight: bold;"><?php echo $almOfi;?></td><td style="text-align: center; font-weight: bold;"><?php echo $almVol;?></td><td style="text-align: center; font-weight: bold;"><?php echo $almCons;?></td><td style="text-align: center; font-weight: bold;"><?php echo $almCons+$almOfi+$almVol; ?></td>
    	<td style="text-align: center; font-weight: bold;"><?php echo $merOfi;?></td><td style="text-align: center; font-weight: bold;"><?php echo $merVol;?></td><td style="text-align: center; font-weight: bold;"><?php echo $merCons;?></td><td style="text-align: center; font-weight: bold;"><?php echo $merCons+$merOfi+$merVol; ?></td>
    	<td></td></tr>
    </tbody>
    </table>
</div>

<?php include_once PATH_TEMPLATE.'/footer.php';?>   
<script src="<?php echo PATH_JS; ?>/formValidation.js"></script>
<script src="<?php echo PATH_JS; ?>/bootstrap.js"></script>
<link href="<?php echo PATH_CSS; ?>/bootstrapValidator.min.css" rel="stylesheet">

<script type="text/javascript">

function imprimir(id,url,valor){
	var posicion_x; 
	var posicion_y; 
	var ancho = 900;
	var alto = 550;
	posicion_x=(screen.width/2)-(ancho/2); 
	posicion_y=(screen.height/2)-(alto/2); 
	var accion = "../"+url+"/" + id;
	if(valor!=0){
		accion = accion + "&valor=" + valor; 
	}
	var opciones="toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width="+ancho+",height="+alto+",left="+posicion_x+",top="+posicion_y;
	window.open(accion,"",opciones);
}






$(document).ready(function() {
	
	$('#imprimirBtn').click(function() {
		imprimir(0,'imprimirConsolidado',$('#fecha').val());
	});
	
	jQuery( "#fecha" ).datepicker({  
		dateFormat: "yy-mm-dd",
		onClose: function( selectedDate ) {
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
								 message: 'La fecha es requerida y no puede ser vacia'
							 },
							 date:{	 
								    format: 'YYYY-MM-DD',
				                    message: 'La fecha no es válida.'				                    
							 },
							 							 
						 }
					 },
		}
		 
	});
});
</script>



</body>
</html>