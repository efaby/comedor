<?php
require_once (PATH_MODELS . "/ConfrontaModel.php");
require_once(PATH_MODELS."/ParametroModel.php");
require_once (PATH_HELPERS. "/File.php");
require_once(PATH_MODELS."/ParametroModel.php");
require_once(PATH_MODELS."/ExtraConfrontaModel.php");

class ConfrontaController {
	
	public function listar() {
		$model = new ConfrontaModel();
		$unidad = $this->getUnidad();
		$datos = $model->getlistadoConfrontaUnidad($unidad);
		$message = "";
		require_once PATH_VIEWS."/Confronta/view.list.php";
	}
	
	public function editar(){
		$confrontaId = isset($_GET['id'])?$_GET['id']:0;
		$confrontaItems = false;
		$disabled = '';
		if($confrontaId > 0){
			$confrontaItems = true;
			$disabled = "disabled=disabled";
		}
		$nuevafecha = strtotime ( '+1 day' , strtotime (date('Y-m-d')) ) ;
		if(isset($_POST['fecha'])){
			$fecha = $_POST['fecha'];
			$confrontaItems = true;			
		} else {
			$fecha = date ( 'Y-m-d' , $nuevafecha );
		}	
		
		$unidad = $this->getUnidad(); 
		$model = new ConfrontaModel();
		$unidadObj = $model->getUnidad($unidad);
		$desCon = $almCon = $merCon = $cons = $unidadObj->num_conscriptos;
		
		if($this->validarHorario($confrontaId, $model,$unidad, $fecha, $confrontaItems)){
			$listado = $model->getListadoPersonaUnidad($unidad,$confrontaId);
			$general = $model->getGeneral($confrontaId);
			if($confrontaId > 0){
				$fecha = $general->fecha_acceso;
			}
			
			$message = "";
			require_once PATH_VIEWS."/Confronta/view.confronta.php";
		} else {
			$_SESSION ['message'] = "No se puede realizar la acción solicitada porque No esta dentro de la hora definida para realizar esta accion";
			if($confrontaId){
				header ( "Location: ../listar/" );
			} else {
				$confrontaItems = false;
				require_once PATH_VIEWS."/Confronta/view.confronta.php";
			}
			
		}	
		
	}
	
	private function validarHorario($confrontaId,$modelConfronta,$unidadId,$fecha,$confrontaItems ){
		$result =  false;
		if($confrontaId == 0 && !$confrontaItems){
			$result = true;
		} else {
			$model = new ParametroModel();
			$parametro = $model->getsParametroByKey('confrontaKeyHora');
			$nuevafecha = strtotime ( '+1 day' , strtotime (date('Y-m-d')) ) ;
			$fechamin = date ( 'Y-m-d' , $nuevafecha ); 
			
			
			if($confrontaId == 0){
				$confrontas = $modelConfronta->getlistadoConfrontaFecha($unidadId,$fecha);
				
				if(count($confrontas)==0){
					if($fecha == $fechamin){
						if(strtotime(date('H:i'))<= strtotime($parametro->valor)){
							$result = true;
						}
					}else {
						if($fecha > $fechamin){
							$result = true;
						}
					}
				}
				
			} else {				
				$confrontas = $modelConfronta->getlistadoConfrontaGetId($confrontaId);
				if(count($confrontas)>0){
					$fecha = $confrontas[0]->fecha_acceso;
					
				}
				if($fecha == $fechamin){
					if(strtotime(date('H:i'))<= strtotime($parametro->valor)){
						$result = true;
					}
				}else {
					if($fecha > $fechamin){
						$result = true;
					}
				}
				
				
			}
		}
		
		return $result;		
	}
	
