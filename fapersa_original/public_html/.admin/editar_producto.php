<?
include("security.inc.php");

include("header.inc.php");

if (!$_POST['editar']){

$selecte = "select * from fapersa_products where id='" .$_GET[id]. "'";
$stme=$bd->ejecutar($selecte);
$e=$bd->obtener_fila($stme,0);

 ?>	
	
<FORM action="<?=$_SERVER['PHP_SELF']?>" METHOD="POST">
<table align="center" width="100%" border="0" cellspacing="0" cellpadding="0" class="tbl_main">
            <tr><td align="left" width="100%" height="50">
<h2>Nuevo Producto</h2><br>
<table width="100%" border="0" align="center" cellpadding="2" cellspacing="1">
  <tr>
    <td width="35%" valign="top" align="right"><b>Marca:</b></td>
    <td width="65%" valign="top" align="left"><?
$selecta = "select * from fapersa_marcas order by Marcas";
$stma=$bd->ejecutar($selecta);
?>	
  	<select name="idMarca"><option value="-1">Seleccione una Marca...</option>
 <?   	  while ($a=$bd->obtener_fila($stma,0)){
   ?>
  <option value="<?=$a[id]?>" <? if($a[id]==$e[IdMarca]){?> selected <? } ?>><?=utf8_decode($a[Marcas])?></option>
<?}
?></select></td>
  </tr>
	    <tr>
    <td width="35%" valign="top" align="right"><b>Descripcion:</b></td>
    <td width="65%" valign="top" align="left"><textarea rows="10" cols="45" class="fields" name="descripcion"><?=$e[Descripcion]?></textarea></td>
  </tr>
	    <tr>
    <td width="35%" valign="top" align="right"><b>Numero Fapersa:</b></td>
    <td width="65%" valign="top" align="left"><input class="fields" type="textbox" name="number" value="<?=$e[Number]?>"></td>
  </tr>
  	    <tr>
    <td width="35%" valign="top" align="right"><b>Dimensiones:</b></td>
    <td width="65%" valign="top" align="left"><input class="fields" type="textbox" name="dimension" value="<?=$e[Dimension]?>"></td>
  </tr>
    <tr>
    <td width="35%" valign="top" align="right"><b>OEM:</b></td>
    <td width="65%" valign="top" align="left"><input class="fields" type="textbox" name="oem" value="<?=$e[OEM]?>"></td>
  </tr>
  <tr>
    <td width="35%" valign="top">&nbsp;</td>
    <td width="65%" valign="top" align="left">
    	<input name="id" type="hidden" id="id" value="<?=$e[id]?>">
	<INPUT class="fields" TYPE="submit" NAME="editar" VALUE="Editar"></td>
  </tr>
</table>
</td></tr></table>
</FORM>
<? }

if ($_POST['editar']){
			
$sql_update= "update fapersa_products set IdMarca='" .$_POST[idMarca]. "', Descripcion='" .$_POST[descripcion]."', Number='" .$_POST[number]."', Dimension='" .$_POST[dimension]."', OEM='" .$_POST[oem]."' where id='" .$_POST[id]. "'";
$update=$bd->ejecutar($sql_update);

if($update){
echo "<div align='center'>Producto editado!<p><a href=\"productos.php\">Listado de Productos</a></p></div>";
}else{
echo "<p align=\"center\">Imposible editar, $goback</p>";
}
}
include("footer.inc.php");
?>	