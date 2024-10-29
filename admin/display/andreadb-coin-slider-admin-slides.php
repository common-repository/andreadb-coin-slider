<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @since      1.0.0
 *
 * @package    Andreadb_Coin_Slider
 * @subpackage Andreadb_Coin_Slider/admin/display
 */
$image_url = wp_get_attachment_image($slide['id'], 'thumbnail', true);
?>
<div class="slide">
    <div class="slide-title">
        <span class="slide-title-index">Slide <?php echo $key + 1; ?></span>
        <span class="dashicons dashicons-no delete-slide"></span>
    </div>
    <div class="content-inner">
        <input type="hidden" name="dba_coin_slider_slides[<?php echo $key; ?>][id]" value="<?php echo $slide['id']; ?>"/>
        <div class="thumb left"><?php echo $image_url; ?></div>
        <div class="attribute left">
            <ul class="tabs">
                <li class="selected" data-tab="tab-0"><?php _e('General', 'andreadb-coin-slider'); ?></li>
                <li data-tab="tab-1"><?php _e('Link', 'andreadb-coin-slider'); ?></li>
            </ul>
            <div class="tabs-content">
                <div class="tab tab-0">
                    <div class="andreadb-coin-slider-field">
                        <label><?php _e('Alt image', 'andreadb-coin-slider'); ?></label>
                        <input type="text" value="<?php echo $slide['alt']; ?>" name="dba_coin_slider_slides[<?php echo $key; ?>][alt]" class="widefat" id="andreadb-coin-slider-alt-image">
                    </div>
                    <div class="andreadb-coin-slider-field">
                        <label><?php _e('Caption image', 'andreadb-coin-slider'); ?></label>
                        <textarea name="dba_coin_slider_slides[<?php echo $key; ?>][description]" class="widefat" id="andreadb-coin-slider-description-image"><?php echo $slide['description']; ?></textarea>
                    </div>
                </div>
                <div class="tab tab-1 hidden-tab">
                    <div class="andreadb-coin-slider-field">
                        <label><?php _e('Link url', 'andreadb-coin-slider'); ?></label>
                        <input type="text" value="<?php echo $slide['link']; ?>" name="dba_coin_slider_slides[<?php echo $key; ?>][link]" class="widefat" id="andreadb-coin-slider-link-image">
                    </div>
                    <div class="andreadb-coin-slider-field">
                        <label><?php _e('Link title', 'andreadb-coin-slider'); ?></label>
                        <input type="text" value="<?php echo $slide['title']; ?>" name="dba_coin_slider_slides[<?php echo $key; ?>][title]" class="widefat" id="andreadb-coin-slider-title-link">
                    </div>
                    <div class="mb10"></div>
                    <div class="andreadb-coin-slider-field">
                        <input name="dba_coin_slider_slides[<?php echo $key; ?>][new_window]" value="0" type="hidden">
                        <input type="checkbox" value="<?php echo ($slide['new_window'] ? "1" : "0"); ?>" <?php checked($slide['new_window'], true) ?> name="dba_coin_slider_slides[<?php echo $key; ?>][new_window]" class="checkbox">
                        <span class="bold"><?php _e('Open link in new window', 'andreadb-coin-slider'); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>