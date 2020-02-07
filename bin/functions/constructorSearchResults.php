
<?php 

	function searchResultsInfo($numRst, $toSearch, $idTableDown) {
		
		echo '
			<!-- QUERY.RST -->
			<div class="section">
				<div class="container row center">
					<h5 class="light header">
						<i class="material-icons tiny prefix blue-text">dns</i> '.$numRst.' resultado(s)
					</h5>
					<div class="fixed-action-btn horizontal">
						<a class="btn-floating btn-large" onclick="javascript:xport.toCSV('.$idTableDown.');"><i class="material-icons small">cloud_download</i></a>
					</div>
				</div>
			</div>
			';
	}
	
	function searchResultsHead($idTable) {
		
		echo '
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
	}
	
	function searchResultsRows($rst) {
		
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


//							<td><a href="/prod/pages/searchByClafi/toSearched.php?clafi='.$clafiltmk.'">'.$clafiltmk.'</a></td>

			echo '
						<!-- Resume Info -->
						<tr>
							<td>'.$fecha.'</td>
							<td><a class="modal-trigger" href="#lead_'.$clafiltmk.'">'.$clafiltmk.'</a></td>
							<td>'.$identificador.'</td>
							<td>'.$afiliado.'</td>
							<td><i class="material-icons tiny prefix">credit_card</i> '.$dni.'</td>
							<td><i class="material-icons '.$color.' tiny prefix">'.$icon.'</i> '.$estatus.'</td>
							<td>'.$fecha_estatus.'</td>
							<td>'.$ultimo_procesado.'</td>
							<td>'.$fecha_ultimo_procesado.'</td>
						</tr>';
						if ($_SERVER['SERVER_NAME'] == '192.168.12.205') {
							searchResultsModal($clafiltmk);
						} else {
							echo 'No puedes visualizar';
						}
		}		
	}
	
	function searchResultsEnd($idTable) {
		
		echo "
					</table>
				</div>
			</div>
			
			<!-- INITIALIZE DATA TABLES PLUG-IN FOR RESULTS
				-->
			<script>
				$(document).ready(
					function() {
						$('#".$idTable."').DataTable(
							{
								'paging': false,
								'ordering': true,
								'info': true,
							}
						);
					}
				);
			</script>				
			";	
	}
	
?>