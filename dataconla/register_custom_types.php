<?php
$posts_with_relevant_year = array(
  'organizer', 'speaker', 'sponsor', 'volunteer', 'panelists',
  'attendee', 'startup_showcase', 'showcase_finalists'
);
add_action('init', 'register_custom_post_types');
add_action('init', 'register_custom_taxonomies');

function register_custom_taxonomies()
{
  global $posts_with_relevant_year;
  register_taxonomy('relevant_year', $posts_with_relevant_year, array(
    'hierarchical' => true,
    'labels' => array(
      'name' => __('Relevant Year', 'dxef'),
      'singular_name' => __('Relevant Year', 'dxef'),
      'search_items' => __('Search Relevant Year', 'dxef'),
      'all_items' => __('All Relevant Year', 'dxef'),
      'parent_item' => __('Parent Relevant Year', 'dxef'),
      'parent_item_colon' => __('Parent Relevant Year:', 'dxef'),
      'edit_item' => __('Edit Relevant Year', 'dxef'),
      'update_item' => __('Update Relevant Year', 'dxef'),
      'add_new_item' => __('Add New Relevant Year', 'dxef'),
      'new_item_name' => __('New Relevant Year', 'dxef')
    ),
    'show_in_rest' => true,
    'query_var' => true,
    'rewrite' => true
  ));

  register_taxonomy('attended_year', 'attendee', array(
    'hierarchical' => true,
    'labels' => array(
      'name' => __('Attended Year', 'dxef'),
      'singular_name' => __('Attended Year', 'dxef'),
      'search_items' => __('Search Attended Year', 'dxef'),
      'all_items' => __('All Attended Year', 'dxef'),
      'parent_item' => __('Parent Attended Year', 'dxef'),
      'parent_item_colon' => __('Parent Attended Year:', 'dxef'),
      'edit_item' => __('Edit Attended Year', 'dxef'),
      'update_item' => __('Update Attended Year', 'dxef'),
      'add_new_item' => __('Add New Attended Year', 'dxef'),
      'new_item_name' => __('New Attended Year', 'dxef'),
      'menu_name' => __('Attended Year', 'dxef')
    ),
    'show_in_rest' => true,
    'query_var' => true,
    'rewrite' => true
  ));

  register_taxonomy('sponsor-tier', 'sponsor', array(
    'hierarchical' => true,
    'labels' => array(
      'name' => __('Tiers', 'dxef'),
      'singular_name' => __('Tier', 'dxef'),
      'search_items' => __('Search Tiers', 'dxef'),
      'all_items' => __('All Tiers', 'dxef'),
      'parent_item' => __('Parent Tier', 'dxef'),
      'parent_item_colon' => __('Parent Tier:', 'dxef'),
      'edit_item' => __('Edit Tier', 'dxef'),
      'update_item' => __('Update Tier', 'dxef'),
      'add_new_item' => __('Add New Tier', 'dxef'),
      'new_item_name' => __('New Tier', 'dxef'),
      'menu_name' => __('Tiers', 'dxef')
    ),
    'show_in_rest' => true,
    'query_var' => true,
    'rewrite' => true
  ));
}

