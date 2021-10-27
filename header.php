<!doctype html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="<?php bloginfo('charset');?>">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- Bootstrap CSS -->
		<!-- CSS only -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
		<title><?php bloginfo('name');?></title>
	</head>

  <body <?php body_class(); ?>>
  <?php wp_head(); ?>

		  <nav id="nav" class="navbar navbar-expand-lg">

				<div class="container">
		      <a class="navbar" href="<?php echo home_url(); ?>"><img id="logo" src="<?php bloginfo('stylesheet_directory') ?>/images/eco-logogreenBG.png" alt="logo"></a>
					<a id="about-link" class="nav-link text-light" href="<?php echo get_page_link(get_page_by_path('about-us')); ?>">About</a>
					<a id="join-link" class="nav-link text-light " href="<?php echo get_page_link(get_page_by_path('members')); ?>">Join us</a>
		    </div>
		  </nav>
