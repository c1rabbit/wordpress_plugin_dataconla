<?php

add_action('vc_before_init', 'vc_theme_call_to_action');

function vc_theme_call_to_action($atts, $content = null)
{
  vc_map(array(
    "base"    => "call_to_action",
    "name"    => __("Call to Action Section", "js_composer"),
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
        "type" => "textfield",
        "holder" => "div",
        "heading" => "Subtitle",
        "param_name" => "subtitle",
        "description" => "Subtitle",
      ),
      array(
        "type" => "colorpicker",
        "holder" => "div",
        "heading" => "Text Color",
        "param_name" => "text_color",
        "description" => "Text color",
      ),
      array(
        "type" => "dropdown",
        "holder" => "div",
        "class" => "",
        "heading" => "Text Alignment",
        "param_name" => "text_alignment",
        "description" => "Text Alignment",
        "value" => array(
          'Left' => 'left',
          'Right' => 'right',
          'Center' => 'center',
        ),
      ),
      array(
        "type" => "attach_image",
        "holder" => "div",
        "class" => "",
        "heading" => "Background Image",
        "param_name" => "bkg_img",
        "description" => "Background Image",
        "value" => array(
          'No' => 'no',
          'Yes' => 'yes',
        ),
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
      array(
        "type" => "colorpicker",
        "holder" => "div",
        "heading" => "Button Hover Color",
        "param_name" => "btn_hover_color",
        "description" => "Hover Color Button",
      ),
    ),
  ));

  global $wp_query;
  extract(shortcode_atts(array(
    'width' => '1/2',
    'el_class' => '',
    'full_width' => '1',
  ), $atts));

  $output = '';
  if (!empty($atts['btn_hover_color'])) {
    $output .= '<style type="text/css">';
    $output .= '#tile_calltoaction .section-button:hover {background-color: ' . $atts['btn_hover_color'] . ';}';
    $output .= '</style>';
  }
  $output .= '<section id="tile_calltoaction" class="fullwidth parallax" ';
  if (isset($atts['bkg_img'])) {
    $output .= 'style="background-image: url(\'';
    $output .= wp_get_attachment_url($atts['bkg_img']);
    $output .= '\')"';
  }

  $output .= '>';
  $output .= '<div id="tile_calltoaction_anchor" class="hook"></div>';
  $output .= '<div class="container" ';

  if (!empty($atts['text_alignment']))
    $output .= 'style="text-align:' . $atts['text_alignment'] . ';"';

  $output .= '>';
  $output .= '<h2';

  if (!empty($atts['text_color']))
    $output .= ' style="color:' . $atts['text_color'] . ';"';

  $output .= '>' . stripslashes($atts['title']) . '</h2>';
  $output .= '<p';

  if (!empty($atts['text_color']))
    $output .= ' style = "color:' . $atts['text_color'] . ';"';

  $output .= '>' . stripslashes($atts['subtitle']) . '</p>';
  $output .= '<a href="' . $atts['btn_link'] . '" class="section-button"';

  if (!empty($atts['text_color']))
    $output .= ' style="color:' . $atts['text_color'] . '; border-color:' . $atts['text_color'] . ';"';

  if ($atts['new_window'] == 'yes')
    $output .= ' target="_blank"';

  $output .= '>' . $atts['btn_text'] . '</a>';
  $output .= '</div>';
  $output .= '</section>';
  return $output;
}
