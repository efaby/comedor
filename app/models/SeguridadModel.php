<?php
require_once(PATH_MODELS."/BaseModel.php");

/**
 * Modelo para modulo de Usuarios
 * 
 *
 */
class SeguridadModel {

	public function validarUsuario($login, $password){
		$model = new BaseModel();
		$sql = "select u.id, p.nombres, p.apellidos, u.usuario, u.tipo_usuario_id as tipo , t.clave, u.unidad_id
				from usuario as u
				inner join persona as p on p.id = u.persona_id
				inner join tipo_usuario as t on t.id = u.tipo_usuario_id
				where u.usuario= '".$login."' and u.password = '".md5($password)."' and u.activo = 1 and p.activo = 1";
	
		return $model->execSql($sql, array($login,$password));
	}
	
	public function cambiarContrasena($passwd,$user){
		$sql = "update usuario set password = md5('".$passwd."') where id = ".$user;
		$model =  new BaseModel();
		return $model->execSql($sql, array($passwd,$user),false,true);
	}
	
	
}
