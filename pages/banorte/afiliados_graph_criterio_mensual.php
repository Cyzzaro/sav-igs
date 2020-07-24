<?php 
//	include_once '../../bin/head.php'; 

	$query = "
		SELECT
			'Total' AS [Fecha]
		   ,COUNT(CASE
				WHEN origen = 'PREVALIDACIONES' THEN 1
				ELSE NULL
			END)						   AS [Prevalidaciones]
		   ,COUNT(CASE
				WHEN origen = 'OTROS CANALES' THEN 1
				ELSE NULL
			END)						   AS [Otros canales]
		   ,COUNT(CASE
				WHEN origen = 'INBOUND' THEN 1
				ELSE NULL
			END)						   AS [Inbound]
		   ,COUNT(CASE
				WHEN origen = 'REACTIVACION' THEN 1
				ELSE NULL
			END)						   AS [Reactivacion]
		   ,COUNT(id)					   AS [Total]
		FROM tmk.dbo.afiliados
		ORDER BY [Fecha]
		";

	$obj_conn_params_SQLSERVER = array('Database' => COBRANZABD, 'Uid' => COBRANZAUSER, 'PWD' => COBRANZAPWD);
	$obj_conn_SQLSERVER = sqlsrv_connect(COBRANZASRVR, $obj_conn_params_SQLSERVER);
		
	$obj_rst_aditional_params_SQLSERVER = array();
	$obj_rst_optionals_SQLSERVER = array('Scrollable'=>SQLSRV_CURSOR_KEYSET);	
	
	$obj_rst = sqlsrv_query($obj_conn_SQLSERVER, $query, $obj_rst_aditional_params_SQLSERVER, $obj_rst_optionals_SQLSERVER);

	if ($obj_rst == FALSE)
		die(errorConnSQLSRVR(sqlsrv_errors()));

	$graph_field_name = '';
	$datasets_prevalidaciones = '';
	$datasets_otros_canales = '';
	$datasets_inbound = '';
	$datasets_reactivacion = '';
	$periods = '';
	while ($rst = sqlsrv_fetch_array($obj_rst, SQLSRV_FETCH_ASSOC)) {
			$graph_field_name = $graph_field_name.'"'.$rst['Fecha'].'",';
			$datasets_prevalidaciones = $datasets_prevalidaciones.'"'.$rst['Prevalidaciones'].'",';
			$datasets_otros_canales = $datasets_otros_canales.'"'.$rst['Otros canales'].'",';
			$datasets_inbound = $datasets_inbound.'"'.$rst['Inbound'].'",';
			$datasets_reactivacion = $datasets_reactivacion.'"'.$rst['Reactivacion'].'",';
			
			$periods = $periods . '
								{
									label: '.$graph_field_name.'
									data: ['.$datasets_prevalidaciones.$datasets_otros_canales.$datasets_inbound.$datasets_reactivacion.'],
									backgroundColor: ['."'".$blue_rgb_7."','".$blue_rgb_5."','".$blue_rgb_3."','".$blue_rgb_1."'".'],
								},
			';
			
		}

?>

						<div style="height: 25vh; width: 100%">
							<canvas id="afiliados_graph_criterio_mensual"></canvas>
						</div>
						<script type="text/javascript">
							new Chart(document.getElementById("afiliados_graph_criterio_mensual"), {
								type: 'doughnut',
								data: {
									labels: ['Prevalidaciones','Otros canales','Inbound','Reactivacion'],
									datasets: [
										<?php echo $periods; ?>
									]
								},
								options: {
									title: {
										display: false,
										text: 'Proporcion historica'
									},
									responsive: true,
									maintainAspectRatio: false,
									tooltips: {
										mode: 'point',
										intersect: false,
									},
									legend: {
										display: false,
										position: 'right',
										labels: {
											fontSize: 10,
										}
									},
									layout: {
										padding: {
										left: 1,	
										right: 1,
										top: 1,
										bottom: 1,
										}
									},
									//rotation: -Math.PI,
									//cutoutPercentage: 15,
									//circumference: Math.PI,	
									scales: {
										xAxes: [{
											display: false,
											stacked: true,
											gridLines: { display: false },
										}],
										yAxes: [{
											display: false,
											stacked: true,
											gridLines: { display: false },
										}],
									}						
								}
							});	
						</script>	
<?php 
//	include_once '../../bin/jquery.php';
?>