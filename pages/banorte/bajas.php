<?php 
	include_once '../../bin/head.php'; 
?>
	<body>

		<header>
<?php 
	pageNavHead('Banorte - Bajas');
	include_once '../../bin/menu.php';
?>

		</header>

		<main>

<?php 
	//include_once '../../bin/sections/banorte_card_counters.php';
?>

			<div class="section container row">
				<h4>Acumulado mensual</h4>
				<div class="col l12 m12 s12">
					<div class="col l9 m7 s12">
						<?php include_once 'bajas_graph_acumulado_mensual.php'; ?>
					</div>
					<div class="col l3 m5 s12">					
						<?php include_once 'bajas_graph_criterio_mensual.php'; ?>
					</div>
				</div>
            </div>
            <div class="section container row">
				<h4>Registro diario y proporción</h4>
				<div class="col l12 m12 s12">
					<div class="col l9 m7 s12">
						<?php include_once 'bajas_graph_acumulado_diario.php'; ?>
					</div>
					<div class="col l3 m5 s12">					
						<?php include_once 'bajas_graph_criterio_diario.php'; ?>
					</div>
				</div>
			</div>
			<div class="section container row">
				<h4>Resumen</h4>
				<?php include_once 'bajas_resume.php'; ?>
			</div>

		</main>

<?php 
	include_once '../../bin/footer.php';	
	include_once '../../bin/jquery.php';
?>

	</body>
</html>