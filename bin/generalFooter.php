
<?php

	if (isset($registros)) {
		sqlsrv_free_stmt($registros);
	} else {
		echo '';
	}
	
	if (isset($conn)) {
		sqlsrv_close($conn);
	} else {
		echo '';
	}
	
?>
		<!-- BEGIN FOOTER 
			- Git repo last commit 
			- Support and contact
			- CopyRight -->
		<footer class="page-footer">
			<div class="container">
				<div class="row">
					<div class="col l8 m8 s12">
						<div class="card-panel grey lighten-5 z-depth-1">
							<div class="row valign-wrapper">
								<div class="col l1 m2 s4">
									<img src="<?php echo GLOBALPATH; ?>/res/images/cyzzaro.png" alt="" class="circle responsive-img"> <!-- notice the "circle" class -->
								</div>
								<div class="col l11 m10 s8">
									 <div class="github-commit">
										<div class="commit left-align">
											<ul>
												<li><span class="message"></span></li>
												<li>(<span class="additions green-text bold"></span>, <span class="deletions red-text bold"></span> <span href="" target="new" class="sha"></span>) <span class="date"></span> por <span class="author"></span></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col l4 m4 s12">
						<h5 class="white-text">Soporte</h5>
						<ul>
							<li class="white-text"><i class="material-icons tiny prefix">phone</i> <?php echo PHONECIA; ?></li>
							<li><a class="white-text" href="mailto:<?php echo SUPPORTMAIL.'?Subject=Soporte para sitio - '.PAGETITLE; ?>" title="Envia tus comentarios y sugerencias"><i class="material-icons tiny prefix">mail</i> <?php echo SUPPORTMAIL; ?></a></li>
						</ul>
					</div>
				</div>
				<br>
			</div>
			<div class="footer-copyright">
				<div class="container">
					© 2019-<script type="text/javascript">document.write(new Date().getFullYear());</script> 
					<span xmlns:dct="http://purl.org/dc/terms/" href="http://purl.org/dc/dcmitype/InteractiveResource" property="dct:title" rel="dct:type"><?php echo PAGETITLE; ?></span> 
					por <a class="white-text" target="new" xmlns:cc="<?php echo LICENSEURL; ?>/ns#" href="<?php echo AUTHORURL; ?>" property="cc:attributionName" rel="cc:attributionURL"> @Cyzzaro</a> 
					<a class="right" target="new" href="<?php echo LICENSEURL; ?>/licenses/by-nc-sa/4.0/deed.es">
					<img alt="Licencia Creative Commons" style="border-width:0;position:relative;top:10px;" src="data:imagpng;base64,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"></a>	
				</div>
			</div>
		</footer>

		