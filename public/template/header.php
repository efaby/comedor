<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- bootstrap 3.0.2 -->
    <link href="<?php echo PATH_CSS; ?>/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo PATH_CSS; ?>/jquery-ui.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo PATH_CSS; ?>/google-fonts.css" rel="stylesheet" type="text/css" />
    <!-- font Awesome -->
    <link href="<?php echo PATH_CSS; ?>/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo PATH_CSS; ?>/style.css" rel="stylesheet" type="text/css" />
     <link rel="shortcut icon" type="image/x-icon" href="<?php echo PATH_IMAGES.'/favicon.ico'?>" />
      </head>
      <body class="skin-black">        
         <div class="navbar navbar-inverse set-radius-zero">
        <div class="container">
            <div class="navbar-header" style="width: 100%">  
             <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>              
                <a class="navbar-brand" href="index.html">
                    <img src="<?php echo PATH_IMAGES.'/ejercito.jpg'?>" width="70px"/>
                </a>
                <h1 style="padding-top: 15px;">Sistema de Gestión de Confrontas</h1>
            </div>            
        </div>
    </div>
        
    <section class="menu-section">
        <div class="container">
            <div class="row">
               <?php $url = $_SERVER["REQUEST_URI"];?>
                    <div class="navbar-collapse collapse ">
                        <ul id="menu-top" class="nav navbar-nav">
                            <li class="<?php echo (strpos($url, '/Seguridad/inicio/'))?'menu-top-active':'';?>"><a href="../../Seguridad/inicio/">Inicio</a></li>
                            <?php if($_SESSION['SESSION_USER']->tipo==1):?>
                            	<li class="<?php echo (strpos($url, '/Usuario/listar/'))?'menu-top-active':'';?>"><a href="../../Usuario/listar/">Usuarios</a></li>
                            
	                            <li class="dropdown <?php echo ((strpos($url, '/Unidad/'))||(strpos($url, '/Tipo/'))||(strpos($url, '/TipoNovedad/'))||(strpos($url, '/Grado/')))?'menu-top-active':'';?>">
	                            	<a data-submenu="" data-toggle="dropdown" tabindex="0" aria-expanded="false">Catálogos
	                            		<span class="caret"></span>
	                            	</a>
	                            	<ul class="dropdown-menu">
									     <li class="sub-menu <?php echo (strpos($url, '/Unidad/listar/'))?'menu-top-active':'';?>"><a href="../../Unidad/listar/">Unidades</a></li>
									     <li class="sub-menu <?php echo (strpos($url, '/Tipo/listar/'))?'menu-top-active':'';?>"><a href="../../Tipo/listar/">Tipos de Personal</a></li>
									     <li class="sub-menu <?php echo (strpos($url, '/TipoNovedad/listar/'))?'menu-top-active':'';?>"><a href="../../TipoNovedad/listar/">Tipos de Novedades</a></li>
									     <li class="sub-menu <?php echo (strpos($url, '/Grado/listar/'))?'menu-top-active':'';?>"><a href="../../Grado/listar/">Grados de Personal</a></li>
									</ul>
	                            </li>
	                            
	                            <li class="<?php echo (strpos($url, '/Parametro/listar/'))?'menu-top-active':'';?>"><a href="../../Parametro/editar/">Configuración</a></li>
                            <?php endif;?>
                            <?php if(($_SESSION['SESSION_USER']->tipo==2)||($_SESSION['SESSION_USER']->tipo==3)):?>
                            	<li class="<?php echo (strpos($url, '/Persona/listar/'))?'menu-top-active':'';?>"><a href="../../Persona/listar/">Personal</a></li>
                            <?php endif;?>
                            <?php if($_SESSION['SESSION_USER']->tipo==2):?>	
                            	<li class="<?php echo (strpos($url, '/Novedad/listar/'))?'menu-top-active':'';?>"><a href="../../Novedad/listar/">Novedad</a></li>
                            	<li class="<?php echo (strpos($url, '/Confronta/listar/'))?'menu-top-active':'';?>"><a href="../../Confronta/listar/">Confronta</a></li>
                            	<li class="<?php echo (strpos($url, '/Unidad/configurar/'))?'menu-top-active':'';?>"><a href="../../Unidad/configurar/">Unidad</a></li>
                            	<li class="dropdown <?php echo ((strpos($url, '/Consumo/')))?'menu-top-active':'';?>">
	                            	<a data-submenu="" data-toggle="dropdown" tabindex="0" aria-expanded="false">Consumos
	                            		<span class="caret"></span>
	                            	</a>
	                            	<ul class="dropdown-menu">
									     <li class="sub-menu <?php echo (strpos($url, '/Consumo/individual/'))?'menu-top-active':'';?>"><a href="../../Consumo/individual/">Individual</a></li>
									     <li class="sub-menu <?php echo (strpos($url, '/Consumo/listado/'))?'menu-top-active':'';?>"><a href="../../Consumo/listado/">Listado</a></li>
									    
									</ul>
	                            </li>
                            	<?php endif;?>
							<?php if($_SESSION['SESSION_USER']->tipo==3):?>
                            	<li class="<?php echo (strpos($url, '/Confronta/consolidado/'))?'menu-top-active':'';?>"><a href="../../Confronta/consolidado/">Consolidado</a></li>
                            	<li class="<?php echo (strpos($url, '/Confronta/reporteConsolidado/'))?'menu-top-active':'';?>"><a href="../../Confronta/reporteConsolidado/">Reporte</a></li>
                            <?php endif;?>
                            <?php if($_SESSION['SESSION_USER']->tipo==4):?>
                            	<li class="<?php echo (strpos($url, '/ExtraConfronta/listar/'))?'menu-top-active':'';?>"><a href="../../ExtraConfronta/listar/">Extra Confronta</a></li>
                            	<li class="<?php echo (strpos($url, '/Confronta/consolidado/'))?'menu-top-active':'';?>"><a href="../../Confronta/consolidado/">Consolidado</a></li>
                            	<li class="<?php echo (strpos($url, '/Confronta/reporteConsolidado/'))?'menu-top-active':'';?>"><a href="../../Confronta/reporteConsolidado/">Reporte</a></li>
                            <?php endif;?>
                        </ul>
                        
                        <div class="navbar-right">
                    <ul class="nav navbar-nav" id="menu-top">                         
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-user"></i>
                                <span><?php echo $_SESSION['SESSION_USER']->usuario; ?><i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu dropdown-custom dropdown-menu-right">
                                <li class="sub-menu">
                                        <a href="../../Seguridad/cambiarContrasena/">                                        
                                            Cambiar Contraseña
                                        </a>                                        
                                        </li>
                                        <li class="sub-menu">
                                            <a href="../../Seguridad/cerrarSesion/"><i class="fa fa-sign-out fa-fw pull-right"></i> Cerrar Sesión</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>                
                        
                    </div>               

            </div>
        </div>
    </section>
                                <!-- Main content -->
                <section class="content">
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
		