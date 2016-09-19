<?php
require_once (PATH_MODELS . "/NovedadModel.php");
require_once (PATH_HELPERS. "/File.php");
require_once (PATH_MODELS . "/PersonaModel.php");

class NovedadController {
	
	public function listar() {
		$model = new NovedadModel();
		// Obtenemos el id de la unidad
		$unidad_id = 0;
		$datos = $model->getlistadoNovedad($unidad_id);
		$message = "";
		require_once PATH_VIEWS."/Novedad/view.list.php";
	}
	
	public function editar(){
		$model = new NovedadModel();
		$item = $model->getNovedad();	
		$tipos = $model->getTiposNovedad();
		// Obtenemos el id de la unidad
		$unidad_id = 0;
		$message = "";
		require_once PATH_VIEWS."/Novedad/view.form.php";
	}
	
	public function guardar() {
		
		$novedad ['id'] = $_POST ['id'];
		$novedad ['persona_id'] = $_POST ['persona_id'];
		$novedad ['tipo_novedad_id'] = $_POST ['tipo_novedad_id'];
		$novedad ['fecha_inicio'] = $_POST ['fecha_inicio'];
		$novedad ['fecha_fin'] = $_POST ['fecha_fin'];
		$novedad ['usuario_id'] = 0; // getUserSesion
		
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
}
