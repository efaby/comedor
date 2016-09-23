<?php $title = "Confronta";?>
<?php include_once PATH_TEMPLATE.'/header.php';?>
<style>
<!--

        .table1 {
            width: 100%;
        }

        .table1 thead, .table1 tbody, .table1 tr, .table1 td, .table1 th { display: block; }

        .table1 tr:after {
            content: ' ';
            display: block;
            visibility: hidden;
            clear: both;
        }

		.table1 thead tr{
			width: 98%;
		}
        .table1 thead th {
			
            /*text-align: left;*/
        }

        .table1 tbody {
            height: 400px;
            overflow-y: auto;
        }

        .table1 thead {
            /* fallback */
        }


        .table1 tbody td, .table1 thead th {
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
        .help-block {
        
        color:#a94442;
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
	<table class="table table1 table-striped table-hover" id="dataTables-example1">
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
    <?php $des = $alm = $mer = $desOfi = $almOfi = $merOfi = 0; ?>
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
    			echo "<td class='servicio'><input type='checkbox' name='desayuno[]' value='".$item->id."' checked onclick='calcularTotal(\"des\",\"".$tipo."\",this,\"".$item->identificacion."\")' /></td>";
    			echo "<td class='servicio'><input type='checkbox' name='almuerzo[]' value='".$item->id."' checked onclick='calcularTotal(\"alm\",\"".$tipo."\",this,\"".$item->identificacion."\")' /></td>";
    			echo "<td class='servicio'><input type='checkbox' name='merienda[]' value='".$item->id."' checked onclick='calcularTotal(\"mer\",\"".$tipo."\",this,\"".$item->identificacion."\")' /></td></tr>";
    				
    		} else {
    			echo "<td colspan='3' style='text-align: center; width: 15%;'>".$item->nombre."</td></tr>";
    		}
    		
    	}?>
    </tbody>
    </table>
    
    
    <div style="width: 50%; ">
    <div class="col-sm-12">
    		<div class="col-sm-2">    		
    		</div>
    		<div class="col-sm-2">
    		<label class="control-label">Oficiales</label>
    		</div>
    		<div class="col-sm-2">
    		<label class="control-label">Voluntarios</label>
    		</div>
    		<div class="col-sm-2">
    		<label class="control-label">Conscriptos</label>
    		</div>
    		<div class="col-sm-2">
    		<label class="control-label">Total</label>
    		</div>
    	</div>
    	<div class="col-sm-12">
    		<div class="col-sm-2">
    		Desayunos 
    		</div>
    		<div class="col-sm-2">
    		<input type="text" name="desOfi" id="desOfi" value="<?php echo $desOfi;?>" readonly="readonly" size="3" class="form-control">
    		</div>
    		<div class="col-sm-2">
    		<input type="text" name="des" id="des" value="<?php echo $des;?>" readonly="readonly" size="3" class="form-control">
    		</div>
    		<div class="col-sm-2 form-group">
    		<input type="text" name="desCons" id="desCons" value="<?php echo $cons;?>" size="3" class="form-control">
    		</div>
    		<div class="col-sm-2">
    		<input type="text" name="desTotal" id="desTotal" value="<?php echo $des + $desOfi + $cons?>" readonly="readonly" size="3" class="form-control">
    		</div>
    	</div>
    	<div class="col-sm-12">
    		<div class="col-sm-2">
    		Almuersos 
    		</div>
    		<div class="col-sm-2">
    		<input type="text" name="almOfi" id="almOfi" value="<?php echo $almOfi;?>" readonly="readonly" size="3" class="form-control">
    		</div>
    		<div class="col-sm-2">
    		<input type="text" name="alm" id="alm" value="<?php echo $alm;?>" readonly="readonly" size="3" class="form-control">
    		</div>
    		<div class="col-sm-2 form-group">
    		<input type="text" name="almCons" id="almCons" value="<?php echo $cons;?>" size="3" class="form-control">
    		</div>
    		<div class="col-sm-2">
    		<input type="text" name="almTotal" id="almTotal" value="<?php echo $alm + $almOfi + $cons?>" readonly="readonly" size="3" class="form-control">
    		</div>
    	</div>
    	<div class="col-sm-12">
    		<div class="col-sm-2">
    		Meriendas 
    		</div>
    		<div class="col-sm-2">
    		<input type="text" name="merOfi" id="merOfi" value="<?php echo $merOfi;?>" readonly="readonly" size="3" class="form-control">
    		</div>
    		<div class="col-sm-2">
    		<input type="text" name="mer" id="mer" value="<?php echo $mer;?>" readonly="readonly" size="3" class="form-control">
    		</div>
    		<div class="col-sm-2 form-group">
    		<input type="text" name="merCons" id="merCons" value="<?php echo $cons;?>" size="3" class="form-control" class="form-control">
    		</div>
    		<div class="col-sm-2">
    		<input type="text" name="merTotal" id="merTotal" value="<?php echo $mer + $merOfi + $cons?>" readonly="readonly" size="3" class="form-control">
    		</div>
    	</div>
    </div>
    <div class="form-group col-sm-12">
        
            <div id="messages1" style="color: #a94442;"></div>
    </div>
    <div class="form-group col-sm-12">
		<button type="submit" class="btn btn-success">Guardar</button>
		<a href="../listar/" class="btn btn-info">Cancelar</a>		
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
var ckecksArray = {};
ckecksArray['teste'] = 'hola';
function calcularTotal(tipo,grado,item,i){

	var sum = 0;
	if(item.checked){
		sum = 1;
	} else {
		sum = -1;
	}

	$('#'+tipo+grado).val(parseInt($('#'+tipo+grado).val()) + sum);
	$('#'+tipo+'Total').val(parseInt($('#'+tipo+'Ofi').val()) + parseInt($('#'+tipo).val()) + parseInt($('#'+tipo+'Cons').val()));


	if(ckecksArray[i] != undefined) {
		ckecksArray[i] = ckecksArray[i] + sum;
	} else {
		ckecksArray[i] = 2;
	}
	
};

