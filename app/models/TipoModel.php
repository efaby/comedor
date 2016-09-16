<?php
require_once(PATH_MODELS."/BaseModel.php");

class TipoModel {

	public function getlistadoTiposPersona(){
		$model = new BaseModel();	
		$sql = "select * from tipo_persona where activo = 1";		
		return $model->execSql($sql, array(),true);
	}	
	
	public function getTipoPersona()
	{
		$tipo = $_GET['id'];
		$model = new BaseModel();		
		if($tipo > 0){
			$sql = "select * from tipo_persona where id = ?";
			$result = $model->execSql($sql, array($tipo));				
		} else {
			$result = (object) array('id'=>0,'nombre'=>'','descripcion'=>'');			
		}
		
		return $result;
	}
	
	
	public function saveTipoPersona($tipo)
	{
		$model = new BaseModel();
		return $model->saveDatos($tipo,'tipo_persona');
	}
	
	public function delTipoPersona(){
		$tipo = $_GET['id'];
		$sql = "update tipo_persona set activo = 0 where id = ?";
		$model = new BaseModel();
		$result = $model->execSql($sql, array($tipo),false,true);
	}

}
