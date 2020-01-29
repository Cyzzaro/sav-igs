
<?php 

	include_once '../../bin/generalHead.php';

?>

	<body>
		
		<header>
<?php 
	
	navHead('Buscar afiliado');
	include_once '../../bin/generalMenu.php';

?>

		</header>
		
		<main>

<?php 
		formSearchByName('');
?>
		
		</main>

<?php 
	
	include_once '../../bin/generalFooter.php';	
	include_once '../../bin/generaljQuery.php';

?>

	</body>
</html>