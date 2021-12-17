
<?php 

	/* Inicio de secciones de menú */
	function beginMenuSection($icon, $description, $active) {
		
		if ($icon) {
			$icon = '<i class="material-icons prefix small">'.$icon.'</i>';
		} else {
			$icon = '';
		}
		
		if (strlen($active) > 1) {$active = 'active';} else {$active = '';}	
		
		echo '
					<li class="'.$active.'"><a class="collapsible-header waves-effect '.$active.'">'.$icon.' '.$description.'</a>
						<div class="collapsible-body">
							<ul>';
	}

	/* Entrada de sección para menú */	
	function menuSectionEntry($page, $icon, $description, $active) {
		
		if ($icon) {
			$class = '<i class="material-icons prefix small">'.$icon.'</i>';
		} else {
			$class = '';
		}
		
		echo '	
								<li><a href="'.$page.'" class="waves-effect '.$active.'">'.$class.' '.$description.'</a></li>';
	}
	
	/* Entrada simple menú */	
	function menuSimpleEntry($page, $icon, $description, $active) {
		
		if ($icon) {
			$class = '<i class="material-icons prefix medium">'.$icon.'</i>';
		} else {
			$class = '';
		}

		echo '	
					&nbsp;
					<li><a href="'.$page.'" class="waves-effect '.$active.' valign-wrapper">'.$class.' '.$description.'</a></li>
					<div class="divider"></div>';
	}

	/* Fin de secciones de menú */
		function endMenuSection() {
		
		echo '
							</ul>
						</div>
					</li>';
	}

	
?>