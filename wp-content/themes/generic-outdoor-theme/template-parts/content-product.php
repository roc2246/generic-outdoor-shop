<div class="post-item">
  <li class="product-card__list-item">
    <a class="product-card" href="<?php the_permalink(); ?>">
      <img class="product-card__image" src="<?php the_post_thumbnail_url('') ?>">
      <span class="product-card__name"><?php the_title(); ?></span>
    </a>
  </li>
</div>