
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
								<i class="material-icons prefix">person_pin</i> ';

		if (isset($_POST['nombre_afiliado'])) {
			$toSearch = $_POST['nombre_afiliado'];		
			echo '
								<input id="nombre_afiliado" type="text" class="validate" autofocus="autofocus" name="nombre_afiliado" value="'.$toSearch.'">';
		} else {
			echo '
								<input id="nombre_afiliado" type="text" class="validate" name="nombre_afiliado" value="">';
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
				
		if (isset($_POST['nombre_afiliado'])) {
			

			$toSearch = strip_tags($_POST['nombre_afiliado'],ENT_QUOTES);
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
				
			} elseif ($numRst > 0) {
				
				if ($numRst < 10000) {
					
					$idTable = str_replace(",","",str_replace(" ","_",$toSearch."_".$numRst));
					$idTableDown = "'".$idTable."'";
					
					searchResultsInfo($numRst, $toSearch, $idTableDown);
					searchResultsHead($idTable);
					searchResultsRows($rst);
					searchResultsEnd($idTable);
					
				} else {

					withToMuchResults($numRst);

				}
			}
		}
	}

	function formSearchById($toSearch) {
		
		/* Formulario de busqueda por identificador */
		echo '
			<!-- BEGIN FORM SEARCH -->
			<div class="section">
				<div class="container row center">
					<h3 class="light header">Ubicar por identificador</h3>
					<p class="caption">
						Ingresa el identificador asignado por el cliente al afiliado.<br>
						En caso de consultas multiples puedes ingresar identificadores separados por coma (,).
					</p>
					<div class="row valign-wrapper">
						<form class="col l10 offset-l1 m10 offset-m1 s12" action="'.$_SERVER['PHP_SELF'].'" method="POST">
							<div class="input-field col l11 m10 s10">
								<i class="material-icons prefix">how_to_reg</i> ';

		if (isset($_POST['identificador'])) {
			$toSearch = $_POST['identificador'];		
			echo '
								<input id="nombre_afiliado" type="text" class="validate" autofocus="autofocus" name="identificador" value="'.$toSearch.'">';
		} else {
			echo '
								<input id="nombre_afiliado" type="text" class="validate" name="identificador" value="">';
		}
								
		echo '
								<label for="identificador">Identificador de afiliado</label>
							</div>
							<button class="col l1 m2 s2 btn-large waves-effect waves-light" type="submit" name="action">
								<i class="material-icons prefix">search</i> 
							</button>

						</form>
					</div>
				</div>
			</div>
			';
				
		if (isset($_POST['identificador'])) {
			
			$toSearch = strip_tags($_POST['identificador'],ENT_QUOTES);
			$toSearchDB = $toSearch;

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
					identificador IN (".$toSearchDB.")";
			
			$conn = sqlsrv_connect(COBRANZASRVR, array('Database' => 'tmk', 'Uid' => COBRANZAUSER, 'PWD' => COBRANZAPWD));
			$rst = sqlsrv_query($conn, $sql, array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET));
		
			if ($rst == FALSE) {die(SQL_SRVR_FormatErrors(sqlsrv_errors()));}
		
			$numRst = sqlsrv_num_rows($rst);

			if ($numRst == 0) {
				
				withNoResults();
				
			} elseif ($numRst > 0) {
				
				if ($numRst < 10000) {
					
					$idTable = str_replace(",","",str_replace(" ","_",$toSearch."_".$numRst));
					$idTableDown = "'".$idTable."'";
					
					searchResultsInfo($numRst, '', $idTableDown);
					searchResultsHead($idTable);
					searchResultsRows($rst);
					searchResultsEnd($idTable);
					
				} else {

					withToMuchResults($numRst);

				}
			}
		}
	}
	

?>