<?php
/*
 * Plugin Name: Cyberpack - Tools - Shortcode
 * Description: Tools shortcode for various tools created by Cyberpack.pl team
 * Version: 1.0
 * Author: Cyberpack - Kornel
 * Author: https://cyberpack.pl/
*/

add_shortcode( 'cbp_tool', function ($atts) {
  if (!defined('TOOLS')): define('TOOLS', '/wp-content/tools') endif;
  wp_enqueue_style( 'cbp_tool-style', TOOLS.'/assets/style.css', [], '0.1' );
  wp_enqueue_script( 'cbp_tool-scripts', TOOLS.'/assets/scripts.js', [], '0.1', $footer = true );

  $atts = shortcode_atts(['tool' => '',], $atts, 'cbp_tool' );

  if ($atts['tool'] == 'all') {
    $files = [];
    $path = scandir(ABSPATH.'wp-content/tools/src/');
    foreach (array_splice($path, 2) as $cat) {
      $path = scandir(ABSPATH . "wp-content/tools/src/" . $cat);
      $files[$cat] = array_splice($path, 2);
    }
    $html = '<ul>';
    foreach ($files as $cat => $file) {
      foreach ($file as $single) {
        $html .= "<li>{$cat}/{$single}</li>";
      }
    }
    $html .= '</ul>';
  } else {
    $tool = TOOLS."/src/".$atts['tool']."/";
    $toolPath = ABSPATH.'wp-content/tools/src/'.$atts['tool'].'/index.html';

    if (file_exists($toolPath)) {
      wp_enqueue_style( "cbp_tool-{$atts['tool']}-style", $tool . 'style.css', [], '1.0.0' );
      wp_enqueue_script( "cbp_tool-{$atts['tool']}-scripts", $tool . 'scripts.js', [], '1.0.0', $footer = true );
      $html = file_get_contents($toolPath);
    } else {
      $html =  "<pre>{$atts['tool']} - NOT FOUND</pre>";
    }
  }

  return $html;
});
