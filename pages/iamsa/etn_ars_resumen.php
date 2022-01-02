<?php
include_once '../../bin/head.php';
?>

<body>

	<header>
		<?php
		pageNavHead('Grupo IAMSA - Viajes reportados ETN/ARS');
		include_once '../../bin/menu.php';
		?>

	</header>

	<main>

		<div class="container section col">
			<div class="section row">
				<h5>Indicadores</h5>

				<?php

				echo
				generalCardCounter( // IAMSA General
					'l3 m4 s12',
					'blue-grey',
					'Total viajes en el mes',
					'directions_bus',
					getUniqueCountValueFromDB($count_iamsa_acumulado, "Cuantos"),
					getUniqueCountValueFromDB($count_iamsa_anterior, "Cuantos"),
					getUniqueCountValueFromDB($count_iamsa_actual, "Cuantos"),
					'',/*$graph_iamsa_acumulado,*/
					'Fecha',
					'Total'
				)
					.
					generalCardCounter( // IAMSA ETN
						'l3 m4 s6',
						'blue-grey lighten-3',
						'Viajes ETN',
						'directions_bus',
						getUniqueCountValueFromDB($count_iamsa_etn_acumulado, "Cuantos"),
						getUniqueCountValueFromDB($count_iamsa_etn_anterior, "Cuantos"),
						getUniqueCountValueFromDB($count_iamsa_etn_actual, "Cuantos"),
						'',
						'',
						''
					)
					.
					generalCardCounter( // IAMSA AERS
						'l3 m4 s6',
						'blue-grey lighten-3',
						'Viajes AERS',
						'directions_bus',
						getUniqueCountValueFromDB($count_iamsa_aers_acumulado, "Cuantos"),
						getUniqueCountValueFromDB($count_iamsa_aers_anterior, "Cuantos"),
						getUniqueCountValueFromDB($count_iamsa_aers_actual, "Cuantos"),
						'',
						'',
						''
					)
					.
					generalCardCounter( // IAMSA vigente ETN
						'l3 m4 s6',
						'blue-grey lighten-1',
						'Vigente Apolo',
						'looks',
						'0',
						'0',
						getUniqueCountValueFromDB($count_vigente_etn_aers, "Cuantos"),
						'',
						'',
						''
					);

				?>

			</div>
			<div class="section row">
				<h5>Registro diario y proporción</h5>
				<div class="col l12 m12 s12"><?php include_once 'etn_ars_graph_diario.php'; ?></div>
			</div>
			<div class="section row">
				<h5>Resumen</h5>
				<?php include_once 'etn_ars_tables.php'; ?>
			</div>
		</div>
	</main>

	<?php
	include_once '../../bin/footer.php';
	include_once '../../bin/jquery.php';
	?>

</body>

</html>