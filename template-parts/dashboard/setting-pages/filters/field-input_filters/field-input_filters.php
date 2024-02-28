<div id="jbk-filters">
  <jbk-items-list
    :items="filters"
    item-css-class="jbk-filter-instance"
    item-general-label="Filter"
    :new-item-data-cb="() => ({
      state: 'under_development',
      label: '',
      source_pt: '',
      timing: [],
      filter_page: {
        items_per_page: 12,
      },
      popup: {
        fields: [
          {
            type: 'pt',
            is_selectable: true,
            is_required: true,
          }
        ],
      },
    })"
  >
    <template #default="{ item: filterInstance, itemIndex: filterInstanceIndex }">
      <?php
      foreach ( [ 'global', 'filter-page', 'popup' ] as $settings_group )
      { ?>
        <div class="jbk-filter-instance__section">
          <h3 class="jbk-filter-instance__section__title">
            <?php echo [
              'global' => 'Global',
              'filter-page' => 'Filter Page',
              'popup' => 'Popup',
            ][ $settings_group ]; ?>
          </h3>

          <div class="
            jbk-filter-instance__<?php echo esc_attr( $settings_group ); ?>-settings
            jbk-filter-instance__section__content
          ">
            <?php require jbk_get_template_path( __DIR__ . "/$settings_group-settings/$settings_group-settings.php" ); ?>
          </div>
        </div>
      <?php
      } ?>
    </template>
  </jbk-items-list>
</div>