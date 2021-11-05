<?php



/**
 * NavHead.
 * 
 * Genera encabezado de pagina o NavHead con titulo personalizado.
 * 
 * @param string $nav_title Titulo de pagina.
 * @return string Encabezado con titulo.
 */
function pageNavHead($nav_title)
{
	if (isset($nav_title))
	{
		$nav_title = strtoupper($nav_title);
	} else {
		$nav_title = strtoupper(str_replace('_', ' ', activePageName()));
	}
	echo '
			<nav class="top-nav '.activePagePrimaryColor().'">
				<div class="container">
					<div class="nav-wrapper truncate">
						<a class="page-title">'.$nav_title.'</a>
					</div>
				</div>
			</nav>
	';
}




/**
 * Buscar por nombre.
 * 
 * Imprime en pantalla el formulario de busqueda por Nombre, asi como 
 * los resultados acorde a los criterios indicados por el usuario
 * 
 * @param string $string_to_search Dato a buscar.
 * @return string Formulario de busqueda por nombre.
 */
function formToSearchByName($string_to_search)
{
	if (isset($_GET['nombre_afiliado']))
	{
		$string_to_search = $_GET['nombre_afiliado'];		
		$field_for_data_to_search = '
								<input id="nombre_afiliado" type="text" class="validate" autofocus="autofocus" name="nombre_afiliado" value="'.$string_to_search.'">';
	} else {
		$field_for_data_to_search = '
								<input id="nombre_afiliado" type="text" class="validate" name="nombre_afiliado" value="">';
	}
	echo '
			<div class="section">
				<div class="container row center">
					<p class="caption">
						Para obtener mejores resultados se recomienda ingresar el nombre completo.<br>
						En caso de no contar con el, puedes ingresar los apellidos o porciones del nombre.
					</p>
					<div class="row valign-wrapper">
						<form class="col l6 offset-l3 m8 offset-m2 s12" action="'.$_SERVER['PHP_SELF'].'" method="GET">
							<div class="input-field col s12">
								<i class="material-icons prefix">person_pin</i>'.
								$field_for_data_to_search 
								.'<label for="nombre_afiliado">Nombre de afiliado</label>
							</div>
						</form>
					</div>
				</div>
			</div>
	';
	if (isset($_GET['nombre_afiliado']))
	{
		$string_to_search = strip_tags($_GET['nombre_afiliado'],ENT_QUOTES);
		$string_to_search_higienized_for_query = higienizeString($string_to_search);
		$query = "
			SELECT 
				id, cliente, asistencia, clafiltmk, nombre_afiliado, fecha_venta, dni, identificador, estatus, fecha_estatus, ultimo_procesado, fecha_ultimo_procesado, fecha_ultimo_exitoso, acumulado_exitosos, nombre_agente  
			FROM tmk.dbo.afiliados 
			WHERE nombre_afiliado LIKE '%".$string_to_search_higienized_for_query."%'";
		$obj_conn_params_SQLSERVER = array('Database' => COBRANZABD, 'Uid' => COBRANZAUSER, 'PWD' => COBRANZAPWD);
		$obj_conn_SQLSERVER = sqlsrv_connect(COBRANZASRVR, $obj_conn_params_SQLSERVER);
		$obj_rst_aditional_params_SQLSERVER = array();
		$obj_rst_optionals_SQLSERVER = array('Scrollable'=>SQLSRV_CURSOR_KEYSET);	
		$obj_rst = sqlsrv_query($obj_conn_SQLSERVER, $query, $obj_rst_aditional_params_SQLSERVER, $obj_rst_optionals_SQLSERVER);
		if ($obj_rst == FALSE)
		{die(errorConnSQLSRVR(sqlsrv_errors()));}
		$total_num_rst = sqlsrv_num_rows($obj_rst);
		if ($total_num_rst == 0)
		{
			withNoResultsSQLSERVER(); 
		} elseif ($total_num_rst > 0)
		{
			if ($total_num_rst < 10000)
			{
				$table_results_name = str_replace(",","",str_replace(" ","_", $string_to_search."_".$total_num_rst));
				$table_results_name_download_plugin = "'".$table_results_name."'";
				infoGeneralResultsTable($total_num_rst, $string_to_search, $table_results_name_download_plugin);
				headRowGeneralResultsTable($table_results_name);
				rowsGeneralResultsTable($obj_rst,true);
				endGeneralResultsTable($table_results_name, 'true');
			} else {
				withToMuchResultsSQLSERVER($total_num_rst); 
			}
		}
		sqlsrv_free_stmt($obj_rst);
		sqlsrv_close($obj_conn_SQLSERVER);
	}
}




/**
 * Buscar por LeadID.
 * 
 * Imprime en pantalla el formulario de busqueda por Identificador, asi como 
 * los resultados acorde a los criterios indicados por el usuario.
 * 
 * 	@param string $string_to_search Lead Id de afiliado.
 * 	@return string Formulario de busqueda por Lead Id.
 */
