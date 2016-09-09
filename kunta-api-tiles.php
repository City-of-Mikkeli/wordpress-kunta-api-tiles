<?php
/*
 * Created on Sep 9, 2016
 * Plugin Name: Kunta API Tiles
 * Description: Kunta API Tiles plugin for Wordpress
 * Version: 0.1
 * Author: Antti Leppä / Otavan Opisto
 */
defined ( 'ABSPATH' ) || die ( 'No script kiddies please!' );

require_once ('constants.php');

add_action ( 'init', 'create_post_type' );

function create_post_type() {
  
	register_post_type ( 'kunta_api_tiles', array (
	'labels' => array (
	  'name'               => __( 'Tiles', KUNTA_API_TILES_I18N_DOMAIN ),
	  'singular_name'      => __( 'Tile', KUNTA_API_TILES_I18N_DOMAIN ),
	  'add_new'            => __( 'Add Tile', KUNTA_API_TILES_I18N_DOMAIN ),
	  'add_new_item'       => __( 'Add New Tile', KUNTA_API_TILES_I18N_DOMAIN ),
	  'edit_item'          => __( 'Edit Tile', KUNTA_API_TILES_I18N_DOMAIN ),
	  'new_item'           => __( 'New Tile', KUNTA_API_TILES_I18N_DOMAIN ),
	  'view_item'          => __( 'View Tile', KUNTA_API_TILES_I18N_DOMAIN ),
      'search_items'       => __( 'Search Tiles', KUNTA_API_TILES_I18N_DOMAIN ),
	  'not_found'          => __( 'No Tiles found', KUNTA_API_TILES_I18N_DOMAIN ),
	  'not_found_in_trash' => __( 'No Tiles in trash', KUNTA_API_TILES_I18N_DOMAIN ),
	  'menu_name'          => __( 'Tiles', KUNTA_API_TILES_I18N_DOMAIN ),
	  'all_items'          => __( 'Tiles', KUNTA_API_TILES_I18N_DOMAIN )
	),
	'public' => true,
	'has_archive' => true,
	'supports' => array (
	  'title',
	  'editor',
      'thumbnail'
	)
  ));
  
}

?>