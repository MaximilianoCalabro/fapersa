<?
include("security.inc.php");

include("header.inc.php"); ?>

<table border="0" cellpadding="0" cellspacing="0" width="100%" class="tbl_main">
<tr><td width="100%" valign="top" align="left"><h2>Productos</h2></td></tr></table>

<?
if ($_GET['del']==1){
	$sql = "delete from fapersa_products where id='" .$_GET[id]. "'";
	$borrar=$bd->ejecutar($sql);
if ($borrar){
	echo"<br><p align=\"center\">Producto Borrado<br><br><a href=\"productos.php\">Volver a Productos</a></p>";}
}

if(!$_GET['del']){
 $sql_count = "select * FROM fapersa_products INNER JOIN fapersa_marcas ON fapersa_products.IdMarca = fapersa_marcas.id order by fapersa_marcas.Marcas desc";	
	$stmt=$bd->ejecutar($sql_count);
	$totalrows=$bd->NumeroRows($stmt);
	
if ($totalrows==0){
	echo "<br><p align=\"center\">No Hay Productos<br><br><a href=\"alta_producto.php\">Agregar Producto</a></p>";
	include_once ("footer.inc.php");
	exit;
	}
?>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tr><td width="100%" valign="top">
<form action="productos.php?search=yes&ddlimit=<?=$ddlimit ?>" method="post"><tr><td align="right"><font style="font-size: 9pt">Busqueda </font><input type="text" class="campos" name="searchStr">&nbsp;<input type="submit" class="boton" value="Buscar">
<br><br></td></tr></form></td></tr></table>

<?
//$searchStr = str_replace(" ", "",$_POST[searchStr]); 

if($_GET[search]!=="yes"){
$query = "select * FROM fapersa_products INNER JOIN fapersa_marcas ON fapersa_products.IdMarca = fapersa_marcas.id order by fapersa_marcas.Marcas asc LIMIT $limitvalue, $limit";}

if($_GET[search]=="yes"){
$query = "SELECT * , MATCH (Numbre,Descripcion) AGAINST ('%" .$_POST[searchStr]. "%') AS busqueda FROM fapersa_products WHERE MATCH (Numbre,Descripcion) AGAINST ('%" .$_POST[searchStr]. "%') LIMIT $limitvalue, $limit";}

$stmt=$bd->ejecutar($query);
$result=$bd->NumeroRows($stmt);

if($result == 0){
if($_GET[search]!=="yes"){
            echo"<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">
              <tr>
                <td width=\"100%\">No hay Productos.</td>
              </tr>
            </table>";
             }
if($_GET[search]=="yes"){
?><p align="center"><br>No hay Resultados para esta busqueda <b><?=$_POST[searchStr]?></b>"!<br><br><a href="productos.php" target="_self">Resetear</a></p>
<? }
					include_once ("footer.inc.php");
					exit;
					}
if($result > 0){
if($_GET[search]=="yes"){ ?>
<p align="center"><br>Resultado encontrados<b><?=$_POST[searchStr]?></b>!</p><br>
<? }
}          
			if($result > 0){

	 	 echo "<table align=\"center\" width=\"95%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
            <tr><td><p align=\"left\">Productos en Total:"; if($_GET[search]=="yes"){
	 echo"$result"; 
	 }else{
	 	 echo"$totalrows</p></td></tr></table>"; 
	 	 }
?>	 	 
<table align="center" width="95%" border="0" cellspacing="0" cellpadding="0">
<tr><td align="right"><a href="alta_producto.php"><b>Agregar Producto</b></a><br><br></td></tr></table>
<table align="center" width="95%" border="0" cellspacing="0" cellpadding="0">
            <tr><td height="20">
<table cellpadding="2" border="0" cellspacing="1" width="100%" align="center">
	  <tr class="tbl_mi" height="20">
	  <td align="center" width="30%"><b>Marca</b></td>
	  <td align="center" width="20%"><b>Descripcion</b></td>
	  <td align="center" width="15%"><b>Number</b></td>
	  <td align="center" width="15%"><b>Dimension</b></td>
	  <td align="center" width="10%"><b>OEM</b></td>
	  <td align="center" width="10%"><b>Accion</b></td>
	  </tr>
<?     
	  $bgcolor=$color_3;
	  
	  while ($x=$bd->obtener_fila($stmt,0)){
	  	
	  		if ($bgcolor ==$color_3){
				$bgcolor =$color_4;}
				elseif ($bgcolor ==$color_4){
				$bgcolor =$color_3;}
			      
		$selecta = "select * from fapersa_marcas where id='" .$x[IdMarca]. "'";
			$stma=$bd->ejecutar($selecta);
			$a=$bd->obtener_fila($stma,0);
				
	  echo "<tr bgcolor='$bgcolor'>";
		echo "<td align='left'>" .utf8_decode($a[Marcas]). "</td>";
		echo "<td align='left'>" .$x[Descripcion]. "</td>";
		echo "<td align='left'>" .$x[Number]. "</td>";
		echo "<td align='left'>" .$x[Dimension]. "</td>";
		echo "<td align='left'>" .$x[OEM]. "</td>";
		echo "<td align='center'><a href='editar_producto.php?id=" .$x[id]."'><IMG NAME='modificar' SRC='images/modificar.png' BORDER='0' ALT='Editar' width='18' height='18'></a><a href=\"javascript:decision('esta seguro que desea borrar este Producto! Presione OK para continuar','productos.php?id=" .$x[id]."&del=1')\"><IMG NAME='borrar' SRC='images/eliminar.png' BORDER='0' ALT='Borrar' width='18' height='18'></a></td></tr>";
			}
  echo"</table>";
  $function->paginacion($_GET[page],$limit,$_GET[search],$_GET[searchStr],$result,$totalrows,$pagina);
  echo"</td></tr></table>";
  }

}
include("footer.inc.php");
?>