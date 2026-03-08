<?php
// Prevent direct access
if (!defined('ABSPATH')) exit;

get_header();
?>

<div class="max-w-[1440px] mx-auto px-6 md:px-20 py-12">

    <?php
    // Display page content (for normal pages)
    while (have_posts()) : the_post();
        the_content();
    endwhile;
    ?>

</div>

<?php
get_footer();