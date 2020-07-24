<?php 
	include_once '../../bin/head.php';
?>

	<body>
		
		<header>
<?php 
	pageNavHead('Banorte - Buscar por nombre');
	include_once '../../bin/menu.php';
?>

		</header>
		
		<main>

<?php 
		formToSearchByName('');
?>
		
		</main>

<?php 
	include_once '../../bin/footer.php';	
	include_once '../../bin/jquery.php';
?>

	</body>
</html>