<?php

	$string_to_search = $_GET['dato'];
	$client_name = $_GET['client'];

	list($query_criteria_filter, $query_date_filter) = explode('_', $string_to_search);

	if ($query_criteria_filter == '') {
		
		$query_criteria_filter = 'GENERAL';
		$query_criteria_filter_en_bd = " WHERE (estatus IS NOT NULL AND estatus NOT LIKE '%RESERVAR%') ";
		
	} else {
		
		$query_criteria_filter_en_bd = " WHERE estatus LIKE '%".$query_criteria_filter."%'";
		
	}
	
	if ($query_date_filter == 'Total') {
		
		$query_date_filterFilter = "";
		
	} else {
		
		$query_date_filterFilter = " AND fecha_estatus BETWEEN '".$query_date_filter."-01' AND DATEADD(ms,-3,DATEADD(mm,0,DATEADD(mm,DATEDIFF(mm,0,'".$query_date_filter."-01')+1,0)))";
		
	}
	
	$string_to_search = "SELECT identificador FROM tmk.dbo.afiliados".$query_criteria_filter_en_bd.$query_date_filterFilter;
	
	$client_name = "cliente = '".$client_name."'";
	$query = "
		SELECT 
			clafiltmk, 
			nombre_afiliado, 
			fecha_venta, 
			dni, 
			identificador, 
			cliente, 
			estatus, 
			fecha_estatus, 
			ultimo_procesado, 
			fecha_ultimo_procesado 
		FROM 
			tmk.dbo.afiliados 
		WHERE 
			$client_name AND identificador IN (".$string_to_search.")
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

	if ($total_num_rst == 0) {
		
		withNoResultsSQLSERVER();
		
	} elseif ($total_num_rst > 0) {
		
		if ($total_num_rst < 40000) {
			
			$table_results_name = str_replace(" ","_",$query_criteria_filter."_".$total_num_rst."_".$query_date_filter);
			$table_results_name_download_plugin = "'".$table_results_name."'";
		
			infoGeneralDetailTable($query_criteria_filter, $query_date_filter, $total_num_rst, $table_results_name_download_plugin);
			headRowGeneralResultsTable($table_results_name);
			rowsGeneralResultsTable($obj_rst,true);
			endGeneralResultsTable($table_results_name, 'true');

		} else {
			
			withToMuchResultsSQLSERVER($total_num_rst);
			
		}
	}
	
?>
