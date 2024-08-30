<?php

/**
 * Plugin Name:       Elementor Kit Addons
 * Description:       Simple Elementor Kit Addons Plugin for elementor based website
 * Plugin URI:        #
 * Version:           1.0.0
 * Author:            Robiul Islam
 * Author URI:        https://robiul-islam.netlify.app
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Domain Path:       /languages
 * Text Domain:      r_elekit
 * 
 * Elementor tested up to: 3.21.0
 * Elementor Pro tested up to: 3.21.0
 */

// if anyone try to access our main file
if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Make final class
 */
final class R_EleKit {

    /**
     * Plugin Version
     *
     * @since 1.0.0
     *
     * @var string The plugin version.
     */
    const VERSION = '1.0.0';
    /**
     * Minimum Elementor Version
     *
     * @since 1.0.0
     *
     * @var string Minimum Elementor version required to run the plugin.
     */
    const MINIMUM_ELEMENTOR_VERSION = '3.0.0';

    /**
     * Minimum PHP Version
     *
     * @since 1.0.0
     *
     * @var string Minimum PHP version required to run the plugin.
     */
    const MINIMUM_PHP_VERSION = '7.2';

    /**
     * Constructor
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function __construct() {

        add_action( 'plugins_loaded', [$this, 'rek_on_plugins_loaded'] );

        add_action( 'elementor/widgets/register', [$this, 'register_hello_world_widget'] );

    }

    /**
     * Call all things here
     *
     * After all plugins loaded it'll be called
     *
     * @return void
     */
    public function rek_on_plugins_loaded() {

    }

    public function register_hello_world_widget( $widgets_manager ) {
        require_once __DIR__ . '/widgets/hello-world-widget-2.php';

        $widgets_manager->register( new \Elementor_Hello_World_Widget_2() );

    }

    /**
     * Compatibility Checks
     *
     * Checks if the installed version of Elementor meets the plugin's minimum requirement.
     * Checks if the installed PHP version meets the plugin's minimum requirement.
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function is_compatible() {

        // Check if Elementor installed and activated
        if ( !did_action( 'elementor/loaded' ) ) {
            add_action( 'admin_notices', [$this, 'admin_notice_missing_main_plugin'] );
            return false;
        }

        // Check for required Elementor version
        if ( !version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
            add_action( 'admin_notices', [$this, 'admin_notice_minimum_elementor_version'] );
            return false;
        }

        // Check for required PHP version
        if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
            add_action( 'admin_notices', [$this, 'admin_notice_minimum_php_version'] );
            return false;
        }

        return true;

    }

    /**
     * Admin notice
     *
     * Warning when the site doesn't have Elementor installed or activated.
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function admin_notice_missing_main_plugin() {

        if ( isset( $_GET['activate'] ) ) {
            unset( $_GET['activate'] );
        }

        $message = sprintf(
            /* translators: 1: Plugin name 2: Elementor */
            esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'boilerplate-elementor-extension' ),
            '<strong>' . esc_html__( 'Elementor Test Extension', 'boilerplate-elementor-extension' ) . '</strong>',
            '<strong>' . esc_html__( 'Elementor', 'boilerplate-elementor-extension' ) . '</strong>'
        );

        printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

    }

    /**
     * Admin notice
     *
     * Warning when the site doesn't have a minimum required Elementor version.
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function admin_notice_minimum_elementor_version() {

        if ( isset( $_GET['activate'] ) ) {
            unset( $_GET['activate'] );
        }

        $message = sprintf(
            /* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
            esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'boilerplate-elementor-extension' ),
            '<strong>' . esc_html__( 'Elementor Test Extension', 'boilerplate-elementor-extension' ) . '</strong>',
            '<strong>' . esc_html__( 'Elementor', 'boilerplate-elementor-extension' ) . '</strong>',
            self::MINIMUM_ELEMENTOR_VERSION
        );

        printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

    }

    /**
     * Admin notice
     *
     * Warning when the site doesn't have a minimum required PHP version.
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function admin_notice_minimum_php_version() {

        if ( isset( $_GET['activate'] ) ) {
            unset( $_GET['activate'] );
        }

        $message = sprintf(
            /* translators: 1: Plugin name 2: PHP 3: Required PHP version */
            esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'boilerplate-elementor-extension' ),
            '<strong>' . esc_html__( 'Elementor Test Extension', 'boilerplate-elementor-extension' ) . '</strong>',
            '<strong>' . esc_html__( 'PHP', 'boilerplate-elementor-extension' ) . '</strong>',
            self::MINIMUM_PHP_VERSION
        );

        printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

    }

}

// Create instance
new R_EleKit();

/**
 * Inspect helper function
 *
 * @param mixed $value
 *
 * @return void
 */
function dump( $value ) {
    echo '<pre>';
    print_r( $value );
    echo '</pre>';
}