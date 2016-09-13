<?php
require_once (PATH_MODELS . "/UsuarioModel.php");
/**
 * Controlador de Usuarios
 */
class UsuarioController {
	
	public function listar() {
		$model = new UsuarioModel();
		$datos = $model->getlistadoUsuarios();
		$message = "";
		require_once PATH_VIEWS."/Usuario/view.list.php";
	}
	
	public function editar(){
		$model = new UsuarioModel();
		$usuario = $model->getUsuario();		
		$tipos = $model->getTipoUsuario();
		$message = "";
		require_once PATH_VIEWS."/Usuario/view.form.php";
	}
	
	public function guardar() {
		
		$usuario ['id'] = $_POST ['id'];
		$usuario ['identificacion'] = $_POST ['identificacion'];
		$usuario ['nombres'] = $_POST ['nombres'];
		$usuario ['apellidos'] = $_POST ['apellidos'];
		$usuario ['direccion'] = $_POST ['direccion'];
		$usuario ['tipo_usuario_id'] = $_POST ['tipo_usuario_id'];
		$usuario ['telefono'] = $_POST ['telefono'];
		$usuario ['password'] = $_POST ['password'];
		$usuario ['email'] = $_POST ['email'];
		$usuario ['celular'] = $_POST ['celular'];	
		$usuario ['usuario'] = $_POST ['usuario'];
		$usuario ['genero'] = $_POST ['genero'];
		$model = new UsuarioModel();
		try {
			$datos = $model->saveUsuario( $usuario );
			$_SESSION ['message'] = "Datos almacenados correctamente.";
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
		}
		header ( "Location: ../listar/" );
	}
	
	public function eliminar() {
		$model = new UsuarioModel();
		try {
			$datos = $model->delUsuario();
			$_SESSION ['message'] = "Datos eliminados correctamente.";
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
		}
		header ( "Location: ../listar/" );
	}
	
}
