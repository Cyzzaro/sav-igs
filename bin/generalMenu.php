
			<!-- BEGIN MENU 
				- Toggle menu
				- Logo de empresa
				- Secciones y sub-secciones del menu -->
			<div class="container">
				<a href="#" data-activates="nav-mobile" class="button-collapse top-nav waves-effect waves-light circle"><i class="material-icons">menu</i></a>
			</div>
			<ul id="nav-mobile" class="side-nav fixed">
				<li class="logo">
					<a id="logo-container" href="<?php echo GLOBALPATH; ?>/" class="brand-logo">
						<img id="front-page-logo" src="<?php echo GLOBALPATH; ?>/res/images/logo-igs.png">
					</a>
				</li>
				<ul class="collapsible collapsible-accordion">
					<?php

						beginMenuSection('search', 'Buscar afiliado', (pageDir() == GLOBALPATH."/pages/toSearch" ? "active" : ""));
						menuSectionEntry(GLOBALPATH.'/pages/toSearch/', '', 'Por nombre', (pageDir() == GLOBALPATH."/pages/toSearch" ? "active" : ""));
						menuSectionEntry(GLOBALPATH.'/pages/toSearch/', '', 'Por LeadID', (pageDir() == GLOBALPATH."/pages/toSearch" ? "active" : ""));
						menuSectionEntry(GLOBALPATH.'/pages/toSearch/', '', 'Por Identificador', (pageDir() == GLOBALPATH."/pages/toSearch" ? "active" : ""));
						endMenuSection();
						beginMenuSection('folder_shared','Banorte', (pageDir() == GLOBALPATH."/pages/toBanorte" ? "active" : ""));
						menuSectionEntry(GLOBALPATH.'/pages/toBanorte/', '', 'Afiliados', (pageDir() == GLOBALPATH."/pages/toBanorte" ? "active" : ""));
						menuSectionEntry(GLOBALPATH.'/pages/toBanorte/', '', 'Bajas', (pageDir() == GLOBALPATH."/pages/toBanorte" ? "active" : ""));
						menuSectionEntry(GLOBALPATH.'/pages/toBanorte/', '', 'Recurrencia', (pageDir() == GLOBALPATH."/pages/toBanorte" ? "active" : ""));
						endMenuSection();
						beginMenuSection('folder_special','Grupo IAMSA', (pageDir() == GLOBALPATH."/pages/toIAMSA" ? "active" : ""));
						menuSectionEntry(GLOBALPATH.'/pages/toIAMSA/', '', 'Viajes reportados', (pageDir() == GLOBALPATH."/pages/toIAMSA" ? "active" : ""));
						endMenuSection();
						//echo pageDir();
					?>
					
				</ul>
			</ul>

