<?php 	
	define('HOSTNAME_DATABASE', 'localhost');
	define('USERNAME', 'root');
	define('PASSWORD', 'sistemas');
	define('DATABASE', 'comedor'); 	 
	define('PATH_MODELS', PATH_ROOT."/app/models");
	define('PATH_CONTROLLERS', PATH_ROOT."/app/controllers");
	define('PATH_VIEWS', PATH_ROOT."/public/views");
	define('PATH_BASE', "/comedor");	
	define('PATH_CSS', PATH_BASE."/public/web/css");
	define('PATH_JS', PATH_BASE."/public/web/js");
	define('PATH_IMAGES', PATH_BASE."/public/web/images");
	define('PATH_TEMPLATE', PATH_ROOT."/public/template");
	define('PATH_HELPERS', PATH_ROOT."/lib");
	define('PATH_FILES', PATH_ROOT."/public/web/files/");
	
	define('PATH_IMAGES_USER',  "../../assets/images/users/");
	define('PATH_FILES_USER',  "../../files/");

	
	

	define('PATH_FILES_IMAGE', PATH_ROOT."/web/assets/images/users/");

	define('EMAIL', "no-reply@merito.online");
	define('PUBLIC_URLS', serialize(array('/index.php','index.php?action=validationUser','Registro/index.php','Registro/index.php?action=saveData','Registro/index.php?action=activarCuenta','Secure/index.php?action=closeSession','Secure/index.php?action=recoverPassword','Secure/index.php?action=recoverPass','Secure/index.php?action=resetPassword','Secure/index.php?action=resetPass', 'Register/index.php?action=loadCity', 'Register/index.php?action=saveData','.php')));
	
?>