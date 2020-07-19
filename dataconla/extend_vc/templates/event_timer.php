<?php
function datetime_picker_settings_field($settings, $value)
{
  return '<div class="datetime_picker">'
    . '<input name="' . esc_attr($settings['param_name']) . '" class="wpb_vc_param_value wpb-textinput eventtimerdatestr ' .
    esc_attr($settings['param_name']) . ' ' .
    esc_attr($settings['type']) . '_field" type="text" value="' . esc_attr($value) . '" />' .
    '</div>'; // This is html markup that will be outputted in content elements edit form
}

// add_action('vc_before_init', 'vc_theme_event_timer');

function vc_theme_event_timer($atts, $content = null)
{
  // vc_add_shortcode_param('datetime_picker', 'datetime_picker_settings_field', get_stylesheet_directory_uri() . '/extend_vc/js/datetimepicker.js');


  vc_map(array(
    "base"    => "event_timer",
    "name"    => __("Event Timer", "js_composer"),
    "class"    => "",
    "icon"      => "icon-wpb-message",
    "params"  => array(
      array(
        "type" => "textfield",
        "holder" => "div",
        "heading" => "Title",
        "param_name" => "title",
        "description" => "Title of Section",
      ),
      array(
        "type" => "datetime_picker",
        "holder" => "div",
        "heading" => "Date and Time",
        "param_name" => "date_time",
        "description" => "Date and Time",
      ),
      array(
        "type" => "textfield",
        "holder" => "div",
        "heading" => "Button Text",
        "param_name" => "btn_text",
        "description" => "Text of the Button",
      ),
      array(
        "type" => "textfield",
        "holder" => "div",
        "heading" => "Button Link",
        "param_name" => "btn_link",
        "description" => "Link of the Button",
      ),
      array(
        "type" => "dropdown",
        "holder" => "div",
        "class" => "",
        "heading" => "New Tab or Window",
        "param_name" => "new_window",
        "description" => "To Open Button Link in New Window or Not",
        "value" => array(
          'No' => 'no',
          'Yes' => 'yes',
        ),
      ),
    ),
  ));

  global $wp_query;
  extract(shortcode_atts(array(
    'width' => '1/2',
    'el_class' => '',
    'full_width' => '1',
  ), $atts));

  $output  = '<section id="tile_eventtimer" class="fullwidth timer">';
  $output .= '<div id="tile_eventtimer_anchor" class="hook"></div>';
  $output .= '<div class="container">';
  if ($atts['title'] != '') {
    $output .= '<header class="row section-header">';
    $output .= '<h2>' . $atts['title'] . '</h2>';
    $output .= '</header>';
  }
  $output .= '<div>';
  if ($atts['date_time'] != '')
    $output .= '<div class="countdown" data-date="' . date('Y-m-d H:i:s', strtotime($atts['date_time'])) . '"></div>';
  else {
    $output .= '<div class="zerocountdown">';
    $output .= '<div class="time_circles">';
    $output .= '<div class="textDiv" ><div class="zeros">0</div><h4>Days</h4></div>';
    $output .= '<div class="textDiv"><div class="zeros">0</div><h4>Hours</h4></div>';
    $output .= '<div class="textDiv"><div class="zeros">0</div><h4>Minutes</h4></div>';
    $output .= '<div class="textDiv"><div class="zeros">0</div><h4>Seconds</h4></div>';
    $output .= '</div></div>';
  }
  $output .= '</div>';

  if (!empty($atts['btn_text'])) {
    $output .= '<footer class="section-footer">';
    $output .= '<a href="' . $atts['btn_link'] . '" class="section-button"';
    if ($atts['new_window'] == 'yes')
      $output .= ' target="_blank"';
    $output .= '>';
    $output .= $atts['btn_text'] . '</a>';
    $output .= '</footer>';
  }
  $output .= '</div>';
  $output .= '</section>';
  return $output;
}
