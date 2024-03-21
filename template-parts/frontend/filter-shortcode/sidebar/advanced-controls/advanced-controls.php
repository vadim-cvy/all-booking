<div class="jab-filter__sidebar__advanced-controls">
  <a
    href="#"
    class="jab-filter__sidebar__advanced-controls__trigger"
    @click.prevent="() => areAdvancedControlsVisible = true"
  >
    Click for more options
  </a>

  <?php require_once jab_resolve_path( __DIR__ . '/popup.php' ); ?>
</div>