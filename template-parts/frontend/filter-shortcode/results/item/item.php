<div
  v-for="item in results"
  :key="item.id"
  :class="[
    'jab-filter__item',
    `jab-filter__item--status-${item.status.slug}`,
  ]"
>
  <?php
  require_once jab_resolve_path( __DIR__ . '/img.php' );
  require_once jab_resolve_path( __DIR__ . '/title.php' );
  require_once jab_resolve_path( __DIR__ . '/status.php' );
  require_once jab_resolve_path( __DIR__ . '/excerpt.php' );
  require_once jab_resolve_path( __DIR__ . '/popup-triggers.php' );
  ?>
</div>
