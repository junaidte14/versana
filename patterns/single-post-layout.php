<?php
/**
 * Title: Single Post Layout
 * Slug: versana/single-post-layout
 * Categories: versana-layout
 * Keywords: single, blog, post
 * Description: Single blog post layout with sidebar.
 */
?>
<!-- wp:group {"tagName":"main","className":"blog-archive","style":{"spacing":{"padding":{"top":"var:preset|spacing|xl","bottom":"var:preset|spacing|xl"}}},"layout":{"type":"constrained"}} -->
<main class="wp-block-group blog-archive" style="padding-top:var(--wp--preset--spacing--xl);padding-bottom:var(--wp--preset--spacing--xl)">

    <!-- wp:group {"align":"wide","className":"blog-archive-group"} -->
    <div class="wp-block-group alignwide blog-archive-group">
        
        <!-- wp:group {"align":"wide","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|lg"}}},"layout":{"type":"constrained"}} -->
        <div class="wp-block-group alignwide versana-content" style="margin-bottom:var(--wp--preset--spacing--lg)">
            <?php
                /**
                 * Extensibility Hook: Add content before main content
                 *
                 * Allows other plugins to add more content
                 *
                 * @since 1.0.2
                 */
                do_action( 'versana_before_content' );
            ?>

            <!-- wp:post-featured-image {"align":"wide","aspectRatio":"16/9","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|lg"}},"border":{"radius":"12px"}}} /-->

            <!-- wp:group {"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|sm"}},"layout":{"type":"constrained"}} -->
            <div class="wp-block-group alignwide">

                <!-- wp:group {"align":"wide","className":"post-meta","style":{"spacing":{"blockGap":"var:preset|spacing|sm","margin":{"bottom":"var:preset|spacing|md"}}},"layout":{"type":"flex","flexWrap":"wrap"}} -->
                <div class="wp-block-group post-meta alignwide" style="margin-bottom:var(--wp--preset--spacing--md)">

                    <!-- wp:post-terms {"term":"category","style":{"elements":{"link":{"color":{"text":"var:preset|color|neutral-100"}}}}} /-->

                    <!-- wp:post-date {"format":"F j, Y","isLink":false,"style":{"elements":{"link":{"color":{"text":"var:preset|color|neutral-700"}}},"typography":{"fontSize":"0.875rem"}}} /-->

                    <!-- wp:post-author-name {"isLink":true,"style":{"elements":{"link":{"color":{"text":"var:preset|color|neutral-700"}}},"typography":{"fontSize":"0.875rem"}}} /-->

                    <!-- wp:post-time-to-read {"style":{"typography":{"fontSize":"0.875rem"},"elements":{"link":{"color":{"text":"var:preset|color|neutral-700"}}}}} /-->

                </div>
                <!-- /wp:group -->

                <!-- wp:post-title {"align":"wide","level":1,"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|md"}}}} /-->

                <!-- wp:post-content {"align":"full","layout":{"type":"default"}} /-->

                <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|sm"}},"align":"wide","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between"}} -->
                <div class="wp-block-group alignwide">

                    <!-- wp:heading {"level":3,"fontSize":"lg"} -->
                    <h3 class="wp-block-heading has-lg-font-size">
                        <?php echo esc_html__( 'Tags', 'versana' ); ?>
                    </h3>
                    <!-- /wp:heading -->

                    <!-- wp:post-terms {"term":"post_tag","separator":"  "} /-->

                </div>
                <!-- /wp:group -->

                <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|sm"}},"align":"wide","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between"}} -->
                <div class="wp-block-group alignwide single-post-navigations">

                    <!-- wp:post-navigation-link {"type":"previous","showTitle":false,"linkLabel":true,"arrow":"arrow"} /-->

                    <!-- wp:post-navigation-link {"showTitle":true,"linkLabel":false,"arrow":"arrow"} /-->

                </div>
                <!-- /wp:group -->

                <!-- wp:post-author-biography {"align":"full","showHeading":true,"layout":{"type":"default"}} /-->

                <?php
                    /**
                     * Extensibility Hook: Add content before main content
                     *
                     * Allows other plugins to add more content
                     *
                     * @since 1.0.2
                     */
                    do_action( 'versana_after_content' );
                ?>

                <!-- wp:comments -->
                <div class="wp-block-comments">

                    <!-- wp:comments-title /-->

                    <!-- wp:comment-template -->
                    <!-- wp:columns -->
                    <div class="wp-block-columns">

                        <!-- wp:column {"width":"40px"} -->
                        <div class="wp-block-column" style="flex-basis:40px">
                            <!-- wp:avatar {"size":40} /-->
                        </div>
                        <!-- /wp:column -->

                        <!-- wp:column -->
                        <div class="wp-block-column">

                            <!-- wp:comment-author-name /-->

                            <!-- wp:group {"style":{"spacing":{"blockGap":"0.5em"}},"layout":{"type":"flex"}} -->
                            <div class="wp-block-group">
                                <!-- wp:comment-date /-->
                                <!-- wp:comment-edit-link /-->
                            </div>
                            <!-- /wp:group -->

                            <!-- wp:comment-content /-->

                            <!-- wp:comment-reply-link /-->

                        </div>
                        <!-- /wp:column -->

                    </div>
                    <!-- /wp:columns -->
                    <!-- /wp:comment-template -->

                    <!-- wp:comments-pagination -->
                    <!-- wp:comments-pagination-previous /-->
                    <!-- wp:comments-pagination-numbers /-->
                    <!-- wp:comments-pagination-next /-->
                    <!-- /wp:comments-pagination -->

                    <!-- wp:post-comments-form /-->

                </div>
                <!-- /wp:comments -->

            </div>
            <!-- /wp:group -->

        </div>
        <!-- /wp:group -->

        <!-- wp:pattern {"slug":"versana/blog-sidebar"} /-->

    </div>
    <!-- /wp:group -->

</main>
<!-- /wp:group -->