<?
include("security.inc.php");

include("header.inc.php");

if (!$_POST['editar']){

$selectm = "select * from fapersa_marcas where id='" .$_GET[id]. "'";
$stmm=$bd->ejecutar($selectm);
$m=$bd->obtener_fila($stmm,0);

?>
	
<FORM action="<?=$_SERVER['PHP_SELF']?>" METHOD="POST">
<table align="center" width="100%" border="0" cellspacing="0" cellpadding="0" class="tbl_main">
            <tr><td align="left" width="100%" height="50">
<h2>Editar Marca</h2><br>
<table width="100%" border="0" align="center" cellpadding="2" cellspacing="1">
  <tr>
    <td width="35%" valign="top" align="right"><b>Nombre Marca:</b></td>
    <td width="65%" valign="top" align="left"><input class="fields" type="textbox" name="marca" value="<?=$m[Marcas]?>"></td>
  </tr>
  <tr>
    <td width="35%" valign="top">&nbsp;</td>
    <td width="65%" valign="top" align="left">
    	<input name="id" type="hidden" id="id" value="<?=$m[id]?>">
	<INPUT class="fields" TYPE="submit" NAME="editar" VALUE="Editar"></td>
  </tr>
</table>
</td></tr></table>
</FORM>
<? }

if ($_POST['editar']){

$goback="<a href=\"javascript:history.back()\">Intentar De nuevo</a>";
	
if(empty($_POST['marca'])){
echo "<p align=\"center\">Debe ingresar una Marca!</p><p align=\"center\">$goback</p>";}
			
$sql_update= "update fapersa_marcas set Marcas='" .utf8_encode($_POST[marca]). "' where id='" .$_POST[id]. "'";
$update=$bd->ejecutar($sql_update);

if($update){
echo "<div align='center'>Marca: $_POST[agronomia] editada!<p><a href=\"marcas.php\">Listado de Marcas</a></p></div>";
}else{
echo "<p align=\"center\">Imposible editar, $goback $_POST[marca]</p>";
}
}

include("footer.inc.php");
?>	