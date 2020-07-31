<?php

add_action('vc_before_init', 'dataconla_vc_past_attendee');

function dataconla_vc_past_attendee()
{
  vc_map(array(
    "base"    => "past_attendees",
    "name"    => __("Past Attendees List", "datadayla"),
    "category" => __("Data Con LA", "datadayla"),
    "class"    => "",
    "icon"      => "icon-wpb-message",
    "params"  => array(
      array(
        "type" => "textfield",
        "holder" => "div",
        "heading" => "Year",
        "param_name" => "year",
        "description" => "Relevant Year",
      ),
    ),
  ));
}

add_shortcode('past_attendees', 'dataconla_vc_past_attendee_render');

function dataconla_vc_past_attendee_render($atts, $content = null)
{
  global $wp_query;
  // extract(shortcode_atts(array(
  //   'width' => '1/2',
  //   'el_class' => '',
  //   'full_width' => '1',
  // ), $atts));

  // if ($atts['level'] == 'all') {
  //   $args_posts = array(
  //     'post_type' => 'attendee',
  //     'posts_per_page' => -1,
  //     'orderby' => 'title',
  //     'order' => 'ASC'
  //   );
  // } else {
  $args_posts = array(
    'post_type' => 'attendee',
    'tax_query' => array(
      array(
        'taxonomy' => 'relevant_year',
        'field'    => 'slug',
        'terms'    => $atts['year'],
      ),
    ), 'posts_per_page' => -1,
    'orderby' => 'title',
    'order' => 'ASC'
  );
  // }
  $posts = new WP_Query($args_posts);
  $output = '<div class="row">';
  if ($posts->have_posts()) {
    while ($posts->have_posts()) {
      $posts->the_post();

      // $output .= '<a href="' . get_post_meta(get_the_ID(), 'link_url', true) . '" target="_blank"><img alt="' . get_the_title() . '" src="' . get_post_meta(get_the_ID(), 'logo_image', true) . '" /></a>';
      $output .= '<div class="col"><a href="' . get_post_meta(get_the_ID(), 'link_url', true) . '" target="_blank"><img alt="' . get_the_title() . '" ' . get_the_post_thumbnail() . '</a></div>';
    }
  }
  $output .= '</div><!-- .companies_container -->';
  return $output;
}
