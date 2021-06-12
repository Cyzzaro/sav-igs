<?php

/**
 * Genera encabezado con boton para descarga CSV de los resultados obtenidos en Tabla.
 * 
 * @param string $total_num_rst Total de registros obtenidos.
 * @param string $string_to_search Parametro de busqueda utilizado.
 * @param string $table_results_name_download_plugin Nombre de la tabla que se habilito para descarga CSV.
 * @return string Row con opciones y boton para descarga CSV.
 */
function infoGeneralResultsTable($total_num_rst, $string_to_search, $table_results_name_download_plugin)
{
	echo '
			<div class="fixed-action-btn">
				<a class="btn-floating btn-large waves-effect waves-light" onclick="javascript:xport.toCSV(' . $table_results_name_download_plugin . ');"><i class="material-icons small">cloud_download</i></a>
			</div>
	';
}




/**
 * Genera encabezado que muestra parametros seleccionados de consulta y un boton
 * para descarga CSV de los resultados obtenidos en Tabla.
 * 
 * @param string $query_criteria_filter Criterio de filtro para Query.
 * @param string $query_criteria_filter_date Criterio de fecha para Query.
 * @param integer $total_num_rst Total de registros obtenidos por Query.
 * @param string $table_results_name_download_plugin Nombre de tabla para habilitar Download Plugin.
 * @return string Encabezado general para tabla con resultados de busqueda.
 */
function infoGeneralDetailTable($query_criteria_filter, $query_date_filter, $total_num_rst, $table_results_name_download_plugin)
{
	echo '
			<div class="section">
				<div class="section row container">
					<div class="col l3 m3 s12 center-align btn-flat">
						Detalle: <b>' . $query_criteria_filter . '</b>
					</div>
					<div class="col l3 m3 s12 center-align btn-flat">
						Periodo: <b>' . $query_date_filter . '</b>
					</div>
					<div class="col l3 m3 s12 center-align btn-flat">
						Registros: <b>' . $total_num_rst . '</b>
					</div>
					<a onclick="javascript:xport.toCSV(' . $table_results_name_download_plugin . ');">
					<div class="col l3 m3 s12 center-align">
						<i class="material-icons small">cloud_download</i>
					</div>
					</a>
				</div>
			</div>
			<div class="row">&nbsp;</div>
	';
}




/**
 * Encabezado general para Tabla con resultados de busqueda. (Layout general)
 * 
 * @param string $table_results_name Nombre para tabla de resultados.
 * @return string Head de tabla para resultados de busqueda.
 */
function headRowGeneralResultsTable($table_results_name)
{
	echo '
			<div class="section container row">
				<!-- <div class="container row"> -->
					<table id="' . $table_results_name . '" class="table responsive-table bordered hoverable card-panel">
						<thead class="' . activePagePrimaryColor() . ' white-text bold">
							<tr>
								<th>FECHA(VT)</th>
								<th>LEADID</th>
								<th>IDENTIFICADOR</th>
								<th>NOMBRE</th>
								<th>4TDC</th>
								<th>ESTATUS</th>
								<th>FECHA(ST)</th>
								<th>PROCESADO</th>
								<th>FECHA(PR)</th>
								<th>EXITOSOS($)</th>
								<th>ULTIMO($)</th>
								<th>AGENTE</th>
							</tr>
						</thead>
	';
}




/**
 * Genera arreglo para filas de tabla con la informacion obtenida de Query.
 * 
 * @param string $obj_rst Objeto que almacena los registros obtenidos de la Query.
 * @param string $modal (Opcional) Muestra detalles del Lead Id en un Modal.
 * @return string Modal Lead Info.
 */
