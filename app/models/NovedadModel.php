<?php
require_once(PATH_MODELS."/BaseModel.php");

class NovedadModel {

	public function getlistadoNovedad($unidad_id){
		$model = new BaseModel();	
		$sql = "select n.*, p.nombres, p.apellidos, p.identificacion, t.nombre from novedad as n
				inner join persona as p on p.id = n.persona_id
				inner join tipo_novedad as t on t.id = n.tipo_novedad_id
				where n.activo = 1 and (p.unidad_id = ? or 0 = ?)";		
		return $model->execSql($sql, array($unidad_id,$unidad_id),true);
	}	
	
	public function getNovedad()
	{
		$novedad = $_GET['id'];
		$model = new BaseModel();		
		if($novedad > 0){
			$sql = "select n.*, p.identificacion, p.nombres, p.apellidos from novedad as n
					inner join persona as p on p.id = n.persona_id
					where n.id = ?";
			$result = $model->execSql($sql, array($novedad));				
		} else {
			$result = (object) array('id'=>0,'persona_id'=>0,'tipo_novedad_id'=>0,'fecha_inicio'=>'', 'fecha_fin'=>'', 'identificacion' => '','nombres'=>'' , 'url' => '');			
		}
		
		return $result;
	}
	
	
	public function saveNovedad($novedad)
	{
		$model = new BaseModel();
		return $model->saveDatos($novedad,'novedad');
	}
	
	public function delNovedad(){
		$novedad = $_GET['id'];
		$sql = "update novedad set activo = 0 where id = ?";
		$model = new BaseModel();
		$result = $model->execSql($sql, array($novedad),false,true);
	}

	public function getTiposNovedad(){
		$model = new BaseModel();
		return $model->getCatalogo('tipo_novedad');
	}
}
