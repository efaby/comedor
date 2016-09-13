<form id="frmUsuario" method="post" action="../../Cliente/guardar/">

	<div class="form-group col-sm-12">
		<label class="control-label">Número de Identificación</label> <input type='text'
			name='identificacion' class='form-control'
			value="<?php echo $cliente['identificacion']; ?>">

	</div>
	<div class="form-group col-sm-6">
		<label class="control-label">Nombres</label> <input type='text'
			name='nombres' class='form-control'
			value="<?php echo $cliente['nombres']; ?>">

	</div>
	<div class="form-group col-sm-6">
		<label class="control-label">Apellidos</label> <input type='text'
			name='apellidos' class='form-control'
			value="<?php echo $cliente['apellidos']; ?>">

	</div>
	<div class="form-group col-sm-12">
		<label class="control-label">Dirección</label> <input type='text'
			name='direccion' class='form-control'
			value="<?php echo $cliente['direccion']; ?>">

	</div>
	<div class="form-group col-sm-6">
		<label class="control-label">Teléfono</label>
		<input type='text'
			name='telefono' class='form-control'
			value="<?php echo $cliente['telefono']; ?>">

	</div>
	
	<div class="form-group  col-sm-6">
		<label class="control-label">Celular</label>
		<input type='text'
			name='celular' class='form-control'
			value="<?php echo $cliente['celular']; ?>">

	</div>
	<div class="form-group col-sm-12">
		<label class="control-label">Email</label>
		<input type='text'
			name='email' class='form-control'
			value="<?php echo $cliente['email']; ?>">

	</div>

	
	<div class="form-group">
	<input type='hidden' name='id' class='form-control' value="<?php echo $cliente['id']; ?>">
	<input type='hidden' name='redireccion' value="<?php echo $cliente_id; ?>">
		<button type="submit" class="btn btn-success">Guardar</button>
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
			}	
		}
	});

});
</script>
<style>
.col-sm-6, .col-sm-12 {
	padding-right: 0px;
}
</style>