<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>
    <head>
        <title>
            <?php 
                if(isset($this->titulo))
                    echo $this->titulo;
            ?>
        </title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf8" />
        <link href="<?php echo $_layoutParams['ruta_css']; ?>estilos.css" rel="stylesheet" type="text/css" />
        <script src="<?php echo BASE_URL; ?>public/js/jquery.js" type="text/javascript"></script> <?php //V5?>
        <!-- Para aumentar los js personalidos carpeta public -->
        <?php if(isset($_layoutParams['jsPublic']) && count($_layoutParams['jsPublic'])): //V5 ?>
            <?php for($i=0; $i < count($_layoutParams['jsPublic']); $i++): //V5 ?>
                <script src="<?php echo $_layoutParams['jsPublic'][$i] ?>" type="text/javascript"></script> <?php //V5?>
            <?php endfor; //V5?>
        <?php endif; //V5?>
        <!-- Para aumentar los js personalidos -->
        <?php if(isset($_layoutParams['js']) && count($_layoutParams['js'])): //V5 ?>
            <?php for($i=0; $i < count($_layoutParams['js']); $i++): //V5 ?>
                <script src="<?php echo $_layoutParams['js'][$i] ?>" type="text/javascript"></script> <?php //V5?>
            <?php endfor; //V5?>
        <?php endif; //V5?>
    </head>
    <body>
        <div id ="main">
        <div id="header">
            <div id="logo">
                <h1><?php echo APP_NAME; ?></h1>
            </div>
            <div id="menu">
                <div id="top_menu">
                    <ul>
                    <?php if(isset($_layoutParams['menu'])): ?>
                        <?php for($i = 0; $i < count($_layoutParams['menu']); $i++): ?>
                            <?php 
                     
                                if($item && $_layoutParams['menu'][$i]['id'] == $item ){ 
                                    $_item_style = 'current'; 
                                } else {
                                    $_item_style = '';
                                }
                            ?>
                            <li><a class="<?php echo $_item_style; ?>" href="<?php echo $_layoutParams['menu'][$i]['enlace']; ?>"><?php  echo $_layoutParams['menu'][$i]['titulo']; ?></a></li>
                        <?php endfor; ?>
                    <?php endif; ?>
                    </ul>
                </div>
            </div>
       </div>
        <div id="content"> <?php //V5 ?>
            <noscript><p>Para el correcto funcionamiento debe tener el soporte de javascript habilitado</p></noscript> <?php //V5 ?>
            <!-- <div id="error"><?php //if(isset($this->_error)): echo $this->_error; endif; ?></div> <?php //V5 ?> -->
            <?php if(isset($this->_error)): ?> <?php //V10 ?>
                <div id="error"><?php echo $this->_error; ?></div> <?php //V10 ?>
            <?php endif; ?> <?php //V10 ?>
            <?php if(isset($this->_mensaje)): ?> <?php //V10 ?>
                <div id="mensaje"><?php echo $this->_mensaje; ?></div> <?php //V10 ?>
            <?php endif; ?> <?php //V10 ?>
 