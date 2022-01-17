<?php
	include_once '../../bin/head.php'; 

$query = "
		SELECT
			FORMAT(fecha_procesado, 'yyyy-MM') AS [Fecha]
			,COUNT(CASE WHEN evento = '00 VENTAS' THEN 1 ELSE NULL END) AS '00-VTAS'
			,COUNT(CASE WHEN evento = '01 VENTAS' THEN 1 ELSE NULL END) AS '01-VTAS'

			,COUNT(CASE WHEN evento = '05 RECHAZADA' THEN 1 ELSE NULL END) AS '05-RZDA'
			,COUNT(CASE WHEN evento = '51 FONDOS INSUFICIENTES' THEN 1 ELSE NULL END) AS '51-F.INS'
			,COUNT(CASE WHEN evento = '65 EXCEDE LIMITE DE DISPOSICIONES DIARIAS' THEN 1 ELSE NULL END) AS '65-L.DISP'
			,COUNT(CASE WHEN evento = '87 RECHAZADA' THEN 1 ELSE NULL END) AS '87-RZDA'
			,COUNT(CASE WHEN evento = '91 IMPOSIBLE AUTORIZAR EN ESTE MOMENTO' THEN 1 ELSE NULL END) AS '91-N.AUT'
			,COUNT(CASE WHEN evento = 'N0 TRANSACCION NO PERMITIDA AL TARJETAHABIENTE' THEN 1 ELSE NULL END) AS 'N0-TNP'
			,COUNT(CASE WHEN evento = 'P1 EXCEDE LIMITE DE DISPOSICION DIARIA' THEN 1 ELSE NULL END) AS 'P1-L.DISP'
			,COUNT(CASE WHEN evento = 'T5 RECHAZAR' THEN 1 ELSE NULL END) AS 'T5-RCHZ'
			,COUNT(CASE WHEN evento = 'T2 RECHAZADA' THEN 1 ELSE NULL END) AS 'T2-RZDA'

			,COUNT(CASE WHEN evento = '01 LLAMAR AL BANCO EMISOR' THEN 1 ELSE NULL END) AS '01-L.BEM'
			,COUNT(CASE WHEN evento = '57 TRANSACCION NO PERMITIDA AL TARJETAHABIENTE' THEN 1 ELSE NULL END) AS '57-TNP'
			,COUNT(CASE WHEN evento = '62 TARJETA RESTRINGIDA' THEN 1 ELSE NULL END) AS '62-T.RST'
			,COUNT(CASE WHEN evento = 'O6 RECHAZADA' THEN 1 ELSE NULL END) AS 'O6-RZDA'

			,COUNT(CASE WHEN evento = '0  DENEGADO' THEN 1 ELSE NULL END) AS '0-DEN'
			,COUNT(CASE WHEN evento = '14 NUMERO DE TARJETA INVALIDO' THEN 1 ELSE NULL END) AS '14-T.INV'
			,COUNT(CASE WHEN evento = '33 TARJETA VENCIDA' THEN 1 ELSE NULL END) AS '33-T.VENC'
			,COUNT(CASE WHEN evento = '41 TARJETA EXTRAVIADA' THEN 1 ELSE NULL END) AS '41-T.EXT'
			,COUNT(CASE WHEN evento = '56 TARJETA SIN REGISTRO' THEN 1 ELSE NULL END) AS '56-T.SREG'
			,COUNT(CASE WHEN evento = '83 RECHAZADA' THEN 1 ELSE NULL END) AS '83-RZDA'
			,COUNT(CASE WHEN evento = 'N7 RECHAZADA' THEN 1 ELSE NULL END) AS 'N7-RZDA'
			,COUNT(CASE WHEN evento = 'O8 RECHAZADA' THEN 1 ELSE NULL END) AS 'O8-RZDA'
		  ,COUNT(id)						   AS [Procesados]
		FROM tmk.dbo.Procesados
		GROUP BY FORMAT(fecha_procesado, 'yyyy-MM')
		UNION ALL
		SELECT
			'Total' AS [Fecha]
			,COUNT(CASE WHEN evento = '00 VENTAS' THEN 1 ELSE NULL END) AS '00-VTAS'
			,COUNT(CASE WHEN evento = '01 VENTAS' THEN 1 ELSE NULL END) AS '01-VTAS'

			,COUNT(CASE WHEN evento = '05 RECHAZADA' THEN 1 ELSE NULL END) AS '05-RZDA'
			,COUNT(CASE WHEN evento = '51 FONDOS INSUFICIENTES' THEN 1 ELSE NULL END) AS '51-F.INS'
			,COUNT(CASE WHEN evento = '65 EXCEDE LIMITE DE DISPOSICIONES DIARIAS' THEN 1 ELSE NULL END) AS '65-L.DISP'
			,COUNT(CASE WHEN evento = '87 RECHAZADA' THEN 1 ELSE NULL END) AS '87-RZDA'
			,COUNT(CASE WHEN evento = '91 IMPOSIBLE AUTORIZAR EN ESTE MOMENTO' THEN 1 ELSE NULL END) AS '91-N.AUT'
			,COUNT(CASE WHEN evento = 'N0 TRANSACCION NO PERMITIDA AL TARJETAHABIENTE' THEN 1 ELSE NULL END) AS 'N0-TNP'
			,COUNT(CASE WHEN evento = 'P1 EXCEDE LIMITE DE DISPOSICION DIARIA' THEN 1 ELSE NULL END) AS 'P1-L.DISP'
			,COUNT(CASE WHEN evento = 'T5 RECHAZAR' THEN 1 ELSE NULL END) AS 'T5-RCHZ'
			,COUNT(CASE WHEN evento = 'T2 RECHAZADA' THEN 1 ELSE NULL END) AS 'T2-RZDA'

			,COUNT(CASE WHEN evento = '01 LLAMAR AL BANCO EMISOR' THEN 1 ELSE NULL END) AS '01-L.BEM'
			,COUNT(CASE WHEN evento = '57 TRANSACCION NO PERMITIDA AL TARJETAHABIENTE' THEN 1 ELSE NULL END) AS '57-TNP'
			,COUNT(CASE WHEN evento = '62 TARJETA RESTRINGIDA' THEN 1 ELSE NULL END) AS '62-T.RST'
			,COUNT(CASE WHEN evento = 'O6 RECHAZADA' THEN 1 ELSE NULL END) AS 'O6-RZDA'

			,COUNT(CASE WHEN evento = '0  DENEGADO' THEN 1 ELSE NULL END) AS '0-DEN'
			,COUNT(CASE WHEN evento = '14 NUMERO DE TARJETA INVALIDO' THEN 1 ELSE NULL END) AS '14-T.INV'
			,COUNT(CASE WHEN evento = '33 TARJETA VENCIDA' THEN 1 ELSE NULL END) AS '33-T.VENC'
			,COUNT(CASE WHEN evento = '41 TARJETA EXTRAVIADA' THEN 1 ELSE NULL END) AS '41-T.EXT'
			,COUNT(CASE WHEN evento = '56 TARJETA SIN REGISTRO' THEN 1 ELSE NULL END) AS '56-T.SREG'
			,COUNT(CASE WHEN evento = '83 RECHAZADA' THEN 1 ELSE NULL END) AS '83-RZDA'
			,COUNT(CASE WHEN evento = 'N7 RECHAZADA' THEN 1 ELSE NULL END) AS 'N7-RZDA'
			,COUNT(CASE WHEN evento = 'O8 RECHAZADA' THEN 1 ELSE NULL END) AS 'O8-RZDA'
		  ,COUNT(id)						   AS [Procesados]
		FROM tmk.dbo.Procesados
		ORDER BY [Fecha] DESC
		";

