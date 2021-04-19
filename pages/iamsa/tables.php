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

				$Cliente = $rst['Cliente'];
 				$Anio = $rst['Anio'];
 				$Ene = number_format($rst['Ene']);
 				$Feb = number_format($rst['Feb']);
 				$Mar = number_format($rst['Mar']);
 				$Abr = number_format($rst['Abr']);
 				$May = number_format($rst['May']);
 				$Jun = number_format($rst['Jun']);
 				$Jul = number_format($rst['Jul']);
 				$Ago = number_format($rst['Ago']);
 				$Sep = number_format($rst['Sep']);
 				$Oct = number_format($rst['Oct']);
 				$Nov = number_format($rst['Nov']);
 				$Dic = number_format($rst['Dic']);
 				$Total = number_format($rst['Total']);

				
				

//				if ($fecha == 'Total') {
//					
//					$totals = ' class="'.activePagePrimaryColor().' white-text"';
//					
//				} else {
//					
					$totals = '';
//					
//				}
			
				echo '

										<tr'.$totals. '>
											<td>' . $Cliente . '</td>
											<td>' . $Anio . '</td>
											<td>' . $Ene . '</td>
											<td>' . $Feb . '</td>
											<td>' . $Mar . '</td>
											<td>' . $Abr . '</td>
											<td>' . $May . '</td>
											<td>' . $Jun . '</td>
											<td>' . $Jul . '</td>
											<td>' . $Ago . '</td>
											<td>' . $Sep . '</td>
											<td>' . $Oct . '</td>
											<td>' . $Nov . '</td>
											<td>' . $Dic . '</td>
											<td>' . $Total . '</td>
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
							<div class="col l12 m8 offset-m2 s12">
								<table id="table_info" class="responsive-table hoverable bordered card centered">
									<thead class="white-text '.activePagePrimaryColor(). '">
										<tr>
											<th>Cliente</th>
											<th>Año</th>
											<th>Ene</th>
											<th>Feb</th>
											<th>Mar</th>
											<th>Abr</th>
											<th>May</th>
											<th>Jun</th>
											<th>Jul</th>
											<th>Ago</th>
											<th>Sep</th>
											<th>Oct</th>
											<th>Nov</th>
											<th>Dic</th>
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
