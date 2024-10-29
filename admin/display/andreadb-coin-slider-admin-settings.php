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
<div class="andreadb-coin-slider-settings">
    <div class="andreadb-coin-slider-field">
        <label><?php _e('Width', 'andreadb-coin-slider'); ?></label>
        <input id="andreadb-coin-slider-width" type="number" name="dba_coin_slider_settings[width]" value="<?php echo esc_attr($data['width']); ?>" />
        <span class="note"><?php _e('px', 'andreadb-coin-slider'); ?></span>
        <div class="clear"></div>
    </div>
    <div class="andreadb-coin-slider-field">
        <label><?php _e('Height', 'andreadb-coin-slider'); ?></label>
        <input id="andreadb-coin-slider-height" type="number" name="dba_coin_slider_settings[height]" value="<?php echo esc_attr($data['height']); ?>" />
        <span class="note"><?php _e('px', 'andreadb-coin-slider'); ?></span>
        <div class="clear"></div>
    </div>
    <div class="andreadb-coin-slider-field">
        <label><?php _e('Squares per width', 'andreadb-coin-slider'); ?></label>
        <input id="andreadb-coin-slider-spw" type="number" name="dba_coin_slider_settings[spw]" value="<?php echo esc_attr($data['spw']); ?>" />
        <div class="clear"></div>
    </div>
    <div class="andreadb-coin-slider-field">
        <label><?php _e('Squares per height', 'andreadb-coin-slider'); ?></label>
        <input id="andreadb-coin-slider-sph" type="number" name="dba_coin_slider_settings[sph]" value="<?php echo esc_attr($data['sph']); ?>" />
        <div class="clear"></div>
    </div>
    <div class="andreadb-coin-slider-field">
        <label><?php _e('Delay', 'andreadb-coin-slider'); ?></label>
        <input id="andreadb-coin-slider-delay" type="number" name="dba_coin_slider_settings[delay]" value="<?php echo esc_attr($data['delay']); ?>" />
        <span class="note"><?php _e('ms', 'andreadb-coin-slider'); ?></span>
        <div class="clear"></div>
    </div>
    <div class="andreadb-coin-slider-field">
        <label><?php _e('Delay squares', 'andreadb-coin-slider'); ?></label>
        <input id="andreadb-coin-slider-sdelay" type="number" name="dba_coin_slider_settings[sdelay]" value="<?php echo esc_attr($data['sdelay']); ?>" />
        <span class="note"><?php _e('ms', 'andreadb-coin-slider'); ?></span>
        <div class="clear"></div>
    </div>
    <div class="andreadb-coin-slider-field">
        <label><?php _e('Opacity', 'andreadb-coin-slider'); ?><span class="note1"><?php _e('(Opacity of title and navigation)', 'andreadb-coin-slider'); ?></span></label>
        <input id="andreadb-coin-slider-opacity" type="number" step="0.1" min="0" max="1" name="dba_coin_slider_settings[opacity]" value="<?php echo esc_attr($data['opacity']); ?>" />
        <div class="clear"></div>
    </div>
    <div class="andreadb-coin-slider-field">
        <label><?php _e('Speed of title', 'andreadb-coin-slider'); ?></label>
        <input id="andreadb-coin-slider-title-speed" type="number" name="dba_coin_slider_settings[title_speed]" value="<?php echo esc_attr($data['title_speed']); ?>" />
        <span class="note"><?php _e('ms', 'andreadb-coin-slider'); ?></span>
        <div class="clear"></div>
    </div>
    <div class="andreadb-coin-slider-field">
        <label><?php _e('Effect', 'andreadb-coin-slider'); ?></label>
        <select id="andreadb-coin-slider-effect" name="dba_coin_slider_settings[effect]">
            <option <?php selected($data['effect'], 'random'); ?> value="random"><?php _e('Random', 'andreadb-coin-slider'); ?></option>
            <option <?php selected($data['effect'], 'swirl'); ?> value="swirl"><?php _e('Swirl', 'andreadb-coin-slider'); ?></option>
            <option <?php selected($data['effect'], 'rain'); ?> value="rain"><?php _e('Rain', 'andreadb-coin-slider'); ?></option>
            <option <?php selected($data['effect'], 'straight'); ?> value="straight"><?php _e('Straight', 'andreadb-coin-slider'); ?></option>
        </select>
        <div class="clear"></div>
    </div>
    <div class="andreadb-coin-slider-field">
        <label><?php _e('Navigation', 'andreadb-coin-slider'); ?></label>
        <select id="andreadb-coin-slider-navigation" name="dba_coin_slider_settings[navigation]">
            <option <?php selected($data['navigation'], 'false'); ?> value="false"><?php _e('No', 'andreadb-coin-slider'); ?></option>
            <option <?php selected($data['navigation'], 'true'); ?> value="true"><?php _e('Yes', 'andreadb-coin-slider'); ?></option>
        </select>
        <div class="clear"></div>
    </div>
    <div class="andreadb-coin-slider-field">
        <label><?php _e('Links', 'andreadb-coin-slider'); ?><span class="note1"><?php _e('(Show images as links) ', 'andreadb-coin-slider'); ?></span></label>
        <select id="andreadb-coin-slider-links" name="dba_coin_slider_settings[links]">
            <option <?php selected($data['links'], 'false'); ?> value="false"><?php _e('No', 'andreadb-coin-slider'); ?></option>
            <option <?php selected($data['links'], 'true'); ?> value="true"><?php _e('Yes', 'andreadb-coin-slider'); ?></option>
        </select>
        <div class="clear"></div>
    </div>
    <div class="andreadb-coin-slider-field">
        <label><?php _e('Hover pause', 'andreadb-coin-slider'); ?></label>
        <select id="andreadb-coin-slider-hover-pause" name="dba_coin_slider_settings[hover_pause]">
            <option <?php selected($data['hover_pause'], 'false'); ?> value="false"><?php _e('No', 'andreadb-coin-slider'); ?></option>
            <option <?php selected($data['hover_pause'], 'true'); ?> value="true"><?php _e('Yes', 'andreadb-coin-slider'); ?></option>
        </select>
        <div class="clear"></div>
    </div>
</div>