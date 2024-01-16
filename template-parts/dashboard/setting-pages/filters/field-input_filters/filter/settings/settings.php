<div class="jbk-filters-setting__filter__settings">
  <?php
  require_once jbk_get_template_path( __DIR__ . '/section_base/section_base.php' );
  require_once jbk_get_template_path( __DIR__ . '/section_popup/section_popup.php' );
  ?>

  <div>
    <button
      @click="() => deleteFilter( filterIndex )"
      type="button"
      class="button jbk-button_delete"
    >
      Delete Filter
    </button>
  </div>
</div>