<?php include_once '../head.php'; ?>

<body>

	<header>

		<?php
		pageNavHead('Detalle de afiliado');
		include_once '../menu.php';
		?>

	</header>

	<main>

		<div class="container section">
			<?php
			$lead_id = $_GET['lead_id'];
			$string_to_search = strip_tags($lead_id, ENT_QUOTES);
			$string_to_search_higienized_for_query = higienizeString($string_to_search);
			if ($_SERVER['REMOTE_ADDR'] == '::1') {
				// Devuelve el numero de TDC completo - Vista especial para quien administra cobranza de la cuenta.
				$query = "SELECT TOP(1) cliente, asistencia, clafiltmk, identificador, CAST(fecha_venta AS VARCHAR(12)) AS fecha_venta, nombre_afiliado, 
					CAST(fecha_nacimiento AS VARCHAR(12)) AS fecha_nacimiento, tipo_tarjeta, dia_corte, dni, 
					CONCAT(SUBSTRING(tarjeta, 1, 4),' - ',SUBSTRING(tarjeta, 5, 4),' - ',SUBSTRING(tarjeta, 9, 4),' - ',SUBSTRING(tarjeta, 13, 4)) as tarjeta, 
					CAST(fecha_vto AS VARCHAR(12)) AS fecha_vto, estatus, CAST(fecha_estatus AS VARCHAR(12)) AS fecha_estatus, ultimo_procesado, 
					CAST(fecha_ultimo_procesado AS VARCHAR(12)) AS fecha_ultimo_procesado, CAST(fecha_ultimo_exitoso AS VARCHAR(12)) AS fecha_ultimo_exitoso, 
					reus, reus_arco, acumulado_exitosos, acumulado_rechazos, origen, nombre_agente
				FROM tmk.dbo.afiliados
				WHERE clafiltmk = " . $string_to_search_higienized_for_query . "";
			} else {
				// Devuelve los 4TDC formateados o enmascarados - Vista para el publico en general.
				$query = "SELECT TOP(1) cliente, asistencia, clafiltmk, identificador, CAST(fecha_venta AS VARCHAR(12)) AS fecha_venta, nombre_afiliado, 
					CAST(fecha_nacimiento AS VARCHAR(12)) AS fecha_nacimiento, tipo_tarjeta, dia_corte, dni, 
					CONCAT(REPLICATE('#### - ',3),SUBSTRING(tarjeta, 13, 4)) as tarjeta, 
					CAST(fecha_vto AS VARCHAR(12)) AS fecha_vto, estatus, CAST(fecha_estatus AS VARCHAR(12)) AS fecha_estatus, ultimo_procesado, 
					CAST(fecha_ultimo_procesado AS VARCHAR(12)) AS fecha_ultimo_procesado, CAST(fecha_ultimo_exitoso AS VARCHAR(12)) AS fecha_ultimo_exitoso, 
					reus, reus_arco, acumulado_exitosos, acumulado_rechazos, origen, nombre_agente
				FROM tmk.dbo.afiliados
				WHERE clafiltmk = " . $string_to_search_higienized_for_query . "";
			}
			// Obtiene detalles de procesamiento exitoso para el Lead Id.
			$query2 = "
		SELECT 
			CAST(fecha_procesado AS VARCHAR(12)) as fecha_procesado,
			CONCAT('$ ',monto) as monto,
			evento,
			autorizacion,
			origen, 
			estatus,
			CAST(fecha_estatus AS VARCHAR(12)) as fecha_estatus
		FROM tmk.dbo.procesados 
		WHERE (/*evento LIKE '%VENTAS%' AND*/ evento NOT LIKE '%-%') AND clafiltmk = " . $lead_id . "
		ORDER BY fecha_procesado DESC";
			$obj_conn_SQLSERVER = sqlsrv_connect(COBRANZASRVR, array('Database' => 'tmk', 'Uid' => COBRANZAUSER, 'PWD' => COBRANZAPWD));
			$obj_rst = sqlsrv_query($obj_conn_SQLSERVER, $query, array(), array("Scrollable" => SQLSRV_CURSOR_KEYSET));
			if ($obj_rst == FALSE) {
				die(errorConnSQLSRVR(sqlsrv_errors()));
			}
			$total_num_rst = sqlsrv_num_rows($obj_rst);
			while ($individual_rst = sqlsrv_fetch_array($obj_rst, SQLSRV_FETCH_ASSOC)) {
				$client_namee = $individual_rst['cliente'];
				$asistencia = $individual_rst['asistencia'];
				$lead_id = $individual_rst['clafiltmk'];
				$identificador = $individual_rst['identificador'];
				$fecha_venta = $individual_rst['fecha_venta'];
				$nombre_afiliado = $individual_rst['nombre_afiliado'];
				$fecha_nacimiento = $individual_rst['fecha_nacimiento'];
				$tipo_tarjeta = $individual_rst['tipo_tarjeta'];
				$dia_corte = $individual_rst['dia_corte'];
				$dni = $individual_rst['dni'];
				$tarjeta = $individual_rst['tarjeta'];
				$fecha_vto = $individual_rst['fecha_vto'];
				$estatus = $individual_rst['estatus'];
				switch ($estatus) {
					case 'CANCELADO';
						$section_icon = 'cancel';
						$section_icon_color = 'red';
						break;
					case 'CANCELADO';
						$section_icon = 'cancel';
						$section_icon_color = 'red';
						break;
					case 'TDC CANCELADA';
						$section_icon = 'report purple-text';
						$section_icon_color = 'purple';
						break;
					case 'INTENTOS';
						$section_icon = 'warning';
						$section_icon_color = 'blue';
						break;
					case 'CONTRACARGO';
						$section_icon = 'note-add';
						$section_icon_color = 'orange';
						break;
					case 'REINTEGRO';
						$section_icon = 'note-add';
						$section_icon_color = 'amber';
						break;
					case 'VENCIDO';
						$section_icon = 'warning';
						$section_icon_color = 'yellow';
						break;
					case 'RESERVAR';
						$section_icon = 'system-update';
						$section_icon_color = 'grey';
						break;
					default:
						$section_icon = "verified-user";
						$section_icon_color = 'teal';
						$estatus = 'ACTIVO';
						break;
				}
				$fecha_estatus = $individual_rst['fecha_estatus'];
				$ultimo_procesado = $individual_rst['ultimo_procesado'];
				$fecha_ultimo_procesado = $individual_rst['fecha_ultimo_procesado'];
				$fecha_ultimo_exitoso = $individual_rst['fecha_ultimo_exitoso'];
				$reus = $individual_rst['reus'];
				$reus_arco = $individual_rst['reus_arco'];
				$acumulado_exitosos = $individual_rst['acumulado_exitosos'];
				$acumulado_rechazos = $individual_rst['acumulado_rechazos'];
				$origen = $individual_rst['origen'];
				$nombre_agente = $individual_rst['nombre_agente'];
				$obj_rst_2 = sqlsrv_query($obj_conn_SQLSERVER, $query2, array(), array("Scrollable" => SQLSRV_CURSOR_KEYSET));
				if ($obj_rst_2 == FALSE) {
					die(errorConnSQLSRVR(sqlsrv_errors()));
				}
				$recaudo = getUniqueCountDecimalValueFromDB("SELECT SUM(monto) AS 'recaudo'  FROM tmk.dbo.procesados WHERE (evento LIKE '%VENTAS%' AND evento NOT LIKE '%-%') AND clafiltmk = " . $lead_id . "", "recaudo");
				$historico = '<a href="#!" class="collection-item ' . $section_icon_color . ' white-text"><br><h4 class="center-align">$ ' . $recaudo . '</h4></a>';
				while ($individual_rst_2 = sqlsrv_fetch_array($obj_rst_2, SQLSRV_FETCH_ASSOC)) {
					$fecha_procesado = $individual_rst_2['fecha_procesado'];
					$monto = $individual_rst_2['monto'];
					
					$origen_pago = $individual_rst_2['origen'];
					switch ($origen_pago) {
						case 'Payworks'; $origen_pago = 'Payworks'; break;
						default: $origen_pago = 'ConnectEnterprise'; break;
					}

					$evento = $individual_rst_2['evento'];
					switch ($evento) {

						case '00 VENTAS'; $color_evento = 'green lighten-5 black-text'; break;
						case '01 VENTAS'; $color_evento = 'green lighten-5 black-text'; break;

						case '05 RECHAZADA'; $color_evento = 'black-text'; break;
						case '51 FONDOS INSUFICIENTES'; $color_evento = 'black-text'; break;
						case '65 EXCEDE LIMITE DE DISPOSICIONES DIARIAS'; $color_evento = 'black-text'; break;
						case '87 RECHAZADA'; $color_evento = 'black-text'; break;
					  case '91 IMPOSIBLE AUTORIZAR EN ESTE MOMENTO'; $color_evento = 'black-text'; break;
						case 'N0 TRANSACCION NO PERMITIDA AL TARJETAHABIENTE'; $color_evento = 'black-text'; break;
						case 'T5 RECHAZAR'; $color_evento = 'black-text'; break;

						case '01 LLAMAR AL BANCO EMISOR'; $color_evento = 'black-text'; break;
						case '57 TRANSACCION NO PERMITIDA AL TARJETAHABIENTE'; $color_evento = 'black-text'; break;
						case '62 TARJETA RESTRINGIDA'; $color_evento = 'black-text'; break;
						case 'O6 RECHAZADA'; $color_evento = 'black-text'; break;

						case '0  DENEGADO'; $color_evento = 'black-text'; break;
					  case '14 NUMERO DE TARJETA INVALIDO'; $color_evento = 'black-text'; break;
						case '41 TARJETA EXTRAVIADA'; $color_evento = 'black-text'; break;
						case '56 TARJETA SIN REGISTRO'; $color_evento = 'black-text'; break;
						case '83 RECHAZADA'; $color_evento = 'black-text'; break;
						case 'N7 RECHAZADA'; $color_evento = 'black-text'; break;
					  case 'O8 RECHAZADA'; $color_evento = 'black-text'; break;
						
						default: $color_evento = ''; break;
					}
					/*$color_evento = '';*/
					$autorizacion = $individual_rst_2['autorizacion'];
					
					$estatus_intento = $individual_rst_2['estatus'];
					$fecha_estatus_intento = $individual_rst_2['fecha_estatus'];
					if ($autorizacion == !"") {
						if ($estatus_intento == !"") {
							$autorizacion = '<span class="new badge red">' . $monto . '    <b>' . $autorizacion . '</b>       <b>' . $estatus_intento . '</b>    ' . $origen_pago . '</span>';
						} else {
							$autorizacion = '<span class="new badge teal">' . $monto . '    <b>' . $autorizacion . '</b>       <b>' .
									$estatus_intento . '</b>    ' . $origen_pago . '</span>';
						}
					}
					$intento = '' . $fecha_procesado . ' ' . $autorizacion . ' <b>[' . $evento . ']</b> ';
					if ($historico == "") {
						$historico = '<a class="collection-item">' . $intento . '</a>';
					} else {
						$historico = $historico . '
										<a href="#!" class="collection-item ' . $color_evento . '">' . $intento . '</a>';
					}
				}
				sqlsrv_free_stmt($obj_rst_2);
				echo '
				<div class="">
					<div class="row section">
						<h4 class="truncate show-on-medium-and-down">' . $nombre_afiliado . '</h4>
						<div class="col l12 m12 s12">
							<div class="col l5 m12 s12">
								<h6>Datos de afiliado</h6>
								<div class="collection">
									<a href="#!" class="collection-item black-text">' . $tarjeta . '
										<span class="badge">
											<img class="prefix" src="' . GLOBALPATH . '/res/images/tdc/' . $client_namee . ' ' . $tipo_tarjeta . '.png" alt="' . $tipo_tarjeta . '" width="38px" height="auto">
										</span>
									</a>
									<a href="#!" class="collection-item black-text">Producto<span class="badge">' . $tipo_tarjeta . '</span></a>
									<a href="#!" class="collection-item black-text">Día de corte<span class="badge">' . $dia_corte . '</span></a>
								</div>
								<div class="collection">
									<a href="#!" class="collection-item black-text">Lead Id<span class="badge">' . $lead_id . '</span></a>
									<a href="#!" class="collection-item black-text">Identificador<span class="badge">' . $identificador . '</span></a>
									<a href="#!" class="collection-item black-text">Fecha venta<span class="badge">' . $fecha_venta . '</span></a>
									<a href="#!" class="collection-item black-text">Origen<span class="badge">' . $origen . '</span></a>
									<a href="#!" class="collection-item black-text">Agente<span class="badge">' . $nombre_agente . '</span></a>
								</div>
								<div class="collection">
									<a href="#!" class="collection-item black-text">Estatus<span class="badge ' . $section_icon_color . '-text">' . $estatus . ' ' . $fecha_estatus . '</span></a>
									<a href="#!" class="collection-item black-text">Cobros efectivos<span class="badge">' . $acumulado_exitosos . '</span></a>
									<a href="#!" class="collection-item black-text">Contador de rechazos<span class="badge">' . $acumulado_rechazos . '</span></a>
								</div>
							</div>
							<div class="col l7 m12 s12">
								<h6>Recurrencia</h6>
								<div class="collection with-header">
									<div class="inner-content">
									' . $historico . '
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
		';
			}
			sqlsrv_free_stmt($obj_rst);
			sqlsrv_close($obj_conn_SQLSERVER);

			?>

		</div>

	</main>

	<?php
	include_once '../footer.php';
	include_once '../jquery.php';
	?>

</body>

</html>