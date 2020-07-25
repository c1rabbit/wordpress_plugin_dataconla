<?php

add_action('vc_before_init', 'dataconla_vc_sponsor_section');

function dataconla_vc_sponsor_section()
{
  vc_map(array(
    "base"    => "sponsor_section",
    "name"    => __("Sponsors Section", "datadayla"),
    "category" => __("Data Con LA", "datadayla"),
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
        "type" => "textfield",
        "holder" => "div",
        "heading" => "Year",
        "param_name" => "year",
        "description" => "Relevant Year",
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
}

add_shortcode('sponsor_section', 'vc_dataconla_sponsor_section_render');

function vc_dataconla_sponsor_section_render($atts, $content = null)
{
  global $wp_query;
  global $wpdb;
  $terms = $wpdb->get_results("SELECT * FROM wp_terms, wp_term_taxonomy WHERE wp_terms.term_id = wp_term_taxonomy.term_id AND wp_term_taxonomy.taxonomy = 'sponsor-tier'", OBJECT);

  // extract(shortcode_atts(array(
  //   'width' => '1/2',
  //   'el_class' => '',
  //   'full_width' => '1',
  // ), $atts));
  $output = '<section id="tile_sponsors" class="fullwidth big-sponsors sticked schedule">';
  $output .= '<div id="tile_sponsors_anchor" class="hook"></div>';
  if (isset($atts['title']) || isset($atts['subtitle'])) {
    $output .= '<header class="row section-header">';
    $output .= '<h2>' . $atts['title'] ?? $atts['subtitle'] . '</h2>';
    $output .= '</header>';
  }

  if ($terms && count($terms) > 0) {

    // tiers sorting
    $new_tiers = array();
    foreach ($terms as $tier) {
      $tier->order = intval(ef_get_term_meta('sponsor-tier-metas', $tier->term_id, 'sponsor_tier_order'));
      $new_tiers[$tier->order] = $tier;
    }
    ksort($new_tiers, SORT_NUMERIC);

    $terms = $new_tiers;
    // -------------

    $tier_count = 0;
    foreach ($terms as $tier) {
      // ++$tier_count;
      // $tier_type = ef_get_term_meta('sponsor-tier-metas', $tier->term_id, 'sponsor_tier_type');
      $sponsors = get_posts(array(
        'posts_per_page' => -1,
        'post_type' => 'sponsor',
        'tax_query' => array(
          array(
            'taxonomy' => 'sponsor-tier',
            'field' => 'slug',
            'terms' => array($tier->slug)
          ),
          array(
            'taxonomy' => 'relevant_year',
            'field'    => 'slug',
            'terms'    => $atts['year'],
          )
        ),
        'orderby' => 'title',
        'order' => 'ASC'
      ));

      if (count($sponsors) > 0) {
        // $output .= '<div class="">';
        $output .= '<div class="row section-content">';
        // $output .= '<div class="col-md-12">';
        // $output .= '<div class="sponsor_tier">';
        // $output .= '<div class="container">';
        // $output .= '<div class="row">';
        $output .= '<div class="col-md-12 col-sm-12 sponsor_tier">';
        $output .= '<h3 class=""><i class="fa fa-trophy"></i> ' . $tier->name . ' Sponsors</h3>';
        $output .= '<p>' . stripslashes($tier->description) . '</p>';
        // $output .= '</div>';
        // $output .= '</div>';
        // $output .= '</div>';
        $output .= '</div>';
        $output .= '</div>';


        $output .= '<div class="row  d-flex" style="min-height:200px">';

        if ($sponsors && count($sponsors) > 0) {
          foreach ($sponsors as $sponsor) {

            $output .= '<div class="col-md-3 col-sm-4 col-6 align-self-center">';

            $link = get_post_meta($sponsor->ID, 'sponsors_link', true);

            if (!empty($link))
              $output .= '<a href="' . $link . '" target="_blank" class="url">';

            $these_options = array('class' => 'sponsor py-5 px-3 my-5' . $sponsor->ID, 'alt' => $sponsor->post_title, 'style' => 'max-width:100%');

            // really bad for now. 
            // if ($sponsor->ID == 1833) {
            //   $these_options["style"] = "max-width: 500px";
            // }

            // if ($sponsor->ID == 1764) {
            //   $these_options["style"] = "max-width: 220px; max-height: 200px;";
            // }

            // if ($sponsor->ID == 1823) {
            //   $these_options["style"] = "max-width: 140px; max-height: 150px;";
            // }

            // if ($sponsor->ID == 1963) {
            //   $these_options["style"] = "max-width: 300px; max-height: 217px;";
            // }

            $output .= get_the_post_thumbnail($sponsor->ID, 'full', $these_options);
            if (!empty($link))
              $output .= '</a>';


            $output .= '</div><!-- sponsors_container -->';
          }
        }

        // $output .= '</div>';
        $output .= '</div>';
      }
    }
  }
  if (isset($atts['btn_link']) && !empty($atts['btn_link'])) {
    $output .= '<footer class="section-footer">';
    $output .= '<a href="' . $atts['btn_link'] . '" class="section-button" ';
    if ($atts['new_window'] == 'yes') {
      $output .= 'target="_blank"';
    }
    $output .= '>' . $atts['btn_text'] . '</a>';
    $output .= '</footer>';
  }
  $output .= '</section>';
  return $output;
}

// class EF_Taxonomy_Helper 
function ef_get_term_meta($field_set, $term_id, $field_id)
{
  $meta = get_option($field_set);
  if (empty($meta))
    $meta = array();
  if (!is_array($meta))
    $meta = (array) $meta;
  $meta = isset($meta[$term_id]) ? $meta[$term_id] : array();
  $value = isset($meta[$field_id]) ? $meta[$field_id] : '';

  return $value;
}
