<?php
/**
 * Title: FAQ Section
 * Slug: versana/faq-section
 * Categories: versana-patterns
 * Keywords: faq, questions, answers, help, support
 * Block Types: core/group
 * Description: Frequently asked questions section using details/summary blocks.
 */
?>
<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|4xl","bottom":"var:preset|spacing|4xl"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained","contentSize":"800px"}} -->
<div class="wp-block-group alignwide" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--4-xl);padding-bottom:var(--wp--preset--spacing--4-xl)">

    <!-- wp:heading {"textAlign":"center","fontSize":"4-xl"} -->
    <h2 class="wp-block-heading has-text-align-center has-4-xl-font-size">
        <?php echo esc_html__( 'Frequently Asked Questions', 'versana' ); ?>
    </h2>
    <!-- /wp:heading -->

    <!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"top":"var:preset|spacing|sm","bottom":"var:preset|spacing|2xl"}}},"fontSize":"lg"} -->
    <p class="has-text-align-center has-lg-font-size" style="margin-top:var(--wp--preset--spacing--sm);margin-bottom:var(--wp--preset--spacing--2-xl)">
        <?php echo esc_html__( 'Everything you need to know', 'versana' ); ?>
    </p>
    <!-- /wp:paragraph -->

    <?php
    $faqs = [
        [
            'q' => 'What makes your service different from competitors?',
            'a' => 'We focus on three key differentiators: lightning-fast performance, beautiful design out of the box, and exceptional customer support. Our platform is built with modern technologies and best practices, ensuring your site is not only functional but also future-proof.',
        ],
        [
            'q' => 'Do you offer a free trial?',
            'a' => 'Yes! We offer a 14-day free trial with full access to all features. No credit card required to start. If you\'re not completely satisfied, you can cancel anytime during the trial period.',
        ],
        [
            'q' => 'How long does it take to set up?',
            'a' => 'Most users are up and running within minutes. Our one-click demo import feature allows you to have a fully functional website immediately. You can then customize it to match your brand and content needs.',
        ],
        [
            'q' => 'Can I upgrade or downgrade my plan later?',
            'a' => 'Absolutely! You can change your plan at any time. Upgrades take effect immediately, and for downgrades, the change will occur at the end of your current billing cycle. There are no penalties for changing plans.',
        ],
        [
            'q' => 'What kind of support do you provide?',
            'a' => 'We offer email support for all plans, with priority support for Professional and Enterprise customers. Our support team typically responds within 24 hours, and we maintain extensive documentation and video tutorials for self-service help.',
        ],
        [
            'q' => 'Is my data secure?',
            'a' => 'Security is our top priority. We use industry-standard encryption, regular security audits, automated backups, and comply with all major data protection regulations. Your data is stored securely and is never shared with third parties.',
        ],
    ];

    foreach ( $faqs as $faq ) :
    ?>
        <!-- wp:details {"showContent":false,"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|md"}}}} -->
        <details class="wp-block-details" style="margin-bottom:var(--wp--preset--spacing--md)">
            <summary><strong><?php echo esc_html__( $faq['q'], 'versana' ); ?></strong></summary>

            <!-- wp:paragraph -->
            <p style="margin-top:var(--wp--preset--spacing--sm)">
                <?php echo esc_html__( $faq['a'], 'versana' ); ?>
            </p>
            <!-- /wp:paragraph -->
        </details>
        <!-- /wp:details -->
    <?php endforeach; ?>

    <!-- wp:separator {"style":{"spacing":{"margin":{"top":"var:preset|spacing|xl","bottom":"var:preset|spacing|xl"}}},"className":"is-style-wide"} -->
    <hr class="wp-block-separator has-alpha-channel-opacity is-style-wide" style="margin-top:var(--wp--preset--spacing--xl);margin-bottom:var(--wp--preset--spacing--xl)"/>
    <!-- /wp:separator -->

    <!-- wp:paragraph {"align":"center"} -->
    <p class="has-text-align-center">
        <strong><?php echo esc_html__( 'Still have questions?', 'versana' ); ?></strong>
        <?php echo esc_html__( 'We\'re here to help.', 'versana' ); ?>
        <a href="#"><?php echo esc_html__( 'Contact our support team', 'versana' ); ?></a>
    </p>
    <!-- /wp:paragraph -->

</div>
<!-- /wp:group -->