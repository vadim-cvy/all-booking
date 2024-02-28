<jbk-field
  class="jbk-filter-instance__global-stettings__timing"
  label="Timing"
  :is-label-clickable="false"
>
  <jbk-items-list
    :items="filterInstance.timing"
    item-css-class="jbk-filter-instance__global-stettings__timing__slots-group"
    item-general-label="Slots Group"
    :new-item-data-cb="() => ({
      days: [],
      slots: [],
    })"
  >
    <template #default="{ item: slotsGroup, itemIndex: slotsGroupIndex }">
      <jbk-field
        class="jbk-filter-instance__global-stettings__timing__slots-group__days"
        label="Days"
        :is-label-clickable="false"
      >
        <template #default>
          <?php
          foreach ( [ 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun' ] as $day_index => $day_name )
          { ?>
            <label class="jbk-filter-instance__global-stettings__timing__slots-group__days__option">
              <input
                type="checkbox"
                v-model="slotsGroup.days"
                value="<?php echo (int) $day_index; ?>"
              >
              <?php echo esc_html( $day_name ); ?>
            </label>

            <input
              type="hidden"
              :name="`jbk_filters_settings[${filterInstanceIndex}][timing][${slotsGroupIndex}][days]`"
              :value="JSON.stringify( slotsGroup.days )"
            >
          <?php
          } ?>
        </template>
      </jbk-field>

      <jbk-field
        class="jbk-filter-instance__global-stettings__timing__slots-group__slots"
        label="Slots"
        :is-label-clickable="false"
      >
        <jbk-items-list
          :items="slotsGroup.slots"
          item-css-class="jbk-filter-instance__global-stettings__timing__slots-group__slot"
          item-general-label="Slot"
          :new-item-data-cb="() => ({
            start: { h: 0, m: 0 },
            duration: { d: 0, h: 0, m: 0 },
          })"
        >
          <template #default="{ item: slot, itemIndex: slotIndex }">
            <jbk-field
              class="jbk-filter-instance__global-stettings__timing__slots-group__slot__start"
              label="Start Time"
            >
              <template #default="{ inputId }">
                <input
                  :id="inputId"
                  v-model="slot.start"
                  type="time"
                  :name="`jbk_filters_settings[${filterInstanceIndex}][timing][${slotsGroupIndex}][slots][${slotIndex}][start]`"
                >
              </template>
            </jbk-field>

            <jbk-field
              class="jbk-filter-instance__global-stettings__timing__slots-group__slot__duration"
              label="Duration"
              :is-label-clickable="false"
            >
              <template #default="{ inputId }">
                <label>
                  <input
                    type="number"
                    min="0"
                    step="1"
                    v-model.number="slot.duration.d"
                    :name="`jbk_filters_settings[${filterInstanceIndex}][timing][${slotsGroupIndex}][slots][${slotIndex}][duration][d]`"
                  >
                  days
                </label>

                <label>
                  <input
                    type="number"
                    min="0"
                    max="23"
                    step="1"
                    v-model.number="slot.duration.h"
                    :name="`jbk_filters_settings[${filterInstanceIndex}][timing][${slotsGroupIndex}][slots][${slotIndex}][duration][h]`"
                  >
                  hours
                </label>

                <label>
                  <input
                    type="number"
                    min="0"
                    max="59"
                    step="1"
                    v-model.number="slot.duration.m"
                    :name="`jbk_filters_settings[${filterInstanceIndex}][timing][${slotsGroupIndex}][slots][${slotIndex}][duration][m]`"
                  >
                  minutes
              </template>
            </jbk-field>
          </template>
        </jbk-items-list>
      </jbk-field>
    </template>
  </jbk-items-list>
</jbk-field>
