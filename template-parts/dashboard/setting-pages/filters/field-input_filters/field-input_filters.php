<div id="jbk-filters-setting" class="jbk-filters-setting">
  <div
    class="jbk-filters-setting__filter"
    v-for="(filter, filterIndex) in filters"
    :key="filterIndex"
  >
    <?php require_once jbk_get_template_path( __DIR__ . '/filter/filter.php' ); ?>
  </div>

  <div class="jbk-filters-setting__actions">
    <button
      @click="() => addFilter()"
      type="button"
      class="button"
    >
      Add Filter
    </button>
  </div>
</div>