<?php
/**
 * Title: Blog Layout
 * Slug: versana/blog-layout
 * Categories: versana-layout
 */
?>

<!-- wp:group {"tagName":"main","className":"blog-archive","layout":{"type":"constrained"}} -->
<main class="wp-block-group blog-archive">

    <!-- wp:group {"align":"wide","className":"blog-archive-group"} -->
    <div class="wp-block-group alignwide blog-archive-group">

        <!-- wp:query {"query":{"inherit":true},"align":"wide"} -->
        <div class="wp-block-query alignwide">

            <!-- wp:post-template -->
                <!-- wp:post-featured-image {"isLink":true,"aspectRatio":"16/9"} /-->
                <!-- wp:group {"className":"post-meta"} -->
                <div class="wp-block-group post-meta">
                <!-- wp:post-terms {"term":"category"} /-->
                <!-- wp:post-date {"isLink":true} /-->
                <!-- wp:post-author-name {"isLink":true} /-->
                </div>
                <!-- wp:post-title {"isLink":true} /-->
                <!-- wp:post-excerpt {"excerptLength":30,"moreText":"<?php echo esc_html__( 'Continue reading →', 'versana' ); ?>"} /-->
            <!-- /wp:post-template -->

            <!-- wp:query-pagination {"layout":{"type":"flex","justifyContent":"center"}} -->
            <!-- wp:query-pagination-previous /-->
            <!-- wp:query-pagination-numbers /-->
            <!-- wp:query-pagination-next /-->
            <!-- /wp:query-pagination -->

        </div>
        <!-- /wp:query -->

        <!-- wp:pattern {"slug":"versana/blog-sidebar"} /-->

    </div>
    <!-- /wp:group -->

</main>
<!-- /wp:group -->