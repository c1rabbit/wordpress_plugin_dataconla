<?php

add_action('vc_before_init', 'dataconla_vc_section_header');

function dataconla_vc_section_header()
{
  vc_map(array(
    "base"    => "section_header",
    "name"    => __("Section Header with Icon", "datadayla"),
    "category" => __("Data Con LA", "datadayla"),
    "class"    => "",
    "icon"      => "icon-wpb-message",
    "params"  => array(
      array(
        "type" => "textfield",
        "holder" => "div",
        "heading" => "Icon",
        "param_name" => "icon",
        "description" => "Font awesome class.  i.e search for the magnifying glass icon",
      ),
      array(
        "type" => "textfield",
        "holder" => "div",
        "heading" => "Title",
        "param_name" => "title",
        "description" => "Title",
      ),
      array(
        "type" => "textfield",
        "holder" => "div",
        "heading" => "Subtext",
        "param_name" => "subtext",
        "description" => "Text for description on the side of the title",
      ),
    ),
  ));
}

add_shortcode('section_header', 'dataconla_vc_section_header_render');

function dataconla_vc_section_header_render($atts, $content = null)
{
  global $wp_query;
  // extract(shortcode_atts(array(
  //   'width' => '1/2',
  //   'el_class' => '',
  //   'full_width' => '1',
  // ), $atts));

  $output = '<div class="section_header row">';
  $output .= '<div style="display:inline-block">';
  $output .= '<i class="fa fa-';
  if (isset($atts['icon']) && !empty($atts['icon'])) {
    $output .= $atts['icon'];
  } else {
    $output .= 'connectdevelop';
  }

  $output .= '"></i>';
  $output .= '</div>';
  $output .= '<div style="display:inline-block">';
  $output .= '<h2>';
  $output .= $atts['title'] ?? "";
  if (isset($atts['subtext']) && !empty($atts['subtext'])) {
    $output .= '<span class="subtext"> / ' . $atts['subtext'] . '</span>';
  }
  $output .= '</h2>';
  $output .= '</div>';
  $output .= '</div>';
  return $output;
}
