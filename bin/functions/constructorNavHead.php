
<?php 

	function navHead($titleNav) {
		$serverName = COBRANZASRVR;
		$conn = sqlsrv_connect(COBRANZASRVR, array('Database' => 'tmk', 'Uid' => COBRANZAUSER, 'PWD' => COBRANZAPWD));

		if($conn) {
			echo '<span class="badge green white-text z-depth-1" data-badge-caption="Online">Online</span>';
		} else {
			echo '<span class="badge red white-text z-depth-1" data-badge-caption="Online">Offline</span>';
		}
		
		echo '
			<!-- BEGIN TOP NAV HEAD PAGE -->
			<nav class="top-nav">
				<div class="container">
					<div class="nav-wrapper truncate">
						<a class="page-title">'.$titleNav.'</a>
					</div>
				</div>
			</nav>
			<!-- END TOP NAV HEAD PAGE -->
			';
	}

?>