<?php
error_reporting(7);
session_start();

if (!isset($_SESSION['id'])) {
	if (isset($_COOKIE['id']) && isset($_COOKIE['nombres'])) {
		$_SESSION['id'] = $_COOKIE['id'];
		$_SESSION['nombres'] = $_COOKIE['nombres'];
		$_SESSION['tipo'] = $_COOKIE['tipo'];
	}
}

if (isset($_SESSION['id'])) {

?>
<!DOCTYPE html>
<html>
<head>
	<title>Inicio</title>
	<meta charset="utf-8" />
	<meta name = "viewport" content = "width=device-width, maximum-scale = 1, minimum-scale=1" />
	<link rel="stylesheet" type="text/css" href="css/default.css" media="all" />
	<link rel="stylesheet" href="css/flexslider.css" type="text/css" />
	<link href='http://fonts.googleapis.com/css?family=PT+Sans' rel='stylesheet' type='text/css' />
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>-->
	<script src="jquery.min.js"></script>
	<script src="js/jquery.flexslider.js"></script>
	<script src="js/default.js"></script>
	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<script src="js/respond.min.js"></script>
	<![endif]-->
</head>
<body>

<?php

}

else {
			$homeurl = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/login.php';
			header('Location: ' . $homeurl);
	}
?>
