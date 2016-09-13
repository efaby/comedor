<?php $title = "Editar Reparación";?>
<?php include_once PATH_TEMPLATE.'/header.php';?>

<!-- Main row -->
<div class="row">
	<div class="col-lg-12">
    	<h1 class="page-header">Ingreso Reparación</h1>
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


	<div class="col-sm-12 panel panel-default" style="margin-left: 15px; width: 98%; ">
		
		<div class="form-group col-sm-12">
			<div class="form-group col-sm-6" style="padding-left: 0px; padding-top: 10px;">
				<label class="control-label">Identificación Cliente:</label> <input type='text'
					name='identificacion' class='form-control' id="identificacion"
					value="">
			</div>
			<div class="form-group col-sm-6" id="registro" style=" display: none; padding-top: 10px;">
			<label class="control-label">El Cliente No existe! Por favor ingrese un nuevo Cliente</label></br>
			<button class="btn btn-primary" id="modalOpen">
				Nuevo Cliente
			</button>
			</div>
		</div>
		<div class="form-group col-sm-12" id="datos" style="display: none;">	
			<label class="control-label">Nombre Cliente:</label><div id="nombre_cliente"></div> 
			<label class="control-label">Dirección: </label> <div id="direccion_cliente"></div>
			<label class="control-label">Teléfonos:</label><div id="telefono_cliente"></div> 
			<label class="control-label">Email:</label><div id="email_cliente"></div> 		
		</div>
	</div>
	
	<form id="frmReparacion" method="post" action="">
	<div class="col-sm-12 panel panel-default" style="margin-left: 15px; width: 98%; padding-right: 15px; display: none; " id="reparacion">
	<h4>Detalles Equipo a Reparar</h4>
	<div class="form-group col-sm-6">
		<label class="control-label">Número de Serie</label> <input type='text'
			name='numero_serie' class='form-control'
			value="">

	</div>
	<div class="form-group col-sm-6">
		<label class="control-label">Nombre Equipo</label> <input type='text'
			name='nombre' class='form-control'
			value="">

	</div>
	<div class="form-group col-sm-6">
		<label class="control-label">Marca</label>
		<input type='text'
			name='marca' class='form-control'
			value="">

	</div>
	
	<div class="form-group  col-sm-6">
		<label class="control-label">Modelo</label>
		<input type='text'
			name='modelo' class='form-control'
			value="">

	</div>
	<div class="form-group col-sm-12">
		<label class="control-label">Observación del Equipo</label> <input type='text'
			name='observacion' class='form-control'
			value="">

	</div>
	
	<div class="form-group col-sm-12">
		<label class="control-label">Problema a Reparar</label>
		<textarea name='observaciones' style="width: 100%"></textarea>
		

	</div>
	<div class="form-group col-sm-6">
		<label class="control-label">Fecha Ingreso</label>
		<input type='text' id="fecha"
			name='fecha' class='form-control'
			value="">

	</div>
	
	<div class="form-group  col-sm-6">
		<label class="control-label">Técnico Asignado</label>
		<select class='form-control' name="tecnico_id">
			<option value="" >Seleccione</option>
		<?php foreach ($tecnicos as $dato) { ?>
			<option value="<?php echo $dato['id'];?>" ><?php echo $dato['nombres']." ".$dato['apellidos'];?></option>
		<?php }?>
		</select>

	</div>
	
	<div class="form-group">
	<input type='hidden' name='id' class='form-control' value="0">
	<input type='hidden' name='cliente_id' id="cliente_id" class='form-control' value="">
		<button type="submit" class="btn btn-success">Guardar</button>
	</div>
</div>
</form>
</div>
<div class="modal fade" id="confirm-submit" tabindex="-1" role="dialog"
	aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" >
		<div class="modal-content">
			<div class="modal-header">
				<a class="close" data-dismiss="modal">×</a>
				<h3>Cliente</h3>
			</div>

			<div class="modal-body"></div>

		</div>

	</div>
</div>

