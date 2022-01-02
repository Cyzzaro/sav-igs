<?php 

	$query = $graph_iamsa_diario;

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
			
			$graph_field_name = $graph_field_name.'"'.$rst['Fecha'].'",';
			$datasets_etn = $datasets_etn.'"'.$rst['ETN'].'",';
			$datasets_aers = $datasets_aers.'"'.$rst['AERS'].'",';
			
		}

?>

                        <div style="height: 35vh; width: 100%">
                            <canvas id="graph_acumulado_diario"></canvas>
                        </div>
                        <script type="text/javascript">
                            new Chart(document.getElementById("graph_acumulado_diario"), {
                                type: 'bar',
                                data: {
                                    labels: [<?php echo $graph_field_name; ?>],
                                    datasets: [
                                        {
                                            label: "ETN Turistar",
                                            fill: true,
                                            data: [<?php echo $datasets_etn; ?>],
                                            borderColor: <?php echo "'".$white_rgb_1."'"; ?>,
                                            backgroundColor: <?php echo "'".$indigo_rgb_3."'"; ?>,
                                        },{
                                            label: "Estrella Roja",
                                            fill: true,
                                            data: [<?php echo $datasets_aers; ?>],
                                            borderColor: <?php echo "'".$white_rgb_1."'"; ?>,
                                            backgroundColor: <?php echo "'".$red_rgb_3."'"; ?>,
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
                                            gridLines: { display: false },
                                        }],
                                    }						
                                }
                            });	
                        </script>	
