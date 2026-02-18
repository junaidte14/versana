<?php
/**
 * Title: Hero Banner
 * Slug: versana/hero-banner
 * Categories: versana-sections
 * Keywords: hero, banner, cover
 * Block Types: core/cover
 * Description: A large hero section with primary gradient, heading, paragraph and CTA buttons.
 */
?>
<!-- wp:cover {"url":"","isUserOverlayColor":true,"minHeight":85,"minHeightUnit":"vh","gradient":"primary-gradient","contentPosition":"center center","isDark":false,"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|2xl","bottom":"var:preset|spacing|2xl","left":"var:preset|spacing|md","right":"var:preset|spacing|md"}}},"layout":{"type":"default"}} -->
<div class="wp-block-cover alignfull is-light"
    style="padding-top:var(--wp--preset--spacing--2-xl);padding-right:var(--wp--preset--spacing--md);padding-bottom:var(--wp--preset--spacing--2-xl);padding-left:var(--wp--preset--spacing--md);min-height:85vh">
    <span aria-hidden="true"
        class="wp-block-cover__background has-background-dim-100 has-background-dim has-background-gradient has-primary-gradient-gradient-background"></span>
    <div class="wp-block-cover__inner-container">
        <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|lg"}},"layout":{"type":"constrained","contentSize":"900px"}} -->
        <div class="wp-block-group">
            <!-- wp:heading {"textAlign":"center","level":1,"style":{"typography":{"fontSize":"clamp(2.5rem, 8vw, 5rem)","fontWeight":"800","lineHeight":"1.1","letterSpacing":"-0.02em"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|md"}}},"textColor":"neutral-100"} -->
            <h1 class="wp-block-heading has-text-align-center has-neutral-100-color has-text-color"
                style="margin-top:0;margin-bottom:var(--wp--preset--spacing--md);font-size:clamp(2.5rem, 8vw, 5rem);font-weight:800;letter-spacing:-0.02em;line-height:1.1">
                Your Story Starts Here</h1>
            <!-- /wp:heading -->

            <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"clamp(1.125rem, 2.5vw, 1.5rem)","lineHeight":"1.6"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|lg"}}},"textColor":"neutral-100"} -->
            <p class="has-text-align-center has-neutral-100-color has-text-color"
                style="margin-top:0;margin-bottom:var(--wp--preset--spacing--lg);font-size:clamp(1.125rem, 2.5vw, 1.5rem);line-height:1.6">
                Discover insightful articles, expert tutorials, and inspiring stories. Join our community of
                passionate readers and writers.</p>
            <!-- /wp:paragraph -->

            <!-- wp:buttons {"style":{"spacing":{"margin":{"top":"0"}}},"layout":{"type":"flex","justifyContent":"center"}} -->
            <div class="wp-block-buttons" style="margin-top:0">
                <!-- wp:button {"backgroundColor":"neutral-100","textColor":"primary","className":"is-style-fill","style":{"border":{"radius":"50px"},"spacing":{"padding":{"left":"var:preset|spacing|xl","right":"var:preset|spacing|xl","top":"var:preset|spacing|sm","bottom":"var:preset|spacing|sm"}},"typography":{"fontSize":"1.125rem","fontWeight":"600"}}} -->
                <div class="wp-block-button is-style-fill"><a
                        class="wp-block-button__link has-primary-color has-neutral-100-background-color has-text-color has-background has-custom-font-size wp-element-button"
                        style="border-radius:50px;padding-top:var(--wp--preset--spacing--sm);padding-right:var(--wp--preset--spacing--xl);padding-bottom:var(--wp--preset--spacing--sm);padding-left:var(--wp--preset--spacing--xl);font-size:1.125rem;font-weight:600">Start
                        Reading</a></div>
                <!-- /wp:button -->

                <!-- wp:button {"backgroundColor":"transparent","textColor":"neutral-100","className":"is-style-outline","style":{"border":{"radius":"50px","width":"2px","color":"var:preset|color|neutral-100"},"spacing":{"padding":{"left":"var:preset|spacing|xl","right":"var:preset|spacing|xl","top":"var:preset|spacing|sm","bottom":"var:preset|spacing|sm"}},"typography":{"fontSize":"1.125rem","fontWeight":"600"}}} -->
                <div class="wp-block-button is-style-outline"><a
                        class="wp-block-button__link has-neutral-100-color has-transparent-background-color has-text-color has-background has-border-color has-custom-font-size wp-element-button"
                        style="border-color:var(--wp--preset--color--neutral-100);border-width:2px;border-radius:50px;padding-top:var(--wp--preset--spacing--sm);padding-right:var(--wp--preset--spacing--xl);padding-bottom:var(--wp--preset--spacing--sm);padding-left:var(--wp--preset--spacing--xl);font-size:1.125rem;font-weight:600">Learn
                        More</a></div>
                <!-- /wp:button -->
            </div>
            <!-- /wp:buttons -->
        </div>
        <!-- /wp:group -->
    </div>
</div>
<!-- /wp:cover -->