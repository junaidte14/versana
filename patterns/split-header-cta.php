<?php
/**
 * Title: Split Header with CTA
 * Slug: versana/split-header-cta
 * Categories: versana-headers
 * Keywords: header, navigation, split, cta, call to action
 * Description: Premium split layout header with prominent call-to-action and contact information
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"},"margin":{"top":"0","bottom":"0"}}},"className":"versana-split-header site-header","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull versana-split-header site-header" style="margin-top:0;margin-bottom:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0">
    
    <!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|xs","bottom":"var:preset|spacing|xs","left":"var:preset|spacing|md","right":"var:preset|spacing|md"}}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between","verticalAlignment":"center"}} -->
    <div class="wp-block-group alignwide" style="padding-top:var(--wp--preset--spacing--xs);padding-right:var(--wp--preset--spacing--md);padding-bottom:var(--wp--preset--spacing--xs);padding-left:var(--wp--preset--spacing--md)">
        
        <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|lg"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
        <div class="wp-block-group">
            <!-- wp:paragraph {"fontSize":"sm"} -->
            <p class="has-sm-font-size">📧 <a href="mailto:hello@example.com"><?php echo esc_html__( 'hello@example.com', 'versana' ); ?></a></p>
            <!-- /wp:paragraph -->

            <!-- wp:paragraph {"fontSize":"sm"} -->
            <p class="has-sm-font-size">📞 <a href="tel:+15551234567"><?php echo esc_html__( '(555) 123-4567', 'versana' ); ?></a></p>
            <!-- /wp:paragraph -->
        </div>
        <!-- /wp:group -->

        <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|md"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
        <div class="wp-block-group">
            <!-- wp:social-links {"size":"has-small-icon-size","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|sm","left":"var:preset|spacing|sm"}}},"className":"is-style-logos-only"} -->
            <ul class="wp-block-social-links has-small-icon-size is-style-logos-only">
                <!-- wp:social-link {"url":"#","service":"facebook"} /-->
                <!-- wp:social-link {"url":"#","service":"twitter"} /-->
                <!-- wp:social-link {"url":"#","service":"linkedin"} /-->
                <!-- wp:social-link {"url":"#","service":"instagram"} /-->
            </ul>
            <!-- /wp:social-links -->
        </div>
        <!-- /wp:group -->
    </div>
    <!-- /wp:group -->

    <!-- wp:separator {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"className":"is-style-wide"} -->
    <hr class="wp-block-separator has-alpha-channel-opacity is-style-wide" style="margin-top:0;margin-bottom:0"/>
    <!-- /wp:separator -->

    <!-- wp:group {"align":"wide","style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"var:preset|spacing|xs","bottom":"var:preset|spacing|xs","left":"var:preset|spacing|md","right":"var:preset|spacing|md"}}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between","verticalAlignment":"center"}} -->
    <div class="wp-block-group alignwide" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--xs);padding-right:var(--wp--preset--spacing--md);padding-bottom:var(--wp--preset--spacing--xs);padding-left:var(--wp--preset--spacing--md)">
        
        <!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
        <div class="wp-block-group">
            <!-- wp:site-logo {"width":60} /-->
            <!-- wp:site-title {"level":0} /-->
        </div>
        <!-- /wp:group -->

        <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|2xl"}},"className":"versana-split-nav","layout":{"type":"flex","flexWrap":"nowrap"}} -->
        <div class="wp-block-group versana-split-nav">
            <!-- wp:navigation {
                "overlayMenu":"mobile",
                "className":"versana-primary-navigation",
                "ariaLabel":"Versana Menu",
                "layout":{
                    "type":"flex",
                    "justifyContent":"center"
                }
            } /-->
        </div>
        <!-- /wp:group -->

        <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|md"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
        <div class="wp-block-group">
            <!-- wp:buttons -->
            <div class="wp-block-buttons">
                <!-- wp:button {"style":{"border":{"radius":"50px"},"spacing":{"padding":{"top":"var:preset|spacing|sm","bottom":"var:preset|spacing|sm","left":"var:preset|spacing|md","right":"var:preset|spacing|md"}}}} -->
                <div class="wp-block-button"><a class="wp-block-button__link wp-element-button" style="border-radius:50px;padding-top:var(--wp--preset--spacing--sm);padding-right:var(--wp--preset--spacing--md);padding-bottom:var(--wp--preset--spacing--sm);padding-left:var(--wp--preset--spacing--md)"><?php echo esc_html__( 'Get Started Free', 'versana' ); ?></a></div>
                <!-- /wp:button -->
            </div>
            <!-- /wp:buttons -->
        </div>
        <!-- /wp:group -->
    </div>
    <!-- /wp:group -->
</div>
<!-- /wp:group -->