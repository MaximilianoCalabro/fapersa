<?php
include("security.inc.php");
include("header.inc.php");

switch ($_GET['action']) {
    case 'r':
        if (is_array($_SESSION['cart_products']['id'])) {
            foreach ($_POST[cantidad] AS $key => $value) {
                $_SESSION['cart_products']['cantidad'][$key] = $value;
            }
        }
    break;
    case 'd':
        if (is_array($_SESSION['cart_products']['id'])) {
            $key = array_search($_GET['id'], $_SESSION['cart_products']['id']);
            if ($key !== false) {
                unset($_SESSION['cart_products']['id'][$key]);
                unset($_SESSION['cart_products']['cantidad'][$key]);
            }
        }

    break;
    case 'c':
        unset($_SESSION[cart_products]);
    break;
}
unset($key);

?>
        <div id="menu2"><div id="acceso">
<h2 class="accesonav">Catalog Access</h2>
<div id="fbuscar" class="cuerpolateral"> 
<form ACTION="login.php" METHOD="POST">
<div id="campotexto"><input type="text" name="cliente" value="Client" onfocus="this.value = ''"></div> 
<div id="campotexto"><input type="password" name="password" value="Password" onfocus="this.value = ''"></div>
<div id="botonbuscar"><input type=image src="images/boton.gif" width="105" height="27"><input name="sent" type="hidden" id="sent" value="1"></div>
</form> 
</div> 
        </div>
        </div>
  </div>
        <div id="contenido">
        <div id="ourcompany">      	
<div id="textogeneral" class="graltexto">
<h1>Your Basket</h1>
<div id="basketresult"><? include("basket_result.php"); ?></div>
</div>
</div>
        </div>
        </div>
<?php
include("footer.inc.php"); 
?>
