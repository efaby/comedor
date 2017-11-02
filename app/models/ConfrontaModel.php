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
	
	public function getlistadoConfrontaGetId($id){
		$model = new BaseModel();
		$sql = "select c.* from confronta_general as c
				where id = ?";
		return $model->execSql($sql, array($id),true);
	}
	
	public function getlistadoConfrontaFecha($unidad,$fecha){
		$model = new BaseModel();
		$sql = "select c.* from confronta_general as c
				where unidad_id = ? and fecha_acceso = ?";
		return $model->execSql($sql, array($unidad,$fecha),true);
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
       // $sql .= " group by p.id";

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
	
	public function getlistadoConsolidado($fecha, $unidad){
		$model = new BaseModel();
		$sql = "select c.*, u.abreviatura as unidad from confronta_general as c
				inner join unidad as u on u.id = c.unidad_id
				where c.fecha_acceso = ? and (0 = ? or c.unidad_id = ?)" ;
		return $model->execSql($sql, array($fecha,$unidad,$unidad),true);
	}
	
	public function getReporteConsolidado($fecha){
		$model = new BaseModel();
		$sql = "SELECT c.unidad_id, u.abreviatura as unidad,
				sum(c.desayuno_ofi) as desayuno_ofi,
				sum(c.desayuno_vol) as desayuno_vol,
				sum(c.desayuno_con) as desayuno_con,
				sum(c.almuerzo_ofi) as almuerzo_ofi,
				sum(c.almuerzo_vol) as almuerzo_vol,
				sum(c.almuerzo_con) as almuerzo_con,
				sum(c.merienda_ofi) as merienda_ofi,
				sum(c.merienda_vol) as merienda_vol,
				sum(c.merienda_con) as merienda_con,
				sum(c.costo_desayuno * (c.desayuno_ofi + c.desayuno_vol + c.desayuno_con)) as costo_desayuno,
				sum(c.costo_almuerzo * (c.almuerzo_ofi + c.almuerzo_vol + c.almuerzo_con)) as costo_almuerzo,
				sum(c.costo_merienda * (c.merienda_ofi + c.merienda_vol + c.merienda_con)) as costo_merienda
 				FROM comedor.confronta_general as c
 							inner join unidad as u on u.id = c.unidad_id
 				where date_format(c.fecha_acceso, '%Y-%m') = ?
 				group by c.unidad_id, date_format(c.fecha_acceso, '%Y-%m')";
		return $model->execSql($sql, array($fecha),true);
	}

	public function getListadoPersonasAcceso(){

		$model = new BaseModel();
		$sql = "select p.*, g.abreviatura as grado, g.tipo_persona_id as tipo, t.nombre, n.url, n.id as novedad, c.almuerzo, c.desayuno, c.merienda, u.nombre as unidad from persona as p
				inner join grado_persona as g on g.id = p.grado_persona_id
				inner join unidad as u on u.id = p.unidad_id
				left join confronta as c on c.persona_id = p.id
				left join novedad as n on n.id = c.novedad_id
                left join tipo_novedad as t on t.id = n.tipo_novedad_id	
                inner join confronta_general as cg on cg.id = c.confronta_general_id			
				where p.activo = 1 and cg.fecha_acceso = ?";	

		return $model->execSql($sql, array(date('Y-m-d')),true);
	}

	
}
