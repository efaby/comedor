<?php
require_once(PATH_MODELS."/SeguridadModelo.php");

/**
 * Controlador de Usuarios
 *
 */
class SeguridadControlador {

	public function mostrar()
	{	
		require_once PATH_VIEWS."/Seguridad/vista.login.php";
	}
	
	public function inicio(){
		$model = new SeguridadModelo();
		$clientes = $model->contarClientes();		
		$atendidos = $model->contarReparaciones(4);
		$nuevos = $model->contarReparaciones(1);
		$pendientes = $model->contarReparaciones(0);
		require_once PATH_VISTAS."/Seguridad/vista.home.php";
	}
	
	
	public function validar()
	{
		$model = new SeguridadModelo();
		$login = $model->limpiar($_POST['usuario']);
		$password = $model->limpiar($_POST['contrasena']);		
		$result= $model->validarUsuario($login, $password);
		$response['band'] = 0;
		if($result)
		{			
			session_regenerate_id();
			$result['urls'] = $model->obtenerUrlAccesos($result["tipo_usuario_id"]);
			$_SESSION['SESSION_USER'] = $result;
			session_write_close();
			$url = $_POST['url'];
			$response['data'] = $url.'inicio/';			
							
		} else {
				$response['data'] = 'Credenciales Inválidas.';
				$response['band'] = 1;
		}	
		echo json_encode($response);		
		exit();				
	}
	
	public function cerrarSesion(){
		session_start();
		unset($_SESSION["SESSION_USER"]);
		session_destroy();
		header("Location: ../../");
	}
	
	public function cambiarContrasena(){
		require_once "vista.cambiocontrasena.php";
	}
	
	public function cambiarContraseñaDatos(){
		$passwd["p1"] = $_POST['passwordAnterior'];
		$passwd["p2"] = $_POST['password'];
		$passwd["p3"] = $_POST['password1'];
		$user = $_SESSION['SESSION_USER']['id'];
		$message = $this->validarContrasenas($passwd,$user);
		if($message == ''){
			$model = new SeguridadModelo();
			try {
				$model->cambiarContrasena($passwd["p2"],$user);
				$_SESSION['message'] = "Su contraseña ha sido cambiada exitosamente.";
			}
			catch (Exception $e){
				$_SESSION['message'] = $e->getMessage();
			}
		} else {
			$_SESSION['message'] = $message;
		}
	
		header("Location: ../cambiarContrasena/");
	}
	
	private function validarContrasenas($passwd,$user,$band = true){
		$model = new SeguridadModelo();	
		if($band){
			if($model->verificarContrasena($passwd["p1"],$user)==0){
				return 'La contraseña actual no coincide.';
			}
		}
	
		if ($passwd["p2"] == ''){
			return 'Por favor ingrese un Password';
		}
		if ($passwd["p3"] == '') {
			return 'Por favor ingrese nuevamente un Password';
		}
		if ($passwd["p2"] != $passwd["p3"]){
			return 'Las contraseñas no coinciden';
		}
		return "";
	}
	
	public function error403(){
		require_once PATH_VISTAS."/Seguridad/vista.error403.php";
	}
	
	public function error404(){
		require_once PATH_VISTAS."/Seguridad/vista.error404.php";
	}
	
	public function error500(){
		require_once PATH_VISTAS."/Seguridad/vista.error500.php";
	}
	
	/*
		

	
	public function recoverPassword(){
		require_once "view.recoverPassword.php";
	}
	
	public function recoverPass(){
		$user_id = $_POST["identity_card"];
		$model = new SecureModel();
		$user = $model->getEmailByCI($user_id);
		if($user != null){
			$token = base64_encode($user_id);			
			$email = new Email();			
			$email->sendRecuperacionContrasena($user["nombres"]." ".$user["apellidos"], $user["email"],$token);			
			$_SESSION['message'] = "Por favor revise su Email. Se ha enviado un link para resetear su contraseña.";
		} else {
			$_SESSION['message'] = "El usuario no existe.";
		}
		header("Location: index.php?action=recoverPassword");
	}
	
	public function resetPassword(){
		$encode = $_GET["tc"];
		$user_id = base64_decode($encode);
		$model = new SecureModel();
		$user = $model->getEmailByCI($user_id);
		if($user == null){
			$_SESSION['message'] = "El usuario no existe.";
		}
		require_once "view.reset.php";
	}
	
	public function resetPass(){

		$user_id = $_POST["identity_card"];
		$model = new SecureModel();
		$user = $model->getEmailByCI($user_id);
		if($user != null){
			$passwd["p2"] = $_POST['passwordNew'];
			$passwd["p3"] = $_POST['repeatPasswordNew'];
			$message = $this->validate($passwd,$user,false);
			if($message == ''){				
				try {
					$model->changePassword($passwd["p2"],$user["id"]);
					$_SESSION['message'] = "Su contraseña ha sido cambiada éxitosamente.";
				}
				catch (Exception $e){
					$_SESSION['message'] = $e->getMessage();
				}
			} else {
				$_SESSION['message'] = $message;
			}
			
		} else {
			$_SESSION['message'] = "El usuario no existe.";
		}
		$token = base64_encode($user_id);
		header("Location: index.php?action=resetPassword&tc=".$token);
	}
	*/
}