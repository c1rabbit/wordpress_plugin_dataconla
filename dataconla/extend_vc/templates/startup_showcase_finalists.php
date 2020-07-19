<?php
add_action('vc_before_init', 'vc_theme_startup_showcase_finalists');

function vc_theme_startup_showcase_finalists($atts, $content = null)
{
  vc_map(array(
    "base"    => "startup_showcase_finalists",
    "name"    => __("Startup Showcase Finalists", "js_composer"),
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
  $output .= '<section id="startup_showcase_finalists">';


  $keynotes = new WP_Query(array(
    'post_type' => 'showcase_finalists',
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


  /*
    
    echo "<pre>";
    print_r($keynotes);
    echo "</pre>";
      
*/
  $output .= '<div class="finalist_section">';

  while ($keynotes->have_posts()) {
    $keynotes->the_post();

    $link_url = get_post_meta(get_the_ID(), 'link_url', true);

    if (has_post_thumbnail()) {
      $output .= '<div class="col-xs-6 col-sm-4 col-md-3" style="min-height:300px"><a href="' . $link_url . '" target="_blank" class="panelist" style="width:100%;">';
      $output .= get_the_post_thumbnail(get_the_ID(), 'full');
      $output .= '</a></div>';
    }
  }
  $output .= '</div>';
  $output .= '</section>';
  wp_reset_postdata();
  return $output;
}
