<?php
/**
 * Disable WordPress extra features
 *
 * @author   Fernando Tessmann
 * @since    1.0.0
 * @package  dwef
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'DisableExtraFeatures' ) ) :

	/**
	 * Disable WordPress extra features Class
	 *
	 * @class    DisableExtraFeatures
	 * @since    1.0.0
	 * @package  dwef
	 */
	class DisableExtraFeatures {

		/**
		 * Setup class
		 *
		 * @since  1.0.0
		 */
		public function __construct() {
			$this->clean_on_construct();

			add_action( 'after_setup_theme', array( $this, 'clean_on_after_setup_theme' ) );
		}

		/**
		 * WordPress clean (part 1, on __construct)
		 *
		 * @since  1.0.0
		 */
		public function clean_on_construct() {
			// Remove really simple discovery link.
			remove_action( 'wp_head', 'rsd_link' );

			// Remove WordPress version.
			remove_action( 'wp_head', 'wp_generator' );

			// Remove rss feed links.
			remove_action( 'wp_head', 'feed_links', 2 );

			// Removes all extra rss feed links.
			remove_action( 'wp_head', 'feed_links_extra', 3 );

			// Remove link to index page.
			remove_action( 'wp_head', 'index_rel_link' );

			// Remove wlwmanifest.xml.
			remove_action( 'wp_head', 'wlwmanifest_link' );

			// Remove random post link.
			remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );

			// Remove parent post link.
			remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );

			// Remove the next and previous post links.
			remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 );
			remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );

			// Remove emojicon.
			remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
			remove_action( 'wp_print_styles', 'print_emoji_styles' );

			// Remove shortlink.
			remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );

			// Remove dns-prefetch meta.
			remove_action( 'wp_head', 'wp_resource_hints', 2 );
		}

		/**
		 * WordPress clean (part 2, on after_setup_theme)
		 *
		 * @since  1.0.0
		 */
		public function clean_on_after_setup_theme() {
			// Remove JSON API links in header html.

			// Remove the REST API lines from the HTML Header.
			remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
			remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );

			// Remove the REST API endpoint.
			remove_action( 'rest_api_init', 'wp_oembed_register_route' );

			// Turn off oEmbed auto discovery.
			add_filter( 'embed_oembed_discover', '__return_false' );

			// Don't filter oEmbed results.
			remove_filter( 'oembed_dataparse', 'wp_filter_oembed_result', 10 );

			// Remove oEmbed discovery links.
			remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );

			// Remove oEmbed-specific JavaScript from the front-end and back-end.
			remove_action( 'wp_head', 'wp_oembed_add_host_js' );

			// Remove all embeds rewrite rules.
			/* add_filter( 'rewrite_rules_array', 'disable_embeds_rewrites' ); */

			// Snippet completely disable the REST API and shows {"code":"rest_disabled","message":"The REST API is disabled on this site."}.

			// Filters for WP-API version 1.x.
			add_filter( 'json_enabled', '__return_false' );
			add_filter( 'json_jsonp_enabled', '__return_false' );

			// Filters for WP-API version 2.x.
			add_filter( 'rest_enabled', '__return_false' );
			add_filter( 'rest_jsonp_enabled', '__return_false' );
		}

	}

endif;

return new DisableExtraFeatures();
