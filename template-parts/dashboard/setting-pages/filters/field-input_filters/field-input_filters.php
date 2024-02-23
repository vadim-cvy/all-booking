<div id="jbk-filters" class="jbk-filters jbk-items-list">
  <div class="jbk-items-list__items">
    <div
      class="jbk-items-list__item"
      v-for="(filter, filterIndex) in filters"
      :key="filterIndex"
    >
      <div class="jbk-items-list__item__content jbk-filters__filter">
        <?php require_once jbk_get_template_path( __DIR__ . '/filter-content/filter-content.php' ); ?>
      </div>

      <div class="jbk-items-list__item__actions">
        <button
          type="button"
          class="button jbk-button_danger"
          @click="() => deleteFilter( filterIndex )"
        >
          Delete This Filter
        </button>
      </div>
    </div>
  </div>

  <div class="jbk-items-list__actions">
    <button
      @click="() => addFilter()"
      type="button"
      class="button"
    >
      Add Filter
    </button>
  </div>
</div>