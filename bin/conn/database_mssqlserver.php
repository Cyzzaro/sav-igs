<?php 




/**
 * SQL Server: Errores de ejecución.
 * 
 * Imprime un CardPanel que muestra al usuario los mensajes de error en detalle 
 * que lleguase a arrojar la ejecución de una consulta en SQL Server.
 * 
 * @param arrary $error Arreglo con los mensajes de error arrojados por la
 * ejecución de una consulta en SQL Server.
 * @return string CardPanel con listado de errores simple.
 */
function errorConnSQLSRVR($error) 
{
	$error_array = '';
	foreach($error as $error_item) {
		$error_array = $error_array . '
							<p>'.$error_item['message'].'</p>';
	}
	echo '
			<div class="row container">
				<div class="col l10 offset-l1 m10 offset-m1 s12">
					<div class="card red">
						<div class="card-content">
							<span class="card-title white-text">PARAMETROS INCORRECTOS</span>
							<p class="white-text">Si consideras que la información introducida es correcta, comparte un screen de 
							esta pantalla con el Administrador de la Base de Datos, para que te ayude a encontrar 
							una solución.</p>
						</div>
						<div class="card-action white">'.
						$error_array
						.'
						</div>
					</div>
				</div>
			</div>
	';
}




/**
 * SQL Server: Sin Resultados.
 * 
 * Imprime un CardPanel que alerta al usuario acerca de que la consulta ejecutada
 * no arroja resultados y que debe intentar mejorar los filtros o criterios.
 * 
 * @static
 * @return string CardPanel con sugerencias para mejorar la ejecución de la
 * consulta.
 */
function withNoResultsSQLSERVER()
{
	echo '
			<div class="row container">
				<div class="col l10 offset-l1 m10 offset-m1 s12">
					<div class="card orange">
						<div class="card-content">
							<span class="card-title">SIN RESULTADOS</span>
						</div>
						<div class="card-action white">
							<p>Intente nuevamente, refinando los criterios de busqueda o complementa la información acorde al tipo de dato que deseas obtener.</p>
						</div>
					</div>
				</div>
			</div>
	';
}




/**
 * SQL Server: Exceso de resultados.
 * 
 * Imprime un CardPanel que alerta al usuario acerca de que la consulta ejecutada
 * arroja demasiados resultados como para mostrarlos en pantalla y que debe 
 * intentar mejorar los filtros o criterios usados. 
 * 
 * @param string $total_num_rst Cantidad de resultados obtenidos por la ejecucion
 * de la consulta.
 * @return string CardPanel con sugerencias para mejorar la ejecución de la
 * consulta.
 */
function withToMuchResultsSQLSERVER($total_num_rst)
{
	echo '
			<div class="row container">
				<div class="col l10 offset-l1 m10 offset-m1 s12">
					<div class="card orange">
						<div class="card-content">
							<span class="card-title">DEMASIADAS COINCIDENCIAS</span>
						</div>
						<div class="card-action white">
							<p>Tu busqueda coincide con un total de <b>'.$total_num_rst.'</b> registros contenidos en la base.<br>
							Intenta nuevamente refinando los criterios.</p>
							<p>En caso de ser necesario, solicita un reporte especial al Administrador de la Base de Datos.</p>
						</div>
					</div>
				</div>
			</div>
	';	
}
	
?>