<?php

/*

Template Name: Fruit Collection Page Template

*/

?>

<?php get_header(); ?>
  <div class="container fluid mt-5 mb-5">
     <div class="row">
       <div class="col-12">
        <h3>Check out my fruit</h3>
      </div>
      <?php
      query_posts(array(
        'post_type' => fruit
        )
      );
      ?>
        <?php
        if (have_posts() ) : $postcount = 0;
            while (have_posts() ) : the_post();
        ?>

            <!-- here's the area where it loops over each post -->
            <div class="col col-md-4">
                 <div class="card mb-3" style="width: 415px">
                   <?php the_post_thumbnail("medium_large", ['class' => 'card-image-top']); ?>
                   <div class="card-body bg-dark">
                     <h5 class="card-title">
                       <?php the_title() ?>
                     </h5>
                      <?php echo get_the_term_list($post->ID, 'attribute', '<div class="custom-class">', ' ', '</div>'); ?>
                     <p>Posted: <?php the_date('F j, Y'); ?></p>
                     <p>Posted by: <?php the_author('F j, Y'); ?></p>
                     <p><?php the_time(); ?></p>
                     <p class="card-text"><?php the_excerpt(); ?></p>
                     <a href="<?php the_permalink(); ?>" class="btn btn-primary">
                     Read more
                     </a>
                   </div>
                 </div>
            </div>
      </div>
    </div>
  <?php endwhile;
      else : echo '<p>There are no posts!</p>';
  endif;
  ?>
  <a href="<?php echo get_page_link(get_page_by_path('fruit')) ?>">Back to the fruit collection</a>
        <!-- <p>This is the index template</p> -->
</body>

<?php get_footer(); ?>
