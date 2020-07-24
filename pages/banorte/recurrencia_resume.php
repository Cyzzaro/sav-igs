<?php 
//	include_once '../../bin/head.php'; 

	$query = "
		SELECT
			FORMAT(fecha_procesado, 'yyyy-MM') AS [Fecha]
		   ,COUNT(CASE
				WHEN evento = '00 VENTAS' THEN 1
				ELSE NULL
			END)							   AS [00-VTAS]
		   ,COUNT(CASE
				WHEN evento = '01 VENTAS' THEN 1
				ELSE NULL
			END)							   AS [01-VTAS]

		   ,COUNT(CASE
				WHEN evento = '51 FONDOS INSUFICIENTES' THEN 1
				ELSE NULL
			END)							   AS [51-F.INS]
		   ,COUNT(CASE
				WHEN evento = '05 RECHAZADA' THEN 1
				ELSE NULL
			END)							   AS [05-RZDA]
		   ,COUNT(CASE
				WHEN evento = 'T5 RECHAZAR' THEN 1
				ELSE NULL
			END)							   AS [T5-RCHZ]
		   ,COUNT(CASE
				WHEN evento = '87 RECHAZADA' THEN 1
				ELSE NULL
			END)							   AS [87-RZDA]
		   ,COUNT(CASE
				WHEN evento = 'N0 TRANSACCION NO PERMITIDA AL TARJETAHABIENTE' THEN 1
				ELSE NULL
			END)							   AS [N0-TNP]
			

		   ,COUNT(CASE
				WHEN evento = '62 TARJETA RESTRINGIDA' THEN 1
				ELSE NULL
			END)							   AS [62-T.RST]
		   ,COUNT(CASE
				WHEN evento = '57 TRANSACCION NO PERMITIDA AL TARJETAHABIENTE' THEN 1
				ELSE NULL
			END)							   AS [57-TNP]
		   ,COUNT(CASE
				WHEN evento = '01 LLAMAR AL BANCO EMISOR' THEN 1
				ELSE NULL
			END)							   AS [01-L.BEM]
		   ,COUNT(CASE
				WHEN evento = 'O6 RECHAZADA' THEN 1
				ELSE NULL
			END)							   AS [O6-RZDA]

			,COUNT(CASE
				WHEN evento = '41 TARJETA EXTRAVIADA' THEN 1
				ELSE NULL
			END)							   AS [41-T.EXT]
		   ,COUNT(CASE
				WHEN evento = 'N7 RECHAZADA' THEN 1
				ELSE NULL
			END)							   AS [N7-RZDA]
		   ,COUNT(id)						   AS [Procesados]
		FROM tmk.dbo.Procesados
		GROUP BY FORMAT(fecha_procesado, 'yyyy-MM')
		UNION ALL
		SELECT
			'Total' AS [Fecha]
		   ,COUNT(CASE
				WHEN evento = '00 VENTAS' THEN 1
				ELSE NULL
			END)							   AS [00-VTAS]
		   ,COUNT(CASE
				WHEN evento = '01 VENTAS' THEN 1
				ELSE NULL
			END)							   AS [01-VTAS]

		   ,COUNT(CASE
				WHEN evento = '51 FONDOS INSUFICIENTES' THEN 1
				ELSE NULL
			END)							   AS [51-F.INS]
		   ,COUNT(CASE
				WHEN evento = '05 RECHAZADA' THEN 1
				ELSE NULL
			END)							   AS [05-RZDA]
		   ,COUNT(CASE
				WHEN evento = 'T5 RECHAZAR' THEN 1
				ELSE NULL
			END)							   AS [T5-RCHZ]
		   ,COUNT(CASE
				WHEN evento = '87 RECHAZADA' THEN 1
				ELSE NULL
			END)							   AS [87-RZDA]
		   ,COUNT(CASE
				WHEN evento = 'N0 TRANSACCION NO PERMITIDA AL TARJETAHABIENTE' THEN 1
				ELSE NULL
			END)							   AS [N0-TNP]
			

		   ,COUNT(CASE
				WHEN evento = '62 TARJETA RESTRINGIDA' THEN 1
				ELSE NULL
			END)							   AS [62-T.RST]
		   ,COUNT(CASE
				WHEN evento = '57 TRANSACCION NO PERMITIDA AL TARJETAHABIENTE' THEN 1
				ELSE NULL
			END)							   AS [57-TNP]
		   ,COUNT(CASE
				WHEN evento = '01 LLAMAR AL BANCO EMISOR' THEN 1
				ELSE NULL
			END)							   AS [01-L.BEM]
		   ,COUNT(CASE
				WHEN evento = 'O6 RECHAZADA' THEN 1
				ELSE NULL
			END)							   AS [O6-RZDA]

			,COUNT(CASE
				WHEN evento = '41 TARJETA EXTRAVIADA' THEN 1
				ELSE NULL
			END)							   AS [41-T.EXT]
		   ,COUNT(CASE
				WHEN evento = 'N7 RECHAZADA' THEN 1
				ELSE NULL
			END)							   AS [N7-RZDA]
		   ,COUNT(id)						   AS [Procesados]
		FROM tmk.dbo.Procesados
		ORDER BY [Fecha]
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

	function priv_filas_tabla_para_resultados_obtenidos_recurrencia($client_name, $obj_rst) {
			while ($rst = sqlsrv_fetch_array($obj_rst, SQLSRV_FETCH_ASSOC)) { 
				$fecha = $rst['Fecha'];
				$vtas_00 = number_format($rst['00-VTAS']);
				$vtas_01 = number_format($rst['01-VTAS']);
				
				$f_ins_51 = number_format($rst['51-F.INS']);
				$rzda_05 = number_format($rst['05-RZDA']);
				$rchz_t5 = number_format($rst['T5-RCHZ']);
				$rzda_87 = number_format($rst['87-RZDA']);
				$tnp_n0 = number_format($rst['N0-TNP']);
				
				$t_rst_62 = number_format($rst['62-T.RST']);
				$tnp_57 = number_format($rst['57-TNP']);
				$l_bem_01 = number_format($rst['01-L.BEM']);
				$rzda_o6 = number_format($rst['O6-RZDA']);
				
				$t_ext_41 = number_format($rst['41-T.EXT']);
				$rzda_n7 = number_format($rst['N7-RZDA']);
				$procesados = number_format($rst['Procesados']);

				if ($fecha == 'Total') {
					$class_for_totals_row = ' class="'.activePagePrimaryColor().' lighten-4"';
				} else {
					$class_for_totals_row = '';
				}
							
				echo "
								<tr".$class_for_totals_row.">
									<td>".$fecha."</td>
									<td><a href='".GLOBALPATH."/pages/detalle/detalle_recurrencia.php?client=BANORTE&dato=00-VTAS_".$fecha."' target='new'>".$vtas_00."</a></td>
									<td><a href='".GLOBALPATH."/pages/detalle/detalle_recurrencia.php?client=BANORTE&dato=01-VTAS_".$fecha."' target='new'>".$vtas_01."</a></td>
									
									<td><a href='".GLOBALPATH."/pages/detalle/detalle_recurrencia.php?client=BANORTE&dato=51-F.INS_".$fecha."' target='new'>".$f_ins_51."</a></td>
									<td><a href='".GLOBALPATH."/pages/detalle/detalle_recurrencia.php?client=BANORTE&dato=05-RZDA_".$fecha."' target='new'>".$rzda_05."</a></td>
									<td><a href='".GLOBALPATH."/pages/detalle/detalle_recurrencia.php?client=BANORTE&dato=T5-RCHZ_".$fecha."' target='new'>".$rchz_t5."</a></td>
									<td><a href='".GLOBALPATH."/pages/detalle/detalle_recurrencia.php?client=BANORTE&dato=87-RZDA_".$fecha."' target='new'>".$rzda_87."</a></td>
									<td><a href='".GLOBALPATH."/pages/detalle/detalle_recurrencia.php?client=BANORTE&dato=N0-TNP_".$fecha."' target='new'>".$tnp_n0."</a></td>
									
									<td><a href='".GLOBALPATH."/pages/detalle/detalle_recurrencia.php?client=BANORTE&dato=62-T.RST_".$fecha."' target='new'>".$t_rst_62."</a></td>
									<td><a href='".GLOBALPATH."/pages/detalle/detalle_recurrencia.php?client=BANORTE&dato=57-TNP_".$fecha."' target='new'>".$tnp_57."</a></td>
									<td><a href='".GLOBALPATH."/pages/detalle/detalle_recurrencia.php?client=BANORTE&dato=01-L.BEM_".$fecha."' target='new'>".$l_bem_01."</a></td>
									<td><a href='".GLOBALPATH."/pages/detalle/detalle_recurrencia.php?client=BANORTE&dato=O6-RZDA_".$fecha."' target='new'>".$rzda_o6."</a></td>
									
									<td><a href='".GLOBALPATH."/pages/detalle/detalle_recurrencia.php?client=BANORTE&dato=41-T.EXT_".$fecha."' target='new'>".$t_ext_41."</a></td>
									<td><a href='".GLOBALPATH."/pages/detalle/detalle_recurrencia.php?client=BANORTE&dato=N7-RZDA_".$fecha."' target='new'>".$rzda_n7."</a></td>
									<td><a href='".GLOBALPATH."/pages/detalle/detalle_recurrencia.php?client=BANORTE&dato=_".$fecha."' target='new'>".$procesados."</a></td>
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
					<div class="col l12 m12 s12">
						<table id="resumen_solicitado" class="responsive-table bordered hoverable card centered">
							<thead class="'.activePagePrimaryColor().' white-text">
								<tr>
									<th>FECHA</th>
									<th class="green">00-VTAS</th>
									<th class="green">01-VTAS</th>
									
									<th class="blue">51-F.INS</th>
									<th class="blue">05-RZDA</th>
									<th class="blue">T5-RCHZ</th>
									<th class="blue">87-RZDA</th>
									<th class="blue">N0-TNP</th>
									
									<th class="amber black-text">62-T.RST</th>
									<th class="amber black-text">57-TNP</th>
									<th class="amber black-text">01-L.BEM</th>
									<th class="amber black-text">O6-RZDA</th>
									
									<th class="red">41-T.EXT</th>
									<th class="red">N7-RZDA</th>
									<th>Procesados</th>
								</tr>
							</thead>';			
			priv_filas_tabla_para_resultados_obtenidos_recurrencia('BANORTE',$obj_rst);
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
