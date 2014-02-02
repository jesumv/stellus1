<?php
    //directiva de la conexion a la base de datos
include_once "php/config.php";

//directiva a la revision de conexion
include_once"php/lock.php";

//variables globales
global $caso;


//viene de la pagina con id.
if(isset($_GET['nid'])){
    //bandera indicando actualización
    $caso =0;
    //lectura de variables de la pagina posteadora
    $_SESSION['no']=$_GET['nid'];
    $num = $_GET['nid'];
    
        //------consulta a la base de datos------
      
    $table = 'proveedores';
    $sql= "SELECT * FROM $table WHERE idproveedores =".$num;
    $result2 = mysqli_query($mysqli,$sql) or die('no hay resultados para '.$table);
    $result3= mysqli_fetch_row($result2);
    $nombre = $result3[1];
    $corto = $result3[2];
    $dir= $result3[3];
      /* liberar la serie de resultados */
      mysqli_free_result($result2);
      /* cerrar la conexión */
      mysqli_close($mysqli);
    
    //titulo del boton de la forma
    $titbot = "Actualizar";
    // bandera señalando que se requiere actualizacion

} else {
    //viene de la pagina proveedpres, sin id.
    $num = "";
    $nombre = "";
    $corto = "";
    $dir= "";
    //titulo del boton de la forma
    $titbot = "Insertar";
    $caso = -1; 
}



//viene de la misma pagina, al oprimir el boton
if(isset($_POST['enviomod'])){
//Se ha oprimido el boton de actualizar o insertar
    $num = $_SESSION['no'];
    //sección de conexion a la tabla para modificación
    //CONVERSIONES A STRING
     $nombre =strtoupper($_POST ['nom']) ;
     $corto =strtoupper($_POST ['corto']) ;
     $dir=strtoupper($_POST ['dir']) ;
     $usu = $_SESSION['username'];
    //el llenado de la tabla
    if ($caso !=-1) {
      $sqlCommand = "UPDATE proveedores SET razon_social ='$nombre', nom_corto='$corto', direccion = '$dir', usu = '$usu' status = 2 WHERE idproveedores='$num' LIMIT 1"
        or die('actualizacion cancelada ');  
    }else{
        $sqlCommand= "INSERT INTO proveedores (razon_social,nom_corto,direccion,usu,status) VALUES ('$nombre','$corto','$dir','$usu',0)"
        or die('insercion cancelada '.$table);
    }
    
    // Execute the query here now
    $query = mysqli_query($mysqli, $sqlCommand) or die (mysqli_error($mysqli)); 
    /* liberar la serie de resultados */
    mysqli_free_result($query);
  /* cerrar la conexión */
    mysqli_close($mysqli);
    
    
    header('Location: proveedores.php');
       
}





?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-1"/>
<link rel="stylesheet" type="text/CSS" href="css/plantilla2.css" />
<link rel="stylesheet" type="text/CSS" href="css/dropdown_two.css" />
<title>STELLUS MEDEVICES</title>

<script src="js/jquery-1.11.0.js"></script>
  <script>
  $( document ).ready(function() {
       $('#inic').focus();  
});
  </script>
</head>

<body

<!--LISTON DE ENCABEZADO ---------------------------------------------------------------------------------------->  
    <?php 
  $titulo = "ACTUALIZACION PROVEEDORES";
  include_once "include/barrasup.php";
  
  ?> 
  
  <div class="cajacentra">

    <form id="modifprov" action="<?php echo $_SERVER['PHP_SELF']; ?>" method = "POST">
        
       <table  class="db-table">
          
        <!-- la forma. ------>
        
     <tr>
            <td >No.</td> 
            <?php  
            echo "<td>$num</td>";
            echo "<td >NOMBRE O RAZON SOCIAL:</td> ";
            echo "<td><input id='inic' name ='nom' value = '$nombre'  size = '60'/> </td>";
            echo " <td> NOMBRE CORTO</td>";
            echo "<td ><input name ='corto' value = '$corto' /></td>";
            echo "<td> DIRECCION</td>";
            echo "<td ><input name ='dir' value = '$dir' size = '60' /></td>";
            ?>         
     </tr>
   
     
                      
          </table>  <br />
    <!--------el boton de enviar ------------->
    <div>
        <?php
           echo  "<input type='submit' name ='enviomod' value=$titbot />"
        ?>
    </div>        
        </form>
    

</div>

<div id="footer"></div>


</body>


</html>
