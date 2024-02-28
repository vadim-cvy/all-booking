<jbk-field
  class="jbk-filter-instance__filter-page-stettings__items-per-page"
  label="Items per page"
>
  <template #default="{ inputId }">
    <input
      :id="inputId"
      v-model="filterInstance.filter_page.items_per_page"
      type="number"
      min="1"
      step="1"
    >
  </template>
</jbk-field>