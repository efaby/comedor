<?php $title = "Resetar Contraseña";?>
<?php include_once PATH_TEMPLATE.'/header.public.php';?>
<div class="section">
<div class="content">
<div class="container">

<div class="title-home">


	<?php $band = 0; if (isset($_SESSION['message'])&& ($_SESSION['message'] != '')):?>
<div class="alert alert-warning fade in alert-dismissable">
	<?php echo $_SESSION['message'];$_SESSION['message'] = ''; $band = 1;?>
</div>
<?php endif;?>
<?php if($band == 1):?>
<br />
<a href="../../index.php" class="btn btn-info" >Iniciar Sesión</a>	
<?php else:?> 
	      			
	<form method="post" action="index.php?action=resetPass" id="passwordForm" name="passwordForm" class="bootstrap-validator-form">
		
		<div class="form-group col-sm-6 rows">
			<div class="form-group col-sm-6">
			<label class="control-label">Nueva Contraseña:</label> 
			</div>
			<div class="form-group col-sm-6">
				<input id="passwordNew" name="passwordNew" type="password" class='form-control'/>
			</div>
			<div class="form-group col-sm-6">
			<label class="control-label">Repetir Nueva Contraseña:</label> 
			</div>
			<div class="form-group col-sm-6">
				<input id="repeatPasswordNew" name="repeatPasswordNew" type="password" class='form-control'/>
			</div>
			<div class="form-group col-sm-6">				
			</div>
			<div class="form-group col-sm-6">
				<input type="hidden" name="identity_card" value="<?php echo $user_id;?>">	      		
	      		<button type="submit" class="btn btn-info">Resetear Contraseña</button> 
			</div>			
		</div>	
		
	</form>
	<?php endif;?> 
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
    $('#passwordForm').bootstrapValidator({
    	message: 'This value is not valid',
		feedbackIcons: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
		fields: {			
			
			passwordNew: {
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
			repeatPasswordNew: {
				validators: {
					notEmpty: {
						message: 'La contraseña no puede ser vacia.'
					},
					identical: {
						field: 'passwordNew',
						message: 'La contraseña debe ser la misma'
					}
				}
			},
			
		}
	});

});
</script>
</body>
</html>