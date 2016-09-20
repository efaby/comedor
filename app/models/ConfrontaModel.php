<?php
require_once(PATH_MODELS."/BaseModel.php");

class ConfrontaModel {

	public function getlistadoConfrontaUnidad($unidad){
		$model = new BaseModel();	
		$sql = "select * from confonta_general where unidad_id = ?";		
		return $model->execSql($sql, array($unidad),true);
	}	
	/*
	public function getUnidad()
	{
		$unidad = $_GET['id'];
		$model = new BaseModel();		
		if($unidad > 0){
			$sql = "select * from unidad where id = ?";
			$result = $model->execSql($sql, array($unidad));				
		} else {
			$result = (object) array('id'=>0,'nombre'=>'','descripcion'=>'','abreviatura'=>'', 'num_conscriptos'=>0,'hora_inicio'=>'00:00','hora_fin'=>'00:00');			
		}
		
		return $result;
	}
	
	
	public function saveUnidad($unidad)
	{
		$model = new BaseModel();
		return $model->saveDatos($unidad,'unidad');
	}
	
	public function delUnidad(){
		$unidad = $_GET['id'];
		$sql = "update unidad set activo = 0 where id = ?";
		$model = new BaseModel();
		$result = $model->execSql($sql, array($unidad),false,true);
	}
	
	*/

}
