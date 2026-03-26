<?php
/**
 * Title: Page Layout
 * Slug: versana/page-layout
 * Categories: versana-patterns
 * Keywords: page
 * Description: A standard page layout with before and after action hooks.
 */
?>
<!-- wp:group {"tagName":"main","layout":{"type":"constrained"}} -->
<main class="wp-block-group versana-content">

    <?php do_action( 'versana_before_content' ); ?>

    <!-- wp:group {"align":"wide","layout":{"type":"constrained"}} -->
    <div class="wp-block-group alignwide">
        <!-- wp:post-title {"level":1,"align":"wide","className":"versana-page-title"} /-->
        <!-- wp:post-content {"align":"wide","layout":{"type":"default"}} /-->
    </div>
    <!-- /wp:group -->

    <?php do_action( 'versana_after_content' ); ?>

</main>
<!-- /wp:group -->