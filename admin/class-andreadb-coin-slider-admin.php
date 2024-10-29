<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @since      1.0.0
 *
 * @package    Andreadb_Coin_Slider
 * @subpackage Andreadb_Coin_Slider/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Andreadb_Coin_Slider
 * @subpackage Andreadb_Coin_Slider/admin
 * @author     Andreadb <andreadb91@gmail.com>
 */
class Andreadb_Coin_Slider_Admin {

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $plugin_name       The name of this plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($plugin_name, $version) {

        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function dba_coin_slider_enqueue_styles() {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Andreadb_Coin_Slider_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Andreadb_Coin_Slider_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/andreadb-coin-slider-admin.css', array(), $this->version, 'all');
    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function dba_coin_slider_enqueue_scripts() {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Andreadb_Coin_Slider_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Andreadb_Coin_Slider_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
        wp_enqueue_media();
        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/andreadb-coin-slider-admin.js', array('jquery'), $this->version, false);
        wp_localize_script($this->plugin_name, 'andreadb_coin_slider', array(
            'url' => __('URL', 'andreadb-coin-slider'),
            'confirm' => __('Are you sure?', 'andreadb-coin-slider'),
            'ajaxurl' => admin_url('admin-ajax.php'),
            'addslide_nonce' => wp_create_nonce('dba_coin_slider_addslide'),
            'iframeurl' => admin_url('admin-ajax.php?action=dba_coin_slider_preview')
                )
        );
    }

    /**
     * Register dba_coin_slider post type.
     *
     * @since 	1.0.0
     * @access 	public
     * @uses 	register_post_type()
     */
    public static function register_dba_coin_slider_post_type() {

        $labels = array(
            'name' => __('Coin Slider', 'andreadb-coin-slider'),
            'singular_name' => __('Coin Slider', 'andreadb-coin-slider'),
            'menu_name' => _x('Coin Slider', 'Admin menu name', 'andreadb-coin-slider'),
            'add_new' => __('Add Coin Slider', 'andreadb-coin-slider'),
            'add_new_item' => __('Add New Coin Slider', 'andreadb-coin-slider'),
            'edit' => __('Edit', 'andreadb-coin-slider'),
            'edit_item' => __('Edit Coin Slider', 'andreadb-coin-slider'),
            'new_item' => __('New Coin Slider', 'andreadb-coin-slider'),
            'view' => __('View Coin Slider', 'andreadb-coin-slider'),
            'view_item' => __('View Coin Slider', 'andreadb-coin-slider'),
            'search_items' => __('Search coin slider', 'andreadb-coin-slider'),
            'not_found' => __('No coin slider found', 'andreadb-coin-slider'),
            'not_found_in_trash' => __('No coin slider found in trash', 'andreadb-coin-slider')
        );

        $args = array(
            'labels' => $labels,
            'query_var' => false,
            'rewrite' => false,
            'public' => true,
            'exclude_from_search' => true,
            'publicly_queryable' => false,
            'show_in_nav_menus' => true,
            'show_ui' => true,
            'menu_position' => 100,
            'menu_icon' => 'dashicons-format-gallery',
            'supports' => array(
                'title',
                'thumbnail'
            ),
        );

        register_post_type('dba_coin_slider', $args);
    }

    /**
     * Add columns in dba_coin_slider.
     *
     * @since 	1.0.0
     * @param mixed $columns
     * @return array
     */
    public function dba_coin_slider_columns($columns) {

        unset($columns['title'], $columns['date']);
        $columns['dba-coin-slider-id'] = __('ID', 'andreadb-coin-slider');
        $columns['title'] = __('Title', 'andreadb-coin-slider');
        $columns['dba-coin-slider-number'] = __('Slides', 'andreadb-coin-slider');
        $columns['dba-coin-slider-shortcode'] = __('Shortcode', 'andreadb-coin-slider');
        $columns['date'] = __('Date', 'andreadb-coin-slider');
        return $columns;
    }

    /**
     * Column value added to dba_coin_slider.
     *
     * @since 	1.0.0
     * @param string $column
     */
    public function dba_coin_slider_column($column) {

        global $post;
        $post_id = $post->ID;
        $slides = get_post_meta($post_id, 'dba_coin_slider_slides', true);
        switch ($column) {
            case 'dba-coin-slider-id' :
                echo $post_id;
                break;
            case 'dba-coin-slider-number' :
                echo ($slides ? count($slides) : 0);
                break;
            case 'dba-coin-slider-shortcode' :
                echo '<input type="text" style="width:100%" value="[andreadb_coin_slider id=&quot;' . $post_id . '&quot;]" readonly="true" />';
                break;
        }
    }

    /**
     * Add preview action row.
     *
     * @since 	1.0.0
     * @param $actions $post
     */
    public function dba_coin_slider_action_row($actions, $post) {

        if ($post->post_type == "dba_coin_slider") {
            $preview_url = add_query_arg(array(
                'action' => 'dba_coin_slider_preview',
                'andreadb_coin_slider_id' => $post->ID,
                'TB_iframe' => '1'
                    ), admin_url('admin-ajax.php')
            );
            $preview_button = __('Preview', 'andreadb-coin-slider');
            array_splice($actions, 2, 0, '<a href="' . $preview_url . '" target="_blank" id="andreadb-preview-coin-slider">' . $preview_button . '</a>');
        }
        return $actions;
    }

    /**
     * Add metaboxes coin slider.
     *
     * @since 	1.0.0
     * @access 	public
     */
    public function add_meta_boxes_dba_coin_slider() {

        // add_meta_box( $id, $title, $callback, $screen, $context, $priority, $callback_args );

        add_meta_box(
                'dba_coin_slider_slides', __('Slides', 'andreadb-coin-slider'), array($this, 'render_dba_coin_slider_slides'), 'dba_coin_slider', 'normal', 'high'
        );
        add_meta_box(
                'dba_coin_slider_settings', __('Settings', 'andreadb-coin-slider'), array($this, 'render_dba_coin_slider_settings'), 'dba_coin_slider', 'side', 'low'
        );
        add_meta_box(
                'dba_coin_slider_codes', __('Shortcodes', 'andreadb-coin-slider'), array($this, 'render_dba_coin_slider_codes'), 'dba_coin_slider', 'side', 'low'
        );
        remove_meta_box('postimagediv', 'dba_coin_slider', 'side');
    }

    /**
     * Gets the coin slider default slides.
     *
     * @since 	1.0.0
     * @access 	public
     * @return array The array of coin slider defaults
     */
    public function dba_coin_slider_defaults_slides() {

        return array(
            'id' => '',
            'description' => '',
            'alt' => '',
            'link' => '',
            'title' => '',
            'new_window' => ''
        );
    }

    /**
     * Gets the coin slider slides.
     *
     * @since 	1.0.0
     * @access 	public
     * @param $post_id
     * @return array The array of coin slider settings
     */
    public function dba_coin_slider_slides($post_id) {

        $slider_settings = get_post_meta($post_id, 'dba_coin_slider_slides', true);
        if (empty($slider_settings)) {
            $this->dba_coin_slider_defaults_slides();
        } else {
            return $slider_settings;
        }
    }

    /**
     * Render slider slides.
     *
     * @since 	1.0.0
     * @access 	public
     * @param $post
     */
    public function render_dba_coin_slider_slides($post) {

        $post_id = $post->ID;

        echo '<div class="andreadb-coin-slider-slides">'
        . '<input type="hidden" id="andreadb-coin-slider-id" value="' . $post_id . '"/>'
        . '<button type="button" id="andreadb-add-coin-slider" class="button">'
        . '<span class="dashicons dashicons-camera"></span>' . translate('Add Slide', 'andreadb-coin-slider') . '</button>'
        . '<button type="button" id="andreadb-preview-coin-slider" class="button">'
        . '<span class="dashicons dashicons-images-alt"></span>' . translate('Preview Slider', 'andreadb-coin-slider') . '</button>'
        . '<div id="slides">';

        $slides = $this->dba_coin_slider_slides($post_id);
        $key = 0;
        if (is_array($slides) and count($slides) > 0) {
            foreach ($slides as $slide) {
                $data = array();
                $data['slide'] = $slide;

                include( plugin_dir_path(__FILE__) . 'display/' . $this->plugin_name . '-admin-slides.php' );
                $key++;
            }
        }

        echo '</div></div>';
    }

    public function ajax_dba_coin_slider_preview() {

        if (isset($_GET['andreadb_coin_slider_id']) && absint($_GET['andreadb_coin_slider_id']) > 0) {
            $id = absint($_GET['andreadb_coin_slider_id']);
            ?>
            <!DOCTYPE html>
            <html>
                <head>
                    <meta charset="utf-8" />
                    <title><?php _e('Andreadb Coin Slider Preview', 'andreadb-fotorama') ?></title>
                    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
                    <meta http-equiv="Pragma" content="no-cache" />
                    <meta http-equiv="Expires" content="0" />
                    <?php wp_head(); ?>
                    <style type='text/css'>
                        body, html {
                            overflow: hidden;
                            margin: 0;
                            padding: 0;
                        }
                    </style>
                </head>
                <body>
                    <div id="andreadb-preview-coin-slider">
                        <?php echo do_shortcode('[andreadb_coin_slider id="' . $id . '"]'); ?>
                    </div>
                    <?php wp_footer(); ?>
                </body>
            </html>
            <?php
        }

        wp_die();
    }

    /**
     * Create a new coin slide.
     *
     * @since 	1.0.0
     * @access 	public
     */
    public function ajax_create_dba_coin_slider() {

        // security check
        if (!wp_verify_nonce($_REQUEST['_wpnonce'], 'dba_coin_slider_addslide')) {
            echo __("Security check failed. Refresh page and try again.", 'andreadb-coin-slider');
            wp_die();
        }

        $selection = $_POST['selection'];
        $post_id = $_POST['andreadb_coin_slider_id'];

        $slides = get_post_meta($post_id, 'dba_coin_slider_slides', true);
        $key = ($slides ? count($slides) : 0);

        if (is_array($selection) && count($selection)) {
            foreach ($selection as $slide_id) {
                $slide = array();
                $slide['id'] = $slide_id;

                include( plugin_dir_path(__FILE__) . 'display/' . $this->plugin_name . '-admin-slides.php' );
                $key++;
            }
        }

        wp_die();
    }

    /**
     * Render slider codes
     *
     * @since 	1.0.0
     * @access 	public
     * @param $post
     */
    public function render_dba_coin_slider_codes($post) {

        $status = get_post_status($post->ID);
        $shortcode = $shortcodephp = '';
        if ($status == 'publish') {
            $shortcode = '[andreadb_coin_slider id=&quot;' . $post->ID . '&quot;]';
            $shortcodephp = '&lt;?php &#13;&#10; echo do_shortcode("[andreadb_coin_slider id="' . $post->ID . '"]"); &#13;&#10;?>';
        }

        include( plugin_dir_path(__FILE__) . 'display/' . $this->plugin_name . '-admin-codes.php' );
    }

    /**
     * Render slider settings
     *
     * @since 	1.0.0
     * @access 	public
     * @param $post
     */
    public function render_dba_coin_slider_settings($post) {

        wp_nonce_field('dba_coin_slider_settings_nonce', 'meta_box_nonce');

        $default = $this->dba_coin_slider_defaults_settings();
        $settings = $this->dba_coin_slider_settings($post);

        $data = array();
        $data['width'] = ($settings['width'] ? $settings['width'] : $default['width']);
        $data['height'] = ($settings['height'] ? $settings['height'] : $default['height']);
        $data['spw'] = ($settings['spw'] ? $settings['spw'] : $default['spw']);
        $data['sph'] = ($settings['sph'] ? $settings['sph'] : $default['sph']);
        $data['delay'] = ($settings['delay'] ? $settings['delay'] : $default['delay']);
        $data['sdelay'] = ($settings['sdelay'] ? $settings['sdelay'] : $default['sdelay']);
        $data['opacity'] = ($settings['opacity'] ? $settings['opacity'] : $default['opacity']);
        $data['title_speed'] = ($settings['title_speed'] ? $settings['title_speed'] : $default['title_speed']);
        $data['effect'] = ($settings['effect'] ? $settings['effect'] : $default['effect']);
        $data['navigation'] = ($settings['navigation'] ? $settings['navigation'] : $default['navigation']);
        $data['links'] = ($settings['links'] ? $settings['links'] : $default['links']);
        $data['hover_pause'] = ($settings['hover_pause'] ? $settings['hover_pause'] : $default['hover_pause']);

        include( plugin_dir_path(__FILE__) . 'display/' . $this->plugin_name . '-admin-settings.php' );
    }

    /**
     * Gets the coin slider default settings.
     *
     * @since 	1.0.0
     * @access 	public
     * @return array The array of coin slider defaults
     */
    public function dba_coin_slider_defaults_settings() {

        return array(
            'width' => '565',
            'height' => '290',
            'spw' => '7',
            'sph' => '5',
            'delay' => '3000',
            'sdelay' => '30',
            'opacity' => '0.7',
            'title_speed' => '500',
            'effect' => '',
            'navigation' => 'true',
            'links' => 'true',
            'hover_pause' => 'true'
        );
    }

    /**
     * Gets the coin slider settings.
     *
     * @since 	1.0.0
     * @access 	public
     * @param $post
     * @return array The array of coin slider settings
     */
    public function dba_coin_slider_settings($post) {

        $post_id = $post->ID;
        $slider_settings = get_post_meta($post_id, 'dba_coin_slider_settings', true);
        if (empty($slider_settings)) {
            $this->dba_coin_slider_defaults_settings();
        } else {
            return $slider_settings;
        }
    }

    /**
     * Save metaboxes coin slider
     *
     * @since 	1.0.0
     * @param $post_id
     * @access 	public
     */
    public function save_metaboxes_dba_coin_slider($post_id) {

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        if (!isset($_POST['meta_box_nonce']) || !wp_verify_nonce($_POST['meta_box_nonce'], 'dba_coin_slider_settings_nonce')) {
            return;
        }

        if (!current_user_can('edit_post')) {
            return;
        }

        // update settings
        if (isset($_POST['dba_coin_slider_settings'])) {
            $settings = $_POST['dba_coin_slider_settings'];
            update_post_meta($post_id, 'dba_coin_slider_settings', $settings);
        }
        // update images
        if (isset($_POST['dba_coin_slider_slides'])) {
            $slides = $_POST['dba_coin_slider_slides'];
            update_post_meta($post_id, 'dba_coin_slider_slides', $slides);
        } else {
            delete_post_meta($post_id, 'dba_coin_slider_slides');
        }
    }

    /**
     * Register dba_coin_slider widget.
     *
     * @since 	1.0.0
     * @access 	public
     * @uses 	register_widget()
     */
    public function register_dba_coin_slider_widgets() {

        register_widget('Andreadb_Coin_Slider_Widget');
    }

    /**
     * Adds a settings page link to a menu
     *
     * @link 		https://codex.wordpress.org/Administration_Menus
     * @since 		1.0.0
     * @return 		void
     */
    public function add_dba_coin_slider_admin_menu() {

        // Top-level page
        // add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
        // Submenu Page
        // add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function);

        add_submenu_page(
                'edit.php?post_type=dba_coin_slider', esc_html__('Donate', $this->plugin_name), esc_html__('Donate', $this->plugin_name), 'manage_options', 'andreadb-coin-slider-donate', array($this, 'dba_coin_slider_donate'));
    }

    /**
     * Creates the import product page
     *
     * @since 		1.0.0
     * @return 		void
     */
    public function dba_coin_slider_donate() {

        include( plugin_dir_path(__FILE__) . 'display/andreadb-coin-slider-admin-donate.php' );
    }

}
