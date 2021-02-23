<footer class="page-footer <?php echo activePagePrimaryColor(); ?>">
	<div class="container">
		<div class="row">
			<div class="col l9 m9 s12">
				<div class="card-panel-git grey lighten-5 z-depth-1">
					<div class="row valign-wrapper">
						<span class="col l1 m2 s4 gh-photo"></span>
						<div class="col l11 m10 s8">
							<div class="github-commit">
								<div class="commit left-align">
									<ul>
										<li>
											<span class="message"></span>
											<span href="" class="sha"></span>
											<span class="additions green-text bold"></span>,
											<span class="deletions red-text bold"></span>
										</li>
										<li><span class="date"></span>
											por <span class="author"></span>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col l3 m3 s12">
				<h5 class="white-text">Soporte</h5>
				<ul>
					<li class="white-text"><i class="material-icons tiny prefix">phone</i> <?php echo PHONECIA; ?></li>
					<li><a class="white-text" href="mailto:<?php echo SUPPORTMAIL . '?Subject=Soporte para sitio - ' . PAGETITLE; ?>" title="Envia tus comentarios y sugerencias"><i class="material-icons tiny prefix">mail</i>
							<?php echo SUPPORTMAIL; ?></a></li>
				</ul>
			</div>
		</div>
		<br>
	</div>
	<div class="footer-copyright">
		<div class="container">
			© 2019-<script type="text/javascript">
				document.write(new Date().getFullYear());
			</script>
			<span xmlns:dct="http://purl.org/dc/terms/" href="http://purl.org/dc/dcmitype/InteractiveResource" property="dct:title" rel="dct:type"><?php echo PAGETITLE; ?></span>
			por <a class="white-text" target="new" xmlns:cc="<?php echo LICENSEURL; ?>/ns#" href="<?php echo AUTHORURL; ?>" property="cc:attributionName" rel="cc:attributionURL"> @Cyzzaro</a>
			<a class="right" target="new" href="<?php echo LICENSEURL; ?>/licenses/by-nc-sa/4.0/deed.es">
				<img alt="Licencia Creative Commons" style="border-width:0;position:relative;top:10px;" src="<?php echo LICENSEIMAGE; ?>"></a>
		</div>
	</div>
</footer>