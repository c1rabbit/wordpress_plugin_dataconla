<?php
add_action('vc_before_init', 'dataconla_vc_startup_showcase_judges');

function dataconla_vc_startup_showcase_judges()
{
  vc_map(array(
    "base"    => "startup_showcase_judges",
    "name"    => __("Startup Showcase Judges", "js_composer"),
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

add_shortcode('startup_showcase_judges', 'dataconla_vc_startup_showcase_judges_render');

function dataconla_vc_startup_showcase_judges_render($atts, $content = null)
{
  global $wp_query;
  // extract(shortcode_atts(array(
  //   'width' => '1/2',
  //   'el_class' => '',
  //   'full_width' => '1',
  // ), $atts));

  $output = '<section id="startup_showcase_judges">';

  $keynotes = new WP_Query(array(
    'post_type' => 'startup_showcase',
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

  // echo "<pre>";
  // print_r($keynotes);
  // echo "</pre>";

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
    } else
      $output .= '<div class="col-md-12 speaker_section">';
    $output .= '<h2 class="speaker_h2">' . get_the_title() . '</h2>';
    $output .= '<div class="speaker_content">';
    $output .= get_the_content();
    $output .= '</div>';
    $output .= '</div>';

    $output .= '</div>';
  }
  $output .= '</section>';
  wp_reset_postdata();
  return $output;
}
