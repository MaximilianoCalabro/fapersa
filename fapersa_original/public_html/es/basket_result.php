<?
			if (count($_SESSION['cart_products']['id'])) {
?>				
<div id="tabla_gral">
<div id="tabla_titulo" class="titulo_tabla"><div id="code">codigo</div>
  <div id="measure">cantidad</div>
  <div id="measure">medida</div><div id="measure">marca</div><div id="descripcion">descripcion</div></div>
<?
$bgcolor="tabla_1";	

				foreach ($_SESSION['cart_products']['id'] AS $key => $value) {
						
					$id_producto = $_SESSION['cart_products']['id'][$key];
					$cantidad = $_SESSION['cart_products']['cantidad'][$key];
					$cantidad_total += $_SESSION['cart_products']['cantidad'][$key];

					
	  	$select = "select * from fapersa_products where id='" .$id_producto. "'";
			$stmi=$bd->ejecutar($select);
			$i=$bd->obtener_fila($stmi,0);		
					
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
  	<form name="fproductos<?=$key ?>" action="" onsubmit="ModificarProducto('<?=$key ?>'); return false"><input type="text" name="cantidad<?=$key ?>" size="1" maxlength="7" value="<?=$cantidad ?>"><INPUT type="image"  NAME="cantid" SRC="../images/icon_add.gif" BORDER="0" title="Agregar Carro" width="16" height="16"></a>&nbsp;<a href="#" OnClick="DelItem('<?=$key?>'); return false"><img src="../images/icon_remove.gif" title="Eliminar producto" width="16" height="16" border="0"></a></FORM>
  	</div>
<div id="measure"><?=$i[Dimension]?></div><div id="measure"><?=$m[Marcas]?></div><div id="descripcion"><?=$i[Descripcion]?></div></div>
<?
}
?>

  <div id="catalogo_header"><div id="carrito"><div id="basket_catalogo">Total de productos: <?=$cantidad_total ?></div></div></div>
  
    <div id="catalogo_header"><div id="alineacion_derecha"><a href="catalog.html?basket=cancelar"><img src="../images/erase.gif" height="28" width="105" border="0" /></a>&nbsp;<a href="send_basket.php?envio=true"><img src="../images/send.gif" height="28" width="105" border="0" /></a></div></div>
 

<?
}else{
	?>
  <div id="catalogo_header"><div id="no_result">No hay productos en su cesta<br><?=$goback?></div></div>
<?
}
?>