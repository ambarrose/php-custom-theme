<?php get_header(); ?>

    <div class="custom-img">
      <img src="<?php echo get_theme_mod("custom_image"); ?>" alt="">
    </div>
    <h1 class="welcome text-center text-light"><?php echo get_theme_mod("eco_title"); ?></h1>

    <div id="signUp">
      <h4 class="friend text-light">Become a Friend of ECO</h4>
      <button id="link" class="rounded-pill text-light" type="button" name="button"><a class="nav-link text-light " href="<?php echo get_page_link(get_page_by_path('join-us')); ?>">Sign-up & Support</a></button>
    </div>

    <?php if(get_theme_mod("my_custom_select") === 'show_posts'){ ?>



    <div id="main" class="container fluid mt-5 mb-5 text-dark">
     <div class="row">
       <div class="col-12">
        <h3>News items</h3>
      </div>
        <?php
        if (have_posts() ) :
            while (have_posts() ) : the_post(); ?>

            <!-- here's the area where it loops over each post -->
            <div class="col <?php echo "col-md-" . get_theme_mod("custom_number"); ?>">
                 <div class="card mb-3">
                   <?php the_post_thumbnail("medium", ['class'=>'card-img-top']); ?>
                   <div class="card-body">
                     <h5 class="card-title">
                       <a href="<?php the_permalink(); ?>">
                       <?php the_title(); ?>
                       </a>
                     </h5>

                     <p>Posted: <?php echo get_the_date(); ?></p>
                     <p class="card-text"><?php new_excerpt_length(); ?></p>

                     <button id="card-link" class="rounded-pill text-light" href="<?php the_permalink(); ?>">Read More</button>
                   </div>
                 </div>
            </div>
        <?php endwhile;
            else : echo '<p>There are no posts!</p>';
        endif; }
        ?>
      </div>
    </div>


      <div class="container fluid mt-5 mb-5">
       <div class="row">
           <div class="col-12">
            <h3>Key issues</h3>
          </div>
        <?php
        query_posts(array(
          'post_type' => fruit
          )
        );
        ?>
        <?php
        if (have_posts() ) :
            while (have_posts() ) : the_post(); ?>

              <!-- here's the area where it loops over each post -->
              <div class="col col-md-3">
                   <div class="card mb-3">
                     <?php the_post_thumbnail("medium", ['class'=>'card-img-top']); ?>
                     <div class="card-body">
                       <h5 class="card-title">
                         <a href="<?php the_permalink(); ?>">
                         <?php the_title() ?>
                         </a>
                       </h5>

                       <p>Posted: <?php echo get_the_date(); ?></p>
                       <p class="card-text"><?php the_excerpt(); ?></p>

                       <button id="card-link" class="rounded-pill text-light" type="button" name="button" href="<?php the_permalink(); ?>">Read More</button>
                     </div>
                   </div>
              </div>

          <?php
        endwhile;
              else : echo '<p>There are no posts!</p>';
          endif;
          ?>
  </div>
        <!-- <div class="row">
          <div class="col-12">
            <ul class="list-group">
              <li class="list-group-item">Email</li>
              <li class="list-group-item">Phone</li>
            </ul>
          </div>
        </div> -->

</div>

  <?php echo get_theme_mod("my_new_message");
  ?>
  <?php echo get_theme_mod("my_custom_select");
  ?>

  <?php echo get_theme_mod("custom_number");
  ?>



        <!-- <p>This is front-page.php</p> -->
</body>

<?php get_footer(); ?>
