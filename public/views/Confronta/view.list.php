<?php $title = "Confronta";?>
<?php include_once PATH_TEMPLATE.'/header.php';?>

<!-- Main row -->
<div class="row">
	<div class="col-lg-12">
    	<h1 class="page-header">Confrontas</h1>
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
	<div class="col-lg-12">
	<a href="../editar/" class="btn btn-primary">Nueva</a>		
	</div>
	<table class="table table-striped table-bordered table-hover" id="dataTables-example">
    <thead>
	    <tr>
	    	<th rowspan="2">Unidad</th>
		    <th colspan="3" style="text-align: center;">Desayunos</th>
		    <th colspan="3" style="text-align: center;">Almuerzos</th>
		    <th colspan="3" style="text-align: center;">Meriendas</th>
		    <th rowspan="2" style="text-align: center;">Fecha</th>
		    <th rowspan="2" style="text-align: center; width: 20%">Acciones</th>
	    </tr>
	    <tr>
	    	<th>OFI</th>
	    	<th>VOL</th>
	    	<th>CON</th>
	    	<th>OFI</th>
	    	<th>VOL</th>
	    	<th>CON</th>
	    	<th>OFI</th>
	    	<th>VOL</th>
	    	<th style="border-right: 1px solid #ddd;">CON</th>	    	
	    </tr>
    </thead>
    <tbody>
    	<?php foreach ($datos as $item) {
    		echo "<tr><td>".$item->unidad."</td>";
    		echo "<td>".$item->desayuno_ofi."</td>";
    		echo "<td>".$item->desayuno_vol."</td>";  
    		echo "<td>".$item->desayuno_con."</td>";
    		echo "<td>".$item->almuerzo_ofi."</td>";
    		echo "<td>".$item->almuerzo_vol."</td>";
    		echo "<td>".$item->almuerzo_con."</td>";
    		echo "<td>".$item->merienda_ofi."</td>";
    		echo "<td>".$item->merienda_vol."</td>";
    		echo "<td>".$item->merienda_con."</td>";
    		echo "<td style='text-align: center;'>".$item->fecha_acceso."</td>";    		
    		echo "<td align='center'><a href='../editar/".$item->id."' class='btn btn-warning btn-sm' title='Editar' ><i class='fa fa-pencil'></i></a>
					  <a href='javascript:if(confirm(\"Está seguro que desea eliminar el elemento seleccionado?\")){redirect(".$item->id.");}' class='btn btn-danger btn-sm' title='Eliminar'><i class='fa fa-trash'></i></a>
		    		<a href='javascript:imprimir(".$item->id.",\"verGeneral\");' class='btn btn-info btn-sm' title='Ver Resumen'><i class='fa fa-file-text-o'></i></a>  
		    		<a href='javascript:imprimir(".$item->id.",\"verListado\");' class='btn btn-success btn-sm' title='Ver Listado'><i class='fa fa-book'></i></a>		    		  
		    		</td></tr>";
    	}?>
    </tbody>
    </table>
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


</script>

</body>
</html>