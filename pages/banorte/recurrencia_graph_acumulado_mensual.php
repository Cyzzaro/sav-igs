<?php 
//	include_once '../../bin/head.php'; 

	$query = "
		SELECT
			FORMAT(fecha_procesado, 'yyyy-MM') AS [Fecha]
		   ,COUNT(CASE
				WHEN evento = '00 VENTAS' THEN 1
				WHEN evento = '01 VENTAS' THEN 1
				ELSE NULL
			END)								  AS [Exitoso]
		   ,COUNT(CASE
				WHEN evento = '51 FONDOS INSUFICIENTES' THEN 1
				WHEN evento = '05 RECHAZADA' THEN 1
				WHEN evento = 'T5 RECHAZAR' THEN 1
				WHEN evento = '87 RECHAZADA' THEN 1
				WHEN evento = 'N0 TRANSACCION NO PERMITIDA AL TARJETAHABIENTE' THEN 1
				ELSE NULL
			END)								  AS [Retry]
		   ,COUNT(CASE
				WHEN evento = '62 TARJETA RESTRINGIDA' THEN 1
				WHEN evento = '57 TRANSACCION NO PERMITIDA AL TARJETAHABIENTE' THEN 1
				WHEN evento = '01 LLAMAR AL BANCO EMISOR' THEN 1
				WHEN evento = 'O6 RECHAZADA' THEN 1
				ELSE NULL
			END)								  AS [Soft]
		   ,COUNT(CASE
				WHEN evento = '41 TARJETA EXTRAVIADA' THEN 1
				WHEN evento = 'N7 RECHAZADA' THEN 1
				ELSE NULL
			END)								  AS [Hard]
		   ,COUNT(id)							  AS [Procesado]
		FROM tmk.dbo.procesados
		GROUP BY FORMAT(fecha_procesado, 'yyyy-MM')
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
	$datasets_exitoso = '';
	$datasets_retry = '';
	$datasets_soft = '';
	$datasets_hard = '';
	$periods = '';
	while ($rst = sqlsrv_fetch_array($obj_rst, SQLSRV_FETCH_ASSOC)) {
			$graph_field_name = $graph_field_name.'"'.$rst['Fecha'].'",';
			$datasets_exitoso = $datasets_exitoso.'"'.$rst['Exitoso'].'",';
			$datasets_retry = $datasets_retry.'"'.$rst['Retry'].'",';
			$datasets_soft = $datasets_soft.'"'.$rst['Soft'].'",';
			$datasets_hard = $datasets_hard.'"'.$rst['Hard'].'",';
		}

?>

				<div style="height: 30vh; width: 100%">
					<canvas id="recurrencia_graph_acumulado_mensual"></canvas>
				</div>
				<script type="text/javascript">
					new Chart(document.getElementById("recurrencia_graph_acumulado_mensual"), {
						type: 'bar',
						data: {
							labels: [<?php echo $graph_field_name; ?>],
							datasets: [
								{
									label: "Exitoso",
									fill: true,
									data: [<?php echo $datasets_exitoso; ?>],
									backgroundColor: <?php echo "'".$green_rgb_5."'"; ?>,
								},{
									label: "Retry ",
									fill: true,
									data: [<?php echo $datasets_retry; ?>],
									backgroundColor: <?php echo "'".$blue_rgb_5."'"; ?>,
								},{
									label: "Soft",
									fill: true,
									data: [<?php echo $datasets_soft; ?>],
									backgroundColor: <?php echo "'".$amber_rgb_5."'"; ?>,
								},{
									label: "Hard",
									fill: true,
									data: [<?php echo $datasets_hard; ?>],
									backgroundColor: <?php echo "'".$red_rgb_5."'"; ?>,
								},
								]
						},
						options: {
							title: {
								display: false,
								text: 'Registro historico'
							},
							responsive: true,
							maintainAspectRatio: false,
							tooltips: {
								mode: 'index',
								intersect: true,
							},						
							legend: {
								display: true,
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
							scales: {
								xAxes: [{
									display: true,
									stacked: true,
									gridLines: { display: false },
								}],
								yAxes: [{
									display: true,
									stacked: true,
									gridLines: { display: true },
								}],
							}						
						}
					});	
				</script>	
<?php 
//	include_once '../../bin/jquery.php';
?>