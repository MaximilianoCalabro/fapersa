<?php  

/* Clase encargada de gestionar las conexiones a la base de datos */

Class Db
{  
private $servidor='localhost';
private $usuario='fapersa_fapersa';
private $password='faper519x';
private $base_datos='fapersa_db';
private $link;
private $stmt;
private $array;
static $_instance;

private function __construct(){
$this->conectar();
}     
    
private function __clone(){ }

public static function getInstance(){       
if (!(self::$_instance instanceof self)){
          self::$_instance=new self();
          }
          return self::$_instance;
          } 

 /*Realiza la conexión a la base de datos.*/
 
private function conectar(){
$this->link=mysql_connect($this->servidor, $this->usuario, $this->password);
mysql_select_db($this->base_datos,$this->link);
@mysql_query("SET NAMES 'utf8'");
}

/*Método para ejecutar una sentencia sql*/

public function ejecutar($sql){

//$this->stmt=mysql_query($sql,$this->link);

$this->stmt=mysql_query($sql,$this->link) or die("Error: " . mysql_error());

return $this->stmt;
}

/*Método para obtener una fila de resultados de la sentencia sql*/

public function Obtener_fila($stmt,$fila){

if ($fila==0){
$this->array=mysql_fetch_array($stmt);
}else{
mysql_data_seek($stmt,$fila);
$this->array=mysql_fetch_array($stmt);
}       
return $this->array;
}

//Devuelve el último id del insert introducido

public function UltimoID(){
return mysql_insert_id($this->link);
}

public function NumeroRows($stmt){
return mysql_num_rows($this->stmt);
}

}
?>