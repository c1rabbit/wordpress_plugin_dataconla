<?php

add_action('vc_before_init', 'vc_theme_speakers_section');

function vc_theme_speakers_section($atts, $content = null)
{
  vc_map(array(
    "base"    => "speakers_section",
    "name"    => __("Speakers Section", "js_composer"),
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
  global $wp_query;
  extract(shortcode_atts(array(
    'width' => '1/2',
    'el_class' => '',
    'full_width' => '1',
  ), $atts));
  $output = "";
  $output .= '<section class="bigdata_speakers">';
  $speakers = new WP_Query(array(
    'post_type' => 'speaker',
    'tax_query' => array(
      array(
        'taxonomy' => 'relevant_year',
        'field'    => 'slug',
        'terms'    => $atts['year'],
      ),
    ),
    'posts_per_page' => -1,
    'orderby' => 'title',
    'order' => 'ASC'
  ));
  $output .= '<div class="row">';
  while ($speakers->have_posts()) {
    $speakers->the_post();
    $keynote = get_post_meta(get_the_ID(), 'speaker_keynote', true);
    if (!$keynote) {
      $output .= '<div class="col-md-2 col-sm-4 col-xs-6 speaker_container">';
      if (has_post_thumbnail()) { // check if the post has a Post Thumbnail assigned to it.

        $output .= get_the_post_thumbnail(get_the_ID(), 'full');
      }
      $output .= '<div class="speaker_info">';
      $output .= '<h3>' . get_the_title() . '</h3>';
      $output .= '<h4>' . get_post_meta(get_the_ID(), 'speaker_title', true) . '</h4>';
      $output .= '</div>';
      $linkedin = get_post_meta(get_the_ID(), 'linkedin', true);
      $twitter = get_post_meta(get_the_ID(), 'twitter', true);
      if ($twitter || $linkedin) {
        $output .= '<div class="social_links">';
        if ($linkedin)
          $output .= '<a href="' . $linkedin . '" target="_blank"><i class="fa fa-linkedin"></i></a>';

        if ($twitter)
          $output .= '<a href="' . $twitter . '" target="_blank"><i class="fa fa-twitter"></i></a>';

        $output .= '</div>';
      }
      $output .= '</div>';
    }
  }
  $output .= '</div>';
  $output .= '</section>';
  wp_reset_postdata();
  return $output;
}
