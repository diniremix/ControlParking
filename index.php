<?php
session_start();
error_reporting(7);
if (!isset($_SESSION['id'])) {
require_once('header.php');
require_once('pagewidth.php');

require_once('footer.php');
?>
				<nav id="mainNav">
					<ul>
						<li class="active">
                        <li><a href="index.php"><span>Inicio</span></a></li>
						<li><a href="login.php"><span>Ingresar</span></a></li>
                        <font Arial, Helvetica, sans-serif color="#A4A4A4">Sin iniciar sesi&oacute;n </font>	
                        
					</ul>
				</nav>
			</div>
<?php
}
if ($_SESSION['tipo'] === '2') {
require_once('header.php');
require_once('pagewidth.php');
require_once('ingreso_vehiculo.php');
require_once('footer.php');
}
if ($_SESSION['tipo'] === '1') {
require_once('header.php');
require_once('pagewidth.php');
require_once('reportes_ingresos.php');
require_once('footer.php');
}
?>
