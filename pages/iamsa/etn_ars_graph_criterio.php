<?php 

	$query = $graph_iamsa_mensual;

	$obj_conn_params_SQLSERVER = array('Database' => COBRANZABD, 'Uid' => COBRANZAUSER, 'PWD' => COBRANZAPWD);
	$obj_conn_SQLSERVER = sqlsrv_connect(COBRANZASRVR, $obj_conn_params_SQLSERVER);
		
	$obj_rst_aditional_params_SQLSERVER = array();
	$obj_rst_optionals_SQLSERVER = array('Scrollable'=>SQLSRV_CURSOR_KEYSET);	
	
	$obj_rst = sqlsrv_query($obj_conn_SQLSERVER, $query, $obj_rst_aditional_params_SQLSERVER, $obj_rst_optionals_SQLSERVER);

	if ($obj_rst == FALSE)
		die(errorConnSQLSRVR(sqlsrv_errors()));

	$graph_field_name = '';
	$datasets_etn = '';
	$datasets_aers = '';
	$periods = '';
	
	while ($rst = sqlsrv_fetch_array($obj_rst, SQLSRV_FETCH_ASSOC)) {
			
			$labels = '"'.$rst['Fecha'].'",';
			$datasets_etn = '"'.$rst['ETN'].'",';
			$datasets_aers = '"'.$rst['AERS'].'",';
			
			$periods = $periods . '
								{
									label: '.$labels.'
									data: ['.$datasets_etn.$datasets_aers.'],
									backgroundColor: ['."'".$blue_rgb_5."','".$red_rgb_5."'".'],
								},
			';
			
		}

?>

                        <div style="height: 20vh; width: 100%">
                            <canvas id="graph_acumulado_mensual"></canvas>
                        </div>
                        <script type="text/javascript">
                            new Chart(document.getElementById("graph_acumulado_mensual"), {
                                type: 'pie',
                                data: {
                                    labels: ['ETN','AERS'],
                                    datasets: [
                                        <?php echo $periods; ?>
                                    ]
                                },
                                options: {
                                    title: {
                                        display: true,
                                        text: 'Proporcion'
                                    },
                                    responsive: true,
                                    tooltips: {
                                        mode: 'point',
                                        intersect: false,
                                    },						
                                    legend: {
                                        display: false,
                                        
                                    },
                                    rotation: -Math.PI,
                                    cutoutPercentage: 30,
                                    circumference: Math.PI,	
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