function calcularTotal1(tipo){
	$('#'+tipo+'Total').val(parseInt($('#'+tipo+'Ofi').val()) + parseInt($('#'+tipo).val()) + parseInt($('#'+tipo+'Cons').val()));	
};

$(document).ready(function() {

	$("#desCons").keyup(function(){
	   calcularTotal1('des');
	});
	$("#almCons").keyup(function(){
		   calcularTotal1('alm');
		});
	$("#merCons").keyup(function(){
		   calcularTotal1('mer');
		});

	
	$('#frmItem').formValidation({
    	message: 'This value is not valid',
		feedbackIcons: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
		err: {
            container: '#messages1'
        },
		fields: {			

			desCons: {
				message: 'El número de Conscriptos no es válido',
				validators: {
					notEmpty: {
						message: 'El número de Desayunos de Conscriptos no puede ser vacío.'
					},					
					regexp: {
						regexp: /^\d*$/,
						message: 'Ingrese un número de Desayunos de Conscriptos válido.'
					},
					between: {
                        min: 0,
                        max: <?php echo $cons?>,
                        message: 'Ingrese un número de Desayunos de Conscriptos válido. Máximo <?php echo $cons?> Desayunos.'
                    }
				}
			},
			almCons: {
				message: 'El número de Conscriptos no es válido',
				validators: {
					notEmpty: {
						message: 'El número de Almuersos de Conscriptos no puede ser vacío.'
					},					
					regexp: {
						regexp: /^\d*$/,
						message: 'Ingrese un número de Almuerzos de Conscriptos válido.'
					},
					between: {
                        min: 0,
                        max: <?php echo $cons?>,
                        message: 'Ingrese un número de Almuerzos de Conscriptos válido. Máximo <?php echo $cons?> Almuerzos.'
                    }
				}
			},
			merCons: {
				message: 'El número de Conscriptos no es válido',
				validators: {
					notEmpty: {
						message: 'El número de Meriendas de Conscriptos no puede ser vacío.'
					},					
					regexp: {
						regexp: /^\d*$/,
						message: 'Ingrese un número de Meriendas de Conscriptos válido.'
					},
					between: {
                        min: 0,
                        max: <?php echo $cons?>,
                        message: 'Ingrese un número de Meriendas de Conscriptos válido. Máximo <?php echo $cons?> Meriendas.'
                    }
				}
			},
			
		}
	}).on('success.form.fv', function(e) {
		var id = -1;
		
		for (var key in ckecksArray){
			if(ckecksArray[key] == 0){
				id = key;
				break;
			}
		}
		
        if(id!=-1){
        	e.preventDefault();        	
        	alert('La persona con Identidicación ' + id + ' no tiene asignado ningun servicio.');
        }
        var $form = $(e.target);
        $form.formValidation('disableSubmitButtons', false);
    });
	
	
		
});

</script>

</body>
</html>