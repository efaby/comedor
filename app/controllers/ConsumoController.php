<?php
require_once (PATH_MODELS . "/ConsumoModel.php");
require_once (PATH_MODELS . "/PersonaModel.php");
require_once(PATH_MODELS."/UnidadModel.php");
require_once(PATH_MODELS."/ExtraConfrontaModel.php");

class ConsumoController {
	
	public function individual() {
		$usuario = (isset($_POST ['id']))?$_POST ['id']:0;	
		$imprimir = (isset($_POST ['imprimir']))?$_POST ['imprimir']:0;
		$fechaInicio = (isset($_POST ['fecha_inicio']))?$_POST ['fecha_inicio']:'';	
		$fechaFin = (isset($_POST ['fecha_fin']))?$_POST ['fecha_fin']:'';
		$item = (object) array('persona_id'=>0,'identificacion' =>'','nombres'=>'','apellidos'=>'', 'id' => 0);			;
		$datos =  $extraConfronta = array();

		if($usuario > 0){
			$model = new ConsumoModel();
			$datos = $model->getConsumo($usuario, $fechaInicio, $fechaFin,$_SESSION['SESSION_USER']->unidad_id);
			$model = new PersonaModel();
			$cedula = (isset($_POST ['identificacion']))?$_POST ['identificacion']:0;
			$item = $model->getPersonaPorCedula($cedula);
			$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
			$parametros = $this->getParametros();	
			$modelEC = new ExtraConfrontaModel();
			$extraConfronta = $modelEC->getExtraConfrontaByPersona($usuario, $fechaInicio, $fechaFin);
			$servicio = array(1=>'Desayuno',2=>'Almuerzo',3 =>'Merienda');
		}

		require_once PATH_VIEWS."/Consumo/view.individual.php";		
	}
	
	public function imprimirIndividual(){
		$usuario = $_GET ['id'];
		$fechaInicio = $_GET ['fecha_inicio'];
		$fechaFin = $_GET ['fecha_fin'];		
		$model = new ConsumoModel();
		$datos = $model->getConsumo($usuario, $fechaInicio, $fechaFin,$_SESSION['SESSION_USER']->unidad_id);	
		$model = new PersonaModel();
		$cedula = $_GET ['identificacion'];
		$item = $model->getPersonaPorCedula($cedula);
		$parametros = $this->getParametros();		
		$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");		
		$modelEC = new ExtraConfrontaModel();
		$extraConfronta = $modelEC->getExtraConfrontaByPersona($usuario, $fechaInicio, $fechaFin);
		$servicio = array(1=>'Desayuno',2=>'Almuerzo',3 =>'Merienda');
		require_once PATH_VIEWS."/Consumo/view.imprimirIndividual.php";
	}
	
	
	private function getParametros(){
		$model = new UnidadModel();
		$unidad_id = $_SESSION['SESSION_USER']->unidad_id;
		$unidad = $model->getUnidadById($unidad_id);		
		$result['unidad'] = $unidad->abreviatura;
		return $result;	
	}
	
	
	public function listado() {
		$fechaInicio = (isset($_POST ['fecha_inicio']))?$_POST ['fecha_inicio']:'';
		$datos = $extraConfronta = null;
		if($fechaInicio != ''){
			$model = new ConsumoModel();
			$parametros = $this->getParametros();
			$datos = $model->getConsumoListado($fechaInicio,$_SESSION['SESSION_USER']->unidad_id);			
			$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
			$modelEC = new ExtraConfrontaModel();
			$extraConfronta = $modelEC->getExtraConfrontaListado($fechaInicio, $_SESSION['SESSION_USER']->unidad_id);
		}
		require_once PATH_VIEWS."/Consumo/view.listado.php";
	}
	
	public function imprimirListado() {
		
		$fechaInicio = $_GET ['fecha_inicio'];
		$model = new ConsumoModel();
		$datos = $model->getConsumoListado($fechaInicio,$_SESSION['SESSION_USER']->unidad_id);
		$parametros = $this->getParametros();
		$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
		$modelEC = new ExtraConfrontaModel();
		$extraConfronta = $modelEC->getExtraConfrontaListado($fechaInicio, $_SESSION['SESSION_USER']->unidad_id);
		require_once PATH_VIEWS."/Consumo/view.imprimirListado.php";
		
		
	}
	
	public function getPersona() {
		$cedula = $_GET ['identificacion'];
		$model = new PersonaModel();
		$persona = $model->getPersonaPorCedula($cedula);
		echo json_encode ($persona);
	}
	
}
