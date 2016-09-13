<?php // define("PATH_ROOT", $_SERVER['DOCUMENT_ROOT']."/postulacion"); ?>
<?php define("PATH_ROOT", __DIR__."/../..");?>

<?php require_once(PATH_ROOT . "/config/config.inc"); ?>
<?php $title = "Pagina no Encontrada";?>
<?php include_once PATH_ROOT.'/web/template/header.public.php';?>
<div class="content">
<div style="text-align: center; width: 980px; margin: 20px;">
<img src="<?php echo PATH_IMAGES. "/404.png"; ?>" >
</div>
</div>
<?php include_once PATH_ROOT.'/web/template/footer.php';?>
</body>
</html>