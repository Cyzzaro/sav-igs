<?php
include_once '../../bin/head.php';
?>

<body>

	<header>
		<?php
		pageNavHead('Grupo IAMSA - Viajes reportados VIVA AEROBUS');
		include_once '../../bin/menu.php';
		?>

	</header>

	<main>

		<div class="container section col">
			<div class="section row">
				<h5>Indicadores</h5>

				<?php

				echo
				generalCardCounter( // VIVA AEROBUS General
					'l3 m4 s12',
					'blue-grey',
					'Total viajes acumulados',
					'airplanemode_active',
					getUniqueCountValueFromDB($count_viva_aerobus_actual, "Cuantos"),
					getUniqueCountValueFromDB($count_viva_aerobus_anterior, "Cuantos"),
					getUniqueCountValueFromDB($count_viva_aerobus_acumulado, "Cuantos"),
					$graph_viva_aerobus_acumulado,
					'Fecha',
					'Total'
				)
				.
					generalCardCounter( // VIVA AEROBUS General
						'l3 m4 s12',
						'blue-grey lighten-1',
						'Vigente Apolo',
						'looks',
						'',
						'',
						getUniqueCountValueFromDB($count_vigente_viva_aerobus, "Cuantos"),
						'',/*$graph_iamsa_acumulado,*/
						'Fecha',
						'Total'
					)
				?>

			</div>
			<div class="section row">
				<h5>Registro en los ultimos 60 dias</h5>
				<div class="col l12 m12 s12"><?php include_once 'viva_aerobus_graph_diario.php'; ?></div>
			</div>
			<div class="section row">
				<h5>Resumen</h5>
				<?php include_once 'viva_aerobus_tables.php'; ?>
			</div>
		</div>
	</main>

	<?php
	include_once '../../bin/footer.php';
	include_once '../../bin/jquery.php';
	?>

</body>

</html>