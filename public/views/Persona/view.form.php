<form id="frmUsuario" method="post" action="../guardar/">
<div style="overflow: auto;">
	
	<div class="form-group  col-sm-6">
		<label class="control-label">Grado Persona</label>
		<select class='form-control' name="grado_persona_id" >
			<option value="" >Seleccione</option>
		<?php foreach ($grados as $dato) { ?>
			<option value="<?php echo $dato->id;?>"  <?php if($item->grado_persona_id==$dato->id):echo "selected"; endif;?>><?php echo $dato->nombre;?></option>
		<?php }?>
		</select>

	</div>
	<div class="form-group col-sm-6">
		<label class="control-label">Arma</label> <input type='text'
			name='arma' class='form-control'
			value="<?php echo $item->arma; ?>">

	</div>
	</div>
	<div style="overflow: auto;">
	<div class="form-group  col-sm-6"> <!-- desactivar si es de un amanuence poner por defecto la unidad selecionada -->
		<label class="control-label">Unidad</label>
		<?php $disabled = ''; 
			if($unidad_id>0): 
				$disabled = 'disabled="disabled"'; 
				$item->unidad_id = $unidad_id; 
				echo '<input type="hidden" name="unidad_id" id="unidad_id" value="'.$unidad_id.'">';
			endif;?> 
			
		<select class='form-control' name="unidad_id" <?php echo $disabled;?> >
			<option value="" >Seleccione</option>
		<?php foreach ($unidades as $dato) { ?>
			<option value="<?php echo $dato->id;?>"  <?php if($item->unidad_id==$dato->id):echo "selected"; endif;?>><?php echo $dato->nombre;?></option>
		<?php }?>
		</select>

	</div>
	<div class="form-group col-sm-6">
		<label class="control-label">Identificación</label> <input type='text'
			name='identificacion' class='form-control'
			value="<?php echo $item->identificacion; ?>">

	</div>
	</div>
	<div style="overflow: auto;">
	<div class="form-group col-sm-6">
		<label class="control-label">Nombres</label> <input type='text'
			name='nombres' class='form-control'
			value="<?php echo $item->nombres; ?>">

	</div>
	<div class="form-group col-sm-6">
		<label class="control-label">Apellidos</label> <input type='text'
			name='apellidos' class='form-control'
			value="<?php echo $item->apellidos; ?>">

	</div>
	</div>
	
	<div style="overflow: auto;">
	<div class="form-group col-sm-6">
		<label class="control-label">Teléfono</label>
		<input type='text'
			name='telefono' class='form-control'
			value="<?php echo $item->telefono; ?>">

	</div>
	
	<div class="form-group  col-sm-6">
		<label class="control-label">Celular</label>
		<input type='text'
			name='celular' class='form-control'
			value="<?php echo $item->celular; ?>">

	</div>
	</div>
	<div class="form-group">
	<input type='hidden' name='id' class='form-control' value="<?php echo $item->id; ?>">
		<button type="submit" class="btn btn-success boton">Guardar</button>
	</div>

</form>

<script type="text/javascript">

$(document).ready(function() {
    $('#frmUsuario').formValidation({
    	message: 'This value is not valid',
		feedbackIcons: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
		fields: {		
			id: {

			},	
			identificacion: {
				message: 'El Número de Identificación no es válido',
				validators: {
							notEmpty: {
								message: 'El Número de Identificación no puede ser vacío.'
							},					
							regexp: {
								regexp: /^(?:\+)?\d{10,13}$/,
								message: 'Ingrese un Número de Identificación válido.'
							},
							remote: {
		                        message: 'El Número de Identificación ya esta registrado.',
		                        url: '../verificarPersona/',
		                        data: function(validator, $field, value) {
		                            return {
		                                id: validator.getFieldElements('id').val()
		                            };
		                        },
		                        type: 'GET'
		               },
						}
					},
			nombres: {
				message: 'Los Nombres no es válido',
				validators: {
					notEmpty: {
						message: 'El Nombre no puede ser vacío.'
					},					
					regexp: {
						regexp: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ \.]+$/,
						message: 'Ingrese un Nombre válido.'
					}
				}
			},
			apellidos: {
				message: 'El Apellido no es válido',
				validators: {
					notEmpty: {
						message: 'El Apellido no puede ser vacío.'
					},					
					regexp: {
						regexp: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ \.]+$/,
						message: 'Ingrese un Apellido válido.'
					}
				}
			},
			telefono: {
				message: 'El Número de Teléfono no es válido',
				validators: {												
							regexp: {
								regexp: /^(?:\+)?\d{9}$/,
								message: 'Ingrese un Número de Teléfono válido.'
							}
						}
				
			},
			
			grado_persona_id: {
				validators: {
					notEmpty: {
						message: 'Seleccione un Grado de Persona'
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
			celular: {
				message: 'El Celular de Teléfono no es válido',
				validators: {					
							regexp: {
								regexp: /^(?:\+)?\d{10}$/,
								message: 'Ingrese un Número de Celular válido.'
							}
						}
				
			},	
			arma: {
				message: 'El Nombre del Arma no es válido',
				validators: {					
					regexp: {
						regexp: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9_ ,-\.]+$/,
						message: 'Ingrese un Nombre de Arma válido.'
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
.
</style>