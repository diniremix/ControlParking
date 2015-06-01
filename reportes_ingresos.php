<?php require_once('Connections/conexion.php'); ?>
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

require_once('header.php');
require_once('pagewidth.php');

if ($_SESSION['tipo'] === '1') {
?>



			<section class="row">
				<div class="center">
	<?php 


date_default_timezone_set("America/Bogota");

		$hoy = date('Y-m-d');
		$numeroSemana = date("W");

//		echo $hoy, '   ' ,$numeroSemana;


//aqui meto yo
$año = date(Y);
$mes = date(m);
$numerosemana = date("W");
if ($numerosemana > 0 and $numerosemana < 54) {$numerosemana = $numerosemana;
$primerdiaS = $numerosemana * 7 -7;
$ultimodiaS = $numerosemana * 7 -1;
$principioaño = "$año-01-01";
$principiomes = "$año-$mes-01";
$primerdia = date('Y-m-d', strtotime("$principioaño + $primerdiaS DAY")); 
$ultimodia = date('Y-m-d', strtotime ("$principioaño + $ultimodiaS DAY")); 
$primerdiames = date('Y-m-d', strtotime("$principiomes")); 
if ($fecha2 <= date('Y-m-d', strtotime("$año-12-31"))) {$fecha2 = $fecha2;} else {$fecha2 = date('Y-m-d',strtotime("$año-12-31"));}
//echo 'la semana nº '.$numerosemana.' del año '.$año.', va desde '.$primerdia.' hasta '.$ultimodia.'</br>';} else {echo "este número de semana no es válido";
}

//hasta aqui

mysql_select_db($database_conexion, $conexion);
$query_Diario = "SELECT * FROM movimientos WHERE fecha_salida = '$hoy'";
$Diario = mysql_query($query_Diario, $conexion) or die(mysql_error());
$row_Diario = mysql_fetch_assoc($Diario);
$totalRows_Diario = mysql_num_rows($Diario);

mysql_select_db($database_conexion, $conexion);
$query_sumatoria = "SELECT sum(valor_cobro) as suma from movimientos WHERE fecha_salida = '$hoy' ";
$sumatoria = mysql_query($query_sumatoria, $conexion) or die(mysql_error());
$row_sumatoria = mysql_fetch_assoc($sumatoria);
$totalRows_sumatoria = mysql_num_rows($sumatoria);

mysql_select_db($database_conexion, $conexion);
$query_Semanal = "SELECT * FROM `movimientos` WHERE fecha_salida  BETWEEN '$primerdia' AND '$hoy' ";
$Semanal = mysql_query($query_Semanal, $conexion) or die(mysql_error());
$row_Semanal = mysql_fetch_assoc($Semanal);
$totalRows_Semanal = mysql_num_rows($Semanal);

mysql_select_db($database_conexion, $conexion);
$query_sumatoriasem = "SELECT sum(valor_cobro) as suma from movimientos WHERE fecha_salida BETWEEN '$primerdia' AND '$hoy' ";
$sumatoriasem = mysql_query($query_sumatoriasem, $conexion) or die(mysql_error());
$row_sumatoriasem = mysql_fetch_assoc($sumatoriasem);
$totalRows_sumatoriasem = mysql_num_rows($sumatoriasem);

mysql_select_db($database_conexion, $conexion);
$query_mensual = "SELECT * FROM `movimientos` WHERE fecha_salida BETWEEN '$primerdiames' AND '$hoy' ";
$mensual = mysql_query($query_mensual, $conexion) or die(mysql_error($conexion));
$row_mensual = mysql_fetch_assoc($mensual);
$totalRows_mensual = mysql_num_rows($mensual);

mysql_select_db($database_conexion, $conexion);
$query_sumatoriames = "SELECT sum(valor_cobro) as suma from movimientos WHERE fecha_salida BETWEEN '$primerdiames' AND '$hoy' ";
$sumatoriames = mysql_query($query_sumatoriames, $conexion) or die(mysql_error());
$row_sumatoriames = mysql_fetch_assoc($sumatoriames);
$totalRows_sumatoriames = mysql_num_rows($sumatoriames);

?>           


<strong class="subHeading"> Reporte Diario</br> <?php echo date('Y-m-d'); ?></strong>
					
<table border="1" cellpadding="1" cellspacing="1">
  <tr>
    <td>id</td>
    <td>placa</td>
    <td>tipo</td>
    <td>fecha llegada</td>
    <td>hora llegada</td>
    <td>fecha salida</td>
    <td>hora salida</td>
    <td>transcurrido</td>
    <td>valor cobro</td>
    <td>cliente</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_Diario['id']; ?></td>
      <td><?php echo $row_Diario['placa']; ?></td>
      <td><?php echo $row_Diario['tipo']; ?></td>
      <td><?php echo $row_Diario['fecha_llegada']; ?></td>
      <td><?php echo $row_Diario['hora_llegada']; ?></td>
      <td><?php echo $row_Diario['fecha_salida']; ?></td>
      <td><?php echo $row_Diario['hora_salida']; ?></td>
      <td><?php echo $row_Diario['transcurrido']; ?></td>
      <td><?php echo $row_Diario['valor_cobro']; ?></td>
      <td><?php echo $row_Diario['cliente']; ?></td>
    </tr>
    <?php } while ($row_Diario = mysql_fetch_assoc($Diario)); ?>
