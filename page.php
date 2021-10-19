<?php get_header(); ?>
  <div class="container fluid mt-5 mb-5">
     <div class="row">
        <?php
        if (have_posts() ) :
            while (have_posts() ) : the_post(); ?>
            <div class="col-12">
             <h3><?php the_title() ?></h3>
             <!-- here's the area where it loops over each post -->
                 <?php the_content(); ?>
           </div>
            
        <?php endwhile;
            else : echo '<p>There are no posts!</p>';
        endif;
        ?>
        <!-- <p>This is the index template</p> -->
</body>

<?php get_footer(); ?>
