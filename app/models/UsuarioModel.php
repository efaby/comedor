<?php
require_once(PATH_MODELS."/BaseModel.php");

class UsuarioModel {

	private $pattern = "------";
	
	public function getlistadoUsuario(){
		$model = new BaseModel();	
		$sql = "select u.*, n.abreviatura as unidad, t.nombre, p.nombres, p.apellidos from usuario as u
				inner join tipo_usuario as t on t.id = u.tipo_usuario_id
				inner join persona as p on p.id = u.persona_id
				left join unidad as n on n.id = u.unidad_id
				where u.activo = 1";		
		return $model->execSql($sql, array(),true);
	}	
	
	public function getUsuario()
	{
		$usuario = $_GET['id'];
		$model = new BaseModel();		
		if($usuario > 0){
			$sql = "select * from usuario where id = ?";
			$result = $model->execSql($sql, array($unidad));
			$result->password = $result->password1 = $this->pattern;
		} else {
			$result = (object) array('id'=>0,'persona_id'=>0,'unidad_id'=>0,'usuario'=>'', 'password'=>'', 'password1'=>'','identificacion' =>'','nombres'=>'','tipo_usuario_id'=>0);			
		}
		
		return $result;
	}
	
	
	public function saveUsuario($usuario){
		if((($usuario['id']>0) && ($usuario['password']!=$this->patron))||($usuario['id']==0)){
			$usuario['password'] =  md5($usuario['password']);
		} else {
			unset($usuario['password']);
		}
		$model = new BaseModel();
		return $model->saveDatos($unidad,'unidad');
	}
	
	public function delUsuario(){
		$unidad = $_GET['id'];
		$sql = "update usuario set activo = 0 where id = ?";
		$model = new BaseModel();
		$result = $model->execSql($sql, array($unidad),false,true);
	}

	public function getCatalogo($tabla){
		$model = new BaseModel();
		return $model->getCatalogo($tabla);
	}
}
