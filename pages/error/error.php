<?php 
	include_once '../../bin/head.php'; 
?>
	<body>

		<header>
<?php 
	pageNavHead('...no se encuentra');
	include_once '../../bin/menu.php';
?>

		</header>

		<main>

			<div class="section">
				<div class="row center">
					<h3 class="light header">¡Lo sentimos!</h3>
					<div class="col l12 m12 s12">
						<p class="caption">
							Al parecer la página a que intentas acceder 
							<strong>no existe</strong> o no se encuentra disponible
							por el momento.
						</p>
						<p>
							Te sugerimos intentar nuevamente, seleccionando un recurso valido 
							desde el panel lateral izquierdo.<br>
							Si el problema persiste, contacta al Administrador.
						</p>
					</div>
				</div>
			</div>
		
		</main>

<?php 
	include_once '../../bin/footer.php';	
	include_once '../../bin/jquery.php';
?>

	</body>
</html>