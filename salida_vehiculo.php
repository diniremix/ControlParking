<?php require_once('connections/conexion.php'); ?>
<?php
error_reporting(7);
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

$placa = $_POST['placa'];
$fecha_salida = $_POST['fecha_salida'];
$hora_salida = $_POST['hora_salida'];
$transcurrido = $_POST['transcurrido'];
$usuario_salida = $_POST['usuario_salida'];
$valor_cobro = $_POST['valor_cobro'];


	$insertSQL = sprintf("UPDATE movimientos SET fecha_salida=' $fecha_salida', hora_salida='$hora_salida', usuario_salida='$usuario_salida',  transcurrido = '$transcurrido', valor_cobro = '$valor_cobro', tipo_cobro = 'horas', e_s ='1' 
WHERE placa='$placa'",
                       GetSQLValueString($_POST['placa'], "text"),
                       GetSQLValueString($_POST['tipo'], "text"),
                       GetSQLValueString($_POST['fecha_llegada'], "date"),
                       GetSQLValueString($_POST['hora_llegada'], "date"),
                       GetSQLValueString($_POST['usuario_llegada'], "int"),
                       GetSQLValueString($_POST['fecha_salida'], "date"),
                       GetSQLValueString($_POST['hora_salida'], "date"),
                       GetSQLValueString($_POST['usuario_salida'], "text"),
                       GetSQLValueString($_POST['transcurrido'], "date"),
                       GetSQLValueString($_POST['valor_cobro'], "int"),
                       GetSQLValueString($_POST['tipo_cobro'], "text"),
                       GetSQLValueString($_POST['e_s'], "int"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());

  $insertGoTo = "salida_vehiculo.php";
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
					 <h1>Salida de veh&iacute;culos</h1>
				<div class="columns">
						<div class="half">
							
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="busqueda" id="busqueda">
<strong class="subHeading">Buscar por placa</strong>
 <input name="busquedas" type="text" value="" size="6" maxlength="6" />

<br />
        <div class="formRow">
		  <button class="btnSmall btn submit right" value="enviar" type="submit" id="enviar" name="enviar">
		  <span>Buscar</span>
		  </button>
		   &nbsp;&nbsp;
		  <button class="btnSmall btn submit left" value="enviar" type="submit" id="enviar" name="enviar">
		  <span>Listar Todos</span>
		  </button>
		</div>	

</form>



<?php 

if (!isset($busquedas) && !isset($_POST['busquedas'])){  

}
else {  
	
	echo "Busqueda:   ",  $_POST['busqueda'];
?>
<table border="0" cellpadding="5" cellspacing="5">
  <tr bgcolor="#FFFFFF">
    
    <td width="20%"><font color="#000000"><b>Placa No.</font></b></td>
    <td width="20%"><font color="#000000"><b>Tipo de vehiculo</b></font></td>
    <td width="35%"><font color="#000000"><b>fecha llegada</b></font></td>
    <td width="25%"><font color="#000000"><b>hora llegada</b></font></td>
  </tr>
<?php 

  		$buscada=$_POST['busquedas'];
		
		
		mysql_select_db($database_conexion, $conexion);
		$query_All = "SELECT *  FROM `movimientos` 
					WHERE `placa` LIKE '%$buscada%' && `e_s` = '0'";
		$All = mysql_query($query_All, $conexion) or die(mysql_error());
		$row_All = mysql_fetch_assoc($All);
		$totalRows_All = mysql_num_rows($All);

  
  do { ?>
    <tr>
      <td>
      
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="resultado" id="resultado">
      <input type="hidden" name="MM_insert" value="form1" />
      <input name="placaformulario" type="hidden" value="<?php echo $row_All['placa']; ?>" size="6" maxlength="6" />
      <button value="placa" type="submit" name="enviar" ><?php echo $row_All['placa']; ?></button></form></td>
      <td><?php echo $row_All['tipo']; ?></td>
      <td><?php echo $row_All['fecha_llegada']; ?></td>
      <td ><em><?php echo $row_All['hora_llegada']; ?></em></td>
    </tr>
    <?php } while ($row_All = mysql_fetch_assoc($All)); 
	
	mysql_free_result($All);

}


//echo $row_All['placa'];
//$plaquita = $row_All['placa'] ;
//$placabuscada = $_POST['placaformulario'];
// echo $placabuscada, $plaquita,  $row_All['placa'];

	?>
</table>

 
						</div>

				<div class="half">
							
        

  <?php   

if ((isset($_POST["placaformulario"])) && ($_POST["MM_insert"] == "form1")) {

date_default_timezone_set("America/Bogota");
$fecha_salida = date('Y-m-d');
$hora_salida=  date('H:i:s');

$placabuscada = $_POST['placaformulario'];

mysql_select_db($database_conexion, $conexion);
$query_vehiculos = "SELECT * FROM movimientos  
WHERE  `placa` =  '$placabuscada' && `e_s` = '0'";
$vehiculos = mysql_query($query_vehiculos, $conexion) or die(mysql_error());
$row_vehiculos = mysql_fetch_assoc($vehiculos);
$totalRows_vehiculos = mysql_num_rows($vehiculos);


$fecha_llegada =  $row_vehiculos['fecha_llegada'];
$hora_llegada =   $row_vehiculos['hora_llegada'];

$id = $row_vehiculos['id'];

$duracion = $hora_llegada - $hora_salida;
$horas = (int) $duracion/3600;
$duracion = $duracion - ($horas * 3600);
$minutos = (int) $duracion/60;
$segundos = $duracion - ($minutos * 60);

/*

echo 'llegada ',  $hora_llegada,'<br />' , 'salida  ',$hora_salida, '<br />' ;
echo '<br />', 'Dia llegada', $dia_llegada, '<br />', 'Dia salida', $dia_salida, '<br />', 
'Hora llegada  ',$hora_llegada, '<br />', 'Hora Salida  ', $hora_salida, '<br />',  
 'usuario',$row_vehiculos['usurio_llegada'], '<br />','placa ', $row_vehiculos['placa'], '<br />'  ; 
*/

//desde aqui
$fechaini = $fecha_llegada;
$fechafin = $fecha_salida;

	$añoi=substr($fechaini,0,4);
	$mesi=substr($fechaini,5,2);
	$diai=substr($fechaini,8,2);

	$añof=substr($fechafin,0,4);
	$mesf=substr($fechafin,5,2);
	$diaf=substr($fechafin,8,2);

	$aini=($añoi);
	$afin=($añof);

	$adif=$afin-$aini;

	$mini=($mesi);
	$mfin=($mesf);

	$mdif=$mfin-$mini;

	$dini=($diai);
	$dfin=($diaf);

	$tddif=$dfin-$dini;

$diastotal = (($adif*360)+($mdif*30)+($tddif));

//hasta aqui

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
		
	$thdif = date("H:i:s",mktime($difh))+(24*$diastotal);

	$transcurrido = date("H:i:s",mktime($difh,$difm,$difs));
//	echo 'Diferencia : ', $transcurrido;

	$valor_cobro = $thdif * 1000;	

	
//	echo 'VALOR HORA : ', $valor_hora;


}

?>      	        
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="form2" id="form2">
  <table align="center">
    <tr>
      <td nowrap="nowrap" align="right">Placa No.: </td>
      <td><input name="placa" type="text" disabled="disabled" value="<?php echo $placabuscada?>" size="6" maxlength="6" /></td>
    </tr>
    <tr>
      <td nowrap="nowrap" align="right">Fecha de salida:</td>
      <td><input name="fecha_salida" type="text" disabled="disabled" value="<?php echo  $fecha_salida?>" size="32" /></td>
    </tr>
    <tr>
      <td nowrap="nowrap" align="right">Hora de salida:</td>
      <td><input name="hora_salida" type="text" disabled="disabled" value="<?php echo $hora_salida?>" size="32" /></td>
    </tr>
    <tr>
      <td nowrap="nowrap" align="right">Usuario Actual:</td>
      <td><input name="usuario_salida" type="text" disabled="disabled" value="<?php echo $_SESSION['login']?>" size="32" /></td>
    </tr>
    <tr>
      <td nowrap="nowrap" align="right">D&iacute;as transcurridos:</td>
      <td><input name="transdias" type="text" disabled="disabled" value="<?php echo $diastotal?> " size="32" /></td>
    </tr>
    <tr>
      <td nowrap="nowrap" align="right">Horas transcurridas:</td>
      <td><input name="transcurrido" type="text" disabled="disabled" value="<?php echo $transcurrido?> " size="32" /></td>
    </tr>
    <tr>
      <td nowrap="nowrap" align="right">Valor de cobro:</td>
      <td><input name="valor_cobro" type="text" disabled="disabled" value="<?php echo $valor_cobro ?>" size="32" /></td>
    </tr>
	  <input type="hidden" name="placa" type="text" value="<?php echo $placabuscada?>" />
	  <input type="hidden" name="fecha_salida" type="text" value="<?php echo  $fecha_salida?>" />
	  <input type="hidden" name="hora_salida" type="text" value="<?php echo $hora_salida?>" />
	  <input type="hidden" name="usuario_salida" type="text" value="<?php echo $_SESSION['login']?>" />
	  <input type="hidden" name="transcurrido" type="text" value="<?php echo $transcurrido?>" />
	  <input type="hidden" name="valor_cobro" type="int" value="<?php echo $valor_cobro ?>" />
	  <input type="hidden" name="tipo_cobro" type="text" value="horas" />
	  <input type="hidden" name="e_s" type="int" value="1" />
	  <input type="hidden" name="MM_insert" value="form2" />
    <tr>
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td>
        <div class="formRow">
		  <button class="btnSmall btn submit right" value="send" type="submit" id="send" name="send">
		  <span>Salida</span>
		  </button>
		</div>	

	</div>	
    </tr>
  </table>

</form>
              
</div>
</div>
					</div>
				</div>
</section>

        

<?php
require_once('footer.php');
?>
