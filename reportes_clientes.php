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

if ($_SESSION['tipo'] === '1') {
?>



			<section class="row">
				<div class="center">
				  <h1></h1>
					<strong class="subHeading">Reporte Clientes en deuda</strong>
        <?php 
		
		
date_default_timezone_set("America/Bogota");
		
		$hoy = date('Y-m-d');
	//	echo $hoy;
		//WHERE fecha_llegada = '$hoy'
		
mysql_select_db($database_conexion, $conexion);
$query_Recordset1 = "SELECT * FROM pagos ";
$Recordset1 = mysql_query($query_Recordset1, $conexion) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

		
?>
        <table border="1" cellpadding="1" cellspacing="1"  >
          <tr>
            <td>id</td>
            <td>Cedula</td>
            <td>fecha Pago</td>
            <td>fecha Vencimiento</td>
            <td>hora Pago</td>
            <td>tiempo</td>
            <td>usuario Pago</td>
          </tr>
          <?php 
		  
		  	$rangodias = 5;
		  
		   echo $hoy, '<br>'  ;		   
		   echo 'mas dias', $masdias = date("Y-m-d", strtotime("$hoy +$rangodias day")), '<br>';
		   echo 'menos dias',$menosdias = date("Y-m-d", strtotime("$hoy -$rangodias day")), '<br>';
		   
		   
		   do { 
		  
		if ($row_Recordset1['fecha_vencimiento'] >= $menosdias AND $row_Recordset1['fecha_vencimiento']  <= $masdias )
				
		{
  			$colorcelda = '#FFC0CB';
		}
		else 
		{
			$colorcelda = '#E0FFFF';
		}
		  
	//	  echo $colorcelda;
		  
		  ?>
          
          
            <tr>
              <td bgcolor='<?php echo $colorcelda?>'><?php echo $row_Recordset1['id']; ?></td>
              <td bgcolor='<?php echo $colorcelda?>'><?php echo $row_Recordset1['cedula']; ?></td>
              <td bgcolor='<?php echo $colorcelda?>'><?php echo $row_Recordset1['fecha_pago']; ?></td>
              <td bgcolor='<?php echo $colorcelda?>'><?php echo $row_Recordset1['fecha_vencimiento']; ?></td>
              <td bgcolor='<?php echo $colorcelda?>'><?php echo $row_Recordset1['hora_pago']; ?></td>
              <td bgcolor='<?php echo $colorcelda?>'><?php echo $row_Recordset1['tiempo']; ?></td>
              <td bgcolor='<?php echo $colorcelda?>'><?php echo $row_Recordset1['usuario_pago']; ?></td>
            </tr>
            <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
        </table>
                </div>
			</section>
		</div>
     



<?php


mysql_free_result($Recordset1);
}
require_once('footer.php');

?>
