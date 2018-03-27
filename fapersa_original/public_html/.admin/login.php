<?
require '../inc/.conectar.class.php';
$bd=Db::getInstance();
include ("../inc/.configuracion.inc.php");
include ("../inc/.funciones.inc.php");
$function = new Functions;

$_SESSION[SESSION_ADMIN] = array();
unset($_SESSION[SESSION_ADMIN]);

if($_POST[sent] == 1){
	if ($_POST[username] AND $_POST[password]){
		$sql = "SELECT 
					* 
				FROM 
					admin_users 
				WHERE 
					username = '" . stripQuotes($_POST[username]) . "' AND 
					password = '" . encryptPassword($_POST[password]) . "'";
		$stmt=$bd->ejecutar($sql);	
		if ($x=$bd->obtener_fila($stmt,0)) {
			$_SESSION[SESSION_ADMIN][id] = $x[id];
			$_SESSION[SESSION_ADMIN][user] = $x[username];
			$_SESSION[SESSION_ADMIN][pass] = $_POST[password];
			$_SESSION[SESSION_ADMIN][complete_name] = $x[complete_name];
			$_SESSION[SESSION_ADMIN][god] = $x[god];
			
				header("Location: index.php");
				exit;
		}else{
			$error = "Nombre de usuario o contraseña incorrecta";
		}
	}else{
		$error = "Debe ingresar usuario o contraseña";
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title><?=ADMIN_TITLE?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style>
body, html, #outer {
	height: 100%;
	width: 100%;
	margin: 0;
	padding: 0;
}
</style>
</head>
<link rel="stylesheet" href="images/styles.css" type="text/css">
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onload="document.form.username.focus();">
<table width="100%" border="0" cellpadding="0" cellspacing="0" id="outer">
	<tr>
		<td><table border="0" align="center" cellpadding="0" cellspacing="0">
			<tr>
				<td><img src="images/login_header.jpg" width="371" height="103" /></td>
			</tr>
			<tr>
				<td height="152" valign="top" background="images/login_bg.jpg" class="borders">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td height="35" align="center" valign="bottom" class="txt_dark"><?
								if ($error) {
								?><b><?=$error ?></b><?
								}else{
								?>Ingrese nombre de usuario y contrase&ntilde;a<?
								}
								?></td>
						</tr>
						<tr>
							<td height="10"></td>
						</tr>
						<tr>
							<td height="106">
								<table border="0" align="center" cellpadding="0" cellspacing="4">
									<form name="form" method="post" action="<?=$_SERVER['PHP_SELF']?>">
									<tr>
										<td><img src="images/login_username.png" width="74" height="18" /></td>
										<td>&nbsp;</td>
										<td><input name="username" class="fields_stylish" id="username" value="<?=$_POST[username]?>" size="18" maxlength="50" tabindex="1"></td>
									</tr>
									<tr>
										<td><img src="images/login_password.png" width="74" height="18" /></td>
										<td>&nbsp;</td>
										<td><input name="password" type="password" class="fields_stylish" id="password" size="18" maxlength="50" tabindex="2"></td>
									</tr>
									<tr>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>
											<input name="button" type="submit" class="button_stylish" id="button" value="Ingresar" tabindex="3" />
											<input name="sent" type="hidden" id="sent" value="1">
										</td>
									</tr>
									</form>
								</table>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td><img src="images/login_footer.jpg" width="371" height="60" /></td>
			</tr>
		</table></td>
	</tr>
</table>
</body>
</html>