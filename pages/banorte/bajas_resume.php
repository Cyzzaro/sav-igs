<?php 
//	include_once '../../bin/head.php'; 

	$query = "
		SELECT
			FORMAT(fecha_estatus, 'yyyy-MM') AS [Fecha]
		  ,COUNT(CASE WHEN estatus = 'BAJA DEL SERVICIO (SAC)' THEN 1 ELSE NULL END) AS [Baja(SAC)]
			,COUNT(CASE WHEN estatus = 'BAJA DEL SERVICIO (SPONSOR)' THEN 1 ELSE NULL END) AS [Baja(SPONSOR)]
			,COUNT(CASE WHEN estatus = 'CONTRACARGO' THEN 1 ELSE NULL END) AS [Contracargo]
			,COUNT(CASE WHEN estatus = 'REINTEGRO' THEN 1 ELSE NULL END) AS [Reintegro]
			,COUNT(CASE WHEN estatus = 'REINTEGRO (SPONSOR)' THEN 1 ELSE NULL END) AS [Reintegro(SPONSOR)]
			,COUNT(CASE WHEN estatus = 'TDC CANCELADA' THEN 1 ELSE NULL END) AS [TDC Cancelada]
			,COUNT(CASE WHEN estatus = 'INTENTOS' THEN 1 ELSE NULL END) AS [Intentos]
			,COUNT(CASE WHEN estatus = 'BAJA DEL SERVICIO (CAMBIO DE PLAN)' THEN 1 ELSE NULL END) AS [Cambio de Plan]
			,COUNT(CASE WHEN estatus = 'RESERVAR' THEN 1 ELSE NULL END) AS [Reservar]
		   ,COUNT(id)							AS [Total]
		FROM tmk.dbo.afiliados
		WHERE (estatus IS NOT NULL /*AND estatus NOT LIKE '%RESERVAR%'*/)
		GROUP BY FORMAT(fecha_estatus, 'yyyy-MM')
		UNION ALL
		SELECT
			'Total' AS [Fecha]
		  ,COUNT(CASE WHEN estatus = 'BAJA DEL SERVICIO (SAC)' THEN 1 ELSE NULL END) AS [Baja(SAC)]
			,COUNT(CASE WHEN estatus = 'BAJA DEL SERVICIO (SPONSOR)' THEN 1 ELSE NULL END) AS [Baja(SPONSOR)]
			,COUNT(CASE WHEN estatus = 'CONTRACARGO' THEN 1 ELSE NULL END) AS [Contracargo]
			,COUNT(CASE WHEN estatus = 'REINTEGRO' THEN 1 ELSE NULL END) AS [Reintegro]
			,COUNT(CASE WHEN estatus = 'REINTEGRO (SPONSOR)' THEN 1 ELSE NULL END) AS [Reintegro(SPONSOR)]
			,COUNT(CASE WHEN estatus = 'TDC CANCELADA' THEN 1 ELSE NULL END) AS [TDC Cancelada]
			,COUNT(CASE WHEN estatus = 'INTENTOS' THEN 1 ELSE NULL END) AS [Intentos]
			,COUNT(CASE WHEN estatus = 'BAJA DEL SERVICIO (CAMBIO DE PLAN)' THEN 1 ELSE NULL END) AS [Cambio de Plan]
			,COUNT(CASE WHEN estatus = 'RESERVAR' THEN 1 ELSE NULL END) AS [Reservar]
		   ,COUNT(id)							AS [Total]
		FROM tmk.dbo.afiliados
		WHERE (estatus IS NOT NULL /*AND estatus NOT LIKE '%RESERVAR%'*/)
		ORDER BY [Fecha] DESC
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

	function priv_filas_tabla_para_resultados_obtenidos_bajas($client_name, $obj_rst) {
			while ($rst = sqlsrv_fetch_array($obj_rst, SQLSRV_FETCH_ASSOC)) { 
				$fecha = $rst['Fecha'];
				$baja_sac = number_format($rst['Baja(SAC)']);
				$baja_sponsor = number_format($rst['Baja(SPONSOR)']);
				$contracargo = number_format($rst['Contracargo']);
				$reintegro = number_format($rst['Reintegro']);
				$reintegro_sponsor = number_format($rst['Reintegro(SPONSOR)']);
				$tdccancelada = number_format($rst['TDC Cancelada']);
				$intentos = number_format($rst['Intentos']);
				$baja_cambio_plan = number_format($rst['Cambio de Plan']);
				$reservar = number_format($rst['Reservar']);
				$bajas = number_format($rst['Total']);

				if ($fecha == 'Total') {
					$class_for_totals_row = ' class="'.activePagePrimaryColor().' lighten-4"';
				} else {
					$class_for_totals_row = '';
				}
							
				echo "
								<tr".$class_for_totals_row.">
									<td>".$fecha."</td>
									<td><a href='".GLOBALPATH."/pages/detalle/detalle_bajas.php?client=BANORTE&dato=BAJA+DEL+SERVICIO+(SAC)_".$fecha."' target='new'>".$baja_sac."</a></td>
									<td><a href='".GLOBALPATH. "/pages/detalle/detalle_bajas.php?client=BANORTE&dato=BAJA+DEL+SERVICIO+(SPONSOR)_".$fecha."' target='new'>".$baja_sponsor."</a></td>
									<td><a href='".GLOBALPATH."/pages/detalle/detalle_bajas.php?client=BANORTE&dato=CONTRACARGO_".$fecha."' target='new'>".$contracargo."</a></td>
									<td><a href='".GLOBALPATH."/pages/detalle/detalle_bajas.php?client=BANORTE&dato=REINTEGRO_".$fecha."' target='new'>".$reintegro."</a></td>
									<td><a href='".GLOBALPATH."/pages/detalle/detalle_bajas.php?client=BANORTE&dato=REINTEGRO+(SPONSOR)_".$fecha."' target='new'>".$reintegro_sponsor."</a></td>
									<td><a href='".GLOBALPATH."/pages/detalle/detalle_bajas.php?client=BANORTE&dato=TDC+CANCELADA_".$fecha."' target='new'>".$tdccancelada."</a></td>
									<td><a href='".GLOBALPATH."/pages/detalle/detalle_bajas.php?client=BANORTE&dato=INTENTOS_".$fecha."' target='new'>".$intentos. "</a></td>
									<td><a href='" . GLOBALPATH . "/pages/detalle/detalle_bajas.php?client=BANORTE&dato=BAJA+DEL+SERVICIO+(CAMBIO+DE+PLAN)_" . $fecha . "' target='new'>" . $baja_cambio_plan . "</a></td>
									<td><a href='".GLOBALPATH."/pages/detalle/detalle_bajas.php?client=BANORTE&dato=RESERVAR_".$fecha."' target='new'>".$reservar."</a></td>
									<td><a href='".GLOBALPATH."/pages/detalle/detalle_bajas.php?client=BANORTE&dato=_".$fecha."' target='new'>".$bajas."</a></td>
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
					<div class="col l10 offset-l1 m12 s12">
						<table id="resumen_solicitado" class="responsive-table bordered hoverable card centered">
							<thead class="'.activePagePrimaryColor(). ' white-text">
								<tr>
									<th>FECHA</th>
									<th>BAJA(SAC)</th>
									<th>BAJA(SPONSOR)</th>
									<th>CONTRACARGO</th>
									<th>REINTEGRO</th>
									<th>REINTEGRO(SPONSOR)</th>
									<th>TDC CANCELADA</th>
									<th>INTENTOS</th>
									<th>CAMBIO DE PLAN</th>
									<th>RESERVAR</th>
									<th>TOTAL</th>
								</tr>
							</thead>';			
			priv_filas_tabla_para_resultados_obtenidos_bajas('BANORTE',$obj_rst);
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
