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
		$model = new ConfrontaModel();
		$fecha = date('Y-m-d');
		$nuevafecha = strtotime ( '+1 day' , strtotime ( $fecha ) ) ;
		$nuevafecha = date ( 'Y-m-d' , $nuevafecha );
		$usuario = 1; // obtener usuario
		$unidad = 13; // obtener unidad del usurio amanuence logueado
		
		$fieldsListado = array('persona_id', 'desayuno', 'almuerzo', 'merienda', 'fecha_acceso', 'fecha_registro', 'acceso','guardia','usuario_id','unidad_id','novedad_id','confronta_general_id');
		$listado = $this->getConfrontaListado($model, $fecha, $nuevafecha, $usuario,$unidad);		
		
		$fieldsGeneral = array('desayuno_ofi','almuerzo_ofi','merienda_ofi','desayuno_vol','almuerzo_vol','merienda_vol','desayuno_con','almuerzo_con','merienda_con','estado','fecha_registro','fecha_acceso','usuario_id','unidad_id');
		
		$general[] = $_POST ['desOfi'];
		$general[] = $_POST ['almOfi'];
		$general[] = $_POST ['merOfi'];		
		$general[] = $_POST ['des'];
		$general[] = $_POST ['alm'];
		$general[] = $_POST ['mer'];		
		$general[] = $_POST ['desCons'];
		$general[] = $_POST ['almCons'];
		$general[] = $_POST ['merCons'];		
		$general[] = 1;		
		$general[] = $fecha;
		$general[] = $nuevafecha;
		$general[] = $usuario; // obtener usuario
		$general[] = $unidad;
		
		

		try {
			$datos = $model->saveConfronta( $fieldsGeneral,$general,$fieldsListado,$listado);
			$_SESSION ['message'] = "Datos almacenados correctamente.";
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
		}
		header ( "Location: ../listar/" );
	}
	
	private function getConfrontaListado($model, $fecha, $fecha_acceso,$usuario,$unidad){
		$desayunos = $_POST ['desayuno'];
		$almuerzos = $_POST ['almuerzo'];
		$meriendas = $_POST ['merienda'];		
		$listado = $model->getListadoPersonaUnidad($unidad);
		$listadoArray = array();
		foreach ($listado as $item){
			$row = array();
			$row[] = $item->id;
			$row[] = (in_array($item->id, $desayunos))?1:0;
			$row[] = (in_array($item->id, $almuerzos))?1:0;
			$row[] = (in_array($item->id, $meriendas))?1:0;
			$row[] = $fecha_acceso;
			$row[] = $fecha;
			$row[] = 1;
			$row[] = 1;
			$row[] = $usuario;
			$row[] = $unidad;
			$row[] = $item->novedad;
			$listadoArray[] = $row;
		}
		
		return $listadoArray;
		
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
