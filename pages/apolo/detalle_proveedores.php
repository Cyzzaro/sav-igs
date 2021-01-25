<?php
include_once '../../bin/head.php';
?>

<body>

  <header>
    <?php
    pageNavHead('Detalle - Proveedores');
    include_once '../../bin/menu.php';
    ?>

  </header>

  <main>

    <?php
    formReportProveedor();
    ?>

  </main>

  <?php
  include_once '../../bin/footer.php';
  include_once '../../bin/jquery.php';
  ?>

</body>

</html>