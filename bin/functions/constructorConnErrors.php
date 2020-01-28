
<?php 

	function SQL_SRVR_FormatErrors($errors) {
		echo '
			<div class="row container">
				<div class="col s12 m12">
					<div class="card blue white-text">
						<div class="card-content yellow-text">
							<span class="card-title white-text">ERROR EN LA CONSULTA</span>';
		foreach ($errors as $error) {
			echo '
							<p>Message: '.$error['message'].'<p>';
		}
		echo '
						</div>
					</div>
				</div>
			</div>';
	}
	
	function withNoResults() {
		echo '
			<div class="row container">
				<div class="col s12 m12">
					<div class="card blue-grey">
						<div class="card-content">
							<span class="card-title">NO SE ENCUENTRA</span>
							<p class="white-text">Intente nuevamente especificando el dato requerido o refinando los criterios.</p>
						</div>
					</div>
				</div>
			</div>
			';		
	}
	
	function withToMuchResults($numRegistros) {
			echo '
				<div class="row container">
					<div class="col s12 m12">
						<div class="card orange">
							<div class="card-content">
								<span class="card-title">DEMASIADAS COINCIDENCIAS</span>
								<p class="white-text">Tu busqueda coincide con un total de '.$numRegistros.' registros contenidos en la base.<br>
								Intenta nuevamente refinando los criterios o solicita un reporte especial al Administrador de la Base de Datos.</p>
							</div>
						</div>
					</div>
				</div>
				';
	}

?>