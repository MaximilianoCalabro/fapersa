<?php

error_reporting(E_PARSE);
$moneda = utf8_encode('$');

ini_set("session.gc_maxlifetime", 1800);
session_start();
session_name("fapersa_catalog");

	define("SITE_URL", "http://www.fapersa.com/");
	define("PATH", "/home/fapersa/public_html/");
	define("ADM_URL", SITE_URL . ".admin/");
	define("ADMIN_TITLE", "fapersa.com - Panel Administrativo");
	define("SESSION_ADMIN", "fapersa_adm");
	define("SESSION_CLIENTE", "fapersa_cliente");
	define("SITE_NAME", "fapersa.com");
	define("SITE_EMAIL", "info@fapersa.com");
	define("PRODUCTION", "N");
	
// Limite paginacion

if($_REQUEST[ddlimit]){
$ddlimit = $_REQUEST[ddlimit];
}

if (!$_REQUEST[ddlimit]){
	$ddlimit=10;
	}

$limit = $ddlimit;

if(empty($_GET[page])){
$page = 1; 
$limitvalue = $page * $limit - ($limit); 
}else{
$limitvalue = $_GET[page] * $limit - ($limit); 
}

// fechas busqueda
$hoy = date("d/m/Y");
$fecha_hoy = explode("/", $hoy);
$dia = $fecha_hoy[0];
$mes = $fecha_hoy[1];
$anno = $fecha_hoy[2];
$primero = "01/$mes/$anno";
			
// Colores Generales

$bg_color = "#FFFFFF";
$color_1 = "#CCCCCC";
$color_2 = "#7DC8E8";
$color_3 = "#EBEBEB";
$color_4 = "#CCCCCC";
$color_5 = "#FFFFFF";

setlocale(LC_TIME, "es_ES"); 
$fecha =(strftime("%A %e de %B %Y"));
$time = date("H:i");
$fecha_hora_actual = date("Y-m-d H:i:s");
$fecha_actual = date("Y-m-d");

$goback="<a href=\"javascript:history.back()\">Intentar De nuevo</a>";
			
?>