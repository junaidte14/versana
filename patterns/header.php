<?php
/**
 * Title: Header
 * Slug: versana/header
 * Categories: versana-headers
 * Keywords: header
 * Description: A default header with logo on the left side and navigation menu on the right side.
 */
?>
<!-- wp:group {"align":"full","className":"site-header","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull site-header" style="padding-top:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50)">
    <!-- wp:group {"align":"wide","layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
    <div class="wp-block-group alignwide">
        <!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap"}} -->
        <div class="wp-block-group">
            <!-- wp:site-logo {"width":60} /-->
            <!-- wp:site-title {"level":0} /-->
        </div>
        <!-- /wp:group -->
        <!-- wp:navigation {
            "overlayMenu":"mobile",
            "className":"versana-primary-navigation",
            "ariaLabel":"Versana Menu",
            "layout":{
                "type":"flex",
                "justifyContent":"center"
            }
        } /-->
    </div>
    <!-- /wp:group -->
</div>
<!-- /wp:group -->