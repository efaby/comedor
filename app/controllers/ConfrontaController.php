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
		$listado = $this->getConfrontaListado($model, $fecha, $nuevafecha, $usuario,$unidad);		
		
		$general['desOfi'] = $_POST ['desOfi'];
		$general['almOfi'] = $_POST ['almOfi'];
		$general['merOfi'] = $_POST ['merOfi'];
		
		$general['des'] = $_POST ['des'];
		$general['alm'] = $_POST ['alm'];
		$general['mer'] = $_POST ['mer'];
		
		$general['desCons'] = $_POST ['desCons'];
		$general['almCons'] = $_POST ['almCons'];
		$general['merCons'] = $_POST ['merCons'];
		
		$general['estado'] = 1;
		
		$general['fecha_registro'] = $fecha;
		$general['fecha_acceso'] = $nuevafecha;
		$general['usuario_id'] = $usuario; // obtener usuario
		$general['unidad_id'] = $unidad;
		
		

		try {
			$datos = $model->saveUnidad( $unidad );
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
			$row = array('persona_id'=>$item->id, 'desayuno' => 0, 'almuerzo' => 0, 'merienda' => 0, 'fecha_acceso'=>$fecha_acceso, 'fecha_registro'=>$fecha, 'acceso'=>1,'guardia'=>1,'usuario_id'=>$usuario,'unidad_id'=>$unidad,'novedad_id' => $item->novedad);
			if(in_array($item->id, $desayunos)){
				$row['desayuno'] = 1;
			}
			if(in_array($item->id, $almuerzos)){
				$row['almuerzo'] = 1;
			}
			if(in_array($item->id, $meriendas)){
				$row['merienda'] = 1;
			}
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
