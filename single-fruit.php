
<?php get_header(); ?>
  <div class="container fluid mb-5">
     <div class="row">
        <?php
        if (have_posts() ) :
            while (have_posts() ) : the_post(); ?>
            <!-- here's the area where it loops over each post -->
            <div class="col-12">
            <h1 class="card-title"><?php the_title() ?></h1>
            <?php the_post_thumbnail("large", ['class'=>'individual-fruit-photo']); ?>
            </div>
            <div class="col">
                 <div class="card mb-3" style="width: 100%">
                   <div class="card-body">
                     <p>
                       <?php
                       $review_stars = get_post_meta(get_the_ID(), 'review_radio_field', true);
                       if($review_stars =="1"){
                         echo '<i class="bi bi-star-fill"></i><i class="bi bi-star"></i><i class="bi bi-star"></i>';
                       }elseif ($review_stars =="2"){
                         echo '<i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star"></i>';
                       }else {
                         echo '<i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>';
                       };
                       ?>
                     </p>
                     <p><b>
                       <?php
                       $fruit_blurb = get_post_meta(get_the_ID(), 'blurb_input', true);
                       echo $fruit_blurb;
                     ?>
                   </b></p>

                     <p class="card-text"><?php the_content() ?></p>
                   </div>
                 </div>
            </div>
            <div class="col-12">
            </div>
        <?php endwhile;
            else : echo '<p>There are no posts!</p>';
        endif;
        ?>
        <a href="<?php echo home_url(); ?>">Back to home</a> 
        <!-- <p>This is the single-fruit template</p> -->
</body>

<?php get_footer(); ?>
