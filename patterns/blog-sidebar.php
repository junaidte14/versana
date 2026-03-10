<?php
/**
 * Title: Blog Sidebar
 * Slug: versana/blog-sidebar
 * Categories: versana-layout
 */
?>

<!-- wp:group {"align":"full","className":"blog-sidebar","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull blog-sidebar">

    <!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|40","right":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40"}}},"backgroundColor":"neutral-100","layout":{"type":"constrained"}} -->
    <div class="wp-block-group alignwide has-neutral-100-background-color has-background"
        style="padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)">

        <!-- wp:heading {"level":3,"fontSize":"lg"} -->
        <h3 class="wp-block-heading has-lg-font-size">
            <?php echo esc_html__( 'Search', 'versana' ); ?>
        </h3>
        <!-- /wp:heading -->

        <!-- wp:search {"label":"Search","showLabel":false,"placeholder":"<?php echo esc_attr__( 'Search posts...', 'versana' ); ?>","buttonText":"<?php echo esc_attr__( 'Search', 'versana' ); ?>"} /-->

    </div>
    <!-- /wp:group -->

    <!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|40","right":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40"}}},"backgroundColor":"neutral-100","layout":{"type":"constrained"}} -->
    <div class="wp-block-group alignwide has-neutral-100-background-color has-background"
        style="padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)">

        <!-- wp:heading {"level":3,"fontSize":"lg"} -->
        <h3 class="wp-block-heading has-lg-font-size">
            <?php echo esc_html__( 'Categories', 'versana' ); ?>
        </h3>
        <!-- /wp:heading -->

        <!-- wp:categories {"showHierarchy":true,"showPostCounts":true} /-->

    </div>
    <!-- /wp:group -->

    <!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|40","right":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40"}}},"backgroundColor":"neutral-100","layout":{"type":"constrained"}} -->
    <div class="wp-block-group alignwide has-neutral-100-background-color has-background"
        style="padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)">

        <!-- wp:heading {"level":3,"fontSize":"lg"} -->
        <h3 class="wp-block-heading has-lg-font-size">
            <?php echo esc_html__( 'Recent Posts', 'versana' ); ?>
        </h3>
        <!-- /wp:heading -->

        <!-- wp:latest-posts {"displayPostDate":true,"displayFeaturedImage":true} /-->

    </div>
    <!-- /wp:group -->

    <!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|40","right":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40"}}},"backgroundColor":"neutral-100","layout":{"type":"constrained"}} -->
    <div class="wp-block-group alignwide has-neutral-100-background-color has-background"
        style="padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)">

        <!-- wp:heading {"level":3,"fontSize":"lg"} -->
        <h3 class="wp-block-heading has-lg-font-size">
            <?php echo esc_html__( 'Tags', 'versana' ); ?>
        </h3>
        <!-- /wp:heading -->

        <!-- wp:tag-cloud /-->

    </div>
    <!-- /wp:group -->

</div>
<!-- /wp:group -->