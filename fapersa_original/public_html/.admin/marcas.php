<?
include("security.inc.php");

include("header.inc.php"); ?>

<table border="0" cellpadding="0" cellspacing="0" width="100%" class="tbl_main">
<tr><td width="100%" valign="top" align="left"><h2>Marcas</h2></td></tr></table>

<?
if ($_GET['del']==1){
	$sql = "delete from fapersa_marcas where id='" .$_GET[id]. "'";
	$borrar=$bd->ejecutar($sql);
if ($borrar){
	echo"<br><p align=\"center\">Marca Borrada<br><br><a href=\"marcas.php\">Volver a Marcas</a></p>";}
}

if(!$_GET['del']){
 $sql_count = "select * from fapersa_marcas order by Marcas";
	$stmt=$bd->ejecutar($sql_count);
	$totalrows=$bd->NumeroRows($stmt);
	
if ($totalrows==0){
	echo "<br><p align=\"center\">No Hay Marcas<br><br><a href=\"alta_marca.php\">Agregar Marcas</a></p>";
	include_once ("footer.inc.php");
	exit;
	}
?>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tr><td width="100%" valign="top">
<form action="marcas.php?search=yes&ddlimit=<?=$ddlimit ?>" method="post"><tr><td align="right"><font style="font-size: 9pt">Busqueda </font><input type="text" class="campos" name="searchStr">&nbsp;<input type="submit" class="boton" value="Buscar">
<br><br></td></tr></form></td></tr></table>

<?
$searchStr = str_replace(" ", "",$_POST[searchStr]); 

if($_GET[search]!=="yes"){
$query = "select * from fapersa_marcas order by Marcas asc LIMIT $limitvalue, $limit";}

if($_GET[search]=="yes"){
$query = "SELECT * FROM fapersa_marcas where (Marcas like '%" .$_POST[searchStr]. "%') order by Marcas asc LIMIT $limitvalue, $limit";}

$stmt=$bd->ejecutar($query);
$result=$bd->NumeroRows($stmt);

if($result == 0){
if($_GET[search]!=="yes"){
            echo"<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">
              <tr>
                <td width=\"100%\">No hay Marcas.</td>
              </tr>
            </table>";
             }
if($_GET[search]=="yes"){
?><p align="center"><br>No hay Resultados para esta busqueda <b><?=$_POST[searchStr]?></b>"!<br><br><a href="marcas.php" target="_self">Resetear</a></p>
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
            <tr><td><p align=\"left\">Marcas en Total:"; if($_GET[search]=="yes"){
	 echo"$result"; 
	 }else{
	 	 echo"$totalrows</p></td></tr></table>"; 
	 	 }
?>	 	 
<table align="center" width="95%" border="0" cellspacing="0" cellpadding="0">
<tr><td align="right"><a href="alta_marca.php"><b>Agregar Marca</b></a><br><br></td></tr></table>
<table align="center" width="95%" border="0" cellspacing="0" cellpadding="0">
            <tr><td height="20">
<table cellpadding="2" border="0" cellspacing="1" width="100%" align="center">
	  <tr class="tbl_mi" height="20">
	  <td align="center" width="80%"><b>Marca</b></td>
	  <td align="center" width="20%"><b>Accion</b></td>
	  </tr>
<?     
	  $bgcolor=$color_3;
	  
	  while ($x=$bd->obtener_fila($stmt,0)){
	  	
	  		if ($bgcolor ==$color_3){
				$bgcolor =$color_4;}
				elseif ($bgcolor ==$color_4){
				$bgcolor =$color_3;}
				
	  echo "<tr bgcolor='$bgcolor'>";
		echo "<td align='left'>" .utf8_decode($x[Marcas]). "</td>";
		echo "<td align='center'><a href='editar_marca.php?id=" .$x[id]."'><IMG NAME='modificar' SRC='images/modificar.png' BORDER='0' ALT='Editar' width='18' height='18'></a> <a href=\"javascript:decision('esta seguro que desea borrar este marca! Presione OK para continuar','marcas.php?id=" .$x[id]."&del=1')\"><IMG NAME='borrar' SRC='images/eliminar.png' BORDER='0' ALT='Borrar' width='18' height='18'></a></td></tr>";
}

  echo"</table>";
  $function->paginacion($_GET[page],$limit,$_GET[search],$_GET[searchStr],$result,$totalrows,$pagina);
  echo"</td></tr></table>";
  }

}
include("footer.inc.php");
?>