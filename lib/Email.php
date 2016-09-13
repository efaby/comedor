<?php

class Email{
	
	public function sendMail($email_to,$email_subject, $message){
		$email_from = EMAIL;		
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
	
		$headers .= 'From: SISTEMA DE POSTULACIÓN DOCENTE <'.$email_from.">\r\n".
				'Reply-To: '.$email_from."\r\n" .
				'X-Mailer: PHP/' . phpversion();
		@mail($email_to, $email_subject, $message, $headers);
	}
	
	public function sendNotificacionRegistro($name,$email, $token){
		$message = '<table>
					    <tr>
					      <td>Estimado '.$name.',</td>
					    </tr>
					    <tr>
					      <td> Para poder activar su cuenta ingrese al siguiente <a target="_blank" href="http://www.merito.online/web/views/Registro/index.php?action=activarCuenta&tc='.$token.'">link</a>
					      	<br><br>
					      	La Administraci&oacute;n.
					      </td>
					    </tr>
					  </table>';
		$this->sendMail($email, "Registro en Sistema de Postulación Docente", $message);
	}
	
	public function sendNotificacionPostulacion($name,$postulacion,$email, $etapa, $calificacion, $aprobado){
		
		$afirmacion = ($aprobado==1)?'Si':'No';
		$message = '<table>
					    <tr>
					      <td>Estimado '.$name.',</td>
					    </tr>
					    <tr>
					      <td> Le informámos que sú postulación a '.$postulacion.', '.$afirmacion.' ha pasado a la etapa de '.$etapa.' con una calificación de '.$calificacion.', por favor ingrese al sistema
					      		con sus credenciales para que pueda verificar el estado de la misma. Para ingresar al sistema de click <a target="_blank" href="http://www.merito.online">aquí</a>.
					      		
					      	<br><br>
					      	La Administraci&oacute;n.
					      </td>
					    </tr>
					  </table>';
		$this->sendMail($email, "Cambio de Etapa en Postulación", $message);
	}
	
	public function sendNotificacionPostulacionInicial($name,$postulacion,$email){
		$message = '<table>
					    <tr>
					      <td>Estimado '.$name.',</td>
					    </tr>
					    <tr>
					      <td> Le informámos que se ha registrado el proceso de postulacion para '.$postulacion.' . Para seguir con mayor detalle el proceso, por favor ingresar al sistema dando click <a target="_blank" href="http://www.merito.online">aquí</a>.
					  
					      	<br><br>
					      	La Administraci&oacute;n.
					      </td>
					    </tr>
					  </table>';
		$this->sendMail($email, "Inicio de Postulación", $message);
	}
	
	public function sendRecuperacionContrasena($name,$email, $token){
		$message = '<table>
					    <tr>
					      <td>Estimado '.$name.',</td>
					    </tr>
					    <tr>
					      <td> Para poder recuperar su contrase&ntilde;a de su cuenta ingrese al siguiente <a target="_blank" href="http://www.merito.online/web/views/Secure/index.php?action=resetPassword&tc='.$token.'">link</a>
					      	<br><br>
					      	La Administraci&oacute;n.
					      </td>
					    </tr>
					  </table>';
		$this->sendMail($email, "Recuperacion Contraseña Sistema de Postulación Docente", $message);
	}
	
}