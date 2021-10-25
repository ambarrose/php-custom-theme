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
  return 20;
}

function wp_nav_menu_no_ul()
{
    $options = array(
        'echo' => false,
        'container' => false,
        'theme_location' => 'primary',
        'fallback_cb'=> 'default_page_menu'
    );

    $menu_args = wp_nav_menu($options);
    echo preg_replace(array(
        '#^<ul[^>]*>#',
        '#</ul>$#'
    ), '', $menu_args);

}

function default_page_menu() {
   wp_list_pages('title_li=');
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

// Customise the woocommerce checkout feilds

add_filter('woocommerce_checkout_fields', 'custom_placeholder');
function custom_placeholder($fields) {
  $fields['order']['order_comments']['placeholder'] = "A new placeholder";
  $fields['order']['order_comments']['label'] = "Delivery Instructions";
  //make phone an email fields unrequired
  $fields['billing']['billing_phone']['required'] = false;
  $fields['billing']['billing_email']['required'] = false;
  return $fields;
}

add_filter( 'woocommerce_default_address_fields' , 'custom_override_default_address_fields' );
function custom_override_default_address_fields( $address_fields ) {
  // make country field unrequired
  $address_fields['country']['required'] = false;
  return $address_fields;
}

// Add a custom section to theme customiser
function my_first_customised_option($wp_customize){
  $wp_customize->add_section("ambars_section",
   array(
    "title" => "My first section",
    "custom_setting",
    "priority" => 1000
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
      'max' => 10
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
?>
