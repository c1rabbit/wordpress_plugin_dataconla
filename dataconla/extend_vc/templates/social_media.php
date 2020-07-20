<?php

add_action('vc_before_init', 'dataconla_vc_social_media');

function dataconla_vc_social_media()
{
  vc_map(array(
    "base"    => "social_media",
    "name"    => __("Social Media", "js_composer"),
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
    ),
  ));
}

add_shortcode('social_media', 'vc_dataconla_social_media_render');

function vc_dataconla_social_media_render($atts, $content = null)
{
  global $wp_query;

  // extract(shortcode_atts(array(
  //   'width' => '1/2',
  //   'el_class' => '',
  //   'full_width' => '1',
  // ), $atts));

  $output = '<section id="tile_connect" class="fullwidth gold social-links">';
  $output .= '<div id="tile_connect_anchor" class="hook"></div>';
  $output .= '<div class="container">';
  if (isset($atts['title']) && !empty($atts['title']))
    $output .= '<h2>' . $atts['title'] . '</h2>';
  $output .= '<div class="icons clearfix">';

  // $ef_options = EF_Event_Options::get_theme_options();
  $ef_options = get_option( 'theme_options' );
  if (!empty($ef_options['ef_linkedin']))
    $output .= '<a href="' . esc_url($ef_options['ef_linkedin'], $args['esc_url_protocols']) . '" target="_blank" title="LinkedIn"><i class="fa fa-linkedin-square"></i></a>';

  if (!empty($ef_options['ef_twitter']))
    $output .= '<a href="' . esc_url($ef_options['ef_twitter'], $args['esc_url_protocols']) . '" target="_blank" title="Twitter"><i class="fa fa-twitter-square"></i></a>';

  if (!empty($ef_options['ef_facebook']))
    $output .= '<a href="' . esc_url($ef_options['ef_facebook'], $args['esc_url_protocols']) . '" target="_blank" title="Facebook"><i class="fa fa-facebook-square"></i></a>';

  if (!empty($ef_options['ef_instagram']))
    $output .= '<a href="' . esc_url($ef_options['ef_instagram'], $args['esc_url_protocols']) . '" target="_blank" title="Instagram"><i class="fa fa-instagram"></i></a>';

  if (!empty($ef_options['ef_youtube']))
    $output .= '<a href="' . esc_url($ef_options['ef_youtube'], $args['esc_url_protocols']) . '" target="_blank" title="Youtube"><i class="fa fa-youtube-square"></i></a>';

  if (!empty($ef_options['ef_pinterest']))
    $output .= '<a href="' . esc_url($ef_options['ef_pinterest'], $args['esc_url_protocols']) . '" target="_blank" title="Pinterest"><i class="fa fa-pinterest-square"></i></a>';

  if (!empty($ef_options['ef_google_plus']))
    $output .= '<a href="' . esc_url($ef_options['ef_google_plus'], $args['esc_url_protocols']) . '" target="_blank" title="Google+"><i class="fa fa-google-plus-square"></i></a>';

  if (!empty($ef_options['ef_email']) && is_email($ef_options['ef_email']))
    $output .= '<a href="mailto:' . $ef_options['ef_email'] . '" title="Email"><i class="fa fa-envelope-square"></i></a>';

  if (!empty($ef_options['ef_vimeo']))
    $output .= '<a href="' . esc_url($ef_options['ef_vimeo'], $args['esc_url_protocols']) . '" target="_blank" title="Vimeo"><i class="fa fa-vimeo-square"></i></a>';

  if (!empty($ef_options['ef_flickr']))
    $output .= '<a href="' . esc_url($ef_options['ef_flickr'], $args['esc_url_protocols']) . '" target="_blank" title="Flickr"><i class="fa fa-flickr"></i></a>';

  if (!empty($ef_options['ef_skype']))
    $output .= '<a href="skype:' . $ef_options['ef_skype'] . '" title="Skype"><i class="fa fa-skype"></i></a>';

  if (!empty($ef_options['ef_rss']) && $ef_options['ef_rss'] == true)
    $output .= '<a href="' . get_bloginfo('rss_url') . '" target="_blank" title="Rss"><i class="fa fa-rss"></i></a>';

  $output .= '</div>';
  $output .= '</div>';
  $output .= '</section>';
  return $output;
}
