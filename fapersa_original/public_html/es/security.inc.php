<?
require '../inc/.conectar.class.php';
$bd=Db::getInstance();
include ("../inc/.configuracion.inc.php");
include ("../inc/.funciones.inc.php");
$function = new Functions;

if (PRODUCTION=="N") {
$sql_sec = "SELECT * FROM fapersa_clientes WHERE 
			email = '" . $_SESSION[SESSION_CLIENTE][email] . "' AND
			password = '" . encryptPassword($_SESSION[SESSION_CLIENTE][password]) . "' AND
			id = '" . $_SESSION[SESSION_CLIENTE][id] . "'";
$stmt=$bd->ejecutar($sql_sec);
if(!$x=$bd->obtener_fila($stmt,0)){
		header("Location: index.html");
		exit;
}else{
	$_SESSION[SESSION_CLIENTE][god] = 'OK';
}
}
?>