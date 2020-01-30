
<?php 

	function formSearchByName ($toSearch) {
		
		/* Formulario de busqueda por nombre */
		echo '
			<!-- BEGIN FORM SEARCH -->
			<div class="section">
				<div class="container row center">
					<h3 class="light header">Ubicar por nombre</h3>
					<p class="caption">
						Para obtener mejores resultados se recomienda ingresar el nombre completo.<br>
						En caso de no contar con el, puedes ingresar los apellidos o porciones del nombre.
					</p>
					<div class="row valign-wrapper">
						<form class="col l10 offset-l1 m10 offset-m1 s12" action="'.$_SERVER['PHP_SELF'].'" method="POST">
							<div class="input-field col l11 m10 s10">
								<i class="material-icons prefix">account_circle</i> ';

		if (isset($_POST['dato'])) {
			$toSearch = $_POST['dato'];		
			echo '
								<input id="nombre_afiliado" type="text" class="validate" autofocus="autofocus" name="dato" value="'.$toSearch.'">';
		} else {
			echo '
								<input id="nombre_afiliado" type="text" class="validate" name="dato" value="">';

		}
								
		echo '
								<label for="nombre_afiliado">Nombre de afiliado</label>
							</div>
							<button class="col l1 m2 s2 btn-large waves-effect waves-light" type="submit" name="action">
								<i class="material-icons prefix">search</i> 
							</button>

						</form>
					</div>
				</div>
			</div>
			';
			
	/* Desencadenador de busqueda por auto-invocacion */
	if (isset($_POST['dato'])) {
		
		$toSearch = $_POST['dato'];
		$toSearchDB = normalizeChars($toSearch);

		$sql = "
			SELECT 
				clafiltmk, 
				nombre_afiliado, 
				fecha_venta, 
				dni, 
				identificador, 
				estatus, 
				fecha_estatus, 
				ultimo_procesado, 
				fecha_ultimo_procesado 
			FROM 
				afiliados 
			WHERE 
				nombre_afiliado LIKE '%".$toSearchDB."%'";
		
		$conn = sqlsrv_connect(COBRANZASRVR, array('Database' => 'tmk', 'Uid' => COBRANZAUSER, 'PWD' => COBRANZAPWD));
		$rst = sqlsrv_query($conn, $sql, array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET));
	
		if ($rst == FALSE) {die(SQL_SRVR_FormatErrors(sqlsrv_errors()));}
	
		$numRst = sqlsrv_num_rows($rst);

		if ($numRst == 0) {
			
			withNoResults();
			
		} elseif ($numRst > 0) 
		
		{
			
		if ($numRst < 10000) {
			
		$idTable = str_replace(" ","_",$toSearch."_".$numRst);
		$idTableDown = "'".$idTable."'";
		
		echo '
			<!-- QUERY.RST -->
			<div class="section">
				<div class="container row center">
					<h5 class="light header">
						<i class="material-icons tiny prefix blue-text">dns</i> '.$numRst.' resultado(s) para: '.$toSearch.'
					</h5>
					<a class="btn-floating blue" onclick="javascript:xport.toCSV('.$idTableDown.');"><i class="material-icons small">cloud_download</i></a>
				</div>
			</div>
						
			<div class="section">
				<div class="container row">
					<table id="'.$idTable.'" class="mdl-data-table">
						<thead>
							<tr>
								<th>VENTA</th>
								<th>LEAD</th>
								<th>ID</th>
								<th>NOMBRE</th>
								<th>DNI</th>
								<th>ESTATUS</th>
								<th>FECHA (ST)</th>
								<th>PROCESADO</th>
								<th>FECHA (PR)</th>
							</tr>
						</thead>
			
			';

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
						<tr>
							<td>'.$fecha.'</td>
							<td><a href="/prod/pages/searchByClafi/toSearched.php?clafi='.$clafiltmk.'">'.$clafiltmk.'</a></td>
							<td>'.$identificador.'</td>
							<td>'.$afiliado.'</td>
							<td><i class="material-icons tiny prefix">credit_card</i> '.$dni.'</td>
							<td><i class="material-icons '.$color.' tiny prefix">'.$icon.'</i> '.$estatus.'</td>
							<td>'.$fecha_estatus.'</td>
							<td>'.$ultimo_procesado.'</td>
							<td>'.$fecha_ultimo_procesado.'</td>
						</tr>';
			}

			echo "
					</table>
				</div>
			</div>
			<script>
				$(document).ready(function() {
					$('#".$idTable."').DataTable( {
						'paging':   false,
						'ordering': true,
						'info':     true,
					} );
				} );
			</script>				
			";
			
		} else {
				
				withToMuchResults($numRst);
				
		}
		}
	}
		

	}
	
?>