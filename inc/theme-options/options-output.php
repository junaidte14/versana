<?php
/**
 * Versana Theme Options Frontend Output
 *
 * Outputs theme option values to the frontend.
 *
 * @package Versana
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Output custom CSS to head
 */
function versana_output_custom_css() {
    $custom_css = versana_get_option( 'custom_css' );
    
    if ( empty( $custom_css ) ) {
        return;
    }
    
    ?>
    <style id="versana-custom-css" type="text/css">
        <?php echo wp_strip_all_tags( $custom_css ); ?>
    </style>
    <?php
}
add_action( 'wp_head', 'versana_output_custom_css', 99 );

/**
 * Output Google Analytics tracking code
 */
function versana_output_google_analytics() {
    $analytics_id = versana_get_option( 'google_analytics_id' );
    
    if ( empty( $analytics_id ) || ! versana_validate_analytics_id( $analytics_id ) ) {
        return;
    }
    
    // Google Analytics 4 (G-XXXXXXXXXX)
    if ( strpos( $analytics_id, 'G-' ) === 0 ) {
        ?>
        <!-- Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo esc_attr( $analytics_id ); ?>"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', '<?php echo esc_js( $analytics_id ); ?>');
        </script>
        <?php
    }
    // Universal Analytics (UA-XXXXXXX-X)
    else {
        ?>
        <!-- Google Analytics -->
        <script async src="https://www.googletagmanager.com/analytics.js"></script>
        <script>
            window.ga=window.ga||function(){(ga.q=ga.q||[]).push(arguments)};ga.l=+new Date;
            ga('create', '<?php echo esc_js( $analytics_id ); ?>', 'auto');
            ga('send', 'pageview');
        </script>
        <?php
    }
}
add_action( 'wp_head', 'versana_output_google_analytics', 10 );

/**
 * Output Google Tag Manager head code
 */
function versana_output_gtm_head() {
    $gtm_id = versana_get_option( 'google_tag_manager_id' );
    
    if ( empty( $gtm_id ) ) {
        return;
    }
    
    ?>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','<?php echo esc_js( $gtm_id ); ?>');</script>
    <!-- End Google Tag Manager -->
    <?php
}
add_action( 'wp_head', 'versana_output_gtm_head', 5 );

/**
 * Output Google Tag Manager body code
 */
function versana_output_gtm_body() {
    $gtm_id = versana_get_option( 'google_tag_manager_id' );
    if ( empty( $gtm_id ) ) {
        return;
    }
    // Prepare the URL safely
    $gtm_url = add_query_arg( 'id', $gtm_id, 'https://www.googletagmanager.com/ns.html' );
    ?>
    <noscript><iframe src="<?php echo esc_url( $gtm_url ); ?>"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <?php
}
add_action( 'wp_body_open', 'versana_output_gtm_body' );

/**
 * Output Facebook Pixel code
 */
function versana_output_facebook_pixel() {
    $pixel_id = versana_get_option( 'facebook_pixel_id' );
    
    if ( empty( $pixel_id ) ) {
        return;
    }
    
    ?>
    <!-- Facebook Pixel Code -->
    <script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window, document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '<?php echo esc_js( $pixel_id ); ?>');
    fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
    src="https://www.facebook.com/tr?id=<?php echo esc_attr( $pixel_id ); ?>&ev=PageView&noscript=1"
    /></noscript>
    <!-- End Facebook Pixel Code -->
    <?php
}
add_action( 'wp_head', 'versana_output_facebook_pixel', 10 );

/**
 * Output header scripts
 */
function versana_output_header_scripts() {
    $header_scripts = versana_get_option( 'header_scripts' );
    
    if ( empty( $header_scripts ) ) {
        return;
    }
    
    echo $header_scripts;
}
add_action( 'wp_head', 'versana_output_header_scripts', 100 );

/**
 * Output footer scripts
 */
function versana_output_footer_scripts() {
    $footer_scripts = versana_get_option( 'footer_scripts' );
    
    if ( empty( $footer_scripts ) ) {
        return;
    }
    
    echo $footer_scripts;
}
add_action( 'wp_footer', 'versana_output_footer_scripts', 100 );