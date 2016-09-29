<?php
require_once (PATH_MODELS . "/NovedadModel.php");
require_once (PATH_HELPERS. "/File.php");
require_once (PATH_MODELS . "/PersonaModel.php");

class NovedadController {
	
	public function listar() {
		$model = new NovedadModel();
		$unidad_id = $this->getUnidad();		
		$datos = $model->getlistadoNovedad($unidad_id);
		$message = "";
		require_once PATH_VIEWS."/Novedad/view.list.php";
	}
	
	public function editar(){
		$model = new NovedadModel();
		$item = $model->getNovedad();	
		$tipos = $model->getTiposNovedad();
		$unidad_id = $this->getUnidad();
		$message = "";
		require_once PATH_VIEWS."/Novedad/view.form.php";
	}
	
	public function guardar() {
		
		$novedad ['id'] = $_POST ['id'];
		$novedad ['persona_id'] = $_POST ['persona_id'];
		$novedad ['tipo_novedad_id'] = $_POST ['tipo_novedad_id'];
		$novedad ['fecha_inicio'] = $_POST ['fecha_inicio'];
		$novedad ['fecha_fin'] = $_POST ['fecha_fin'];
		$novedad ['usuario_id'] = $_SESSION['SESSION_USER']->id; // getUserSesion
		
		//Subir el archivo		
		$upload = new File();
		$novedad ['url'] = $upload->uploadFile('novedad'.date('YmdHms').$novedad ['persona_id']."_");	
		
		$model = new NovedadModel();
		try {
			$datos = $model->saveNovedad( $novedad );
			$_SESSION ['message'] = "Datos almacenados correctamente.";
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
		}
		header ( "Location: ../listar/" );
	}
	
	public function eliminar() {
		$model = new NovedadModel();
		try {
			$datos = $model->delNovedad();
			$_SESSION ['message'] = "Datos eliminados correctamente.";
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
		}
		header ( "Location: ../listar/" );
	}
	
	public function downloadFile(){
		$nombre = $_GET['nameFile'];
		$upload = new File();
		return $upload->download($nombre);
	}
	
	public function getPersona() {
		$cedula = $_GET ['identificacion'];
		$model = new PersonaModel();
		$persona = $model->getPersonaPorCedula($cedula);
		echo json_encode ($persona);
	}
	
	private function getUnidad(){
		$unidad_id = 0;
		if($_SESSION['SESSION_USER']->tipo==2){
			$unidad_id = $_SESSION['SESSION_USER']->unidad_id;
		}
		return $unidad_id;
	}
	
}
