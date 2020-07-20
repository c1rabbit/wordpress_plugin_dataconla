<?php

add_action('vc_before_init', 'vc_plugin_sessions_section');

function vc_plugin_sessions_section($atts, $content = null) {
	vc_map( array(
		"base"		=> "sessions_section",
		"name"		=> __("Sessions Section", "js_composer"),
		"class"		=> "",
		"icon"      => "icon-wpb-message",
		"params"	=> array(
		  array(
				"type" => "textfield",
				"holder" => "div",
				"heading" => "Year",
				"param_name" => "year",
				"description" => "Relevant Year",
			),		
		),
	) );

    global $wp_query;
    extract(shortcode_atts(array(
        'width' => '1/2',
        'el_class'=>'',
        'full_width'=>'1',
	), $atts));
	$output = "";
    $output .= '<section id="sessions_speakers" class="container">';
    $sessions = new WP_Query(array(
    	'post_type' => 'session',
		'posts_per_page' => -1,
		'tax_query' => array(
        	array(
    	        'taxonomy' => 'relevant_year',
	            'field'    => 'slug',
            	'terms'    => $atts['year'],
			),
        ),
        'meta_query' => array(
	        'relation' => 'AND',
	        'session_date_clause' => array(
	            'key'     => 'session_date',
	            'compare' => 'EXISTS',
	        ),
	        'session_time_clause' => array(
	            'key'     => 'session_time',
	            'compare' => 'EXISTS',
	        ), 
	    ),
	    'orderby' => array(
	        'session_date_clause' => 'ASC',
	        'session_time_clause' => 'ASC',
	    )
		));


	$metaPostDateTime = 0;
	$metaPostDate = 0;
            
    while ($sessions->have_posts()) {
		$sessions->the_post();

		$meta = get_post_meta( get_the_ID() );
		$tracks = wp_get_post_terms( get_the_ID(), 'session-track');
		$locations = wp_get_post_terms( get_the_ID(), 'session-location');
		$speakers_list = get_post_meta(get_the_ID(), 'session_speakers_list', true);
		
// 		$output .= "<div><pre>" . print_r($meta, 1) . "</pre></div>";
// 		$output .= "<div><pre>" . print_r($tracks, 1) . "</pre></div>";
// 		$output .= "<div><pre>" . print_r($locations, 1) . "</pre></div>";
// 		$output .= "<div><pre>" . print_r($speakers_list, 1) . "</pre></div>";
			
		if($metaPostDate != $meta['session_date'][0]) {
			$output .= '<div class="row" style="background:#222; padding:10px; color:#fff;"> conference date: ' . date("F j, Y", $meta['session_date'][0]) . '</div>';	  
		}
		
		if($metaPostDateTime != $meta['session_date'][0] . "#" . $meta['session_time'][0]) {
			$output .= '<div class="row" style="padding:10px; color:#fff;"><div style="background:#454545;" class="col-md-11 col-md-offset-1"> times: ' . $meta['session_time'][0] .'</div></div>';	  
		}
		
		$metaPostDate = $meta['session_date'][0];
		$metaPostDateTime = $meta['session_date'][0] . "#" . $meta['session_time'][0];

		// generate list of names
		$list = "";
		foreach($tracks as $k => $f) {
			$list .= ", " . $f->name;
		}

		$output .= '<div class="row">'; 
			$output .= '<div class="col-md-10 col-md-offset-2">'; 
				$output .= '<div class="row">'; 
					$output .= '<div class="col-md-6" style="background:#666; color:#fff">' . get_the_title() . '</div>';
					$output .= '<div class="col-md-6" style="background:#666; color:#fff"> time : ' . $meta['session_time'][0] . ' - ' . $meta['session_end_time'][0] . '</div>';
					$output .= '<div class="col-md-12" style="background:#666; color:#fff;"> tracks: ' . ltrim($list,',') . '</div>';
					$output .= '<div class="col-md-12" style="border:1ps solid #666;">' . get_the_content() . '</div>';
				$output .= '</div>';
			$output .= '</div>';
		$output .= '</div>';
		

     }
    $output .= '</section>';

    wp_reset_postdata();
    return $output;
}