function formToSearchByLeadId($string_to_search)
{
	if (isset($_GET['lead_id']))
	{
		$string_to_search = $_GET['lead_id'];		
		$field_for_data_to_search = '
								<input id="lead_id" type="text" class="validate" autofocus="autofocus" name="lead_id" value="'.$string_to_search.'">';
	} else {
		$field_for_data_to_search = '
								<input id="lead_id" type="text" class="validate" name="lead_id" value="">';
	}
	echo '
			<div class="section">
				<div class="container row center">
					<p class="caption">
						Ingresa el Lead ID asignado al afiliado en registro de Venta de ViciDial.<br>
						En caso de consultas multiples puedes ingresar Leads separados por coma (,).
					</p>
					<div class="row valign-wrapper">
						<form class="col l6 offset-l3 m8 offset-m2 s12" action="'.$_SERVER['PHP_SELF'].'" method="GET">
							<div class="input-field col s12">
								<i class="material-icons prefix">how_to_reg</i>'.
								$field_for_data_to_search 
								.'<label for="lead_id">Lead ID de afiliado</label>
							</div>
						</form>
					</div>
				</div>
			</div>
			';
	if (isset($_GET['lead_id']))
	{
		$string_to_search = strip_tags($_GET['lead_id'],ENT_QUOTES);
		$string_to_search_higienized_for_query = $string_to_search;
		$query = "
			SELECT 
				id, cliente, asistencia, clafiltmk, nombre_afiliado, fecha_venta, dni, identificador, estatus, fecha_estatus, ultimo_procesado, fecha_ultimo_procesado, fecha_ultimo_exitoso, acumulado_exitosos, nombre_agente  
			FROM tmk.dbo.afiliados 
			WHERE clafiltmk IN (".$string_to_search_higienized_for_query.")";
		$obj_conn_params_SQLSERVER = array('Database' => COBRANZABD, 'Uid' => COBRANZAUSER, 'PWD' => COBRANZAPWD);
		$obj_conn_SQLSERVER = sqlsrv_connect(COBRANZASRVR, $obj_conn_params_SQLSERVER);
		$obj_rst_aditional_params_SQLSERVER = array();
		$obj_rst_optionals_SQLSERVER = array('Scrollable'=>SQLSRV_CURSOR_KEYSET);	
		$obj_rst = sqlsrv_query($obj_conn_SQLSERVER, $query, $obj_rst_aditional_params_SQLSERVER, $obj_rst_optionals_SQLSERVER);
		if ($obj_rst == FALSE)
		{die(errorConnSQLSRVR(sqlsrv_errors()));}
		$total_num_rst = sqlsrv_num_rows($obj_rst);
		if ($total_num_rst == 0)
		{
			withNoResultsSQLSERVER(); 
		} elseif ($total_num_rst > 0)
		{
			if ($total_num_rst < 10000)
			{
				$table_results_name = str_replace(",","",str_replace(" ","_","VARIOS_".$total_num_rst));
				$table_results_name_download_plugin = "'".$table_results_name."'";
				infoGeneralResultsTable($total_num_rst, '', $table_results_name_download_plugin);
				headRowGeneralResultsTable($table_results_name);
				rowsGeneralResultsTable($obj_rst,true);
				endGeneralResultsTable($table_results_name, 'true');
			} else {
				withToMuchResultsSQLSERVER($total_num_rst);
			}
		}
		sqlsrv_free_stmt($obj_rst);
		sqlsrv_close($obj_conn_SQLSERVER);
	}
}




/**
 * Buscar por Identificador.
 * 
 * Imprime en pantalla el formulario de busqueda por Identificador, asi como 
 * los resultados acorde a los criterios indicados por el usuario.
 * 
 * @param string $string_to_search Identificador de afiliado.
 * @return string Formulario de busqueda por identificador.
 */
function formToSearchByIdentificador($string_to_search)
{
	if (isset($_GET['identificador']))
	{
		$string_to_search = $_GET['identificador'];		
		$field_for_data_to_search = '
								<input id="identificador" type="text" class="validate" autofocus="autofocus" name="identificador" value="'.$string_to_search.'">';
	} else {
		$field_for_data_to_search = '
								<input id="identificador" type="text" class="validate" name="identificador" value="">';
	}
	echo '
			<div class="section">
				<div class="container row center">
					<p class="caption">
						Ingresa el identificador asignado por el cliente al afiliado.<br>
						En caso de consultas multiples puedes ingresar identificadores separados por coma (,).
					</p>
					<div class="row valign-wrapper">
						<form class="col l6 offset-l3 m8 offset-m2 s12" action="'.$_SERVER['PHP_SELF'].'" method="GET">
							<div class="input-field col s12">
								<i class="material-icons prefix">how_to_reg</i>'.
								$field_for_data_to_search 
								.'<label for="identificador">Identificador de afiliado</label>
							</div>
						</form>
					</div>
				</div>
			</div>
	';
	if (isset($_GET['identificador']))
	{
		$string_to_search = strip_tags($_GET['identificador'],ENT_QUOTES);
		$string_to_search_higienized_for_query = $string_to_search;
		$query = "
			SELECT 
				id, cliente, asistencia, clafiltmk, nombre_afiliado, fecha_venta, dni, identificador, estatus, fecha_estatus, ultimo_procesado, fecha_ultimo_procesado, fecha_ultimo_exitoso, acumulado_exitosos, nombre_agente  
			FROM tmk.dbo.afiliados 
			WHERE identificador IN (".$string_to_search_higienized_for_query.")";
		$obj_conn_params_SQLSERVER = array('Database' => COBRANZABD, 'Uid' => COBRANZAUSER, 'PWD' => COBRANZAPWD);
		$obj_conn_SQLSERVER = sqlsrv_connect(COBRANZASRVR, $obj_conn_params_SQLSERVER);
		$obj_rst_aditional_params_SQLSERVER = array();
		$obj_rst_optionals_SQLSERVER = array('Scrollable'=>SQLSRV_CURSOR_KEYSET);	
		$obj_rst = sqlsrv_query($obj_conn_SQLSERVER, $query, $obj_rst_aditional_params_SQLSERVER, $obj_rst_optionals_SQLSERVER);
		if ($obj_rst == FALSE)
		{die(errorConnSQLSRVR(sqlsrv_errors()));}
		$total_num_rst = sqlsrv_num_rows($obj_rst);
		if ($total_num_rst == 0)
		{
			withNoResultsSQLSERVER(); 
		} elseif ($total_num_rst > 0)
		{
			if ($total_num_rst < 10000)
			{
				$table_results_name = str_replace(",","",str_replace(" ","_","VARIOS_".$total_num_rst));
				$table_results_name_download_plugin = "'".$table_results_name."'";
				infoGeneralResultsTable($total_num_rst, '', $table_results_name_download_plugin);
				headRowGeneralResultsTable($table_results_name);
				rowsGeneralResultsTable($obj_rst,true);
				endGeneralResultsTable($table_results_name, 'true');
			} else {
				withToMuchResultsSQLSERVER($total_num_rst);
			}
		}
		sqlsrv_free_stmt($obj_rst);
		sqlsrv_close($obj_conn_SQLSERVER);
	}
}




/**
 * Asistencias Programadas.
 * 
 * Imprime en pantalla el detalle de Asistencias Progrmadas
 * 
 * @static
 * @return string Formulario de asistencias programadas.
 */
