<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       http://theyoricktouch.com
 * @since      1.0.0
 *
 * @package    Api_Post_Creator
 * @subpackage Api_Post_Creator/public/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<?php
    $options = get_option('api-post-creator');
    if($options['post-title']){
        echo('<h4>' . $args['posts-title'] . "hahahah" . '</h4>');
    }
?>

<ul>
    <?php foreach ( $items as $item ){ ?>
        <li><b><?php echo ($item->post_title) ?></b> - <?php echo ($item->post_content) ?> </li>
    <?php } ?>
</ul>