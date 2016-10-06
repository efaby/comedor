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

}
