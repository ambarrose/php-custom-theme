<?php get_header(); ?>
  <div class="container fluid mt-5 mb-5">
     <div class="row">
        <?php
        if (have_posts() ) :
            while (have_posts() ) : the_post(); ?>
            <!-- here's the area where it loops over each post -->
						<div class="col-12">

            <?php the_post_thumbnail("large", ['class'=>'individual-news-photo']); ?>
            </div>
            <div class="col">
                 <div class="card mb-3" style="width: 100%">
                   <div class="card-body">
                     <p class="card-text col-12"><?php the_content() ?></p>
                   </div>
                 </div>
            </div>
            <div class="col-12">
              <a class="btn btn-primary" href="<?php echo home_url(); ?>">Back to home</a>
            </div>
        <?php endwhile;
            else : echo '<p>There are no posts!</p>';
        endif;
        ?>
        <!-- <p>This is the single.php template</p> -->
</body>

<?php get_footer(); ?>
