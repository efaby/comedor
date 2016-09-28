<?php
require_once(PATH_MODELS."/SeguridadModel.php");

/**
 * Controlador de Usuarios
 *
 */
class SeguridadController {
	
	public function login(){
		require_once PATH_VIEWS."/Seguridad/view.login.php";
	}
	
	public function validar(){

		$model = new SeguridadModel();
		$login = $this->cleanVariables($_POST['usuario']);
		$password = $this->cleanVariables($_POST['contrasena']);
		
		$result= $model->validarUsuario($login, $password);
		$response['band'] = 0;
		if($result)
		{
			session_regenerate_id();			
			$_SESSION['SESSION_USER'] = $result;
			session_write_close();
			$url = $_SERVER["REQUEST_URI"];			
			$response['data'] = (strpos($url, '/Seguridad/mostrar/'))?'../':'Seguridad/'.'inicio/';
				
		} else {
			$response['data'] = 'Credenciales Inválidas.';
			$response['band'] = 1;
		}
		echo json_encode($response);
		exit();
	}
	
	private function cleanVariables($str){
		$str = @trim($str);
		if(get_magic_quotes_gpc())
		{
			$str = stripslashes($str);
		}
		return addslashes($str);
	}
	
	public function inicio(){
		require_once PATH_VIEWS."/Seguridad/view.home.php";
	}
	
	public function cerrarSesion(){
		session_start();
		unset($_SESSION["SESSION_USER"]);
		session_destroy();
		header("Location: ../../");
	}
	
	public function cambiarContrasena(){
		require_once PATH_VIEWS."/Seguridad/view.form.php";
	}
	
	public function guardarContrasena(){
		
		$passwd["p2"] = $_POST['password'];
		$passwd["p3"] = $_POST['password1'];
		$user = $_SESSION['SESSION_USER']->id;		
		
		try {
			$model = new SeguridadModel();
			$model->cambiarContrasena($passwd["p2"],$user);
			$_SESSION['message'] = "Su contraseña ha sido cambiada exitosamente.";
		} catch (Exception $e){
			$_SESSION['message'] = $e->getMessage();
		}		
	
		header("Location: ../cambiarContrasena/");
	}
	
	public function error404(){
		require_once PATH_VIEWS."/Seguridad/view.error404.php";
	}
	
	public function error403(){
		require_once PATH_VIEWS."/Seguridad/view.error403.php";
	}
	
	public function error500(){
		require_once PATH_VIEWS."/Seguridad/view.error500.php";
	}

}