<form id="frmItem" method="post" action="../guardar/">

<div class="form-group  col-sm-12">
		<label class="control-label">Tipo Persona</label>
		<select class='form-control' name="tipo_persona_id">
			<option value="" >Seleccione</option>
		<?php foreach ($tipos as $dato) { ?>
			<option value="<?php echo $dato->id;?>"  <?php if($item->tipo_persona_id==$dato->id):echo "selected"; endif;?>><?php echo $dato->nombre;?></option>
		<?php }?>
		</select>

	</div>
	<div class="form-group  col-sm-12">
		<label class="control-label">Nombre</label>
		<input type='text'
			name='nombre' class='form-control'
			value="<?php echo $item->nombre; ?>">

	</div>
	<div class="form-group  col-sm-12">
		<label class="control-label">Abreviatura</label>
		<input type='text'
			name='abreviatura' class='form-control'
			value="<?php echo $item->abreviatura; ?>">

	</div>
	<div class="form-group col-sm-12">
		<label class="control-label">Descripción</label>	
		<textarea name='descripcion' style="width: 100%"><?php echo $item->descripcion; ?></textarea>

	</div>
	
	<div class="form-group">
	<input type='hidden' name='id' class='form-control' value="<?php echo $item->id; ?>">
		<button type="submit" class="btn btn-success">Guardar</button>
	</div>

</form>

<script type="text/javascript">
$(document).ready(function() {
    $('#frmItem').formValidation({
    	message: 'This value is not valid',
		feedbackIcons: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
		fields: {			
			nombre: {
				message: 'El nombre no es válido',
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
			abreviatura: {
				message: 'La Abreviatura no es válida',
				validators: {
					notEmpty: {
						message: 'La Abreviatura no puede ser vacía.'
					},					
					regexp: {
						regexp: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9_ ,-\.]+$/,
						message: 'Ingrese una Abreviatura válida.'
					}
				}
			},
			descripcion : {
				message: 'La Descripción no es válida',
				validators: {
					notEmpty: {
						message: 'La Descripción no puede ser vacía.'
					},					
					regexp: {
						regexp: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9_ ,-\.]+$/,
						message: 'Ingrese una Descripción válida.'
					}
				}
			},
			tipo_persona_id: {
				validators: {
					notEmpty: {
						message: 'Seleccione un Tipo de Persona'
					}
				}
			},
			
		}
	});
});
</script>
<style>
.col-sm-6, .col-sm-12 {
	padding-right: 0px;
	padding-left: 0px;
}
</style>