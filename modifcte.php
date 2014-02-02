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
      
    $table = 'clientes';
    $sql= "SELECT * FROM $table WHERE idclientes =".$num;
    $result2 = mysqli_query($mysqli,$sql) or die('no hay resultados para '.$table);
    $result3= mysqli_fetch_row($result2);
    $nombre = $result3[1];
    $rfc= $result3[2];
	$suc = $result3[3];
    $corto = $result3[4];
    $calleno= $result3[5];
    $col= $result3[6];
    $del= $result3[7];
    $ciudad= $result3[8];
    $estado= $result3[9];
    $cp= $result3[10];
    $nivel= $result3[11];
    
      /* liberar la serie de resultados */
      mysqli_free_result($result2);
      /* cerrar la conexión */
      mysqli_close($mysqli);
    
    //titulo del boton de la forma
    $titbot = "Actualizar";
    // bandera señalando que se requiere actualizacion

} else {
    //viene de la pagina clientes, sin id.
    
    $num="";
    $nombre = "";
    $rfc= "";
	$suc ="";
    $corto = "";
    $calleno= "";
    $col= "";
    $del= "";
    $ciudad= "";
    $estado= "";
    $cp= "";
    $nivel= 1;
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
     $rfc =strtoupper($_POST ['rfc']) ;
	 $suc =strtoupper($_POST ['suc']) ;
     $corto =strtoupper($_POST ['corto']) ;
     $calleno=strtoupper($_POST ['calleno']) ;
     $col=strtoupper($_POST ['col']) ;
     $del=strtoupper($_POST ['del']) ;
     $ciudad=strtoupper($_POST ['ciudad']) ;
     $estado=strtoupper($_POST ['estado']) ;
     $cp=strtoupper($_POST ['cp']) ;
     $nivel=strtoupper($_POST ['nivel']) ;
     $usu = $_SESSION['username'];
     
    //el llenado de la tabla
    if ($caso !=-1) {
      $sqlCommand = "UPDATE clientes SET razon_social ='$nombre', rfc = '$rfc',sucursal = '$suc', nom_corto='$corto', calleno = '$calleno', col = '$col',
      del = '$del', ciudad = ´$ciudad´, estado = '$estado', cp = '$cp', nivel = '$nivel',usu = '$usu' status = 2 WHERE idclientes='$num' LIMIT 1"
        or die('actualizacion cancelada ');  
    }else{
        $sqlCommand= "INSERT INTO clientes (razon_social,rfc,sucursal,nom_corto,calleno,col,del,ciudad,estado,cp,nivel,usu,status) 
        VALUES ('$nombre','$rfc','$suc','$corto','$calleno','$col','$del','$ciudad','$estado','$cp','$nivel','$usu',0)"
        or die('insercion cancelada '.$table);
    }
    
    // Execute the query here now
    $query = mysqli_query($mysqli, $sqlCommand) or die (mysqli_error($mysqli)); 
    /* liberar la serie de resultados */
    mysqli_free_result($query);
  /* cerrar la conexión */
    mysqli_close($mysqli);
    
    
    header('Location: clientes.php');
       
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
  $titulo = "ACTUALIZACION CLIENTES";
  include_once "include/barrasup.php";
  
  ?> 
  
 <!-- la forma. ------>
  <div class="cajacentra">

    <form id="modifcte" action="<?php echo $_SERVER['PHP_SELF']; ?>" method = "POST">
        
       <table  class="db-table">
          
        
     <tr>
            <tr>
                <td >No.</td> 
                <?php
                echo "<td>$num</td>";
                echo "<td>NIVEL</td>";
                echo "<td >
                        <select name ='nivel'id='inic' value = '$nivel'>
                            <option value='1'>1</option>
                            <option value='2'>2</option>
                            <option value='3'>3</option>
                            <option value='4'>4</option>
                        </select>
                      </td>";
            echo "</tr>";
            echo "<tr>";
                echo "<td >NOMBRE O RAZON SOCIAL:</td> ";
                echo "<td><input  name ='nom' value = '$nombre'  size = '60'/> </td>";
                echo "<td >RFC</td> ";
                echo "<td ><input name ='rfc' value = '$rfc' /></td>";
			echo "</tr>";
			echo "<tr>";
				echo "<td >SUCURSAL</td> ";
                echo "<td ><input name ='suc' value = '$suc' /></td>";
                echo " <td>NOMBRE CORTO</td>";
                echo "<td ><input name ='corto' value = '$corto' /></td>";
            echo "</tr>";
            echo "<tr>";
                echo "<td> CALLE Y NO.</td>";
                echo "<td ><input name ='calleno' value = '$calleno' size = '60' /></td>";
                echo "<td>COLONIA</td>";
                echo "<td ><input name ='col' value = '$col' size = '60' /></td>";
            echo "</tr>";
			echo "<tr>";
                echo "<td>DELEGACION</td>";
                echo "<td ><input name ='del' value = '$del' size = '60' /></td>";
                echo "<td>CIUDAD</td>";
                echo "<td ><input name ='ciudad' value = '$ciudad' size = '60' /></td>";
            echo "</tr>";
            echo "<tr>";
                echo "<td>ESTADO</td>";
                echo "<td ><input name ='estado' value = '$estado' size = '60' /></td>";
                echo "<td>CP</td>";
                echo "<td ><input name ='cp' value = '$cp' size = '10' /></td>";
            echo "</tr>";
             
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
