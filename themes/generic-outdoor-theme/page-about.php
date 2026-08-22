<?php

get_header();

while (have_posts()) {
    the_post();
    pageBanner();
    get_template_part('template-parts/content-about');
}

get_footer();
?>