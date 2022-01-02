<?php

$query = $graph_viva_aerobus_diario;

$obj_conn_params_SQLSERVER = array('Database' => COBRANZABD, 'Uid' => COBRANZAUSER, 'PWD' => COBRANZAPWD);
$obj_conn_SQLSERVER = sqlsrv_connect(COBRANZASRVR, $obj_conn_params_SQLSERVER);

$obj_rst_aditional_params_SQLSERVER = array();
$obj_rst_optionals_SQLSERVER = array('Scrollable' => SQLSRV_CURSOR_KEYSET);

$obj_rst = sqlsrv_query($obj_conn_SQLSERVER, $query, $obj_rst_aditional_params_SQLSERVER, $obj_rst_optionals_SQLSERVER);

if ($obj_rst == FALSE)
    die(errorConnSQLSRVR(sqlsrv_errors()));

$graph_field_name = '';
$datasets_VBABEX = '';
$datasets_VBABEZ = '';
$datasets_VBABEW = '';
$datasets_VBABEY = '';
$datasets_VBABEV = '';
$periods = '';

while ($rst = sqlsrv_fetch_array($obj_rst, SQLSRV_FETCH_ASSOC)) {

    $graph_field_name = $graph_field_name . '"' . $rst['Fecha'] . '",';

    $datasets_VBABEX = $datasets_VBABEX . '"' . $rst['VBABEX'] . '", ';
    $datasets_VBABEZ = $datasets_VBABEZ . '"' . $rst['VBABEZ'] . '", ';
    $datasets_VBABEW = $datasets_VBABEW . '"' . $rst['VBABEW'] . '", ';
    $datasets_VBABEY = $datasets_VBABEY . '"' . $rst['VBABEY'] . '", ';
    $datasets_VBABEV = $datasets_VBABEV . '"' . $rst['VBABEV'] . '", ';
}

?>

<div style="height: 35vh; width: 100%">
    <canvas id="graph_acumulado_mensual"></canvas>
</div>
<script type="text/javascript">
    new Chart(document.getElementById("graph_acumulado_mensual"), {
        type: 'bar',
        data: {
            labels: [<?php echo $graph_field_name; ?>],
            datasets: [{
                label: "VB Seguro de Corporativo Básico",
                fill: true,
                data: [<?php echo $datasets_VBABEY; ?>],
                borderColor: <?php echo "'" . $white_rgb_1 . "'"; ?>,
                backgroundColor: <?php echo "'" . $green_rgb_5 . "'"; ?>,
            }, {
                label: "VB Seguro Esencial",
                fill: true,
                data: [<?php echo $datasets_VBABEV; ?>],
                borderColor: <?php echo "'" . $white_rgb_1 . "'"; ?>,
                backgroundColor: <?php echo "'" . $green_rgb_4 . "'"; ?>,
            }, {
                label: "VB Seguro Viajero Premium",
                fill: true,
                data: [<?php echo $datasets_VBABEX; ?>],
                borderColor: <?php echo "'" . $white_rgb_1 . "'"; ?>,
                backgroundColor: <?php echo "'" . $green_rgb_3 . "'"; ?>,
            }, {
                label: "VB Seguro Viajero Básico",
                fill: true,
                data: [<?php echo $datasets_VBABEW; ?>],
                borderColor: <?php echo "'" . $white_rgb_1 . "'"; ?>,
                backgroundColor: <?php echo "'" . $green_rgb_2 . "'"; ?>,
            }, {
                label: "VB Seguro Corporativo Premium",
                fill: true,
                data: [<?php echo $datasets_VBABEZ; ?>],
                borderColor: <?php echo "'" . $white_rgb_1 . "'"; ?>,
                backgroundColor: <?php echo "'" . $green_rgb_1 . "'"; ?>,
            }]
        },
        options: {
            title: {
                display: false,
                text: 'Registro mensual'
            },
            responsive: true,
            maintainAspectRatio: false,
            tooltips: {
                mode: 'index',
                intersect: true,
            },
            legend: {
                display: true,
                position: 'right',
                labels: {
                    fontSize: 10,
                }
            },
            layout: {
                padding: {
                    left: 1,
                    right: 1,
                    top: 1,
                    bottom: 1,
                }
            },
            scales: {
                xAxes: [{
                    display: true,
                    stacked: true,
                    gridLines: {
                        display: false
                    },
                }],
                yAxes: [{
                    display: true,
                    stacked: true,
                    gridLines: {
                        display: false
                    },
                }],
            }
        }
    });
</script>