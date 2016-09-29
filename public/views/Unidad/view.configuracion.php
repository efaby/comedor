<?php $title = "Configurar Unidad";?>
<?php include_once PATH_TEMPLATE.'/header.php';?>
<!-- Main row -->
<div class="row">
	<div class="col-lg-12">
    	<h1 class="page-header">Configurar Unidad</h1>
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
			
	<form method="post" action="../guardarConfiguracion/" id="frmItem" name="frmItem">
		
		<div style="width: 25%; overflow: auto; margin-bottom: 20px;">
		
		<div class="form-group  col-sm-12">
		<label class="control-label">Número de Conscriptos</label>
		<input type='text'
			name='num_conscriptos' class='form-control'
			value="<?php echo $item->num_conscriptos; ?>">

	</div>
	<div class="form-group  col-sm-12">
		<label class="control-label">Almuerzo Hora Inicio</label>
		<div>
			<select class='form-control' name="hora_inicio" style="width: 60px; float: left;">
			<?php for ($i=0;$i<24;$i++) { ?>
				<option value="<?php echo $i;?>"  <?php if($i==date('H',strtotime($item->hora_inicio))):echo "selected"; endif;?>><?php echo str_pad($i,2,0, STR_PAD_LEFT);?></option>
			<?php }?>
			</select> 
			<div style="float: left;font-size: 20px;font-weight: bold;padding-left: 5px;width: 15px;">
			:
			</div>
			<select class='form-control' name="minuto_inicio" style="width: 60px; float: left;">
				<option value="" >Seleccione</option>
			<?php for ($i=0;$i<60;$i=$i + 10) { ?>
				<option value="<?php echo $i;?>"  <?php if($i==date('i',strtotime($item->hora_inicio))):echo "selected"; endif;?>><?php echo str_pad($i,2,0, STR_PAD_LEFT);?></option>
			<?php }?>
			</select>
		</div>
	</div>
	<div class="form-group  col-sm-12">
		<label class="control-label">Almuerzo Hora Fin</label>
		<div>
			<select class='form-control' name="hora_fin" style="width: 60px; float: left;">
			<?php for ($i=0;$i<24;$i++) { ?>
				<option value="<?php echo $i;?>"  <?php if($i==date('H',strtotime($item->hora_fin))):echo "selected"; endif;?>><?php echo str_pad($i,2,0, STR_PAD_LEFT);?></option>
			<?php }?>
			</select> 
			<div style="float: left;font-size: 20px;font-weight: bold;padding-left: 5px;width: 15px;">
			:
			</div>
			<select class='form-control' name="minuto_fin" style="width: 60px; float: left;">
				<option value="" >Seleccione</option>
			<?php for ($i=0;$i<60;$i=$i + 10) { ?>
				<option value="<?php echo $i;?>"  <?php if($i==date('i',strtotime($item->hora_fin))):echo "selected"; endif;?>><?php echo str_pad($i,2,0, STR_PAD_LEFT);?></option>
			<?php }?>
			</select>
		</div>
	</div>
		
		<div class="form-group rowBottom" >
		<input type='hidden' name='id' class='form-control' value="<?php echo $item->id; ?>">
		<button type="submit" class="btn btn-success">Guardar</button>
	</div>
		</div>
	</form>
	</div>
	
	
<?php include_once PATH_TEMPLATE.'/footer.php';?>

<script src="<?php echo PATH_JS; ?>/formValidation.js"></script>
<script src="<?php echo PATH_JS; ?>/bootstrap.js"></script>
<link href="<?php echo PATH_CSS; ?>/bootstrapValidator.min.css" rel="stylesheet">

<script type="text/javascript">

$(document).ready(function() {
    $('#frmItem').formValidation({
    	message: 'This value is not valid',
		feedbackIcons: {
			validating: 'glyphicon glyphicon-refresh'
		},
		fields: {			
			num_conscriptos: {
				message: 'El número de Conscriptos no es válido',
				validators: {
					notEmpty: {
						message: 'El número de Conscriptos no puede ser vacío.'
					},					
					regexp: {
						regexp: /^\d*$/,
						message: 'Ingrese un número de Conscriptos válido.'
					}
				}
			},
			minuto_inicio : {
				message: 'El Minuto Inicio no es válida',
				validators: {
					callback: {
                        message: 'La Hora Inicio no pude ser mayor a la Hora Fin',
                        callback: function(value, validator, $field) {
                           var hora_inicio = parseInt(validator.getFieldElements('hora_inicio').val()*60) + parseInt(validator.getFieldElements('minuto_inicio').val());
                           var hora_fin = parseInt(validator.getFieldElements('hora_fin').val()*60) + parseInt(validator.getFieldElements('minuto_fin').val());                                   
                           return (hora_inicio <= hora_fin);
                        }
                    }			
					
				}
			},

			minuto_fin : {
				message: 'El Minuto Fin no es válida',
				validators: {
					callback: {
                        message: 'La Hora Fin no pude ser menor a la Hora Inicio',
                        callback: function(value, validator, $field) {
                           var hora_inicio = parseInt(validator.getFieldElements('hora_inicio').val()*60) + parseInt(validator.getFieldElements('minuto_inicio').val());
                           var hora_fin = parseInt(validator.getFieldElements('hora_fin').val()*60) + parseInt(validator.getFieldElements('minuto_fin').val());                                   
                           return (hora_inicio <= hora_fin);
                        }
                    }
				}
			},
			
		}
    });
	}).on('change', '[name="minuto_fin"]', function(e) {
	    $('#frmItem').formValidation('revalidateField', 'minuto_inicio');
	}).on('change', '[name="minuto_inicio"]', function(e) {
	    $('#frmItem').formValidation('revalidateField', 'minuto_fin');
	}).on('change', '[name="hora_inicio"]', function(e) {
	    $('#frmItem').formValidation('revalidateField', 'minuto_inicio');
	    $('#frmItem').formValidation('revalidateField', 'minuto_fin');
	}).on('change', '[name="hora_fin"]', function(e) {
		$('#frmItem').formValidation('revalidateField', 'minuto_inicio');
	    $('#frmItem').formValidation('revalidateField', 'minuto_fin');

});
</script>
<style>
.col-sm-6, .col-sm-4 {
	padding-left: 0px;
}
.rows{
	padding-right: 0px;
	}
	.rowBottom{
		padding-left: 15px;
	}
</style>
</body>
</html>