<?php 
//	include_once '../../bin/head.php'; 

	$query = "
		SELECT
			FORMAT(fecha_venta, 'yyyy-MM-dd') AS [Fecha]
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
		WHERE fecha_venta BETWEEN CONVERT(DATE, DATEADD(d, -( DAY(DATEADD(m, -2, GETDATE() -1)) ), DATEADD(m, -2, GETDATE()))) AND GETDATE()
		GROUP BY FORMAT(fecha_venta, 'yyyy-MM-dd')
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
		}

?>

						<div style="height: 30vh; width: 100%">
							<canvas id="afiliados_graph_acumulado_diario"></canvas>
						</div>
						<script type="text/javascript">
							new Chart(document.getElementById("afiliados_graph_acumulado_diario"), {
								type: 'bar',
								data: {
									labels: [<?php echo $graph_field_name; ?>],
									datasets: [
										{
											label: "Prevalidaciones",
											fill: true,
											data: [<?php echo $datasets_prevalidaciones; ?>],
											backgroundColor: <?php echo "'".$blue_rgb_7."'"; ?>,
										},{
											label: "Otros canales ",
											fill: true,
											data: [<?php echo $datasets_otros_canales; ?>],
											backgroundColor: <?php echo "'".$blue_rgb_5."'"; ?>,
										},{
											label: "Inbound",
											fill: true,
											data: [<?php echo $datasets_inbound; ?>],
											backgroundColor: <?php echo "'".$blue_rgb_3."'"; ?>,
										},{
											label: "Reactivacion",
											fill: true,
											data: [<?php echo $datasets_reactivacion; ?>],
											backgroundColor: <?php echo "'".$blue_rgb_1."'"; ?>,
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