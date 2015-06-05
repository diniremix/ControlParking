<?php


if (!isset($_SESSION['id'])) {

?>

<?php
}

if ($_SESSION['tipo'] === '1') {

?>
				<nav id="mainNav">
					<ul>
						<li class="active">
                        <li><a href="index.php"><span>Inicio</span></a></li>
						<li><a href="nuevo_usuario.php"><span>Nuevo usuario</span></a></li>
						<!-- <li><a href="reportes_clientes.php"><span>Reportes clientes</span></a></li> -->
						<li><a href="reportes_usuariosa.php"><span>Reportes por usuarios</span></a></li>
						<li><a href="reportes_ingresos.php"><span>Reportes de ingresos por fecha</span></a></li>
						<li><a href="logoff.php"><span>Salir</span></a></li>
                        <font Arial, Helvetica, sans-serif color="#A4A4A4"><?php echo $_SESSION['nombres']; ?> </font>	
                        
					</ul>
				</nav>
			</div>
<?php
}

if ($_SESSION['tipo'] === '2') {

?>
				<nav id="mainNav">
					<ul>
						<li class="active">
                        <li><a href="index.php"><span>Inicio</span></a></li>
						<li><a href="ingreso_vehiculo.php"><span>Ingreso de veh&iacute;culos</span></a></li>
						<li><a href="salida_vehiculo.php"><span>Salida de veh&iacute;culos </span></a></li>
						<!-- <li><a href="ingreso_cliente.php"><span>Nuevo cliente</span></a></li>
						<li><a href="vehiculo_mensualidad.php"><span>Mensualidad</span></a></li>
						<li><a href="reportes_usuarios.php"><span>Salir</span></a></li> -->
						<li><a href="reportes_usuarios.php"><span>Reporte Diario</span></a></li>
						<li><a href="logoff.php"><span>Salir</span></a></li>
                        <font Arial, Helvetica, sans-serif color="#A4A4A4"><?php echo $_SESSION['nombres']; ?> </font>	
                        
					</ul>
				</nav>
			</div>
<?php
}

?>
