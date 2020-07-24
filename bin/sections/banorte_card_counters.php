<?php 
/**
 * CardCounter (Banorte).
 * 
 * Imprime en pantalla 4 CardCounters con informacion especifica para Cliente Banorte.
 * 
 * @static
 * @return string CardCounters (Banorte).
 */
//include_once '../head.php'; ?>
<div class="section container row">

    <div class="col l3 m4 s12">
        <div class="card">
            <div class="card-content teal-text center-align">
                <div class="row">
                    <a href="<?php echo GLOBALPATH.'/pages/banorte/recurrencia.php';?>">
                        <div class="col s9">
                            <span class="card-title teal-text small truncate">
                                Recurrencia
                            </span>
                        </div>
                    </a>
                    <div class="col s3">
                        <i class="material-icons small">credit_card</i>
                    </div>
                </div>
            </div>
            <div class="card-tabs">
                <ul class="tabs tabs-fixed-width ">
                    <li class="tab"><a class="active" href="#cobros-actual"><?php echo shortMonthName(date("m",strtotime(date("Y-m-d")."- 0 days"))); ?></a></li>
                    <li class="tab"><a href="#cobros-anterior"><?php echo shortMonthName(date("m",strtotime(date("Y-m-d")."- 1 month"))); ?></a></li>
                    <li class="tab"><a href="#cobros-anterior_1"><?php echo shortMonthName(date("m",strtotime(date("Y-m-d")."- 2 month"))); ?></a></li>
                    <li class="tab"><a href="#cobros-acumulado">Acum.</a></li>
                </ul>
            </div>
            <div class="card-action">
                <div id="cobros-actual">
                    <span class="card-title teal-text small truncate"><?php echo getUniqueCountValueFromDB($count_cobros_actual,"Cuantos"); ?></span>
                    <?php echo generalMiniGraph($graph_cobros_actual, 'Actual', 'Cobros', $teal_rgb_5); ?>
                </div>
                <div id="cobros-anterior">
                    <span class="card-title teal-text small truncate"><?php echo getUniqueCountValueFromDB($count_cobros_anterior,"Cuantos"); ?></span>
                    <?php echo generalMiniGraph($graph_cobros_anterior, 'Anterior', 'Cobros', $teal_rgb_5); ?>
                </div>
                <div id="cobros-anterior_1">
                    <span class="card-title teal-text small truncate"><?php echo getUniqueCountValueFromDB($count_cobros_anterior_1,"Cuantos"); ?></span>
                    <?php echo generalMiniGraph($graph_cobros_anterior_1, 'Anterior_1', 'Cobros', $teal_rgb_5); ?>
                </div>
                <div id="cobros-acumulado">
                    <span class="card-title teal-text small truncate"><?php echo getUniqueCountValueFromDB($count_cobros_acumulado,"Cuantos"); ?></span>
                    <?php echo generalMiniGraph($graph_cobros_acumulado, 'Acumulado', 'Cobros', $teal_rgb_5); ?>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col l3 m4 s12">
        <div class="card">
            <div class="card-content indigo-text center-align">
                <div class="row">
                    <a href="<?php echo GLOBALPATH.'/pages/banorte/afiliados.php';?>">
                        <div class="col s9">
                            <span class="card-title indigo-text small truncate">
                                Afiliados
                            </span>
                        </div>
                    </a>
                    <div class="col s3">
                        <i class="material-icons small">face</i>
                    </div>
                </div>
            </div>
            <div class="card-tabs">
                <ul class="tabs tabs-fixed-width">
                    <li class="tab"><a class="active" href="#afiliados-actual"><?php echo shortMonthName(date("m",strtotime(date("Y-m-d")."- 0 days"))); ?></a></li>
                    <li class="tab"><a href="#afiliados-anterior"><?php echo shortMonthName(date("m",strtotime(date("Y-m-d")."- 1 month"))); ?></a></li>
                    <li class="tab"><a href="#afiliados-anterior_1"><?php echo shortMonthName(date("m",strtotime(date("Y-m-d")."- 2 month"))); ?></a></li>
                    <li class="tab"><a href="#afiliados-acumulado">Acum.</a></li>
                </ul>
            </div>
            <div class="card-action">
                <div id="afiliados-actual">
                    <span class="card-title indigo-text small truncate"><?php echo getUniqueCountValueFromDB($count_afiliados_actual,"Cuantos"); ?></span>
                    <?php echo generalMiniGraph($graph_afiliados_actual, 'Actual', 'Afiliados', $indigo_rgb_5); ?>
                </div>
                <div id="afiliados-anterior">
                    <span class="card-title indigo-text small truncate"><?php echo getUniqueCountValueFromDB($count_afiliados_anterior,"Cuantos"); ?></span>
                    <?php echo generalMiniGraph($graph_afiliados_anterior, 'Anterior', 'Afiliados', $indigo_rgb_5); ?>
                </div>
                <div id="afiliados-anterior_1">
                    <span class="card-title indigo-text small truncate"><?php echo getUniqueCountValueFromDB($count_afiliados_anterior_1,"Cuantos"); ?></span>
                    <?php echo generalMiniGraph($graph_afiliados_anterior_1, 'Anterior_1', 'Afiliados', $indigo_rgb_5); ?>
                </div>
                <div id="afiliados-acumulado">
                    <span class="card-title indigo-text small truncate"><?php echo getUniqueCountValueFromDB($count_afiliados_acumulado,"Cuantos"); ?></span>
                    <?php echo generalMiniGraph($graph_afiliados_acumulado, 'Acumulado', 'Afiliados', $indigo_rgb_5); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="col l3 m4 s12">
        <div class="card">
            <div class="card-content red-text center-align">
                <div class="row">
                    <a href="<?php echo GLOBALPATH.'/pages/banorte/bajas.php';?>">
                        <div class="col s9">
                            <span class="card-title red-text small truncate">
                                Bajas
                            </span>
                        </div>
                    </a>
                    <div class="col s3">
                        <i class="material-icons small">trending_down</i>
                    </div>
                </div>
            </div>
            <div class="card-tabs">
                <ul class="tabs tabs-fixed-width">
                    <li class="tab"><a class="active" href="#bajas-actual"><?php echo shortMonthName(date("m",strtotime(date("Y-m-d")."- 0 days"))); ?></a></li>
                    <li class="tab"><a href="#bajas-anterior"><?php echo shortMonthName(date("m",strtotime(date("Y-m-d")."- 1 month"))); ?></a></li>
                    <li class="tab"><a href="#bajas-anterior_1"><?php echo shortMonthName(date("m",strtotime(date("Y-m-d")."- 2 month"))); ?></a></li>
                    <li class="tab"><a href="#bajas-acumulado">Acum.</a></li>
                </ul>
            </div>
            <div class="card-action">
                <div id="bajas-actual">
                    <span class="card-title red-text small truncate"><?php echo getUniqueCountValueFromDB($count_bajas_actual,"Cuantos"); ?></span>
                    <?php echo generalMiniGraph($graph_bajas_actual, 'Actual', 'Bajas', $red_rgb_5); ?>
                </div>
                <div id="bajas-anterior">
                    <span class="card-title red-text small truncate"><?php echo getUniqueCountValueFromDB($count_bajas_anterior,"Cuantos"); ?></span>
                    <?php echo generalMiniGraph($graph_bajas_anterior, 'Anterior', 'Bajas', $red_rgb_5); ?>
                </div>
                <div id="bajas-anterior_1">
                    <span class="card-title red-text small truncate"><?php echo getUniqueCountValueFromDB($count_bajas_anterior_1,"Cuantos"); ?></span>
                    <?php echo generalMiniGraph($graph_bajas_anterior_1, 'Anterior_1', 'Bajas', $red_rgb_5); ?>
                </div>
                <div id="bajas-acumulado">
                    <span class="card-title red-text small truncate"><?php echo getUniqueCountValueFromDB($count_bajas_acumulado,"Cuantos"); ?></span>
                    <?php echo generalMiniGraph($graph_bajas_acumulado, 'Acumulado', 'Bajas', $red_rgb_5); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="col l3 m4 s12">
        <div class="card">
            <div class="card-content blue-grey-text center-align">
                <div class="row">
                    <div class="col s9">
                        <span class="card-title blue-grey-text small truncate">
                            Reservar
                        </span>
                    </div>
                    <div class="col s3">
                        <i class="material-icons small">notifications_paused</i>
                    </div>
                </div>
            </div>
            <div class="card-tabs">
                <ul class="tabs tabs-fixed-width">
                    <li class="tab"><a href="#reservar-actual"><?php echo shortMonthName(date("m",strtotime(date("Y-m-d")."- 0 days"))); ?></a></li>
                    <li class="tab"><a href="#reservar-anterior"><?php echo shortMonthName(date("m",strtotime(date("Y-m-d")."- 1 month"))); ?></a></li>
                    <li class="tab"><a href="#reservar-anterior_1"><?php echo shortMonthName(date("m",strtotime(date("Y-m-d")."- 2 month"))); ?></a></li>
                    <li class="tab active">
                        <a class="active" href="#reservar-acumulado">Acum.</a></li>
                </ul>
            </div>
            <div class="card-action">
                <div id="reservar-actual">
                    <span class="card-title blue-grey-text small truncate"><?php echo getUniqueCountValueFromDB($count_reservar_actual,"Cuantos"); ?></span>
                    <?php echo generalMiniGraph($graph_reservar_actual, 'Actual', 'Reservar', $blue_grey_rgb_5); ?>
                </div>
                <div id="reservar-anterior">
                    <span class="card-title blue-grey-text small truncate"><?php echo getUniqueCountValueFromDB($count_reservar_anterior,"Cuantos"); ?></span>
                    <?php echo generalMiniGraph($graph_reservar_anterior, 'Anterior', 'Reservar', $blue_grey_rgb_5); ?>
                </div>
                <div id="reservar-anterior_1">
                    <span class="card-title blue-grey-text small truncate"><?php echo getUniqueCountValueFromDB($count_reservar_anterior_1,"Cuantos"); ?></span>
                    <?php echo generalMiniGraph($graph_reservar_anterior_1, 'Anterior_1', 'Reservar', $blue_grey_rgb_5); ?>
                </div>
                <div id="reservar-acumulado">
                    <span class="card-title blue-grey-text small truncate"><?php echo getUniqueCountValueFromDB($count_reservar_acumulado,"Cuantos"); ?></span>
                    <?php echo generalMiniGraph($graph_reservar_acumulado, 'Acumulado', 'Reservar', $blue_grey_rgb_5); ?>
                </div>
            </div>
        </div>
    </div>

</div>
<?php //include_once '../jquery.php'; ?>