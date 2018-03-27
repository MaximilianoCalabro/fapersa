<link rel="stylesheet" href="<?=SITE_URL?>js/accordion/accordion.css" />
<ul id="navigation" class="nav">
	<li>
		<a class="head">Home</a>
		<ul>
			<li><a href="<?=ADM_URL?>index.php">Bienvenido</a></li>
			<li><a href="<?=ADM_URL?>logout.php">Logout</a></li>
			<li><span><img src="<?=ADM_URL?>images/arrow_white.gif" width="4" height="8" border="0" vspace="6" align="absmiddle"> Datos de acceso</span></li>
			<li><a href="<?=ADM_URL?>modificar.php">Modificar</a></li>
		</ul> 
	</li>
	<li>
		<a class="head">Marcas</a>
		<ul>
			<li><a href="<?=ADM_URL?>alta_marca.php">Alta</a></li>
			<li><a href="<?=ADM_URL?>marcas.php">Baja / Modificaci&oacute;n</a></li>
		</ul> 
	</li>
	<li>
		<a class="head">Productos</a>
		<ul>
			<li><a href="<?=ADM_URL?>alta_producto.php">Alta</a></li>
			<li><a href="<?=ADM_URL?>productos.php">Baja / Modificaci&oacute;n</a></li>
		</ul> 
	<li>
		<a class="head">Clientes</a>
		<ul>
			<li><a href="<?=ADM_URL?>alta_cliente.php">Alta</a></li>
			<li><a href="<?=ADM_URL?>clientes.php">Baja / Modificaci&oacute;n</a></li>
		</ul> 
	</li>
</ul>
<script type="text/javascript">
jQuery('#navigation').Accordion({
	active: false,
	header: '.head',
	alwaysOpen: false,
	navigation: true
});

jQuery('#close').click(function() {
	jQuery('#navigation').activate(-1);
});

jQuery('#navigation_2').Accordion({
	active: false,
	header: '.head',
	alwaysOpen: false,
	navigation: true
});

jQuery('#navigation_2 #close').click(function() {
	jQuery('#navigation_2').activate(-1);
});
</script>