function register_custom_post_types()
{

  register_post_type('organizer', array(
    'labels' => array(
      'name' => __('Organizers', 'dxef'),
      'singular_name' => __('Organizer', 'dxef'),
      'add_new' => __('Add New', 'dxef'),
      'add_new_item' => __('Add New Organizer', 'dxef'),
      'edit_item' => __('Edit Organizer', 'dxef'),
      'new_item' => __('New Organizer', 'dxef'),
      'view_item' => __('View Organizer', 'dxef'),
      'search_items' => __('Search Organizer', 'dxef'),
      'not_found' => __('No Organizer found', 'dxef'),
      'not_found_in_trash' => __('No Organizer found in trash', 'dxef'),
      'menu_name' => __('Organizers', 'dxef')
    ),
    'public' => true,
    'show_ui' => true,
    'show_in_menu' => 'dataconla',
    'capability_type' => 'post',
    'hierarchical' => false,
    'rewrite' => true,
    'query_var' => false,
    'show_in_rest' => true,
    'supports' => array(
      'title',
      'thumbnail',
      'custom-fields'
    )
  ));

  register_post_type('speaker', array(
    'labels' => array(
      'name' => __('All Speakers', 'dxef'),
      'singular_name' => __('Speaker', 'dxef'),
      'add_new' => __('Add New Speaker', 'dxef'),
      'add_new_item' => __('Add New Speaker', 'dxef'),
      'edit_item' => __('Edit Speaker', 'dxef'),
      'new_item' => __('New Speaker', 'dxef'),
      'view_item' => __('View Speaker', 'dxef'),
      'search_items' => __('Search Speaker', 'dxef'),
      'not_found' => __('No Speaker found', 'dxef'),
      'not_found_in_trash' => __('No Speaker found in trash', 'dxef'),
      'menu_name' => __('Speakers', 'dxef')
    ),
    'public' => true,
    'show_ui' => true,
    'show_in_menu' => 'dataconla',
    'capability_type' => 'post',
    'hierarchical' => false,
    'rewrite' => true,
    'query_var' => false,
    'show_in_rest' => true,
    'supports' => array(
      'title',
      'editor',
      'thumbnail',
      'page-attributes',
      'custom-fields'
    )
  ));

  register_post_type('sponsor', array(
    'labels' => array(
      'name' => __('Sponsors', 'dxef'),
      'singular_name' => __('Sponsor', 'dxef'),
      'add_new' => __('Add New', 'dxef'),
      'add_new_item' => __('Add New Sponsor', 'dxef'),
      'edit_item' => __('Edit Sponsor', 'dxef'),
      'new_item' => __('New Sponsor', 'dxef'),
      'view_item' => __('View Sponsor', 'dxef'),
      'search_items' => __('Search Sponsors', 'dxef'),
      'not_found' => __('No Sponsors found', 'dxef'),
      'not_found_in_trash' => __('No Sponsors found in trash', 'dxef'),
      'menu_name' => __('Sponsors', 'dxef')
    ),
    'public' => true,
    'show_ui' => true,
    'show_in_menu' => 'dataconla',
    'capability_type' => 'post',
    'hierarchical' => false,
    'rewrite' => true,
    'query_var' => false,
    'show_in_rest' => true,
    'supports' => array(
      'title',
      'editor',
      'author',
      'thumbnail',
      'custom-fields'
    )
  ));

  register_post_type('startup_showcase', array(
    'labels' => array(
      'name' => __('Startup Showcase Judges', 'dxef'),
      'singular_name' => __('Startup Showcase Judge', 'dxef'),
      'add_new' => __('Add Startup Showcase Judge', 'dxef'),
      'add_new_item' => __('Add Startup Showcase Judge', 'dxef'),
      'edit_item' => __('Edit Startup Showcase Judge', 'dxef'),
      'new_item' => __('New Startup Showcase Judge', 'dxef'),
      'view_item' => __('View Startup Showcase Judge', 'dxef'),
      'search_items' => __('Search Startup Showcase Judge', 'dxef'),
      'not_found' => __('No Startup Showcase Judge found', 'dxef'),
      'not_found_in_trash' => __('No Startup Showcase Judge found in trash', 'dxef'),
      'menu_name' => __('Startup Showcase Judges', 'dxef')
    ),
    'public' => true,
    'show_ui' => true,
    'show_in_menu' => 'dataconla',
    'capability_type' => 'post',
    'hierarchical' => false,
    'rewrite' => true,
    'query_var' => false,
    'show_in_rest' => true,
    'supports' => array(
      'title',
      'author',
      'editor',
      'thumbnail',
      'custom-fields'
    )
  ));

  register_post_type('showcase_finalists', array(
    'labels' => array(
      'name' => __('Startup Showcase Finalists', 'dxef'),
      'singular_name' => __('Startup Showcase Finalist', 'dxef'),
      'add_new' => __('Add New Startup Showcase Finalist', 'dxef'),
      'add_new_item' => __('Add New Startup Showcase Finalist', 'dxef'),
      'edit_item' => __('Edit Startup Showcase Finalist', 'dxef'),
      'new_item' => __('New Startup Showcase Finalist', 'dxef'),
      'view_item' => __('View Startup Showcase Finalist', 'dxef'),
      'search_items' => __('Search Startup Showcase Finalist', 'dxef'),
      'not_found' => __('No Startup Showcase Finalist found', 'dxef'),
      'not_found_in_trash' => __('No Startup Showcase Finalist found in trash', 'dxef'),
      'menu_name' => __('Startup Showcase Finalists', 'dxef')
    ),
    'public' => true,
    'show_ui' => true,
    'show_in_menu' => 'dataconla',
    'capability_type' => 'post',
    'hierarchical' => false,
    'rewrite' => true,
    'query_var' => false,
    'show_in_rest' => true,
    'supports' => array(
      'title',
      'editor',
      'author',
      'thumbnail',
      'custom-fields'
    )
  ));

  register_post_type('attendee', array(
    'labels' => array(
      'name' => __('Past Attendees', 'dxef'),
      'singular_name' => __('Past Attendee', 'dxef'),
      'add_new' => __('Add Past Attendee', 'dxef'),
      'add_new_item' => __('Add Past Attendee', 'dxef'),
      'edit_item' => __('Edit Past Attendee', 'dxef'),
      'new_item' => __('New Past Attendee', 'dxef'),
      'view_item' => __('View Past Attendee', 'dxef'),
      'search_items' => __('Search Past Attendee', 'dxef'),
      'not_found' => __('No Past Attendee found', 'dxef'),
      'not_found_in_trash' => __('No Past Attendee found in trash', 'dxef'),
      'menu_name' => __('Past Attendees', 'dxef')
    ),
    'public' => true,
    'show_ui' => true,
    'show_in_menu' => 'dataconla',
    'capability_type' => 'post',
    'hierarchical' => false,
    'rewrite' => true,
    'query_var' => false,
    'show_in_rest' => true,
    'supports' => array(
      'title',
      'thumbnail',
      'custom-fields'
    )
  ));

  register_post_type('panelists', array(
    'labels' => array(
      'name' => __('Panelists', 'dxef'),
      'singular_name' => __('Panelist', 'dxef'),
      'add_new' => __('Add New Panelist', 'dxef'),
      'add_new_item' => __('Add New Panelist', 'dxef'),
      'edit_item' => __('Edit Panelist', 'dxef'),
      'new_item' => __('New Panelist', 'dxef'),
      'view_item' => __('View Panelist', 'dxef'),
      'search_items' => __('Search Panelist', 'dxef'),
      'not_found' => __('No Panelist found', 'dxef'),
      'not_found_in_trash' => __('No Panelist found in trash', 'dxef'),
      'menu_name' => __('Panelists', 'dxef')
    ),
    'public' => true,
    'show_ui' => true,
    'show_in_menu' => 'dataconla',
    'capability_type' => 'post',
    'hierarchical' => false,
    'rewrite' => true,
    'query_var' => false,
    'show_in_rest' => true,
    'supports' => array(
      'title',
      'editor',
      'author',
      'thumbnail',
      'custom-fields'
    )
  ));

  register_post_type('volunteer', array(
    'labels' => array(
      'name' => __('Volunteers', 'dxef'),
      'singular_name' => __('Volunteer', 'dxef'),
      'add_new_item' => __('Add New Volunteer', 'dxef'),
      'edit_item' => __('Edit Volunteer', 'dxef'),
      'new_item' => __('New Volunteer', 'dxef'),
      'view_item' => __('View Volunteer', 'dxef'),
      'search_items' => __('Search Volunteer', 'dxef'),
      'not_found' => __('No Volunteer found', 'dxef'),
      'not_found_in_trash' => __('No Volunteer found in trash', 'dxef'),
      'menu_name' => __('Volunteers', 'dxef')
    ),
    'public' => true,
    'show_ui' => true,
    'show_in_menu' => 'dataconla',
    'capability_type' => 'post',
    'hierarchical' => false,
    'rewrite' => true,
    'query_var' => false,
    'show_in_rest' => true,
    'supports' => array(
      'title',
      'thumbnail',
      'custom-fields'
    )
  ));
}

