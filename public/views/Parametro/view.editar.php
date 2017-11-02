<?php $title = "Parametros";?>
<?php include_once PATH_TEMPLATE.'/header.php';?>

<!-- Main row -->
<div class="row">
	<div class="col-lg-12">
    	<h1 class="page-header">Parametros de Configuración</h1>
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
	
    <div style="width: 40%; overflow: auto; margin-bottom: 20px;">
    <?php $validacion = '';
    	foreach ($datos as $item):?>
    
    <div class="form-group col-sm-12">
    		<div class="col-sm-4">
    			<label class="control-label"><?php echo $item->etiqueta;?></label>
    		</div>
    		<div class="col-sm-8">
    			<input type="<?php echo $item->tipo;?>" name="<?php echo $item->clave;?>" id="<?php echo $item->clave;?>" value="<?php echo $item->valor;?>" class="form-control">
    		</div>    		
    </div>
    
    <?php $validacion .= $item->clave.": {
				message: 'El campo ".$item->etiqueta." no es válido',
				validators: {
					notEmpty: {
						message: 'El campo ".$item->etiqueta." no puede ser vacío.'
					},					
					regexp: {
						regexp: /^".$item->patron."/,
						message: 'Ingrese un valor de campo ".$item->etiqueta." válido.'
					}
				} }," ?>
    <?php endforeach;?>
    </div>
    <div class="form-group col-sm-12">
		<button type="submit" class="btn btn-success">Guardar</button>	
	</div>
    
    </form>
</div>

<?php include_once PATH_TEMPLATE.'/footer.php';?>   

<script src="<?php echo PATH_JS; ?>/formValidation.js"></script>
<script src="<?php echo PATH_JS; ?>/bootstrap.js"></script>
<link href="<?php echo PATH_CSS; ?>/bootstrapValidator.min.css" rel="stylesheet">
<script type="text/javascript">
$(document).ready(function() {

	$('#frmItem').formValidation({
    	message: 'This value is not valid',
		feedbackIcons: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
		fields: {		
			
			<?php echo $validacion;?>
			
		}
	});
	
	
		
});

</script>

</body>
</html>