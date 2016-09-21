<?php $title = "Confronta";?>
<?php include_once PATH_TEMPLATE.'/header.php';?>
<style>
<!--

        table1 {
            width: 100%;
        }

        table1 thead, table1 tbody, table1 tr, table1 td, table1 th { display: block; }

        table1 tr:after {
            content: ' ';
            display: block;
            visibility: hidden;
            clear: both;
        }

        table1 thead th {

            /*text-align: left;*/
        }

        table1 tbody {
            height: 400px;
            overflow-y: auto;
        }

        table1 thead {
            /* fallback */
        }


        table1 tbody td,table1 thead th {
            float: left;
        }
        .ci {
        	width: 15%;
        }
        .texto{
        	width: 25%;
        }
        .tipo{
        	width: 10%
        }
        .servicio{
        	text-align: center;
        	width: 5%;
        }
-->
</style>
<!-- Main row -->
<div class="row">
	<div class="col-lg-12">
    	<h1 class="page-header">Confronta</h1>
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
<form id="frmItem" method="post" action="../guardar/">

	<table class="table table1 table-striped table-bordered table-hover" id="dataTables-example1">
    <thead>
	    <tr>
	    	<th class="ci">Indentificación</th>
		    <th class="texto">Nombres</th>
		    <th class="texto">Apellidos</th>
		    <th class="tipo">Grado</th>
		    <th class="tipo">Arma</th>
	    	<th class='servicio'>DES</th>
	    	<th class='servicio'>ALM</th>
	    	<th class='servicio'>MER</th>
	    </tr>
    </thead>
    <tbody>
    <?php $des = $alm = $mer = $desOfi = $almOfi = $merOfi = 0;?>
    	<?php foreach ($listado as $item) {
    		echo "<tr><td class='ci'>".$item->identificacion."</td>";
    		echo "<td class='texto'>".$item->nombres."</td>";
    		echo "<td class='texto'>".$item->apellidos."</td>";  
    		echo "<td class='tipo'>".$item->grado."</td>";
    		echo "<td class='tipo'>".$item->arma."</td>"; 
    		if($item->nombre == ''){
    			if($item->tipo == 1){
    				$almOfi = $merOfi = $desOfi = $desOfi + 1;
    				$tipo = "Ofi";
    			} else {
    				$alm = $mer = $des = $des + 1;
    				$tipo = "";
    			}
    			echo "<td class='servicio'><input type='checkbox' name='desayuno[]' value='".$item->id."' checked onclick='calcularTotal(\"des\",\"".$tipo."\",this)' /></td>";
    			echo "<td class='servicio'><input type='checkbox' name='almuerzo[]' value='".$item->id."' checked onclick='calcularTotal(\"alm\",\"".$tipo."\",this)' /></td>";
    			echo "<td class='servicio'><input type='checkbox' name='merienda[]' value='".$item->id."' checked onclick='calcularTotal(\"mer\",\"".$tipo."\",this)' /></td></tr>";
    				
    		} else {
    			echo "<td colspan='3'>".$item->nombre."</td></tr>";
    		}
    		
    	}?>
    </tbody>
    </table>
    <table class="table table-bordered table-hover" style="width: 40%;">
    <tr><th></th><th align='center'>Oficiales</th><th align='center'>Voluntarios</th><th align='center'>Conscriptos</th><th align='center'>Total</th></tr>
    <tr><td>Desayunos </td><td align='center'><input type="text" name="desOfi" id="desOfi" value="<?php echo $desOfi;?>" readonly="readonly" size="3"></td><td align='center'><input type="text" name="des" id="des" value="<?php echo $des;?>" readonly="readonly" size="3"></td><td align='center'><input type="text" name="desCons" id="desCons" value="<?php echo $cons;?>" size="3"></td><td align='center'><input type="text" name="desTotal" id="desTotal" value="<?php echo $des + $desOfi + $cons?>" readonly="readonly" size="3"></td></tr>
    <tr><td>Almuersos </td><td align='center'><input type="text" name="almOfi" id="almOfi" value="<?php echo $almOfi;?>" readonly="readonly" size="3"></td><td align='center'><input type="text" name="alm" id="alm" value="<?php echo $alm;?>" readonly="readonly" size="3"></td><td align='center'><input type="text" name="almCons" id="almCons" value="<?php echo $cons;?>" size="3"></td><td align='center'><input type="text" name="almTotal" id="almTotal" value="<?php echo $alm + $almOfi + $cons?>" readonly="readonly" size="3"></td></tr>
    <tr><td>Meriendas </td><td align='center'><input type="text" name="merOfi" id="merOfi" value="<?php echo $merOfi;?>" readonly="readonly" size="3"></td><td align='center'><input type="text" name="mer" id="mer" value="<?php echo $mer;?>" readonly="readonly" size="3"></td><td align='center'><input type="text" name="merCons" id="merCons" value="<?php echo $cons;?>" size="3"></td><td align='center'><input type="text" name="merTotal" id="merTotal" value="<?php echo $mer + $merOfi + $cons?>" readonly="readonly" size="3"></td></tr>
    </table>
    <div class="form-group">
		<button type="submit" class="btn btn-success">Guardar</button>
	</div>
    
    </form>
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

function calcularTotal(tipo,grado,item){

	var sum = 0;
	if(item.checked){
		sum = 1;
	} else {
		sum = -1;
	}

	$('#'+tipo+grado).val(parseInt($('#'+tipo+grado).val()) + sum);
	$('#'+tipo+'Total').val(parseInt($('#'+tipo+'Ofi').val()) + parseInt($('#'+tipo).val()) + parseInt($('#'+tipo+'Cons').val()));

	
};

$(document).ready(function() {

	
});

</script>

</body>
</html>