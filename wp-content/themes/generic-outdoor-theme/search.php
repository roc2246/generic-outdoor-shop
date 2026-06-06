<?php

get_header();
pageBanner(array(
  'title' => 'Search Results',
  'subtitle' => 'You searched for &ldquo;' . esc_html(get_search_query(false)) . '&rdquo;'
));
?>

<main class="site-main">
<div class="container container--narrow page-section">
  <?php
  get_search_form();


  if (have_posts()) {
    echo '<br>';
    while (have_posts()) {
      the_post();
      get_template_part('template-parts/content', get_post_type());
    }
    echo paginate_links();
  } else {
    echo '<br><h2 class="headline headline--small-plus">No results match that search.</h2>';
  }
  ?>

</div>
</main>

<?php get_footer();

?>