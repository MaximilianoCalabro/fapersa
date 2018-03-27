<?
require '../inc/.conectar.class.php';
$bd=Db::getInstance();
include ("../inc/.configuracion.inc.php");
include ("../inc/.funciones.inc.php");
$function = new Functions;

$sql_sec = "SELECT id, god FROM admin_users WHERE 
			username = '" . $_SESSION[SESSION_ADMIN][user] . "' AND 
			password = '" . encryptPassword($_SESSION[SESSION_ADMIN][pass]) . "' AND
			id = '" . $_SESSION[SESSION_ADMIN][id] . "'";
$stmt=$bd->ejecutar($sql_sec);
if(!$x=$bd->obtener_fila($stmt,0)){
		header("Location: login.php");
		exit;
}else{
	$_SESSION[SESSION_ADMIN][god] = $x[god];
}
?>