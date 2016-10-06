<?php
require_once (PATH_MODELS . "/PersonaModel.php");
require_once (PATH_HELPERS. "/code/Code.php");


class PersonaController {
	
	public function listar() {
		$model = new PersonaModel();
		$unidad_id = $this->getUnidad();
		$datos = $model->getlistadoPersona($unidad_id);
		$message = "";
		require_once PATH_VIEWS."/Persona/view.list.php";
	}
	
	public function editar(){
		$model = new PersonaModel();
		$item = $model->getPersona();	
		$unidades = $model->getCatalogo('unidad');
		$tipos = $model->getCatalogo('tipo_persona');
		$grados = $model->getCatalogo('grado_persona');
		$unidad_id = $this->getUnidad();
		$message = "";
		require_once PATH_VIEWS."/Persona/view.form.php";
	}
	
	public function guardar() {
		
		$persona ['id'] = $_POST ['id'];
		$persona ['unidad_id'] = $_POST ['unidad_id'];		
		$persona ['grado_persona_id'] = $_POST ['grado_persona_id'];
		$persona ['identificacion'] = $_POST ['identificacion'];
		$persona ['nombres'] = $_POST ['nombres'];
		$persona ['apellidos'] = $_POST ['apellidos'];
		$persona ['arma'] = $_POST ['arma'];
		$persona ['telefono'] = $_POST ['telefono'];
		$persona ['celular'] = $_POST ['celular'];
		$persona ['usuario_id'] = $_SESSION['SESSION_USER']->id; // getUserSesion
		
		$model = new PersonaModel();
		try {
			$datos = $model->savePersona($persona);
			$_SESSION ['message'] = "Datos almacenados correctamente.";
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
		}
		header ( "Location: ../listar/" );
	}
	
	public function eliminar() {
		$model = new PersonaModel();
		try {
			$datos = $model->delPersona();
			$_SESSION ['message'] = "Datos eliminados correctamente.";
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
		}
		header ( "Location: ../listar/" );
	}
	
	public function verificarPersona() {
		$cedula = $_GET ['identificacion'];
		$id = $_GET ['id'];
		$persona = 0;
		if(strlen($cedula)>9){
			$model = new PersonaModel();
			$persona = $model->getPersonaPorCedula($cedula);
		}
		$validate = array('valid'=>true);
		if(is_object($persona)){
			if($persona->id != $id){
				$validate = array('valid'=>false);
			}
		}
		echo json_encode ($validate);
	}
	
	private function getUnidad(){
		$unidad_id = 0;
		if($_SESSION['SESSION_USER']->tipo==2){
			$unidad_id = $_SESSION['SESSION_USER']->unidad_id;
		}
		return $unidad_id;
	}
	
	public function generarCodigo(){
		$model = new PersonaModel();
		$item = $model->getPersona();		
		$message = "";
		require_once PATH_VIEWS."/Persona/view.generarCodigo.php";
	}
	
	public function codigo(){
		$code = new Code();
		$code->generarCodigo($_GET['ci']);
	}
}
