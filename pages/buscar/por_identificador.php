<?php 
	include_once '../../bin/head.php';
?>

	<body>
		
		<header>
<?php 
	pageNavHead('Banorte - Buscar por Identificador');
	include_once '../../bin/menu.php';
?>

		</header>
		
		<main>

<?php 
		formToSearchByIdentificador('');
?>
		
		</main>

<?php 
	include_once '../../bin/footer.php';	
	include_once '../../bin/jquery.php';
?>

	</body>
</html>