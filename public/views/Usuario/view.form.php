<form id="frmUsuario" method="post" action="../guardar/">
<div style="overflow: auto;">
	<div class="form-group  col-sm-6">
		<label class="control-label">Tipo Usuario</label>
		<select class='form-control' name="tipo_usuario_id">
			<option value="" >Seleccione</option>
		<?php foreach ($tipos as $dato) { ?>
			<option value="<?php echo $dato->id;?>"  <?php if($item->tipo_usuario_id==$dato->id):echo "selected"; endif;?>><?php echo $dato->nombre;?></option>
		<?php }?>
		</select>

	</div>
	<div class="form-group col-sm-6">
		<label class="control-label">Identificación</label> <input type='text'
			name='identificacion' class='form-control'
			value="<?php echo $item->identificacion; ?>" id="identificacion">

	</div>
	
	</div>
	
	
	<div class="form-group col-sm-6">
		<label class="control-label">Persona</label> <input type='text'
			name='nombres' class='form-control' readonly="readonly"
			value="<?php echo $item->nombres; ?>" id="nombres">

	</div>
	<div class="form-group  col-sm-6">
		<label class="control-label">Unidad</label>
		<select class='form-control' name="unidad_id" id="unidad">
			<option value="" >Seleccione</option>
		<?php foreach ($unidades as $dato) { ?>
			<option value="<?php echo $dato->id;?>"  <?php if($item->unidad_id==$dato->id):echo "selected"; endif;?>><?php echo $dato->nombre;?></option>
		<?php }?>
		</select>

	</div>
	<div class="form-group col-sm-12">
		<label class="control-label">Nombre de Usuario</label> <input type='text'
			name='usuario' class='form-control'
			value="<?php echo $item->usuario; ?>" id="usuario">

	</div>
	

	<div class="form-group col-sm-6">
		<label class="control-label">Contraseña</label>
		<input type="password"
			name='password' class='form-control'
			value="<?php echo $item->password; ?>">

	</div>
	<div class="form-group col-sm-6">
		<label class="control-label">Repetir Contraseña</label>
		<input type="password"
			name='password1' class='form-control'
			value="<?php echo $item->password1; ?>">

	</div>
	<div class="form-group">
	<input type='hidden' name='id' class='form-control' value="<?php echo $item->id; ?>">
	<input type='hidden' name='persona_id' id='persona_id' class='form-control' value="<?php echo $item->persona_id; ?>">
		<button type="submit" class="btn btn-success boton" id="boton">Guardar</button>
	</div>

</form>

<script type="text/javascript">
$(document).ready(function() {

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
		        	jQuery("#usuario").val('');
		        	jQuery("#unidad").val('');
		        	jQuery("#persona_id").val(0);
			        if(data){
			        	jQuery("#nombres").val(data.nombres + ' ' + data.apellidos);
			        	jQuery("#usuario").val(data.identificacion);
			        	jQuery("#unidad").val(data.unidad_id);
			        	jQuery("#boton").removeClass('disabled');
			        	jQuery("#persona_id").val(data.id);
			        	$('#frmUsuario').formValidation('revalidateField', 'unidad_id');
			        	$('#frmUsuario').formValidation('revalidateField', 'usuario');
			        	
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
			
			usuario: {
				message: 'El Usuario no es válido',
				validators: {
					notEmpty: {
						message: 'El Usuario no puede ser vacío.'
					},					
					regexp: {
						regexp: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9_ ,-\.]+$/,
						message: 'Ingrese un Usuario válido.'
					}
				}
			},			
			tipo_usuario_id: {
				validators: {
					notEmpty: {
						message: 'Seleccione un Tipo de Usuario'
					}
				}
			},
			unidad_id: {
				validators: {
					notEmpty: {
						message: 'Seleccione una Unidad'
					}
				}
			},
			
			password: {
				message: 'La Contraseña no es válida',
				validators: {
					notEmpty: {
						message: 'La Contraseña no puede ser vacía.'
					},					
					regexp: {
						regexp: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9-_ \.]+$/,
						message: 'Ingrese una Contraseña válida.'
					}
				}
			},
			password1: {
				validators: {
					notEmpty: {
						message: 'La contraseña no puede ser vacia.'
					},
					identical: {
						field: 'password',
						message: 'La contraseña debe ser la misma'
					}
				}
			},
			
		}
	});
});
</script>
<style>
.boton {
	margin-left: 15px;
}
</style>