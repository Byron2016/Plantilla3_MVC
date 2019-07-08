<?php 

//V12

?>

<h6>Vista _paginacion</h6>                                                                      <?php //V12 ?>

<?php if(isset($this->_paginacion)): ?>                                                         <?php //V12 ?>

 	<?php if(($this->_paginacion['primero'])): ?>                                               <?php //V12 ?>
		<a href="<?php echo $link . $this->_paginacion['primero']; ?>">PRIMERO</a>              <?php //V12 ?>
	<?php else: ?>                                                                              <?php //V12 ?>
		Primero                                                                                 <?php //V12 ?>
	<?php endif; ?>                                                                             <?php //V12 ?>

 	&nbsp;                                                                                      <?php //V12 ?>

 	<?php if(($this->_paginacion['anterior'])): ?>                                              <?php //V12 ?>
		<a href="<?php echo $link . $this->_paginacion['anterior']; ?>">ANTERIOR</a>            <?php //V12 ?>
	<?php else: ?>                                                                              <?php //V12 ?>
		Anterior                                                                                <?php //V12 ?>
	<?php endif; ?>                                                                             <?php //V12 ?>

 	&nbsp;                                                                                      <?php //V12 ?>

 	<?php //rango de páginas entre anterior y siguiente ?>                                      <?php //V12 ?>

 	<?php for($i = 0; $i < count($this->_paginacion['rango']); $i++): ?>                        <?php //V12 ?>

 		<?php if($this->_paginacion['actual'] == $this->_paginacion['rango'][$i]): ?>           <?php //V12 ?>

 			<span><?php echo $this->_paginacion['rango'][$i]; ?></span>                         <?php //V12 ?>

 		<?php else: ?>                                                                          <?php //V12 ?>

 			<a href="<?php echo $link . $this->_paginacion['rango'][$i]; ?>">                   <?php //V12 ?>
				<?php echo $this->_paginacion['rango'][$i]; ?>                                  <?php //V12 ?>
			</a>                                                                                <?php //V12 ?>
			&nbsp;                                                                              <?php //V12 ?>

 		<?php endif; ?>                                                                         <?php //V12 ?>

 	<?php endfor; ?>                                                                            <?php //V12 ?>

 	&nbsp;                                                                                      <?php //V12 ?>

 	<?php if(($this->_paginacion['siguiente'])): ?>                                             <?php //V12 ?>
		<a href="<?php echo $link . $this->_paginacion['siguiente']; ?>">SIGUIENTE</a>          <?php //V12 ?>
	<?php else: ?>                                                                              <?php //V12 ?>
		Siguiente                                                                               <?php //V12 ?>
	<?php endif; ?>                                                                             <?php //V12 ?>

 	&nbsp;                                                                                      <?php //V12 ?>

 	<?php if(($this->_paginacion['ultimo'])): ?>                                                <?php //V12 ?>
		<a href="<?php echo $link . $this->_paginacion['ultimo']; ?>">ULTIMO</a>                <?php //V12 ?>
	<?php else: ?>                                                                              <?php //V12 ?>
		Ultimo                                                                                  <?php //V12 ?>
	<?php endif; ?>                                                                             <?php //V12 ?>

<?php endif; ?>                                                                                 <?php //V12 ?>
