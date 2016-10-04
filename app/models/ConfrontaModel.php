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
	
	public function getlistadoConfrontaHoy($unidad){
		$model = new BaseModel();
		$sql = "select c.* from confronta_general as c				
				where unidad_id = ? and fecha_registro = ?";
		return $model->execSql($sql, array($unidad,date('Y-m-d')),true);
	}
	
	public function getListadoPersonaUnidad($unidad,$confronta){

		$model = new BaseModel();
		$parametros =  array($unidad);
		if($confronta>0){
			$sql = "select p.*, g.abreviatura as grado, g.tipo_persona_id as tipo, t.nombre, n.url, n.id as novedad, c.almuerzo, c.desayuno, c.merienda from persona as p
				inner join grado_persona as g on g.id = p.grado_persona_id
				left join confronta as c on c.persona_id = p.id
				left join novedad as n on n.id = c.novedad_id
                left join tipo_novedad as t on t.id = n.tipo_novedad_id				
				where p.unidad_id = ? and c.confronta_general_id = ?";		
			$parametros[] = $confronta;
		} else {
			$sql = "select p.*, g.abreviatura as grado, g.tipo_persona_id as tipo, t.nombre, n.id as novedad, 1 as almuerzo, 1 as desayuno, 1 as merienda from persona as p
				inner join grado_persona as g on g.id = p.grado_persona_id
				left join novedad as n on p.id = n.persona_id and ('".date('Y-m-d')."' between n.fecha_inicio and n.fecha_fin) and n.activo = 1
                left join tipo_novedad as t on t.id = n.tipo_novedad_id				
				where p.unidad_id = ?";
		}
        $sql .= " group by p.id";

		return $model->execSql($sql, $parametros,true);
	}
	
	public function saveConfronta($fieldsGeneral, $general, $fieldsListado, $listado){
		$model = new BaseModel();
		$model->saveMultipleData($fieldsGeneral, $general, $fieldsListado, $listado);		
	}	
	
	public function updateConfronta($fieldsGeneral, $general, $fieldsListado, $listado,$confrontaId){
		$model = new BaseModel();
		$model->updateMultipleData($fieldsGeneral, $general, $fieldsListado, $listado, $confrontaId);
	}
	
	public function getGeneral($confronta){
		
		$model = new BaseModel();		
		if($confronta > 0){
			$sql = "select g.*, u.abreviatura as unidad from confronta_general as g
					inner join unidad as u on g.unidad_id =  u.id
					where g.id = ?";
			$result = $model->execSql($sql, array($confronta));				
		} else {
			$result = null;
		}
		
		return $result;
	}
	
	public function getUnidad($unidad){
		$model = new BaseModel();
		$sql = "select * from unidad where id = ?";
		return $model->execSql($sql, array($unidad));
	}
	
	public function delConfronta($confrontaId){
		
		$model = new BaseModel();
		$model->deleteMultipleData($confrontaId);
	}	
	
	public function getlistadoConsolidado($fecha){
		$model = new BaseModel();
		$sql = "select c.*, u.abreviatura as unidad from confronta_general as c
				inner join unidad as u on u.id = c.unidad_id
				where c.fecha_registro = ?";
		return $model->execSql($sql, array($fecha),true);
	}

}
