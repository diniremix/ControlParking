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

$insertSQL = sprintf("INSERT INTO movimientos (placa, tipo, fecha_llegada, hora_llegada, usuario_llegada, fecha_salida, hora_salida, usuario_salida, transcurrido, valor_cobro, tipo_cobro, cliente, e_s) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['placa'], "text"),
                       GetSQLValueString($_POST['tipo'], "text"),
                       GetSQLValueString($_POST['fecha_llegada'], "date"),
                       GetSQLValueString($_POST['hora_llegada'], "date"),
                       GetSQLValueString($_POST['usuario_llegada'], "text"),
                       GetSQLValueString($_POST['fecha_salida'], "date"),
                       GetSQLValueString($_POST['hora_salida'], "date"),
                       GetSQLValueString($_POST['usuario_salida'], "text"),
                       GetSQLValueString($_POST['transcurrido'], "date"),
                       GetSQLValueString($_POST['valor_cobro'], "int"),
                       GetSQLValueString($_POST['tipo_cobro'], "text"),
                       GetSQLValueString($_POST['cliente'], "text"),
                       GetSQLValueString($_POST['e_s'], "int"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());

  $insertGoTo = "ingreso_vehiculo.php";
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
					 <h1>Ingreso Veh&iacute;culo</h1>
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
		$query_All = "SELECT *  FROM `vehiculos`, `pagos` 
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

<?php date_default_timezone_set("America/Bogota"); ?>
        
        
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="form2" id="form2">
  <table align="center"  border="0">
    <tr>
      <td nowrap="nowrap" align="right">Placa:</td>
      <td colspan="2"><input name="placa" type="text" value="<?php echo $_POST['placaformulario'] ?>" size="6" maxlength="6" /></td>
    </tr>
<?php if ($_POST['tipo'] === 'moto'){ $moto = 'checked'; } else { $carro = 'checked'; } ?>
    <tr>
      <td align="right">Tipo de Veh&iacuteculo: </td>
	  <td align="center" size="50%">Moto:  	<input type="radio" name="tipo" value="moto" <?php echo $moto ?> /></td>
      <td align="center" size="50%">Carro:     <input type="radio" name="tipo" value="carro" <?php echo $carro ?> /></td>
    </tr>
    <tr >
      <td nowrap="nowrap" align="right">Fecha de llegada:</td>
      <td colspan="2"><input name="fecha_llegada" type="text" disabled="disabled" value="<?php echo date('Y-m-d')?>" size="32" /></td>
    </tr>
    <tr >
      <td nowrap="nowrap" align="right">Hora de llegada:</td>
      <td colspan="2"><input name="hora_llegada" type="text" disabled="disabled"  value ="<?php echo date('H:i:s')?>"   size="32" /></td>
    </tr>
    <tr >
      <td nowrap="nowrap" align="right" >Usuario de llegada:</td>
      <td colspan="2"><input name="usuario_llegada" type="text" disabled="disabled" value="<?php echo $_SESSION['nombres']?>" size="32" /></td>
    </tr>
	  <input type="hidden" name="fecha_llegada" type="text" value="<?php echo date('Y-m-d')?>" />
	  <input type="hidden" name="hora_llegada" type="text" value="<?php echo date('H:i:s')?>" />
	  <input type="hidden" name="usuario_llegada" type="text" value="<?php echo $_SESSION['nombres']?>" />
	  <input type="hidden" name="fecha_salida" type="text" value="0000-00-00" />
	  <input type="hidden" name="hora_salida" type="text" value="00:00:00" />
	  <input type="hidden" name="usuario_salida" type="text" value=" " />
	  <input type="hidden" name="transcurrido" type="text" value="00:00:00" />
	  <input type="hidden" name="valor_cobro" type="int" value="0" />
	  <input type="hidden" name="tipo_cobro" type="text" value="horas" />
	  <input type="hidden" name="e_s" type="int" value="0" />

    <tr>
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td colspan="2">
      	<div class="formRow">
		  <button class="btnSmall btn submit right" type="submit" name="submit">
		  <span>Ingresar</span>
		  </button>
		</div>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form2" />
</form>
       
</div>
</div>
					</div>
				</div>
</section>

        

<?php
require_once('footer.php');
?>

