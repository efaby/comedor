<?php
require_once(PATH_MODELS."/BaseModel.php");

class ParametroModel {

	public function getsParametros(){
		$model = new BaseModel();
		$sql = "select * from parametros";
		return $model->execSql($sql, array(),true);
	}
	
	public function getsParametroByKey($key){
		$model = new BaseModel();
		$sql = "select * from parametros where clave = ?";
		return $model->execSql($sql, array($key));
	}
	
	public function saveParametros($valor, $key){
		$sql = "update parametros set valor = ? where clave = ?";
		$model = new BaseModel();
		$result = $model->execSql($sql, array($valor,$key),false,true);
	}
}
