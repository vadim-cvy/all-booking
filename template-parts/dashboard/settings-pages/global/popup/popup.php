<jab-field
  class="jab-filter-instance__popup-stettings__fields"
  label="Fields"
>
  <jab-items-list
    :items="filterInstance.popup.fields"
    item-css-class="jab-filter-instance__popup-stettings__fields__field"
    item-general-label="Field"
    :new-item-data-cb="() => ({
      id: generateUniqueId(),
      label: null,
      type: null,
      subFields: [],
    })"
  >
    <template #default="{ item: field, itemIndex: fieldIndex }">
      <div class="jab-filter-instance__popup-stettings__fields__field__header">
        <span class="jab-text-secondary">
          Field ID: {{ field.id }}
        </span>
      </div>

      <?php
      foreach ( [ 'label', 'is-required', 'type' ] as $field_setting_name )
      {
        require jab_resolve_path( __DIR__ . "/field-setting_$field_setting_name.php" );
      } ?>

      <div v-if="field.type">
        <?php
        foreach ( [ 'pt', 'number', 'true-false' ] as $popup_field_settings_group )
        {
          require jab_resolve_path( __DIR__ . "/field-settings_$popup_field_settings_group.php" );
        } ?>
      </div>

      <jab-field
        v-if="field.type"
        class="jab-filter-instance__popup-stettings__fields__field__sub-fields"
        label="Sub Fields"
      >
        <template #default="{ inputId }">
          // todo
          // todo: all subfields of numeric pt or number will be shown the number of times specified in the number input value
        </template>
      </jab-field>

      <input type="hidden" :name="`jab[filters][${filterInstanceIndex}][popup][fields][${fieldIndex}][id]`" :value="field.id">
    </template>
  </jab-items-list>
</jab-field>
