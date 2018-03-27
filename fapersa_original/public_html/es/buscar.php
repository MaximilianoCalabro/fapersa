<?php

require '../inc/.conectar.class.php';
$bd=Db::getInstance();
include ("../inc/.configuracion.inc.php");
include ("../inc/.funciones.inc.php");

  sleep(2);
  
$RegistrosAMostrar=10;
if(isset($_POST['pag'])){
$RegistrosAEmpezar=($_POST['pag']-1)*$RegistrosAMostrar;
$PagAct=$_POST['pag'];
}else{
$RegistrosAEmpezar=0;
$PagAct=1;
}  

			if($_POST[id_marca]=="-1"){
					if(empty($_POST[code])){
	  	$select = "select * from fapersa_products order by Descripcion desc LIMIT $RegistrosAEmpezar, $RegistrosAMostrar";
			$stmi=$bd->ejecutar($select);
					}else{
			$select = "select * from fapersa_products where (Descripcion like '%" .$_POST[code]. "%' or Number like '%" .$_POST[code]. "%') order by Descripcion desc LIMIT $RegistrosAEmpezar, $RegistrosAMostrar";
			$stmi=$bd->ejecutar($select);
				}}else{
					if(empty($_POST[code])){
	  	$select = "select * from fapersa_products where IdMarca='" .$_POST[id_marca]. "' order by Descripcion desc LIMIT $RegistrosAEmpezar, $RegistrosAMostrar";
			$stmi=$bd->ejecutar($select);
					}else{
			$select = "select * from fapersa_products where (Descripcion like '%" .$_POST[code]. "%' or Number like '%" .$_POST[code]. "%') and  IdMarca='" .$_POST[id_marca]. "' order by Descripcion desc LIMIT $RegistrosAEmpezar, $RegistrosAMostrar";
			$stmi=$bd->ejecutar($select);
				}
		}

$total_items=$bd->NumeroRows($stmi);
			
if ($total_items !== 0){
?>
<div id="tabla_gral">
<div id="tabla_titulo" class="titulo_tabla"><div id="code">codigo</div>
  <div id="measure">cantidad</div>
  <div id="measure">medida</div><div id="measure">marca</div><div id="descripcion">descripcion</div></div>
 <?
$bgcolor="tabla_1";			
while ($i=$bd->obtener_fila($stmi,0)){			
					
	  	$selectm = "select * from fapersa_marcas where id='" .$i[IdMarca]. "'";
			$stmm=$bd->ejecutar($selectm);
			$m=$bd->obtener_fila($stmm,0);
		
			  if ($bgcolor =="tabla_1"){
				$bgcolor ="tabla_2";}
				elseif ($bgcolor =="tabla_2"){
				$bgcolor ="tabla_1";}
?>
<div id="<?=$bgcolor?>"><div id="code"><?=$i[Number]?></div>
  <div id="measure">
  	<form name="fproductos<?=$i[id]?>" action="" onsubmit="CargarProducto('<?=$i[id]?>'); return false"><input type="text" name="cantidad<?=$i[id]?>" size="1" maxlength="7" value="1"><INPUT type="image"  NAME="cantid" SRC="../images/yes.gif" BORDER="0" title="Agregar Carro" width="18" height="17"></a></FORM>
  	</div>
<div id="measure"><?=$i[Dimension]?></div><div id="measure"><?=$m[Marcas]?></div><div id="descripcion"><?=$i[Descripcion]?></div></div>
<? 
  //$total = $total + $i['SubTotal'];
  }
  ?>
<?  
}else{
?>
<div id="no_result">No Hay resultados para esta Busqueda</div>
<?
}
?>
</div>
<?

//******--------determinar las p&aacute;ginas---------******//

			if($_POST[id_marca]=="-1"){
					if(empty($_POST[code])){
	  	$select = "select * from fapersa_products";
			$stmi=$bd->ejecutar($select);
					}else{
			$select = "select * from fapersa_products where (Descripcion like '%" .$_POST[code]. "%' or Number like '%" .$_POST[code]. "%')";
			$stmi=$bd->ejecutar($select);
				}}else{
					if(empty($_POST[code])){
	  	$select = "select * from fapersa_products where IdMarca='" .$_POST[id_marca]. "'";
			$stmi=$bd->ejecutar($select);
					}else{
			$select = "select * from fapersa_products where (Descripcion like '%" .$_POST[code]. "%' or Number like '%" .$_POST[code]. "%') and  IdMarca='" .$_POST[id_marca]. "'";
			$stmi=$bd->ejecutar($select);
				}
		}
		
$NroRegistros=$bd->NumeroRows($stmi);

if($NroRegistros > $RegistrosAMostrar){
			
$PagAnt=$PagAct-1;
$PagSig=$PagAct+1;
$PagUlt=$NroRegistros/$RegistrosAMostrar;
$Res=$NroRegistros%$RegistrosAMostrar;
if($Res > 0) $PagUlt=floor($PagUlt)+1;?>
<div id="paginacion"><div id="links"><a href="#" class="menunav" OnClick="Pagina('1','<?=$_POST[code]?>','<?=$_POST[id_marca]?>');"><b><<</b></a>
<?
if($PagAct > 1) ?><a href="#" class="menunav" OnClick="Pagina('<?=$PagAnt?>','<?=$_POST[code]?>','<?=$_POST[id_marca]?>');"><b><</b></a>
<strong>Pagina <?=$PagAct."/".$PagUlt ?></strong> <?
if($PagAct < $PagUlt) ?>
<a href="#" class="menunav" OnClick="Pagina('<?=$PagSig?>','<?=$_POST[code]?>','<?=$_POST[id_marca]?>');"><b>></b></a>
<a href="#" class="menunav" OnClick="Pagina('<?=$PagUlt?>','<?=$_POST[code]?>','<?=$_POST[id_marca]?>');"><b>>></b></a><br><br></div></div>
<?
}
?>