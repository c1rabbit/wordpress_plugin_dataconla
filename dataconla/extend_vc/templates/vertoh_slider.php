<?php

class WPBakeryShortCode_vertoh_slider extends WPBakeryShortCode {
}


vc_map( array(
    "base"		=> "vertoh_slider",
    "name"		=> __("Vertoh Slider", "js_composer"),
    "class"		=> "",
    "icon"      => "icon-wpb-message",
    "params"	=> array(
      array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => "Slider Type",
            "param_name" => "slider_type",
            "description" => "Types of Sliders",
            "value" => array(
              'Theme Setting'=>'theme_setting',
              'Slider'=>'slider',
              'Small'=>'small',
              'Solid'=>'solid',
              'Video'=>'video',
            ),
        ),
    ),
) );

function vc_theme_vertoh_slider($atts, $content = null) {
    global $wp_query;
    extract(shortcode_atts(array(
        'width' => '1/2',
        'el_class'=>'',
        'full_width'=>'1',
    ), $atts));
    $ef_options = EF_Event_Options::get_theme_options();
    
    ob_start(); 
    if($atts['slider_type'] == 'theme_setting')
      include(locate_template("/components/templates/headers/home/" . $ef_options['ef_header_type'] . ".php"));  
    else
      include(locate_template("/components/templates/headers/home/" . $atts['slider_type'] . ".php"));  
     
    $output = ob_get_contents();  
    ob_end_clean();  
    return $output;
}