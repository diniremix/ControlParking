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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO clientes (cedula, nombres, apellidos) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['cedula'], "text"),
                       GetSQLValueString($_POST['nombres'], "text"),
                       GetSQLValueString($_POST['apellidos'], "text"),
                       GetSQLValueString($_POST['placa'], "text"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());



$insertSQL2 = sprintf("INSERT INTO vehiculos (placa, tipo, marca, modelo, color, cliente) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['placa'], "text"),
                       GetSQLValueString($_POST['tipo'], "text"),
                       GetSQLValueString($_POST['marca'], "text"),
                       GetSQLValueString($_POST['modelo'], "text"),
                       GetSQLValueString($_POST['color'], "text"),
                       GetSQLValueString($_POST['cedula'], "text"));

  mysql_select_db($database_conexion, $conexion);
  $Result2 = mysql_query($insertSQL2, $conexion) or die(mysql_error());

  $insertGoTo = "ingreso_cliente.php";
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
					<h1>Registro Clientes Nuevos</h1>
					
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="form1" id="form1">
  <table align="center" cellspacing="5" cellpadding="5">
     <tr>
      <td align="right">C&eacute;dula</td>
      <td><input name="cedula" type="text" value="" size="10" maxlength="10" /></td>
    </tr>
    <tr>
      <td align="right">Nombres</td>
      <td><input name="nombres" type="text" value="" size="35" maxlength="35" /></td>
    </tr>
    <tr>
      <td nowrap="nowrap" align="right">Apellidos</td>
      <td><input name="apellidos"type="text"  value="" size="35" maxlength="35"/></td>
    </tr>
    <tr>
      <td nowrap="nowrap" align="center">Placa Vehiculo</td>
      <td><input name="placa" type="text"  value="" size="6"maxlength="6" /></td>
    </tr>
    
     <tr>
      <td align="right">Tipo de Veh&iacuteculo: </td>
	  <td align="center" size="50%">Moto:  	<input type="radio" name="tipo" value="moto" checked /></td>
      <td align="center" size="50%">Carro:     <input type="radio" name="tipo" value="carro"/></td>
    </tr>
    <tr>
      <td nowrap="nowrap" align="center">Marca</td>
      <td><input name="marca" type="text"  value=""  maxlength="12" /></td>
    </tr>
    <tr>
      <td nowrap="nowrap" align="center">Modelo</td>
      <td><input name="modelo" type="text"  value="" maxlength="4" /></td>
    </tr>
    <tr>
      <td nowrap="nowrap" align="center">Color</td>
      <td><input name="color" type="text"  value="" maxlength="10" /></td>
    </tr>
    
    <tr>
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><button class="btnSmall btn submit right"><span>Enviar</span></button></td>
    </tr>											
										
  <input type="hidden" name="MM_insert" value="form1" />
</form>
    
  </table>
									
										
                   
			</section>
		</div>
<?php        
require_once('footer.php');

?>