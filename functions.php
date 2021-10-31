<?php

// turn on theme support
add_theme_support('post-thumbnails');
add_theme_support('woocommerce');

function custom_theme_assets() {
  wp_enqueue_style('my-custom-style', get_stylesheet_uri());
}

// load up custom dashboard css
function custom_dashboard_css() {
  wp_enqueue_style('new-dashboard-styles', get_template_directory_uri() . '/dashboard.css');
}

add_action('admin_enqueue_scripts','custom_dashboard_css');

add_action('wp_enqueue_scripts', 'custom_theme_assets');

register_nav_menus(['primary'=> 'Ambars Primary Menu']);

// customise the excerpt length
function new_excerpt_length() {
  $new_length = get_theme_mod("custom_excerpt_length");
  return $new_length;
}

// use a filter hook to modify Wordpress function at runtime
add_filter('excerpt_length', 'new_excerpt_length');

// creating our new custom post type
function create_fruit_posttype() {
  // set up the arguments
  $args = array(
    'labels' => array(
      //name of the post type
      'name' => 'Fruit',
      'singular_name' => 'Fruit'
    ),
    'public' => true,
    'menu_icon' => 'dashicons-carrot',
    'supports' => array('title', 'editor', 'thumbnail')
  );
  // Within our function, we need to register the post type
  register_post_type('fruit', $args);
}

add_action('init','create_fruit_posttype');

// creating our new custom post type
function create_sports_posttype() {
  // set up the arguments
  $args = array(
    'labels' => array(
      //name of the post type
      'name' => 'Sports',
      'singular_name' => 'Sport'
    ),
    'public' => true,
    'menu_icon' => 'dashicons-universal-access',
    'supports' => array('title', 'editor', 'thumbnail')
  );
  // Within our function, we need to register the post type
  register_post_type('sports', $args);
}

add_action('init','create_sports_posttype');

// set up a custom metabox

function add_fruit_metabox(){
  add_meta_box(
    'fruit_metabox', // id in dashboard
    'Our First Metabox', // title seen in the dashboard
    'fruit_metabox_callback', // callback function to run and render the elements
    'fruit', // custom post type to attach it //
    'normal' // position (normal, or side)
  );
}

function fruit_metabox_callback($post){
  $blurb_data = get_post_meta($post->ID, 'blurb_input', true);
  $price_data = get_post_meta($post->ID, 'price_input', true);
  $review_data = get_post_meta($post->ID, 'review_radio_field', true);
  $textarea_data = get_post_meta($post->ID, 'textarea_field', true);
      // blurb
  echo '<label for "blurb">Blurb</label>' .
       '<input text="text" id="blurb_input" class="metabox_input" name="blurb_input" value="'. $blurb_data .'" size="50">';
       // price
  echo '<br><label for "price">Price</label>' .
        '<input text="text" id="price_input" class="metabox_input" name="price_input" value="'. $price_data .'" size="30">';
        // radiobox
        ?>
        <div>
        Review - between 1 to 3 stars
          <div class="fields">
            <label><input type="radio" name="review_radio_field" value="1" <?php if($review_data == "1"){
              echo "checked";} ?>>One Star</label>
            <label><input type="radio" name="review_radio_field" value="2" <?php if($review_data == "2"){
              echo "checked";} ?>>Two Stars</label>
            <label><input type="radio" name="review_radio_field" value="3" <?php if($review_data == "3"){
              echo "checked";} ?>>Three Stars</label>
          </div>
        </div>
        <div class="row">
          <div class="label">Textarea</div>
          <div class="fields">
              <textarea rows="5" name="textarea_field" rows="4" cols="50"><?php echo $textarea_data; ?></textarea>
          </div>
        </div>
<?php
}

// run our metabox function during the admin_menu WP function
add_action('admin_menu','add_fruit_metabox');

// save our fruit metabox