function filter_cars_by_taxonomies($post_type, $which)
{
  global $posts_with_relevant_year;

  // Apply this only on a specific post type
  if (!in_array($post_type, $posts_with_relevant_year))
    return;

  // A list of taxonomy slugs to filter by
  $taxonomies = array('relevant_year');

  foreach ($taxonomies as $taxonomy_slug) {

    // Retrieve taxonomy data
    $taxonomy_obj = get_taxonomy($taxonomy_slug);
    $taxonomy_name = $taxonomy_obj->labels->name;

    // Retrieve taxonomy terms
    $terms = get_terms($taxonomy_slug);

    // Display filter HTML
    echo "<select name='{$taxonomy_slug}' id='{$taxonomy_slug}' class='postform'>";
    echo '<option value="">' . sprintf(esc_html__('Show All %s', 'text_domain'), $taxonomy_name) . '</option>';
    foreach ($terms as $term) {
      printf(
        '<option value="%1$s" %2$s>%3$s</option>',
        $term->slug,
        ((isset($_GET[$taxonomy_slug]) && ($_GET[$taxonomy_slug] == $term->slug)) ? ' selected="selected"' : ''),
        $term->name
      );
    }
    echo '</select>';
  }
}
add_action('restrict_manage_posts', 'filter_cars_by_taxonomies', 10, 2);
