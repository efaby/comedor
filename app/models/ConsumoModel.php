<?php
require_once(PATH_MODELS."/BaseModel.php");

class ConsumoModel {

	private $opcion = 1;
	public function getConsumo($usuario,$fechaInicio,$fechaFin){
		$model = new BaseModel();	
		$sql = "SELECT persona_id,
					date_format(fecha_acceso, '%Y-%m') as fecha,
					SUM(case when desayuno = ".$this->opcion." then 1 else 0 end)  as desayuno,
 					SUM(case when almuerzo = ".$this->opcion." then 1 else 0 end)  as almuerzo,
 					SUM(case when merienda = ".$this->opcion." then 1 else 0 end)  as merienda
 				FROM comedor.confronta
 				where fecha_acceso >= ? and fecha_acceso  <= ? and (0 = ? or persona_id = ?)
 				group by persona_id, date_format(fecha_acceso, '%Y-%m')";		
		return $model->execSql($sql, array($fechaInicio,$fechaFin,$usuario,$usuario),true);
	}	
	
	public function getConsumoListado($fechaInicio){
		$model = new BaseModel();
		$sql = "SELECT c.persona_id, p.identificacion, p.nombres, p.apellidos, p.arma, g.abreviatura as grado,
					date_format(c.fecha_acceso, '%Y-%m') as fecha,
					SUM(case when c.desayuno = ".$this->opcion." then 1 else 0 end)  as desayuno,
 					SUM(case when c.almuerzo = ".$this->opcion." then 1 else 0 end)  as almuerzo,
 					SUM(case when c.merienda = ".$this->opcion." then 1 else 0 end)  as merienda
 				FROM comedor.confronta as c
 							inner join persona as p on p.id = c.persona_id
 							inner join grado_persona as g on g.id = p.grado_persona_id
 				where date_format(c.fecha_acceso, '%Y-%m') = ? 
 				group by c.persona_id, date_format(c.fecha_acceso, '%Y-%m')";
		return $model->execSql($sql, array($fechaInicio),true);
	}
	
	

}
