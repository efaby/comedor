<?php
require_once(PATH_MODELS."/BaseModel.php");

class ArmaModel {

	public function getlistadoArmas(){
		$model = new BaseModel();	
		$sql = "select * from arma where activo = 1";		
		return $model->execSql($sql, array(),true);
	}	
	
	public function getArma()
	{
		$tipo = $_GET['id'];
		$model = new BaseModel();		
		if($tipo > 0){
			$sql = "select * from arma where id = ?";
			$result = $model->execSql($sql, array($tipo));				
		} else {
			$result = (object) array('id'=>0,'nombre'=>'','descripcion'=>'');			
		}
		
		return $result;
	}
	
	
	public function saveArma($arma)
	{
		$model = new BaseModel();
		return $model->saveDatos($arma,'arma');
	}
	
	public function delArma(){
		$tipo = $_GET['id'];
		$sql = "update arma set activo = 0 where id = ?";
		$model = new BaseModel();
		$result = $model->execSql($sql, array($tipo),false,true);
	}

}
