
<?php 

	function SQL_SRVR_FormatErrors($errors) {
		echo '
			<div class="row container">
				<div class="col l10 offset-l1 m10 offset-m1 s12">
					<div class="card amber black-text">
						<div class="card-content white-text">
							<span class="card-title red-text">ERROR EN LA CONSULTA</span>';
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
				<div class="col l10 offset-l1 m10 offset-m1 s12">
					<div class="card blue-grey">
						<div class="card-content">
							<span class="card-title">NO SE ENCUENTRA</span>
							<p class="white-text">Intente nuevamente.</p>
						</div>
					</div>
				</div>
			</div>
			';		
	}
	
	function withToMuchResults($numRegistros) {
			echo '
				<div class="row container">
					<div class="col l10 offset-l1 m10 offset-m1 s12">
						<div class="card deep-orange">
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