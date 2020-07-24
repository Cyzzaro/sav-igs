<?php 
//	include_once '../../bin/head.php'; 

	$query = "
		SELECT
			'General' AS [Fecha]
		   ,COUNT(CASE
				WHEN estatus = 'CANCELADO' THEN 1
				ELSE NULL
			END)								AS [Cancelado]
		   ,COUNT(CASE
				WHEN estatus = 'CONTRACARGO' THEN 1
				ELSE NULL
			END)								AS [Contracargo]
		   ,COUNT(CASE
				WHEN estatus = 'REINTEGRO' THEN 1
				ELSE NULL
			END)								AS [Reintegro]
		   ,COUNT(CASE
				WHEN estatus = 'TDC CANCELADA' THEN 1
				ELSE NULL
			END)								AS [TDC Cancelada]
		   ,COUNT(CASE
				WHEN estatus = 'INTENTOS' THEN 1
				ELSE NULL
			END)								AS [Intentos]
			,COUNT(CASE
				WHEN estatus = 'RESERVAR' THEN 1
				ELSE NULL
			END)								AS [Reservar]
		   ,COUNT(id)							AS [Total]
		FROM tmk.dbo.afiliados
		WHERE estatus IS NOT NULL
		AND fecha_estatus BETWEEN CONVERT(DATE, DATEADD(d, -( DAY(DATEADD(m, -2, GETDATE() -1)) ), DATEADD(m, -2, GETDATE()))) AND GETDATE()
		ORDER BY [Fecha] ASC
		";

	$obj_conn_params_SQLSERVER = array('Database' => COBRANZABD, 'Uid' => COBRANZAUSER, 'PWD' => COBRANZAPWD);
	$obj_conn_SQLSERVER = sqlsrv_connect(COBRANZASRVR, $obj_conn_params_SQLSERVER);
		
	$obj_rst_aditional_params_SQLSERVER = array();
	$obj_rst_optionals_SQLSERVER = array('Scrollable'=>SQLSRV_CURSOR_KEYSET);	
	
	$obj_rst = sqlsrv_query($obj_conn_SQLSERVER, $query, $obj_rst_aditional_params_SQLSERVER, $obj_rst_optionals_SQLSERVER);

	if ($obj_rst == FALSE)
		die(errorConnSQLSRVR(sqlsrv_errors()));

	$graph_field_name = '';
	$datasets_cancelado = '';
	$datasets_contracargo = '';
	$datasets_reintegro = '';
	$datasets_tdc_cancelada = '';
	$datasets_intentos = '';
	$datasets_reservar = '';
	$datasets_total = '';
	$periods = '';
	while ($rst = sqlsrv_fetch_array($obj_rst, SQLSRV_FETCH_ASSOC)) {
			$graph_field_name = $graph_field_name.'"'.$rst['Fecha'].'",';
			$datasets_cancelado = '"'.$rst['Cancelado'].'",';
			$datasets_contracargo = '"'.$rst['Contracargo'].'",';
			$datasets_reintegro = '"'.$rst['Reintegro'].'",';
			$datasets_tdc_cancelada = '"'.$rst['TDC Cancelada'].'",';
			$datasets_intentos = '"'.$rst['Intentos'].'",';
			$datasets_reservar = '"'.$rst['Reservar'].'",';
			
			$periods = $periods . '
								{
									label: '.$graph_field_name.'
									data: ['.$datasets_cancelado.$datasets_contracargo.$datasets_reintegro.$datasets_tdc_cancelada.$datasets_intentos.$datasets_reservar.'],
									backgroundColor: ['."'".$red_rgb_7."','".$red_rgb_5."','".$red_rgb_4."','".$red_rgb_2."','".$red_rgb_1."','".$grey_rgb_5."'".'],
								},
			';
			
		}

?>

				<div style="height: 25vh; width: 100%">
					<canvas id="bajas_graph_criterio_diario"></canvas>
				</div>
				<script type="text/javascript">
					new Chart(document.getElementById("bajas_graph_criterio_diario"), {
						type: 'doughnut',
						data: {
							labels: ['Cancelado','Contracargo','Reintegro','TDC Cancelada','Intentos','Reservar'],
							datasets: [
								<?php echo $periods; ?>
							]
						},
						options: {
							title: {
								display: false,
								text: 'Proporcion del diario'
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
