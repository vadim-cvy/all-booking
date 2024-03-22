<jab-field
  class="jab-filter-instance__global-stettings__timing"
  label="Timing"
  :is-label-clickable="false"
>
  <jab-items-list
    :items="filterInstance.timing"
    item-css-class="jab-filter-instance__global-stettings__timing__slots-group"
    item-general-label="Slots Group"
    :new-item-data-cb="() => ({
      days: [],
      slots: [],
    })"
  >
    <template #default="{ item: slotsGroup, itemIndex: slotsGroupIndex }">
      <jab-field
        class="jab-filter-instance__global-stettings__timing__slots-group__days"
        label="Days"
        :is-label-clickable="false"
      >
        <template #default>
          <?php
          foreach ( [ 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun' ] as $day_index => $day_name )
          { ?>
            <label class="jab-filter-instance__global-stettings__timing__slots-group__days__option">
              <input
                type="checkbox"
                v-model="slotsGroup.days"
                value="<?php echo (int) $day_index; ?>"
              >
              <?php echo esc_html( $day_name ); ?>
            </label>

            <input
              type="hidden"
              :name="`jab[filters][${filterInstanceIndex}][timing][${slotsGroupIndex}][days]`"
              :value="JSON.stringify( slotsGroup.days )"
            >
          <?php
          } ?>
        </template>
      </jab-field>

      <jab-field
        class="jab-filter-instance__global-stettings__timing__slots-group__slots"
        label="Slots"
        :is-label-clickable="false"
      >
        <jab-items-list
          :items="slotsGroup.slots"
          item-css-class="jab-filter-instance__global-stettings__timing__slots-group__slot"
          item-general-label="Slot"
          :new-item-data-cb="() => ({
            start: { h: 0, m: 0 },
            duration: {
              default: { d: 0, h: 0, m: 0 },
              max: { d: 0, h: 0, m: 0 },
              min: { d: 0, h: 0, m: 0 },
              step: { d: 0, h: 0, m: 0 },
            },
          })"
        >
          <template #default="{ item: slot, itemIndex: slotIndex }">
            <jab-field
              class="jab-filter-instance__global-stettings__timing__slots-group__slot__start"
              label="Start Time"
            >
              <template #default="{ inputId }">
                <input
                  :id="inputId"
                  v-model="slot.start"
                  type="time"
                  :name="`jab[filters][${filterInstanceIndex}][timing][${slotsGroupIndex}][slots][${slotIndex}][start]`"
                >
              </template>
            </jab-field>

            <div
              v-for="(slotDurationSettingData, slotDurationSettingName ) in slot.duration"
              :key="slotDurationSettingName"
              class="jab-filter-instance__global-stettings__timing__slots-group__slot__duration__setting"
            >
              <jab-field
                :class="'jab-filter-instance__global-stettings__timing__slots-group__slot__duration__' + slotDurationSettingName"
                :label="{
                  max: 'Max Duration',
                  min: 'Min Duration',
                  default: 'Default Duration',
                  step: 'Duration Step',
                }[slotDurationSettingName]"
              >
                <template #default="{ inputId }">
                  <label>
                    <input
                      type="number"
                      min="0"
                      step="1"
                      v-model.number="slot.duration[slotDurationSettingName].d"
                      :name="`jab[filters][${filterInstanceIndex}][timing][${slotsGroupIndex}][slots][${slotIndex}][duration][${slotDurationSettingName}][d]`"
                      :id="inputId"
                    >
                    days
                  </label>

                  <label>
                    <input
                      type="number"
                      min="0"
                      max="23"
                      step="1"
                      v-model.number="slot.duration[slotDurationSettingName].h"
                      :name="`jab[filters][${filterInstanceIndex}][timing][${slotsGroupIndex}][slots][${slotIndex}][duration][${slotDurationSettingName}][h]`"
                    >
                    hours
                  </label>

                  <label>
                    <input
                      type="number"
                      min="0"
                      max="59"
                      step="1"
                      v-model.number="slot.duration[slotDurationSettingName].m"
                      :name="`jab[filters][${filterInstanceIndex}][timing][${slotsGroupIndex}][slots][${slotIndex}][duration][${slotDurationSettingName}][m]`"
                    >
                    minutes
                  </label>
                </div>
              </template>
            </jab-field>
          </template>
        </jab-items-list>
      </jab-field>
    </template>
  </jab-items-list>
</jab-field>
