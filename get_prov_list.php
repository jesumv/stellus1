<?php
	/*** Autoload class files ***/ 
    function __autoload($class){
      require('include/' . strtolower($class) . '.class.php');
    }
    
    $funcbase = new dbutils;
/*** conexion a bd ***/
    $mysqli = $funcbase->conecta();
    if (is_object($mysqli)) {
/*** checa login***/
        $funcbase->checalogin($mysqli);
    } else {
        die ("<h1>'No se establecio la conexion a bd'</h1>");
    }
	
	$q = strtolower($_GET["q"]);
	if (!$q) return;
	 
	$sql = "select DISTINCT razon_social  from proveedores where razon_social LIKE '%$q%'";
	$rsd = mysqli_query($mysqli,$sql);
	while($rs = mysqli_fetch_array($rsd)) {
	    $prov = $rs['razon_social'];
	    echo "$prod\n";
	}

?>