	public function guardar() {
		$model = new ConfrontaModel();
		$fecha = date('Y-m-d');
		
		$nuevafecha = $_POST ['fecha_acceso'];
		$usuario = $_SESSION['SESSION_USER']->id;
		$unidad = $this->getUnidad();
		
		$fieldsListado = array('persona_id', 'desayuno', 'almuerzo', 'merienda', 'fecha_acceso', 'fecha_registro', 'acceso','guardia','usuario_id','unidad_id','novedad_id','confronta_general_id');
		$listado = $this->getConfrontaListado($model, $fecha, $nuevafecha, $usuario,$unidad);		
		
		$fieldsGeneral = array('desayuno_ofi','almuerzo_ofi','merienda_ofi','desayuno_vol','almuerzo_vol','merienda_vol','desayuno_con','almuerzo_con','merienda_con','estado','fecha_registro','fecha_acceso','usuario_id','unidad_id','costo_desayuno','costo_merienda','costo_almuerzo');
		
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
		$general[] = $usuario; 
		$general[] = $unidad;		
		$modelP = new ParametroModel();
		$parametro = $modelP->getsParametroByKey('confrontaKeyDesayuno');
		$general[] = $parametro->valor;
		$parametro = $modelP->getsParametroByKey('confrontaKeyMerienda');
		$general[] = $parametro->valor;
		$parametro = $modelP->getsParametroByKey('confrontaKeyAlmuerzo');
		$general[] = $parametro->valor;
		
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
		$unidad = $this->getUnidad();
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
	
	public function verListado(){
		$confrontaId = isset($_GET['id'])?$_GET['id']:0;
		$unidad = $this->getUnidad();
		$model = new ConfrontaModel();
		$general = $model->getGeneral($confrontaId);
		$listado = $model->getListadoPersonaUnidad($unidad,$confrontaId);
		
		$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
		$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
		$fecha = $dias[date('w',strtotime($general->fecha_acceso))]." ".date('d',strtotime($general->fecha_acceso))." de ".$meses[date('n',strtotime($general->fecha_acceso))-1]. " del ".date('Y',strtotime($general->fecha_acceso)) ;
		
		require_once PATH_VIEWS."/Confronta/view.verListado.php";
	}
	
	public function verGeneral(){
		$confrontaId = isset($_GET['id'])?$_GET['id']:0;		
		$model = new ConfrontaModel();
		$general = $model->getGeneral($confrontaId);	
		$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
		$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
		$fecha = $dias[date('w',strtotime($general->fecha_acceso))]." ".date('d',strtotime($general->fecha_acceso))." de ".$meses[date('n',strtotime($general->fecha_acceso))-1]. " del ".date('Y',strtotime($general->fecha_acceso)) ;
	
		require_once PATH_VIEWS."/Confronta/view.verGeneral.php";
	}

	public function downloadFile(){
		$nombre = $_GET['nameFile'];
		$upload = new File();
		return $upload->download($nombre);
	}
	
	private function getUnidad(){
		$unidad_id = 0;
		if($_SESSION['SESSION_USER']->tipo==2){
			$unidad_id = $_SESSION['SESSION_USER']->unidad_id;
		} else {
			$unidad_id = isset($_GET['valor'])?$_GET['valor']:0;
		}
		return $unidad_id;
	}
	
	public function consolidado(){
		$model = new ConfrontaModel();
		$unidad = $this->getUnidad();
		$fecha = isset($_POST['fecha'])?$_POST['fecha']:date('Y-m-d');
		$datos = $model->getlistadoConsolidado($fecha);
		$message = "";
		require_once PATH_VIEWS."/Confronta/view.consolidado.php";
	}
	
	public function imprimirConsolidado(){
		$model = new ConfrontaModel();
		$unidad = $this->getUnidad();
		$fecha = isset($_GET['valor'])?$_GET['valor']:date('Y-m-d');
		$datos = $model->getlistadoConsolidado($fecha);
		$message = "";
		$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
		
		require_once PATH_VIEWS."/Confronta/view.imprimirConsolidado.php";
	}
	
	public function reporteConsolidado(){
		
		$fecha = isset($_POST['fecha'])?$_POST['fecha']:'';
		$datos = $extraConfronta = array();
		if($fecha != ''){
			$model = new ConfrontaModel();
			$datos = $model->getReporteConsolidado($fecha);
			$meses = array("ENERO","FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SEPTIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE");
			$modelEC = new ExtraConfrontaModel();
			$extraConfronta = $modelEC->getExtraConfrontaUnidades($fecha);
		}
		$message = "";
		require_once PATH_VIEWS."/Confronta/view.reporteConsolidado.php";
	}
	
	public function imprimirReporteConsolidado(){
	
		$fecha = isset($_GET['fecha'])?$_GET['fecha']:date('Y-m');
		$model = new ConfrontaModel();
		$datos = $model->getReporteConsolidado($fecha);
		$meses = array("ENERO","FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SEPTIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE");
		$modelEC = new ExtraConfrontaModel();
		$extraConfronta = $modelEC->getExtraConfrontaUnidades($fecha);
		require_once PATH_VIEWS."/Confronta/view.imprimirReporteConsolidado.php";
	}
	
	
	
}
