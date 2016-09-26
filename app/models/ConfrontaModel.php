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
		$sql = "select p.*, g.abreviatura as grado, g.tipo_persona_id as tipo, t.nombre, t.id as novedad, c.almuerzo, c.desayuno, c.merienda from persona as p
				inner join grado_persona as g on g.id = p.grado_persona_id
				left join novedad as n on p.id = n.persona_id and ('".date('Y-m-d')."' between n.fecha_inicio and n.fecha_fin) and n.activo = 1
                left join tipo_novedad as t on t.id = n.tipo_novedad_id
				left join confronta as c on c.persona_id = p.id
				where p.unidad_id = ?";
		$parametros =  array($unidad);
		if($confronta>0){
			$sql .= " and c.confronta_general_id = ? ";
			$parametros[] = $confronta;
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
			$sql = "select * from confronta_general where id = ?";
			$result = $model->execSql($sql, array($confronta));				
		} else {
			$result = null;
		}
		
		return $result;
	}
	
	public function delConfronta($confrontaId){
		
		$model = new BaseModel();
		$model->deleteMultipleData($confrontaId);
	}	

}
