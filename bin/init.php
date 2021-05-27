<?php

setlocale(LC_TIME, 'spanish'); 

define('GLOBALPATH','/sav-igs');
define('AUTHORNAME','César Valencia');
define('AUTHORMAIL','cesarvalencia@live.com.mx');
define('AUTHORURL','https://github.com/Cyzzaro');
define('SUPPORTMAIL','cvalencia@igroupsolution.com');
define('NAMECIA','IGS Asistencia, S.A. de C.V.');
define('PHONECIA','55 1219 6267');
define('SYSMAIL','cesarvalencia@live.com.mx');
define('LICENSEURL','http://creativecommons.org');
define('DISCLAIMER','Esta obra se distribuye bajo una Licencia CC-BY-NC-SA 4.0');
define('LICENSEIMAGE','data:imagpng;base64,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');

define('CHARSET','UTF-8');
define('LANG','es-MX');
define('PAGETITLE','SAV - IGS (Mexico) ');
define('PAGEDESC','Portal de consulta y validación de capitas');
define('KEYWORDS','sav,sistema,alterno,validacion,igs,asistencia,cobros,facturacion,analisis,cesar,cesar valencia,cesar valencia campuzano,cyzzaro,html,php,css,js,javascript,jquery');
define('PROGRAM','sublimetext,dreamweaver');

define("TABLEEXPORT","'example'");
define("TABLEINFOEXPORT","'resumen_solicitado'");
	
include_once 'conn/access.php';
include_once 'conn/queries.php';
include_once 'conn/database_mssqlserver.php';

include_once 'env/returns.php';
include_once 'env/color_profile.php';

include_once 'sections/results_of_search.php';
//include_once 'sections/modal_lead_info.php'; // @todo en progreso...

$tiempo_de_actualizacion_automatica_HTML = 0;

?>