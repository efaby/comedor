<?php
require_once (PATH_MODELS . "/UsuarioModel.php");
require_once (PATH_MODELS . "/PersonaModel.php");



class UsuarioController {
	
	public function listar() {
		$model = new UsuarioModel();
		$datos = $model->getlistadoUsuario($_SESSION['SESSION_USER']->id);
		$message = "";
		require_once PATH_VIEWS."/Usuario/view.list.php";
	}
	
	public function editar(){
		$model = new UsuarioModel();
		$item = $model->getUsuario();	
		$tipos = $model->getCatalogo('tipo_usuario');
		$unidades = $model->getCatalogo('unidad');
		$message = "";
		require_once PATH_VIEWS."/Usuario/view.form.php";
	}
	
	public function guardar() {
		
		$usuario ['id'] = $_POST ['id'];
		$usuario ['persona_id'] = $_POST ['persona_id'];
		$usuario ['tipo_usuario_id'] = $_POST ['tipo_usuario_id'];
		$usuario ['usuario'] = $_POST ['usuario'];
		$usuario ['password'] = $_POST ['password'];
		$usuario ['unidad_id'] = $_POST ['unidad_id'];
		
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
	
	public function getPersona() {
		$cedula = $_GET ['identificacion'];
		$model = new PersonaModel();
		$persona = $model->getPersonaPorCedula($cedula);		
		echo json_encode ($persona);
	}
	
}
