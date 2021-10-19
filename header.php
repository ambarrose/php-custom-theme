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

		  <nav id="pastel-nav" class="navbar navbar-expand-lg navbar-light bg-info">
		    <div class="container-fluid">
		      <a class="navbar" href="<?php echo home_url(); ?>"><img id="logo" src="<?php bloginfo('stylesheet_directory') ?>/images/ambarRound.png" alt="logo"></a>
		      <button class="navbar-toggler text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
		        <span class="navbar-toggler-icon"></span>
		      </button>
		      <div class="collapse navbar-collapse" id="navbarNav">
		        <ul class="navbar-nav text-dark">
		          <?php $menu_args = ['theme_location' => 'primary', 'menu_class' => "navbar-nav"]; ?>
		          <?php wp_nav_menu($menu_args); ?>
		        </ul>
		      </div>
		    </div>
		  </nav>
