<?php 
//	include_once '../../bin/head.php'; 

	$query = "
		SELECT
			FORMAT(fecha_estatus, 'yyyy-MM-dd') AS [Fecha]
			,COUNT(CASE WHEN estatus = 'BAJA DEL SERVICIO (SAC)' THEN 1 ELSE NULL END) AS [Baja(SAC)]
			,COUNT(CASE WHEN estatus = 'BAJA DEL SERVICIO (SPONSOR)' THEN 1 ELSE NULL END) AS [Baja(SPONSOR)]
			,COUNT(CASE WHEN estatus = 'CONTRACARGO' THEN 1 ELSE NULL END) AS [Contracargo]
			,COUNT(CASE WHEN estatus = 'REINTEGRO' THEN 1 ELSE NULL END) AS [Reintegro]
			,COUNT(CASE WHEN estatus = 'TDC CANCELADA' THEN 1 ELSE NULL END) AS [TDC Cancelada]
			,COUNT(CASE WHEN estatus = 'INTENTOS' THEN 1 ELSE NULL END) AS [Intentos]
			,COUNT(CASE WHEN estatus = 'RESERVAR' THEN 1 ELSE NULL END) AS [Reservar]
		   ,COUNT(id)							AS [Total]
		FROM tmk.dbo.afiliados
		WHERE estatus IS NOT NULL
		AND fecha_estatus BETWEEN CONVERT(DATE, DATEADD(d, -( DAY(DATEADD(m, -2, GETDATE() -1)) ), DATEADD(m, -2, GETDATE()))) AND GETDATE()
		GROUP BY FORMAT(fecha_estatus, 'yyyy-MM-dd')
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
	$datasets_baja_sac = '';
	$datasets_baja_sponsor = '';
	$datasets_contracargo = '';
	$datasets_reintegro = '';
	$datasets_tdc_cancelada = '';
	$datasets_intentos = '';
	$datasets_reservar = '';
	$datasets_total = '';
	$periods = '';
	while ($rst = sqlsrv_fetch_array($obj_rst, SQLSRV_FETCH_ASSOC)) {
			$graph_field_name = $graph_field_name.'"'.$rst['Fecha'].'",';
			$datasets_baja_sac = $datasets_baja_sac.'"'.$rst['Baja(SAC)'].'",';
			$datasets_baja_sponsor = $datasets_baja_sponsor.'"'.$rst['Baja(SPONSOR)'].'",';
			$datasets_contracargo = $datasets_contracargo.'"'.$rst['Contracargo'].'",';
			$datasets_reintegro = $datasets_reintegro.'"'.$rst['Reintegro'].'",';
			$datasets_tdc_cancelada = $datasets_tdc_cancelada.'"'.$rst['TDC Cancelada'].'",';
			$datasets_intentos = $datasets_intentos.'"'.$rst['Intentos'].'",';
			$datasets_reservar = $datasets_reservar.'"'.$rst['Reservar'].'",';
		}

?>

				<div style="height: 30vh; width: 100%">
					<canvas id="bajas_graph_acumulado_diario"></canvas>
				</div>
				<script type="text/javascript">
					new Chart(document.getElementById("bajas_graph_acumulado_diario"), {
						type: 'bar',
						data: {
							labels: [<?php echo $graph_field_name; ?>],
							datasets: [
								{
									label: "Baja(SAC)",
									fill: true,
									data: [<?php echo $datasets_baja_sac; ?>],
									backgroundColor: <?php echo "'".$red_rgb_4."'"; ?>,
								},{
									label: "Baja(SPONSOR)",
									fill: true,
									data: [<?php echo $datasets_baja_sponsor; ?>],
									backgroundColor: <?php echo "'".$red_rgb_7."'"; ?>,
								},{
									label: "Contracargo ",
									fill: true,
									data: [<?php echo $datasets_contracargo; ?>],
									backgroundColor: <?php echo "'".$red_rgb_5."'"; ?>,
								},{
									label: "Reintegro",
									fill: true,
									data: [<?php echo $datasets_reintegro; ?>],
									backgroundColor: <?php echo "'".$red_rgb_4."'"; ?>,
								},{
									label: "TDC Cancelada",
									fill: true,
									data: [<?php echo $datasets_tdc_cancelada; ?>],
									backgroundColor: <?php echo "'".$red_rgb_2."'"; ?>,
								},{
									label: "Intentos",
									fill: true,
									data: [<?php echo $datasets_intentos; ?>],
									backgroundColor: <?php echo "'".$red_rgb_1."'"; ?>,
								},{
									label: "Reservar",
									fill: true,
									data: [<?php echo $datasets_reservar; ?>],
									backgroundColor: <?php echo "'".$grey_rgb_5."'"; ?>,
								},
								]
						},
						options: {
							title: {
								display: false,
								text: 'Registro diario'
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
									fontSize: 8,
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