<?php $title = "Recuperar Contrase&ntilde;a";?>
<?php include_once PATH_TEMPLATE.'/header.public.php';?>
<div class="section">
<div class="content">
<div class="container">

<div class="title-home">

	<?php if (isset($_SESSION['message'])&& ($_SESSION['message'] != '')):?>
<div class="alert alert-warning fade in alert-dismissable">
	<?php echo $_SESSION['message'];$_SESSION['message'] = ''?>
	<br />
</div>
<?php endif;?>

	<form method="post" action="index.php?action=recoverPass" id="recover" name="recover"  class="bootstrap-validator-form">
		<div class="form-group col-sm-6 rows">
	<div class="form-group col-sm-4">
	<label class="control-label">Usuario:</label> 
	</div>
	<div class="form-group col-sm-4">
		<input id="identity_card" name="identity_card" type="text" class='form-control'/>
	</div>
	<div class="form-group col-sm-4">	
	<button type="submit" class="btn btn-info">Enviar</button>    		      	
	</div>
	</form>
</div>


</div>
</div>
</div>
<?php include_once PATH_TEMPLATE.'/footer.php';?>

<script
	src="<?php echo PATH_CSS . '/../plugins/validator/bootstrapValidator.min.js';?>"></script>
<script src="<?php echo PATH_CSS . '/../js/apps.js';?>"></script>

<script type="text/javascript">

$(document).ready(function() {
    $('#recover').bootstrapValidator({
    	message: 'This value is not valid',
		feedbackIcons: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
		fields: {			
			identity_card: {
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
			
		}
	});

});
</script>

</body>
</html>