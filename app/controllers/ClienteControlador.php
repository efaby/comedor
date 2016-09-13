<?php
require_once (PATH_MODELOS . "/ClienteModelo.php");
/**
 * Controlador de Clientes
 */
class ClienteControlador {
	
	public function listar() {
		$model = new ClienteModelo();
		$datos = $model->obtenerListadoClientes();
		$message = "";
		require_once PATH_VISTAS."/Cliente/vista.listado.php";
	}
	
	public function editar(){
		$model = new ClienteModelo();
		$cliente = $model->obtenerCliente();
		$message = "";
		$cliente_id = $_GET['id'];
		require_once PATH_VISTAS."/Cliente/vista.formulario.php";
	}
	
	public function guardar() {
		$cliente ['id'] = $_POST ['id'];
		$cliente ['identificacion'] = $_POST ['identificacion'];
		$cliente ['nombres'] = $_POST ['nombres'];
		$cliente ['apellidos'] = $_POST ['apellidos'];
		$cliente ['direccion'] = $_POST ['direccion'];		
		$cliente ['telefono'] = $_POST ['telefono'];		
		$cliente ['email'] = $_POST ['email'];
		$cliente ['celular'] = $_POST ['celular'];	
		$redireccion = $_POST ['redireccion'];	
		$model = new ClienteModelo();
		try {
			$datos = $model->guardarCliente( $cliente );
			$_SESSION ['message'] = "Datos almacenados correctamente.";
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
		}
		if($redireccion==-1){
			header ( "Location: ../../Reparacion/editar/" );
		} else {
			header ( "Location: ../listar/" );
		}
		
	}
	
	public function eliminar() {
		$model = new ClienteModelo();
		try {
			$datos = $model->eliminarCliente();
			$_SESSION ['message'] = "Datos eliminados correctamente.";
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
		}
		header ( "Location: ../listar/" );
	}
	
}
