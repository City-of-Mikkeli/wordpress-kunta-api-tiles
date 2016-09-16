<?php
/*
 * Created on Sep 9, 2016
 * Plugin Name: Kunta API Tiles
 * Description: Kunta API Header Tiles plugin for Wordpress
 * Version: 0.1
 * Author: Antti Leppä / Otavan Opisto
 */
defined ( 'ABSPATH' ) || die ( 'No script kiddies please!' );

require_once ('constants.php');

add_action ('init', 'kuntaApiTilesCreatePostType' );
add_action ('add_meta_boxes', 'kuntaApiTileMetaBox', 9999, 2 );
add_action ('save_post', 'kuntaApiTileSaveLink');
add_action ('plugins_loaded', 'kuntaApiTileTextDomain');

function kuntaApiTilesCreatePostType() {
  
  register_post_type ( 'tile', array (
    'labels' => array (
      'name'               => __( 'Header Tiles', KUNTA_API_TILES_I18N_DOMAIN ),
      'singular_name'      => __( 'Header Tile', KUNTA_API_TILES_I18N_DOMAIN ),
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
    'show_in_rest' => true,
    'supports' => array (
      'title',
      'editor',
      'thumbnail'
     )
  ));
  
}

function kuntaApiTileRenderMetaBox($tile) {
  $link = get_post_meta($tile->ID, "tile-link", true);
  echo '<input name="tile-link" id="tile-link" type="url" style="width: 100%;" value="' . $link . '"></input>';
}

function kuntaApiTileMetaBox() {
  add_meta_box( 
    'tile-link-meta-box',
    __( 'Tile Link', KUNTA_API_TILES_I18N_DOMAIN ),
     'kuntaApiTileRenderMetaBox',
     'tile',
     'side',
     'default'
  );
}

function kuntaApiTileSaveLink($tileId) {
  if (array_key_exists('tile-link', $_POST)) {
	update_post_meta($tileId, 'tile-link', $_POST['tile-link']);
  }
}

function kuntaApiTileRestGet( $object, $field_name, $request) {
  return get_post_meta( $object[ 'id' ], $field_name, true);
}

add_action('rest_api_init', function () {
	
  register_rest_field( 'tile', 'tile-link', array(
	'get_callback' => 'kuntaApiTileRestGet',
	'update_callback' => null,
	'schema' => array (
	  "type" => "string",
	  "format" => "url",
	  "description" => "Tile link"
	)
  ));
  
});

function kuntaApiTileTextDomain() {
  load_plugin_textdomain(KUNTA_API_TILES_I18N_DOMAIN);
}


?>