<?php

	$query = $table_iamsa_acumulado;

	$obj_conn_params_SQLSERVER = array('Database' => COBRANZABD, 'Uid' => COBRANZAUSER, 'PWD' => COBRANZAPWD);
	$obj_conn_SQLSERVER = sqlsrv_connect(COBRANZASRVR, $obj_conn_params_SQLSERVER);
		
	$obj_rst_aditional_params_SQLSERVER = array();
	$obj_rst_optionals_SQLSERVER = array('Scrollable'=>SQLSRV_CURSOR_KEYSET);	
	
	$obj_rst = sqlsrv_query($obj_conn_SQLSERVER, $query, $obj_rst_aditional_params_SQLSERVER, $obj_rst_optionals_SQLSERVER);

	if ($obj_rst == FALSE)
		die(errorConnSQLSRVR(sqlsrv_errors()));

	$total_num_rst = sqlsrv_num_rows($obj_rst);

	if ($total_num_rst == 0) {
		
		$card_message_color_SQLSERVER = 'yellow';
		$card_message_text_color = 'black-text';
		
	} elseif ($total_num_rst > 1000) {
		
		$card_message_color_SQLSERVER = 'red';
		$card_message_text_color = 'white-text';
		
	} else {
		
		$card_message_color_SQLSERVER = 'teal';
		$card_message_text_color = 'white-text';
		
	}

	function tableRowsIAMSA(
		$client,
		$obj_rst
		) {
			
			while ($rst = sqlsrv_fetch_array($obj_rst, SQLSRV_FETCH_ASSOC)) { 

				$fecha = $rst['Fecha'];
				$ETN_15 = number_format($rst['ETN $15.00']);
				$AERS_15 = number_format($rst['AERS $15.00']);
				$AERS_10 = number_format($rst['AERS $10.00']);
				$AERS_4 = number_format($rst['AERS $4.00']);
				$OTROS = number_format($rst['OTROS']);
				$Total = number_format($rst['Total']);

				if ($fecha == 'Total') {
					
					$totals = ' class="'.activePagePrimaryColor().' white-text"';
					
				} else {
					
					$totals = '';
					
				}
			
				echo '
										<tr'.$totals.'>
											<td>'.$fecha.'</td>
											<td>'.$ETN_15.'</td>
											<td>'.$AERS_15.'</td>
											<td>'.$AERS_10.'</td>
											<td>'.$AERS_4.'</td>
											<td>'.$OTROS.'</td>
											<td>'.$Total.'</td>
										</tr>';
				}

	}

	if ($total_num_rst == 0) {
		
		withNoResults();
		
	} elseif ($total_num_rst > 0) {
		
		if ($total_num_rst < 500) {
			
			echo '
					<div class="container">
						<div class="row">
							<div class="col l8 offset-l2 m8 offset-m2 s12">
								<table id="table_info" class="responsive-table hoverable bordered card centered">
									<thead class="white-text '.activePagePrimaryColor().'">
										<tr>
											<th>Fecha</th>
											<th class="light-blue">ETN $15.00</th>
											<th class="red lighten-1">AERS $15.00</th>
											<th class="red lighten-2">AERS $10.00</th>
											<th class="red lighten-3">AERS $4.00</th>
											<th class="blue-grey lighten-3">Otros...</th>
											<th>Total</th>
										</tr>
									</thead>';	
									
			tableRowsIAMSA('IAMSA', $obj_rst);
			
			echo '
								</table>
							</div>
						</div>
					</div>
			';
			

		} else {
			
			withToMuchResults();
			
		}
	}

?>
