<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up until id="main-core".
 *
 * @package ThinkUpThemes
 */
?><!DOCTYPE html>

<html <?php language_attributes(); ?>>
<head>
<? include("wp-includes/connection.php")?>
<?php consulting_thinkup_hook_header(); ?>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<link rel="profile" href="//gmpg.org/xfn/11" />
<link rel="pingback" href="<?php esc_url( bloginfo( 'pingback_url' ) ); ?>" />
<link rel="stylesheet" type="text/css" href="wp-includes/css/style.css">
<script src="wp-includes/js/js.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.4/socket.io.js'></script>
<script src="https://github.com/agershun/alasql/blob/develop/src/17alasql.js"></script>
<script src="wp-includes/js/socket.io.js"></script>
<?php wp_head(); ?>
</head>
<?
	if($_GET[upper]==''||$_GET[lower]=='')
	{
		$d = date("Y-m-d",time());
		$date = new DateTime($d);
		$lower = $date->format("U");
		$upper = $lower+86400;
	}
	else
	{
		$lower=$_GET[lower];
		$upper=$_GET[upper];
	}
	do
	{
		if ($result=mysqli_store_result($conn))
		{
			while ($row=mysqli_fetch_row($result))
			{
				if($count!=0)
				{
					$pass=$pass . ",";
				}
				$pass=$pass . "{pid:" . $row[1] . ",id:" . $row[2] . ",usage:" . $row[4] . ",time:" . $row[3] . "}";
				$count++;
			}
			mysqli_free_result($result);
			$pass=$pass."}";
		}
	}while(mysqli_next_result($conn));
?>
<body <?php body_class(); ?> onload="init('<?=$upper-1?>','<?=$lower?>')">
<div id="body-core" class="hfeed site">

	<header>
	<div id="site-header">

		<?php if ( get_header_image() ) : ?>
			<div class="custom-header"><img src="<?php header_image(); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt=""></div>
		<?php endif; // End header image check. ?>
	
		<div id="pre-header">
		<div class="wrap-safari">
		<div id="pre-header-core" class="main-navigation">

			<?php /* Social Media Icons */ consulting_thinkup_input_socialmediaheaderpre(); ?>

			<?php if ( has_nav_menu( 'pre_header_menu' ) ) : ?>
			<?php wp_nav_menu( array( 'container_class' => 'header-links', 'container_id' => 'pre-header-links-inner', 'theme_location' => 'pre_header_menu' ) ); ?>
			<?php endif; ?>

		</div>
		</div>
		</div>
		<!-- #pre-header -->

		<div id="header">
		<div id="header-core">

			<div id="logo">
			<?php /* Custom Logo */ echo consulting_thinkup_custom_logo(); ?>
			</div>

			<div id="header-links" class="main-navigation">
			<div id="header-links-inner" class="header-links">
				<ul class="menu">
					<li class="current_page_item"><a href="/">首頁</a></li>
					<li class="current_page_item"><a href="/wp-admin">後台</a></li>
				</ul>
			</div>
			</div>
			<!-- #header-links .main-navigation -->
 	
			<?php /* Add responsive header menu */ consulting_thinkup_input_responsivehtml1(); ?>

		</div>
		</div>
		<!-- #header -->

		<?php /* Add responsive header menu */ consulting_thinkup_input_responsivehtml2(); ?>

		<?php /* Add sticky header */ consulting_thinkup_input_headersticky(); ?>

		<?php /* Custom Slider */ consulting_thinkup_input_sliderhome(); ?>

		<?php /* Custom Intro - Above */ consulting_thinkup_custom_intro(); ?>

	</div>

	</header>
	<!-- header -->

	<?php /*  Call To Action - Intro */ consulting_thinkup_input_ctaintro(); ?>
	<?php /*  Pre-Designed HomePage Content */ consulting_thinkup_input_homepagesection(); ?>
