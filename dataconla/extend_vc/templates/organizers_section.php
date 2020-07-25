<?php

add_action('vc_before_init', 'dataconla_vc_organizers_section');

function dataconla_vc_organizers_section()
{
  vc_map(array(
    "base"    => "organizers_section",
    "name"    => __("Organizers Section", "datadayla"),
    "class"    => "",
    "category" => __("Data Con LA", "datadayla"),
    "icon"      => "icon-wpb-message",
    "params"  => array(
      array(
        "type" => "textfield",
        "holder" => "div",
        "heading" => "Year",
        "param_name" => "year",
        "description" => "Relevant Year",
      ),
      array(
        "type" => "textfield",
        "holder" => "div",
        "heading" => "Head Organizers",
        "param_name" => "head_organizers",
        "description" => "Head Organizers",
      ),
    ),
  ));
}

add_shortcode('organizers_section', 'vc_dataconla_organizers_section_render');

function vc_dataconla_organizers_section_render($atts, $content = null)
{
  global $wp_query;
  // extract(shortcode_atts(array(
  //   'width' => '1/2',
  //   'el_class' => '',
  //   'full_width' => '1',
  // ), $atts));
  if (isset($atts['head_organizers']) && $atts['head_organizers'] == 'true') {
    $organizers = new WP_Query(array(
      'post_type' => 'organizer',
      'posts_per_page' => -1,
      'tax_query' => array(
        array(
          'taxonomy' => 'relevant_year',
          'field'    => 'slug',
          'terms'    => $atts['year'],
        ),
      ),
      'meta_key'   => 'head_organizer',
      'meta_value' => true,
      'orderby' => 'title',
      'order' => 'ASC'
    ));
  } else {
    $organizers = new WP_Query(array(
      'post_type' => 'organizer',
      'posts_per_page' => -1,
      'tax_query' => array(
        array(
          'taxonomy' => 'relevant_year',
          'field'    => 'slug',
          'terms'    => $atts['year'],
        ),
      ),
      'orderby' => 'title',
      'order' => 'ASC'
    ));
  }

  $output = '<section class="bigdata_speakers">';
  $output .= '<div class="row">';
  while ($organizers->have_posts()) {
    $organizers->the_post();
    $output .= '<div class="col-lg-2 col-md-3 col-sm-4 col-xs-6 speaker_container">';
    if (has_post_thumbnail()) { // check if the post has a Post Thumbnail assigned to it.
      $output .= get_the_post_thumbnail(get_the_ID(), 'full');
    }
    $output .= '<div class="speaker_info">';
    $output .= '<h3>' . get_the_title() . '</h3>';
    $output .= '<h4>' . get_post_meta(get_the_ID(), "subtitle", true) . '</h4>';
    $output .= '</div>';
    $linkedin = get_post_meta(get_the_ID(), "linked_in_link", true);
    $twitter = get_post_meta(get_the_ID(), "twitter_link", true);
    // if ($twitter || $linkedin) {
    $output .= '<div class="datadayla_social_links">';
    if ($linkedin) {
      $output .= '<a href="' . $linkedin . '" target="_blank"><i class="fa fa-linkedin"></i></a>';
    }
    if ($twitter) {
      $output .= '<a href="' . $twitter . '" target="_blank"><i class="fa fa-twitter"></i></a>';
    }
    $output .= '</div>';
    // }
    $output .= '</div>';
  }
  $output .= '</div>';
  $output .= '</section>';
  wp_reset_postdata();
  return $output;
}