function fruit_save_metabox_data($post_id, $post){
  // check current permissions of the user
  $post_type = get_post_type_object($post->post_type);
  if(! current_user_can($post_type->cap->edit_post, $post_id)){
    return $post_id;
  }
  // do not save the data if WP is autosaving
  if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return $post_id;
  }
  if ($post->post_type != 'fruit'){
    return $post_id;
  }
  if(isset($_POST['blurb_input'])){
    update_post_meta($post_id, 'blurb_input', sanitize_text_field($_POST['blurb_input']));
  }else {
    delete_post_meta($post_id, 'blurb_input');
  }
  if(isset($_POST['price_input'])){
    update_post_meta($post_id, 'price_input', sanitize_text_field($_POST['price_input']));
  }else {
    delete_post_meta($post_id, 'price_input');
  }
  if(isset($_POST['review_radio_field'])){
    update_post_meta($post_id, 'review_radio_field', sanitize_text_field($_POST['review_radio_field']));
  }else {
    delete_post_meta($post_id, 'review_radio_field');
  }
  if(isset($_POST['textarea_field'])){
    update_post_meta($post_id, 'textarea_field', sanitize_text_field($_POST['textarea_field']));
  }else {
    delete_post_meta($post_id, 'textarea_field');
  }
  return $post_id;
}

add_action('save_post', 'fruit_save_metabox_data', 10, 2);

// setting up custom taxonomies (or categories) for our custom post type sports

function create_sports_taxonomy() {
  $labels = array(
    'name' => 'Custom Attributes',
    'singular_name' => 'Attribute',
    'search_items' => 'Search Attributes',
    'all_items' => 'All Attributes',
    'parent_item' => 'Parent Attribute',
    'parent_item_colon' => 'Parent Attribute:',
    'edit_item' => 'Edit Attribute',
    'update_item' => 'Update Attribute',
    'add_new_item' => 'Add New Attribute',
    'new_item_name' => 'New Attribute Name',
    'menu_name' => 'Attribute'
  );
  // register the taxonomy
  register_taxonomy(
    'attribute', array('sports', 'fruit'), array(
      'hierarchical' => true,
      'labels' => $labels,
      'show_ui' => true
    )
  );
}

// hook in our action to set up our custom taxonomy
add_action('init','create_sports_taxonomy', 0);

// setting up custom taxonomies (or categories) for our custom post type sports

function create_fruit_taxonomy() {
  $labels = array(
    'name' => 'Color',
    'singular_name' => 'Color',
    'search_items' => 'Search Colors',
    'all_items' => 'All Colors',
    'parent_item' => 'Parent Color',
    'parent_item_colon' => 'Parent Color:',
    'edit_item' => 'Edit Color',
    'update_item' => 'Update Color',
    'add_new_item' => 'Add New Color',
    'new_item_name' => 'New Color Name',
    'menu_name' => 'Color'
  );
  // register the taxonomy
  register_taxonomy(
    'color', array('fruit'), array(
      'hierarchical' => true,
      'labels' => $labels,
      'show_ui' => true
    )
  );
}

// hook in our action to set up our custom taxonomy
add_action('init','create_fruit_taxonomy', 0);

// Customise the woocommerce checkout feilds

add_filter('woocommerce_checkout_fields', 'custom_placeholder');

function custom_placeholder($fields) {
  $fields['order']['order_comments']['placeholder'] = "A new placeholder";
  $fields['order']['order_comments']['label'] = "Delivery instructions";
  return $fields;
}

// make phone and email fields unrequired
add_filter( 'woocommerce_billing_fields', 'phone_email_custom');
function phone_email_custom($fields){
   $fields['billing_phone']['required'] = false;
   $fields['billing_email']['required'] = false;
   return $fields;
}

// Add a custom section to theme customiser
function my_first_customised_option($wp_customize){
  $wp_customize->add_section("ambars_section",
   array(
    "title" => "My first section",
    "priority" => 0
  ));

  // add a new setting
  $wp_customize->add_setting("my_custom_message",
  array(
    "default" => ""
  ));
  $wp_customize->add_setting("my_new_message",
  array(
    "default" => ""
  ));
  // add a new number setting
  $wp_customize->add_setting("my_custom_number", array(
    "default" => 0
  ));

  // add a new number setting for custom excerpts
$wp_customize->add_setting("custom_excerpt_length", array(
  "default" => 500
));

// add a new color picker setting
$wp_customize->add_setting("color_picker", array(
  "default" => ""
));

// add a new image upload setting
$wp_customize->add_setting("custom_image", array(
  "default" => ""
));

// add a new dropdown select setting
$wp_customize->add_setting("my_custom_select", array(
  "default" => "show_posts"
));

$wp_customize->add_setting("my_custom_select2", array(
  "default" => "show_related"
));

$wp_customize->add_control("my_custom_select", array(
  "label" => "Show the latest posts on the front page",
  "section" => "ambars_section",
  "settings" => "my_custom_select",
  "type" => "select",
  "choices" => array(
    "show_posts" => 'Yes',
    "hide_posts" => 'No'
  )
));

$wp_customize->add_control("my_custom_select2", array(
  "label" => "Show or hide Woocommer",
  "section" => "ambars_section",
  "settings" => "my_custom_select2",
  "type" => "select",
  "choices" => array(
    "show_posts" => 'Yes',
    "hide_posts" => 'No'
  )
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_picker', array(
    'label' => 'Link Colors',
    'section' => 'ambars_section',
    'settings' => 'color_picker'
  )));

