<div class="jab-filter__results">
  <div
    v-if="isLoadingResults"
    class="jab-filter__loading"
  >
    Loading...
  </div>

  <div
    v-else-if="results.length"
    class="jab-filter__items"
  >
    <?php require_once jab_resolve_path( __DIR__ . '/item/item.php' ); ?>
  </div>

  <p
    v-else
    class="jab-filter__no-results-message"
  >
    No results found matching your search creteria.
  </p>

  <!-- todo: pagination -->

  <?php require_once jab_resolve_path( __DIR__ . '/item-popup/item-popup.php' ); ?>
</div>
