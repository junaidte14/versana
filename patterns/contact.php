<?php
/**
 * Title: Contact
 * Slug: versana/contact
 * Categories: versana-patterns
 * Keywords: contact, 2 columns, simple contact
 * Block Types: core/group
 * Description: A simple way to show contact information.
 */
?>
<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|2xl","bottom":"var:preset|spacing|2xl"}}},"layout":{"type":"constrained","contentSize":"800px"}} -->
<div class="wp-block-group alignwide" style="padding-top:var(--wp--preset--spacing--2-xl);padding-bottom:var(--wp--preset--spacing--2-xl)">

    <!-- wp:heading {"textAlign":"left","fontSize":"4-xl"} -->
    <h2 class="wp-block-heading has-text-align-left has-4-xl-font-size">
        <?php echo esc_html__( 'Get In Touch', 'versana' ); ?>
    </h2>
    <!-- /wp:heading -->

    <!-- wp:paragraph {"align":"left","fontSize":"md"} -->
    <p class="has-text-align-left has-md-font-size">
        <?php echo esc_html__( 'Have a project in mind? We\'d love to hear from you.', 'versana' ); ?>
    </p>
    <!-- /wp:paragraph -->

    <!-- wp:separator {"className":"is-style-wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|xl","bottom":"var:preset|spacing|xl"}}}} -->
    <hr class="wp-block-separator has-alpha-channel-opacity is-style-wide"
        style="margin-top:var(--wp--preset--spacing--xl);margin-bottom:var(--wp--preset--spacing--xl)" />
    <!-- /wp:separator -->

    <!-- wp:columns -->
    <div class="wp-block-columns">

        <!-- wp:column -->
        <div class="wp-block-column">
            <!-- wp:heading {"level":3} -->
            <h3 class="wp-block-heading">
                <?php echo esc_html__( 'Email', 'versana' ); ?>
            </h3>
            <!-- /wp:heading -->

            <!-- wp:paragraph -->
            <p>hello@example.com</p>
            <!-- /wp:paragraph -->
        </div>
        <!-- /wp:column -->

        <!-- wp:column -->
        <div class="wp-block-column">
            <!-- wp:heading {"level":3} -->
            <h3 class="wp-block-heading">
                <?php echo esc_html__( 'Phone', 'versana' ); ?>
            </h3>
            <!-- /wp:heading -->

            <!-- wp:paragraph -->
            <p>+1 (555) 123-4567</p>
            <!-- /wp:paragraph -->
        </div>
        <!-- /wp:column -->

    </div>
    <!-- /wp:columns -->

    <!-- wp:separator {"className":"is-style-wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|xl","bottom":"var:preset|spacing|xl"}}}} -->
    <hr class="wp-block-separator has-alpha-channel-opacity is-style-wide"
        style="margin-top:var(--wp--preset--spacing--xl);margin-bottom:var(--wp--preset--spacing--xl)" />
    <!-- /wp:separator -->

    <!-- wp:paragraph -->
    <p>
        <strong><?php echo esc_html__( 'Note:', 'versana' ); ?></strong>
        <?php echo esc_html__( 'This is a demo contact page. In a real site, you would add a contact form plugin like Contact Form 7 or WPForms.', 'versana' ); ?>
    </p>
    <!-- /wp:paragraph -->

</div>
<!-- /wp:group -->