$obj_conn_params_SQLSERVER = array('Database' => COBRANZABD, 'Uid' => COBRANZAUSER, 'PWD' => COBRANZAPWD);
$obj_conn_SQLSERVER = sqlsrv_connect(COBRANZASRVR, $obj_conn_params_SQLSERVER);

$obj_rst_aditional_params_SQLSERVER = array();
$obj_rst_optionals_SQLSERVER = array('Scrollable' => SQLSRV_CURSOR_KEYSET);

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

function priv_filas_tabla_para_resultados_obtenidos_recurrencia($client_name, $obj_rst)
{
	while ($rst = sqlsrv_fetch_array($obj_rst, SQLSRV_FETCH_ASSOC)) {
		$fecha = $rst['Fecha'];

		$procesados = number_format($rst['Procesados']);

		if ($fecha == 'Total') {
			$class_for_totals_row = ' class="' . activePagePrimaryColor() . ' lighten-4"';
		} else {
			$class_for_totals_row = '';
		}

		echo "
								<tr" . $class_for_totals_row . ">
									<td>" . $fecha . "</td>
									<td><a href='" . GLOBALPATH . "/pages/detalle/detalle_recurrencia.php?client=BANORTE&dato=00-VTAS_" . $fecha . "' target='new'>" . number_format($rst['00-VTAS']) . "</a></td>
									<td><a href='" . GLOBALPATH . "/pages/detalle/detalle_recurrencia.php?client=BANORTE&dato=01-VTAS_" . $fecha . "' target='new'>" . number_format($rst['01-VTAS']) . "</a></td>
									
									<td><a href='" . GLOBALPATH . "/pages/detalle/detalle_recurrencia.php?client=BANORTE&dato=05-RZDA_" . $fecha . "' target='new'>" . number_format($rst['05-RZDA']) . "</a></td>
									<td><a href='" . GLOBALPATH . "/pages/detalle/detalle_recurrencia.php?client=BANORTE&dato=51-F.INS_" . $fecha . "' target='new'>" . number_format($rst['51-F.INS']) . "</a></td>
									<td><a href='" . GLOBALPATH . "/pages/detalle/detalle_recurrencia.php?client=BANORTE&dato=65-L.DISP_" . $fecha . "' target='new'>" . number_format($rst['65-L.DISP']) . "</a></td>
									<td><a href='" . GLOBALPATH . "/pages/detalle/detalle_recurrencia.php?client=BANORTE&dato=87-RZDA_" . $fecha . "' target='new'>" . number_format($rst['87-RZDA']) . "</a></td>
									<td><a href='" . GLOBALPATH . "/pages/detalle/detalle_recurrencia.php?client=BANORTE&dato=91-N.AUT_" . $fecha . "' target='new'>" . number_format($rst['91-N.AUT']) . "</a></td>
									<td><a href='" . GLOBALPATH . "/pages/detalle/detalle_recurrencia.php?client=BANORTE&dato=N0-TNP_" . $fecha . "' target='new'>" . number_format($rst['N0-TNP']) . "</a></td>
									<td><a href='" . GLOBALPATH . "/pages/detalle/detalle_recurrencia.php?client=BANORTE&dato=P1-L.DISP_" . $fecha . "' target='new'>" . number_format($rst['P1-L.DISP']) . "</a></td>
									<td><a href='" . GLOBALPATH . "/pages/detalle/detalle_recurrencia.php?client=BANORTE&dato=T5-RCHZ_" . $fecha . "' target='new'>" . number_format($rst['T5-RCHZ']) . "</a></td>
									<td><a href='" . GLOBALPATH . "/pages/detalle/detalle_recurrencia.php?client=BANORTE&dato=T2-RZDA_" . $fecha . "' target='new'>" . number_format($rst['T2-RZDA']) . "</a></td>
									
									<td><a href='" . GLOBALPATH . "/pages/detalle/detalle_recurrencia.php?client=BANORTE&dato=01-L.BEM_" . $fecha . "' target='new'>" . number_format($rst['01-L.BEM']) . "</a></td>
									<td><a href='" . GLOBALPATH . "/pages/detalle/detalle_recurrencia.php?client=BANORTE&dato=57-TNP_" . $fecha . "' target='new'>" . number_format($rst['57-TNP']) . "</a></td>
									<td><a href='" . GLOBALPATH . "/pages/detalle/detalle_recurrencia.php?client=BANORTE&dato=62-T.RST_" . $fecha . "' target='new'>" . number_format($rst['62-T.RST']) . "</a></td>
									<td><a href='" . GLOBALPATH . "/pages/detalle/detalle_recurrencia.php?client=BANORTE&dato=O6-RZDA_" . $fecha . "' target='new'>" . number_format($rst['O6-RZDA']) . "</a></td>
									
									<td><a href='" . GLOBALPATH . "/pages/detalle/detalle_recurrencia.php?client=BANORTE&dato=0-DEN_" . $fecha . "' target='new'>" . number_format($rst['0-DEN']) . "</a></td>
									<td><a href='" . GLOBALPATH . "/pages/detalle/detalle_recurrencia.php?client=BANORTE&dato=14-T.INV_" . $fecha . "' target='new'>" . number_format($rst['14-T.INV']) . "</a></td>
									<td><a href='" . GLOBALPATH . "/pages/detalle/detalle_recurrencia.php?client=BANORTE&dato=33-T.VENC_" . $fecha . "' target='new'>" . number_format($rst['33-T.VENC']) . "</a></td>
									<td><a href='" . GLOBALPATH . "/pages/detalle/detalle_recurrencia.php?client=BANORTE&dato=41-T.EXT_" . $fecha . "' target='new'>" . number_format($rst['41-T.EXT']) . "</a></td>
									<td><a href='" . GLOBALPATH . "/pages/detalle/detalle_recurrencia.php?client=BANORTE&dato=56-T.SREG_" . $fecha . "' target='new'>" . number_format($rst['56-T.SREG']) . "</a></td>
									<td><a href='" . GLOBALPATH . "/pages/detalle/detalle_recurrencia.php?client=BANORTE&dato=83-RZDA_" . $fecha . "' target='new'>" . number_format($rst['83-RZDA']) . "</a></td>
									<td><a href='" . GLOBALPATH . "/pages/detalle/detalle_recurrencia.php?client=BANORTE&dato=N7-RZDA_" . $fecha . "' target='new'>" . number_format($rst['N7-RZDA']) . "</a></td>
									<td><a href='" . GLOBALPATH . "/pages/detalle/detalle_recurrencia.php?client=BANORTE&dato=O8-RZDA_" . $fecha . "' target='new'>" . number_format($rst['O8-RZDA']) . "</a></td>
									<td><a href='" . GLOBALPATH . "/pages/detalle/detalle_recurrencia.php?client=BANORTE&dato=_" . $fecha . "' target='new'>" . $procesados . "</a></td>
								</tr>";
	}
}

