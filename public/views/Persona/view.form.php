<form id="frmUsuario" method="post" action="../guardar/">
<div style="overflow: auto;">
	
	<div class="form-group  col-sm-6">
		<label class="control-label">Grado Persona *</label>
		<select class='form-control' name="grado_persona_id" >
			<option value="" >Seleccione</option>
		<?php foreach ($grados as $dato) { ?>
			<option value="<?php echo $dato->id;?>"  <?php if($item->grado_persona_id==$dato->id):echo "selected"; endif;?>><?php echo $dato->nombre;?></option>
		<?php }?>
		</select>

	</div>

	<div class="form-group  col-sm-6">
		<label class="control-label">Arma *</label>
		<select class='form-control' name="arma_id" >
			<option value="" >Seleccione</option>
		<?php foreach ($armas as $dato) { ?>
			<option value="<?php echo $dato->id;?>"  <?php if($item->arma_id==$dato->id):echo "selected"; endif;?>><?php echo $dato->nombre;?></option>
		<?php }?>
		</select>

	</div>

	</div>
	<div style="overflow: auto;">
	<div class="form-group  col-sm-6"> <!-- desactivar si es de un amanuence poner por defecto la unidad selecionada -->
		<label class="control-label">Unidad *</label>
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
		<label class="control-label">Identificación *</label> <input type='text'
			name='identificacion' class='form-control'
			value="<?php echo $item->identificacion; ?>">

	</div>
	</div>
	<div style="overflow: auto;">
	<div class="form-group col-sm-6">
		<label class="control-label">Nombres *</label> <input type='text'
			name='nombres' class='form-control'
			value="<?php echo $item->nombres; ?>">

	</div>
	<div class="form-group col-sm-6">
		<label class="control-label">Apellidos *</label> <input type='text'
			name='apellidos' class='form-control'
			value="<?php echo $item->apellidos; ?>">

	</div>
	</div>
	
	<div style="overflow: auto;">
	<div class="form-group col-sm-6">
		<label class="control-label">Teléfono</label>
		<input type='text'
			name='telefono' id='telefono' class='form-control'
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

<script src="<?php echo PATH_JS; ?>/jquery.maskedinput.min.js"></script>

<script type="text/javascript">

$(document).ready(function() {

	$("#telefono").mask("99-9999999");

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
		               callback: {
                                  message: 'El Número de Identificación no es válido.',
                                  callback: function (value, validator, $field) {
                                    var cedula = value;
                                    try {
                                        array = cedula.split("");
                                    }
                                    catch (e) {
                                        //array = null;
                                    }
                                    num = array.length;
                                    if (num === 10) {
                                        total = 0;
                                        digito = (array[9] * 1);
                                        for (i = 0; i < (num - 1); i++) {
                                            mult = 0;
                                            if ((i % 2) !== 0) {
                                                total = total + (array[i] * 1);
                                            } else {
                                                mult = array[i] * 2;
                                                if (mult > 9)
                                                    total = total + (mult - 9);
                                                else
                                                    total = total + mult;
                                            }
                                        }
                                        decena = total / 10;
                                        decena = Math.floor(decena);
                                        decena = (decena + 1) * 10;
                                        final = (decena - total);
                                        if ((final === 10 && digito === 0) || (final === digito)) {
                                
                                            return true;
                                        } else {
                                
                                            return false;
                                        }
                                    } else {
                                
                                        return false;
                                    }
                                }
                            }
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
								regexp: /^(?:\+)?\d{2}?[-]?\d{7}$/,
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