<?php

add_action('vc_before_init', 'dataconla_vc_keynote_section');

function dataconla_vc_keynote_section()
{

  vc_map(array(
    "base"    => "keynote_section",
    "name"    => __("Keynote Speakers Section", "datadayla"),
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
      )
    ),
  ));
}

add_shortcode('keynote_section', 'vc_dataconla_keynote_section_render');

function vc_dataconla_keynote_section_render($atts, $content = null)
{
  global $wp_query;
  // extract(shortcode_atts(array(
  //   'width' => '1/2',
  //   'el_class' => '',
  //   'full_width' => '1',
  // ), $atts));

  $keynotes = new WP_Query(array(
    'post_type' => 'speaker',
    'posts_per_page' => -1,
    'tax_query' => array(
      array(
        'taxonomy' => 'relevant_year',
        'field'    => 'slug',
        'terms'    => $atts['year'],
      ),
    ),
    'meta_key'   => 'speaker_keynote',
    'meta_value' => true,
    'orderby' => 'menu_order',
    'order' => 'desc'
  ));

  // echo "<pre style='display:none'>";
  // print_r($keynotes);
  // echo "</pre>";

  $output = '<section id="keynote_speakers">';
  while ($keynotes->have_posts()) {
    $keynotes->the_post();
    $output .= '<div class="row">';
    if (has_post_thumbnail()) { // check if the post has a Post Thumbnail assigned to it.
      $output .= '<div class="col-md-3 col-sm-4 col-12 speaker_image">';
      $output .= get_the_post_thumbnail(get_the_ID(), 'full');
      $linkedin = get_post_meta(get_the_ID(), 'linkedin', true);
      $twitter = get_post_meta(get_the_ID(), 'twitter', true);
      if ($twitter || $linkedin) {
        $output .= '<div class="datadayla_social_links">';
        if ($linkedin) {
          $output .= '<a href="' . $linkedin . '" target="_blank"><i class="fa fa-linkedin"></i></a>';
        }
        if ($twitter) {
          $output .= '<a href="' . $twitter . '" target="_blank"><i class="fa fa-twitter"></i></a>';
        }
        $output .= '</div>';
      }
      $output .= '</div>';
      $output .= '<div class="col-md-9 col-sm-8 col-12">';
    } else {
      $output .= '<div class="col-md-12 speaker_section">';
    }
    $output .= '<h2 class="speaker_h2">' . get_the_title() . '</h2>';
    $output .= '<div class="speaker_content">';
    if (!empty(trim(get_post_meta(get_the_ID(), 'speaker_title', true)))) {
      $output .= '<strong>' . get_post_meta(get_the_ID(), 'speaker_title', true) . '</strong>';
    }
    $output .= get_the_content();
    $output .= '</div>';
    $output .= '</div>';

    $output .= '</div>';
  }
  $output .= '</section>';
  wp_reset_postdata();
  return $output;
}
