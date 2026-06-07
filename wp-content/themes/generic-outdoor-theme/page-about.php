<?php

get_header();

while (have_posts()) {
    the_post();
    pageBanner();
    ?>
    <div class="container container--narrow page-section">
        <main class="site-main">
            <div class="generic-content">
                <?php the_content(); ?>

                <h2 class="headline headline--medium">Our Mission</h2>
                <p>Our mission is to provide the best outdoor experience possible. We are dedicated to providing our customers
                    with the highest quality products and services. We are committed to helping our customers enjoy the great
                    outdoors.</p>

                <h2 class="headline headline--medium u-mt-xxl">About the Owner</h2>
                <div class="owner-profile owner-profile--responsive">
                    <div class="owner-profile__image-container owner-profile__image-container--medium">
                        <img src="<?php echo get_theme_file_uri('build/images/john-doe.png'); ?>" alt="John Doe - Owner"
                            class="owner-profile__image">
                    </div>
                    <div class="owner-profile__info">
                        <p>
                            <strong>John Doe</strong> is an experienced, certified outdoor expert. With over 30 years of outdoor experience, John
                            hopes to help you with all of your outdoor needs. By using a float-based layout, this text will now wrap naturally around the profile image, filling the space to the right and then flowing underneath the photo if the biography is long enough.
                        </p>
                    </div>
                </div>
            </div>
        </main>
    </div>

<?php }

get_footer();
?>