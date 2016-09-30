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
	
	

}
