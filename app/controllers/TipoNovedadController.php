<?php
require_once (PATH_MODELS . "/TipoNovedadModel.php");


class TipoNovedadController {
	
	public function listar() {
		$model = new TipoNovedadModel();
		$datos = $model->getlistadoTiposNovedad();
		$message = "";
		require_once PATH_VIEWS."/TipoNovedad/view.list.php";
	}
	
	public function editar(){
		$model = new TipoNovedadModel();
		$item = $model->getTipoNovedad();	
		$message = "";
		require_once PATH_VIEWS."/TipoNovedad/view.form.php";
	}
	
	public function guardar() {
		
		$tipo ['id'] = $_POST ['id'];
		$tipo ['nombre'] = $_POST ['nombre'];
		$tipo ['descripcion'] = $_POST ['descripcion'];
		
		$model = new TipoNovedadModel();
		try {
			$datos = $model->saveTipoNovedad( $tipo );
			$_SESSION ['message'] = "Datos almacenados correctamente.";
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
		}
		header ( "Location: ../listar/" );
	}
	
	public function eliminar() {
		$model = new TipoNovedadModel();
		try {
			$datos = $model->delTipoNovedad();
			$_SESSION ['message'] = "Datos eliminados correctamente.";
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
		}
		header ( "Location: ../listar/" );
	}
	
}
