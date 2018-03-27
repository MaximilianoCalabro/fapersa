<?
include("security.inc.php");

include("header.inc.php");

if (!$_POST['submit']){ ?>
	
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
  <option value="<?=$a[id]?>"><?=utf8_decode($a[Marcas])?></option>
<?}
?></select></td>
  </tr>
	    <tr>
    <td width="35%" valign="top" align="right"><b>Descripcion:</b></td>
    <td width="65%" valign="top" align="left"><textarea rows="10" cols="45" class="fields" name="descripcion"></textarea></td>
  </tr>
	    <tr>
    <td width="35%" valign="top" align="right"><b>Numero Fapersa:</b></td>
    <td width="65%" valign="top" align="left"><input class="fields" type="textbox" name="number"></td>
  </tr>
  	    <tr>
    <td width="35%" valign="top" align="right"><b>Dimensiones:</b></td>
    <td width="65%" valign="top" align="left"><input class="fields" type="textbox" name="dimension"></td>
  </tr>
    <tr>
    <td width="35%" valign="top" align="right"><b>OEM:</b></td>
    <td width="65%" valign="top" align="left"><input class="fields" type="textbox" name="oem"></td>
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

	$sql = "select * from fapersa_products where Number='" . $_POST[number] . "'";
	$stmc=$bd->ejecutar($sql);
	$count_result=$bd->NumeroRows($stmc); 

if($count_result > "0"){
	    echo "<p align=\"center\"> Ya existe este Numero<br>$goback</p>";
}else{	
			
$sql_insert= "insert into fapersa_products set IdMarca='" .$_POST[idMarca]. "', Descripcion='" .$_POST[descripcion]."', Number='" .$_POST[number]."', Dimension='" .$_POST[dimension]."', OEM='" .$_POST[oem]."'";
$insertar=$bd->ejecutar($sql_insert);

if($insertar){
echo "<div align='center'>Nuevo Producto creado!<p><a href=\"alta_producto.php\">Agregar otro Producto</a></p><p><a href=\"productos.php\">Listado de Productos</a></p></div>";
}else{
echo "<p align=\"center\">Imposible cargar, $goback</p>";
}
}
}
include("footer.inc.php");
?>	