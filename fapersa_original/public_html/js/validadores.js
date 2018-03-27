function valida_ingreso(){
	
		if (document.fingresar.emails.value.length==0){ 
       alert("Tiene que Ingresar un email") 
       document.fingresar.emails.focus() 
        return false
  	}
	
	  	if (document.fingresar.dni.value.length==0){ 
       alert("Tiene que Ingresar el DNI") 
       document.fingresar.dni.focus() 
        return false
  	}

}

function valida_carga(){
	
		if (document.fcarga.cantidad.value=="-1"){ 
       alert("Tiene que Seleccionar Cantidad") 
       document.fcarga.cantidad.focus() 
        return false
  	}
	
		if (document.fcarga.factura.value.length==0){ 
       alert("Tiene que Ingresar una factura") 
       document.fcarga.factura.focus() 
        return false
  	}
  			if (document.fcarga.agronomia.value=="-1"){ 
       alert("Tiene que Seleccionar una Agronomia") 
       document.fcarga.agronomia.focus() 
        return false
  	}

}

function valida_registro(){
	
		if (document.fregistrar.nombre.value.length==0){ 
       alert("Tiene que Ingresar un Nombre") 
       document.fregistrar.nombre.focus() 
        return false
  	}
	
		if (document.fregistrar.apellido.value.length==0){ 
       alert("Tiene que Ingresar un Apellido") 
       document.fregistrar.apellido.focus() 
        return false
  	}
        
   if (document.fregistrar.telefono.value.length==0){ 
       alert("Tiene que Ingresar un telefono") 
       document.fregistrar.telefono.focus() 
        return false
  	}
  	
  	    if (document.fregistrar.email.value.length==0){ 
       alert("Tiene que Ingresar un email") 
       document.fregistrar.email.focus() 
        return false
  	}
  	
  	  	    if (document.fregistrar.company.value.length==0){ 
       alert("Tiene que Ingresar una Compañia") 
       document.fregistrar.company.focus() 
        return false
  	}

}


function MM_openBrWindow(theURL,winName,features){
		 window.open(theURL,winName,features);
}
			
function decision(message, url){
		if(confirm(message)) location.href = url;
}