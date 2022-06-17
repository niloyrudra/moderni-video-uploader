<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://niloyrudra.com/
 * @since      1.0.0
 *
 * @package    Moderni_Form
 * @subpackage Moderni_Form/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<div class="wrap mvf-wrap">
    <h3 style="font-family: fantasy;font-size:42px !important;line-height:1.5;letter-spacing: 1px;">
        <?php echo get_admin_page_title(); ?>
    </h3>

    <?php settings_errors(); ?>

    <div id="poststuff">
        <div id="post-body" class="metabox-holder columns-2 mvf-clearfix">
            <div id="post-body-content" class="mvf-tabs-wrapper">
                <?php //$this->plugin_options_tabs(); ?>
                <div class="meta-box-sortables ui-sortable">
                    <div class="postbox">
                        <div class="inside">

                            <form method="post" action="options.php">
                                <?php wp_nonce_field( 'mvf_update_options', '_wpnonce_mvf_update_options' ); ?>
                                <?php settings_fields( 'mvf_customize' ); ?>
                                <?php //do_settings_fields( 'mvf-settings' ); ?>
                                <?php do_settings_sections( 'mvf-settings' ); ?>

                                <p class="submit">
                                    <?php submit_button('', 'primary mvf-button-primary', 'mvf_update_options', false); ?>
                                </p>
                            </form>
                                                                                            
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>