<?php
include_once '../../bin/head.php';
?>

<body>

  <header>
    <?php
    pageNavHead('Asistencias programadas');
    include_once '../../bin/menu.php';
    ?>

  </header>

  <main>
    <!--
		<div class="section">
			<div class="container row center">
				<p class="caption">
					El color indica la prioridad o el tiempo de atención.
				</p>
			</div>
			<div class="container section row">
				<div class="col l3 m3 s6">
					<div class="card black center">
						<span class="card-title white-text center">Concluir hoy</span>
					</div>
				</div>
				<div class="col l3 m3 s6">
					<div class="card red center">
						<span class="card-title white-text center">Atender mañana</span>
					</div>
				</div>
				<div class="col l3 m3 s6">
					<div class="card yellow center">
						<span class="card-title black-text center">Atender en dos días</span>
					</div>
				</div>
				<div class="col l3 m3 s6">
					<div class="card green center">
						<span class="card-title white-text center">Atender esta semana</span>
					</div>
				</div>
			</div>
		</div>
	-->


    <?php
    formProgramedAsistences();
    ?>

  </main>

  <?php
  include_once '../../bin/footer.php';
  include_once '../../bin/jquery.php';
  ?>

</body>

</html>