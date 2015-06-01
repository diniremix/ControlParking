<?php require_once('connections/conexion.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form2")) {
  $insertSQL = sprintf("INSERT INTO movimientos (placa, tipo_vehiculo, fecha_llegada, hora_llegada, usuario_llegada, fecha_salida, hora_salida, usuario_salida, transcurrido, valor_cobro, tipo_cobro) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['placa'], "text"),
                       GetSQLValueString($_POST['tipo_vehiculo'], "int"),
                       GetSQLValueString($_POST['fecha_llegada'], "date"),
                       GetSQLValueString($_POST['hora_llegada'], "date"),
                       GetSQLValueString($_POST['usuario_llegada'], "int"),
                       GetSQLValueString($_POST['fecha_salida'], "date"),
                       GetSQLValueString($_POST['hora_salida'], "date"),
                       GetSQLValueString($_POST['usuario_salida'], "int"),
                       GetSQLValueString($_POST['transcurrido'], "date"),
                       GetSQLValueString($_POST['valor_cobro'], "int"),
                       GetSQLValueString($_POST['tipo_cobro'], "text"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());

  $insertGoTo = "index.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}



require_once('header.php');
require_once('pagewidth.php');
?>
<section id="twoColumnLayout" class="row grey">
				<div class="center">
					 <h1>Ingreso Mensualidad</h1>
				<div class="columns">
						<div class="half">

<form action="vehiculo_mensualidad.php" method="post">
<strong class="subHeading">Buscar placa</strong>
 <input name="busqueda" type="text" value=""  disabled="disabled" size="6" maxlength="6" />

<br />
        <div class="formRow">
		  <button class="btnSmall btn submit right" value="enviar" type="submit" id="enviar" name="enviar" disabled="disabled">
		  <span>Buscar</span>
		  </button>
		</div>	


</table>

 
						</div>
						<div class="half">
							
        

  <?php   
date_default_timezone_set("America/Bogota");
$dia_salida = date('d-m-Y');
$hora_salida=  date('H:i:s');

$placabuscada = $_POST['placaformulario'];

mysql_select_db($database_conexion, $conexion);
$query_vehiculos = "SELECT * FROM movimientos  
WHERE  `placa` =  '$placabuscada'";
$vehiculos = mysql_query($query_vehiculos, $conexion) or die(mysql_error());
$row_vehiculos = mysql_fetch_assoc($vehiculos);
$totalRows_vehiculos = mysql_num_rows($vehiculos);


$dia_llegada =  $row_vehiculos['fecha_llegada'];
$hora_llegada =   $row_vehiculos['hora_llegada'];

$id = $row_vehiculos['id'];
/*
$duracion = $hora_salida - $hora_llegada;
$horas = (int) $duracion/3600;
$duracion = $duracion - ($horas * 3600);
$minutos = (int) $duracion/60;
$segundos = $duracion - ($minutos * 60);



echo 'llegada ',  $hora_llegada,'<br />' , 'salida  ',$hora_salida, '<br />' ;
echo '<br />', 'Dia llegada', $dia_llegada, '<br />', 'Dia salida', $dia_salida, '<br />', 
'Hora llegada  ',$hora_llegada, '<br />', 'Hora Salida  ', $hora_salida, '<br />',  
 'usuario',$row_vehiculos['usurio_llegada'], '<br />','placa ', $row_vehiculos['placa'], '<br />'  ; 


*/



$horaini = $hora_llegada;
$horafin = $hora_salida;

	$horai=substr($horaini,0,2);
	$mini=substr($horaini,3,2);
	$segi=substr($horaini,6,2);

	$horaf=substr($horafin,0,2);
	$minf=substr($horafin,3,2);
	$segf=substr($horafin,6,2);

	$ini=((($horai*60)*60)+($mini*60)+$segi);
	$fin=((($horaf*60)*60)+($minf*60)+$segf);

	$dif=$fin-$ini;

	$difh=floor($dif/3600);
	$difm=floor(($dif-($difh*3600))/60);
	$difs=$dif-($difm*60)-($difh*3600);
	$transcurrido = date("H:i:s",mktime($difh,$difm,$difs));
//	echo 'Diferencia : ', $transcurrido;

	$valor_cobro = $difh * 1000;	
	
//	echo 'VALOR HORA : ', $valor_hora;
		

?>      	        
<form action="vehiculo_mensualidad.php" method="post" name="form2">
  <table align="center">
    <tr>
      <td nowrap="nowrap" align="right">Placa: </td>
      <td><input name="placa" type="text" disabled="disabled" value="<?php echo $placabuscada?>" size="6" maxlength="6" /></td>
    </tr>
  
    
    <tr>
      <td nowrap="nowrap" align="right">Fecha de pago:</td>
      <td><input name="fecha_salida" type="text" disabled="disabled" value="<?php echo  $dia_salida, '  ', $hora_salida?>" size="32" /></td>
    </tr>
    <tr>
      <td nowrap="nowrap" align="right">Usuario salida:</td>
      <td><input name="usuario_salida" type="text" disabled="disabled" value="<?php echo $_SESSION['nombres']?>" size="32" /></td>
    </tr>
    <tr>
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td>
          <div class="formRow">
		  <button class="btnSmall btn submit right">
		  <span>Salida</span>
		  </button>
		</div>	
    </tr>
  </table>

  <input type="hidden" name="MM_insert" value="form2" />
</form>
<?php 
$sql="UPDATE `parqueadero`.`movimientos`
SET fecha_salida=' $dia_salida', hora_salida='$hora_salida', usuario_salida='$_SESSION[nombres]',  transcurrido = '$transcurrido', valor_cobro = '$valor_hora'
WHERE id='$id' ;";
$demo = mysql_query($sql, $conexion) or die(mysql_error($conexion));




mysql_free_result($vehiculos);
       
?>        
</div>
  </div>
					</div>
				</div>
</section>

        
			</section>
		</div>
     
<?php
require_once('footer.php');
?>