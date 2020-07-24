<?php 
	include_once '../../bin/head.php'; 
?>
	<body>

		<header>
<?php 
	pageNavHead('Banorte - Recurrencia');
	include_once '../../bin/menu.php';
?>

		</header>

		<main>

<?php 
	//include_once '../../bin/sections/banorte_card_counters.php';
?>

			<div class="section container row">
				<h4>Resumen</h4>
				<?php include_once 'recurrencia_resume.php'; ?>
			</div>
			<div class="section container row">
				<h4>Acumulado</h4>
				<div class="col l12 m12 s12">
					<div class="col l9 m7 s12">
						<?php include_once 'recurrencia_graph_acumulado_mensual.php'; ?>
					</div>
					<div class="col l3 m5 s12">					
						<?php include_once 'recurrencia_graph_criterio_mensual.php'; ?>
					</div>
				</div>
            </div>
            <div class="section container row">
				<h4>Registro diario y proporción</h4>
				<div class="col l12 m12 s12">
					<div class="col l9 m7 s12">
						<?php include_once 'recurrencia_graph_acumulado_diario.php'; ?>
					</div>
					<div class="col l3 m5 s12">					
						<?php include_once 'recurrencia_graph_criterio_diario.php'; ?>
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