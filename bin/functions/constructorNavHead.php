
<?php 

	function navHead($titleNav) {

		echo '
			<!-- BEGIN TOP NAV HEAD PAGE 
				- Container para el encabezado de pagina
				- Span para el indicador de conexion con la Base de Datos -->
			<nav class="top-nav">
				<div class="container">
					<div class="nav-wrapper truncate">
						<a class="page-title">'.$titleNav.'</a>
					</div>
				</div>
			</nav>

			';
	}

?>