function formProgramedAsistences() 
{
	$obj_rst = new ApoloDB();
	$query = "
	SELECT 
		CASE
			WHEN DATEDIFF(a.fechaprogramada, CURDATE()) < 0 THEN '4. Negro'
			WHEN DATEDIFF(a.fechaprogramada, CURDATE()) = 0 THEN '3. Rojo'
			WHEN DATEDIFF(a.fechaprogramada, CURDATE()) = 1 THEN '3. Rojo'
			WHEN DATEDIFF(a.fechaprogramada, CURDATE()) = 2 THEN '2. Amarillo'
			WHEN DATEDIFF(a.fechaprogramada, CURDATE()) = 3 THEN '2. Amarillo'
			ELSE '1. Verde'
		END AS 'Semaforo',
		a.numero AS 'Expediente',
		h.nombre AS 'Plan',
		y.nombre AS 'Estado',
		z.nombre AS 'Municipio',
		p.nombre AS 'Prioridad',
		s.nombre AS 'Servicio',
		x.nombre AS 'Proveedor',
		c.nombre AS 'Cobertura',
		CAST(a.fechasolicitud AS DATE) AS 'FechaSolicitud',
		a.fechaprogramada AS 'Programada',
		a.horadesde AS 'Desde',
		a.horahasta AS 'Hasta'
	FROM
		mx.asistencia a LEFT JOIN
		mx.estadoasistencia e ON a.estado = e.id LEFT JOIN
		mx.servicio s ON a.servicio = s.id LEFT JOIN
		mx.categoriadeasistencia c ON a.categoria = c.id LEFT JOIN
		mx.prioridadcategoria p ON a.prioridad = p.id LEFT JOIN
		mx.proveedor x ON a.proveedor = x.id LEFT JOIN
		mx.provincia y ON a.provincia = y.id LEFT JOIN
		mx.zona z ON a.zona = z.id LEFT JOIN
		mx.expediente f ON a.expediente = f.numero LEFT JOIN
		mx.cuenta g ON f.cuenta = g.id LEFT JOIN
		mx.plan h ON f.plan = h.id
	WHERE
		a.fechaprogramada IS NOT NULL
			AND (e.id = 4 OR e.id = 6 OR e.id = 7)
		ORDER BY
			Semaforo DESC, Prioridad ASC 
	;";
	$rst= $obj_rst->buscar($query);
	if($rst)
	{
		$table_results_name = str_replace(" ","_","ASISTENCIAS PROGRAMADAS AL ".date("Y-m-d"));
		$table_results_name_download_plugin = "'".$table_results_name."'";
		infoGeneralResultsTable('', '', $table_results_name_download_plugin);
		echo '
				<div class="section container row">
					<table id="'.$table_results_name.'" class="responsive-table compact card-panel">
						<thead class="'.activePagePrimaryColor().' white-text bold">
							<th>Semaforo</th>
							<th>Expediente</th>
							<th>Plan</th>
							<th>Estado</th>
							<th>Municipio</th>
							<th>Prioridad</th>
							<th>Servicio</th>
							<th>Proveedor</th>
							<th>Cobertura</th>
							<th>FechaSolicitud</th>
							<th>Programada</th>
							<th>Desde</th>
							<th>Hasta</th>
						</thead>
		';
		foreach ($rst as $field_name)
		{
			switch ($field_name['Semaforo'])
			{
				case '4. Negro'; $prority_color = 'black black-text'; break;
				case '3. Rojo'; $prority_color = 'red red-text'; break;
				case '2. Amarillo'; $prority_color = 'yellow yellow-text'; break;
				case '1. Verde'; $prority_color = 'green green-text'; break;
				default: $prority_color = ''; break;
			}
			echo '
							<tr>
								<td class="truncate '.$prority_color.'">'.$field_name['Semaforo'].'&nbsp;</td>
								<td>'.$field_name['Expediente'].'&nbsp;</td>
								<td>'.$field_name['Plan'].'&nbsp;</td>
								<td>'.$field_name['Estado'].'&nbsp;</td>
								<td>'.$field_name['Municipio'].'&nbsp;</td>
								<td>'.$field_name['Prioridad'].'&nbsp;</td>
								<td>'.$field_name['Servicio'].'&nbsp;</td>
								<td>'.$field_name['Proveedor'].'&nbsp;</td>
								<td>'.$field_name['Cobertura'].'&nbsp;</td>
								<td>'.$field_name['FechaSolicitud'].'&nbsp;</td>
								<td>'.$field_name['Programada'].'&nbsp;</td>
								<td>'.$field_name['Desde'].'&nbsp;</td>
								<td>'.$field_name['Hasta'].'&nbsp;</td>
							</tr>';
		}
		endGeneralResultsTable($table_results_name, 'false');
	} else {
		echo "No hay registros de Asistencias Programadas";
	}
}




/**
 * Reporte de Proveedores.
 * 
 * Imprime el formulario para obtener Reporte de Proveedores. Asi como 
 * los registros obtenidos acorde a los criterios indicados por el usuario.
 * 
 * @static
 * @return string Formulario/Detalle de Reporte a Proveedores.
 */
