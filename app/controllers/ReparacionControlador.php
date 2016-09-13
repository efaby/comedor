<?php
require_once (PATH_MODELOS . "/ReparacionModelo.php");
/**
 * Controlador de Reparacion
 */
class ReparacionControlador {
	
	public function listar() {
		$model = new ReparacionModelo();
		$datos = $model->obtenerListadoReparaciones();
		$message = "";
		require_once PATH_VISTAS."/Reparacion/vista.listado.php";
	}
	
	public function editar(){
		$model = new ReparacionModelo();
		$tecnicos = $model->obtenerTecnicos();
		$message = "";
		require_once PATH_VISTAS."/Reparacion/vista.formulario.php";
	}
	
	public function buscarCliente(){
		$model = new ReparacionModelo();
		echo json_encode($model->obtenerClienteIdentificacion());
		exit();
	}
	
	public function guardar() {
		
		$equipo ['numero_serie'] = $_POST ['numero_serie'];
		$equipo ['nombre'] = $_POST ['nombre'];
		$equipo ['marca'] = $_POST ['marca'];
		$equipo ['modelo'] = $_POST ['modelo'];
		$equipo ['observaciones'] = $_POST ['observacion'];
		
		$reparacion['tecnico_id'] = $_POST['tecnico_id'];
		$reparacion['cliente_id'] = $_POST['cliente_id'];
		$reparacion['fecha_ingreso'] = $_POST['fecha'];
		$reparacion['fecha_registro'] = $historial['fecha_registro'] = date('y-m-d');		
		$reparacion['id_usuario'] = $historial['id_usuario'] = 1; //Sesion
		$reparacion['observacion'] = $historial['observaciones'] = $_POST['observaciones'];
		
		$historial['estado_id'] = 1;
		$historial['activo'] = 1;
		
		$objeto['equipo'] = $equipo;
		$objeto['reparacion'] = $reparacion;
		$objeto['historial'] = $historial;
		
		$model = new ReparacionModelo();
		try {
			$reparacionId = $model->guardarReparacion($objeto);					
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
		}
		echo json_encode($reparacionId);
		exit();
	}
	
	public function eliminar() {
		$model = new ReparacionModelo();
		try {
			$datos = $model->eliminarReparacion();
			$_SESSION ['message'] = "Datos eliminados correctamente.";
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
		}
		header ( "Location: ../listar/" );
	}
	
	public function imprimir(){
		$reparacionId = $_GET['id'];
		$model = new ReparacionModelo();
		$reparacion = $model->obtenerReparacion($reparacionId);
		require_once PATH_VISTAS."/Reparacion/vista.imprimir.php";
	}
	
	public function cambioEstado(){
		$reparacionId = $_GET['id'];
		$model = new ReparacionModelo();
		$reparacion = $model->obtenerReparacion($reparacionId);
		if($reparacion['estado_id']== 1){
			$estado = 'Diagnostico del Equipo';
			$estado_id = 2;
		} else {
			if($reparacion['estado_id']== 2){
				$estado = 'Reparación del Equipo';
				$estado_id = 3;
			} else {
				$estado = 'Entrega del Equipo';
				$estado_id = 4;
			}
		}
		$historial = $model->obtenerHistorial($reparacionId);
		require_once PATH_VISTAS."/Reparacion/vista.cambioestado.php";
	}
	public function guardarCambioEstado(){
		$reparacion['id'] =$historial['reparacion_id'] = $_POST ['reparacion_id'];
		$reparacion['estado'] = $historial['estado_id'] = $_POST ['estado_id'];
		$historial['observaciones'] = $_POST['observaciones'];
		$historial['activo'] = 1;
		$historial['fecha_registro'] = date('y-m-d');
		$historial['id_usuario'] = 1; //Sesion
		$model = new ReparacionModelo();
		try {
			$model->guardarHistorial($historial);	
			$_SESSION ['message'] = "Datos almacenados correctamente.";
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
		}
		echo json_encode($reparacion);
		exit();
	}
	
}
