<?php
require_once(PATH_MODELS."/BaseModel.php");

class ConfrontaModel {

	public function getlistadoConfrontaUnidad($unidad){
		$model = new BaseModel();	
		$sql = "select c.*, u.abreviatura as unidad from confronta_general as c
				inner join unidad as u on u.id = c.unidad_id
				where unidad_id = ?";		
		return $model->execSql($sql, array($unidad),true);
	}	
	
	public function getListadoPersonaUnidad($unidad){
		$model = new BaseModel();
		$sql = "select p.*, g.abreviatura as grado, g.tipo_persona_id as tipo, t.nombre, t.id as novedad from persona as p
				inner join grado_persona as g on g.id = p.grado_persona_id
				left join novedad as n on p.id = n.persona_id and ('".date('Y-m-d')."' between n.fecha_inicio and n.fecha_fin) and n.activo = 1
                left join tipo_novedad as t on t.id = n.tipo_novedad_id
				where p.unidad_id = ?
                group by p.id";
		return $model->execSql($sql, array($unidad),true);
	}
	
	public function saveConfronta($fieldsGeneral, $general, $fieldsListado, $listado){
		$model = new BaseModel();
		$model->saveMultipleData($fieldsGeneral, $general, $fieldsListado, $listado);		
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
