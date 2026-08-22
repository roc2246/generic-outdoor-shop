<?php
/**
 * Shared About page content partial.
 */
?>
<div class="container container--narrow page-section">
  <main class="site-main">
    <div class="generic-content">
      <?php the_content(); ?>

      <h2 class="headline headline--medium"><?php esc_html_e('Our Mission', 'generic-outdoor-theme'); ?></h2>
      <p><?php esc_html_e('Our mission is to provide the best outdoor experience possible. We are dedicated to providing our customers with the highest quality products and services. We are committed to helping our customers enjoy the great outdoors.', 'generic-outdoor-theme'); ?></p>

      <h2 class="headline headline--medium u-mt-xxl"><?php esc_html_e('About the Owner', 'generic-outdoor-theme'); ?></h2>
      <div class="owner-profile owner-profile--responsive">
        <div class="owner-profile__image-container owner-profile__image-container--medium">
          <img src="<?php echo esc_url(get_theme_file_uri('build/images/john-doe.png')); ?>" alt="<?php echo esc_attr__('John Doe - Owner', 'generic-outdoor-theme'); ?>"
            class="owner-profile__image">
        </div>
        <div class="owner-profile__info">
          <p>
            <strong><?php echo esc_html__('John Doe', 'generic-outdoor-theme'); ?></strong>
            <?php esc_html_e('is an experienced, certified outdoor expert. With over 30 years of outdoor experience, John hopes to help you with all of your outdoor needs.', 'generic-outdoor-theme'); ?>
          </p>
        </div>
      </div>
    </div>
  </main>
</div>
