<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @since      1.0.0
 *
 * @package    Andreadb_Coin_Slider
 * @subpackage Andreadb_Coin_Slider/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Andreadb_Coin_Slider
 * @subpackage Andreadb_Coin_Slider/includes
 * @author     Andreadb <andreadb91@gmail.com>
 */
class Andreadb_Coin_Slider {

    /**
     * The loader that's responsible for maintaining and registering all hooks that power
     * the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      Andreadb_Coin_Slider_Loader    $loader    Maintains and registers all hooks for the plugin.
     */
    protected $loader;

    /**
     * The unique identifier of this plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string    $plugin_name    The string used to uniquely identify this plugin.
     */
    protected $plugin_name;

    /**
     * The current version of the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string    $version    The current version of the plugin.
     */
    protected $version;

    /**
     * Define the core functionality of the plugin.
     *
     * Set the plugin name and the plugin version that can be used throughout the plugin.
     * Load the dependencies, define the locale, and set the hooks for the admin area and
     * the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function __construct() {

        $this->plugin_name = 'andreadb-coin-slider';
        $this->version = '1.0.0';

        $this->load_dependencies();
        $this->set_locale();
        $this->define_admin_hooks();
        $this->define_public_hooks();
    }

    /**
     * Load the required dependencies for this plugin.
     *
     * Include the following files that make up the plugin:
     *
     * - Andreadb_Coin_Slider_Loader. Orchestrates the hooks of the plugin.
     * - Andreadb_Coin_Slider_i18n. Defines internationalization functionality.
     * - Andreadb_Coin_Slider_Admin. Defines all hooks for the admin area.
     * - Andreadb_Coin_Slider_Public. Defines all hooks for the public side of the site.
     *
     * Create an instance of the loader which will be used to register the hooks
     * with WordPress.
     *
     * @since    1.0.0
     * @access   private
     */
    private function load_dependencies() {

        /**
         * The class responsible for orchestrating the actions and filters of the
         * core plugin.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-andreadb-coin-slider-loader.php';

        /**
         * The class responsible for defining internationalization functionality
         * of the plugin.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-andreadb-coin-slider-i18n.php';

        /**
         * The class responsible for defining widget functionality of the plugin.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-andreadb-coin-slider-widget.php';

        /**
         * The class responsible for defining all actions that occur in the admin area.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-andreadb-coin-slider-admin.php';

        /**
         * The class responsible for defining all actions that occur in the public-facing
         * side of the site.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'public/class-andreadb-coin-slider-public.php';

        $this->loader = new Andreadb_Coin_Slider_Loader();
    }

    /**
     * Define the locale for this plugin for internationalization.
     *
     * Uses the Andreadb_Coin_Slider_i18n class in order to set the domain and to register the hook
     * with WordPress.
     *
     * @since    1.0.0
     * @access   private
     */
    private function set_locale() {

        $plugin_i18n = new Andreadb_Coin_Slider_i18n();

        $this->loader->add_action('plugins_loaded', $plugin_i18n, 'load_plugin_textdomain');
    }

    /**
     * Register all of the hooks related to the admin area functionality
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_admin_hooks() {

        $plugin_admin = new Andreadb_Coin_Slider_Admin($this->get_plugin_name(), $this->get_version());

        $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'dba_coin_slider_enqueue_styles');
        $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'dba_coin_slider_enqueue_scripts');

        $this->loader->add_action('init', $plugin_admin, 'register_dba_coin_slider_post_type');
        $this->loader->add_action('widgets_init', $plugin_admin, 'register_dba_coin_slider_widgets');
        $this->loader->add_action('admin_menu', $plugin_admin, 'add_dba_coin_slider_admin_menu');

        $this->loader->add_action('add_meta_boxes', $plugin_admin, 'add_meta_boxes_dba_coin_slider');
        $this->loader->add_action('save_post', $plugin_admin, 'save_metaboxes_dba_coin_slider');

        $this->loader->add_filter('manage_edit-dba_coin_slider_columns', $plugin_admin, 'dba_coin_slider_columns');
        $this->loader->add_action('manage_dba_coin_slider_posts_custom_column', $plugin_admin, 'dba_coin_slider_column', 10, 3);
        $this->loader->add_filter('post_row_actions', $plugin_admin, 'dba_coin_slider_action_row', 10, 2);

        $this->loader->add_action('wp_ajax_create_dba_coin_slider', $plugin_admin, 'ajax_create_dba_coin_slider');
        $this->loader->add_action('wp_ajax_dba_coin_slider_preview', $plugin_admin, 'ajax_dba_coin_slider_preview');
    }

    /**
     * Register all of the hooks related to the public-facing functionality
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_public_hooks() {

        $plugin_public = new Andreadb_Coin_Slider_Public($this->get_plugin_name(), $this->get_version());

        $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'dba_coin_slider_enqueue_styles');
        $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'dba_coin_slider_enqueue_scripts');

        $this->loader->add_action('init', $plugin_public, 'register_dba_coin_slider_shortcodes');
    }

    /**
     * Run the loader to execute all of the hooks with WordPress.
     *
     * @since    1.0.0
     */
    public function run() {
        $this->loader->run();
    }

    /**
     * The name of the plugin used to uniquely identify it within the context of
     * WordPress and to define internationalization functionality.
     *
     * @since     1.0.0
     * @return    string    The name of the plugin.
     */
    public function get_plugin_name() {
        return $this->plugin_name;
    }

    /**
     * The reference to the class that orchestrates the hooks with the plugin.
     *
     * @since     1.0.0
     * @return    Andreadb_Coin_Slider_Loader    Orchestrates the hooks of the plugin.
     */
    public function get_loader() {
        return $this->loader;
    }

    /**
     * Retrieve the version number of the plugin.
     *
     * @since     1.0.0
     * @return    string    The version number of the plugin.
     */
    public function get_version() {
        return $this->version;
    }

}
