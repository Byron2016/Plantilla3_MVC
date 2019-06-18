<?php 

//V3

 ?>

 <!DOCTYPE html>
 <html lang="es">
 <head>
 	<meta charset="UTF-8">
 	<title><?php 
 		if(isset($this->titulo))  
 			echo $this->titulo; //V3
 		?>
 	</title>
 	<link href="<?php echo $_layoutParams['ruta_css'];?>estilos1.css" rel="stylesheet" type="text/css" >
 </head>
 <body>

	<div id="main">
		<div id="header">
			<div id="logo">
				<h1><?php   echo APP_NAME;?></h1>
			</div>
		</div>

		<div id="menu">
			<div id="menu_top">
				<ul>
					<?php if(isset($_layoutParams['menu'])):?>
						<?php for($i = 0; $i < count($_layoutParams['menu']); $i++):?>
							<?php 
		                        if($item && $_layoutParams['menu'][$i]['id'] == $item ){ 
		                            $_item_style = 'current'; 
		                        } else {
		                            $_item_style = '';
		                        }
		                    ?>

 							<li>
								<a class="<?php echo $_item_style; ?>" href="<?php echo $_layoutParams['menu'][$i]['enlace']; ?>"><?php echo $_layoutParams['menu'][$i]['titulo']; ?>
								</a>
							</li>
						<?php endfor; ?>
					<?php endif; ?>
				</ul>
			</div>
		</div>