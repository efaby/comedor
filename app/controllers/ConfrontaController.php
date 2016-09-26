<?php
require_once (PATH_MODELS . "/ConfrontaModel.php");
require_once(PATH_MODELS."/ParametroModel.php");

class ConfrontaController {
	
	public function listar() {
		$model = new ConfrontaModel();
		$unidad = 13; // obtener unidad del usurio amanuence logueado
		$datos = $model->getlistadoConfrontaUnidad($unidad);
		$message = "";
		require_once PATH_VIEWS."/Confronta/view.list.php";
	}
	
	public function editar(){
		// revisar hora
		$confrontaId = isset($_GET['id'])?$_GET['id']:0;
		$unidad = 13; // obtener unidad del usurio amanuence logueado
		$model = new ConfrontaModel();		
		if($this->validarHorario($confrontaId, $model,$unidad)){
			$listado = $model->getListadoPersonaUnidad($unidad,$confrontaId);
			$general = $model->getGeneral($confrontaId);
			$desCon = $almCon = $merCon = $cons = 20;
			$message = "";
			require_once PATH_VIEWS."/Confronta/view.confronta.php";
		} else {
			$_SESSION ['message'] = "No se puede realizar la acción solicitada porque No esta dentro de la hora definida para realizar esta accion";
			header ( "Location: ../listar/" );
		}	
		
	}
	
	private function validarHorario($confrontaId,$modelConfronta,$unidadId){
		$model = new ParametroModel();
		$parametro = $model->getsParametroByKey('confronta.key.hora');
		$result =  false;
		if(strtotime(date('H:s'))<= strtotime($parametro->valor)){
			$confrontas = $modelConfronta->getlistadoConfrontaHoy($unidadId);
			if(count($confrontas)>0){
				if($confrontas[0]->id==$confrontaId){
					$result = true;
				}				
			} else {
				if($confrontaId==0){
					$result = true;
				}
			}
		} 
		return $result;		
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
		
		$confronta_id = isset($_POST['confronta_id'])?$_POST['confronta_id']:0;

		try {

			if($confronta_id){
				$datos = $model->updateConfronta($fieldsGeneral,$general,$fieldsListado,$listado,$confronta_id);
			} else {
				$datos = $model->saveConfronta( $fieldsGeneral,$general,$fieldsListado,$listado);
			}
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
		$listado = $model->getListadoPersonaUnidad($unidad,0);
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
	
	public function eliminar() {
		
		$confrontaId = isset($_GET['id'])?$_GET['id']:0;
		$unidad = 13; // obtener unidad del usurio amanuence logueado
		$model = new ConfrontaModel();
		if($this->validarHorario($confrontaId, $model,$unidad)){	
			try {
				$datos = $model->delConfronta($confrontaId);
				$_SESSION ['message'] = "Datos eliminados correctamente.";
			} catch ( Exception $e ) {
				$_SESSION ['message'] = $e->getMessage ();
			}
			header ( "Location: ../listar/" );
		} else {
			$_SESSION ['message'] = "No se puede realizar la acción solicitada porque No esta dentro de la hora definida para realizar esta accion";
			header ( "Location: ../listar/" );
		}	
	}
	
	public function imprimir(){
		$confrontaId = isset($_GET['id'])?$_GET['id']:0;
		$unidad = 13; // obtener unidad del usurio amanuence logueado
		$model = new ConfrontaModel();
		$listado = $model->getListadoPersonaUnidad($unidad,$confrontaId);
		require_once PATH_VIEWS."/Confronta/view.imprimir.php";
	}

}
