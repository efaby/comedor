<?php
require_once (PATH_MODELS . "/ArmaModel.php");


class ArmaController {
	
	public function listar() {
		$model = new ArmaModel();
		$datos = $model->getlistadoArmas();
		$message = "";
		require_once PATH_VIEWS."/Arma/view.list.php";
	}
	
	public function editar(){
		$model = new ArmaModel();
		$item = $model->getArma();		
		$message = "";
		require_once PATH_VIEWS."/Arma/view.form.php";
	}
	
	public function guardar() {
		
		$tipo ['id'] = $_POST ['id'];
		$tipo ['nombre'] = $_POST ['nombre'];
		$tipo ['descripcion'] = $_POST ['descripcion'];
		
		$model = new ArmaModel();
		try {
			$datos = $model->saveArma( $tipo );
			$_SESSION ['message'] = "Datos almacenados correctamente.";
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
		}
		header ( "Location: ../listar/" );
	}
	
	public function eliminar() {
		$model = new ArmaModel();
		try {
			$datos = $model->delArma();
			$_SESSION ['message'] = "Datos eliminados correctamente.";
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
		}
		header ( "Location: ../listar/" );
	}
	
}
