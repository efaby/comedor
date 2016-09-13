<?php $title = "Listado Reparaciones";?>
<?php include_once PATH_TEMPLATE.'/header.php';?>

<!-- Main row -->
<div class="row">
	<div class="col-lg-12">
    	<h1 class="page-header">Reparaciones</h1>
   	</div>
</div>
<?php if (isset($_SESSION['message'])&& ($_SESSION['message'] != '')):?>
		<div class="alert alert-success fade in alert-dismissable">
				<button type="button" class="close" data-dismiss="alert"
					aria-hidden="true">&times;</button>
								  <?php echo $_SESSION['message'];$_SESSION['message'] = ''?>
								</div>
		<?php endif;?>
<div class="row">
<?php if($_SESSION['SESSION_USER']['tipo_usuario_id']!=2):?>
	<p>
		<button class="btn btn-primary" id="modalOpen" onclick="location.href='../editar/'">
			<i class="glyphicon glyphicon-plus"></i> Añadir
		</button>
	</p>
	<?php endif;?>
	<table class="table table-striped table-bordered table-hover" id="dataTables-example">
    <thead>
	    <tr>
	    <th>Ticket</th>
		    <th>Cliente</th>
		    <th>Equipo</th>
		    <th>Motivo de Ingreso</th>
		    <?php if($_SESSION['SESSION_USER']['tipo_usuario_id']!=2):?>
		    <th>Técnico</th>
		    <?php endif;?>
		    <th>Fecha Ingreso</th>
		    <th>Estado</th>
		    <th style="text-align: center;">Acciones</th>
	    </tr>
    </thead>
    <tbody>
    	<?php foreach ($datos as $item) :
    		echo "<tr><td>TR-".str_pad($item['id'], 4, '0', STR_PAD_LEFT)."</td>";
    		echo "<td>".$item['cliente']."</td>";
    		echo "<td>".$item['nombre']."</td>";
    		echo "<td>".$item['observacion']."</td>";
    		if($_SESSION['SESSION_USER']['tipo_usuario_id']!=2):
    		echo "<td>".$item['tecnico']."</td>";
    		endif;
    		echo "<td>".$item['fecha_ingreso']."</td>";
    		echo "<td>".$item['estado']."</td>";
    		echo "<td align='center'>";
    		if($_SESSION['SESSION_USER']['tipo_usuario_id']==2):
    			$disabled = ($item['estado_id'] == 1)?"":"disabled";
	    		echo "<a href='javascript: loadModal(".$item['id'].")' class='btn btn-primary btn-sm ".$disabled."' title='Diagnosticar' ><i class='fa fa-pencil'></i></a>";
	    		$disabled = ($item['estado_id'] == 2)?"":"disabled";
	    		echo "&nbsp;<a href='javascript: loadModal(".$item['id'].")' class='btn btn-success btn-sm ".$disabled."' title='Reparar' ><i class='fa fa-wrench'></i></a>";
    		else:   
    			$disabled = ($item['estado_id'] == 3)?"":"disabled";
				echo "&nbsp;<a href='javascript: loadModal(".$item['id'].")' class='btn btn-warning btn-sm ".$disabled."' title='Entregar' ><i class='fa fa-check'></i></a>";
				$disabled = ($item['estado_id'] == 1)?"":"disabled";
				echo "&nbsp;<a href='javascript:if(confirm(\"Está seguro que desea eliminar el elemento seleccionado?\")){redirect(".$item['id'].");}' class='btn btn-danger btn-sm ".$disabled."' title='Eliminar'><i class='fa fa-trash'></i></a>";
    		endif;
    		
			echo "</td>";
    	endforeach;
    	?>
    </tbody>
    </table>
</div>
<div class="modal fade" id="confirm-submit" tabindex="-1" role="dialog"
	aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" style="width: 800px;" >
		<div class="modal-content">
			<div class="modal-header">
				<a class="close" data-dismiss="modal">×</a>
				<h3>Reparación de Equipo</h3>
			</div>

			<div class="modal-body"></div>

		</div>

	</div>
</div>
<?php include_once PATH_TEMPLATE.'/footer.php';?>   
<link href="<?php echo PATH_CSS; ?>/dataTables.bootstrap.css" rel="stylesheet">
<script src="<?php echo PATH_JS; ?>/jquery.dataTables.min.js"></script>
<script src="<?php echo PATH_JS; ?>/dataTables.bootstrap.min.js"></script>
<script src="<?php echo PATH_JS; ?>/table.js"></script>
<script src="<?php echo PATH_JS; ?>/bootstrapValidator.min.js"></script>
<link href="<?php echo PATH_CSS; ?>/bootstrapValidator.min.css" rel="stylesheet">
<script type="text/javascript">
function loadModal(id){
	$('.modal-body').load('../cambioEstado/' + id,function(result){
	    $('#confirm-submit').modal({show:true});
	});
}

function redirect(id){
	var url = '../eliminar/' + id;
	location.href = url;
}

</script>
</body>
</html>