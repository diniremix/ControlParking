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
  $insertSQL = sprintf("INSERT INTO usuarios (login, password, nombres, tipo) VALUES (%s, SHA1(%s), %s, %s)",
                       GetSQLValueString($_POST['login'], "text"),
                       GetSQLValueString($_POST['password'], "text"),
                       GetSQLValueString($_POST['nombres'], "text"),
                       GetSQLValueString($_POST['tipo'], "text"));

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

if ($_SESSION['tipo'] === '1') {
?>


<section class="row">
				<div class="center">
					<strong class="subHeading">Registro de nuevos usuarios</strong>
					
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="form1" id="form1">
  <table align="center" cellspacing="5" cellpadding="5">
    <tr>
      <td align="right">Usuario:</td>
      <td><input name="login" type="text" value="" size="35" maxlength="35" /></td>
    </tr>
    <tr>
      <td nowrap="nowrap" align="right">Contrase&ntilde;a:</td>
      <td><input type="text" name="password" value="" size="35" maxlength="35"/></td>
    </tr>
    <tr>
      <td nowrap="nowrap" align="center">Repite la Contrase&ntilde;a:</td>
      <td><input type="text" name="password" value="" size="35"maxlength="35" /></td>
    </tr>
    <tr>
      <td nowrap="nowrap" align="right">Nombres completos:</td>
      <td><input type="text" name="nombres" value="" size="40" maxlength="40"/></td>
    </tr>
    <tr>
      <td align="right"><strong>Tipo:</strong> </td>
      <td align="center">Administrador:   <input type="radio" name="tipo" value="1" size="2" /></td>
	  <td align="center">Usuario:			<input type="radio" name="tipo" value="2" size="2" /></td>
    </tr>
    <tr>
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><button class="btnSmall btn submit right">
											<span>Registrar</span>
										</button>
  <input type="hidden" name="MM_insert" value="form1" />
</form></td>
    </tr>
  </table>
									
										
                   
			</section>
		</div>
<?php
}

require_once('footer.php');
?>
