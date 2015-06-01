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

require_once('header.php');
require_once('pagewidth.php');

if ($_SESSION['tipo'] === '2') {
$login = $_SESSION[login];
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
$query_Diario = "SELECT * FROM movimientos WHERE fecha_salida = '$hoy' && usuario_salida = '$login'";
$Diario = mysql_query($query_Diario, $conexion) or die(mysql_error());
$row_Diario = mysql_fetch_assoc($Diario);
$totalRows_Diario = mysql_num_rows($Diario);

mysql_select_db($database_conexion, $conexion);
$query_sumatoria = "SELECT sum(valor_cobro) as suma from movimientos WHERE fecha_salida = '$hoy' && usuario_salida = '$login'";
$sumatoria = mysql_query($query_sumatoria, $conexion) or die(mysql_error());
$row_sumatoria = mysql_fetch_assoc($sumatoria);
$totalRows_sumatoria = mysql_num_rows($sumatoria);

?>           

<h1></h1>
<strong class="subHeading">
  Reporte Diario </br>
  <?php echo date('d/m/Y'); ?> <br /> 
  Usuario Actual: <?php echo $_SESSION['nombres']; ?>
</strong>
					
<table class="center" border="1" cellpadding="1" cellspacing="1">
  <tr>
    <td><strong>ID</strong></td>
    <td><strong>PLACA&nbsp;&nbsp;</strong></td>
    <td><strong>TIPO</strong></td>
    <td><strong>FECHA LLEGADA</strong></td>
    <td><strong>HORA LLEGADA</strong></td>
    <td><strong>FECHA SALIDA</strong></td>
    <td><strong>HORA SALIDA</strong></td>
    <td><strong>TRANSCURRIDO</strong></td>
    <td><strong>VALOR cobro</strong></td>
    <td><strong>CLIENTE</strong></td>
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


<section class="row">
  <strong>Total Dia:</strong> <?php echo "<strong>".$row_sumatoria['suma']."</strong>";?>
</section>
			</section>
		</div>
     



<?php

mysql_free_result($Diario);
}

require_once('footer.php');

?>
