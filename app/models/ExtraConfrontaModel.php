<?php
require_once(PATH_MODELS."/BaseModel.php");

class ExtraConfrontaModel {

	public function getlistadoExtraConfronta(){
		$model = new BaseModel();	
		$sql = "select c.*, p.nombres, p.apellidos, p.identificacion, u.abreviatura as unidad
				from extra_confronta as c 
				inner join persona as p on p.id = c.persona_id
				inner join unidad as u on u.id = p.unidad_id
				order by id desc";		
		return $model->execSql($sql, array(),true);
	}	
	
	public function getExtraConfronta(){
		$item = $_GET['id'];
		$model = new BaseModel();		
		if($item > 0){
			$sql = "select c.*, p.nombres, p.apellidos, p.identificacion
					from extra_confronta as c 
					inner join persona as p on p.id = c.persona_id
					where c.id = ?";
			$result = $model->execSql($sql, array($item));				
		} else {
			$result = (object) array('id'=>0,'persona_id'=>'','tipo_servicio'=>'','identificacion'=>'','nombres'=>'','apellidos'=>'');			
		}
		
		return $result;
	}
	
	
	public function saveExtraConfronta($item){
		$model = new BaseModel();
		return $model->saveDatos($item,'extra_confronta');
	}
	
	public function delExtraConfronta(){
		$item = $_GET['id'];
		$sql = "delete from extra_confronta where id = ?";
		$model = new BaseModel();
		$result = $model->execSql($sql, array($item),false,true);
	}
	
	public function getExtraConfrontaByPersona($usuario,$fechaInicio,$fechaFin){
		$model = new BaseModel();
		$sql = "select persona_id, tipo_servicio, count(id) as cantidad, sum(precio) as valor, date_format(c.fecha, '%Y-%m') as fecha
				from extra_confronta as c	
				where c.persona_id = ? and fecha >= ? and fecha <= ?
				group by persona_id, date_format(c.fecha, '%Y-%m'),tipo_servicio
				";
		return $model->execSql($sql, array($usuario,$fechaInicio,$fechaFin),true);
	}
	
	public function getExtraConfrontaListado($fecha,$unidad){
		$model = new BaseModel();
		$sql = "SELECT c.persona_id, p.identificacion, p.nombres, p.apellidos, p.arma, g.abreviatura as grado,
					SUM(case when c.tipo_servicio = 1 then 1 else 0 end)  as desayuno,
 					SUM(case when c.tipo_servicio = 2 then 1 else 0 end)  as almuerzo,
 					SUM(case when c.tipo_servicio = 3 then 1 else 0 end)  as merienda,
 					SUM(case when c.tipo_servicio = 1 then c.precio else 0 end)  as costo_desayuno,
 					SUM(case when c.tipo_servicio = 2 then c.precio else 0 end)  as costo_almuerzo,
 					SUM(case when c.tipo_servicio = 3 then c.precio else 0 end)  as costo_merienda		
 				FROM extra_confronta as c
 							inner join persona as p on p.id = c.persona_id
 							inner join grado_persona as g on g.id = p.grado_persona_id 							
 				where date_format(c.fecha, '%Y-%m') = ? and p.unidad_id = ?
 				group by persona_id, date_format(c.fecha, '%Y-%m')";
		return $model->execSql($sql, array($fecha,$unidad),true);
	}	
	
	public function getExtraConfrontaUnidades($fecha){
		$model = new BaseModel();
		$sql = "SELECT p.unidad_id, u.abreviatura as unidad,
					SUM(case when c.tipo_servicio = 1 then 1 else 0 end)  as desayuno,
 					SUM(case when c.tipo_servicio = 2 then 1 else 0 end)  as almuerzo,
 					SUM(case when c.tipo_servicio = 3 then 1 else 0 end)  as merienda,
 					SUM(case when c.tipo_servicio = 1 then c.precio else 0 end)  as costo_desayuno,
 					SUM(case when c.tipo_servicio = 2 then c.precio else 0 end)  as costo_almuerzo,
 					SUM(case when c.tipo_servicio = 3 then c.precio else 0 end)  as costo_merienda
 				FROM extra_confronta as c
 					inner join persona as p on p.id = c.persona_id 	
					inner join unidad as u on u.id = p.unidad_id
 				where date_format(c.fecha, '%Y-%m') = ? 
 				group by unidad_id, date_format(c.fecha, '%Y-%m')";
		return $model->execSql($sql, array($fecha),true);
	}
	
	
}
