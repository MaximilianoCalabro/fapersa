<?php

function stripQuotesNoSpecials($value) {
	return str_replace("'", "&#039;", $value);
}

function stripQuotes($value) {
	$value = htmlspecialchars($value);
	return str_replace("'", "&#039;", $value);
}

function encryptPassword($password, $username = "") {
	
	if ($username) {
		$userLength = strlen($username);
		
		$userHalf = ceil($userLength / 2);
		
		$userStart = substr($username, 0, $userHalf);
		$userEnd = substr($username, $userHalf, $userLength);
	}
	
	return md5(sha1($userStart . $password . $userEnd));
}
	
	///
	// inicio Compras class
	///
	class Functions
	{

		
function paginacion($page,$limit,$search,$searchStr,$count_result,$totalrows,$pagina)
{

if(empty($page)) 
$page = 1; 
$limitvalue = $page * $limit - ($limit); 

if($search=="yes"){
$numofpages = ceil($count_result / $limit);
}else{
$numofpages = ceil($totalrows / $limit);
}
$from=$limit*$page-$limit+1;
$to=$from + $count_result-1;

echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
            <tr><td width=\"50%\" height=\"30\" align=\"left\" valign=\"bottom\">";
            if($numofpages > 1){
            echo"<small>Mostrando $from - $to</td><td width=\"50%\" align=\"right\" height=\"30\" valign=\"bottom\"><b><small>ir a pagina</small></b><small>($numofpages)</small>"; 
            

$upper_limit = $page + 3;
$lower_limit = $page - 2;

if($page != 1){ 
$pageprev = $page - 1; 
echo("<a href=\"$pagina?page=1&ddlimit=$ddlimit&searchStr=$searchStr\"><small>Anterior</small></a>&nbsp;"); 
}  

$lower_dots = $page - $lowerlimit;

if($lower_dots > 3){
echo("...");}

for($i = 1; $i <= $numofpages; $i++){ 
if($numofpages>1){

if($i == $page){
echo("&nbsp;<b><small>[".$i."]</small></b>&nbsp;");} 
if(($i != $page)&&($i < $upper_limit)&&($i >= $lower_limit)){
echo("&nbsp;<a href=\"$pagina?page=$i&ddlimit=$ddlimit&searchStr=$searchStr\"><small>$i</small></a>&nbsp;");}
}}

$upper_dots = $numofpages - 2;

if($page < $upper_dots){
echo("...&nbsp;");}

if(($totalrows - ($limit * $page)) > 0){ 
$pagenext = $page + 1; 
echo("&nbsp;<a href=\"$pagina?page=$pagenext&ddlimit=$ddlimit&searchStr=$searchStr\"><small>Siguiente</small></a>"); 
}

}

mysql_free_result($result);
echo"</td></tr></table>";

}

function ordencompra_actualizar_items($ic_id,$id_solicitud,$id_proveedor,$ultimo_id,$id_user,$fecha_hora_actual){
	
	global $bd;
	
	if($ic_id!=="0"){
	
	  	$select = "select * from compras_items_solicitud where IdInvitacion='$ic_id' and IdSolicitud='$id_solicitud' and IdProveedorSeleccionado='$id_proveedor'";
			$stmi=$bd->ejecutar($select);
			$total_items=$bd->NumeroRows($stmi);
			
		}else{
			
			$select = "select * from compras_items_solicitud where IdInvitacion='$ic_id' and IdSolicitud='$id_solicitud' and IdProveedorSugerido='$id_proveedor'";
			$stmi=$bd->ejecutar($select);
			$total_items=$bd->NumeroRows($stmi);
			
		}

if ($total_items !== 0){
	
	    	  while ($i=$bd->obtener_fila($stmi,0)){
							$id_item = $i['id'];
							$itemsolicitud = $i['ItemSolicitud'];
							$montopactado = $i['MontoPactado'];
							$montoaproxi = $i['MontoAproximado'];
							$cantidad = $i['Cantidad'];
							if($montopactado == "0.00"){
							$montopactado=$montoaproxi;}
							$subtotal = $montopactado * $cantidad;
							
if($ic_id!=="0"){							
	  	$select_item = "select * from compras_cotizaciones where IdInvitacion='$ic_id' and IdItemSolicitud='$id_item' and EsSeleccionado='Y'";
			$stmm=$bd->ejecutar($select_item);
			$m=$bd->obtener_fila($stmm,0);
			$total_item=$bd->NumeroRows($stmm);

		if ($total_item !== 0){
			$itemsolicitud = $m['ItemOfertado'];
		}
	}				
												
		$sql_update= "update compras_items_solicitud set IdOrdenDeCompra='$ultimo_id' where id='$id_item'";
		$update=$bd->ejecutar($sql_update);
		$sql_update2= "update compras_cotizaciones set IdOrdenDeCompra='$ultimo_id' where id='$id_item'";
		$update2=$bd->ejecutar($sql_update2);
		$sql_insert= "insert into compras_items_orden_compra set IdOrdenDeCompra='$ultimo_id', IdItemSolicitud='$id_item', ItemOrdenDeCompra='$itemsolicitud', PrecioUnitario='$montopactado', SubTotal='$subtotal', IdCreadoPor='$id_user', HoraCreacion='$fecha_hora_actual'";
		$insertar=$bd->ejecutar($sql_insert);
	}
}
							
}

function cerrar_sbs($oc_id){
	
	global $bd;
	
		$sql = "select * from compras_ordenes_compras where id='$oc_id'";
	$stmt=$bd->ejecutar($sql);
	
		    	  while ($t=$bd->obtener_fila($stmt,0)){
							$id_solicitud = $t['IdSolicitud '];
						}

		$sql_update2= "update compras_solicitudes set IdEstadoDeSbs='171' where id='$id_solicitud'";
		$update2=$bd->ejecutar($sql_update2);
							
}

function solicitud_actualizar($id_temporal){
	
	global $bd;
	
	$sql = "select * from compras_solicitudes where IdTemp='$id_temporal'";
	$stmt=$bd->ejecutar($sql);
	
		    	  while ($t=$bd->obtener_fila($stmt,0)){
							$id = $t['id'];
						}

	$select = "select * from compras_items_solicitud where IdSolicitud='$id_temporal'";
	$stmi=$bd->ejecutar($select);
	    	  while ($i=$bd->obtener_fila($stmi,0)){
							$id_item = $i['id'];
												
		$sql_update= "update compras_items_solicitud set IdSolicitud='$id' where id='$id_item'";
		$update=$bd->ejecutar($sql_update);
}

		$sql_update2= "update compras_solicitudes set IdTemp='0' where id='$id'";
		$update2=$bd->ejecutar($sql_update2);
							
}

function domicilio_entrega($id_solicitud){
	
	global $bd;

	$sql_counts = "select * from compras_solicitudes where id='$id_solicitud'"; 
	$stms=$bd->ejecutar($sql_counts);
	
				while ($s=$bd->obtener_fila($stms,0)){
					$institucion  = $s['IdInstitucion'];
					$solicitante  = $s['IdSolicitante'];
					$contents["solicitante"] = $solicitante;
				}
				
					$sql_countd = "select * from compras_instituciones where id='$institucion'"; 
					$stmd=$bd->ejecutar($sql_countd);
	
				while ($d=$bd->obtener_fila($stmd,0)){
					$domicilio  = $d['IdDomicilioDeEntrega'];
					$contents["domicilio"] = $domicilio;	
				}
				
					return $contents;
}	

function cotizacion_actualizar($ic_id,$id_prove,$plazo,$formapago,$code,$fecha_actual){
	
	global $bd;

	  	$sele = "select * from compras_items_invitacion where IdInvitacion='$ic_id' and IdProveedor='$id_prove'";
			$stmo=$bd->ejecutar($sele);
			
while ($o=$bd->obtener_fila($stmo,0)){
	
	$id_item_solicitud= $o['IdItemSolicitud'];
	$item_ofertado = $o['ItemOfertado'];
	$item_precio= $o['ItemPrecio'];
	
			  $select = "select * from compras_items_solicitud where IdInvitacion='$ic_id' and id='$id_item_solicitud'";
			$stmi=$bd->ejecutar($select);
			$total_items=$bd->NumeroRows($stmi);
			
while ($i=$bd->obtener_fila($stmi,0)){
	
	$subtotal = $i['Cantidad'] * $item_precio;
	$total = $total + $subtotal;
}
}
	
		
$sql_insert= "update compras_proveedores_invitacion set FechaCotizacion='$fecha_actual', PlazoDeEntrega='$plazo', FormaDePago='$formapago', MontoTotal='$total' where id='$id_prove' and IdInvitacion='$ic_id'";
$insert=$bd->ejecutar($sql_insert);

$sql_count = "select * from compras_items_invitacion where IdProveedor='$id_prove' and code='$code'";
$stme=$bd->ejecutar($sql_count);

while ($e=$bd->obtener_fila($stme,0)){
	 $iditemsolicitud = $e['IdItemSolicitud'];
	 $itemofertado = $e['ItemOfertado'];
	 $itemprecio = $e['ItemPrecio'];
	 		$select = "select * from compras_items_solicitud where IdInvitacion='$ic_id' and id='$id_item_solicitud'";
			$stmi=$bd->ejecutar($select);
			$total_items=$bd->NumeroRows($stmi);		
			while ($i=$bd->obtener_fila($stmi,0)){
			$subtotal = $i['Cantidad'] * $item_precio;
			}
   $sql_update= "update compras_items_invitacion set code='0' where IdInvitacion='$ic_id' and IdProveedor='$id_prove'";
	 $update=$bd->ejecutar($sql_update);
	 $sql_countb = "select * from compras_cotizaciones where IdItemSolicitud='$iditemsolicitud ' and IdProveedor='$id_prove'";
	 $stmb=$bd->ejecutar($sql_countb);
	 $total_afected=$bd->NumeroRows($stmb);
	 if($total_afected == 0){
	 			$insertar= "insert into compras_cotizaciones set IdInvitacion='$ic_id', IdProveedor='$id_prove', IdItemSolicitud='$iditemsolicitud', ItemOfertado='$itemofertado', PrecioUnitario='$itemprecio', Subtotal='$subtotal'";
	 			$insert=$bd->ejecutar($insertar);
	}else{
			 $updateb= "update compras_cotizaciones set  ItemOfertado='$itemofertado', PrecioUnitario='$itemprecio', Subtotal='$subtotal' where IdItemSolicitud='$iditemsolicitud ' and IdProveedor='$id_prove'";
	 		 $updates=$bd->ejecutar($updateb);
		}
	}
	
			// inicio del email de cotizacion

					$seleccionu = "select * from compras_invitaciones where id='$ic_id'";
					$stmu=$bd->ejecutar($seleccionu);	

					while ($u=$bd->obtener_fila($stmu,0)){
				   $usuario= $u['IdCreadoPor'];
						}
						
						$seleccionusu = "select * from compras_usuarios where id='$usuario'";
						$stma=$bd->ejecutar($seleccionusu);	

					while ($a=$bd->obtener_fila($stma,0)){
				   $email_user= $a['Email'];
				   $administrador = $a['Usuario'];
						}
						
						$seleccionpro = "select * from compras_proveedores_invitacion where id='$id_prove'";
						$stmp=$bd->ejecutar($seleccionpro);	

					while ($p=$bd->obtener_fila($stmp,0)){
				   $id_proveedor = $p['IdProveedor'];
						}
						
					$seleccionpros = "select * from compras_proveedores where id='$id_proveedor'";
						$stmr=$bd->ejecutar($seleccionpros);	

					while ($r=$bd->obtener_fila($stmr,0)){
				   $nombre_proveedor = $r['Proveedor'];
						}
						
				$selection = "select * from compras_config";
				$stmc=$bd->ejecutar($selection);	

					while ($c=$bd->obtener_fila($stmc,0)){
				$site_email=$c["site_email"];
				$site_name=$c["site_name"];
				$site_phone=$c["site_phone"];
				$site_address =$c["site_address"];
				$site_url=$c["site_url"];
				$email=$c["email"];
				$email = utf8_decode($email);	
				}
			
			$email_content = "Estimado/a $administrador,\n\n";
			$email_content .= "El Proveedor $nombre_proveedor completo el Pedido de Cotizacion de la Invitacion N: $ic_id\n\n";

					$email_content .= "\n---------------------------------------------------------\n\n";
					$email_content .= "Verifique los datos del pedido de Cotizacion aqui: $site_url/admin/editar_ic.php?ic_id=$ic_id\n";
					$email_content .= "\r\n\nAtentamente,\n\n$site_name \n$site_address \n$site_phone";

					$subject = "Pedido de Cotizacion Confirmado";

					mail("$email_user", $subject, $email_content, "From: $site_email");
			
				// fin enviar emails
	
	return $update;
}

function invitacion_actualizar_items($ic_id){
	
	global $bd;
	
	  	$select = "select * from compras_items_solicitud where IdInvitacion='$ic_id'";
			$stmi=$bd->ejecutar($select);
			$total_items=$bd->NumeroRows($stmi);

if ($total_items !== 0){
	
	    	  while ($i=$bd->obtener_fila($stmi,0)){
							$id_item = $i['id'];
												
		$sql_update= "update compras_items_solicitud set IdInvitacion='0' where id='$id_item'";
		$update=$bd->ejecutar($sql_update);
	}
}
							
}

function fecha_enviada_oc($oc_id){
	
	global $bd;
	
$sql_count = "select * from compras_ordenes_compras where id='$oc_id'";
$stmt=$bd->ejecutar($sql_count);

	  while ($x=$bd->obtener_fila($stmt,0)){
							$FechaEnviada = $x['FechaEnviada'];
								}
								
$fecha = explode("-", $FechaEnviada);
$anno = $fecha[0];
$mes = $fecha[1];
$dia = $fecha[2];
$resultado="$dia/$mes/$anno";

return $resultado;						
}

function fecha_enviada($ic_id){
	
	global $bd;
	
$sql_count = "select * from compras_invitaciones where id='$ic_id'";
$stmt=$bd->ejecutar($sql_count);

	  while ($x=$bd->obtener_fila($stmt,0)){
							$FechaEnviada = $x['FechaEnviada'];
								}
								
$fecha = explode("-", $FechaEnviada);
$anno = $fecha[0];
$mes = $fecha[1];
$dia = $fecha[2];
$resultado="$dia/$mes/$anno";

return $resultado;						
}

function buscar_rubro($sbs_id){
	
	global $bd;
	
	  	$select = "select * from compras_items_solicitud where IdSolicitud='$sbs_id' and IdInvitacion='0'";
			$stmi=$bd->ejecutar($select);
			$total_items=$bd->NumeroRows($stmi);

if ($total_items !== 0){
	
	    	  while ($i=$bd->obtener_fila($stmi,0)){
							$id_item = $i['id'];
							$id_rubro = $i['IdRubro'];
							$subtotal = $i['Cantidad'] * $i['MontoAproximado'];
							$total = $total + $subtotal;
							$resultado["total"] = $total;
							$resultado["rubro_id"] = $id_rubro;
								}
}
return $resultado;						
}

function cargar_items_invitacion($id_prove,$code){
	
	global $bd;
		
	  	$select = "select * from compras_proveedores_invitacion where id='$id_prove'";
			$stmi=$bd->ejecutar($select);

while ($i=$bd->obtener_fila($stmi,0)){
	
	$id= $i['id'];
	$idinvitacion = $i['IdInvitacion'];
	
		  $selecto = "select * from compras_items_solicitud where IdInvitacion='$idinvitacion'";
			$stmn=$bd->ejecutar($selecto);
			while ($n=$bd->obtener_fila($stmn,0)){
				
				$id_item = $n['id'];
				$item = $n['ItemSolicitud'];
				$precio = $n['MontoAproximado'];
				$chequed = $n['chequed'];
				
		$sql_update= "insert into compras_items_invitacion set IdInvitacion='$idinvitacion', chequed='$chequed', IdItemSolicitud='$id_item', ItemOfertado='$item', ItemPrecio='$precio', IdProveedor='$id_prove', code='$code'";
		$update=$bd->ejecutar($sql_update);
			}
							
}
}

function actualizar_items_invitacion($id_prove,$code){
	
	global $bd;
		
	  	$select = "select * from compras_proveedores_invitacion where id='$id_prove'";
			$stmi=$bd->ejecutar($select);

while ($i=$bd->obtener_fila($stmi,0)){
	
	$id= $i['id'];
	$idinvitacion = $i['IdInvitacion'];
	
		  $selecto = "select * from compras_items_solicitud where IdInvitacion='$idinvitacion'";
			$stmn=$bd->ejecutar($selecto);
			while ($n=$bd->obtener_fila($stmn,0)){
				
				$id_item = $n['id'];
				$item = $n['ItemSolicitud'];
				$precio = $n['MontoAproximado'];
				$chequed = $n['chequed'];
				
		$sql_update= "update compras_items_invitacion set IdInvitacion='$idinvitacion', chequed='$chequed', IdItemSolicitud='$id_item', ItemOfertado='$item', ItemPrecio='$precio', IdProveedor='$id_prove', code='$code' where IdProveedor='$id_prove'";
		$update=$bd->ejecutar($sql_update);
			}
							
}
}

function enviar_emails_oc($oc_id){
	
	global $bd;
	
	$moneda = utf8_encode('$');
	$code = date("ymdHis").rand(1000,9999);
	
$selectf = "select * from compras_config";
$stmf=$bd->ejecutar($selectf);	      	
$f=$bd->obtener_fila($stmf,0);		
	
	  	$select = "select * from compras_ordenes_compras where id='$oc_id'";
			$stmi=$bd->ejecutar($select);

while ($i=$bd->obtener_fila($stmi,0)){
	
	$id= $i['id'];
	$id_proveedor = $i['IdProveedor'];
	$id_contacto = $i['IdContacto'];
	$monto = $i['Monto'];
	$formaentrega = $i['IdFormaDeEntrega'];

$selectg = "select * from compras_contactos where id='$formaentrega '";
$stmg=$bd->ejecutar($selectg);	      	
$g=$bd->obtener_fila($stmg,0);		
	
$selectc = "select * from compras_contactos where id='$id_contacto'";
$stmc=$bd->ejecutar($selectc);	      	
$c=$bd->obtener_fila($stmc,0);	
	
$select = "select * from compras_proveedores where id='$id_proveedor' order by Proveedor";
$stmp=$bd->ejecutar($select);	      	
$p=$bd->obtener_fila($stmp,0);
							
				if($p['Emails'])
						{
					// inicio del email de Orden de Compra

$email_content = '<table width="700" border="0" cellspacing="0" cellpadding="0">' . "\n";
$email_content .='<tr>' . "\n";
$email_content .='<td><div align="center">' . "\n";
$email_content .='<table width="100%" border="0" cellspacing="0" cellpadding="0">' . "\n";
$email_content .='<tr>' . "\n";
$email_content .='<td><div align="center">' . "\n";
$email_content .='<p><img src="' . $f[site_url] . '/admin/logo.jpg" width="232" height="82" /><br />' . "\n";
$email_content .='<br />' . "\n";
$email_content .='<span class="Estilo1"><span class="Estilo2">ASOCIACIÓN DE INVESTIGACIONES TECNOLÓGICAS</span><br />' . "\n";
$email_content .='' . $f[site_name] . '<br />' . "\n";
$email_content .='' . $f[site_address] . '<br />' . "\n";
$email_content .='CUIT: 30-64355173-6 / IVA EXENTO<br />' . "\n";
$email_content .='' . $f[site_phone] . '<br />' . "\n";
$email_content .='mail: <a href="mailto:comprasait@ait.org.ar">comprasait@ait.org.ar</a></span><br /><br />' . "\n";
$email_content .='</p>' . "\n";
$email_content .='</div></td>' . "\n";
$email_content .='</tr>' . "\n";
$email_content .='</table>' . "\n";
$email_content .='<table width="100%" border="0" cellspacing="0" cellpadding="0">' . "\n";
$email_content .='<tr>' . "\n";
$email_content .='<td><hr size="1" noshade="noshade" class="Estilo2" />' . "\n";
$email_content .='<span class="Estilo4">ORDEN DE COMPRAS N:' . $oc_id . '<br />' . "\n";
$email_content .='</span><hr size="1" noshade="noshade" class="Estilo2" /></td>' . "\n";
$email_content .='</tr>' . "\n";
$email_content .='</table>' . "\n";
$email_content .='<table width="100%" border="0" cellspacing="0" cellpadding="0">' . "\n";
$email_content .='<tr>' . "\n";
$email_content .='<td width="10%">&nbsp;</td>' . "\n";
$email_content .='<td width="90%">&nbsp;</td>' . "\n";
$email_content .='</tr>' . "\n";
$email_content .='<tr>' . "\n";
$email_content .='<td>Fecha:</td>' . "\n";
$email_content .='<td>' . $i[Fecha] . '</td>' . "\n";
$email_content .='</tr>' . "\n";
$email_content .='<tr>' . "\n";
$email_content .='<td>Razon Social:</td>' . "\n";
$email_content .='<td>' . $p[Proveedor] . '</td>' . "\n";
$email_content .='</tr>' . "\n";
$email_content .='<tr>' . "\n";
$email_content .='<td>CUIT:</td>' . "\n";
$email_content .='<td>' . $p[Cuit] . '</td>' . "\n";
$email_content .='</tr>' . "\n";
$email_content .='<tr>' . "\n";
$email_content .='<td>Domicilio:</td>' . "\n";
$email_content .='<td>' . $p[Domicilio] . '</td>' . "\n";
$email_content .='</tr>' . "\n";
$email_content .='<tr>' . "\n";
$email_content .='<td>Telefono:</td>' . "\n";
$email_content .='<td>' . $p[Telefonos] . '</td>' . "\n";
$email_content .='</tr>' . "\n";
$email_content .='<tr>' . "\n";
$email_content .='<td>Contacto:</td>' . "\n";
$email_content .='<td>' . $c[Contacto] . '</td>' . "\n";
$email_content .='</tr>' . "\n";
$email_content .='<tr>' . "\n";
$email_content .='<td>Plazo de Entrega:</td>' . "\n";
$email_content .='<td>' . $i[FechaEsperada] . '</td>' . "\n";
$email_content .='</tr>' . "\n";
$email_content .='<tr>' . "\n";
$email_content .='<td>Forma de Pago:</td>' . "\n";
$email_content .='<td>' . $i[FormaDePago] . '</td>' . "\n";
$email_content .='</tr>' . "\n";
$email_content .='<tr>' . "\n";
$email_content .='<td width="10%">&nbsp;</td>' . "\n";
$email_content .='<td width="90%">&nbsp;</td>' . "\n";
$email_content .='</tr>' . "\n";
$email_content .='</table>' . "\n";
$email_content .='<table width="100%" border="0" cellspacing="0" cellpadding="0">' . "\n";
$email_content .='<tr>' . "\n";
$email_content .='<td><div align="center">' . "\n";
$email_content .='<table width="650" border="0" cellspacing="0" cellpadding="0">' . "\n";
$email_content .='<tr style="background:#999999;">' . "\n";
$email_content .='<td width="10%"><b><font color="#000099">Item N</td>' . "\n";
$email_content .='<td width="10%"><b><font color="#000099">Cantidad</td>' . "\n";
$email_content .='<td width="10%"><b><font color="#000099">Unidad</td>' . "\n";
$email_content .='<td width="40%"><b><font color="#000099">Detalle</td>' . "\n";
$email_content .='<td width="15%"><b><font color="#000099">Precio</td>' . "\n";
$email_content .='<td width="15%"><b><font color="#000099">SubTotal</td>' . "\n";
$email_content .='</tr>' . "\n";

				// enviar detalles de la cotizacion especifica
	  	$selects = "select * from compras_items_orden_compra where IdOrdenDeCompra='$oc_id'";
			$stms=$bd->ejecutar($selects);
			
			$conta = "0";
			$total_cotizacion = "0";

			while ($s=$bd->obtener_fila($stms,0)){				
				$id_item = $i['id'];
				$item = $s['ItemOrdenDeCompra'];
				$monto = $s['PrecioUnitario'];
				$subtotal = $s['SubTotal'];
				$total_cotizacion = $total_cotizacion + $subtotal;
				
				include("CNumeroaLetra.php");
				$numalet= new CNumeroaletra;
				$numalet->setNumero($total_cotizacion);
				
// cantidad
	$idsolicitud = $i['IdItemSolicitud'];
	
	$select_solicitud = "select * from compras_items_solicitud where id='$idsolicitud'";
	$stms=$bd->ejecutar($select_solicitud);
	while ($s=$bd->obtener_fila($stms,0)){
	$id_unidad = $s['IdUnidad'];
	$cantidad = $s['Cantidad'];
}

	$select_unidad = "select * from compras_unidades where id='$id_unidad'";
	$stmtu=$bd->ejecutar($select_unidad);

while ($u=$bd->obtener_fila($stmtu,0)){
	$unidad = $u['UnidadHtml'];
}
//
				
$conta = $conta + 1;
					
$email_content .='<tr>' . "\n";
$email_content .='<td width="10%"><b><font color="#000099">' . $conta . '</td>' . "\n";
$email_content .='<td width="10%"><b><font color="#000099">' . $cantidad . '</td>' . "\n";
$email_content .='<td width="10%"><b><font color="#000099">' . $unidad . '</td>' . "\n";
$email_content .='<td width="40%"><b><font color="#000099">' . $item . '</td>' . "\n";
$email_content .='<td width="15%"><b><font color="#000099">' . $monto . '</td>' . "\n";
$email_content .='<td width="15%"><b><font color="#000099">' . $subtotal . '</td>' . "\n";
$email_content .='</tr>' . "\n";
	
				}		
					
$email_content .='</table>' . "\n";
$email_content .='<table width="650" border="0" cellspacing="0" cellpadding="0">' . "\n";
$email_content .='<tr>' . "\n";
$email_content .='<td width="520" class="Estilo1"><div align="left">Importa la presente Orden de Compra la suma de<br />' . "\n";
$email_content .='<br />' . $numalet->letra() . '</div></td>' . "\n";
$email_content .='<td width="130"><div align="right"><strong class="Estilo1">' . $moneda . '' . $total_cotizacion . '</strong></div></td>' . "\n";
$email_content .='</tr>' . "\n";
$email_content .='</table>' . "\n";
$email_content .='</div></td>' . "\n";
$email_content .='</tr>' . "\n";
$email_content .='</table>' . "\n";
$email_content .='<table width="100%" border="0" cellspacing="0" cellpadding="0">' . "\n";
$email_content .='<tr>' . "\n";
$email_content .='<td><p class="Estilo1"><br />' . "\n";
$email_content .='Presentar éste documento al momento de la entrega<br />' . "\n";
$email_content .='<span class="Estilo4">Entregar Mercadería a</span><span class="Estilo5"> : ' . $g[FormaEntrega] . '<br />' . "\n";
$email_content .='Av. Fuerza Aérea Km. 6 1/2 - Horario: de 08:30 a 13:30 hs</span><br />' . "\n";
$email_content .='El pago de la Factura correspondiente a esta O.C queda sujeto a verificación técnica<br />' . "\n";
$email_content .='Facturar a : Asociación de Investigaciones Tecnológicas<br />' . "\n";
$email_content .='CUIT: 30-64355173-6 / I.V.A. Exento<br />' . "\n";
$email_content .='Factura tipo B ó C<br />' . "\n";
$email_content .='<span class="Estilo4">Destino</span>: <span class="Estilo5">Facultad Ingenieria (CG5) - IUA<br />' . "\n";
$email_content .='S.G. Nº: 104-5</span></p>' . "\n";
$email_content .='</td>' . "\n";
$email_content .='</tr>' . "\n";
$email_content .='</table>' . "\n";
$email_content .='</div></td></tr></table>' . "\n";

// fin email de OC
					
		$contents_user .= $email_content;					

		// OPENS TEMPLATE
		$template = file("inc/.ht_mail");
		reset($template);
		foreach($template as $line){
			$line = str_replace("{-SITE_URL-}", $f[site_url], $line);
			$line = str_replace("{-CONTENTS-}", $contents_user, $line);

			$final_template .= $line;
		}

		// HEADERS
		$subject = "Detalle Orden de Compra";

		$headers  = "From: AIT Compras <comprasait@ait.org.ar>\n";
		$headers .= "X-Sender: <comprasait@ait.org.ar>\n";
		$headers .= "X-Mailer: AIT Compras\n";
		$headers .= "X-Priority: 1\n";
		$headers .= "Return-Path: <comprasait@ait.org.ar>\n";
		$headers .= "Content-Type: text/html; charset=iso-8859-1\r\n";


					mail("$email_prove",$subject,$final_template,$headers);
					
					$store_owner_email = "############## Copia Orden de Compra Enviada al Proveedor ##############\n";
					$store_owner_email .= "Guardelo por si el proveedor no recibio el Email \n";
					$store_owner_email .= "#################################################\r\n";
					// email Admin				
					mail("$site_email", $subject, "$store_owner_email$email_content", "From: $site_email");

				}	
				// fin enviar emails
			}

}

function enviar_emails($ic_id,$reenvio){
	
	global $bd;
	
	$moneda = utf8_encode('$');
	$code = date("ymdHis").rand(1000,9999);
	
	  	$select = "select * from compras_proveedores_invitacion where IdInvitacion='$ic_id' and chequed='Y'";
			$stmi=$bd->ejecutar($select);

while ($i=$bd->obtener_fila($stmi,0)){
	
	$id= $i['id'];
	$id_proveedor = $i['IdProveedor'];
	$id_contacto = $i['IdContacto'];
	
$select = "select * from compras_proveedores where id='$id_proveedor' order by Proveedor";
$stmp=$bd->ejecutar($select);	      	
    	      	
    	      	while ($p=$bd->obtener_fila($stmp,0)){
							$proveedor = $p['Proveedor'];
							$email_prove = $p['Emails'];
							
				if($email_prove)
						{
					// inicio del email de cotizacion

					$selection = "select * from compras_config";
					$stmc=$bd->ejecutar($selection);	

					while ($c=$bd->obtener_fila($stmc,0)){
				$site_email=$c["site_email"];
				$site_name=$c["site_name"];
				$site_phone=$c["site_phone"];
				$site_address =$c["site_address"];
				$site_url=$c["site_url"];
				$email=$c["email"];
				$email = utf8_decode($email);
	
			}
	
			
			$email_content = "Estimado/a $proveedor,\n\n";
			$email_content .= "$email\n\n";
			$email_content .= "-------------------------Resumen de los items Pedidos----------------------------\n\n";
			

				// enviar detalles de la cotizacion especifica
	  	$selects = "select * from compras_items_solicitud where IdInvitacion='$ic_id' and chequed='Y'";
			$stms=$bd->ejecutar($selects);
			
			$conta = "0";
			$total_cotizacion = "0";

			while ($s=$bd->obtener_fila($stms,0)){				
				$id_item = $i['id'];
				$item = $s['ItemSolicitud'];
				$cantidad = $s['Cantidad'];
				$monto = $s['MontoAproximado'];
				$subtotal = $s['Cantidad'] * $s['MontoAproximado'];
				$total_cotizacion = $total_cotizacion + $subtotal;
				
				$conta = $conta + 1;
		
					$email_content .= "$conta - $cantidad $item ($moneda$monto) $moneda$subtotal\n";
	
				}
					$email_content .= "_________________________\n\n";
					$email_content .= "TOTAL: $moneda$total_cotizacion\n";

					$email_content .= "\n---------------------------------------------------------\n\n";
					$email_content .= "Verifique los datos del pedido aqui: $site_url/cotizacion.php?ic_id=$ic_id&authenticode=$code&id=$id\n";
					$email_content .= "\r\n\nAtentamente,\n\n$site_name \n$site_address \n$site_phone";

					$subject = "Pedido de Cotizacion";

					mail("$email_prove", $subject, $email_content, "From: $site_email");
					
					$store_owner_email = "############## Copia Cotizacion Enviada al Proveedor ##############\n";
					$store_owner_email .= "Guardelo por si el proveedor no recibio el Email \n";
					$store_owner_email .= "#################################################\r\n";
					// email Admin				
					mail("$site_email", $subject, "$store_owner_email$email_content", "From: $site_email");

				}			
				// fin enviar emails
			}
			
			if($reenvio=="false"){
			$carga_items = $this->cargar_items_invitacion($id,$code);
		}if($reenvio=="true"){
		$actuali_items = $this->actualizar_items_invitacion($id,$code);
		}

	}
	
// guardo fecha de envio	
$fecha_envio = date("Ymd");
$sql_update= "update compras_invitaciones set FechaEnviada='$fecha_envio' where id='$ic_id'";
$update=$bd->ejecutar($sql_update);

return $update;					
}

function total_fecha($ic_id){
	
			global $bd;
	
		  $select = "select * from compras_proveedores_invitacion where IdInvitacion='$ic_id'";
			$stmi=$bd->ejecutar($select);
			$total=$bd->NumeroRows($stmi);
			
	  	$select = "select * from compras_items_solicitud where IdInvitacion='$ic_id'";
			$stmi=$bd->ejecutar($select);
			$total=$bd->NumeroRows($stmi);

return $total;
}


function solicitud_ait(){
	
		global $bd;
	
	$sql = "select * from compras_solicitudes_ait";
	$stmt=$bd->ejecutar($sql);
	$total=$bd->NumeroRows($stmt);
	
	if($total == 0){
		$sql_insert= "insert into compras_solicitudes_ait set IdSolicitud='100'";
		$insertar=$bd->ejecutar($sql_insert);
}else{
	$select = "select * from compras_solicitudes_ait";
	$stmi=$bd->ejecutar($select);
	    	  while ($i=$bd->obtener_fila($stmi,0)){
							$id = $i['IdSolicitud'];
						}
		$id = $id + 1;						
		$sql_insert= "update compras_solicitudes_ait set IdSolicitud='$id'";
		$insertar=$bd->ejecutar($sql_insert);
}

	$selects = "select * from compras_solicitudes_ait";
	$stms=$bd->ejecutar($selects);
	    	  while ($s=$bd->obtener_fila($stms,0)){
							$id_ait = $s['IdSolicitud'];
						}
return $id_ait;				
}

function total_items($id_temporal){
	
		global $bd;
	
	$sql = "select * from compras_items_solicitud where IdSolicitud='$id_temporal'";
	$stmt=$bd->ejecutar($sql);
	$total=$bd->NumeroRows($stmt);

return $total;
}

function borrar_items($id_temporal){
	
		global $bd;
	
	$sql = "delete from compras_items_solicitud where IdSolicitud='$id_temporal'";
	$stmt=$bd->ejecutar($sql);
	$borrar=$bd->NumeroRows($stmt);

}

function borrar_invitaciones_tablas($ic_id){
	
		global $bd;
	
	$sql = "delete from compras_proveedores_invitacion where IdInvitacion='$ic_id'";
	$stmt=$bd->ejecutar($sql);
	
	$sql2 = "delete from compras_items_invitacion where IdInvitacion='$ic_id'";
	$stmr=$bd->ejecutar($sql2);
	
	$selects = "select * from compras_items_solicitud where IdInvitacion='$ic_id'";
	$stms=$bd->ejecutar($selects);
	    	  while ($s=$bd->obtener_fila($stms,0)){
	    	  			$id=$s['id'];
	    	  			$sql_update= "update compras_items_solicitud set IdInvitacion='0' where id='$id'";
								$update=$bd->ejecutar($sql_update);
							}

}

function total_items_precio($ic_id){
	
		global $bd;
	
	$sql = "select * from compras_items_solicitud where IdInvitacion='$ic_id'";
	$stms=$bd->ejecutar($sql);
	while ($s=$bd->obtener_fila($stms,0)){
		$monto = $s['MontoAproximado'];
		$cantidad = $s['Cantidad'];
		$subtotal = $monto * $cantidad;
		$total = $total + $subtotal;
}
return $total;
}

}
?>