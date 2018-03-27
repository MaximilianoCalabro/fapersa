<?php
include("security.inc.php");
include("header.inc.php");
?>
   <div id="menu2"><div id="acceso">
<h2 class="accesonav">Acceso Catalogo</h2>
<div id="fbuscar" class="cuerpolateral"> 
<form ACTION="login.php" METHOD="POST">
<div id="campotexto"><input type="text" name="cliente" value="Cliente" onfocus="this.value = ''"></div> 
<div id="campotexto"><input type="password" name="password" value="Password" onfocus="this.value = ''"></div>
<div id="botonbuscar"><input type=image src="../images/boton.gif" width="105" height="27"><input name="sent" type="hidden" id="sent" value="1"></div>
</form> 
</div> 
        </div>
        </div>
  </div>
        <div id="contenido">
        <div id="ourcompany">      	
<div id="textogeneral" class="graltexto">
<h1>Su Orden</h1>

<?

if (!count($_SESSION[cart_products][id])) {
	header("location: catalog.php");
	exit;
}

if ($_GET[envio] == "true") {
	
	$sql = "select * from fapersa_clientes where id='" .$_SESSION[SESSION_CLIENTE][id]. "'";
	$stmc=$bd->ejecutar($sql);
	$count_result=$bd->NumeroRows($stmc);
	$c=$bd->obtener_fila($stmc,0);
	
	//$count_result = "1";
	
	if ($count_result !== "0") {
		// PREPARE TEMPLATE INFO
		$contents_user = "Estimado " . $c[nombre] . ":<br><br>";
		$contents_user .= "A continuaci&oacute;n se presentan los productos solicitados en <a href=\"" . SITE_URL . "\">Fapersa.com</a>";
		
		
		if (count($_SESSION[cart_products][id])) {
	$contents .= '<br><br>' . "\n";
	$contents .= '<table width="580" border="0" cellpadding="0" cellspacing="2">' . "\n";
	$contents .= '		<tr>' . "\n";
	$contents .= '			<td valign="top" width="20%"><b><span class="textonegro">Codigo</span></b></td>' . "\n";
	$contents .= '			<td width="40%" align="center" valign="top"><b><span class="textonegro">Descripcion</span></b></td>' . "\n";
	$contents .= '			<td width="15%" align="center" valign="top"><b><span class="textonegro">Marca</span></b></td>' . "\n";
	$contents .= '			<td width="15%" align="center" valign="top"><b>Dimension</b></td>' . "\n";
	$contents .= '			<td width="10%" align="center" valign="top"><b>Cantidad</b></td>' . "\n";
	$contents .= '		</tr>' . "\n";
	$contents .= '		<tr bgcolor="#C1DCFA">' . "\n";
	$contents .= '			<td height="1" colspan="5" valign="top"></td>' . "\n";
	$contents .= '		</tr>' . "\n";
	
					foreach ($_SESSION[cart_products][id] AS $key => $value) {
						
					$id_producto = $_SESSION['cart_products']['id'][$key];
					$cantidad = $_SESSION['cart_products']['cantidad'][$key];
					$cantidad_total += $_SESSION['cart_products']['cantidad'][$key];

					
	  	$select = "select * from fapersa_products where id='" .$id_producto. "'";
			$stmi=$bd->ejecutar($select);
			$i=$bd->obtener_fila($stmi,0);		
					
	  	$selectm = "select * from fapersa_marcas where id='" .$i[IdMarca]. "'";
			$stmm=$bd->ejecutar($selectm);
			$m=$bd->obtener_fila($stmm,0);

	$contents .= '		<tr>' . "\n";
	$contents .= '			<td width="20%" valign="top"><b>' . $i[Number] . '</b></td>' . "\n";
	$contents .= '			<td align="center" valign="top" width="40%">' . $i[Descripcion] . '</td>' . "\n";
	$contents .= '			<td align="center" valign="top" width="15%">' . $m[Marcas]. '</td>' . "\n";
	$contents .= '			<td align="center" valign="top" width="15%">' . $i[Dimension] . '</td>' . "\n";
	$contents .= '			<td align="center" valign="top" width="10%">' . $cantidad . '</td>' . "\n";
	$contents .= '		</tr>' . "\n";
	$contents .= '		<tr bgcolor="#C1DCFA">' . "\n";
	$contents .= '			<td height="1" colspan="5" valign="top"></td>' . "\n";
	$contents .= '		</tr>' . "\n";
	$contents .= '	<tr>' . "\n";
	$contents .= '		<td colspan="4" align="right" valign="top"><b><font color="#FF0000">Total de Productos</font></b></td>' . "\n";
	$contents .= '		<td align="right" valign="top">' . $cantidad_total . "&nbsp;&nbsp;\n";
	$contents .= '		</td>' . "\n";
	$contents .= '	</tr>' . "\n";
	$contents .= '</table>' . "\n";
}
		
		$contents_user .= $contents;

		// OPENS TEMPLATE
		$template = file("../inc/.ht_mail");
		reset($template);
		foreach($template as $line){
			$line = str_replace("{-SITE_URL-}", SITE_URL, $line);
			$line = str_replace("{-CONTENTS-}", $contents_user, $line);

			$final_template .= $line;
		}

		// HEADERS
		$subject = "Fapersa - Detalle del Pedido";

		$headers  = "From: Fapersa.com <info@fapersa.com>\n";
		$headers .= "X-Sender: <info@fapersa.com>\n";
		$headers .= "X-Mailer: Fapersa.com\n";
		$headers .= "X-Priority: 1\n";
		$headers .= "Return-Path: <info@fapersa.com>\n";
		$headers .= "Content-Type: text/html; charset=iso-8859-1\r\n";

		// CUSTOMER EMAIL
		mail($_SESSION[SESSION_CLIENTE][email],$subject,$final_template,$headers);
		
					
		$subject2 = "Copia Orden de Compra Enviada al Proveedor";
		// email Admin				
		mail(SITE_EMAIL,$subject2,$final_template,$headers);

		// UNSET SESSION
		unset($_SESSION[cart_products]);
		?>
		<div id="catalogo_header"><div id="no_result">Solicitud enviada con &eacute;xito</div></div>
		<?

	}else{
		?>
		<div id="catalogo_header"><div id="no_result">No hay productos en su cesta</div></div>
		<?
	}
}else{
	?>
<div id="catalogo_header"><div id="no_result">Usted no se ha identificado<br><a href="login.php">Ingresar</a></div></div>
<?
}
}
?>
</div>
</div>
        </div>
        </div>
<?php
include("footer.inc.php"); 
?>