<?php
/**
 * Title: Call to Action
 * Slug: versana/call-to-action
 * Categories: versana-sections
 * Keywords: cta, call to action, highlight
 * Block Types: core/group
 * Description: A large section to showcase call to action section.
 */
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|2xl","bottom":"var:preset|spacing|2xl","left":"var:preset|spacing|md","right":"var:preset|spacing|md"}}},"gradient":"primary-gradient","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-primary-gradient-gradient-background has-background"
    style="padding-top:var(--wp--preset--spacing--2-xl);padding-right:var(--wp--preset--spacing--md);padding-bottom:var(--wp--preset--spacing--2-xl);padding-left:var(--wp--preset--spacing--md)">
    <!-- wp:group {"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|lg"}},"layout":{"type":"constrained","contentSize":"800px"}} -->
    <div class="wp-block-group alignwide">
        <!-- wp:heading {"textAlign":"center","style":{"typography":{"fontSize":"clamp(2rem, 5vw, 3.5rem)","fontWeight":"800","lineHeight":"1.2"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|md"}}},"textColor":"neutral-100"} -->
        <h2 class="wp-block-heading has-text-align-center has-neutral-100-color has-text-color"
            style="margin-top:0;margin-bottom:var(--wp--preset--spacing--md);font-size:clamp(2rem, 5vw, 3.5rem);font-weight:800;line-height:1.2">
            Start Your Reading Journey Today</h2>
        <!-- /wp:heading -->

        <!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|lg"}}},"textColor":"neutral-100","fontSize":"md"} -->
        <p class="has-text-align-center has-neutral-100-color has-text-color has-md-font-size"
            style="margin-top:0;margin-bottom:var(--wp--preset--spacing--lg)">Subscribe to our newsletter and never
            miss an update. Get exclusive content delivered to your inbox.</p>
        <!-- /wp:paragraph -->

        <!-- wp:buttons {"style":{"spacing":{"margin":{"top":"0"}}},"layout":{"type":"flex","justifyContent":"center"}} -->
        <div class="wp-block-buttons" style="margin-top:0">
            <!-- wp:button {"backgroundColor":"neutral-100","textColor":"primary","style":{"border":{"radius":"8px"},"spacing":{"padding":{"left":"var:preset|spacing|xl","right":"var:preset|spacing|xl","top":"var:preset|spacing|sm","bottom":"var:preset|spacing|sm"}},"typography":{"fontSize":"1.125rem","fontWeight":"600"}}} -->
            <div class="wp-block-button"><a
                    class="wp-block-button__link has-primary-color has-neutral-100-background-color has-text-color has-background has-custom-font-size wp-element-button"
                    style="border-radius:8px;padding-top:var(--wp--preset--spacing--sm);padding-right:var(--wp--preset--spacing--xl);padding-bottom:var(--wp--preset--spacing--sm);padding-left:var(--wp--preset--spacing--xl);font-size:1.125rem;font-weight:600">Subscribe
                    Now</a></div>
            <!-- /wp:button -->
        </div>
        <!-- /wp:buttons -->
    </div>
    <!-- /wp:group -->
</div>
<!-- /wp:group -->