<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://theyoricktouch.com
 * @since      1.0.0
 *
 * @package    Api_Post_Creator
 * @subpackage Api_Post_Creator/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<div class="wrap">
 
    <h2><?php echo esc_html(get_admin_page_title()); ?></h2>
    
    <form method="post" name="api_post_creator_options" action="options.php">
        <?php
            //Grab all options
            $options = get_option($this->plugin_name);
    
            // Title quote
            $post_title = $options['post-title'];

        ?>
        <?php
            settings_fields($this->plugin_name);
            do_settings_sections($this->plugin_name);
        ?>
    
        <!-- Optional title for api posts list -->
        <fieldset>
            <legend class="screen-reader-text"><span>Include title in posts list.</span></legend>
            <label for="<?php echo $this->plugin_name; ?>-post-title">
                <input type="checkbox" id="<?php echo $this->plugin_name; ?>-post-title" name="<?php echo $this->plugin_name; ?>[post-title]" value="1" <?php checked($post_title, 1); ?>/>
                <span><?php esc_attr_e('Include title in posts list?', $this->plugin_name); ?></span>
            </label>
        </fieldset>
    
        <?php submit_button('Save all changes', 'primary','submit', TRUE); ?>
    
    </form>
 
</div>
