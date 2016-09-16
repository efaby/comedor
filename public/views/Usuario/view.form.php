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
	<div class="form-group  col-sm-6">
		<label class="control-label">Unidad</label>
		<select class='form-control' name="unidad_id">
			<option value="" >Seleccione</option>
		<?php foreach ($unidades as $dato) { ?>
			<option value="<?php echo $dato->id;?>"  <?php if($item->unidad_id==$dato->id):echo "selected"; endif;?>><?php echo $dato->nombre;?></option>
		<?php }?>
		</select>

	</div>
	</div>
	
	<div class="form-group col-sm-6">
		<label class="control-label">Identificación</label> <input type='text'
			name='identificacion' class='form-control'
			value="<?php echo $item->identificacion; ?>">

	</div>
	<div class="form-group col-sm-6">
		<label class="control-label">Persona</label> <input type='text'
			name='apellidos' class='form-control'
			value="<?php echo $item->nombres; ?>">

	</div>
	<div class="form-group col-sm-12">
		<label class="control-label">Nombre de Usuario</label> <input type='text'
			name='usuario' class='form-control'
			value="<?php echo $item->usuario; ?>">

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
	<input type='hidden' name='id' class='form-control' value="<?php echo $usuario->id; ?>">
		<button type="submit" class="btn btn-success boton">Guardar</button>
	</div>

</form>

<script type="text/javascript">

$(document).ready(function() {
    $('#frmUsuario').bootstrapValidator({
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
							notEmpty: {
								message: 'El Número de Teléfono no puede ser vacío.'
							},					
							regexp: {
								regexp: /^(?:\+)?\d{9}$/,
								message: 'Ingrese un Número de Teléfono válido.'
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
			celular: {
				message: 'El Celular de Teléfono no es válido',
				validators: {
							notEmpty: {
								message: 'El Número de Celular no puede ser vacío.'
							},					
							regexp: {
								regexp: /^(?:\+)?\d{10}$/,
								message: 'Ingrese un Número de Celular válido.'
							}
						}
				
			},	
			direccion: {
				message: 'La Dirección no es válida',
				validators: {
					notEmpty: {
						message: 'La Dirección no puede ser vacío.'
					},					
					regexp: {
						regexp: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9_ ,-\.]+$/,
						message: 'Ingrese una Dirección válido.'
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
						regexp: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9_ -\.]+$/,
						message: 'Ingrese un Usuario válido.'
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
			email: {
				message: 'El eEmail no es válido',
				validators: {
					notEmpty: {
						message: 'El Email no puede ser vacío'
					},
					emailAddress: {
						message: 'Ingrese un Email válido.'
					}
				}
			},	
			genero: {
				validators: {
					notEmpty: {
						message: 'Seleccione un Género'
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