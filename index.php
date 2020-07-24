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

			<div class="row section">

				<ul class="collapsible popout" data-collapsible="expandable">
					<li>
						<div class="collapsible-header"><i class="material-icons">credit_card</i>Recurrencia</div>
						<div class="collapsible-body">
							<br><br>
							<div class="col l12 m12 s12">
								<div class="col l10 m7 s12">
									<?php include_once 'pages/banorte/recurrencia_graph_acumulado_mensual.php'; ?>
								</div>
								<div class="col l2 m5 s12">
									<?php include_once 'pages/banorte/recurrencia_graph_criterio_mensual.php'; ?>
								</div>
								<div class="col l10 m7 s12">
									<?php include_once 'pages/banorte/recurrencia_graph_acumulado_diario.php'; ?>
								</div>
								<div class="col l2 m5 s12">
									<?php include_once 'pages/banorte/recurrencia_graph_criterio_diario.php'; ?>
								</div>
								<div class="col l12 m12 s12 center">
									<?php include_once 'pages/banorte/recurrencia_resume.php'; ?>
								</div>
							</div>
							<br><br>
						</div>
					</li>					
					<li>
						<div class="collapsible-header"><i class="material-icons">face</i>Afiliados</div>
						<div class="collapsible-body">
							<br><br>
							<div class="col l12 m12 s12">
								<div class="col l10 m7 s12">
									<?php include_once 'pages/banorte/afiliados_graph_acumulado_mensual.php'; ?>
								</div>
								<div class="col l2 m5 s12">
									<?php include_once 'pages/banorte/afiliados_graph_criterio_mensual.php'; ?>
								</div>
								<div class="col l10 m7 s12">
									<?php include_once 'pages/banorte/afiliados_graph_acumulado_diario.php'; ?>
								</div>
								<div class="col l2 m5 s12">
									<?php include_once 'pages/banorte/afiliados_graph_criterio_diario.php'; ?>
								</div>
								<div class="col l12 m12 s12 center">
									<?php include_once 'pages/banorte/afiliados_resume.php'; ?>
								</div>
							</div>
							<br><br>
						</div>
					</li>
					<li>
						<div class="collapsible-header"><i class="material-icons">trending_down</i>Bajas</div>
						<div class="collapsible-body">
							<br><br>
							<div class="col l12 m12 s12">
								<div class="col l10 m7 s12">
									<?php include_once 'pages/banorte/bajas_graph_acumulado_mensual.php'; ?>
								</div>
								<div class="col l2 m5 s12">
									<?php include_once 'pages/banorte/bajas_graph_criterio_mensual.php'; ?>
								</div>
								<div class="col l10 m7 s12">
									<?php include_once 'pages/banorte/bajas_graph_acumulado_diario.php'; ?>
								</div>
								<div class="col l2 m5 s12">
									<?php include_once 'pages/banorte/bajas_graph_criterio_diario.php'; ?>
								</div>
								<div class="col l12 m12 s12 center">
									<?php include_once 'pages/banorte/bajas_resume.php'; ?>
								</div>
							</div>
							<br><br>
						</div>
					</li>
				</ul>
			</div>
		</div>

	</main>

	<?php 
	include_once 'bin/footer.php';	
	include_once 'bin/jquery.php';
?>

</body>

</html>