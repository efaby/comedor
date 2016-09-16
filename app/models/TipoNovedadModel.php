<?php
require_once(PATH_MODELS."/BaseModel.php");

class TipoNovedadModel {

	public function getlistadoTiposNovedad(){
		$model = new BaseModel();	
		$sql = "select * from tipo_novedad where activo = 1";		
		return $model->execSql($sql, array(),true);
	}	
	
	public function getTipoNovedad()
	{
		$tipo = $_GET['id'];
		$model = new BaseModel();		
		if($tipo > 0){
			$sql = "select * from tipo_novedad where id = ?";
			$result = $model->execSql($sql, array($tipo));				
		} else {
			$result = (object) array('id'=>0,'nombre'=>'','descripcion'=>'');			
		}
		
		return $result;
	}
	
	
	public function saveTipoNovedad($tipo)
	{
		$model = new BaseModel();
		return $model->saveDatos($tipo,'tipo_novedad');
	}
	
	public function delTipoNovedad(){
		$tipo = $_GET['id'];
		$sql = "update tipo_novedad set activo = 0 where id = ?";
		$model = new BaseModel();
		$result = $model->execSql($sql, array($tipo),false,true);
	}

}
