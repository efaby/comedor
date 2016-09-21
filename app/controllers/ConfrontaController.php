<?php
require_once (PATH_MODELS . "/ConfrontaModel.php");


class ConfrontaController {
	
	public function listar() {
		$model = new ConfrontaModel();
		$unidad = 13; // obtener unidad del usurio amanuence logueado
		$datos = $model->getlistadoConfrontaUnidad($unidad);
		$message = "";
		require_once PATH_VIEWS."/Confronta/view.list.php";
	}
	
	public function editar(){
		$model = new ConfrontaModel();
		$unidad = 13; // obtener unidad del usurio amanuence logueado
		$listado = $model->getListadoPersonaUnidad($unidad);	
		$cons = 20;
		$message = "";
		require_once PATH_VIEWS."/Confronta/view.confronta.php";
	}
	
	
	
	public function guardar() {
		
		$desayunos = $_POST ['desayuno'];
		
		print_r($desayunos);
		exit();
		
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
	
	/*
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
	*/
}
