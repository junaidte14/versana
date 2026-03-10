<?php
/**
 * Title: Centered Footer
 * Slug: versana/footer-centered
 * Categories: versana-footers
 * Keywords: footer, centered footer
 * Description: A centrally aligned simple footer with copyright information.
 */
?>
<!-- wp:group {"align":"full","className":"site-footer","style":{"spacing":{"margin":{"top":"0"}}},"backgroundColor":"contrast","textColor":"base","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull site-footer has-base-color has-contrast-background-color has-text-color has-background" style="margin-top:0">
    <!-- wp:group {"align":"wide","className":"footer-widgets","layout":{"type":"constrained"}} -->
    <div class="wp-block-group alignwide footer-widgets">
        <!-- wp:group {"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
        <div class="wp-block-group">
            <!-- wp:site-logo {"width":60,"className":"is-style-rounded"} /-->
            <!-- wp:site-title {"textAlign":"center","level":3} /-->
            <!-- wp:paragraph {"align":"center","fontSize":"small"} -->
            <p class="has-text-align-center has-small-font-size"><?php echo esc_html__( 'Building amazing websites with WordPress', 'versana' ); ?></p>
            <!-- /wp:paragraph -->
            <!-- wp:social-links {"className":"is-style-logos-only","layout":{"type":"flex","justifyContent":"center"}} -->
            <ul class="wp-block-social-links is-style-logos-only">
                <!-- wp:social-link {"url":"#","service":"facebook"} /-->
                <!-- wp:social-link {"url":"#","service":"twitter"} /-->
                <!-- wp:social-link {"url":"#","service":"instagram"} /-->
            </ul>
            <!-- /wp:social-links -->
        </div>
        <!-- /wp:group -->    
    </div>
    <!-- /wp:group -->    
    <!-- wp:group {"align":"wide","className":"footer-bottom","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"center"}} -->
    <div class="wp-block-group alignwide footer-bottom">
        <!-- wp:paragraph {"align":"center","className":"footer-copyright","fontSize":"small"} -->
        <p class="has-text-align-center footer-copyright has-small-font-size">
            <?php
                printf(
                    esc_html__( '© %1$s %2$s. All rights reserved.', 'versana' ),
                    date_i18n( 'Y' ),
                    get_bloginfo( 'name' )
                );
            ?>
        </p>
        <!-- /wp:paragraph -->
    </div>
    <!-- /wp:group -->
</div>
<!-- /wp:group -->