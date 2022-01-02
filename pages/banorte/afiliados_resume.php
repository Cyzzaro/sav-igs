<?php 
//	include_once '../../bin/head.php'; 

	$query = "
		SELECT
			FORMAT(fecha_venta, 'yyyy-MM') AS [Fecha]
		   ,COUNT(CASE
				WHEN (origen LIKE '%192.168.%') THEN 1
				ELSE NULL
			END)						   AS [Prevalidaciones]
		   ,COUNT(CASE
				WHEN origen LIKE 'OTROS%CANALES%' THEN 1
				ELSE NULL
			END)						   AS [Otros canales]
		   ,COUNT(CASE
				WHEN origen LIKE '%INBOUND%' THEN 1
				ELSE NULL
			END)						   AS [Inbound]
		   ,COUNT(CASE
				WHEN origen LIKE '%REACTIVACION%' THEN 1
				ELSE NULL
			END)						   AS [Reactivacion]
		   ,COUNT(id)					   AS [Total]
		FROM tmk.dbo.afiliados
		GROUP BY FORMAT(fecha_venta, 'yyyy-MM')
		UNION ALL
		SELECT
			'Total'	  AS [Fecha]
		   ,COUNT(CASE
				WHEN (origen LIKE '%192.168.%') THEN 1
				ELSE NULL
			END)	  AS [Prevalidaciones]
		   ,COUNT(CASE
				WHEN origen LIKE '%OTROS%CANALES%' THEN 1
				ELSE NULL
			END)	  AS [Otros canales]
		   ,COUNT(CASE
				WHEN origen LIKE '%INBOUND%' THEN 1
				ELSE NULL
			END)	  AS [Inbound]
		   ,COUNT(CASE
				WHEN origen LIKE '%REACTIVACION%' THEN 1
				ELSE NULL
			END)	  AS [Reactivacion]
		   ,COUNT(id) AS [Total]
		FROM tmk.dbo.afiliados
		ORDER BY [fecha] DESC
		";

	$obj_conn_params_SQLSERVER = array('Database' => COBRANZABD, 'Uid' => COBRANZAUSER, 'PWD' => COBRANZAPWD);
	$obj_conn_SQLSERVER = sqlsrv_connect(COBRANZASRVR, $obj_conn_params_SQLSERVER);
		
	$obj_rst_aditional_params_SQLSERVER = array();
	$obj_rst_optionals_SQLSERVER = array('Scrollable'=>SQLSRV_CURSOR_KEYSET);	
	
	$obj_rst = sqlsrv_query($obj_conn_SQLSERVER, $query, $obj_rst_aditional_params_SQLSERVER, $obj_rst_optionals_SQLSERVER);

	if ($obj_rst == FALSE)
		die(errorConnSQLSRVR(sqlsrv_errors()));

	$total_num_rst = sqlsrv_num_rows($obj_rst);

	if ($total_num_rst == 0) {
		$message_num_rst_SQLSERVER = 'yellow';
		$message_text_color_SQLSERVER = 'black-text';
	} elseif ($total_num_rst > 1000) {
		$message_num_rst_SQLSERVER = 'red';
		$message_text_color_SQLSERVER = 'white-text';
	} else {
		$message_num_rst_SQLSERVER = 'teal';
		$message_text_color_SQLSERVER = 'white-text';
	}

	function priv_filas_tabla_para_resultados_obtenidos_afiliados($client_name, $obj_rst) {
			while ($rst = sqlsrv_fetch_array($obj_rst, SQLSRV_FETCH_ASSOC)) { 
				$fecha = $rst['Fecha'];
				$prevalidaciones = number_format($rst['Prevalidaciones']);
				$otros_canales = number_format($rst['Otros canales']);
				$inbound = number_format($rst['Inbound']);
				$reactivacion = number_format($rst['Reactivacion']);
				$procesados = number_format($rst['Total']);

				if ($fecha == 'Total') {
					$class_for_totals_row = ' class="'.activePagePrimaryColor().' lighten-4"';
				} else {
					$class_for_totals_row = '';
				}
			
				echo "
									<tr".$class_for_totals_row.">
										<td>".$fecha."</td>
										<td><a href='".GLOBALPATH."/pages/detalle/detalle_afiliados.php?client=BANORTE&dato=192.168.12._".$fecha."' target='new'>".$prevalidaciones."</a></td>
										<td><a href='".GLOBALPATH."/pages/detalle/detalle_afiliados.php?client=BANORTE&dato=OTROS+CANALES_".$fecha."' target='new'>".$otros_canales."</a></td>
										<td><a href='".GLOBALPATH."/pages/detalle/detalle_afiliados.php?client=BANORTE&dato=INBOUND_".$fecha."' target='new'>".$inbound."</a></td>
										<td><a href='".GLOBALPATH."/pages/detalle/detalle_afiliados.php?client=BANORTE&dato=REACTIVACION_".$fecha."' target='new'>".$reactivacion."</a></td>
										<td><a href='".GLOBALPATH."/pages/detalle/detalle_afiliados.php?client=BANORTE&dato=_".$fecha."' target='new'>".$procesados."</a></td>
									</tr>";
				}

	}

	if ($total_num_rst == 0) {
		withNoResultsSQLSERVER();
	} elseif ($total_num_rst > 0) {
		if ($total_num_rst < 500) {
			echo '
				<div class="container">
					<div class="col l1 offset-l11 m1 offset-m11 s2 offset-s10">
						<a class="btn-floating blue" onclick="javascript:xport.toCSV('.TABLEINFOEXPORT.');"><i class="material-icons small">cloud_download</i></a>
					</div>
					<div class="row">
						<div class="col l8 offset-l2 m12 s12">
							<table id="resumen_solicitado" class="responsive-table bordered hoverable card centered">
								<thead class="'.activePagePrimaryColor().' white-text">
									<tr>
										<th>FECHA</th>
										<th>PREVALIDACIONES</th>
										<th>OTROS CANALES</th>
										<th>INBOUND</th>
										<th>REACTIVACION</th>
										<th>TOTAL</th>
									</tr>
								</thead>';			
			priv_filas_tabla_para_resultados_obtenidos_afiliados('BANORTE',$obj_rst);
			echo '
							</table>
						</div>
					</div>
				</div>
			';

		} else {
			withToMuchResultsSQLSERVER($total_num_rst);
			}
		}

//	include_once '../../bin/jquery.php';
?>
