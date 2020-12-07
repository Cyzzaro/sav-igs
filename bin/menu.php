<div class="container">
	<a href="#" data-activates="nav-mobile" class="button-collapse top-nav waves-effect waves-light circle">
		<i class="material-icons">menu</i>
	</a>
</div>

<ul id="nav-mobile" class="side-nav fixed">
	<li class="logo">
		<a id="logo-container" href="<?php echo GLOBALPATH; ?>/" class="brand-logo">
			<img id="front-page-logo" src="<?php echo GLOBALPATH; ?>/res/images/logo-igs.png">
		</a>
	</li>
	<li><a href="#" class="waves-effect"> Afiliados Banorte...</a></li>
	<div class="row valign-wrapper">
		<form class="col l12 m12 s12" action="<?php echo GLOBALPATH.'/pages/buscar/por_nombre.php'; ?>" method="GET">
			<div class="input-field col s12">
				<i class="material-icons prefix">person_pin</i>
				<input id="nombre_afiliado" type="text" class="validate" name="nombre_afiliado" value="">
				<label for="nombre_afiliado">Nombre</label>
			</div>
		</form>
	</div>
	<div class="row valign-wrapper">
		<form class="col l12 m12 s12" action="<?php echo GLOBALPATH.'/pages/buscar/por_lead_id.php'; ?>" method="GET">
			<div class="input-field col s12">
				<i class="material-icons prefix">verified_user</i>
				<input id="lead_id" type="text" class="validate" name="lead_id" value="">
				<label for="lead_id">Lead ID</label>
			</div>
		</form>
	</div>
	<div class="row valign-wrapper">
		<form class="col l12 m12 s12" action="<?php echo GLOBALPATH.'/pages/buscar/por_identificador.php'; ?>" method="GET">
			<div class="input-field col s12">
				<i class="material-icons prefix">fingerprint</i>
				<input id="identificador" type="text" class="validate" name="identificador" value="">
				<label for="identificador">Identificador</label>
			</div>
		</form>
	</div>
	<div class="divider"></div>
	<ul class="collapsible collapsible-accordion">
		<?php
						menuSectionIni('folder_shared','Banorte', (activePageDir() == GLOBALPATH."/pages/banorte" ? "active" : ""));
							menuElement(GLOBALPATH.'/pages/banorte/afiliados.php', '', 'Afiliados', (activePageDir() == GLOBALPATH."/pages/banorte" ? "active" : ""));
							menuElement(GLOBALPATH.'/pages/banorte/bajas.php', '', 'Bajas', (activePageDir() == GLOBALPATH."/pages/banorte" ? "active" : ""));
							menuElement(GLOBALPATH.'/pages/banorte/recurrencia.php', '', 'Recurrencia', (activePageDir() == GLOBALPATH."/pages/banorte" ? "active" : ""));
						menu_seccion_fin();
						echo '<div class="divider"> &nbsp; </div>';
						menuSectionIni('star','Grupo IAMSA', (activePageDir() == GLOBALPATH."/pages/iamsa" ? "active" : ""));
							menuElement(GLOBALPATH.'/pages/iamsa/resumen.php', '', 'Reporte de viajes', (activePageDir() == GLOBALPATH."/pages/iamsa" ? "active" : ""));
						menu_seccion_fin();
						echo '<div class="divider"> &nbsp; </div>';
						echo '<br><br><br><span class="new badge blue-grey white-text">' . $_SERVER['REMOTE_ADDR'] . '</span>';
					?>

	</ul>
</ul>
<?php 

/**
 * Inicia seccion del menu.
 * 
 * @param string $section_icon Icono que identifica la seccion del menu.
 * @param string $section_descriptive Titulo para la seccion de menu.
 * @param boolean $section_is_active La seccion de menu se encuentra activa.
 * @return string Inicio de seccion para menu.
 */
function menuSectionIni($section_icon, $section_descriptive, $section_is_active)
{
	if ($section_icon)
	{
		$section_icon = '<i class="material-icons prefix small">'.$section_icon.'</i>';
	} else {
		$section_icon = '';
	}
	if (strlen($section_is_active) > 1)
	{
		$section_is_active = 'active';
	} else {
		$section_is_active = '';
	}
	echo '
					<li class="'.$section_is_active.'"><a class="collapsible-header waves-effect '.$section_is_active.'">'.$section_icon.' '.$section_descriptive.'</a>
						<div class="collapsible-body">
							<ul>';
}

/**
 * Elemento del menu dentro de una seccion.
 * 
 * @param string $element_url URL destino del elemento.
 * @param string $element_icon Icono que identifica la seccion del menu.
 * @param string $element_descriptive Titulo para elemento del menu.
 * @param boolean $element_is_active El elemento se encuentra activo.
 * @return string Elemento del menu con vinculo de destino.
 */
function menuElement($element_url, $element_icon, $element_descriptive, $element_is_active)
{
	if ($element_icon)
	{
		$class = '<i class="material-icons prefix small">'.$element_icon.'</i>';
	} else {
		$class = '';
	}
	echo '	
								<li><a href="'.$element_url.'" class="waves-effect '.$element_is_active.'">'.$class.' '.$element_descriptive.'</a></li>';
}

/**
 * Termina seccion de menu.
 * 
 * @static
 * @return string Cierra la seccion de menu.
 */
function menu_seccion_fin()
{
	echo '
							</ul>
						</div>
					</li>';
}
	
?>