
<?php include 'init.php'; ?>
<!DOCTYPE html>
<html lang="<?php echo LANG; ?>">

	<head>

		<!-- BEGIN PAGE TITLE -->
		<title><?php echo PAGETITLE; ?></title>
		<!-- END PAGE TITLE -->

		<!-- BEGIN META TAGS -->
		<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
		<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1.0,user-scalable=no">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="DateCreated" content="Fri, 2 August 2019 09:25:00 GMT-6">
		<meta name="Author" content="<?php echo AUTHORNAME; ?>">
		<meta name="CopyRight" content="<?php echo AUTHORNAME; ?>">
		<meta name="Resource-type" content="Dashboard & Search">
		<link rev="made" href="mailto:cesarvalencia@live.com.mx">
		<!-- END META TAGS -->
		
		<!-- BEGIN FAV ICON AND APP ICON -->
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
		<link rel="icon" type="image/png" href="<?php echo GLOBALPATH; ?>/res/ico/favicon-194x194.png" sizes="194x194">
		<link rel="icon" type="image/png" href="<?php echo GLOBALPATH; ?>/res/ico/favicon-96x96.png" sizes="96x96">
		<link rel="icon" type="image/png" href="<?php echo GLOBALPATH; ?>/res/ico/android-chrome-192x192.png" sizes="192x192">
		<link rel="icon" type="image/png" href="<?php echo GLOBALPATH; ?>/res/ico/favicon-16x16.png" sizes="16x16">
		<meta name="application-name" content="<?php echo PAGETITLE; ?>">
		<meta name="theme-color" content="<?php echo pageColor(); ?>">
		<meta name="msapplication-TileColor" content="<?php echo pageColor(); ?>">
		<meta name="msapplication-TileImage" content="<?php echo GLOBALPATH; ?>/res/ico/mstile-144x144.png">
		<meta name="msapplication-tap-highlight" content="no">
		<link rel="manifest" href="<?php echo GLOBALPATH; ?>/res/ico/manifest.json">
		<!-- END FAV ICON AND APP ICON -->

		<!-- BEGIN CSS ENVIRON -->
		<link href="<?php echo GLOBALPATH; ?>/res/css/material.css" type="text/css" rel="stylesheet" media="screen,projection">
		<link href="<?php echo GLOBALPATH; ?>/res/css/mediaHacks.css" type="text/css" rel="stylesheet" media="screen,projection">
		<link href="<?php echo GLOBALPATH; ?>/res/css/colors.css" type="text/css" rel="stylesheet" media="screen,projection">
		<link href="<?php echo GLOBALPATH; ?>/res/css/font.css" type="text/css" rel="stylesheet" media="screen,projection">
		<link href="<?php echo GLOBALPATH; ?>/res/css/iconFont.css" type="text/css" rel="stylesheet" media="screen,projection">
		<link href="<?php echo GLOBALPATH; ?>/res/css/keyframes.css" type="text/css" rel="stylesheet" media="screen,projection">
		<link href="<?php echo GLOBALPATH; ?>/res/css/gitCommit.css" type="text/css" rel="stylesheet" media="screen,projection">
		<link href="<?php echo GLOBALPATH; ?>/res/css/dataTables.css" type="text/css" rel="stylesheet" media="screen,projection">
		<!-- END CSS ENVIRON -->

		<!-- BEGIN GRAPHS ENVIRON -->
		<script type="text/javascript" src="<?php echo GLOBALPATH; ?>/res/js//charts.js"></script>
		<!-- END GRAPHS ENVIRON -->

		<!-- BEGIN META ROBOTS AND CACHE -->
		<meta http-equiv="cache-control" content="no-cache">
		<meta name="robots" content="noindex,nofollow">
		<meta name="Revisit-after" content="30 days">
		<!-- END META ROBOTS AND CACHE -->

		<?php 
			/* AutoRefresh (Opcional, solo si se encuentra definido en init.php) */
			if ($refresh_time > 0) {
				echo '<!-- AUTO REFRESH --><meta http-equiv="refresh" content="'.$refresh_time.'">';
			}
		?>

	</head>
	
	<?php include_once 'generalPreloader.php'; ?>
