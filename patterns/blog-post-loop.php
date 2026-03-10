<?php
/**
 * Title: Blog Post Loop
 * Slug: versana/blog-post-loop
 * Categories: versana-layout
 */
?>
<!-- wp:group {"tagName":"main","className":"blog-archive","layout":{"type":"constrained"}} -->
<main class="wp-block-group blog-archive">

    <!-- wp:group {"align":"wide","className":"blog-archive-group"} -->
    <div class="wp-block-group alignwide blog-archive-group">

        <!-- wp:query {"queryId":1,"query":{"perPage":12,"postType":"post","order":"desc","orderBy":"date","sticky":"exclude","inherit":true},"align":"wide","layout":{"type":"constrained"}} -->
        <div class="wp-block-query alignwide">

            <!-- wp:post-template {"align":"wide","style":{"spacing":{"blockGap":"0"}}} -->

            <!-- wp:post-featured-image {"isLink":true,"aspectRatio":"16/9","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|0"}}}} /-->

            <!-- wp:group {"className":"post-meta"} -->
            <div class="wp-block-group post-meta">

                <!-- wp:post-terms {"term":"category","style":{"elements":{"link":{"color":{"text":"var:preset|color|neutral-100"}}}}} /-->

                <!-- wp:post-date {"format":"M j, Y","isLink":true,"style":{"typography":{"fontSize":"0.875rem"}}} /-->

                <!-- wp:post-author-name {"isLink":true,"style":{"typography":{"fontSize":"0.875rem"}}} /-->

            </div>
            <!-- /wp:group -->

            <!-- wp:post-title {"isLink":true,"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|30"}}}} /-->

            <!-- wp:post-excerpt {"moreText":"<?php echo esc_html__( 'Continue reading →', 'versana' ); ?>","excerptLength":30} /-->

            <!-- /wp:post-template -->

            <!-- wp:query-pagination {"paginationArrow":"arrow","layout":{"type":"flex","justifyContent":"center"}} -->
            <!-- wp:query-pagination-previous /-->
            <!-- wp:query-pagination-numbers /-->
            <!-- wp:query-pagination-next /-->
            <!-- /wp:query-pagination -->

            <!-- wp:query-no-results -->

            <!-- wp:heading {"textAlign":"center"} -->
            <h2 class="has-text-align-center">
                <?php echo esc_html__( 'Nothing found.', 'versana' ); ?>
            </h2>
            <!-- /wp:heading -->

            <!-- wp:paragraph {"align":"center"} -->
            <p class="has-text-align-center">
                <?php echo esc_html__( 'Try refining your search or explore other content.', 'versana' ); ?>
            </p>
            <!-- /wp:paragraph -->

            <!-- /wp:query-no-results -->

        </div>
        <!-- /wp:query -->

        <!-- wp:pattern {"slug":"versana/blog-sidebar"} /-->

    </div>
    <!-- /wp:group -->

</main>
<!-- /wp:group -->