<?php $title = "Consumo Individual";?>
<?php include_once PATH_TEMPLATE.'/header.php';?>

<!-- Main row -->
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Consumo Individual</h1>
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
			<label class="control-label">Identificación</label> <input
				type='text' name='identificacion' class='form-control'
				value="<?php echo $item->identificacion; ?>" id="identificacion">

		</div>
		<div class="form-group col-sm-4">
			<label class="control-label">Persona</label> <input type='text'
				name='nombres' class='form-control' readonly="readonly"
				value="<?php echo $item->nombres ." ". $item->apellidos; ?>" id="nombres">

		</div>
		<div class="form-group col-sm-3">
		<input type='hidden' name='id' id='id' class='form-control' value="<?php echo $item->id; ?>">
		<input type='hidden' name='imprimir' id='imprimir' class='form-control' value="0">
			<button type="submit" class="btn btn-success boton" id="boton">Buscar</button>

		</div>
	</div>
	<div class="col-lg-12">
	<div class="form-group col-sm-3">
		<label class="control-label">Desde</label>
		<input type="text"
			name='fecha_inicio' id='fecha_inicio' class='form-control'
			value="<?php echo $fechaInicio; ?>">

	</div>
	<div class="form-group col-sm-3">
		<label class="control-label">Hasta</label>
		<input type="text"
			name='fecha_fin' id='fecha_fin' class='form-control'
			value="<?php echo $fechaFin; ?>">

	</div>
	</div>
</form>
<?php if(count($datos)>0):?>
<div class="col-sm-12 rows" style="text-align: right; padding: 10px;">
				<button class="btn btn-primary btn-xs" id="imprimirBtn">Imprimir</button>								
			</div>

<table class="table table-bordered ">
<tr><th colspan="4" style="text-align: center;">Tabla de Consumo del Servicio de Confronta <?php echo $parametros['unidad'];?></th></tr>
<tr><td><b>Nombre</b></td><td><?php echo $item->nombres ." ". $item->apellidos; ?></td><td><b>Identificación</b></td><td><?php echo $item->identificacion?></td></tr>
<?php foreach ($datos as $item):?>
<tr>
<td colspan="4">
<div style="font-weight: bold; padding: 5px">Mes <?php $total = 0; $fecha = explode('-', $item->fecha); echo $meses[$fecha[1]-1]." del ".$fecha[0];?></div>
<table class="table table-bordered " style="width: 30%">
<tr><th></th><th style="text-align: center;">Cantidad</th><th style="text-align: center;">Total</th></tr>
<tr><td>Desayuno</td><td style="text-align: center;"><?php echo $item->desayuno;?></td><td style="text-align: center;"><?php $total = $total + $item->desayuno * $parametros['desayuno']; echo $item->desayuno * $parametros['desayuno']; ?></td></tr>
<tr><td>Almuerzo</td><td style="text-align: center;"><?php echo $item->almuerzo;?></td><td style="text-align: center;"><?php $total = $total + $item->almuerzo * $parametros['almuerzo']; echo $item->almuerzo * $parametros['almuerzo']; ?></td></tr>
<tr><td>Merienda</td><td style="text-align: center;"><?php echo $item->merienda;?></td><td style="text-align: center;"><?php $total = $total + $item->merienda * $parametros['merienda']; echo $item->merienda * $parametros['merienda']; ?></td></tr>
<tr><td>Total</td><td></td><td style="text-align: center;"><?php echo $total; ?></td></tr>
</table>
</td>
</tr>
<?php endforeach;?>
</table>
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
	var accion = "../imprimirIndividual/" + $('#id').val() + "&fecha_inicio=" + $('#fecha_inicio').val() + "&fecha_fin=" + $('#fecha_fin').val() + "&identificacion=" + $('#identificacion').val(); 
	var opciones="toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width="+ancho+",height="+alto+",left="+posicion_x+",top="+posicion_y;
	window.open(accion,"",opciones);
}



$(document).ready(function() {
	
	$('#imprimirBtn').click(function() {
		imprimir();
	});
	
	jQuery( "#fecha_inicio" ).datepicker({  
		dateFormat: "yy-mm-dd",
		onClose: function( selectedDate ) {
	        $( "#fecha_fin" ).datepicker( "option", "minDate", selectedDate );
	        $('#frmUsuario').formValidation('revalidateField', 'fecha_inicio');
	      }  		
	});
    
	jQuery( "#fecha_fin" ).datepicker({  
		dateFormat: "yy-mm-dd",
		onClose: function( selectedDate ) {
	        $( "#fecha_inicio" ).datepicker( "option", "maxDate", selectedDate );
	        $('#frmUsuario').formValidation('revalidateField', 'fecha_fin');
	      }  		
	});
    
	
	$('#identificacion').keyup(function(){
	    var ci = jQuery("#identificacion").val();
	    if(ci.length == 10){
	    	jQuery.ajax({
		        type: "GET",
		        dataType: "json",
		        url: "../getPersona/",
		        data: {
		        	"identificacion": ci
		        },
		        success:function(data) {
		        	jQuery("#nombres").val('');		        	
		        	jQuery("#id").val(0);
			        if(data){
			        	jQuery("#nombres").val(data.nombres + ' ' + data.apellidos);			        	
			        	jQuery("#id").val(data.id);
			        	jQuery("#boton").removeClass('disabled');
			        } else {
						alert("La persona no exite por favor regístrelo en la sección Personal");
						jQuery("#boton").addClass('disabled');
			        }
		        	
		        }
		    });
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
			identificacion: {
				message: 'El Número de Identificación no es válido',
				validators: {
							notEmpty: {
								message: 'El Número de Identificación no puede ser vacío.'
							},					
							regexp: {
								regexp: /^(?:\+)?\d{10,13}$/,
								message: 'Ingrese un Número de Identificación válido.'
							}
						}
					},
					fecha_inicio: {
						 validators: {
							 notEmpty: {
								 message: 'La fecha de inicio es requerida y no puede ser vacia'
							 },
							 date:{	 
								    format: 'YYYY-MM-DD',
				                    message: 'La fecha de inicio no es válida.'				                    
							 },
							 							 
						 }
					 },
					 
			        fecha_fin: {
			        	 validators: {
							 notEmpty: {
								 message: 'La fecha de fin es requerida y no puede ser vacia'
							 },
							 date: {
								 format: 'YYYY-MM-DD',
				                 message: 'La fecha de fin no es válida.'
							 }							 
						 }
			        },
			
			
		}
	});
});
</script>

</body>
</html>