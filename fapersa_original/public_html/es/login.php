<?
require '../inc/.conectar.class.php';
$bd=Db::getInstance();
include ("../inc/.configuracion.inc.php");
include ("../inc/.funciones.inc.php");
$function = new Functions;

$_SESSION[SESSION_CLIENTE] = array();
unset($_SESSION[SESSION_CLIENTE]);

if($_POST[sent] == 1){
	if ($_POST[cliente] AND $_POST[password]){
		$sql = "SELECT 
					* 
				FROM 
					fapersa_clientes 
				WHERE 
					email = '" . stripQuotes($_POST[cliente]) . "' AND 
					password = '" . encryptPassword($_POST[password]) . "'";
		$stmt=$bd->ejecutar($sql);	
		if ($x=$bd->obtener_fila($stmt,0)) {
			$_SESSION[SESSION_CLIENTE][id] = $x[id];
			$_SESSION[SESSION_CLIENTE][email] = $x[email];
			$_SESSION[SESSION_CLIENTE][password] = $_POST[password];
			$_SESSION[SESSION_CLIENTE][nombre] = $x[nombre];
			$_SESSION[SESSION_CLIENTE][god] = $x[god];
			
				header("Location: catalog.html");
				exit;
		}else{
			$error = "Nombre de usuario o contrase&ntilde;a incorrecta";
		}
	}else{
		$error = "Debe ingresar usuario o contrase&ntilde;a";
	}
}

include("header.inc.php");
?>
        <div id="menu2"><div id="acceso">
<h2 class="accesonav">Catalog Access</h2>
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
        <div id="products">
<div id="textogeneral" class="graltexto">
  <h1>Acceso Catalogo</h1>
<? if ($error) { ?>
		<div id="catalogo_header"><div id="no_result"><?=$error?></div></div>
<? } ?>
</div>	  
</div>
</div>
<?php
include("footer.inc.php"); 
?>