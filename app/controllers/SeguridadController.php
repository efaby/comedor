<?php
require_once(PATH_MODELS."/SeguridadModel.php");

/**
 * Controlador de Usuarios
 *
 */
class SeguridadController {
	
	public function login(){
		require_once PATH_VIEWS."/Seguridad/view.login.php";
	}
}