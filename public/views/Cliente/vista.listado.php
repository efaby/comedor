<?php $title = "Listado Clientes";?>
<?php include_once PATH_TEMPLATE.'/header.php';?>

<!-- Main row -->
<div class="row">
	<div class="col-lg-12">
    	<h1 class="page-header">Clientes</h1>
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
	<p>
		<button class="btn btn-primary" id="modalOpen">
			<i class="glyphicon glyphicon-plus"></i> Añadir
		</button>
	</p>
	<table class="table table-striped table-bordered table-hover" id="dataTables-example">
    <thead>
	    <tr>
	    <th>Identificación</th>
		    <th>Nombres</th>
		    <th>Apellidos</th>
		    <th>Email</th>
		    <th>Teléfono</th>
		    <th style="text-align: center;">Acciones</th>
	    </tr>
    </thead>
    <tbody>
    	<?php foreach ($datos as $item) {
    		echo "<tr><td>".$item['identificacion']."</td>";
    		echo "<td>".$item['nombres']."</td>";
    		echo "<td>".$item['apellidos']."</td>";
    		echo "<td>".$item['email']."</td>";
    		echo "<td>".$item['telefono']."</td>";
    		echo "<td align='center'><a href='javascript: loadModal(".$item['id'].")' class='btn btn-warning btn-sm' title='Editar' ><i class='fa fa-pencil'></i></a>
					  <a href='javascript:if(confirm(\"Está seguro que desea eliminar el elemento seleccionado?\")){redirect(".$item['id'].");}' class='btn btn-danger btn-sm' title='Eliminar'><i class='fa fa-trash'></i></a></td>";
    	}?>
    </tbody>
    </table>
</div>
<div class="modal fade" id="confirm-submit" tabindex="-1" role="dialog"
	aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" >
		<div class="modal-content">
			<div class="modal-header">
				<a class="close" data-dismiss="modal">×</a>
				<h3>Cliente</h3>
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
<script src="<?php echo PATH_JS; ?>/listados.js"></script>
</body>
</html>