<?php
require_once(PATH_MODELS."/BaseModel.php");

class GradoModel {

	public function getlistadoGradoPersona(){
		$model = new BaseModel();	
		$sql = "select g.*, t.nombre as tipo from grado_persona as g
				inner join tipo_persona as t on t.id = g.tipo_persona_id
				where g.activo = 1";		
		return $model->execSql($sql, array(),true);
	}	
	
	public function getGradoPersona()
	{
		$grado = $_GET['id'];
		$model = new BaseModel();		
		if($grado > 0){
			$sql = "select * from grado_persona where id = ?";
			$result = $model->execSql($sql, array($grado));				
		} else {
			$result = (object) array('id'=>0,'nombre'=>'','descripcion'=>'','abreviatura'=>'', 'tipo_persona_id' =>0);			
		}
		
		return $result;
	}
	
	
	public function saveGradoPersona($grado)
	{
		$model = new BaseModel();
		return $model->saveDatos($grado,'grado_persona');
	}
	
	public function delGradoPersona(){
		$grado = $_GET['id'];
		$sql = "update grado_persona set activo = 0 where id = ?";
		$model = new BaseModel();
		$result = $model->execSql($sql, array($grado),false,true);
	}

	public function getTipoPersona(){
		$model = new BaseModel();
		return $model->getCatalogo('tipo_persona');
	}
}
