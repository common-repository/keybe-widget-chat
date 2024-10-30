<?php

/**
 * Plugin Name: Keybe Widget Chat
 * Plugin URI: https://keybe.ai/
 * Description: Keybe widget chat. With keybe will boost your sales.
 * Version: 0.1
 * Author: Keybe.ai
 * Author URI: https://keybe.ai
 * Text Domain: keybe-widget-chat
 * Requires at least: 6.0
 * Requires PHP: 7.3
 *
 */

defined('ABSPATH') || exit;

include 'includes/settings-page.php';

// Get settings from settings page settings from settings page
$options = get_option('keybe_settings_chat');
$keybe_api_key_chat = $options['keybe_api_key_chat'];

if($keybe_api_key_chat){
  function keybe_widget_chat_script_tag() {
    // Register the external script with the desired attributes
    $script_attributes = array(
        'async' => true,
        'nonce' => wp_create_nonce('keybe_chat_script_nonce'),
        'type' => 'module',
    );
    wp_register_script( 'keybe-chat-script', 'https://storage.kbe.ai/keybejs/latest/keybe.js', array(), '', true, $script_attributes );
    //Enqueue the external script
    wp_enqueue_script( 'keybe-chat-script' );
    // get the api key from the options table
    $options = get_option('keybe_settings_chat');
    $keybe_api_key_chat = $options['keybe_api_key_chat'];
    // create the inline script
    $script = '
        window.addEventListener("load", function() {
            var configChat = {
                apiKey: "'.$keybe_api_key_chat.'",
            }
            window.keybe.webchatConversationsUiLoad(configChat)
        });';
    // enqueue the inline script after the external script
    wp_add_inline_script( 'keybe-chat-script', $script, 'after' );
  }
  add_action( 'wp_enqueue_scripts', 'keybe_widget_chat_script_tag' );
}