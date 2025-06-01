<footer class="c-footer footer footer-horizontal footer-center bg-base-200 text-base-content rounded px-4 py-10">
  <nav class="c-footer-nav">
    <!-- <a class="link link-hover">About us</a>
    <a class="link link-hover">Contact</a>
    <a class="link link-hover">Jobs</a>
    <a class="link link-hover">Press kit</a> -->
    <?php
    wp_nav_menu(array(
      'theme_location' => 'footer-menu',
      'container' => false,
      'menu_class' => 'menu grid grid-flow-col gap-4',
    ));
    ?>
  </nav>
  <nav>
    <div class="grid grid-flow-col gap-4">
      <?php if (!empty(get_theme_mod('wooprj_youtube'))): ?>
        <a href="<?= get_theme_mod('wooprj_youtube') ?>">
          <span class="dashicons dashicons-youtube text-3xl w-[30px] h-[30px"></span>
        </a>
      <?php endif; ?>
      <?php if (!empty(get_theme_mod('wooprj_facebook'))): ?>
        <a href="<?= get_theme_mod('wooprj_facebook') ?>">
          <span class="dashicons dashicons-facebook text-3xl w-[30px] h-[30px]"></span>
        </a>
      <?php endif; ?>
      <?php if (!empty(get_theme_mod('wooprj_instagram'))): ?>
        <a href="<?= get_theme_mod('wooprj_instagram') ?>">
          <span class="dashicons dashicons-instagram text-3xl w-[30px] h-[30px]"></span>
        </a>
      <?php endif; ?>
    </div>
  </nav>
  <aside>
    <p>Copyright © 2025 - All right reserved</p>
  </aside>
</footer>

</div><!-- #wrap -->

<?php wp_footer(); ?>

</body>

</html>