<?php

require '../inc/.conectar.class.php';
$bd=Db::getInstance();
include ("../inc/.configuracion.inc.php");
include ("../inc/.funciones.inc.php");
	

if($_POST[articulo_id]){			

				$id = $_POST[articulo_id];
				$cantidad= $_POST[cantidades];
				
				if (isset($id, $cantidad)) {
    if (is_array($_SESSION['cart_products']['id'])) {
            $_SESSION['cart_products']['id'][$id] = $id;
            $_SESSION['cart_products']['cantidad'][$id] = $cantidad;
    } else {
        $_SESSION['cart_products']['id'][$id] = $id;
        $_SESSION['cart_products']['cantidad'][$id] = $cantidad;
    }
		}
 
}
include("carrito.php");
?>