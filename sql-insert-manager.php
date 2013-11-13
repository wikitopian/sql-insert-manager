<?php

/*
 * Plugin Name: SQL Insert Manager
 * Plugin URI:  http://www.github.com/wikitopian/sql-insert-manager
 * Description: Fork-friendly basis for custom SQL tweaks
 * Version:     2.0
 * Author:      @wikitopian
 * Author URI:  http://www.swarmstrategies.com/matt
 * License:     GPLv2
 */

class Sql_Insert_Manager {
	const LABEL = 'Sql Insert Manager';

	public function __construct() {
		add_action( 'admin_init', array( get_class(), 'do_query' ) );

		add_action( 'admin_menu', array( get_class(), 'add_page' ) );
	}
	public static function add_page() {
		add_options_page(
			self::LABEL,
			self::LABEL,
			'manage_options',
			get_class(),
			array( get_class(), 'do_page' )
		);
	}
	public static function do_page() {
		echo "<div class=\"wrap\">\n";
		echo "\t<div id=\"icon-options-general\" class=\"icon32\">\n";
		echo "\t\t<br />\n";
		echo "\t</div>\n";
		echo "\t<h2>" . self::LABEL . "</h2>\n";

		echo "\t<form name=\"" . get_class() . "\" method=\"post\">\n";
		wp_nonce_field( get_class(), get_class() );
		echo "\n\n";
		submit_button( 'Execute Query' );
		echo "\n\n";
		echo "\t</form>\n";
		echo "</div>\n";
	}
	public static function do_query() {
		global $_REQUEST;

		if ( empty( $_REQUEST[get_class()] ) ) {
			return;
		}

		if ( !wp_verify_nonce( $_REQUEST[get_class()], get_class() ) ) {
			return;
		}

		self::the_query();
	}
	public static function the_query() {
		//Perform Query
	}
}
$sql_insert_manager = new Sql_Insert_Manager();

?>
