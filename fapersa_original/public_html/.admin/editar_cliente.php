<?
include("security.inc.php");

include("header.inc.php");

if (!$_POST['editar']){

$selectm = "select * from fapersa_clientes where id='" .$_GET[id]. "'";
$stmm=$bd->ejecutar($selectm);
$m=$bd->obtener_fila($stmm,0);

?>
	
<FORM action="<?=$_SERVER['PHP_SELF']?>" METHOD="POST">
<table align="center" width="100%" border="0" cellspacing="0" cellpadding="0" class="tbl_main">
            <tr><td align="left" width="100%" height="50">
<h2>Nuevo  Cliente</h2><br>
<table width="100%" border="0" align="center" cellpadding="2" cellspacing="1">
  <tr>
    <td width="35%" valign="top" align="right"><b>Nombre:</b></td>
    <td width="65%" valign="top" align="left"><input class="fields" type="textbox" name="nombre" value="<?=$m[nombre]?>"></td>
  </tr>
    <tr>
    <td width="35%" valign="top" align="right"><b>Email:</b></td>
    <td width="65%" valign="top" align="left"><input class="fields" type="textbox" name="email" value="<?=$m[email]?>"></td>
  </tr>
    <tr>
    <td width="35%" valign="top" align="right"><b>Contrase&ntilde;a:</b></td>
    <td width="65%" valign="top" align="left"><input class="fields" type="password" name="password"></td>
  </tr>
      <tr>
    <td width="35%" valign="top" align="right"><b>Confirmar Contrase&ntilde;a:</b></td>
    <td width="65%" valign="top" align="left"><input class="fields" type="password" name="password2"></td>
  </tr>
  <tr>
    <td width="35%" valign="top">&nbsp;</td>
    <td width="65%" valign="top" align="left">
    	<input name="correo" type="hidden" id="correo" value="<?=$m[email]?>">
    	<input name="id" type="hidden" id="id" value="<?=$m[id]?>">
	<INPUT class="fields" TYPE="submit" NAME="editar" VALUE="Editar"></td>
  </tr>
</table>
</td></tr></table>
</FORM>
<? }

if ($_POST['editar']){

$goback="<a href=\"javascript:history.back()\">Intentar De nuevo</a>";

if(($_POST[email]) !== ($_POST[correo])){

$dupe_email = "select * from fapersa_clientes where email = '" .$_POST[email]. "'";
$stmt=$bd->ejecutar($dupe_email);
$totalrows=$bd->NumeroRows($stmt);
        if ($totalrows > 0)
        {
echo "<p align=\"center\"><font color=#990000><b>La dirección de E-mail que usted ingreso ya esta en uso por otro usuario.</b></font></p>
<p align=\"center\">$goback</p>";
include("footer.inc.php");
exit();
		}
}		
		
	if (($_POST[password]) !== ($_POST[password2]))
	{
		Echo "<p align='center'><font color=#990000><b>Error: Las claves ingresadas no coinciden.</b></font></p>
		<p align=\"center\">$goback</p>";
	include("footer.inc.php");
	exit();
	}

	if ((strlen($_POST[password])<6 || strlen($_POST[password]) >20)and(strlen($_POST[password2])<6 || strlen($_POST[password2]) >20))
		{
		echo "<p align='center'><font color=#990000><b>Error: La clave ingresada debe contener entre 6 a 20 caracteres.</b></font></p>
		<p align=\"center\">$goback</p>";
	include("footer.inc.php");
	exit();
		}		
	
if(empty($_POST['nombre'])){
echo "<p align=\"center\">Debe ingresar un Nombre!</p><p align=\"center\">$goback</p>";
include("footer.inc.php");
exit();
}
			
$sql_insert= "update fapersa_clientes set nombre='" .utf8_encode($_POST[nombre]). "', email='" .$_POST[email]. "', password='" .encryptPassword($_POST[password]). "' where id='" .$_POST[id]. "'";
$insertar=$bd->ejecutar($sql_insert);

if($insertar){
echo "<div align='center'>Cliente: $_POST[nombre] editado!<p><a href=\"alta_cliente.php\">Agregar otro Cliente</a></p><p><a href=\"clientes.php\">Listado Clientes</a></p></div>";
}else{
echo "<p align=\"center\">Imposible editar, $goback $_POST[nombre]</p>";
}
}

include("footer.inc.php");
?>	