<?php

add_action('vc_before_init', 'vc_plugin_schedule_item');

function vc_plugin_schedule_item($atts, $content = null)
{

  vc_map(array(
    "base"    => "schedule_item",
    "name"    => __("Schedule Item", "js_composer"),
    "class"    => "",
    "icon"      => "icon-wpb-message",
    "params"  => array(
      array(
        "type" => "textfield",
        "holder" => "div",
        "heading" => "Title",
        "param_name" => "title",
        "description" => "Title of Session",
      ),
      array(
        "type" => "textfield",
        "holder" => "div",
        "heading" => "Speaker",
        "param_name" => "speaker",
        "description" => "Speaker of the Session",
      ),
      array(
        "type" => "textfield",
        "holder" => "div",
        "heading" => "Time",
        "param_name" => "time",
        "description" => "Time of the Session (i.e 9:00am - 10:00am)",
      ),
      array(
        "type" => "textfield",
        "holder" => "div",
        "heading" => "Slides",
        "param_name" => "slides",
        "description" => "URL link to sides if available",
      ),
      array(
        "type" => "textarea",
        "holder" => "div",
        "heading" => "Description",
        "param_name" => "description",
        "description" => "Description of Session",
      ),
    ),
  ));

  extract(shortcode_atts(array(
    'width' => '1/2',
    'el_class' => '',
    'full_width' => '1',
  ), $atts));
  $output = '<section class="schedule_item_container container-fluid">';
  $output .= '<div class="row-fluid">';
  $output .= '<div class="col-md-3 col-sm-4 col-12">';
  $output .= '<h3 class="session_time">' . $atts['time'] . '</h3>';
  $output .= '</div>';
  $output .= '<div class="col-md-9 col-sm-8 col-12">';
  $output .= '<h3>' . $atts['title'] . '</h3>';
  if ($atts['speaker'] != '')
    $output .= '<h4 class="speaker">by ' . $atts['speaker'] . '</h4>';
  if ($atts['slides'] != '')
    $output .= '<div class="schedule_description"> <a href="' . $atts['slides'] . '" target="_blank"> View slides and video from the session </a> </div>';
  $output .= '<div class="schedule_description">' . $atts['description'] . '</div>';
  $output .= '</div>';
  $output .= '</div>';
  $output .= '</section>';
  return $output;
}
