<?php
require_once (PATH_MODELS . "/UnidadModel.php");


class UnidadController {
	
	public function listar() {
		$model = new UnidadModel();
		$datos = $model->getlistadoUnidad();
		$message = "";
		require_once PATH_VIEWS."/Unidad/view.list.php";
	}
	
	public function editar(){
		$model = new UnidadModel();
		$item = $model->getUnidad();		
		$message = "";
		require_once PATH_VIEWS."/Unidad/view.form.php";
	}
	
	public function guardar() {
		
		$unidad ['id'] = $_POST ['id'];
		$unidad ['nombre'] = $_POST ['nombre'];
		$unidad ['descripcion'] = $_POST ['descripcion'];
		$unidad ['abreviatura'] = $_POST ['abreviatura'];
		$unidad ['hora_inicio'] = $_POST ['hora_inicio'].":".$_POST ['minuto_inicio'];
		$unidad ['hora_fin'] = $_POST ['hora_fin'].":".$_POST ['minuto_fin'];
		$unidad ['num_conscriptos'] = $_POST ['num_conscriptos'];
		
		$model = new UnidadModel();
		try {
			$datos = $model->saveUnidad( $unidad );
			$_SESSION ['message'] = "Datos almacenados correctamente.";
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
		}
		header ( "Location: ../listar/" );
	}
	
	public function eliminar() {
		$model = new UnidadModel();
		try {
			$datos = $model->delUnidad();
			$_SESSION ['message'] = "Datos eliminados correctamente.";
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
		}
		header ( "Location: ../listar/" );
	}
	
}
