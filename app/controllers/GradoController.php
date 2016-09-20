<?php
require_once (PATH_MODELS . "/GradoModel.php");


class GradoController {
	
	public function listar() {
		$model = new GradoModel();
		$datos = $model->getlistadoGradoPersona();
		$message = "";
		require_once PATH_VIEWS."/Grado/view.list.php";
	}
	
	public function editar(){
		$model = new GradoModel();
		$item = $model->getGradoPersona();	
		$tipos = $model->getTipoPersona();
		$message = "";
		require_once PATH_VIEWS."/Grado/view.form.php";
	}
	
	public function guardar() {
		
		$grado ['id'] = $_POST ['id'];
		$grado ['nombre'] = $_POST ['nombre'];
		$grado ['descripcion'] = $_POST ['descripcion'];
		$grado ['abreviatura'] = $_POST ['abreviatura'];
		$grado ['tipo_persona_id'] = $_POST ['tipo_persona_id'];
		
		$model = new GradoModel();
		try {
			$datos = $model->saveGradoPersona( $grado );
			$_SESSION ['message'] = "Datos almacenados correctamente.";
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
		}
		header ( "Location: ../listar/" );
	}
	
	public function eliminar() {
		$model = new GradoModel();
		try {
			$datos = $model->delGradoPersona();
			$_SESSION ['message'] = "Datos eliminados correctamente.";
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
		}
		header ( "Location: ../listar/" );
	}
	
}