// add our custom image control
$wp_customize->add_control(new WP_Customize_Image_Control(
  $wp_customize, 'custom_image', array(
      'label' => 'Upload a custom image',
      'settings' => 'custom_image',
      'section' => 'tims_section',
      'priority' => 1000
  ))
);

  // Add a new control
  $wp_customize->add_control("my_custom_message",
  array(
    "label" => "Enter a custom message",
    "section" => "ambars_section",
    "settings" => "my_custom_message",
    "type" => "textarea"
  ));


  $wp_customize->add_control("my_new_message",
  array(
    "label" => "Enter a custom message",
    "section" => "ambars_section",
    "settings" => "my_new_message",
    "type" => "textarea"
  ));

  // heres the control for our new number
  $wp_customize->add_control("my_custom_number", array(
    "label" => "Enter a number",
    "section" => "ambars_section",
    "settings" => "my_custom_number",
    "type" => "number",
    'input_attrs' => array(
      'min' => 0,
      'max' => 12
    )
  ));

  $wp_customize->add_control("custom_excerpt_length", array(
    "label" => "Excerpt length",
    "section" => "ambars_section",
    "settings" => "custom_excerpt_length",
    "type" => "number",
    'input_attrs' => array(
      'min' => 5,
      'max' => 500
    )
  ));
}

  add_action("customize_register","my_first_customised_option");

  // new section -------

  function new_customised_option($wp_customize){
    $wp_customize->add_section("number_section",
     array(
      "title" => "My customised number section",
      "custom_setting",
      "priority" => 0
    ));

    // add a new number setting
    $wp_customize->add_setting("custom_number", array(
      "default" => 0
    ));

    // heres the control for our new number
    $wp_customize->add_control("custom_number", array(
      "label" => "Choose a col amount",
      "section" => "number_section",
      "settings" => "custom_number",
      "type" => "number",
      'input_attrs' => array(
        'min' => 0,
        'max' => 10
      )
    ));
  }

  add_action("customize_register","new_customised_option");

  // add a custom section to your theme customiser
function bootstrap_changes($wp_customize) {
  $wp_customize->add_section("bootstrap_section", array(
    "title" => "Bootstrap settings",
    "priority" => 0
  ));

  // add a new number setting
  $wp_customize->add_setting("my_custom_col_size", array(
    "default" => 4
  ));

  // heres the control for our new number
  $wp_customize->add_control("my_custom_col_size", array(
    "label" => "Enter a number",
    "section" => "bootstrap_section",
    "settings" => "my_custom_col_size",
    "type" => "number",
    'input_attrs' => array(
      'min' => 6,
      'max' => 12
    )
  ));
}

add_action("customize_register", "bootstrap_changes");

function generate_special_css() {
  $color_picker = get_theme_mod('color_picker');
  ?>
  <style type="text/css">
    .card-title a {
      color: <?php echo $color_picker; ?>
    }

  </style>
  <?php
}

add_action('wp_head','generate_special_css');

/* Add Show All Products to Woocommerce Shortcode */
function woocommerce_shortcode_display_all_products($args)
{
 if(strtolower(@$args['post__in'][0])=='all')
 {
  global $wpdb;
  $args['post__in'] = array();
  $products = $wpdb->get_results("SELECT ID FROM ".$wpdb->posts." WHERE `post_type`='product'",ARRAY_A);
  foreach($products as $k => $v) { $args['post__in'][] = $products[$k]['ID']; }
 }
 return $args;
}
add_filter('woocommerce_shortcode_products_query', 'woocommerce_shortcode_display_all_products');

?>