function formReportProveedor() 
{
	echo '
			<div class="section">
				<div class="container row center">
					<p class="caption">
						Indica el rango de fecha del cual deseas obtener el Detalle de Proveedores.<br>
						El tiempo de consulta puede variar en función de la cantidad de registros obtenidos.
					</p>
					<div class="row valign-wrapper">
						<form class="col l8 offset-l2 m8 offset-m2 s12" action="'.$_SERVER['PHP_SELF'].'" method="GET">
							<div class="input-field col s12 m5">
								<i class="material-icons prefix">today</i>';
		if (isset($_GET['date_ini']))
		{
			echo '
								<input id="date_ini" type="text" class="validate" name="date_ini" min="2018-05-11" value="'.$_GET['date_ini'].'">';
		} else {
			echo '
								<input id="date_ini" type="text" class="validate" name="date_ini" min="2018-05-11" value="'.date("Y-m-d",strtotime(date("Y-m-d")."- 1 days")).'">';
		}
		echo '
								<label for="date_ini">Desde</label>
							</div>
							<div class="input-field col s12 m5">
								<i class="material-icons prefix">today</i>';
		if (isset($_GET['date_fin']))
		{
			echo '
								<input id="date_fin" type="text" class="validate" name="date_fin" min="2018-05-11" value="'.$_GET['date_fin'].'">';
		} else {
			echo '
								<input id="date_fin" type="text" class="validate" name="date_fin" min="2018-05-11" value="'.date("Y-m-d",strtotime(date("Y-m-d")."- 1 days")).'">';
		}
		echo '
								<label for="date_fin">Hasta</label>		
							</div>
							<button class="btn-large waves-effect waves-light" type="submit" name="action">
								<i class="material-icons prefix">send</i> 
							</button>							
						</form>
					</div>
				</div>
			</div>
	';
	if (isset($_GET['date_ini']))
	{
		$date_ini = strip_tags($_GET['date_ini'],ENT_QUOTES);
		$date_fin = strip_tags($_GET['date_fin'],ENT_QUOTES);
		$string_to_search_higienized_for_query = $date_ini.$date_fin;
		$obj_rst = new ApoloDB();
		$query = "
			SELECT
				a.numero AS 'Expediente',
				CASE
				WHEN a.fechasolicitud IS NULL THEN e.fechaapertura
				ELSE a.fechasolicitud
				END AS 'FechaApertura',
				c.nombre AS 'Cuenta',
				p.nombre AS 'Plan',
				UCASE(e1.nombre) AS 'Status',
				CASE
				WHEN t.nombre IS NULL THEN 'LLAMADA INFORMATIVA'
				ELSE t.nombre
				END AS 'TipoServicio',
				CASE
				WHEN s.nombre IS NULL THEN 'Llamada informativa'
				ELSE s.nombre
				END AS 'Servicio',
				p2.nombre AS 'Proveedor',
				p2.condicion AS 'Condicion Proveedor' ,
				a.fechaconcluida AS 'FechaCierre',
				c1.importe AS 'Costo'
			FROM mx.asistencia a
				LEFT JOIN mx.expediente e ON a.expediente = e.id
				LEFT JOIN mx.estadoasistencia e1 ON a.estado = e1.id
				LEFT JOIN mx.proveedor p2 ON a.proveedor = p2.id
				LEFT JOIN mx.cuenta c ON e.cuenta = c.id
				LEFT JOIN mx.plan p ON e.plan = p.id
				LEFT JOIN mx.servicio s ON a.servicio = s.id
				LEFT JOIN mx.tipodeservicio t ON a.tipo = t.id
				LEFT JOIN mx.costo c1 ON c1.asistencia = a.id
			WHERE 
				e.fechaapertura BETWEEN '".$date_ini." 00:00:00' AND '".$date_fin." 23:59:59';
			";
		$rst = $obj_rst->buscar($query);
		if($rst)
		{
			$date_ini = strip_tags($_GET['date_ini'],ENT_QUOTES);
			$date_fin = strip_tags($_GET['date_fin'],ENT_QUOTES);
			$table_results_name = str_replace(",","",str_replace(" ","_", $date_ini.' al '.$date_fin));
			$table_results_name_download_plugin = "'".$table_results_name."'";
			infoGeneralResultsTable('', $table_results_name, $table_results_name_download_plugin);
			echo '
				<div class="section container row">
					<!-- <div class="container row"> -->
						<table id="'.$table_results_name.'" class="responsive-table compact card-panel">
							<thead class="'.activePagePrimaryColor().' white-text bold">
								<th>Expediente</th>
								<th>FechaApertura</th>
								<th>Cuenta</th>
								<th>Plan</th>
								<th>Status</th>
								<th>TipoServicio</th>
								<th>Servicio</th>
								<th>Proveedor</th>
								<th>Condicion Proveedor</th>
								<th>Costo</th>
								<th>FechaCierre</th>
							</thead>
			';
			foreach ($rst as $field_name)
			{
				echo '
							<tr>
								<td>'.$field_name['Expediente'].'&nbsp;</td>
								<td>'.$field_name['FechaApertura'].'&nbsp;</td>
								<td>'.$field_name['Cuenta'].'&nbsp;</td>
								<td>'.$field_name['Plan'].'&nbsp;</td>
								<td>'.$field_name['Status'].'&nbsp;</td>
								<td>'.$field_name['TipoServicio'].'&nbsp;</td>
								<td>'.$field_name['Servicio'].'&nbsp;</td>
								<td>'.$field_name['Proveedor'].'&nbsp;</td>
								<td>'.$field_name['Condicion Proveedor'].'&nbsp;</td>
								<td>'.$field_name['Costo'].'&nbsp;</td>
								<td>'.$field_name['FechaCierre'].'&nbsp;</td>				
							</tr>';
			}
			endGeneralResultsTable($table_results_name, false);
		} else {
			echo "No hay registros";
		}
	}
}




/**
 * Reporte de Operaciones.
 * 
 * Imprime el formulario para obtener el Reporte de Operaciones, asi como 
 * los registros obtenidos acorde a los criterios indicados por el usuario.
 * 
 * @static
 * @return string Formulario/Detalle de Reporte de Operaciones.
 */
