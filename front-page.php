<?php get_header(); ?>


    <div id="full-page">
      <img src="images/fern.jpg" alt="">

        <h1 class="welcome text-center">Environment & Conservation <br>
          Organisations of Aotearoa New Zealand</h1>
    </div>

    <div id="signUp">
      <button id="link" type="button" name="button" href="<?php echo get_page_link(get_page_by_path('join-us')); ?>">Sign up link</button>
    </div>


    <div class="container fluid mt-5 mb-5">
     <div class="row">
       <div class="col-12">
        <h3>News items</h3>
      </div>
        <?php
        if (have_posts() ) :
            while (have_posts() ) : the_post(); ?>

            <!-- here's the area where it loops over each post -->
            <div class="col col-md-3">
                 <div class="card mb-3" style="width: 100%">
                   <div class="card-body">
                     <h5 class="card-title">
                       <a href="<?php the_permalink(); ?>">
                       <?php the_title() ?>
                       </a>
                     </h5>

                     <p>Posted: <?php echo get_the_date('F j, Y'); ?></p>
                     <p>Posted by: <?php the_author('F j, Y'); ?></p>
                     <p><?php the_time(); ?></p>
                     <p class="card-text"><?php the_excerpt(); ?></p>
                     <a href="<?php the_permalink(); ?>" class="btn btn-primary">
                     Read more
                     </a>
                   </div>
                 </div>
            </div>
        <?php endwhile;
            else : echo '<p>There are no posts!</p>';
        endif;
        ?>
      </div>
    </div>
      <div class="container fluid mt-5 mb-5">
       <div class="row">
           <div class="col-12">
            <h3>key issues</h3>
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
                  $postcount++;
                  if($postcount == 1) {
              ?>

              <!-- here's the area where it loops over each post -->
              <div class="col col-md-4">
                   <div class="card mb-3" style="width: 100%">
                     <?php the_post_thumbnail("medium_large", ['class'=>'card-img-top']); ?>
                     <div class="card-body">
                       <h5 class="card-title">
                         <a href="<?php the_permalink(); ?>">
                         <?php the_title() ?>
                         </a>
                       </h5>
                       <span><b>Featured!</b></span>
                       <p>Posted2: <?php echo get_the_date(); ?></p>
                       <p>Posted by: <?php the_author('F j, Y'); ?></p>
                       <p><?php the_time(); ?></p>
                       <p class="card-text"><?php the_excerpt(); ?></p>
                       <a href="<?php the_permalink(); ?>" class="btn btn-primary">
                       Read more
                       </a>
                     </div>
                   </div>
              </div>
            <?php
            // closing the if statement
          }else{
            ?>
            <div class="col col-md-4">
                 <div class="card mb-3" style="width: 100%">
                   <?php the_post_thumbnail("medium_large", ['class'=>'card-img-top']); ?>
                   <div class="card-body">
                     <h5 class="card-title">
                       <a href="<?php the_permalink(); ?>">
                       <?php the_title() ?>
                       </a>
                     </h5>
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
            <?php
          };  ?>
          <?php
        endwhile;
              else : echo '<p>There are no posts!</p>';
          endif;
          ?>
  </div>
</div>
  <?php echo get_theme_mod("my_new_message")
  ?>

        <!-- <p>This is front-page.php</p> -->
</body>

<?php get_footer(); ?>
