<?php
/**
 * Title: Page Layout
 * Slug: versana/page-layout
 * Categories: versana-patterns
 * Keywords: page
 * Description: A standard page layout with before and after action hooks.
 */
?>
<!-- wp:group {"tagName":"main","layout":{"type":"default"}} -->
<main class="wp-block-group versana-content">
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
    <!-- wp:post-title {"level":1,"align":"full","className":"versana-page-title","style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|lg"}}}} /-->
    <!-- wp:post-content {"layout":{"type":"default"}} /-->
    <?php
        /**
         * Extensibility Hook: Add content after main content
         *
         * Allows other plugins to add more content
         *
         * @since 1.0.2
         */
        do_action( 'versana_after_content' );
    ?>
</main>
<!-- /wp:group -->