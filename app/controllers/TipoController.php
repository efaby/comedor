<?php
require_once (PATH_MODELS . "/TipoModel.php");


class TipoController {
	
	public function listar() {
		$model = new TipoModel();
		$datos = $model->getlistadoTiposPersona();
		$message = "";
		require_once PATH_VIEWS."/Tipo/view.list.php";
	}
	
	public function editar(){
		$model = new TipoModel();
		$item = $model->getTipoPersona();		
		$message = "";
		require_once PATH_VIEWS."/Tipo/view.form.php";
	}
	
	public function guardar() {
		
		$tipo ['id'] = $_POST ['id'];
		$tipo ['nombre'] = $_POST ['nombre'];
		$tipo ['descripcion'] = $_POST ['descripcion'];
		
		$model = new TipoModel();
		try {
			$datos = $model->saveTipoPersona( $tipo );
			$_SESSION ['message'] = "Datos almacenados correctamente.";
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
		}
		header ( "Location: ../listar/" );
	}
	
	public function eliminar() {
		$model = new TipoModel();
		try {
			$datos = $model->delTipoPersona();
			$_SESSION ['message'] = "Datos eliminados correctamente.";
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
		}
		header ( "Location: ../listar/" );
	}
	
}
