<?php

    /*** Autoload class files ***/
    function __autoload($class){
      require('include/' . strtolower($class) . '.class.php');
    }
    
	$funcbase = new dbutils;
	$mysqli = $funcbase->conecta();
	if (is_object($mysqli)) {
        $funcbase->checalogin($mysqli);
	} else {
		die ("<h1>'No se establecio la conexion a bd'</h1>");
	}
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-1"/>
<link rel="stylesheet" type="text/CSS" href="css/plantilla2.css" />
<link rel="stylesheet" type="text/CSS" href="css/dropdown_two.css" />

<title>STELLUS MEDEVICES</title>
</head>

<body

<!--LISTON DE ENCABEZADO ---------------------------------------------------------------------------------------->  
    <?php 
  $titulo = "PAGINA DE PRUEBA";
  include_once "include/barrasup.php";
  ?> 

   
<div id="footer"></div>


</body>


</html>