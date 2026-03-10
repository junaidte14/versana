<?php
/**
 * Title: Footer
 * Slug: versana/footer
 * Categories: versana-footers
 * Keywords: footer
 * Description: A simple 3 columns footer with copyright information.
 */
?>
<!-- wp:group {"align":"full","className":"site-footer","style":{"spacing":{"margin":{"top":"0"}}},"backgroundColor":"contrast","textColor":"base","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull site-footer has-base-color has-contrast-background-color has-text-color has-background" style="margin-top:0">
    
    <!-- wp:group {"align":"wide","className":"footer-widgets","layout":{"type":"constrained"}} -->
    <div class="wp-block-group alignwide footer-widgets">
        <!-- wp:columns {"align":"wide"} -->
        <div class="wp-block-columns alignwide">
            
            <!-- wp:column -->
            <div class="wp-block-column">
                <!-- wp:heading {"level":3,"fontSize":"medium"} -->
                <h3 class="wp-block-heading has-medium-font-size"><?php echo esc_html__( 'About', 'versana' ); ?></h3>
                <!-- /wp:heading -->
                
                <!-- wp:paragraph {"fontSize":"small"} -->
                <p class="has-small-font-size"><?php echo esc_html__( 'A brief description of your website or company. This helps visitors understand what you do and why they should care.', 'versana' ); ?></p>
                <!-- /wp:paragraph -->
                
                <!-- wp:social-links {"className":"is-style-logos-only"} -->
                <ul class="wp-block-social-links is-style-logos-only">
                    <!-- wp:social-link {"url":"#","service":"facebook"} /-->
                    <!-- wp:social-link {"url":"#","service":"twitter"} /-->
                    <!-- wp:social-link {"url":"#","service":"instagram"} /-->
                    <!-- wp:social-link {"url":"#","service":"linkedin"} /-->
                </ul>
                <!-- /wp:social-links -->
            </div>
            <!-- /wp:column -->
            
            <!-- wp:column -->
            <div class="wp-block-column">
                <!-- wp:heading {"level":3,"fontSize":"medium"} -->
                <h3 class="wp-block-heading has-medium-font-size"><?php echo esc_html__( 'Quick Links', 'versana' ); ?></h3>
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
                <h3 class="wp-block-heading has-medium-font-size"><?php echo esc_html__( 'Contact', 'versana' ); ?></h3>
                <!-- /wp:heading -->
                <!-- wp:paragraph {"fontSize":"small"} -->
                <p class="has-small-font-size"><?php echo esc_html__( '📧 info@example.com', 'versana' ); ?><br><?php echo esc_html__( '📞 (555) 123-4567', 'versana' ); ?><br><?php echo esc_html__( '📍 123 Main St, City, State', 'versana' ); ?></p>
                <!-- /wp:paragraph -->
            </div>
            <!-- /wp:column -->
        </div>
        <!-- /wp:columns -->   
    </div>
    <!-- /wp:group -->
    
    <!-- wp:group {"align":"wide","className":"footer-bottom","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between"}} -->
    <div class="wp-block-group alignwide footer-bottom">
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