function formReportOperativo() 
{
	echo '
			<div class="section">
				<div class="container row center">
					<p class="caption">
						Indica el rango de fecha del cual deseas obtener el Detalle de Asistencias aperturadas.<br>
						El tiempo de consulta puede variar en función de la cantidad de registros obtenidos.
					</p>
					<div class="row valign-wrapper">
						<form class="col l8 offset-l2 m8 offset-m2 s12" action="'.$_SERVER['PHP_SELF'].'" method="GET">
							<div class="input-field col s12 m5">
								<i class="material-icons prefix">today</i>';
		if (isset($_GET['date_ini']))
		{
			echo '
								<input id="date_ini" type="text" class="validate" name="date_ini" min="2018-05-11" value="'.$_GET['date_ini'].'">';
		} else {
			echo '
								<input id="date_ini" type="text" class="validate" name="date_ini" min="2018-05-11" value="'.date("Y-m-d",strtotime(date("Y-m-d")."- 1 days")).'">';
		}
		echo '
								<label for="date_ini">Desde</label>
							</div>
							<div class="input-field col s12 m5">
								<i class="material-icons prefix">today</i>';
		if (isset($_GET['date_fin']))
		{
			echo '
								<input id="date_fin" type="text" class="validate" name="date_fin" min="2018-05-11" value="'.$_GET['date_fin'].'">';
		} else {
			echo '
								<input id="date_fin" type="text" class="validate" name="date_fin" min="2018-05-11" value="'.date("Y-m-d",strtotime(date("Y-m-d")."- 1 days")).'">';
		}
		echo '
								<label for="date_fin">Hasta</label>		
							</div>
							<button class="btn-large waves-effect waves-light" type="submit" name="action">
								<i class="material-icons prefix">send</i> 
							</button>							
						</form>
					</div>
				</div>
			</div>
	';
	if (isset($_GET['date_ini']))
	{
		$date_ini = strip_tags($_GET['date_ini'],ENT_QUOTES);
		$date_fin = strip_tags($_GET['date_fin'],ENT_QUOTES);
		$string_to_search_higienized_for_query = $date_ini.$date_fin;
		$obj_rst = new ApoloDB();
		$query = "
			SELECT
				Expediente,
				FechaAperturaAsistencia,
				FechaConcluidaAsistencia,
				StatusAsistencia,
				TipoServicio,
				Servicio,
				Proveedor,
				Cuenta,
				Plan,
				EstadoProvincia,
				CiudadZona,
				NombreAfiliado,
				DNIAfiliado,
				Costo,
				Pagador,
				UsuarioRegistra,
				UsuarioCoordina,
				UsuarioModifica
			FROM mx.vwREO
			WHERE 
			(`FechaAperturaAsistencia` BETWEEN '".$date_ini." 00:00:00' AND '".$date_fin." 23:59:59');
			";
		$rst = $obj_rst->buscar($query);
		if($rst)
		{
			$date_ini = strip_tags($_GET['date_ini'],ENT_QUOTES);
			$date_fin = strip_tags($_GET['date_fin'],ENT_QUOTES);
			$table_results_name = str_replace(",","",str_replace(" ","_", $date_ini.' al '.$date_fin));
			$table_results_name_download_plugin = "'".$table_results_name."'";
			infoGeneralResultsTable('', $table_results_name, $table_results_name_download_plugin);
			echo '
				<div class="section container row">
					<!-- <div class="container row"> -->
						<table id="'.$table_results_name.'" class="responsive-table compact card-panel">
							<thead class="'.activePagePrimaryColor().' white-text bold">
								<th>Expediente</th>
								<th>FechaApertura</th>
								<th>FechaCierre</th>
								<th>Status</th>
								<th>TipoServicio</th>
								<th>Servicio</th>
								<th>Proveedor</th>
								<th>Cuenta</th>
								<th>Plan</th>
								<th>Estado</th>
								<th>Ciudad</th>
								<th>Nombre Afiliado</th>
								<th>DNI</th>
								<th>Costo</th>
								<th>Pagador</th>
								<th>UsuarioRegistra</th>
								<th>UsuarioCoordina</th>
								<th>UsuarioModifica</th>
							</thead>
			';
			foreach ($rst as $field_name)
			{
				echo '
							<tr>
								<td>'.$field_name['Expediente'].'&nbsp;</td>
								<td>'.$field_name['FechaAperturaAsistencia'].'&nbsp;</td>
								<td>'.$field_name['FechaConcluidaAsistencia'].'&nbsp;</td>
								<td>'.$field_name['StatusAsistencia'].'&nbsp;</td>
								<td>'.$field_name['TipoServicio'].'&nbsp;</td>
								<td>'.$field_name['Servicio'].'&nbsp;</td>
								<td>'.$field_name['Proveedor'].'&nbsp;</td>
								<td>'.$field_name['Cuenta'].'&nbsp;</td>
								<td>'.$field_name['Plan'].'&nbsp;</td>
								<td>'.$field_name['EstadoProvincia'].'&nbsp;</td>
								<td>'.$field_name['CiudadZona'].'&nbsp;</td>
								<td>'.$field_name['NombreAfiliado'].'&nbsp;</td>
								<td>'.$field_name['DNIAfiliado'].'&nbsp;</td>
								<td>'.$field_name['Costo'].'&nbsp;</td>
								<td>'.$field_name['Pagador'].'&nbsp;</td>
								<td>'.$field_name['UsuarioRegistra'].'&nbsp;</td>
								<td>'.$field_name['UsuarioCoordina'].'&nbsp;</td>
								<td>'.$field_name['UsuarioModifica'].'&nbsp;</td>
							</tr>';
			}
			endGeneralResultsTable($table_results_name, false);
		} else {
			echo "No hay registros";
		}
	}
}




/**
 * Valor numerico (#,##0).
 * 
 * Imprime en formato de numero, el valor obtenido de una consulta a la BBDD que
 * implique sumar, contar, o extraer.
 * 
 * @param string $query Consulta que permitira obtener el valor numerico.
 * @param string $field_name Campo del cual se ha de extraer el valor numerico.
 * @return string Valor numerico (Formateado #,##0).
 */
function getUniqueCountValueFromDB($query, $field_name)
{
	$obj_conn_params_SQLSERVER = array('Database' => COBRANZABD, 'Uid' => COBRANZAUSER, 'PWD' => COBRANZAPWD);
	$obj_conn_SQLSERVER = sqlsrv_connect(COBRANZASRVR, $obj_conn_params_SQLSERVER);

	$obj_rst_aditional_params_SQLSERVER = array();
	$obj_rst_optionals_SQLSERVER = array('Scrollable'=>SQLSRV_CURSOR_KEYSET);	
	$obj_rst = sqlsrv_query($obj_conn_SQLSERVER, $query, $obj_rst_aditional_params_SQLSERVER, $obj_rst_optionals_SQLSERVER);
	if ($obj_rst == FALSE)
	{
		die(errorConnSQLSRVR(sqlsrv_errors()));		
	} else {
		$obj_rst = sqlsrv_fetch_array($obj_rst, SQLSRV_FETCH_ASSOC);
		return number_format($obj_rst[$field_name],0,'.',',');
	}
	sqlsrv_free_stmt($obj_rst);
		sqlsrv_close($obj_conn_SQLSERVER);
}




