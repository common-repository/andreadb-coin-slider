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
?>
<div class="andreadb-coin-slider-codes">
    <div class="andreadb-coin-slider-field">
        <label><?php _e('Your Shortcode', 'andreadb-coin-slider'); ?></label>
        <input type="text" value="<?php echo $shortcode; ?>" readonly="true" class="widefat" id="andreadb-coin-slider-get-shortcode" />
        <span class="note1"><?php _e('Copy and paste this shortcode into any WordPress post or page.', 'andreadb-coin-slider'); ?></span>
        <div class="clear"></div>
    </div>
    <div class="andreadb-coin-slider-field">
        <label><?php _e('Your PHP Code', 'andreadb-coin-slider'); ?></label>
        <textarea id="andreadb-coin-slider-get-code" readonly="true"><?php echo $shortcodephp; ?></textarea>
        <span class="note1"><?php _e('Copy and paste this code into a template file to include the slideshow.', 'andreadb-coin-slider'); ?></span>
        <div class="clear"></div>
    </div>
</div>