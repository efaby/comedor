<form id="frmItem" method="post" action="../guardarExtraconfronta/">

	<div class="form-group  col-sm-12">
		<label class="control-label">Persona</label> <input type='text'
			name='nombres' class='form-control' readonly="readonly"
			value="<?php echo $item->nombres ." ".$item->apellidos; ?>" id="nombres">
	</div>
	
	<div class="form-group col-sm-12">
		<label class="control-label">Servicio *</label>	<br>
		<label class="radio-inline"><input type="radio" name="tipo_servicio" value="1" >Desayuno</label>
		<label class="radio-inline"><input type="radio" name="tipo_servicio" value="2" >Almuerzo</label>
		<label class="radio-inline"><input type="radio" name="tipo_servicio" value="3" >Merienda</label>
		
	</div>
	
	<div class="form-group">
	<input type='hidden' name='id' class='form-control' value="<?php echo $item->id; ?>">
	<input type='hidden' name='persona_id' id='persona_id' class='form-control' value="<?php echo $item->id; ?>">
	
	<button type="submit" class="btn btn-success boton" id="boton">Guardar</button>
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
					tipo_servicio: {
		                validators: {
		                    notEmpty: {
		                        message: 'Seleccion un Servicio.'
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