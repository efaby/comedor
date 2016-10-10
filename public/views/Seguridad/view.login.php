<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
 <link rel="shortcut icon" type="image/x-icon" href="<?php echo PATH_IMAGES.'/favicon.ico'?>" />
    <title>Sistema Confrontas</title>
    <link href="<?php echo PATH_CSS; ?>/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo PATH_CSS; ?>/login.css" rel="stylesheet">
	<link href="<?php echo PATH_CSS; ?>/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>

<body>

<div class="container">
        <div class="card card-container">  
        <p id="profile-name" class="profile-name-card">Sistema de Gestión de Confrontas</p>          
            <img id="profile-img" class="profile-img-card" src="<?php echo PATH_IMAGES.'/ejercito.jpg'?>" />            
             <div class="alert alert-danger fade in alert-dismissable" style="display: none; padding: 6px;" id="mensaje">
				<span id="mensajeValidacion"></span>
			</div>             
             <?php $url = $_SERVER["REQUEST_URI"];?>
             <form action="<?php echo (strpos($url, '/Seguridad/listar/'))?'../validar/':'Seguridad/validar/';?>" id="frmLogin" method="post" class="form-signin">
            <div class="form-group"> 
                <input type="text" id="usuario" name="usuario" class="form-control" placeholder="Usuario" >
             </div>
             <div class="form-group"> 
                <input type="password" id="contrasena" name="contrasena" class="form-control" placeholder="Contraseña" >                
             </div>
                <br>
                
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit" id="btnSubmit">
                                <i class="fa fa-sign-in "></i>&nbsp;Ingresar</button>
            </form><!-- /form -->
          
        </div><!-- /card-container -->
    </div><!-- /container -->
    
    <script src="<?php echo PATH_JS; ?>/jquery.min.js" type="text/javascript"></script>
    
	<script src="<?php echo PATH_JS; ?>/formValidation.js"></script>
	<script src="<?php echo PATH_JS; ?>/bootstrap.js"></script>
	<script src="<?php echo PATH_JS; ?>/currentList.js"></script>
	<link href="<?php echo PATH_CSS; ?>/bootstrapValidator.min.css" rel="stylesheet"> 
    <script type="text/javascript">
						$(document).ready(function(){
							$('#frmLogin').formValidation({
						    	message: 'This value is not valid',
								feedbackIcons: {
									validating: 'glyphicon glyphicon-refresh'
								},
								fields: {			
									usuario: {
										message: 'El Usuario no es válido',
										validators: {
													notEmpty: {
														message: 'El Usuario no puede ser vacío.'
													},					
													regexp: {
														regexp: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9-_ \.]+$/,
														message: 'Ingrese un Usuario válido.'
													}
												}
											},	
									contrasena: {
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
													
									
								},								
							}) .on('success.form.fv', function(e) {
					            // Prevent form submission
					            e.preventDefault();

					            var $form = $(e.target),
					                fv    = $form.data('formValidation');

					            // Use Ajax to submit form data
					            $.ajax({
					                url: $form.attr('action'),
					                type: 'POST',
					                data: $form.serialize(),
					                dataType: 'json',
					                success: function(result) {
						                console.log(result)
					                	var obj = JSON.parse(JSON.stringify(result));
										 if( obj.band === 1 ){											
											 $("#mensajeValidacion").html(obj.data);
									     	 $("#mensaje").css('display','block');	
										 } else {
											 window.location = obj.data;
										      return false;
										 }
					                }
					            });
					        });


						
						});		
						</script>	
    

    
</body>

</html>