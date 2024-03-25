<div class="jab-metabox">
  <div class="jab-metabox__section jab-metabox__base-settings">
    <h2 class="jab-metabox__section__title">
      Base Settings
    </h2>

    <jab-field
      class="jab-metabox__base-settings__limit"
      label="Limit"
    >
      <template #default="{ inputId }">
        <input
          type="number"
          v-model.number="limit"
          :id="inputId"
          min="0"
          step="1"
          name="jab[limit]"
        >

        <p>
          Leave empty or set "0" to make this item unlimited.
        </p>
      </template>
  </div>

  <div class="jab-metabox__section">
    <h2 class="jab-metabox__section__title">
      Filter Fields Overrides
    </h2>

    <div
      v-for="(filterOverridesData, filterInstanceIndex) in overrides"
      :key="filterOverridesData.filterId"
      class="jab-metabox__filter-overrides"
    >
      <h3 class="jab-metabox__filter-overrides__title">
        {{ filterOverridesData.filterLabel }}
      </h3>

      <div
        v-for="(field, fieldIndex) in filterOverridesData.fields"
        :key="field.id"
        class="jab-metabox__filter-overrides__content"
      >
        <jab-field class="" :label="field.label">
          <template #default>
            <div v-if="field.is_qty_adjustable">
              <?php
              foreach ( [ 'default-number', 'max-number', 'min-number' ] as $field_setting_name )
              {
                require jab_resolve_path(
                  JAB_TEMPLATES_PATH . "/dashboard/settings-pages/global/popup/field-setting_$field_setting_name.php" );
              } ?>
            </div>

            <?php require jab_resolve_path(
              JAB_TEMPLATES_PATH . "/dashboard/settings-pages/global/popup/field-setting_price.php" ); ?>

            <input
              type="hidden"
              :name="`jab[filters][${filterInstanceIndex}][popup][fields][${fieldIndex}][id]`" :value="field.id"
            >
          </template>
        </jab-field>
      </div>
    </div>
  </div>
</div>