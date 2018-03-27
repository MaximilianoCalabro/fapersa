<?php
// session carrito
if (count($_SESSION['cart_products']['id'])) {
	
				foreach ($_SESSION['cart_products']['id'] AS $key => $value) {
					
					$totales += $_SESSION['cart_products']['cantidad'][$key];
				}
?>
<div id="basket_catalogo"><a href="basket.php"><img src="images/basket.png" height="13" width="14" border="0" /></a>&nbsp;Your basket:&nbsp;<?=$totales ?> product</div>
<?
}else{ ?>
<div id="basket_catalogo"><img src="images/basket.png" height="13" width="14" border="0" />&nbsp;Your basket: empty</div>
<?
}	
//fin session
?>