<?php
require_once(PATH_MODELS."/BaseModel.php");

class ConsumoModel {

	private $opcion = 1;
	public function getConsumo($usuario,$fechaInicio,$fechaFin,$unidad){
		$model = new BaseModel();	
		$sql = "SELECT c.persona_id,
					date_format(c.fecha_acceso, '%Y-%m') as fecha,
					SUM(case when c.desayuno = ".$this->opcion." then 1 else 0 end)  as desayuno,
 					SUM(case when c.almuerzo = ".$this->opcion." then 1 else 0 end)  as almuerzo,
 					SUM(case when c.merienda = ".$this->opcion." then 1 else 0 end)  as merienda,
 					SUM(case when c.desayuno = ".$this->opcion." then g.costo_desayuno else 0 end)  as costo_desayuno,
 					SUM(case when c.almuerzo = ".$this->opcion." then g.costo_almuerzo else 0 end)  as costo_almuerzo,
 					SUM(case when c.merienda = ".$this->opcion." then g.costo_merienda else 0 end)  as costo_merienda
 				FROM comedor.confronta as c
 							inner join confronta_general as g on g.id = c.confronta_general_id
 				where c.fecha_acceso >= ? and c.fecha_acceso  <= ? and (0 = ? or c.persona_id = ?) and c.unidad_id = ?
 				group by c.persona_id, date_format(c.fecha_acceso, '%Y-%m')";		
		return $model->execSql($sql, array($fechaInicio,$fechaFin,$usuario,$usuario,$unidad),true);
	}	
	
	public function getConsumoListado($fechaInicio,$unidad){
		$model = new BaseModel();
		$sql = "SELECT c.persona_id, p.identificacion, p.nombres, p.apellidos, p.arma, g.abreviatura as grado,
					date_format(c.fecha_acceso, '%Y-%m') as fecha,
					SUM(case when c.desayuno = ".$this->opcion." then 1 else 0 end)  as desayuno,
 					SUM(case when c.almuerzo = ".$this->opcion." then 1 else 0 end)  as almuerzo,
 					SUM(case when c.merienda = ".$this->opcion." then 1 else 0 end)  as merienda,
 					SUM(case when c.desayuno = ".$this->opcion." then cg.costo_desayuno else 0 end)  as costo_desayuno,
 					SUM(case when c.almuerzo = ".$this->opcion." then cg.costo_almuerzo else 0 end)  as costo_almuerzo,
 					SUM(case when c.merienda = ".$this->opcion." then cg.costo_merienda else 0 end)  as costo_merienda
 				FROM comedor.confronta as c
 							inner join persona as p on p.id = c.persona_id
 							inner join grado_persona as g on g.id = p.grado_persona_id
 							inner join confronta_general as cg on cg.id = c.confronta_general_id
 				where date_format(c.fecha_acceso, '%Y-%m') = ? and c.unidad_id = ?
 				group by c.persona_id, date_format(c.fecha_acceso, '%Y-%m')";
		return $model->execSql($sql, array($fechaInicio,$unidad),true);
	}
	
	

}