/**
 * Valor numerico con decimales (#,##0.0#).
 * 
 * Imprime en formato de numero, el valor obtenido de una consulta a la BBDD que
 * implique sumar, contar, o extraer.
 * 
 * @param string $query Consulta que permitira obtener el valor numerico.
 * @param string $field_name Campo del cual se ha de extraer el valor numerico.
 * @return string Valor numerico (Formateado #,##0.0#).
 */
function getUniqueCountDecimalValueFromDB($query, $field_name)
{
	$obj_conn_params_SQLSERVER = array('Database' => COBRANZABD, 'Uid' => COBRANZAUSER, 'PWD' => COBRANZAPWD);
	$obj_conn_SQLSERVER = sqlsrv_connect(COBRANZASRVR, $obj_conn_params_SQLSERVER);
	$obj_rst_aditional_params_SQLSERVER = array();
	$obj_rst_optionals_SQLSERVER = array('Scrollable'=>SQLSRV_CURSOR_KEYSET);	
	$obj_rst = sqlsrv_query($obj_conn_SQLSERVER, $query, $obj_rst_aditional_params_SQLSERVER, $obj_rst_optionals_SQLSERVER);
	if ($obj_rst == FALSE)
	{
		die(errorConnSQLSRVR(sqlsrv_errors()));		
	} else {
		$obj_rst = sqlsrv_fetch_array($obj_rst, SQLSRV_FETCH_ASSOC);
		return number_format($obj_rst[$field_name],2,'.',',');
	}
	sqlsrv_free_stmt($obj_rst);
		sqlsrv_close($obj_conn_SQLSERVER);
}




/**
 * CardCounter con MiniGrafico.
 * 
 * Imprime un Card con Mini Graficos y datos complementarios (opcionales).
 *
 * @param string $class_definition Clase CSS de tamaño en la rejilla.
 * @param string $color Clase CSS de color.
 * @param string $description Titulo del Card.
 * @param string $descriptive_ico IcoFont relacionado con el Titulo de Card.
 * @param string $acum_value Valor en acumulado que se mostraria en la parte inferior derecha del Card.
 * @param string $prev_value Valor del periodo previo que se mostraria en la parte inferior izquierda del Card.
 * @param string $new_value Valor del periodo actual que se mostraria debajo del Titulo del Card.
 * @param string $query Query que permite generar el Mini Grafico con la funcion createMiniGraph().
 * @param string $cols Nombre de la columna que servira de Eje en el Mini Grafico.
 * @param string $values Nombre de los valores para el Eje en el Minigrafico.
 * @return string Card con Mini Grafico y datos complementarios.
 */
function generalCardCounter($class_definition, $color, $description, $descriptive_ico, $acum_value, $prev_value, $new_value, $query, $cols, $values)
{
	if (strlen($prev_value) > 1 or strlen($acum_value) > 1)
	{
		$aditional_counters = '
							<div class="row white-text">
								<div class="col l6 m6 s6 center-align">
									<span class="tooltipped truncate" data-position="top" data-delay="50" data-tooltip="Valor del mes anterior">
										<i class="material-icons prefix tiny">today</i> '.$prev_value.'
									</span>
								</div>
								<div class="col l6 m6 s6 center-align">
									<span class="tooltipped truncate" data-position="top" data-delay="50" data-tooltip="Acumulado al día de hoy">
										<i class="material-icons prefix tiny">flip_to_back</i> '.$acum_value.'
									</span>
								</div>
							</div>
		';
	} else {
		$aditional_counters = '';
	}
	if (strlen($query) > 1)
	{
		$mini_graph = '
							<div class="card-action '.$color.' darken-1 white-text">
								'.generalMiniGraph($query, $cols, $values, 'rgb(255, 255, 255)').'
							</div>
		';
	} else {
		$mini_graph = '';
	}
	return '
					<div class="col '.$class_definition.'">
						<div class="card '.$color.'">
							<div class="card-content white-text center-align">
								<p class="truncate">
									<i class="material-icons prefix small">'.$descriptive_ico.'</i> '.$description.'
								</p>
								<span class="card-title truncate">'.
									$new_value
								.'</span>
							</div>'.
							$mini_graph.
							$aditional_counters.'
						</div>
					</div>
	';
}




/**
 * Generar MiniGrafico (Vivos en Blanco, Fondo Transparente).
 * 
 * @param string $query Query que arroja los datos a representar en Mini Grafico.
 * @param string $descriptive_field Nombre para Ejes.
 * @param string $descriptive_value Valores de los Ejes.
 * @return string Mini Grafico traslucido blanco, con fondo transparente.
 * @todo Facilitar la seleccion de color traslucido via activePagePrimariColor() o similares.
 */
function generalMiniGraph($query, $descriptive_field, $descriptive_value, $color_graph)
{
	$obj_conn_params_SQLSERVER = array('Database' => COBRANZABD, 'Uid' => COBRANZAUSER, 'PWD' => COBRANZAPWD);
	$obj_conn_SQLSERVER = sqlsrv_connect(COBRANZASRVR, $obj_conn_params_SQLSERVER);
	$obj_rst_aditional_params_SQLSERVER = array();
	$obj_rst_optionals_SQLSERVER = array('Scrollable'=>SQLSRV_CURSOR_KEYSET);	
	$obj_rst = sqlsrv_query($obj_conn_SQLSERVER, $query, $obj_rst_aditional_params_SQLSERVER, $obj_rst_optionals_SQLSERVER);
	if ($obj_rst == FALSE)
	{
		die(errorConnSQLSRVR(sqlsrv_errors()));
	} else {
		$graph_field_name = '';
		$graph_field_value = '';
		while ($individual_rst = sqlsrv_fetch_array($obj_rst, SQLSRV_FETCH_ASSOC))
		{
				$graph_field_name = $graph_field_name.'"'.$individual_rst[$descriptive_field].'",';
				$graph_field_value = $graph_field_value.'"'.$individual_rst[$descriptive_value].'",';
		}
		sqlsrv_free_stmt($obj_rst);
		sqlsrv_close($obj_conn_SQLSERVER);
	}
	return '
								<div style="height: 16vh; width: 100%">
									<canvas id="graph_'.strtolower($descriptive_field.'_'.$descriptive_value).'"></canvas>
								</div>
								<script type="text/javascript">
									new Chart(document.getElementById("graph_'.strtolower($descriptive_field.'_'.$descriptive_value).'"), {
										type: "bar",
										data: {
											labels: ['.$graph_field_name.'],
											datasets: [
												{
													label: "",
													fill: true,
													data: ['.$graph_field_value.'],
													backgroundColor: "'.$color_graph. '",
													borderColor: "rgba(255, 255, 255,0.5)",
												},
												]
										},
										options: {
											title: {
												display: false
											},
											responsive: true,
											maintainAspectRatio: false,
											tooltips: {
												enabled: true,
												mode: "index",
												intersect: true
											},
											legend: {
												display: false
											},
											layout: {
												padding: {
												left: 0,	
												right: 0,
												top: 0,
												bottom: 0,
												}
											},
											scales: {
												xAxes: [{
													display: false,
													stacked: true,
													gridLines: { display: false }
												}],
												yAxes: [{
													display: false,
													stacked: true,
													gridLines: { display: false }
												}],
											}						
										}
									});	
								</script>
	';
}




