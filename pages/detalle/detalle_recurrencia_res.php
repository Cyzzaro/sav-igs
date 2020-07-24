<?php

	$string_to_search = $_GET['dato'];
	$client_name = $_GET['client'];

	list($query_criteria_filter, $query_date_filter) = explode('_', $string_to_search);	

	if ($query_criteria_filter == '') {
		
		$query_criteria_filter = 'GENERAL';
		$query_criteria_filter_en_bd = " WHERE p.evento IS NOT NULL";
		
	} else {
		
		$query_criteria_filter_en_bd = " WHERE p.evento = (SELECT
					evento
				FROM tmk.dbo.catalogo_procesados
				WHERE conciso = '".$query_criteria_filter."')";
				
	}
	
	if ($query_date_filter == 'Total') {
		
		$query_date_filterFilter = "";
		
	} else {
		
		$query_date_filterFilter = " AND fecha_procesado BETWEEN '".$query_date_filter."-01' AND DATEADD(ms,-3,DATEADD(mm,0,DATEADD(mm,DATEDIFF(mm,0,'".$query_date_filter."-01')+1,0)))";
		
	}
	
	$query = "
		SELECT
			p.cliente		  AS [Cliente]
		   ,CAST(p.fecha_procesado AS VARCHAR(10)) AS [Fecha]
		   ,p.clafiltmk		  AS [Clafiltmk]
		   ,a.nombre_afiliado AS [Nombre afiliado]
		   ,p.evento		  AS [Codigo rechazo]
		   ,p.monto			  AS [Importe]
		   ,p.Autorizacion	  AS [Autorizacion]
		FROM tmk.dbo.procesados p
		INNER JOIN tmk.dbo.afiliados a
			ON a.clafiltmk = p.clafiltmk "
			.$query_criteria_filter_en_bd.$query_date_filterFilter.
			" ORDER BY p.fecha_procesado, p.clafiltmk
		";
	
	$obj_conn_params_SQLSERVER = array('Database' => COBRANZABD, 'Uid' => COBRANZAUSER, 'PWD' => COBRANZAPWD);
	$obj_conn_SQLSERVER = sqlsrv_connect(COBRANZASRVR, $obj_conn_params_SQLSERVER);

	$obj_rst_aditional_params_SQLSERVER = array();
	$obj_rst_optionals_SQLSERVER = array( "Scrollable" => SQLSRV_CURSOR_KEYSET);	

	$obj_rst = sqlsrv_query($obj_conn_SQLSERVER, $query, $obj_rst_aditional_params_SQLSERVER, $obj_rst_optionals_SQLSERVER);

	if ($obj_rst== FALSE)
		die(errorConnSQLSRVR(sqlsrv_errors()));

	$total_num_rst = sqlsrv_num_rows($obj_rst);

	if ($total_num_rst == 0) {
		
 		$message_num_rst_SQLSERVER = 'yellow';
		$message_text_color_SQLSERVER = 'black-text';
		
	} elseif ($total_num_rst > 500) {
		
		$message_num_rst_SQLSERVER = 'red';
		$message_text_color_SQLSERVER = 'white-text';
		
	} else {
		
		$message_num_rst_SQLSERVER = 'teal';
		$message_text_color_SQLSERVER = 'white-text';
		
	}

	function tableRowsRecurrencia(
		$client_name,
		$obj_rst
		) {
		
		while ($rst = sqlsrv_fetch_array($obj_rst, SQLSRV_FETCH_ASSOC)) { 
		
			$cliente = $rst['Cliente'];
			$fecha = $rst['Fecha'];
			$lead_id = $rst['Clafiltmk'];
			$nombre_afiliado = $rst['Nombre afiliado'];
			$codigo_rechazo = $rst['Codigo rechazo'];
			$importe = $rst['Importe'];
			$autorizacion = $rst['Autorizacion'];

			if ($fecha == 'Total') {
				
				$totals = '';
				
			} else {
				
				$totals = '';
				
			}
		
			echo '
								<tr'.$totals.'>
									<td>'.$cliente.'</td>
									<td>'.$fecha.'</td>
									<td>'.$lead_id.'</td>
									<td>'.$nombre_afiliado.'</td>
									<td>'.$codigo_rechazo.'</td>
									<td>'.$importe.'</td>
									<td>'.$autorizacion.'</td>
								</tr>
			';
								
		}
				
	}

	if ($total_num_rst == 0) {
		
		withNoResultsSQLSERVER();
		
	} elseif ($total_num_rst > 0) {
		
		if ($total_num_rst < 40000) {
			
			$table_results_name = str_replace(" ","_",$query_criteria_filter."_".$total_num_rst."_".$query_date_filter);
			$table_results_name_download_plugin = "'".$table_results_name."'";
			
			infoGeneralDetailTable($query_criteria_filter, $query_date_filter, $total_num_rst, $table_results_name_download_plugin);
			
			echo '
			<br>
			<div class="container">
				<div class="row">
					<div class="col l12 m12 s12">
						<table id="'.$table_results_name.'" class="hoverable card centered">
							<thead class="white-text '.activePagePrimaryColor().'">
								<tr>
									<th>Cliente</th>
									<th>Fecha</th>
									<th>Lead ID</th>
									<th>Nombre afiliado</th>
									<th>Evento</th>
									<th>Importe</th>									
									<th>Autorizacion</th>
								</tr>
							</thead>
			';
			
			tableRowsRecurrencia('BANORTE',$obj_rst);
			
			echo '
						</table>
					</div>
				</div>
			</div>
			';
			
			endGeneralResultsTable($table_results_name, 'true');
			
		} else {
			
			withToMuchResultsSQLSERVER($total_num_rst);
			
		}
	}

?>
