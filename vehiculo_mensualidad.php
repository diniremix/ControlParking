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

if (isset($_POST['tiempo'])) {
  switch ($_POST['tiempo']) {
    case "dia":
      $fecha_vencimiento = date('Y-m-d', strtotime('+1 day'));
      break;
    case "semana":
      $fecha_vencimiento = date('Y-m-d', strtotime('+1 week'));
      break;
    case "15dias":
      $fecha_vencimiento = date('Y-m-d', strtotime('+2 week'));
      break;    
     case "mes_l":
      $fecha_vencimiento = date('Y-m-d', strtotime('+1 month'));
      break;
    case "mes_c":
      $fecha_vencimiento = date('Y-m-d', strtotime('+1 month'));
      break;
    case "mes":
      $fecha_vencimiento = date('Y-m-d', strtotime('+1 month'));
      break;

  return $fecha_vencimiento;

}}

  $insertSQL = sprintf("INSERT INTO pagos (cedula, fecha_pago, fecha_vencimiento, hora_pago, tiempo, usuario_pago) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['cedula'], "text"),
                       GetSQLValueString($_POST['fecha_pago'], "date"),
                       GetSQLValueString($fecha_vencimiento, "date"),
                       GetSQLValueString($_POST['hora_pago'], "date"),
                       GetSQLValueString($_POST['tiempo'], "text"),
                       GetSQLValueString($_POST['usuario_pago'], "text"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());

  $insertGoTo = "vehiculo_mensualidad.php";
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
					 <h1>Ingreso Pagos</h1>
				<div class="columns">
						<div class="half">
							
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="busqueda" id="busqueda">
<strong class="subHeading">Buscar placa</strong>
<input name="busquedas" type="text" value="" size="6" maxlength="6" />

<br />
        <div class="formRow">
		  <button class="btnSmall btn submit right" value="enviar" type="submit" id="enviar" name="enviar">
		  <span>Buscar</span>
		  </button>
		</div>	


</form>



<?php 

if (!isset($busquedas) && !isset($_POST['busquedas'])){  

}
else {  
	
//	echo "Busqueda:   ",  $_POST['busquedas'];
?>
<table border="0" cellpadding="5" cellspacing="5">
  <tr bgcolor="#FFFFFF">
    
    <td width="20%"><font color="#000000"><b>Placa</font></b></td>
    <td width="20%"><font color="#000000"><b>Tipo de vehiculo</b></font></td>
    <td width="35%"><font color="#000000"><b>Marca/modelo</b></font></td>
    <td width="25%"><font color="#000000"><b>color</b></font></td>
  </tr>
<?php 

  		$buscada=$_POST['busquedas'];
		
		
		mysql_select_db($database_conexion, $conexion);
		$query_All = "SELECT *  FROM `vehiculos`, `clientes` 
					WHERE   `cliente` = `cedula` AND `placa` LIKE '%$buscada%'";
		$All = mysql_query($query_All, $conexion) or die(mysql_error());
		$row_All = mysql_fetch_assoc($All);
		$totalRows_All = mysql_num_rows($All);

  
  do { ?>
    <tr>
      <td>
      
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="resultado" id="resultado">
      <input type="hidden" name="MM_insert" value="form1" />
      <input type="hidden" name="cedula" value="<?php echo $row_All['cliente']; ?>" />
      <input type="hidden" name="tipo" value="<?php echo $row_All['tipo']; ?>" />
      <input name="placaformulario" type="hidden" value="<?php echo $row_All['placa']; ?>" size="6" maxlength="6" />
      <button value="placa" type="submit" name="enviar" ><?php echo $row_All['placa']; ?></button></form></td>
      <td><?php echo $row_All['tipo']; ?></td> <td><?php echo $row_All['marca']; ?>
      <?php echo $row_All['modelo']; ?></td>
      <td><?php echo $row_All['color']; ?></td>
    </tr>
    <?php } while ($row_All = mysql_fetch_assoc($All)); 
	
	mysql_free_result($All);

}
//echo $row_All['placa'];
//$plaquita = $row_All['placa'] ;
//$placabuscada = $_POST['placaformulario'];
//echo $placabuscada, $plaquita,  $row_All['placa'];
	?>
</table>

 
						</div>
						<div class="half">
							
  <?php   

date_default_timezone_set("America/Bogota");

$placabuscada = $_POST['placaformulario'];
$cedula = $_POST['cedula'];
$fecha_pago = date('Y-m-d');
$hora_pago = date('H:i:s');

?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="form2" id="form2">
  <table align="center">
    <tr>
      <td nowrap="nowrap" align="right">Placa: </td>
      <td><input name="placa" type="text" disabled="disabled" value="<?php echo $placabuscada?>" size="6" maxlength="6" /></td>
    </tr>
    <tr>
      <td nowrap="nowrap" align="right">Cedula: </td>
      <td><input name="cedula" type="text" disabled="disabled" value="<?php echo $cedula?>" size="6" maxlength="6" /></td>
    </tr>
    <tr>
      <td nowrap="nowrap" align="right">Fecha de pago:</td>
      <td><input name="fecha_pago" type="text" disabled="disabled" value="<?php echo  $fecha_pago?>" size="32" /></td>
    </tr>
    <tr>
      <td nowrap="nowrap" align="right">Hora de pago:</td>
      <td><input name="hora_pago" type="text" disabled="disabled" value="<?php echo $hora_pago?>" size="32" /></td>
    </tr>
    <tr>
      <td nowrap="nowrap" align="right">Valor de pago:</td>
      <td><select id="tiempo" name="tiempo">
<?php
						$tsql = "SELECT * from tarifas WHERE tipo = '$_POST[tipo]' && valor_tarifa >= '10000'";
						$tresult = mysql_query($tsql) or die('Query failed: ' . mysql_error($conexion));

						while ($tarifas = mysql_fetch_array($tresult)) {
?>
            <option id="pago" value="<?php echo $tarifas['tiempo']; ?>"><?php echo $tarifas['valor_tarifa']; ?>&nbsp;<?php echo $tarifas['tiempo']; ?></option>
<?php
}
	?>
	      </select></td>
    </tr>
    <tr>
      <td nowrap="nowrap" align="right">Usuario:</td>
      <td><input name="usuario_pago" type="text" disabled="disabled" value="<?php echo $_SESSION['login']?>" size="32" /></td>
    </tr>
	  <input type="hidden" name="placa" type="text" value="<?php echo $placabuscada?>" />
	  <input type="hidden" name="cedula" type="text" value="<?php echo $cedula?>" />
	  <input type="hidden" name="fecha_pago" type="text" value="<?php echo $fecha_pago?>" />
	  <input type="hidden" name="hora_pago" type="text" value="<?php echo $hora_pago?>" />
	  <input type="hidden" name="usuario_pago" type="text" value="<?php echo $_SESSION['login']?>" />
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

        
			</section>
		</div>
<?php     
require_once('footer.php');
?>