if ($total_num_rst == 0) {
	withNoResultsSQLSERVER();
} elseif ($total_num_rst > 0) {
	if ($total_num_rst < 500) {
		echo '
				<div class="col l1 offset-l11 m1 offset-m11 s2 offset-s10">
					<a class="btn-floating blue" onclick="javascript:xport.toCSV(' . TABLEINFOEXPORT . ');"><i class="material-icons small">cloud_download</i></a>
				</div>
				<div class="row">
					<div class="col l12 m12 s12">
						<table id="resumen_solicitado" class="responsive-table bordered hoverable card centered">
							<thead class="' . activePagePrimaryColor() . ' white-text">
								<tr>
									<th>FECHA</th>
									<th class="green">00-VTAS</th>
									<th class="green">01-VTAS</th>
									
									<th class="blue">05-RZDA</th>
									<th class="blue">51-F.INS</th>
									<th class="blue">65-L.DISP</th>
									<th class="blue">87-RZDA</th>
									<th class="blue">91-N.AUT</th>
									<th class="blue">N0-TNP</th>
									<th class="blue">P1-L.DISP</th>
									<th class="blue">T5-RCHZ</th>
									<th class="blue">T2-RZDA</th>
									
									<th class="amber">01-L.BEM</th>
									<th class="amber">57-TNP</th>
									<th class="amber">62-T.RST</th>
									<th class="amber">O6-RZDA</th>
									
									<th class="red">0-DEN</th>
									<th class="red">14-T.INV</th>
									<th class="red">33-T.VENC</th>
									<th class="red">41-T.EXT</th>
									<th class="red">56-T.SREG</th>
									<th class="red">83-RZDA</th>
									<th class="red">N7-RZDA</th>
									<th class="red">O8-RZDA</th>
									
									<th>Procesados</th>
								</tr>
							</thead>';
		priv_filas_tabla_para_resultados_obtenidos_recurrencia('BANORTE', $obj_rst);
		echo '
						</table>
					</div>
				</div>
			';
	} else {
		withToMuchResultsSQLSERVER($total_num_rst);
	}
}

	include_once '../../bin/jquery.php';
