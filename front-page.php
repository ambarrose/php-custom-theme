<?php get_header(); ?>

    <div id="full-page">
      <img src="images/fern.jpg" alt="">

        <h1 class="welcome text-center">Environment & Conservation<br>Organisations of Aotearoa New Zealand</h1>
    </div>

    <div id="signUp">
      <h2 class="friend text-light">Become a Friend of ECO</h2>
      <button id="link" class="rounded-pill text-light" type="button" name="button"><a class="nav-link text-light " href="<?php echo get_page_link(get_page_by_path('join-us')); ?>">Sign-up & Support</a></button>
    </div>

    <?php if(get_theme_mod("my_custom_select") === 'show_posts'){

    ?>
    <div id="main" class="container fluid mt-5 mb-5 text-dark">
     <div class="row">
       <div class="col-12">
        <h2>News items</h2>
      </div>
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
                     <p class="card-text"><?php new_excerpt_length(); ?></p>

                     <button id="link" class="rounded-pill text-light" type="button" name="button" href="<?php the_permalink(); ?>">Read More</button>
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
            <h2>Key issues</h2>
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

                       <button id="link" class="rounded-pill text-light" type="button" name="button" href="<?php the_permalink(); ?>">Read More</button>
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
        <?php echo do_shortcode('[contact-form-7 id="34" title="Contact form 1"]'); ?>
</div>
  <?php echo get_theme_mod("my_new_message")
  ?>
  <?php echo get_theme_mod("my_custom_select")
  ?>



        <!-- <p>This is front-page.php</p> -->
</body>

<?php get_footer(); ?>