/**
 * Directorio activo.
 * 
 * Imprime la ruta o directorio que contiene el recurso activo.
 * 
 * @static
 * @return string Ruta/Directorio del recurso activo.
 */
function activePageDir()
{
	return dirname($_SERVER['PHP_SELF']);
}




/**
 * Recurso activo.
 * 
 * Imprime la ruta completa del recurso activo.
 * 
 * @static
 * @return string Ruta del recurso activo.
 */
function activePageName()
{
	return basename($_SERVER['PHP_SELF'],'.php');
}




/**
 * Color primario.
 * 
 * Define el color primario que se usara dentro del recurso activo.
 * 
 * @static
 * @return string Color primario.
 */
function activePagePrimaryColor()
{
	switch (activePageName())
	{
		//case 'afiliados'; $page_color = 'indigo darken-1'; break;
		//case 'bajas'; $page_color = 'red darken-1'; break;
		//case 'recurrencia'; $page_color = 'teal darken-1'; break;
		//case 'reservar'; $page_color = 'blue-grey darken-1'; break;
		case 'error'; $page_color = 'red darken-1'; break;
		default: $page_color = 'blue-grey darken-3'; break;
	}
	return $page_color;
}




/**
 * Nombre de mes, largo.
 * 
 * Imprime en pantalla el nombre de mes en su formato largo.
 * Ej: 1 - ENERO
 * 
 * @param string $mont_number Numero de mes.
 * @return string Nombre de mes.
 */
function largeMonthName($month_number)
{
	$month = strftime('%B', mktime(0, 0, 0, $month_number, 1, 2000));
	return $month;
}	



/**
 * Nombre de mes, corto.
 * 
 * Imprime en pantalla el nombre de mes en su formato corto.
 * Ej: 1 - ENE.
 * 
 * @param string $mont_number Numero de mes.
 * @return string Nombre de mes.
 */
function shortMonthName($month_number)
{
	$month = strftime('%b', mktime(0, 0, 0, $month_number, 1, 2000));
	return $month;
}




/**
 * Higienizar cadena.
 * 
 * Dada una cadena de texto, reemplaza caracteres acentuados por no acentuados.
 * Ademas, retira caracteres especiales o reemplaza Ñ por comodines (%).
 * 
 * @param string $string Cadena de texto a higienizar.
 * @return string Cadena de texto higienizada.
 */