function rowsGeneralResultsTable($obj_rst, $modal)
{
	while ($individual_rst = sqlsrv_fetch_array($obj_rst, SQLSRV_FETCH_ASSOC)) {
		$afiliado = $individual_rst['nombre_afiliado'];
		$dni = $individual_rst['dni'];
		if ($individual_rst['fecha_venta']) {
			$fecha = $individual_rst['fecha_venta']->format('Y/m/d');
		} else {
			$fecha = '';
		}
		$lead_id = $individual_rst['clafiltmk'];
		$identificador = $individual_rst['identificador'];
		$estatus = $individual_rst['estatus'];
		if ($individual_rst['fecha_estatus']) {
			$fecha_estatus = $individual_rst['fecha_estatus']->format('Y/m/d');
		} else {
			$fecha_estatus = '';
		}
		$ultimo_procesado = $individual_rst['ultimo_procesado'];
		if ($individual_rst['fecha_ultimo_procesado']) {
			$fecha_ultimo_procesado = $individual_rst['fecha_ultimo_procesado']->format('Y/m/d');
		} else {
			$fecha_ultimo_procesado = '';
		}
		if ($individual_rst['fecha_ultimo_exitoso']) {
			$fecha_ultimo_exitoso = $individual_rst['fecha_ultimo_exitoso']->format('Y/m/d');
		} else {
			$fecha_ultimo_exitoso = '';
		}
		$acumulado_exitosos = $individual_rst['acumulado_exitosos'];
		$nombre_agente = $individual_rst['nombre_agente'];
		//		$ultimo_procesado = substr($ultimo_procesado,3);
		if ($estatus == "BAJA DEL SERVICIO (SAC)") {
			$section_icon = 'cancel';
			$color = 'red-text';
		} elseif ($estatus == "BAJA DEL SERVICIO (SPONSOR)") {
			$section_icon = 'cancel';
			$color = 'red-text';
		} elseif ($estatus == "TDC CANCELADA") {
			$section_icon = 'report';
			$color = 'purple-text';
		} elseif ($estatus == "INTENTOS") {
			$section_icon = 'warning';
			$color = 'light-blue-text';
		} elseif ($estatus == "CONTRACARGO") {
			$section_icon = 'note_add';
			$color = 'deep-orange-text';
		} elseif ($estatus == "REINTEGRO") {
			$section_icon = 'note_add';
			$color = 'orange-text';
		} elseif ($estatus == "RESERVAR") {
			$section_icon = 'pause';
			$color = 'grey-text';
		} elseif ($estatus == "MES GRATIS") {
			$section_icon = 'pause';
			$color = 'grey-text';
		} else {
			$section_icon = 'verified_user';
			$color = 'green-text';
			$estatus = 'ACTIVO';
		}

		if ($modal == True) {
			$lead_detail = '<a href="' . GLOBALPATH . '/bin/sections/lead_info_alt.php?lead_id=' . $lead_id . '&identificador=' . $identificador . '" target="new">' . $lead_id . '</a>';
		} else {
			$lead_detail = $lead_id;
		}
		echo '
						<tr>
							<td>' . $fecha . '&nbsp;</td>
							<td>' . $lead_detail . '&nbsp;</td>
							<td>' . $identificador . '&nbsp;</td>
							<td>' . $afiliado . '&nbsp;</td>
							<td>' . $dni . '&nbsp;</td>
							<td><span class="' . $color . ' ">' . $estatus . '</span></td>
							<td>' . $fecha_estatus . '&nbsp;</td>
							<td>' . $ultimo_procesado . '&nbsp;</td>
							<td>' . $fecha_ultimo_procesado . '&nbsp;</td>
							<td>' . $acumulado_exitosos . '&nbsp;</td>
							<td>' . $fecha_ultimo_exitoso . '&nbsp;</td>
							<td>' . $nombre_agente . '&nbsp;</td>
						</tr>
		';
	}
}




/**
 * Cierre para tabla de resultados obtenidos por Query.
 * 
 * @param string $table_results_name Nombre para tabla de resultados.
 * @param string $is_paging Define estado de paginación en tabla.
 * @return string Cierre de tabla de resultados.
 */
function endGeneralResultsTable($table_results_name, $is_paging)
{
	echo "
					</table>
				<!-- </div> -->
			</div>
			<script>
				$(document).ready(
					function()
					{
						$('#" . $table_results_name . "').DataTable(
							{
								'paging': false,
								'ordering': false,
								'info': true,
								'filter': true,
							}
						);
					}
				);
			</script>				
	";
}
