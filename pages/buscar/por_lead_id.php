<?php 
	include_once '../../bin/head.php';
?>

	<body>
		
		<header>
<?php 
	pageNavHead('Banorte - Buscar por Lead ID');
	include_once '../../bin/menu.php';
?>

		</header>
		
		<main>

<?php 
		formToSearchByLeadId('');
?>
		
		</main>

<?php 
	include_once '../../bin/footer.php';	
	include_once '../../bin/jquery.php';
?>

	</body>
</html>