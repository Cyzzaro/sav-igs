
<?php 

	include_once 'bin/generalHead.php';

?>

	<body>
		
		<header>

<?php 
	
	navHead(PAGETITLE);
	include_once 'bin/generalMenu.php';

?>

		</header>
		
		<main>

			<div class="section">
				<div class="row center">
					<h3 class="light header"><?php echo PAGEDESC; ?></h3>
					<div class="col l8 offset-l2 m10 offset-m1 s12">
						<p class="caption">Desarrollado por <?php echo AUTHORNAME; ?> para <?php echo NAMECIA; ?></p>
					</div>
				</div>
			</div>

		</main>

<?php 
	
	include_once 'bin/generalFooter.php';	
	include_once 'bin/generaljQuery.php';

?>

	</body>
</html>