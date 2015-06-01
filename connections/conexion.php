<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"

//localhost
$hostname_conexion = "localhost";
$database_conexion = "parkingdb";
$username_conexion = "root";
$password_conexion = "";

//server
/*
$hostname_conexion = "";
$database_conexion = "";
$username_conexion = "";
$password_conexion = "";
*/

$conexion = mysql_pconnect($hostname_conexion, $username_conexion, $password_conexion) or trigger_error(mysql_error(),E_USER_ERROR); 
?>