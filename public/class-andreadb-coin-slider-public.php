<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @since      1.0.0
 *
 * @package    Andreadb_Coin_Slider
 * @subpackage Andreadb_Coin_Slider/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Andreadb_Coin_Slider
 * @subpackage Andreadb_Coin_Slider/public
 * @author     Andreadb <andreadb91@gmail.com>
 */
class Andreadb_Coin_Slider_Public {

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
     * @param      string    $plugin_name       The name of the plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($plugin_name, $version) {

        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    /**
     * Register the stylesheets for the public-facing side of the site.
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
        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/coin-slider-styles.css', array(), $this->version, 'all');
    }

    /**
     * Register the JavaScript for the public-facing side of the site.
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
        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/coin-slider.min.js', array('jquery'), $this->version, false);
    }

    /**
     * Register the andreadb_coin_slider shortcode.
     * 
     * @since 	1.0.0
     * @access 	public
     * @uses 	add_shortcode()
     */
    public function register_dba_coin_slider_shortcodes() {

        add_shortcode('andreadb_coin_slider', array($this, 'dba_coin_slider_shortcode'));
    }

    /**
     * Displays shortcode on pages
     *
     * @since    1.0.0
     * @param array $atts Array of shortcode parameters
     * @return string Slider HTML
     */
    public function dba_coin_slider_shortcode($atts) {

        extract(shortcode_atts(
                        array('id' => 0), $atts, 'andreadb_coin_slider'
        ));

        if (!$id) {
            return false;
        }

        $slider_slides = get_post_meta($id, 'dba_coin_slider_slides', true);
        $slider_settings = get_post_meta($id, 'dba_coin_slider_settings', true);

        $html = '<!-- andreadb coin slider -->';
        $html .= '<div id="andreadb-coin-slider-' . $id . '">';
        if (is_array($slider_slides) and count($slider_slides) > 0) {
            foreach ($slider_slides as $slide) {
                $html .= '<div class="andreadb-coin-slider-' . $id . '">';
                if ($slide['link']) {
                    $slide_url = $slide['link'];
                    if (false === strpos($slide['link'], '://')) {
                        $slide_url = 'http://' . $slide['link'];
                    }
                    $title = ($slide['title'] ? ' title="' . $slide['title'] . '"' : '');
                    $new_window = ($slide['new_window'] == 1 ? ' target="_blank"' : '');
                    $html .= '<a href="' . $slide_url . '"' . $title . $new_window . '>';
                } else {
                    $html .= '<a href="javascript:void(0)">';
                }
                $image_url = wp_get_attachment_image_src($slide['id'], 'full', true);
                $image_alt = ($slide['alt'] ? ' alt="' . $slide['alt'] . '"' : '');
                $html .= '<img src="' . $image_url[0] . '"' . $image_alt . ' class="image-slider-' . $id . ' slide-' . $slide['id'] . '">';
                if ($slide['description']) {
                    $html .= '<span>' . $slide['description'] . '</span>';
                }
                $html .= '</a>';
                $html .= '</div>';
            }
        }
        $html .= '<script type="text/javascript">';
        $html .= '(function($) {';
        $html .= '$("#andreadb-coin-slider-' . $id . '").coinslider({'
                . ' width: ' . $slider_settings['width'] . ','
                . ' height: ' . $slider_settings['height'] . ','
                . ' spw: ' . $slider_settings['spw'] . ','
                . ' sph: ' . $slider_settings['sph'] . ','
                . ' delay: ' . $slider_settings['delay'] . ','
                . ' sdelay: ' . $slider_settings['sdelay'] . ','
                . ' opacity: ' . $slider_settings['opacity'] . ','
                . ' title_speed: ' . $slider_settings['title_speed'] . ','
                . ' effect: "' . $slider_settings['effect'] . '",'
                . ' navigation: ' . $slider_settings['navigation'] . ','
                . ' links: ' . $slider_settings['links'] . ','
                . ' hover_pause: ' . $slider_settings['hover_pause']
                . '});';
        $html .= '})(jQuery);';
        $html .= '</script>';
        $html .= '</div>';
        $html .= '<!--// andreadb coin slider-->';

        return $html;
    }

}