function higienizeString($string)
{
	$replacement_list = array(
		'ъ'=>'-', 'Ь'=>'-', 'Ъ'=>'-', 'ь'=>'-', 'Ă'=>'A', 'Ą'=>'A', 'À'=>'A', 'Ã'=>'A', 'Á'=>'A', 'Æ'=>'A', 
		'Â'=>'A', 'Å'=>'A', 'Ä'=>'Ae', 'Þ'=>'B', 'Ć'=>'C', 'ץ'=>'C', 'Ç'=>'C', 'È'=>'E', 'Ę'=>'E', 'É'=>'E', 
		'Ë'=>'E', 'Ê'=>'E', 'Ğ'=>'G', 'İ'=>'I', 'Ï'=>'I', 'Î'=>'I', 'Í'=>'I', 'Ì'=>'I', 'Ł'=>'L', 'Ñ'=>'N', 
		'Ń'=>'N', 'Ñ'=>'N', 'Ń'=>'N', 'Ø'=>'O', 'Ó'=>'O', 'Ò'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'Oe', 'Ş'=>'S', 
		'Ś'=>'S', 'Ș'=>'S', 'Š'=>'S', 'Ț'=>'T', 'Ù'=>'U', 'Û'=>'U', 'Ú'=>'U', 'Ü'=>'Ue', 'Ý'=>'Y', 'Ź'=>'Z', 
		'Ž'=>'Z', 'Ż'=>'Z', 'â'=>'a', 'ǎ'=>'a', 'ą'=>'a', 'á'=>'a', 'ă'=>'a', 'ã'=>'a', 'Ǎ'=>'a', 'а'=>'a', 
		'А'=>'a', 'å'=>'a', 'à'=>'a', 'א'=>'a', 'Ǻ'=>'a', 'Ā'=>'a', 'ǻ'=>'a', 'ā'=>'a', 'ä'=>'ae', 'æ'=>'ae', 
		'Ǽ'=>'ae', 'ǽ'=>'ae', 'б'=>'b', 'ב'=>'b', 'Б'=>'b', 'þ'=>'b', 'ĉ'=>'c', 'Ĉ'=>'c', 'Ċ'=>'c', 'ć'=>'c', 
		'ç'=>'c', 'ц'=>'c', 'צ'=>'c', 'ċ'=>'c', 'Ц'=>'c', 'Č'=>'c', 'č'=>'c', 'Ч'=>'ch', 'ч'=>'ch', 'ד'=>'d', 
		'ď'=>'d', 'Đ'=>'d', 'Ď'=>'d', 'đ'=>'d', 'д'=>'d', 'Д'=>'D', 'ð'=>'d', 'є'=>'e', 'ע'=>'e', 'е'=>'e', 
		'Е'=>'e', 'Ə'=>'e', 'ę'=>'e', 'ĕ'=>'e', 'ē'=>'e', 'Ē'=>'e', 'Ė'=>'e', 'ė'=>'e', 'ě'=>'e', 'Ě'=>'e', 
		'Є'=>'e', 'Ĕ'=>'e', 'ê'=>'e', 'ə'=>'e', 'è'=>'e', 'ë'=>'e', 'é'=>'e', 'ф'=>'f', 'ƒ'=>'f', 'Ф'=>'f', 
		'ġ'=>'g', 'Ģ'=>'g', 'Ġ'=>'g', 'Ĝ'=>'g', 'Г'=>'g', 'г'=>'g', 'ĝ'=>'g', 'ğ'=>'g', 'ג'=>'g', 'Ґ'=>'g', 
		'ґ'=>'g', 'ģ'=>'g', 'ח'=>'h', 'ħ'=>'h', 'Х'=>'h', 'Ħ'=>'h', 'Ĥ'=>'h', 'ĥ'=>'h', 'х'=>'h', 'ה'=>'h', 
		'î'=>'i', 'ï'=>'i', 'í'=>'i', 'ì'=>'i', 'į'=>'i', 'ĭ'=>'i', 'ı'=>'i', 'Ĭ'=>'i', 'И'=>'i', 'ĩ'=>'i', 
		'ǐ'=>'i', 'Ĩ'=>'i', 'Ǐ'=>'i', 'и'=>'i', 'Į'=>'i', 'י'=>'i', 'Ї'=>'i', 'Ī'=>'i', 'І'=>'i', 'ї'=>'i', 
		'і'=>'i', 'ī'=>'i', 'ĳ'=>'ij', 'Ĳ'=>'ij', 'й'=>'j', 'Й'=>'j', 'Ĵ'=>'j', 'ĵ'=>'j', 'я'=>'ja', 'Я'=>'ja', 
		'Э'=>'je', 'э'=>'je', 'ё'=>'jo', 'Ё'=>'jo', 'ю'=>'ju', 'Ю'=>'ju', 'ĸ'=>'k', 'כ'=>'k', 'Ķ'=>'k', 
		'К'=>'k', 'к'=>'k', 'ķ'=>'k', 'ך'=>'k', 'Ŀ'=>'l', 'ŀ'=>'l', 'Л'=>'l', 'ł'=>'l', 'ļ'=>'l', 'ĺ'=>'l', 
		'Ĺ'=>'l', 'Ļ'=>'l', 'л'=>'l', 'Ľ'=>'l', 'ľ'=>'l', 'ל'=>'l', 'מ'=>'m', 'М'=>'m', 'ם'=>'m', 'м'=>'m', 
		'ñ'=>'%', 'н'=>'n', 'Ņ'=>'n', 'ן'=>'n', 'ŋ'=>'n', 'נ'=>'n', 'Н'=>'n', 'ń'=>'n', 'Ŋ'=>'n', 'ņ'=>'n', 
		'ŉ'=>'n', 'Ň'=>'n', 'ň'=>'n', 'о'=>'o', 'О'=>'o', 'ő'=>'o', 'õ'=>'o', 'ô'=>'o', 'Ő'=>'o', 'ŏ'=>'o', 
		'Ŏ'=>'o', 'Ō'=>'o', 'ō'=>'o', 'ø'=>'o', 'ǿ'=>'o', 'ǒ'=>'o', 'ò'=>'o', 'Ǿ'=>'o', 'Ǒ'=>'o', 'ơ'=>'o', 
		'ó'=>'o', 'Ơ'=>'o', 'œ'=>'oe', 'Œ'=>'oe', 'ö'=>'oe', 'פ'=>'p', 'ף'=>'p', 'п'=>'p', 'П'=>'p', 'ק'=>'q', 
		'ŕ'=>'r', 'ř'=>'r', 'Ř'=>'r', 'ŗ'=>'r', 'Ŗ'=>'r', 'ר'=>'r', 'Ŕ'=>'r', 'Р'=>'r', 'р'=>'r', 'ș'=>'s', 
		'с'=>'s', 'Ŝ'=>'s', 'š'=>'s', 'ś'=>'s', 'ס'=>'s', 'ş'=>'s', 'С'=>'s', 'ŝ'=>'s', 'Щ'=>'sch', 'щ'=>'sch', 
		'ш'=>'sh', 'Ш'=>'sh', 'ß'=>'ss', 'т'=>'t', 'ט'=>'t', 'ŧ'=>'t', 'ת'=>'t', 'ť'=>'t', 'ţ'=>'t', 'Ţ'=>'t', 
		'Т'=>'t', 'ț'=>'t', 'Ŧ'=>'t', 'Ť'=>'t', '™'=>'tm', 'ū'=>'u', 'у'=>'u', 'Ũ'=>'u', 'ũ'=>'u', 'Ư'=>'u', 
		'ư'=>'u', 'Ū'=>'u', 'Ǔ'=>'u', 'ų'=>'u', 'Ų'=>'u', 'ŭ'=>'u', 'Ŭ'=>'u', 'Ů'=>'u', 'ů'=>'u', 'ű'=>'u', 
		'Ű'=>'u', 'Ǖ'=>'u', 'ǔ'=>'u', 'Ǜ'=>'u', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'У'=>'u', 'ǚ'=>'u', 'ǜ'=>'u', 
		'Ǚ'=>'u', 'Ǘ'=>'u', 'ǖ'=>'u', 'ǘ'=>'u', 'ü'=>'ue', 'в'=>'v', 'ו'=>'v', 'В'=>'v', 'ש'=>'w', 'ŵ'=>'w', 
		'Ŵ'=>'w', 'ы'=>'y', 'ŷ'=>'y', 'ý'=>'y', 'ÿ'=>'y', 'Ÿ'=>'y', 'Ŷ'=>'y', 'Ы'=>'y', 'ž'=>'z', 'З'=>'z', 
		'з'=>'z', 'ź'=>'z', 'ז'=>'z', 'ż'=>'z', 'ſ'=>'z', 'Ж'=>'zh', 'ж'=>'zh', ' '=>'%',
	);
	return strtr($string, $replacement_list);
}

?>
