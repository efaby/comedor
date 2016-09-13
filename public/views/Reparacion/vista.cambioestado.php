<div class="table-responsive">
		<div class="col-sm-12 rows">
			<table class="table table-th-block table-bordered tabla">				
				<tbody>
				<tr><th colspan="2"></th><th width="20%">No. Ticket:</th><th width="20%"><span style="font-size: 20px;"><?php echo 'TR-'.str_pad($reparacion['id'], 4, '0', STR_PAD_LEFT); ?></span></th></tr>
				<tr><td width="20%">Cliente:</td><td colspan="3"><?php echo $reparacion['cliente']?></td></tr>				
				<tr><td>Equipo:</td><td><?php echo $reparacion['nombre']?></td><td>Serie:</td><td><?php echo $reparacion['numero_serie'];?></td></tr>
				<tr><td>Marca:</td><td><?php echo $reparacion['marca']?></td><td>Modelo:</td><td><?php echo $reparacion['modelo'];?></td></tr>
				<tr><td>Observación Equipo:</td><td colspan="3"><?php echo $reparacion['observaciones']?></td></tr>	
				<tr><td>Técnico</td><td><?php echo $reparacion['tecnico']?></td><td>Fecha Ingreso:</td><td><?php echo $reparacion['fecha_ingreso'];?></td></tr>					
				<tr><td>Motivo de Ingreso:</td><td colspan="3"><?php echo $reparacion['observacion']?></td></tr>						
				</tbody>
			</table>
		</div>
		<div class="col-sm-12 rows">
		<label class="control-label">Historial de Reparación</label> 		
			<table class="table table-th-block table-bordered tabla">				
				<tr>
					<th>Estado</th>
					<th>Fecha</th>
					<th>Técnico</th>
					<th>Observaciones</th>
				</tr>
				
				<?php foreach ($historial as $item) {
					echo "<tr><td>".$item['estado']."</td>";
					echo "<td>".$item['fecha_registro']."</td>";
					echo "<td>".$item['tecnico']."</td>";
					echo "<td>".$item['observaciones']."</td></tr>";
				}?>				
				
			</table>
		</div>
	</div>
<!-- /.table-responsive -->

<form action="" method="post" id="frmHistorial" enctype="multipart/form-data">
	<div class="form-group col-sm-12">
		<label class="control-label"><?php echo $estado;?></label> 
		<textarea name='observaciones' id='observaciones' class='form-control' ></textarea>			
	</div>
	
	<div class="form-group" style="padding-left: 15px;">
		<input type='hidden' name='reparacion_id' class='form-control' value="<?php echo $reparacion['id']; ?>">
		<input type='hidden' name='estado_id' class='form-control' value="<?php echo $estado_id; ?>">
		<button type="submit" class="btn btn-success">Guardar</button>
	</div>
				</form>
<script type="text/javascript">
$(document).ready(function() {
    $('#frmHistorial').bootstrapValidator({
    	message: 'This value is not valid',
		feedbackIcons: {
			validating: 'glyphicon glyphicon-refresh'
		},
		fields: {		
			observaciones: {
						message: 'La Observación no es válida',
						validators: {	
							notEmpty: {
								message: 'La Observación no puede ser vacía.'
							},											
									regexp: {
										regexp: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9 \.]+$/,
										message: 'Ingrese una observación válida.'
									}
								}
							},		
			
			
		},
		submitHandler: function(validator, form, submitButton) {
			$.ajax({
		           type: "POST",
		           dataType: "json",
		           url: '../guardarCambioEstado/',
		           data: $("#frmHistorial").serialize(), 
		           success: function(data){
		        	   var $jQuery=window.parent.$;
		                $jQuery('body').find('.close').trigger('click');					           
			           if(data.estado == 4){
			        	   var posicion_x; 
			        		var posicion_y; 
			        		var ancho = 800;
			        		var alto = 450;
			        		posicion_x=(screen.width/2)-(ancho/2); 
			        		posicion_y=(screen.height/2)-(alto/2); 
			        		var accion = "../imprimir/"+data.id;
			        		var opciones="toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width="+ancho+",height="+alto+",left="+posicion_x+",top="+posicion_y;
			        		window.open(accion,"",opciones);
			           } else {
			        	   window.location.href ='../listar/';
			           }				           
		           }
		         });
	         return false;
		}
	});

});
</script>
<style>
<!--
.tabla > thead > tr > th, .tabla > tbody > tr > td {
	padding: 0 5px;
}
-->
</style>
