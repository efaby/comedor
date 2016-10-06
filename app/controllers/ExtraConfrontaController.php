<?php
require_once (PATH_MODELS . "/ExtraConfrontaModel.php");
require_once (PATH_MODELS . "/PersonaModel.php");

class ExtraConfrontaController {
	
	public function listar() {
		$model = new ExtraConfrontaModel();
		$datos = $model->getlistadoExtraConfronta();
		$message = "";
		$servicio = array(1=>'Desayuno',2=>'Almuerzo',3 =>'Merienda');
		require_once PATH_VIEWS."/ExtraConfronta/view.list.php";
	}
	
	public function editar(){
		$model = new ExtraConfrontaModel();
		$item = $model->getExtraConfronta();
		$message = "";
		require_once PATH_VIEWS."/ExtraConfronta/view.form.php";
	}
	
	public function guardar() {
		
		$item ['id'] = $_POST ['id'];
		$item ['persona_id'] = $_POST ['persona_id'];
		$item ['tipo_servicio'] = $_POST ['tipo_servicio'];
		if($item ['id']==0){
			$item ['fecha'] = date('Y-m-d');
		}		
		$item ['usuario_id'] = $_SESSION['SESSION_USER']->id;		
		$model = new ExtraConfrontaModel();
		try {
			$datos = $model->saveExtraConfronta($item);
			$_SESSION ['message'] = "Datos almacenados correctamente.";
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
	
	
	public function eliminar() {
		$model = new ExtraConfrontaModel();
		try {
			$datos = $model->delExtraConfronta();
			$_SESSION ['message'] = "Datos eliminados correctamente.";
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
		}
		header ( "Location: ../listar/" );
	}
	
}
