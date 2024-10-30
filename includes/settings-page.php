<?php
/**
 * Keybe Settings Page
 */

defined('ABSPATH') || exit;

function add_keybe_plugin_chat_menu() {
	add_submenu_page('options-general.php', 'keybe Widget Chat', 'keybe Widget Chat', 'manage_options', 'keybe-widget-chat', 'keybe_plugin_chat_function');
}
add_action('admin_menu', 'add_keybe_plugin_chat_menu');

function keybe_settings_chat_init() {
  register_setting( 'keybe-setting-chat', 'keybe_settings_chat' );
  add_settings_section('keybe-plugin-section-chat', __( 'keybe Widget Chat', 'keybe-widget-chat' ), 'keybe_chat_settings_section_callback', 'keybe-setting-chat');
  add_settings_field('keybe_api_key_chat', __( 'Keybe Api Key:', 'keybe-widget-chat' ), 'keybe_api_key_chat', 'keybe-setting-chat', 'keybe-plugin-section-chat');
}

add_action( 'admin_init', 'keybe_settings_chat_init' );

function keybe_chat_settings_section_callback(  ) {
  echo __( '<p><strong>Keybe Widget Chat settings</strong></p>', 'keybe-widget-chat' );
  echo __( '<p class="description">You can find your API keys in your Keybe account <strong><a href="https://keybe.app/admin/configurations/app" target="_blank">here!</a></strong>. <br>The plugin will add the chat widget in your site.</p>', 'keybe-widget-chat' );
  echo __( '<p>Setup your web chat configuration on <a href="https://keybe.app/admin/configurations/chat" target="_blank">https://keybe.app/admin/configurations/chat</a></p>', 'keybe-widget-chat' );
}

function keybe_api_key_chat(){
  $options = get_option( 'keybe_settings_chat' );
  $keybe_api_key_chat = $options["keybe_api_key_chat"];
  echo __("<input type='text' class='regular-text' name='keybe_settings_chat[keybe_api_key_chat]' value='$keybe_api_key_chat'>");
}

function keybe_plugin_chat_function(){ ?>
	<form action='options.php' method='post'> <?php
			settings_fields( 'keybe-setting-chat' );
			do_settings_sections( 'keybe-setting-chat' );
			submit_button(); ?>
	</form> <?php
}