<?php $title = "Confronta";?>
<?php include_once PATH_TEMPLATE.'/header.php';?>

<!-- Main row -->
<div class="row">
	<div class="col-lg-12">
    	<h1 class="page-header">Confronta de Rancho para el dia <?php echo $fecha;?></h1>
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


	<table class="table table-striped table-bordered table-hover" id="dataTables-example">
    <thead>
	    <tr>
			<th>Identificación</th>
			<th>Grado</th>
			<th>Nombres</th>
			<th>Unidad</th>							
			<th>DES</th>
			<th>ALM</th>
			<th>MER</th>
		    <th style="text-align: center;">Accion</th>
	    </tr>
    </thead>
    <tbody>
    	<?php foreach ($listado as $item): ?>
			<tr>
				<td><?php echo $item->identificacion ?></td>
				<td><?php echo $item->grado; ?></td>				
				<td><?php echo $item->apellidos; ?> <?php echo $item->nombres; ?></td>
				<td><?php echo $item->unidad; ?></td>
				<?php if($item->nombre == ''):?>
				<td style="text-align: center;"><?php echo ($item->desayuno)?'<i class="fa fa-check">':'<i class="fa fa-times">'; ?> </i></td>
				<td style="text-align: center;"><?php echo ($item->almuerzo)?'<i class="fa fa-check">':'<i class="fa fa-times">'; ?></td>
				<td style="text-align: center;"><?php echo ($item->merienda)?'<i class="fa fa-check">':'<i class="fa fa-times">'; ?></td>
				<?php else:?>
				<td colspan='3' style='text-align: center;'><a href="../downloadFile/?nameFile=<?php echo $item->url;?>"><?php echo $item->nombre; ?></a></td>

				<?php endif;?>
				<td align='center'><a href='javascript: loadModalExtra(<?php echo $item->id; ?>)' class='btn btn-warning btn-sm' title='Extraconfronta' ><i class='fa fa-pencil'></i></a>
			</tr>
		<?php endforeach;?>
    </tbody>
    </table>
</div>

<div class="modal fade" id="confirm-submit" tabindex="-1" role="dialog"
	aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" style="width: 400px;">
		<div class="modal-content">
			<div class="modal-header">
				<a class="close" data-dismiss="modal">×</a>
				<h3>Extra Confronta</h3>
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
<script src="<?php echo PATH_JS; ?>/formValidation.js"></script>
<script src="<?php echo PATH_JS; ?>/bootstrap.js"></script>
<link href="<?php echo PATH_CSS; ?>/bootstrapValidator.min.css" rel="stylesheet">

<script type="text/javascript">

function redirect(id){
		var url = '../eliminar/' + id;
		location.href = url;
	}

function imprimir(id,url){
	var posicion_x; 
	var posicion_y; 
	var ancho = 900;
	var alto = 550;
	posicion_x=(screen.width/2)-(ancho/2); 
	posicion_y=(screen.height/2)-(alto/2); 
	var accion = "../"+url+"/" + id;
	var opciones="toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width="+ancho+",height="+alto+",left="+posicion_x+",top="+posicion_y;
	window.open(accion,"",opciones);
}

function loadModalExtra(id){
		$('.modal-body').load('../extraconfronta/' + id,function(result){
		    $('#confirm-submit').modal({show:true});
		});
	}

</script>

</body>
</html>