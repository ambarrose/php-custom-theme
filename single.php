<?php get_header(); ?>
  <div class="container fluid mt-5 mb-5">
     <div class="row">
        <?php
        if (have_posts() ) :
            while (have_posts() ) : the_post(); ?>

            <!-- here's the area where it loops over each post -->
            <div class="col-12">
            <h1 class="card-title"><?php the_title() ?></h1>
            </div>
            <div class="col">
                 <div class="card mb-3" style="width: 100%">
                   <div class="card-body bg-dark">
                     <p class="card-text"><?php the_content() ?></p>
                   </div>
                 </div>
            </div>
        <?php endwhile;
            else : echo '<p>There are no posts!</p>';
        endif;
        ?>
        <!-- <p>This is the index template</p> -->
</body>

<?php get_footer(); ?>
