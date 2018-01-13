<form id="frmItem" method="post" action="../guardar/">

<div class="form-group  col-sm-12">
		<label class="control-label">Identificación *</label> <input type='text'
			name='identificacion' class='form-control'
			value="<?php echo $item->identificacion; ?>" id="identificacion">
	</div>
	<div class="form-group  col-sm-12">
		<label class="control-label">Persona</label> <input type='text'
			name='nombres' class='form-control' readonly="readonly"
			value="<?php echo $item->nombres ." ".$item->apellidos; ?>" id="nombres">
	</div>
	
	<div class="form-group col-sm-12">
		<label class="control-label">Servicio *</label>	<br>
		<label class="radio-inline"><input type="radio" name="tipo_servicio" value="1" <?php echo ($item->tipo_servicio == 1 )?'checked':'';?>>Desayuno</label>
		<label class="radio-inline"><input type="radio" name="tipo_servicio" value="2" <?php echo ($item->tipo_servicio == 2 )?'checked':'';?>>Almuerzo</label>
		<label class="radio-inline"><input type="radio" name="tipo_servicio" value="3" <?php echo ($item->tipo_servicio == 3 )?'checked':'';?>>Merienda</label>
		
	</div>
	
	<div class="form-group">
	<input type='hidden' name='id' class='form-control' value="<?php echo $item->id; ?>">
	<input type='hidden' name='persona_id' id='persona_id' class='form-control' value="<?php echo $item->persona_id; ?>">
	
	<button type="submit" class="btn btn-success boton" id="boton">Guardar</button>
	</div>

</form>

<script type="text/javascript">

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
	        	jQuery("#persona_id").val(0);
		        if(data){			       
			        jQuery("#nombres").val(data.nombres + ' ' + data.apellidos);
			        jQuery("#boton").removeClass('disabled');
			        jQuery("#persona_id").val(data.id);		        	        	
		        	
		        } else {
					alert("La persona no exite por favor regístrelo en la sección Personal");
					jQuery("#boton").addClass('disabled');
		        }
	        	
	        }
	    });
    }
});




$(document).ready(function() {
    $('#frmItem').formValidation({
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