
<?php 

	
	function searchResultsModal($clafiltmk) {

		$toSearch = strip_tags($clafiltmk,ENT_QUOTES);
		$toSearchDB = normalizeChars($toSearch);

		$sql = "
			SELECT TOP(1) 
				clafiltmk, 
				nombre_afiliado, 
				fecha_venta, 
				dni, 
				identificador, 
				estatus, 
				fecha_estatus, 
				ultimo_procesado, 
				fecha_ultimo_procesado ,
				tarjeta, 
				tipo_tarjeta  
			FROM 
				afiliados 
			WHERE 
				clafiltmk = ".$toSearchDB."";
		
		$conn = sqlsrv_connect(COBRANZASRVR, array('Database' => 'tmk', 'Uid' => COBRANZAUSER, 'PWD' => COBRANZAPWD));
		$rst = sqlsrv_query($conn, $sql, array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET));
	
		if ($rst == FALSE) {die(SQL_SRVR_FormatErrors(sqlsrv_errors()));}
	
		$numRst = sqlsrv_num_rows($rst);
			
		while ($rstRow = sqlsrv_fetch_array($rst, SQLSRV_FETCH_ASSOC)) { 
			$afiliado = $rstRow['nombre_afiliado'];
			$dni = $rstRow['dni'];
			if ($rstRow['fecha_venta']) {
				$fecha = $rstRow['fecha_venta']->format('Y/m/d');
			} else {
				$fecha = '';
			}
			$clafiltmk = $rstRow['clafiltmk'];
			$identificador = $rstRow['identificador'];
			$estatus = $rstRow['estatus'];
			if ($rstRow['fecha_estatus']) {
				$fecha_estatus = $rstRow['fecha_estatus']->format('Y/m/d');
			} else {
				$fecha_estatus = '';
			}
			$ultimo_procesado = $rstRow['ultimo_procesado'];
			if ($rstRow['fecha_ultimo_procesado']) {
				$fecha_ultimo_procesado = $rstRow['fecha_ultimo_procesado']->format('Y/m/d');
			} else {
				$fecha_ultimo_procesado = '';
			}
			$tarjeta = $rstRow['tarjeta'];
			$tipo_tarjeta = $rstRow['tipo_tarjeta'];

	
			$ultimo_procesado = substr($ultimo_procesado,3);
	
			if ($estatus == "CANCELADO") {
				$icon = 'cancel';
				$color = 'red-text';
			} elseif ($estatus == "TDC CANCELADA") {
				$icon = 'report';
				$color = 'purple-text';
			} elseif ($estatus == "INTENTOS") {
				$icon = 'warning';
				$color = 'light-blue-text';
			} elseif ($estatus == "CONTRACARGO") {
				$icon = 'note_add';
				$color = 'deep-orange-text';
			} elseif ($estatus == "REINTEGRO") {
				$icon = 'note_add';
				$color = 'orange-text';
			} elseif ($estatus == "RESERVAR") {
				$icon = 'pause';
				$color = 'grey-text';
			} else {
				$icon = 'verified_user';
				$color = 'green-text';
				$estatus = 'ACTIVO';
			}
	
			$ultimo_procesado = $ultimo_procesado;
			if ($ultimo_procesado == 'VTAS') {
				$ultimo_procesado = '<i class="material-icons green-text tiny prefix">account_balance_wallet</i> '.$ultimo_procesado;
			} elseif ($ultimo_procesado == 'F.INS') {
				$ultimo_procesado = '<i class="material-icons blue-text tiny prefix">account_balance_wallet</i> '.$ultimo_procesado;
			} elseif ($ultimo_procesado == 'RZDA') {
				$ultimo_procesado = '<i class="material-icons amber-text tiny prefix">account_balance_wallet</i> '.$ultimo_procesado;
			} elseif ($ultimo_procesado == 'RCHZ') {
				$ultimo_procesado = '<i class="material-icons amber-text tiny prefix">account_balance_wallet</i> '.$ultimo_procesado;
			} elseif ($ultimo_procesado == 'T.RST') {
				$ultimo_procesado = '<i class="material-icons grey-text tiny prefix">account_balance_wallet</i> '.$ultimo_procesado;
			} elseif ($ultimo_procesado == 'T.EXT') {
				$ultimo_procesado = '<i class="material-icons grey-text tiny prefix">account_balance_wallet</i> '.$ultimo_procesado;
			} elseif ($ultimo_procesado == 'L.BEM') {
				$ultimo_procesado = '<i class="material-icons red-text tiny prefix">account_balance_wallet</i> '.$ultimo_procesado;
			} elseif ($ultimo_procesado == 'TNP') {
				$ultimo_procesado = '<i class="material-icons red-text tiny prefix">account_balance_wallet</i> '.$ultimo_procesado;
			} elseif ($ultimo_procesado == '') {
				$ultimo_procesado = $ultimo_procesado;
			}
			

			echo '
						<!-- Detailed Info -->
						<div id="lead_'.$clafiltmk.'" class="modal modal-fixed-footer">
							<div class="modal-content">
								<h4>'.$afiliado.'</h4>
								<p>Tarjeta: '.$tarjeta.'</p>
								<p><img src="../../res/images/tdc/'.$tipo_tarjeta.'.png" width="auto" height="auto" alt="'.$tipo_tarjeta.'"></p>
							</div>
							<div class="modal-footer">
							<a href="#!" class="modal-action modal-close waves-effect btn-flat ">Cerrar</a>
							</div>
						</div>
						';

		}
						
	}


?>