</table>

sumatoria = <?php echo $row_sumatoria['suma']?>

</br>
<h1></h1>
<strong class="subHeading">Reporte Semanal </br> Desde <?php echo $primerdia; ?> hasta <?php echo $hoy; ?></strong>

<table border="1" cellpadding="1" cellspacing="1">
  <tr>
    <td>id</td>
    <td>placa</td>
    <td>tipo</td>
    <td>fecha llegada</td>
    <td>hora llegada</td>
    <td>fecha salida</td>
    <td>hora salida</td>
    <td>transcurrido</td>
    <td>valor cobro</td>
    <td>cliente</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_Semanal['id']; ?></td>
      <td><?php echo $row_Semanal['placa']; ?></td>
      <td><?php echo $row_Semanal['tipo']; ?></td>
      <td><?php echo $row_Semanal['fecha_llegada']; ?></td>
      <td><?php echo $row_Semanal['hora_llegada']; ?></td>
      <td><?php echo $row_Semanal['fecha_salida']; ?></td>
      <td><?php echo $row_Semanal['hora_salida']; ?></td>
      <td><?php echo $row_Semanal['transcurrido']; ?></td>
      <td><?php echo $row_Semanal['valor_cobro']; ?></td>
      <td><?php echo $row_Semanal['cliente']; ?></td>
    </tr>
    <?php } while ($row_Semanal = mysql_fetch_assoc($Semanal)); ?>
       
</table>

sumatoriasem = <?php echo $row_sumatoriasem['suma']?>

</br>
<h1></h1>
<strong class="subHeading">Reporte Mensual</br> Desde <?php echo $primerdiames; ?> hasta <?php echo $hoy; ?></strong>
    				
<table border="1" cellpadding="1" cellspacing="1">
  <tr>
    <td>id</td>
    <td>placa</td>
    <td>tipo</td>
    <td>fecha llegada</td>
    <td>hora llegada</td>
    <td>fecha salida</td>
    <td>hora salida</td>
    <td>transcurrido</td>
    <td>valor cobro</td>
    <td>cliente</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_mensual['id']; ?></td>
      <td><?php echo $row_mensual['placa']; ?></td>
      <td><?php echo $row_mensual['tipo']; ?></td>
      <td><?php echo $row_mensual['fecha_llegada']; ?></td>
      <td><?php echo $row_mensual['hora_llegada']; ?></td>
      <td><?php echo $row_mensual['fecha_salida']; ?></td>
      <td><?php echo $row_mensual['hora_salida']; ?></td>
      <td><?php echo $row_mensual['transcurrido']; ?></td>
      <td><?php echo $row_mensual['valor_cobro']; ?></td>
      <td><?php echo $row_mensual['cliente']; ?></td>
    </tr>
    <?php } while ($row_mensual = mysql_fetch_assoc($mensual)); ?>
</table>

sumatoriasem = <?php echo $row_sumatoriames['suma']?>

                    
				</div>
			</section>
		</div>
     



<?php

mysql_free_result($Diario);
mysql_free_result($Semanal);
mysql_free_result($mensual);

}
require_once('footer.php');
?>
