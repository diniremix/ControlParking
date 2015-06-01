<!DOCTYPE html>
<html>
<head>
	<title>ControlParking</title>
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
error_reporting(7);
require_once('pagewidth.php');

?>

			<section id="contactUs" class="row grey">
				<div class="center">
					<h2>ControlParking</h2>
					<h2>Sistema Administrador de Parqueaderos</h2>
					<h2>Ingresar al sistema</h2>
					<div class="columns">
						<div class="half">
                        
							<form action="validate.php" method="post" class="form">
								<fieldset>
									<div class="formRow">
										<div class="textField"><input type="text" id="login" name="login" placeholder="Usuario" /></div>	
									</div>
									<div class="formRow">
										<div class="textField"><input type="password" id="password" name="password" placeholder="Contraseña" /></div>
									</div>
                                    
									<div class="formRow">
										<button class="btnSmall btn submit right">
											<span>Ingresar</span>
										</button>
									</div>
								</fieldset>
							</form>
						</div>
					</div>
				</div>
			</section>
		</div>

<?php
require_once('footer.php');
?>
