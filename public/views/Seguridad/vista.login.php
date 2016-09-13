<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Iniciar Sesión</title>
    <link href="<?php echo PATH_CSS; ?>/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo PATH_CSS; ?>/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo PATH_CSS; ?>/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Iniciar Sesión</h3>
                    </div>
                    <div class="panel-body">
                    <?php $url = $_SERVER["REQUEST_URI"];?>
                        <form action="<?php echo (strpos($url, '/Seguridad/mostrar/'))?'../validar/':'Seguridad/validar/';?>" id="frmLogin" method="post">
                            <fieldset>
                            <div class="alert alert-danger fade in alert-dismissable" style="display: none; padding: 6px;" id="mensajeContenedor">
								  <span id="mensajeLogin"></span>
								</div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Usuario" name="usuario" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Contraseña" name="contrasena" type="password" value="">
                                </div>
                                <input name="url" type="hidden" value="<?php echo (strpos($url, '/Seguridad/mostrar/'))?'../':'Seguridad/'; ?>">
                                <!-- Change this to a button or input when using this as a form -->
                                <button class="btn btn-success btn-block" type="submit" id="btnSubmit">
                                <i class="fa fa-sign-in "></i>&nbsp;Ingresar</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?php echo PATH_JS; ?>/jquery.min.js" type="text/javascript"></script>
   <script src="<?php echo PATH_JS; ?>/bootstrapValidator.min.js"></script>
<link href="<?php echo PATH_CSS; ?>/bootstrapValidator.min.css" rel="stylesheet"> 
    <script type="text/javascript">
						$(document).ready(function(){
							$('#frmLogin').bootstrapValidator({
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
								 submitHandler: function(validator, form, submitButton) {
									 $.post(form.attr('action'), form.serialize(), function(result) {
										 var obj = JSON.parse(JSON.stringify(result));
										 if( obj.band === 1 ){											
											 $("#mensajeLogin").html(obj.data);
									     	 $("#mensajeContenedor").css('display','block');	
										 } else {
											 window.location = obj.data;
										      return false;
										 }
									 }, 'json');					   
								 }
							});


						
						});		
						</script>	
    

    
</body>

</html>