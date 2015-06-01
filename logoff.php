<?php
session_start();
$id = $_SESSION['id'];
if (isset($_SESSION['id'])) {
	$_SESSION = array();

	if (isset($_COOKIE[session_name()])) {
	      setcookie(session_name(), '', time() - 3600);
		}

	session_destroy();
}


setcookie('id', '', time() - 3600);
setcookie('nombres', '', time() - 3600);
setcookie('login', '', time() - 3600);
$homeurl = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php';
header('Location: ' . $homeurl);
?>

