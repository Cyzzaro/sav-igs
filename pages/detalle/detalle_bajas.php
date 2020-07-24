<?php 
	include_once '../../bin/head.php'; 
?>
	<body>

		<header>
<?php 
	pageNavHead('Banorte - Consulta de detalles');
	include_once '../../bin/menu.php';
?>

		</header>

		<main>

<?php 
	echo '<div class="row">&nbsp;</div>';
	include_once 'detalle_bajas_res.php'; 
?>
			
		</main>

<?php 
	include_once '../../bin/footer.php';	
	include_once '../../bin/jquery.php';
?>

	</body>
</html>