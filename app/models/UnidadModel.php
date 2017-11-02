<?php
require_once(PATH_MODELS."/BaseModel.php");

class UnidadModel {

	public function getlistadoUnidad(){
		$model = new BaseModel();	
		$sql = "SELECT u.nombre, u.id, 
			count(CASE WHEN gp.tipo_persona_id = 1 THEN p.id ELSE null END) AS oficiales, 
			count(CASE WHEN gp.tipo_persona_id = 2 THEN p.id ELSE null END) AS voluntarios,
			u.num_conscriptos,
			u.hora_inicio,
			u.hora_fin 
			FROM comedor.persona as p
			inner join grado_persona as gp on gp.id = p.grado_persona_id 
			inner join unidad as u on u.id = p.unidad_id
			where u.activo = 1
			group by u.id";		
		return $model->execSql($sql, array(),true);
	}	
	
	public function getUnidad(){
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
	
	public function saveUnidad($unidad)	{
		$model = new BaseModel();
		return $model->saveDatos($unidad,'unidad');
	}
	
	public function delUnidad(){
		$unidad = $_GET['id'];
		$sql = "update unidad set activo = 0 where id = ?";
		$model = new BaseModel();
		$result = $model->execSql($sql, array($unidad),false,true);
	}
	
	public function getUnidadById($unidad){
		$model = new BaseModel();
		$sql = "select * from unidad where id = ?";
		return $model->execSql($sql, array($unidad));		
	}

}
