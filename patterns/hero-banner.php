<?php
/**
 * Title: Hero Banner
 * Slug: versana/hero-banner
 * Categories: versana-sections
 * Keywords: hero, banner, cover
 * Block Types: core/cover
 * Description: A large hero section with background image and heading.
 */
?>
<!-- wp:cover {"url":"https://picsum.photos/500/300/?blur","dimRatio":40,"minHeight":300,"align":"full","className":"hero-banner"} -->
<div class="wp-block-cover alignfull hero-banner" style="min-height:300px">
    <span class="wp-block-cover__background has-background-dim"></span>
    <img class="wp-block-cover__image-background" src="https://picsum.photos/500/300/?blur" alt="" />
    <div class="wp-block-cover__inner-container">
        <!-- wp:heading {"textAlign":"center","level":1} -->
        <h1 class="has-text-align-center">Welcome to Versana</h1>
        <!-- /wp:heading -->

        <!-- wp:paragraph {"align":"center"} -->
        <p class="has-text-align-center">A beautiful, modern WordPress block theme for creative professionals.</p>
        <!-- /wp:paragraph -->

        <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
        <div class="wp-block-buttons">
            <!-- wp:button {"backgroundColor":"primary","textColor":"background","className":"cta-button"} -->
            <div class="wp-block-button cta-button">
                <a class="wp-block-button__link has-background-color has-primary-background-color">Get Started</a>
            </div>
            <!-- /wp:button -->
        </div>
        <!-- /wp:buttons -->
    </div>
</div>
<!-- /wp:cover -->