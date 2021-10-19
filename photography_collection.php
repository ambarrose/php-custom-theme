<?php

/*

Template Name: Photography Collection Page Template

*/

?>

<?php get_header(); ?>
  <div class="container fluid mt-5 mb-5">
     <div class="row">
       <div class="col-12">
        <h3>Enjoy these photos</h3>
      </div>
      <?php
      query_posts(array(
        'post_type' => photo
        )
      );
      ?>

<!-- DOES NOT WORK!!!! -->
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
          </ol>

          <div class="carousel-inner">
            <?php
            if (have_posts() ) : $postcount = 0;
                while (have_posts() ) : the_post();
            ?>
            <div class="carousel-item active">
              <?php the_post_thumbnail("medium_large", ['class' => 'card-image-top']); ?>
              <div class="carousel-caption">
                <?php the_title() ?>
                <?php the_content() ?>
              </div>
            </div>
          </div>
          <div class="carousel-inner">
            <div class="carousel-item ">
              <?php the_post_thumbnail("medium_large", ['class' => 'card-image-top']); ?>
            </div>
          </div>
          <div class="carousel-inner">
            <div class="carousel-item ">
              <?php the_post_thumbnail("medium_large", ['class' => 'card-image-top']); ?>
            </div>
          </div>

          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>

            <!-- here's the area where it loops over each post -->

        <?php endwhile;
            else : echo '<p>There are no posts!</p>';
        endif;
        ?>
      </div>
    </div>
        <!-- <p>This is the index template</p> -->
</body>

<?php get_footer(); ?>
