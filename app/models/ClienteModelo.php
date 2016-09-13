<?php
require_once(PATH_MODELOS."/BaseModelo.php");

/**
 * Modelo para modulo de Clientes
 * 
 *
 */
class ClienteModelo {
	
	public function obtenerListadoClientes(){
		$model = new BaseModelo();		
		$sql = "select *  from cliente where eliminado = 0";		
		$result = $model->ejecutarSql($sql);
		return $model->obtenerCampos($result);
	}		
	
	public function obtenerCliente()
	{
		$cliente = $_GET['id'];
		$model = new BaseModelo();	
		if($cliente > 0){
			$sql = "select * from cliente where id = ".$cliente;
			$result = $model->ejecutarSql($sql);
			$resultArray = $model->obtenerCampos($result);
			$resultArray = $resultArray[0];
				
		} else {
			$resultArray = Array ( 'id' => '' ,'identificacion' => '','nombres' => '','apellidos' => '','email' => '','direccion' => '','telefono' => '', 'celular' => '');
		}
		
		return $resultArray;
	}
	
	public function guardarCliente($cliente)
	{
		$model = new BaseModelo();
		return $model->guardarDatos($cliente, 'cliente');
	}
	
	public function eliminarCliente(){
		$cliente = $_GET['id'];
		$sql = "update cliente set eliminado = 1 where id = ".$cliente;
		$model = new BaseModelo();
		$result = $model->ejecutarSql($sql);
	}
	

}
