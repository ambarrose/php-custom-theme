<?php get_header(); ?>
  <div class="container fluid mt-5 mb-5">
     <div class="row">
        <?php
        if (have_posts() ) :
            while (have_posts() ) : the_post(); ?>

            <!-- here's the area where it loops over each post -->
            <div id="image">
            <h1 class="card-title"><?php the_title() ?></h1>
             <?php the_post_thumbnail("large"); ?>
            </div>

            <button id="Btn" class="my-3 btn btn-primary">back to all sport</button>
        <?php endwhile;
            else : echo '<p>There are no posts!</p>';
        endif;
        ?>
        <!-- <p>This is the index template</p> -->
</body>

<?php get_footer(); ?>
