<?php
require_once(PATH_MODELS."/BaseModel.php");

class PersonaModel {

	public function getlistadoPersona($unidad_id){
		$model = new BaseModel();	
		$sql = "select p.id, p.identificacion, p.nombres, p.apellidos, p.arma, u.abreviatura as unidad, g.abreviatura as grado, t.nombre from persona as p 
				inner join unidad as u on u.id = p.unidad_id
				inner join grado_persona as g on g.id = p.grado_persona_id
				inner join tipo_persona as t on t.id = g.tipo_persona_id
				where p.activo = 1 and (u.id = ? or 0 = ?)";		
		return $model->execSql($sql, array($unidad_id,$unidad_id),true);
	}	
	
	public function getPersona()
	{
		$unidad = $_GET['id'];
		$model = new BaseModel();		
		if($unidad > 0){
			$sql = "select * from persona where id = ?";
			$result = $model->execSql($sql, array($unidad));				
		} else {
			$result = (object) array('id'=>0,'tipo_persona_id'=>0,'grado_persona_id'=>0,'unidad_id'=>0,'identificacion'=>'','nombres'=>'','apellidos'=>'','arma'=>'', 'telefono'=>'','celular'=>'');			
		}
		
		return $result;
	}
	
	public function getCatalogo($tabla){
		$model = new BaseModel();
		return $model->getCatalogo($tabla);
	}
	
	public function savePersona($persona)
	{
		$model = new BaseModel();
		return $model->saveDatos($persona,'persona');
	}
	
	public function delPersona(){
		$persona = $_GET['id'];
		$sql = "update persona set activo = 0 where id = ?";
		$model = new BaseModel();
		$result = $model->execSql($sql, array($persona),false,true);
	}
	
	public function getPersonaPorCedula($cedula){
		$model =  new BaseModel();
		$sql = "select * from persona where identificacion = ? ";
		return $model->execSql($sql, array($cedula));
	}
	
}
