<?php

require 'inc/.conectar.class.php';
$bd=Db::getInstance();
include ("inc/.configuracion.inc.php");
include ("inc/.funciones.inc.php");
	

if($_POST[articulo_id]){			

				$id = $_POST[articulo_id];
				
        if (is_array($_SESSION['cart_products']['id'])) {
            unset($_SESSION['cart_products']['id'][$id]);
        }
 
}
include("basket_result.php");
?>