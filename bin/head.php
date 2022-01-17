<!DOCTYPE html>

<?php
include 'init.php';
?>

<html lang="<?php echo LANG; ?>">

<head>
	<title><?php echo PAGETITLE; ?></title>
	
	<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
	<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1.0,user-scalable=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="DateCreated" content="Fri, 2 August 2019 09:25:00 GMT-6">
	<meta name="Author" content="<?php echo AUTHORNAME; ?>">
	<meta name="CopyRight" content="<?php echo AUTHORNAME; ?>">
	<meta name="Resource-type" content="Dashboard & Search">
	<link rev="made" href="mailto:cvalencia@igroupsolution.com">

	<link rel="apple-touch-icon" sizes="57x57" href="<?php echo GLOBALPATH; ?>/res/ico/apple-touch-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="<?php echo GLOBALPATH; ?>/res/ico/apple-touch-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo GLOBALPATH; ?>/res/ico/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="<?php echo GLOBALPATH; ?>/res/ico/apple-touch-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo GLOBALPATH; ?>/res/ico/apple-touch-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="<?php echo GLOBALPATH; ?>/res/ico/apple-touch-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="<?php echo GLOBALPATH; ?>/res/ico/apple-touch-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="<?php echo GLOBALPATH; ?>/res/ico/apple-touch-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo GLOBALPATH; ?>/res/ico/apple-touch-icon-180x180.png">
	<link rel="icon" type="image/png" href="<?php echo GLOBALPATH; ?>/res/ico/favicon-32x32.png" sizes="32x32">
	<link rel="icon" type="image/png" href="<?php echo GLOBALPATH; ?>/res/ico/favicon-96x96.png" sizes="96x96">
	<link rel="icon" type="image/png" href="<?php echo GLOBALPATH; ?>/res/ico/android-chrome-192x192.png" sizes="192x192">
	<link rel="icon" type="image/png" href="<?php echo GLOBALPATH; ?>/res/ico/favicon-16x16.png" sizes="16x16">
	<meta name="application-name" content="<?php echo PAGETITLE; ?>">
	<meta name="theme-color" content="<?php echo activePagePrimaryColor(); ?>">
	<meta name="msapplication-TileColor" content="<?php echo activePagePrimaryColor(); ?>">
	<meta name="msapplication-TileImage" content="<?php echo GLOBALPATH; ?>/res/ico/mstile-144x144.png">
	<meta name="msapplication-tap-highlight" content="no">
	<link rel="manifest" href="<?php echo GLOBALPATH; ?>/res/ico/manifest.json">

	<link href="<?php echo GLOBALPATH; ?>/res/css/material.css" type="text/css" rel="stylesheet" media="screen,projection">
	<link href="<?php echo GLOBALPATH; ?>/res/css/media_hack.css" type="text/css" rel="stylesheet" media="screen,projection">
	<link href="<?php echo GLOBALPATH; ?>/res/css/color_environ.css" type="text/css" rel="stylesheet" media="screen,projection">
	<link href="<?php echo GLOBALPATH; ?>/res/css/font_environ.css" type="text/css" rel="stylesheet" media="screen,projection">
	<link href="<?php echo GLOBALPATH; ?>/res/css/key_frames.css" type="text/css" rel="stylesheet" media="screen,projection">
	<link href="<?php echo GLOBALPATH; ?>/res/css/git_commit.css" type="text/css" rel="stylesheet" media="screen,projection">
	<link href="<?php echo GLOBALPATH; ?>/res/css/data_tables.css" type="text/css" rel="stylesheet" media="screen,projection">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" media="screen,projection">

	<script type="text/javascript" src="<?php echo GLOBALPATH; ?>/res/js/chart_js.js"></script>

	<meta name="robots" content="noindex,nofollow">
	<meta name="Revisit-after" content="30 days">

	<?php
	if ($tiempo_de_actualizacion_automatica_HTML > 0) {
		echo '<!-- AUTO REFRESH --><meta http-equiv="refresh" content="' . $tiempo_de_actualizacion_automatica_HTML . '">';
	}
	?>

</head>

<?php include_once 'preloader.php'; ?>