<?php include_once PATH_TEMPLATE.'/footer.php';?>
<script src="<?php echo PATH_JS; ?>/bootstrapValidator.min.js"></script>
<link href="<?php echo PATH_CSS; ?>/bootstrapValidator.min.css" rel="stylesheet">  
<script src="<?php echo PATH_JS; ?>/bootstrap-datepicker.js"></script>
<link href="<?php echo PATH_CSS; ?>/datepicker.min.css" rel="stylesheet">  
<script src="<?php echo PATH_JS; ?>/moment.min.js"></script>
<script src="<?php echo PATH_JS; ?>/bootstrap-datetimepicker.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
	
	$( "#fecha" ).datetimepicker({		
		pickTime: false, 
	      format: "YYYY-MM-DD", 
	      defaultDate: new Date()
		});
	
	
	$('#identificacion').keyup(function(){
		var ci = jQuery("#identificacion").val();
	    if(ci.length == 10){
	    	jQuery.ajax({
		        type: "GET",
		        dataType: "json",
		        url: "../buscarCliente/" + ci,		        
		        success:function(data) {
			        if(data && data.id > 0){
						$("#datos").css("display", "block");
						$("#nombre_cliente").empty();
						$("#nombre_cliente").append(data.nombres + ' ' + data.apellidos);
						$("#direccion_cliente").empty();
						$("#direccion_cliente").append(data.direccion);
						$("#telefono_cliente").empty();
						$("#telefono_cliente").append(data.telefono + ' - ' + data.celular);
						$("#email_cliente").empty();
						$("#email_cliente").append(data.email);
						$("#cliente_id").val(data.id);
						$("#reparacion").css("display", "block");
						
			        } else {
			        	$("#registro").css("display", "block");
			        }
		        	
		        }
		    });
	    } else {
	    	$("#datos").css("display", "none");
	    	$("#registro").css("display", "none");
	    	
	    	$(':input','#frmReparacion')
	    	 .not(':button, :submit, :reset, :hidden, #fecha')
	    	 .val('')
	    	 .removeAttr('checked')
	    	 .removeAttr('selected');
	    	$("#reparacion").css("display", "none");
	    }
	});
	
	$('#modalOpen').click(function(){	  
		$('.modal-body').load('../../Cliente/editar/-1' ,function(result){
		    $('#confirm-submit').modal({show:true});
		});
	});
    $('#frmReparacion').bootstrapValidator({
    	message: 'This value is not valid',
		feedbackIcons: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
		fields: {			
			numero_serie: {
				message: 'El Número de Serie no es válido',
				validators: {
							notEmpty: {
								message: 'El Número de Serie no puede ser vacío.'
							},					
							regexp: {
								regexp: /^[a-zA-Z0-9_ ,-\.]+$/,
								message: 'Ingrese un Número de Serie válido.'
							}
						}
					},
			nombre: {
				message: 'El Nombre del Equipo no es válido',
				validators: {
					notEmpty: {
						message: 'El Nombre del Equipo no puede ser vacío.'
					},					
					regexp: {
						regexp: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9_ ,-\.]+$/,
						message: 'Ingrese un Nombre del Equipo válido.'
					}
				}
			},
			marca: {
				message: 'La Marca no es válida',
				validators: {
					notEmpty: {
						message: 'La Marca no puede ser vacía.'
					},					
					regexp: {
						regexp: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9_ ,-\.]+$/,
						message: 'Ingrese una Marca válida.'
					}
				}
			},
			modelo: {
				message: 'El Modelo no es válido',
				validators: {
							notEmpty: {
								message: 'El Modelo no puede ser vacío.'
							},					
							regexp: {
								regexp: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9_ ,-\.]+$/,
								message: 'Ingrese un Modelo válido.'
							}
						}
				
			},
			
			observacion: {
				message: 'La Observación del Equipo no es válida',
				validators: {
							notEmpty: {
								message: 'La Observación del Equipo no puede ser vacía.'
							},					
							regexp: {
								regexp: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9_ ,-\.]+$/,
								message: 'Ingrese una Observacion del Equipo válida.'
							}
						}
				
			},	
			observaciones: {
				message: 'El Problema a Reparar no es válido',
				validators: {
					notEmpty: {
						message: 'E Problema a Reparar no puede ser vacío.'
					},					
					regexp: {
						regexp: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9_ ,-\.]+$/,
						message: 'Ingrese un Problema a Reparar válido.'
					}
				}
			},			
			fecha: {
				message: 'La fecha no es válida',
				validators: {
					 notEmpty: {
						 message: 'La fecha de ingreso no puede ser vacía'
					 },
					 date: {
						 format: 'YYYY-MM-DD',
		                 message: 'La fecha de ingreso no es válida.'
					 }
					 
				 }
			},
			tecnico_id: {
				validators: {
					notEmpty: {
						message: 'Seleccione un Tecnico'
					}
				}
			},	
		},
		submitHandler: function(validator, form, submitButton) {
			$.ajax({
		           type: "POST",
		           dataType: "json",
		           url: '../guardar/',
		           data: $("#frmReparacion").serialize(), 
		           success: function(data){
		        	   var posicion_x; 
		        		var posicion_y; 
		        		var ancho = 800;
		        		var alto = 450;
		        		posicion_x=(screen.width/2)-(ancho/2); 
		        		posicion_y=(screen.height/2)-(alto/2); 
		        		var accion = "../imprimir/"+data;
		        		var opciones="toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width="+ancho+",height="+alto+",left="+posicion_x+",top="+posicion_y;
		        		window.open(accion,"",opciones);
		           }
		         });
	         return false;
		}
		
	});

});

</script>
<style>
.col-sm-6, .col-sm-12 {
	padding-right: 0px;
}
</style>
</body>
</html>
