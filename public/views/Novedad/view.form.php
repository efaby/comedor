<form id="frmUsuario" method="post" action="../guardar/" enctype="multipart/form-data">
<div style="overflow: auto;">
	<div class="form-group  col-sm-6">
		<label class="control-label">Tipo Novedad</label>
		<select class='form-control' name="tipo_novedad_id">
			<option value="" >Seleccione</option>
		<?php foreach ($tipos as $dato) { ?>
			<option value="<?php echo $dato->id;?>"  <?php if($item->tipo_novedad_id==$dato->id):echo "selected"; endif;?>><?php echo $dato->nombre;?></option>
		<?php }?>
		</select>

	</div>
	<div class="form-group col-sm-6">
		<label class="control-label">Identificación</label> <input type='text'
			name='identificacion' class='form-control'
			value="<?php echo $item->identificacion; ?>" id="identificacion">

	</div>
	
	</div>
	
	
	<div class="form-group col-sm-12">
		<label class="control-label">Persona</label> <input type='text'
			name='nombres' class='form-control' readonly="readonly"
			value="<?php echo $item->nombres; ?>" id="nombres">

	</div>
	
	<div class="form-group col-sm-6">
		<label class="control-label">Fecha Inicio</label>
		<input type="text"
			name='fecha_inicio' id='fecha_inicio' class='form-control'
			value="<?php echo $item->fecha_inicio; ?>">

	</div>
	<div class="form-group col-sm-6">
		<label class="control-label">Fecha Fin</label>
		<input type="text"
			name='fecha_fin' id='fecha_fin' class='form-control'
			value="<?php echo $item->fecha_fin; ?>">

	</div>
	<div class="form-group col-sm-12">
		<label class="control-label">Respado Digital</label> 
		
		<?php if($item->url != ''):?>
			<input type='file' name='url1' id="url1" class="file">		
			<a href="../downloadFile/?nameFile=<?php echo $item->url;?>">Descargar</a>
			<input type="hidden" name="fileName" value="<?php echo $item->url;?>">
		<?php else :?>
			<input type='file' name='url' id="url" class="file">	
		<?php endif;?>
	</div>
	<div class="form-group">
	<input type='hidden' name='id' class='form-control' value="<?php echo $item->id; ?>">
	<input type='hidden' name='persona_id' id='persona_id' class='form-control' value="<?php echo $item->persona_id; ?>">
	<input type='hidden' name='unidad_id' id='unidad_id' class='form-control' value="<?php echo $unidad_id; ?>">
		<button type="submit" class="btn btn-success boton" id="boton">Guardar</button>
	</div>

</form>
<script src="<?php echo PATH_JS; ?>/calendar.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	
	jQuery( "#fecha_inicio" ).datepicker({  
		dateFormat: "yy-mm-dd",
		onClose: function( selectedDate ) {
	        $( "#fecha_fin" ).datepicker( "option", "minDate", selectedDate );
	      }  		
	});
	jQuery( "#fecha_fin" ).datepicker({  
		dateFormat: "yy-mm-dd",
		onClose: function( selectedDate ) {
	        $( "#fecha_inicio" ).datepicker( "option", "maxDate", selectedDate );
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
		        	jQuery("#unidad").val('');
		        	jQuery("#persona_id").val(0);
			        if(data){
				        if(jQuery("#unidad_id").val()==0||jQuery("#unidad_id").val()==data.unidad_id){
				        	jQuery("#nombres").val(data.nombres + ' ' + data.apellidos);
				        	jQuery("#unidad").val(data.unidad_id);
				        	jQuery("#boton").removeClass('disabled');
				        	jQuery("#persona_id").val(data.id);
				        	$('#frmUsuario').formValidation('revalidateField', 'unidad_id');
				        	$('#frmUsuario').formValidation('revalidateField', 'usuario');
				        } else {
				        	alert("La persona no pertenece a su Unidad. Usted solo puede registrar novedades de miembros de su Unidad.");
							jQuery("#boton").addClass('disabled');
				        }		        	
			        	
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
			
			
			tipo_novedad_id: {
				validators: {
					notEmpty: {
						message: 'Seleccione un Tipo de Novedad'
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
	        url: {
				validators: {
					notEmpty: {
						message: 'Seleccione un Archivo.'
					},
					file: {
	                    extension: 'pdf,docx,doc',
	                    maxSize: 2097152,
	                    message: 'Seleccione un archivo válido. (pdf, doc, docx) y no mayor a 2 MB.'
	                }
				}
			},
			url1: {
				validators: {							
					file: {
	                    extension: 'pdf,docx,doc',
	                    maxSize: 2097152,
	                    message: 'Seleccione un archivo válido. (pdf, doc, docx) y no mayor a 2 MB.'
	                }
				}
			}		
			
			
		}
	});
});
</script>
<style>
.boton {
	margin-left: 15px;
}
.datepicker{
        z-index: 1200   !important;
    }
    
</style>