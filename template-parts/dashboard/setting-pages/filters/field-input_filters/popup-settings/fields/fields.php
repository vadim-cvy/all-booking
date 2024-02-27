<jbk-field
  class="jbk-filter-instance__popup-stettings__fields"
  label="Fields"
>
  <jbk-items-list
    :items="filterInstance.popup.fields"
    item-css-class="jbk-filter-instance__popup-stettings__fields__field"
    item-general-label="Field"
    :new-item-data-cb="() => ({
      label: null,
      type: null,
      subFields: [],
    })"
  >
    <template #default="{ item: field }">
      <?php require_once __DIR__ . '/field-settings.php'; ?>
    </template>
  </jbk-items-list>
</jbk-field>
