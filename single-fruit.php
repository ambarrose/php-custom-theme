
<?php get_header(); ?>
  <div class="container fluid mt-5 mb-5">
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
                     <p><b>
                       <?php
                       $fruit_blurb = get_post_meta(get_the_ID(), 'blurb_input', true);
                       echo $fruit_blurb;
                       ?><br><?php
                       $review_data = get_post_meta(get_the_ID(), 'review_radio_field', true);
                       echo "Your review: " . $review_data . '<span class="oi oi-star"></span>';
                       ?>
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
        <a href="<?php echo get_page_link(get_page_by_path('fruit-collection')); ?>">Back to the fruit collection</a>
        <!-- <p>This is the single-fruit template</p> -->
</body>

<?php get_footer(); ?>
