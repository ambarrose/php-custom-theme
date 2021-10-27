<?php
get_header();
?>
<?php if(get_theme_mod("my_custom_select") === 'show_posts'){
?>
<div class="container mt-5">
  <div class="row">
    <div class="col">
      <?php woocommerce_content(); ?>
    </div>
  </div>
</div>
<?php } ?>


<?php echo get_theme_mod("my_custom_select")
?>
<?php
get_footer();
?>
