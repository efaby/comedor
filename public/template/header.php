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

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
          <![endif]-->
      </head>
      <body class="skin-black">
        <!-- header logo: style can be found in header.less -->
        
         <div class="navbar navbar-inverse set-radius-zero">
        <div class="container">
            <div class="navbar-header">                
                <a class="navbar-brand" href="index.html">
                    <img src="<?php echo PATH_IMAGES.'/ejercito.jpg'?>" width="70px"/>
                </a>
            </div>            
        </div>
    </div>
        
    <section class="menu-section">
        <div class="container">
            <div class="row">
               
                    <div class="navbar-collapse collapse ">
                        <ul id="menu-top" class="nav navbar-nav">
                            <li><a class="menu-top-active" href="index.html">Inicio</a></li>
                            <li><a href="../../Usuario/listar/">Usuarios</a></li>
                            <li class="dropdown">
                            	<a data-submenu="" data-toggle="dropdown" tabindex="0" aria-expanded="false">Catálogos
                            		<span class="caret"></span>
                            	</a>
                            	<ul class="dropdown-menu">
								     <li class="sub-menu"><a href="../../Unidad/listar/">Unidades</a></li>
								     <li class="sub-menu"><a href="../../Tipo/listar/">Tipos de Personal</a></li>
								     <li class="sub-menu"><a href="../../TipoNovedad/listar/">Tipos de Novedades</a></li>
								     <li class="sub-menu"><a href="../../Grado/listar/">Grados de Personal</a></li>
								</ul>
                            </li>
                             <li><a href="../../Parametro/editar/">Configuración</a></li>
                            <li><a href="../../Persona/listar/">Personal</a></li>
                            <li><a href="../../Novedad/listar/">Novedad</a></li>
                            <li><a href="../../Confronta/listar/">Confronta</a></li>

                        </ul>
                    </div>
                

            </div>
        </div>
    </section>
                                <!-- Main content -->
                <section class="content">
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
		