<?php get_header(); ?>
	 <div class="container fluid mt-5 mb-5">
			<div class="row">
				<div class="col-12">
				 <!-- <h3>Showing all posts - index.php</h3> -->
			 </div>
				 <?php
				 if (have_posts() ) :
						 while (have_posts() ) : the_post(); ?>

				 <?php endwhile;
						 else : echo '<p>There are no posts!</p>';
				 endif;
				 ?>
			 </div>
		 </div>
				 <!-- <p>This is the index template</p> -->
 </body>

 <?php get_footer(); ?>
© 2021 GitHub, Inc.
Terms
Privacy
Security
