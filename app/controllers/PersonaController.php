<?php
require_once (PATH_MODELS . "/PersonaModel.php");


class PersonaController {
	
	public function listar() {
		$model = new PersonaModel();
		$datos = $model->getlistadoPersona();
		$message = "";
		require_once PATH_VIEWS."/Persona/view.list.php";
	}
	
	public function editar(){
		$model = new PersonaModel();
		$item = $model->getPersona();	
		$unidades = $model->getCatalogo('unidad');
		$tipos = $model->getCatalogo('tipo_persona');
		$grados = $model->getCatalogo('grado_persona');
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
		$persona ['usuario_id'] = 0; // getUserSesion
		
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
		$persona = 0;
		if(strlen($cedula)>9){
			$model = new PersonaModel();
			$persona = $model->getPersonaPorCedula($cedula);
		}
		echo json_encode ((is_object($persona))?array('valid'=>false):array('valid'=>true));
	}
	
}
