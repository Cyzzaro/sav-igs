
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
								<i class="material-icons prefix">account_circle</i>';

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
		
		
		$sql = "SELECT nombre_afiliado FROM tmk.dbo.afiliados WHERE nombre_afiliado LIKE '%".$toSearchDB."%'";
		
		$conn = sqlsrv_connect(COBRANZASRVR, array('Database' => 'tmk', 'Uid' => COBRANZAUSER, 'PWD' => COBRANZAPWD));
		$rst = sqlsrv_query($conn, $sql, array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET));
	
		if ($rst == FALSE) {
			die(SQL_SRVR_FormatErrors(sqlsrv_errors()));
		}
	
		$numRst = sqlsrv_num_rows($rst);

		
		if ($numRst == 0) {
			withNoResults();
		} elseif ($numRst > 0) {
			if ($numRst < 10000) {
				echo '
			
			<!-- QUERY.RST -->
			<div class="section">
				<div class="container row center">
					<h5 class="light header">
						<i class="material-icons tiny prefix blue-text">dns</i> '.$numRst.' resultado(s) para: '.$toSearch.'
						</h5>
				</div>
			</div>
			
			<div class="section">
				<div class="container row">
					<ul class="collapsible" data-collapsible="accordion">';

				while ($rstIterate = sqlsrv_fetch_array($rst, SQLSRV_FETCH_ASSOC)) { 
					$nombre_afiliado = $rstIterate['nombre_afiliado'];
					echo '
							<li>
							<div class="collapsible-header"><i class="material-icons">filter_drama</i>'.$nombre_afiliado.'</div>
							<div class="collapsible-body"><p>Lorem ipsum dolor sit amet.</p></div>
						</li>';
				}
				
				echo '
					</ul>
				</div>
			</div>
			';
			} else {
			withToMuchResults($numRst);
			}
		}
	}
		

	}
	
?>