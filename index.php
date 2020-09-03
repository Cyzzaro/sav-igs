<?php include_once 'bin/head.php'; ?>

<body>

	<header>

		<?php 
	pageNavHead('Portal de consulta y validación de capitas Banorte');
	include_once 'bin/menu.php';
?>

	</header>

	<main>

		<div class="section">
			<div class="row center">
				<div class="col l12 m12 s12">
					<?php 
						include_once 'bin/sections/banorte_card_counters.php';
					?>
				</div>
			</div>

			
		</div>

	</main>

	<?php 
	include_once 'bin/footer.php';	
	include_once 'bin/jquery.php';
?>

</body>

</html>