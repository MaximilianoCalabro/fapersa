// JavaScript Document
function nuevoAjax(){
	var xmlhttp=false;
	try{
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	}catch(e){
		try {
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}catch(E){
			xmlhttp = false;
		}
	}

	if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
		xmlhttp = new XMLHttpRequest();
	}
	
	return xmlhttp;
}

function decision(message, url){
		if(confirm(message)) location.href = url;
}

function Buscar(){
  	
	resul = document.getElementById('resultados');
	resul.innerHTML= '<img src="images/bigrotation2.gif">';
	
	aimarca=document.fbuscar.id_marca.value;
	aicode=document.fbuscar.code.value;
	
	ajax=nuevoAjax();
	ajax.open("POST", "buscar.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			resul.innerHTML = ajax.responseText
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("id_marca="+aimarca+"&code="+aicode)

}

function CargarProducto(articulo){
	
	var formulario = "fproductos"+articulo;
	var cantidad = "cantidad"+articulo;
	
	  if (document.forms[formulario].elements[cantidad].value.length==0){ 
       alert("Tiene que ingresar la cantidad") 
       document.forms[formulario].elements[cantidad].focus() 
        return false
  						}
	    if (document.forms[formulario].elements[cantidad].value=="0"){ 
       alert("Tiene que ingresar cantidad mayor a cero") 
       document.forms[formulario].elements[cantidad].focus() 
        return false
  						}
	
	acantidad=document.forms[formulario].elements[cantidad].value;
	
	   resul = document.getElementById('carrito');
  	 resul.innerHTML= '<img src="images/bigrotation2.gif">';
	
	ajax=nuevoAjax();
	ajax.open("POST", "cargar_producto.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			resul.innerHTML = ajax.responseText
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("articulo_id="+articulo+"&cantidades="+acantidad)
  					
}

function DelItem(articulo){
	
	   resul = document.getElementById('basketresult');
  	 resul.innerHTML= '<img src="images/bigrotation2.gif">';
	
	ajax=nuevoAjax();
	ajax.open("POST", "borrar_producto.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			resul.innerHTML = ajax.responseText
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("articulo_id="+articulo)
  					
}

function ModificarProducto(articulo){
	
	var formulario = "fproductos"+articulo;
	var cantidad = "cantidad"+articulo;
	
	  if (document.forms[formulario].elements[cantidad].value.length==0){ 
       alert("Tiene que ingresar la cantidad") 
       document.forms[formulario].elements[cantidad].focus() 
        return false
  						}
	    if (document.forms[formulario].elements[cantidad].value=="0"){ 
       alert("Tiene que ingresar cantidad mayor a cero") 
       document.forms[formulario].elements[cantidad].focus() 
        return false
  						}
	
	acantidad=document.forms[formulario].elements[cantidad].value;
	
	   resul = document.getElementById('basketresult');
  	 resul.innerHTML= '<img src="images/bigrotation2.gif">';
	
	ajax=nuevoAjax();
	ajax.open("POST", "modificar_producto.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			resul.innerHTML = ajax.responseText
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("articulo_id="+articulo+"&cantidades="+acantidad)
  					
}

function CargarItems(asbs_id){
	
	
	    if (document.frmitems.item.value.length==0){ 
       alert("Tiene que escribir el Detalle del Item") 
       document.frmitems.item.focus() 
        return false
  						}
	    if (document.frmitems.id_categoria.value=="-1"){ 
       alert("Tiene que seleccionar una categoria") 
       document.frmitems.id_categoria.focus() 
        return false
  						}
	    if (document.frmitems.cantidad.value.length==0){ 
       alert("Tiene que ingresar cantidad") 
       document.frmitems.cantidad.focus() 
        return false
  						}
	    if (document.frmitems.id_unidad.value=="-1"){ 
       alert("Tiene que seleccionar una unidad") 
       document.frmitems.id_unidad.focus() 
        return false
  						}	
	    if (document.frmitems.cuenta.value.length==0){ 
       alert("Tiene que ingresar un numero de cuenta") 
       document.frmitems.cuenta.focus() 
        return false
  						}					  						
  		if (document.frmitems.id_rubro.value=="-1"){ 
       alert("Tiene que seleccionar un Rubro") 
       document.frmitems.id_rubro.focus() 
        return false
  						}
  						  						  										  						
  	 resul = document.getElementById('items_cargados');
  	 divFormulario = document.getElementById('form_agre_items');
  	 resul.innerHTML= '<img src="images/bigrotation2.gif">';
	
	aitem=document.frmitems.item.value;
	aid_categoria=document.frmitems.id_categoria.value;
	acantidad=document.frmitems.cantidad.value;
	aid_unidad=document.frmitems.id_unidad.value;
	aidcuenta=document.frmitems.cuenta.value;
	aid_rubro=document.frmitems.id_rubro.value;
	aid_proveedor=document.frmitems.id_proveedor.value;
	aprecio=document.frmitems.precio.value;
	aidtemporal=document.frmitems.id_temporal.value;
	
	ajax=nuevoAjax();
	ajax.open("POST", "cargar_items.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			resul.innerHTML = ajax.responseText
			divFormulario.style.display="none";
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("item="+aitem+"&id_categoria="+aid_categoria+"&cantidad="+acantidad+"&id_unidad="+aid_unidad+"&id_proveedor="+aid_proveedor+"&precio="+aprecio+"&id_temporal="+aidtemporal+"&idrubro="+aid_rubro+"&cuenta="+aidcuenta+"&sbs_id="+asbs_id)
  					
}

function ActualizarItems(){
	
	
	    if (document.frmitem.item.value.length==0){ 
       alert("Tiene que escribir el Detalle del Item") 
       document.frmitem.item.focus() 
        return false
  						}
	    if (document.frmitem.id_categoria.value=="-1"){ 
       alert("Tiene que seleccionar una categoria") 
       document.frmitem.id_categoria.focus() 
        return false
  						}
	    if (document.frmitem.cantidad.value.length==0){ 
       alert("Tiene que ingresar cantidad") 
       document.frmitem.cantidad.focus() 
        return false
  						}
	    if (document.frmitem.id_unidad.value=="-1"){ 
       alert("Tiene que seleccionar una unidad") 
       document.frmitem.id_unidad.focus() 
        return false
  						}
	    if (document.frmitem.id_centro.value=="-1"){ 
       alert("Tiene que seleccionar un Centro de Gestion") 
       document.frmitem.id_centro.focus() 
        return false
  						}		
  		 if (document.frmitem.id_rubro.value=="-1"){ 
       alert("Tiene que seleccionar un Rubro") 
       document.frmitem.id_rubro.focus() 
        return false
  						}
  						  						  										  						
  	 resul = document.getElementById('items_cargados');
  	 divFormulario = document.getElementById('form_editar_items');
  	 resul.innerHTML= '<img src="images/bigrotation2.gif">';
	
	aitem=document.frmitem.item.value;
	aid_categoria=document.frmitem.id_categoria.value;
	acantidad=document.frmitem.cantidad.value;
	aid_unidad=document.frmitem.id_unidad.value;
	aid_centro=document.frmitem.id_centro.value;
	aidcuenta=document.frmitem.cuenta.value;
	aid_proveedor=document.frmitem.id_proveedor.value;
	aid_rubro=document.frmitem.id_rubro.value;
	aprecio=document.frmitem.precio.value;
	aid=document.frmitem.id_item.value;
	aisbs_id=document.frmitem.sbs_id.value;
	
	ajax=nuevoAjax();
	ajax.open("POST", "actualizar_items.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			resul.innerHTML = ajax.responseText
			divFormulario.style.display="none";
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("item="+aitem+"&id_categoria="+aid_categoria+"&cantidad="+acantidad+"&id_unidad="+aid_unidad+"&id_centro="+aid_centro+"&id_proveedor="+aid_proveedor+"&precio="+aprecio+"&id_items="+aid+"&sbs_id="+aisbs_id+"&id_rubro="+aid_rubro+"&cuenta="+aidcuenta)
  					
}

function ActualizarItemsOc(){
	
	
	    if (document.frmitemoc.item.value.length==0){ 
       alert("Tiene que escribir el Detalle del Item") 
       document.frmitemoc.item.focus() 
        return false
  						}
  						  						  										  						
  	 resul = document.getElementById('itemscombo');
  	 divFormulario = document.getElementById('form_edititems_oc');
  	 resul.innerHTML= '<img src="admin/images/bigrotation2.gif">';
	
	aitem=document.frmitemoc.item.value;
	aprecio=document.frmitemoc.precio.value;
	aid=document.frmitemoc.id_item.value;
	aid_orden=document.frmitemoc.id_orden.value;
	aid_prove=document.frmitemoc.id_prove.value;
	
	ajax=nuevoAjax();
	ajax.open("POST", "actualizar_items_oc.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			resul.innerHTML = ajax.responseText
			divFormulario.style.display="none";
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("item="+aitem+"&precio="+aprecio+"&id_items="+aid+"&id_orden="+aid_orden)
  					
}

function ActualizarItemsIC(){
	
	
	    if (document.frmitemic.item.value.length==0){ 
       alert("Tiene que escribir el Detalle del Item") 
       document.frmitemic.item.focus() 
        return false
  						}
  						  						  										  						
  	 resul = document.getElementById('itemscombo');
  	 divFormulario = document.getElementById('form_edititems_ic');
  	 resul.innerHTML= '<img src="admin/images/bigrotation2.gif">';
	
	aitem=document.frmitemic.item.value;
	aprecio=document.frmitemic.precio.value;
	aid=document.frmitemic.id_item.value;
	aid_ic=document.frmitemic.ic_id.value;
	aid_prove=document.frmitemic.id_prove.value;
	acode=document.frmitemic.code.value;
	
	ajax=nuevoAjax();
	ajax.open("POST", "actualizar_items_ic.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			resul.innerHTML = ajax.responseText
			divFormulario.style.display="none";
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("item="+aitem+"&precio="+aprecio+"&id_items="+aid+"&ic_id="+aid_ic+"&idprove="+aid_prove+"&code="+acode)
  					
}

function SeleccionarProve(id_proveedor,aic_id,id_item){
	
	resul = document.getElementById('resultados');
	
	ajax=nuevoAjax();
	ajax.open("POST", "actualizar_prove_ic.php",true);
		ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			resul.innerHTML = ajax.responseText
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("item="+id_item+"&proveedor="+id_proveedor+"&ic_id="+aic_id)
  					
}

function Comparar(aic_id){
	
	resul = document.getElementById('resultados');
	resul.innerHTML= '<img src="images/bigrotation2.gif">';
	
	ajax=nuevoAjax();
	ajax.open("POST", "comparar.php",true);
		ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			resul.innerHTML = ajax.responseText
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("ic_id="+aic_id)
  					
}

function ChequearItems(aid_item_oc){
	
	resul = document.getElementById('items_verificar');
	resul.innerHTML= '<img src="admin/images/bigrotation2.gif">';
	
	ajax=nuevoAjax();
	ajax.open("POST", "verificar.php",true);
		ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			resul.innerHTML = ajax.responseText
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("item_oc="+aid_item_oc)
  					
}

function CentroCostos(idcosto){
	
	resul = document.getElementById('select_centros');
	
	ajax=nuevoAjax();
	ajax.open("POST", "centros_selected.php",true);
		ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			resul.innerHTML = ajax.responseText
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("idcentrodegestion="+idcosto)
  					
}

function CargarProve(){
	
	    if (document.frmprove.id_proveedor.value=="-1"){ 
       alert("Tiene que seleccionar un Proveedor") 
       document.frmprove.id_proveedor.focus() 
        return false
  						}
  						  						  										  						
  	 resultado = document.getElementById('prove_cargados');
  	 divFormulario = document.getElementById('form_agre_prove');
  	 resultado.innerHTML= '<img src="images/bigrotation2.gif">';
	
	aiprove=document.frmprove.id_proveedor.value;
	aiic_id=document.frmprove.ic_id.value;
	ainotas=document.frmprove.notas.value;
	aicontacto=document.frmprove.id_contacto.value;
	aitotal=document.frmprove.total.value;
	afechaenviada=document.frmprove.fechaenviada.value;
	
	ajax=nuevoAjax();
	ajax.open("POST", "cargar_prove.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			resultado.innerHTML = ajax.responseText
			divFormulario.style.display="none";
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("id_prove="+aiprove+"&ic_id="+aiic_id+"&notas="+ainotas+"&contacto_id="+aicontacto+"&total_precio="+aitotal+"&fechaenviada="+afechaenviada)
  					
}

function busqueda(){
  	
	resul = document.getElementById('nombrearticulo');
	
	artname=document.frmlista.articulo_nombre.value;
	
	ajax=nuevoAjax();
	ajax.open("POST", "articulo_nombre.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			resul.innerHTML = ajax.responseText
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("articulo_nombre="+artname)

}


function Pagina(nropagina,icode,marca){

	 divContenido = document.getElementById('resultados');
	 
	 ajax=nuevoAjax();

	  ajax.open("POST", "buscar.php",true);
	  divContenido.innerHTML= '<img src="images/bigrotation2.gif">'; 
	  ajax.onreadystatechange=function() {
	  	if (ajax.readyState==4) {
	  	divContenido.innerHTML = ajax.responseText
	  	}
	  	}
	  	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
			ajax.send("id_marca="+marca+"&pag="+nropagina+"&code="+icode)
}
	  	

function BorrarItem(itemid,sbs_id){
  	 
  	 var eliminar = confirm("Esta seguro que desea eliminar este Item?") 
  	 if ( eliminar ) {
  	 	
  	 resul = document.getElementById('items_cargados'); 
  	 resul.innerHTML= '<img src="images/bigrotation2.gif">';
	
	ajax=nuevoAjax();
	ajax.open("POST", "borrar_item.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			resul.innerHTML = ajax.responseText
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("item_id="+itemid+"&idsbs="+sbs_id)
}

}

function EditarItem(itemid,sbs_id){
  	 
  	 divFormulario2 = document.getElementById('form_agre_items');
  	 divFormulario = document.getElementById('form_editar_items');
	
	ajax=nuevoAjax();
	ajax.open("POST", "form_editar_items.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
				  divFormulario.innerHTML = ajax.responseText
				  divFormulario2.style.display="none";  
	     		divFormulario.style.display="block";  
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("item_id="+itemid+"&idsbs="+sbs_id)

}

function EditarItemIC(itemid,aic_id,rubroid,acode){
  	 
  	 divFormulario = document.getElementById('form_edititems_ic');
	
	ajax=nuevoAjax();
	ajax.open("POST", "form_edititems_ic.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
				  divFormulario.innerHTML = ajax.responseText
	     		divFormulario.style.display="block";  
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("item_id="+itemid+"&ic_id="+aic_id+"&idrubro="+rubroid+"&code="+acode)

}

function EditarItemOc(itemid,oc_id,idorden){
  	 
  	 divFormulario = document.getElementById('form_edititems_oc');
	
	ajax=nuevoAjax();
	ajax.open("POST", "form_edititems_oc.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
				  divFormulario.innerHTML = ajax.responseText
	     		divFormulario.style.display="block";  
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("item_id="+itemid+"&orden_id="+oc_id+"&id_orden="+idorden)

}

function BorrarProve(proveid,aic_id,fecha){
  	 
  	 var eliminar = confirm("Esta seguro que desea eliminar este Proveedor?") 
  	 if ( eliminar ) {
  	 	
  	 resul = document.getElementById('prove_cargados'); 
  	 resul.innerHTML= '<img src="images/bigrotation2.gif">';
	
	ajax=nuevoAjax();
	ajax.open("POST", "borrar_prove.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			resul.innerHTML = ajax.responseText
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("prove_id="+proveid+"&ic_id="+aic_id+"&fechaenviada="+fecha)
}

}

function EditarProve(proveid,aic_id,fecha){
  	 
  	 divFormulario2 = document.getElementById('form_agre_prove');
  	 divFormulario = document.getElementById('form_editar_prove');
	
	ajax=nuevoAjax();
	ajax.open("POST", "form_editar_prove.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
				  divFormulario.innerHTML = ajax.responseText
				  divFormulario2.style.display="none";  
	     		divFormulario.style.display="block";  
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("id_prove="+proveid+"&ic_id="+aic_id+"&fechaenviada="+fecha)

}

function ChequearProveIC(proveid,aic_id){
  	 
  	 	
  	 resul = document.getElementById('prove_cargados'); 
  	 resul.innerHTML= '<img src="images/bigrotation2.gif">';
	
	ajax=nuevoAjax();
	ajax.open("POST", "chequear_prove.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			resul.innerHTML = ajax.responseText
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("prove_id="+proveid+"&ic_id="+aic_id)

}

function MostrarForm(sbs_id){

		divFormulario2 = document.getElementById('form_editar_items');
	  divFormulario = document.getElementById('form_agre_items');
	  
	 ajax=nuevoAjax(); 
	 ajax.open("POST", "form_agre_items.php",true); 
	 ajax.onreadystatechange=function() {  
	   if (ajax.readyState==4) {    
	     		divFormulario.innerHTML = ajax.responseText
	     		divFormulario2.style.display="none";
	     		divFormulario.style.display="block";  
	     		} 
	  } 
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("id_sbs="+sbs_id)
}

function SelectProve(valor){
  	 
  	 divFormulario = document.getElementById('select_prove');
	
	ajax=nuevoAjax();
	ajax.open("POST", "seleccionar_prove.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
				  divFormulario.innerHTML = ajax.responseText
	     		divFormulario.style.display="block";  
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("prove_id="+valor)

}


function SelectRubro(valor){
  	 
  	 divFormulario = document.getElementById('select_rubro');
	
	ajax=nuevoAjax();
	ajax.open("POST", "seleccionar_rubro.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
				  divFormulario.innerHTML = ajax.responseText
	     		divFormulario.style.display="block";  
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("rubro_id="+valor)

}

function AccionCarpeta(aidcar,asbs_id){

  	 resultado = document.getElementById('carpetascombo');
  	 resultado.innerHTML= '<img src="images/bigrotation2.gif">'; 
	  
	 ajax=nuevoAjax(); 
	 ajax.open("POST", "accion_carpeta.php",true); 
	 ajax.onreadystatechange=function() {  
	   if (ajax.readyState==4) {    
	     		resultado.innerHTML = ajax.responseText
	     		} 
	  }
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("carid="+aidcar+"&idsbs="+asbs_id)
}

function AccionItems(itemid,ic_id,rubroid){
  	 
  	 resultado = document.getElementById('itemscombo');
  	 resultado.innerHTML= '<img src="images/bigrotation2.gif">'; 
	
	ajax=nuevoAjax();
	ajax.open("POST", "add_item_ic.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
					resultado.innerHTML = ajax.responseText  
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("item_id="+itemid+"&invitacion_id="+ic_id+"&idrubro="+rubroid)

}

function AccionItemsOc(itemid,oc_id){
  	 
  	 resultado = document.getElementById('itemscombo');
  	 resultado.innerHTML= '<img src="images/bigrotation2.gif">'; 
	
	ajax=nuevoAjax();
	ajax.open("POST", "add_item_oc.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
					resultado.innerHTML = ajax.responseText  
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("item_id="+itemid+"&orden_id="+oc_id)

}

function EliminarItem(itemid,ic_id,rubroid){
  	 
  	 resultado = document.getElementById('itemscombo');
  	 resultado.innerHTML= '<img src="images/bigrotation2.gif">'; 
	
	ajax=nuevoAjax();
	ajax.open("POST", "eliminar_item_ic.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
					resultado.innerHTML = ajax.responseText  
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("item_id="+itemid+"&invitacion_id="+ic_id+"&idrubro="+rubroid)

}

function ChequearItemsIC(itemid,ic_id,rubroid){
  	 
  	 resultado = document.getElementById('itemscombo');
  	 resultado.innerHTML= '<img src="images/bigrotation2.gif">'; 
	
	ajax=nuevoAjax();
	ajax.open("POST", "chequear_item_ic.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
					resultado.innerHTML = ajax.responseText  
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("item_id="+itemid+"&invitacion_id="+ic_id+"&idrubro="+rubroid)

}

function ChequearItemsOC(itemid,ic_id){
  	 
  	 resultado = document.getElementById('resultados');
	
	ajax=nuevoAjax();
	ajax.open("POST", "chequear_item_oc.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
					resultado.innerHTML = ajax.responseText  
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("coti_id="+itemid+"&invitacion_id="+ic_id)

}

function EliminarItemOc(itemid,oc_id,idorden){
  	 
  	 resultado = document.getElementById('itemscombo');
  	 resultado.innerHTML= '<img src="images/bigrotation2.gif">'; 
	
	ajax=nuevoAjax();
	ajax.open("POST", "eliminar_item_oc.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
					resultado.innerHTML = ajax.responseText  
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("item_id="+itemid+"&orden_id="+oc_id+"&id_orden="+idorden)

}

function Institucion(valor){

 if(valor == '160')
  {
  document.fcarga_sbs.numero.disabled=true;
  } 
 else 
  {
  document.fcarga_sbs.numero.disabled=false;
  }
 
}				