<?php
require_once(PATH_MODELOS."/BaseModelo.php");

/**
 * Modelo para modulo de Reparacion
 *
 */

class ReparacionModelo {


	public function obtenerListadoReparaciones(){
		$model = new BaseModelo();		
		$sql = "select c.identificacion, concat(c.nombres, ' ', c.apellidos) as cliente, e.nombre, concat(t.nombres, ' ' , t.apellidos) as tecnico, r.fecha_ingreso, r.observacion, es.nombre as estado, es.id as estado_id, r.id 
				from cliente as c
				inner join reparacion as r on r.cliente_id = c.id
				inner join usuario as t on r.tecnico_id =  t.id
				inner join equipo as e on r.equipo_id =  e.id
				inner join historial as h on h.reparacion_id = r.id and h.activo = 1
				inner join estado as es on h.estado_id = es.id
				where r.eliminado = 0";		
		if($_SESSION['SESSION_USER']['tipo_usuario_id']==2){
			$sql .= " and r.tecnico_id = ".$_SESSION['SESSION_USER']['id'];
		}
		$result = $model->ejecutarSql($sql);
		return $model->obtenerCampos($result);
	}
	
	public function obtenerClienteIdentificacion()
	{
		$cliente = $_GET['id'];
		$model = new BaseModelo();
		if($cliente > 0){
			$sql = "select * from cliente where identificacion = ".$cliente;
			$result = $model->ejecutarSql($sql);
			$resultArray = $model->obtenerCampos($result);
			$resultArray = $resultArray[0];
	
		} else {
			$resultArray = Array ( 'id' => 0);
		}
		
		return $resultArray;
	}
	
	public function obtenerTecnicos()
	{		
		$model = new BaseModelo();
		$sql = "select * from usuario where tipo_usuario_id = 2 and eliminado = 0";
		$result = $model->ejecutarSql($sql);
		return $model->obtenerCampos($result);
	}
	
	public function guardarReparacion($objeto)
	{
		$model = new BaseModelo();
		$equipo_id = $model->guardarDatos($objeto['equipo'], 'equipo');		
		$objeto['reparacion']['equipo_id'] = $equipo_id;
		$reparacion_id = $model->guardarDatos($objeto['reparacion'], 'reparacion');
		$objeto['historial']['reparacion_id'] = $reparacion_id;
		$model->guardarDatos($objeto['historial'], 'historial');
		return $reparacion_id;
	}
	
	public function eliminarReparacion(){
		$reparacion = $_GET['id'];
		$sql = "update reparacion set eliminado = 1 where id = ".$reparacion;
		$model = new BaseModelo();
		$result = $model->ejecutarSql($sql);
	}
	
	public function obtenerReparacion($reparacionId){
		$sql = "select c.identificacion, concat(c.nombres, ' ', c.apellidos) as cliente, e.*, concat(t.nombres, ' ' , t.apellidos) as tecnico, r.fecha_ingreso, r.observacion,  r.id, h.estado_id, h.observaciones estado_final, h.fecha_registro as fecha_entrega 
				from cliente as c
				inner join reparacion as r on r.cliente_id = c.id
				inner join usuario as t on r.tecnico_id =  t.id
				inner join equipo as e on r.equipo_id =  e.id
				inner join historial as h on h.reparacion_id = r.id and h.activo = 1				
				where r.id = ".$reparacionId;

		$model = new BaseModelo();
		$result = $model->ejecutarSql($sql);
		$resultArray = $model->obtenerCampos($result);
		return $resultArray[0];
	}

	public function obtenerHistorial($reparacionId){
		$sql = "select concat(t.nombres, ' ' , t.apellidos) as tecnico, h.fecha_registro, h.observaciones, e.nombre as estado
				from  usuario as t
				inner join historial as h on h.id_usuario =  t.id
				inner join estado as e on e.id =  h.estado_id
				where h.reparacion_id = ".$reparacionId;		
		$model = new BaseModelo();
		$result = $model->ejecutarSql($sql);
		return $model->obtenerCampos($result);
	}
	
	public function guardarHistorial($historial){
		$sql = "update historial set activo = 0 where reparacion_id = ".$historial['reparacion_id'];
		$model = new BaseModelo();
		$model->ejecutarSql($sql);
		return $model->guardarDatos($historial, 'historial');		
	}
}
