<?php

add_action('vc_before_init', 'vc_plugin_presentation_slideitem');

function vc_plugin_presentation_slideitem($atts, $content = null) {
  vc_map( array(
    "base"		=> "presentation_slideitem",
    "name"		=> __("Past Presentation Slide Item", "js_composer"),
    "class"		=> "",
    "icon"      => "icon-wpb-message",
    "params"	=> array(
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
            "heading" => "Link to Slide",
            "param_name" => "slide_link",
            "description" => "Link to the Presentation Slide",
        ),
      array(
            "type" => "attach_image",
            "holder" => "div",
            "heading" => "Presenter Image",
            "param_name" => "presenter_image",
            "description" => "Image of Presenter",
        ),
      array(
            "type" => "textarea",
            "holder" => "div",
            "heading" => "Description",
            "param_name" => "description",
            "description" => "Description of Session",
        ),
    ),
) );

    extract(shortcode_atts(array(
        'width' => '1/2',
        'el_class'=>'',
        'full_width'=>'1',
    ), $atts));
  
    $output = '<section class="presentation_item_container container-fluid">';
    $output .= '<div class="row-fluid">';
    $output .= '<div class="col-md-3 col-sm-4 col-xs-12 slide_download">';
    if($atts['speaker'] != '' )
      $output .= '<h4 class="speaker">' . $atts['speaker'] . '</h4>';
    if($atts['presenter_image'])
    {
      $output .= '<img src="';
      $output .= wp_get_attachment_url($atts['presenter_image']);
      $output .= '"/>';
    }
    if($atts['slide_link'])
    {
      $output .= '<a href="' . $atts['slide_link'] . '" target="_blank"><h3 class="download_link"><i class="fa fa-download"></i> Download Slides</h3></a>';
    }
    $output .= '</div>';
    $output .= '<div class="col-md-9 col-sm-8 col-xs-12">';
    $output .= '<h3>' . $atts['title'] . '</h3>';
    $output .= '<div class="schedule_description">' . $atts['description'] . '</div>';
    $output .= '</div>';
    $output .= '</div>';
    $output .= '</section>';
    return $output;
}