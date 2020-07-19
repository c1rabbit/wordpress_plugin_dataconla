<?php

add_action('vc_before_init', 'vc_theme_section_header');

function vc_theme_section_header($atts, $content = null)
{
  vc_map(array(
    "base"    => "section_header",
    "name"    => __("Section Header with Icon", "js_composer"),
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

  global $wp_query;
  extract(shortcode_atts(array(
    'width' => '1/2',
    'el_class' => '',
    'full_width' => '1',
  ), $atts));

  $output = "";
  $output .= '<table class="section_header">';
  $output .= '<tr>';
  $output .= '<td><i class="fa fa-';
  if (isset($atts['icon']) && !empty($atts['icon']))
    $output .= $atts['icon'];
  else
    $output .= 'connectdevelop';

  $output .= '"></i></td>';
  $output .= '<td><h2>';
  $output .= $atts['title'] ?? "";
  if (isset($atts['subtext']) && !empty($atts['subtext']))
    $output .= '<span class="subtext"> / ' . $atts['subtext'] . '</span>';
  $output .= '</h2></td>';
  $output .= '</tr>';
  $output .= '</table>';
  return $output;
}
