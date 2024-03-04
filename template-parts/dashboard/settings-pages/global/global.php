<?php
$setting_groups = [
  'global' => 'Global',
  'filter-page' => 'Filter Page',
  'popup' => 'Popup',
];
?>

<jab-items-list
  :items="settings.filters"
  item-css-class="jab-filter-instance"
  item-general-label="Filter"
  :new-item-data-cb="() => ({
    id: generateUniqueId(),
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
          id: generateUniqueId(),
          type: 'pt',
          is_selectable: true,
          is_required: true,
        }
      ],
    },
  })"
>
  <template #default="{ item: filterInstance, itemIndex: filterInstanceIndex }">
    <div class="jab-filter-instance__header">
      <span class="jab-text-secondary">
        Filter ID: {{ filterInstance.id }}
      </span>

      <p class="jab-filter-instance__warning" v-if="filterInstance.state === 'under_development'">
        Note: this filter is hidden from users at the moment.
      </p>
    </div>

    <?php
    foreach ( $setting_groups as $setting_group_key => $setting_group_label )
    { ?>
      <div class="jab-filter-instance__section">
        <h3 class="jab-filter-instance__section__title">
          <?php echo esc_html( $setting_group_label ); ?>
        </h3>

        <div class="
          jab-filter-instance__<?php echo esc_attr( $setting_group_key ); ?>-settings
          jab-filter-instance__section__content
        ">
          <?php require_once jab_resolve_path( __DIR__ . "/$setting_group_key/$setting_group_key.php" ); ?>
        </div>
      </div>
    <?php
    } ?>

    <input type="hidden" :name="`jab[filters][${filterInstanceIndex}][id]`" :value="filterInstance.id">
  </template>
</jab-items-list>