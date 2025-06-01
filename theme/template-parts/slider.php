<?php
global $post;
$sliders = get_posts(array(
  'post_type' => 'slider',
  'posts_per_page' => -1
));
?>

<?php if ($sliders): ?>
  <div class="c-slider">
    <div class="l-container py-2">

      <div class="carousel w-full">
        <?php $i = 1; ?>
        <?php foreach ($sliders as $post):
          setup_postdata($post); ?>
          <div id="item<?= $i ?>" class="carousel-item w-full relative">
            <img src="<?php the_post_thumbnail_url('wooprj-featured-image') ?>" class="w-full" alt="<?php the_title() ?>" />
            <div class="absolute bottom-[6%] left-1/2 transform -translate-x-1/2 text-center text-white bg-black/40 p-2">
              <div class="text-2xl font-bold md:text-5xl "><?php the_title() ?></div>
              <div class="text-base/5 font-bold md:text-2xl/7 "><?php the_content('') ?></div>
            </div>
          </div>
          <?php $i++; ?>
        <?php endforeach; ?>
      </div>

      <div class="flex w-full justify-center gap-2 py-2">
        <?php for ($i = 1; $i <= count($sliders); $i++): ?>
          <a href="#item<?= $i ?>" class="btn btn-xs"><?= $i ?></a>
        <?php endfor; ?>
      </div>

    </div>
  </div>
<?php endif;