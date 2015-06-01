<?php
	session_start();

require_once('connections/conexion.php');

mysql_select_db($database_conexion, $conexion);

      $login = mysql_real_escape_string(trim($_POST['login']));
      $password = mysql_real_escape_string(trim($_POST['password']));

		$vsql = "SELECT id, login, password, nombres, tipo FROM usuarios WHERE login = '$login'";
		$vresult = mysql_query($vsql, $conexion) or die('Query failed: ' . mysql_error($conexion));

		$userdata = mysql_fetch_array($vresult);

		if ($userdata['password'] === SHA1($password)) {
			require_once('connections/conexion.php');

			$id = $_SESSION['id'] = $userdata['id'];
			$tipo = $_SESSION['tipo'] = $userdata['tipo'];
			$_SESSION['login'] = $userdata['login'];
			$_SESSION['nombres'] = $userdata['nombres'];
			setcookie('id', $userdata['id'], time() + (60 * 60 * 24));
			setcookie('tipo', $userdata['tipo'], time() + (60 * 60 * 24));
			setcookie('nombres', $userdata['nombres'], time() + (60 * 60 * 24));
			setcookie('login', $login, time() + (60 * 60 * 24));
			$date = date('Y-m-j H:i:s');
			$homeurl = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php';
			header('Location: ' . $homeurl);
		}
		else {
			$homeurl = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/login.php';
			header('Location: ' . $homeurl);
		}
?>
