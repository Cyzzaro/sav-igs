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
			$identificador = $_GET['identificador'];
			
			$string_to_search = strip_tags($lead_id, ENT_QUOTES);
			$string_to_search_higienized_for_query = higienizeString($string_to_search);
			if ($_SERVER['REMOTE_ADDR'] == '::1' or $_SERVER['REMOTE_ADDR'] == '127.0.0.1') {
				// Devuelve el numero de TDC completo - Vista especial para quien administra cobranza de la cuenta.
				$query = "SELECT TOP(1) cliente, asistencia, clafiltmk, identificador, cast(fecha_venta as varchar(12)) fecha_venta, nombre_afiliado, 
					cast(fecha_nacimiento as varchar(12)) fecha_nacimiento, tipo_tarjeta, dia_corte, dni, 
					CONCAT(SUBSTRING(tarjeta, 1, 4),' - ',SUBSTRING(tarjeta, 5, 4),' - ',SUBSTRING(tarjeta, 9, 4),' - ',SUBSTRING(tarjeta, 13, 4)) as tarjeta, 
					cast(fecha_vto as varchar(12)) fecha_vto, estatus, cast(fecha_estatus as varchar(12)) fecha_estatus, ultimo_procesado, 
					cast(fecha_ultimo_procesado as varchar(12)) fecha_ultimo_procesado, cast(fecha_ultimo_exitoso as varchar(12)) fecha_ultimo_exitoso, 
					reus, reus_arco, acumulado_exitosos, acumulado_rechazos, origen, nombre_agente
				FROM tmk.dbo.afiliados
				WHERE clafiltmk = " . higienizeString($lead_id) . " AND identificador = " . higienizeString($identificador);
			} else {
				// Devuelve los 4TDC formateados o enmascarados - Vista para el publico en general.
				$query = "SELECT TOP(1) cliente, asistencia, clafiltmk, identificador, cast(fecha_venta as varchar(12)) fecha_venta, nombre_afiliado, 
					cast(fecha_nacimiento as varchar(12)) fecha_nacimiento, tipo_tarjeta, dia_corte, dni, 
					CONCAT(REPLICATE('#### - ',3),SUBSTRING(tarjeta, 13, 4)) as tarjeta, 
					cast(fecha_vto as varchar(12)) fecha_vto, estatus, cast(fecha_estatus as varchar(12)) fecha_estatus, ultimo_procesado, 
					cast(fecha_ultimo_procesado as varchar(12)) fecha_ultimo_procesado, cast(fecha_ultimo_exitoso as varchar(12)) fecha_ultimo_exitoso, 
					reus, reus_arco, acumulado_exitosos, acumulado_rechazos, origen, nombre_agente
				FROM tmk.dbo.afiliados
				WHERE clafiltmk = " . higienizeString($lead_id) . " AND identificador = " . higienizeString($identificador);
			}
			// Obtiene detalles de procesamiento exitoso para el Lead Id.
			$query2 = "
		SELECT 
			cast(fecha_procesado as varchar(12)) fecha_procesado,
			CONCAT('$ ',monto) as monto,
			evento,
			autorizacion,
			origen, 
			estatus,
			cast(fecha_estatus as varchar(12)) fecha_estatus
		FROM tmk.dbo.procesados 
		WHERE (evento LIKE '%VENTAS%' AND evento NOT LIKE '%-%') AND afiliado = (SELECT id FROM tmk.dbo.afiliados WHERE clafiltmk=" . $lead_id . " AND identificador = " . $identificador . ")
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
					case 'BAJA DEL SERVICIO (SAC)';
						$section_icon = 'cancel';
						$section_icon_color = 'deep orange';
						break;
					case 'BAJA DEL SERVICIO (SPONSOR)';
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
						$section_icon_color = 'deep orange';
						break;
					case 'REINTEGRO (SPONSOR)';
						$section_icon = 'note-add';
						$section_icon_color = 'deep orange';
						break;
					case 'RESERVAR';
						$section_icon = 'system-update';
						$section_icon_color = 'grey';
						break;
					case NULL;
						$section_icon = 'verified-user';
						$section_icon_color = 'green';
						$estatus = 'ACTIVO';
						break;	
					default:
						$section_icon = "verified-user";
						$section_icon_color = 'blue-grey';
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
				$recaudo = getUniqueCountDecimalValueFromDB("SELECT SUM(monto) AS 'recaudo'  FROM tmk.dbo.procesados WHERE (evento LIKE '%VENTAS%' AND evento NOT LIKE '%-%') AND afiliado=(SELECT id FROM tmk.dbo.afiliados WHERE clafiltmk=" . $lead_id . " AND identificador = " . $identificador . ")", "recaudo");
				$contracargado = getUniqueCountDecimalValueFromDB("SELECT SUM(monto) AS 'contracargado'  FROM tmk.dbo.procesados WHERE (evento LIKE '%VENTAS%' AND evento NOT LIKE '%-%' AND estatus IS NOT NULL ) AND afiliado=(SELECT id FROM tmk.dbo.afiliados WHERE clafiltmk=" . $lead_id . " AND identificador = " . $identificador . ")", "contracargado");
				switch ($contracargado) {
					case '0.00':
							$contracargado = '';
						break;
					
					default:
									$contracargado = '$ ' . $contracargado;
									$contracargado = '<a href="#!" class="collection-item black-text ' . $section_icon_color . ' lighten-4">Contracargado o devuelto<span class="badge black-text">' . $contracargado . '</span></a>';
						break;
				}



				//$historico = '<a href="#!" class="collection-item ' . $section_icon_color . ' white-text"><br><h4 class="center-align">$ ' . $recaudo . '</h4></a>';
				$historico = '<span>';
				while ($individual_rst_2 = sqlsrv_fetch_array($obj_rst_2, SQLSRV_FETCH_ASSOC)) {
					$fecha_procesado = $individual_rst_2['fecha_procesado'];
					$monto = $individual_rst_2['monto'];
					
					$origen_pago = $individual_rst_2['origen'];
					if (substr($origen_pago,0,2) == 'CE') {
						$origen_pago = 'ConnectEnterprise';
					} else {
						$origen_pago = $origen_pago;
					}
					$evento = $individual_rst_2['evento'];
					switch ($evento) {
						case '00 VENTAS';
						case '01 VENTAS'; $color_evento = 'black-text'; break;
						default: $color_evento = 'black-text'; break;
					}

					$autorizacion = $individual_rst_2['autorizacion'];
					
					$estatus_intento = $individual_rst_2['estatus'];
					$fecha_estatus_intento = $individual_rst_2['fecha_estatus'];
					if ($autorizacion == !"") {
						if ($estatus_intento == !"") {
							$autorizacion = '<span class="new badge red"><span class="hide-on-med-and-down">' . $origen_pago . '</span>   ' . $monto . '  <b>' . $autorizacion . '</b>  <b>' . $estatus_intento . '</b>  </span>';
						} else {
							$autorizacion = '<span class="new badge teal"><span class="hide-on-med-and-down">' . $origen_pago . '</span>   ' . $monto . '  <b>' . $autorizacion . '</b>  <b>' .
							$estatus_intento . '</b>  </span>';
						}
					}
					$intento = '' . $fecha_procesado . ' ' . $autorizacion . '    <b>' . $evento . '</b>    ';
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
							<div class="col l5 m6 s12">
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
								</div>
								<div class="collection">
									<a href="#!" class="collection-item black-text">Fecha venta<span class="badge">' . $fecha_venta . '</span></a>
									<a href="#!" class="collection-item black-text">Agente<span class="badge">' . $nombre_agente . '</span></a>
									<a href="#!" class="collection-item black-text">Origen<span class="badge">' . $origen . '</span></a>
								</div>
								<div class="collection">
									<a href="#!" class="collection-item black-text">Cobros efectivos<span class="badge">' . $acumulado_exitosos . '</span></a>
									<a href="#!" class="collection-item black-text">Contador de rechazos<span class="badge">' . $acumulado_rechazos . '</span></a>
									<a href="#!" class="collection-item black-text">Estatus<span class="badge ' . $section_icon_color . '-text">' . $estatus . ' (' . $fecha_estatus . ')</span></a>
								</div>
							</div>
							<div class="col l7 m6 s12">
								<h6>Recurrencia</h6>
								<div class="collection">	
									<a href="#!" class="collection-item ' . $section_icon_color . ' white-text"><h4 class="center-align">$ ' . $recaudo . '</h4></a>
									' . $contracargado . '
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