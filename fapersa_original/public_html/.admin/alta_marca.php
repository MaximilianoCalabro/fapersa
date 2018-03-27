<?
include("security.inc.php");

include("header.inc.php");

if (!$_POST['submit']){ ?>
	
<FORM action="<?=$_SERVER['PHP_SELF']?>" METHOD="POST">
<table align="center" width="100%" border="0" cellspacing="0" cellpadding="0" class="tbl_main">
            <tr><td align="left" width="100%" height="50">
<h2>Nueva Marca</h2><br>
<table width="100%" border="0" align="center" cellpadding="2" cellspacing="1">
  <tr>
    <td width="35%" valign="top" align="right"><b>Nombre Marca:</b></td>
    <td width="65%" valign="top" align="left"><input class="fields" type="textbox" name="trade"></td>
  </tr>
  <tr>
    <td width="35%" valign="top">&nbsp;</td>
    <td width="65%" valign="top" align="left">
	<INPUT class="fields" TYPE="submit" NAME="submit" VALUE="Agregar"></td>
  </tr>
</table>
</td></tr></table>
</FORM>
<? }

if ($_POST['submit']){

$goback="<a href=\"javascript:history.back()\">Intentar De nuevo</a>";
	
if(empty($_POST['trade'])){
echo "<p align=\"center\">Debe ingresar una Marca!</p><p align=\"center\">$goback</p>";}
			
$sql_insert= "insert into fapersa_marcas set Marcas='" .utf8_encode($_POST[trade]). "'";
$insertar=$bd->ejecutar($sql_insert);

if($insertar){
echo "<div align='center'>Nueva Marca: $_POST[trade] creada!<p><a href=\"alta_marca.php\">Agregar otra Marca</a></p><p><a href=\"marcas.php\">Listado Marcas</a></p></div>";
}else{
echo "<p align=\"center\">Imposible cargar, $goback $_POST[trade]</p>";
}
}

include("footer.inc.php");
?>	