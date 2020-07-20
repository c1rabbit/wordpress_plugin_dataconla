<?php

add_action('vc_before_init', 'vc_plugin_slash_list');

function vc_plugin_slash_list($atts, $content = null)
{
  vc_map(array(
    "base"    => "slash_list",
    "name"    => __("Slash List", "datadayla"),
    "category" => __("Data Con LA", "datadayla"),    
    "class"    => "",
    "icon"      => "icon-wpb-message",
    "params"  => array(
      array(
        "type" => "textarea",
        "holder" => "div",
        "heading" => "List",
        "param_name" => "list",
        "description" => "List out items with slashes, one item per line",
      ),
    ),
  ));

  extract(shortcode_atts(array(
    'width' => '1/2',
    'el_class' => '',
    'full_width' => '1',
  ), $atts));
  $list = explode(PHP_EOL, $atts['list']);
  $output = '<section class="slash_list">';
  $i = 0;
  $columns[0] = array();
  $columns[1] = array();
  $columns[2] = array();
  foreach ($list as $item) {
    if ($i == 3)
      $i = 0;
    $columns[$i][] = $item;
    $i++;
  }
  foreach ($columns as $column) {
    $output .= '<div class="col-md-4 col-sm-4 col-xs-12">';
    $output .= '<table>';
    foreach ($column as $list_item) {
      $output .= '<tr>';
      $output .= '<td><i class="fa fa-circle-o-notch"></i></td>';
      $output .= '<td><h3>/ ' . $list_item . '</h3></td>';
      $output .= '</tr>';
    }
    $output .= '</table>';
    $output .= '</div>';
  }
  $output .= '</section>';
  return $output;
}
