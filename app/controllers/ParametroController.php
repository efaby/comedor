<?php
require_once (PATH_MODELS . "/ParametroModel.php");


class ParametroController {

	public function editar(){
		$model = new ParametroModel();
		$datos = $model->getsParametros();		
		$message = "";
		require_once PATH_VIEWS."/Parametro/view.editar.php";
	}
	
	public function guardar() {
		$model = new ParametroModel();
		$datos = $model->getsParametros();
		
		try {
			foreach ($datos as $item){
				if(isset($_POST[$item->clave])){
					$valor = $_POST[$item->clave];
					$model->saveParametros($valor, $item->clave);
				}
			}
			$_SESSION ['message'] = "Datos almacenados correctamente.";
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
		}
		header ( "Location: ../editar/" );
	}
	
}
