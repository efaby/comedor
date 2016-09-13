<?php
require_once(PATH_MODELS."/BaseModel.php");

/**
 * Modelo para modulo de Usuarios
 * 
 *
 */
class UsuarioModel {
	
	private $pattern = "------";

	public function getlistadoUsuarios(){
		$model = new BaseModel();	
		$sql = "select u.id, u.identificacion, u.genero, u.nombres, u.apellidos, u.email, t.nombre as tipo_usuario from usuario as u inner join tipo_usuario as t on  u.tipo_usuario_id = t.id where eliminado = 0";		
		return $model->execSql($sql, array(),true);
	}	
	
	public function getUsuario()
	{
		$usuario = $_GET['id'];
		$model = new BaseModel();		
		if($usuario > 0){
			$sql = "select * from usuario where id = ?";
			$result = $model->execSql($sql, array($usuario));				
		} else {
			$result = new stdClass();			
		}
		$result->password = $result->password1 = $this->pattern;
		return $result;
	}
	
	public function getTipoUsuario(){
		$model = new BaseModel();			
		return $model->getCatalogo("tipo_usuario");
	}
	
	public function saveUsuario($usuario)
	{
		if((($usuario['id']>0) && ($usuario['password']!=$this->patron))||($usuario['id']==0)){
			$usuario['password'] =  md5($usuario['password']);
		} else {
			unset($usuario['password']);
		}
		$model = new BaseModel();
		return $model->saveDatos($usuario,'usuario');
	}
	
	public function delUsuario(){
		$usuario = $_GET['id'];
		$sql = "update usuario set eliminado = 1 where id = ?";
		$model = new BaseModel();
		$result = $model->execSql($sql, array($usuario),false,true);
	}

}
