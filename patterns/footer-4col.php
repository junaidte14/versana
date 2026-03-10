<?php
/**
 * Title: 4 Column Footer
 * Slug: versana/footer-4col
 * Categories: versana-footers
 * Keywords: footer, 4 column footer
 * Description: A footer with 4 columns and copyright information.
 */
?>
<!-- wp:group {"align":"full","className":"site-footer","style":{"spacing":{"margin":{"top":"0"}}},"backgroundColor":"contrast","textColor":"base","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull site-footer has-base-color has-contrast-background-color has-text-color has-background" style="margin-top:0">
    <!-- wp:group {"align":"wide","className":"footer-widgets","layout":{"type":"constrained"}} -->
    <div class="wp-block-group alignwide footer-widgets">
        <!-- wp:columns {"align":"wide"} -->
        <div class="wp-block-columns alignwide">
            <!-- wp:column {"width":"35%"} -->
            <div class="wp-block-column" style="flex-basis:35%">
                <!-- wp:site-logo {"width":50} /-->
                <!-- wp:site-title {"level":3,"fontSize":"medium"} /-->
                <!-- wp:paragraph {"fontSize":"small"} -->
                <p class="has-small-font-size"><?php echo esc_html__( 'Your tagline or mission statement goes here. Make it compelling and memorable.', 'versana' ); ?></p>
                <!-- /wp:paragraph -->
            </div>
            <!-- /wp:column -->
            <!-- wp:column -->
            <div class="wp-block-column">
                <!-- wp:heading {"level":3,"fontSize":"medium"} -->
                <h3 class="wp-block-heading has-medium-font-size"><?php echo esc_html__( 'Company', 'versana' ); ?></h3>
                <!-- /wp:heading -->
                <!-- wp:navigation {"overlayMenu":"never","layout":{"type":"flex","orientation":"vertical"}} /-->
            </div>
            <!-- /wp:column -->
            <!-- wp:column -->
            <div class="wp-block-column">
                <!-- wp:heading {"level":3,"fontSize":"medium"} -->
                <h3 class="wp-block-heading has-medium-font-size"><?php echo esc_html__( 'Resources', 'versana' ); ?></h3>
                <!-- /wp:heading -->
                 <!-- wp:navigation {
                    "overlayMenu":"never",
                    "className":"versana-primary-navigation",
                    "ariaLabel":"Versana Menu",
                    "layout":{
                        "type":"flex",
                        "orientation":"vertical"
                    }
                } /-->
            </div>
            <!-- /wp:column -->
            <!-- wp:column -->
            <div class="wp-block-column">
                <!-- wp:heading {"level":3,"fontSize":"medium"} -->
                <h3 class="wp-block-heading has-medium-font-size"><?php echo esc_html__( 'Newsletter', 'versana' ); ?></h3>
                <!-- /wp:heading -->
                <!-- wp:paragraph {"fontSize":"small"} -->
                <p class="has-small-font-size"><?php echo esc_html__( 'Subscribe to our newsletter for updates and tips. Add newsletter form shortcode here.', 'versana' ); ?></p>
                <!-- /wp:paragraph -->
            </div>
            <!-- /wp:column -->
        </div>
        <!-- /wp:columns -->
    </div>
    <!-- /wp:group -->
    <!-- wp:group {"align":"wide","className":"footer-bottom","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between"}} -->
    <div class="wp-block-group alignwide footer-bottom">
        <!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap"}} -->
        <div class="wp-block-group">
            <!-- wp:paragraph {"className":"footer-copyright","fontSize":"small"} -->
            <p class="footer-copyright has-small-font-size">
                <?php
                printf(
                    esc_html__( '© %1$s %2$s. All rights reserved.', 'versana' ),
                    date_i18n( 'Y' ),
                    get_bloginfo( 'name' )
                );
                ?>
            </p>
            <!-- /wp:paragraph -->
            <!-- wp:social-links {"size":"has-small-icon-size","className":"is-style-logos-only"} -->
            <ul class="wp-block-social-links has-small-icon-size is-style-logos-only">
                <!-- wp:social-link {"url":"#","service":"facebook"} /-->
                <!-- wp:social-link {"url":"#","service":"twitter"} /-->
                <!-- wp:social-link {"url":"#","service":"linkedin"} /-->
            </ul>
            <!-- /wp:social-links -->
        </div>
        <!-- /wp:group -->
         <!-- wp:navigation {
            "overlayMenu":"never",
            "className":"versana-primary-navigation",
            "ariaLabel":"Versana Menu",
            "layout":{
                "type":"flex",
                "justifyContent":"right"
            },
            "fontSize":"small"
        } /-->
    </div>
    <!-- /wp:group -->
</div>
<!-- /wp:group -->