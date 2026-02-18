<?php
/**
 * Title: Latest Articles
 * Slug: versana/latest-articles
 * Categories: versana-sections
 * Keywords: latest, articles, posts
 * Block Types: core/group
 * Description: A large section to showcase latest articles or blog posts.
 */
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|2xl","bottom":"var:preset|spacing|2xl","left":"var:preset|spacing|md","right":"var:preset|spacing|md"}}},"backgroundColor":"neutral-100","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-neutral-100-background-color has-background"
    style="padding-top:var(--wp--preset--spacing--2-xl);padding-right:var(--wp--preset--spacing--md);padding-bottom:var(--wp--preset--spacing--2-xl);padding-left:var(--wp--preset--spacing--md)">
    <!-- wp:group {"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|md","margin":{"bottom":"var:preset|spacing|xl"}}},"layout":{"type":"constrained","contentSize":"800px"}} -->
    <div class="wp-block-group alignwide" style="margin-bottom:var(--wp--preset--spacing--xl)">
        <!-- wp:heading {"textAlign":"center","style":{"typography":{"fontSize":"clamp(2rem, 4vw, 3rem)","fontWeight":"800","lineHeight":"1.2","letterSpacing":"-0.02em"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|sm"}}}} -->
        <h2 class="wp-block-heading has-text-align-center"
            style="margin-top:0;margin-bottom:var(--wp--preset--spacing--sm);font-size:clamp(2rem, 4vw, 3rem);font-weight:800;letter-spacing:-0.02em;line-height:1.2">
            Latest Articles</h2>
        <!-- /wp:heading -->

        <!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"neutral-700","fontSize":"md"} -->
        <p class="has-text-align-center has-neutral-700-color has-text-color has-md-font-size"
            style="margin-top:0;margin-bottom:0">Explore our most recent posts and stay updated with the latest
            insights.</p>
        <!-- /wp:paragraph -->
    </div>
    <!-- /wp:group -->

    <!-- wp:query {"queryId":1,"query":{"perPage":3,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"align":"wide"} -->
    <div class="wp-block-query alignwide">
        <!-- wp:post-template {"style":{"spacing":{"blockGap":"var:preset|spacing|lg"}},"layout":{"type":"grid","columnCount":3}} -->
        <!-- wp:group {"style":{"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"}},"border":{"radius":"12px","width":"1px","color":"var:preset|color|neutral-300"}},"backgroundColor":"neutral-100","layout":{"type":"constrained"}} -->
        <div class="wp-block-group has-border-color has-neutral-100-background-color has-background"
            style="border-color:var(--wp--preset--color--neutral-300);border-width:1px;border-radius:12px;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0">
            <!-- wp:post-featured-image {"isLink":true,"aspectRatio":"16/9","align":"wide","style":{"spacing":{"margin":{"bottom":"0"}},"border":{"radius":{"topLeft":"12px","topRight":"12px"}}}} /-->

            <!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|md","bottom":"var:preset|spacing|md","left":"var:preset|spacing|md","right":"var:preset|spacing|md"},"blockGap":"var:preset|spacing|sm"}},"layout":{"type":"constrained"}} -->
            <div class="wp-block-group alignwide"
                style="padding-top:var(--wp--preset--spacing--md);padding-right:var(--wp--preset--spacing--md);padding-bottom:var(--wp--preset--spacing--md);padding-left:var(--wp--preset--spacing--md)">
                <!-- wp:post-terms {"term":"category","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|sm"}}}} /-->

                <!-- wp:post-title {"isLink":true,"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|sm"}},"typography":{"fontSize":"1.25rem","fontWeight":"700","lineHeight":"1.3"}}} /-->

                <!-- wp:post-excerpt {"excerptLength":15,"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|sm"}}},"fontSize":"sm"} /-->

                <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|sm"}},"fontSize":"xs","layout":{"type":"flex","flexWrap":"nowrap"}} -->
                <div class="wp-block-group has-xs-font-size">
                    <!-- wp:post-date {"format":"M j, Y","metadata":{"bindings":{"datetime":{"source":"core/post-data","args":{"field":"date"}}}},"textColor":"neutral-700"} /-->

                    <!-- wp:paragraph {"textColor":"neutral-700"} -->
                    <p class="has-neutral-700-color has-text-color">•</p>
                    <!-- /wp:paragraph -->

                    <!-- wp:post-time-to-read {"textColor":"neutral-700"} /-->
                </div>
                <!-- /wp:group -->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:group -->
        <!-- /wp:post-template -->
    </div>
    <!-- /wp:query -->

    <!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|xl"}}},"layout":{"type":"flex","justifyContent":"center"}} -->
    <div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--xl)">
        <!-- wp:button {"style":{"border":{"radius":"8px"}}} -->
        <div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="/blog"
                style="border-radius:8px">View All Posts →</a></div>
        <!-- /wp:button -->
    </div>
    <!-- /wp:buttons -->
</div>
<!-- /wp:group -->