<div class="jbk-filters">
  <div
    class="jbk-filters__filter"
    v-for="(filter, filterIndex) in filters"
    :key="filterIndex"
  >
    <div class="jbk-filters__filter__settings">
      <div class="jbk-filters__filter__settings__section">
        <strong class="jbk-filters__filter__settings__section__title">
          Filter Settings
        </strong>

        <div class="jbk-field">
          <label for="jbk-filters__filter_0__label" class="jbk-field__label">
            Label
          </label>

          <div class="jbk-field__value">
            <input type="text" class="jbk-field__input" id="jbk-filters__filter_0__label">
          </div>
        </div>

        <div class="jbk-field">
          <label for="jbk-filters__filter_0__per-page" class="jbk-field__label">
            Items Per Page
          </label>

          <div class="jbk-field__value">
            <input type="number" class="jbk-field__input" id="jbk-filters__filter_0__per-page">
          </div>
        </div>
      </div>

      <div class="jbk-filters__filter__settings__section">
        <strong class="jbk-filters__filter__settings__section__title">
          Popup Fields
        </strong>

        <div class="jbk-filters__filter__settings__popup-fields">
          <div
            class="jbk-filters__filter__settings__popup-field"
            v-for="(popupField, popuppopupFieldIndex) in popupFields"
            :key="popupFieldIndex"
          >
            <div class="jbk-filters__filter__settings__popup-field__settings">
              <div>
                <div class="jbk-field">
                  <label for="jbk-filters__filter_0__field_0__label" class="jbk-field__label">
                    Label
                  </label>

                  <div class="jbk-field__value">
                    <input type="text" class="jbk-field__input" id="jbk-filters__filter_0__field_0__label">
                  </div>
                </div>
              </div>

              <div>
                <strong @click="() => togglePopupFieldAdvancedSettings( popupFieldIndex, filterIndex )">
                  Advanced settings {open-close icon}
                </strong>

                <div class="jbk-field">
                  <label for="jbk-filters__filter_0__field_0__data-source" class="jbk-field__label">
                    Data Source
                  </label>

                  <div class="jbk-field__value">
                    <select id="jbk-filters__filter_0__field_0__data-source">
                      <option value="" selected="selected" disabled="disabled">Select</option>

                      <?php
                      foreach ( [ 'foo' ] as $post_type )
                      {
                        printf( '<option value="%s">%s</option>',
                          esc_attr( 'todo pt slug '),
                          esc_html( 'Todo PT' ),
                        );
                      } ?>

                      <option value="custom">Custom Field</option>
                    </select>
                  </div>
                </div>

                <div class="jbk-field">
                  <label class="jbk-field__label">
                    Price
                  </label>

                  <p class="jbk-field__value">
                    You will be able to setup post {timeslots/seasons} prices on the post edit page after you save this filter.
                  </p>
                </div>
              </div>
            </div>

            <div>
              <button
                @click="() => deletePopupField( popupFieldIndex, filterIndex )"
                type="button"
                class="button jbk-button_delete"
              >
                Delete Field
              </button>

              <button
                @click="() => addPopupField( filterIndex, popupFieldIndex )"
                type="button"
                class="button"
              >
                Add Sub Field
              </button>
            </div>
          </div>

          <div class="jbk-filters__filter__settings__popup-fields__actions">
            <button
              @click="() => addPopupField( filterIndex )"
              type="button"
              class="button"
            >
              Add Field
            </button>
          </div>
        </div>
      </div>

      <div>
        <button
          @click="() => deleteFilter( filterIndex )"
          type="button"
          class="button jbk-button_delete"
        >
          Delete Filter
        </button>
      </div>
    </div>

    <div class="jbk-filters__filter__preview">
      <div class="jbk-filters__filter__preview__section">
        <strong class="jbk-filters__filter__preview__section__title">
          Popup Preview (dummy data)
        </strong>

        <div>
          <div class="jbk-field">
            <label class="jbk-field__label">
              Date
            </label>

            <div class="jbk-field__value">
              <select class="jbk-field__input">
                <option>Date Month, Year</option>
                <option>Date Month, Year</option>
                <option>Date Month, Year</option>
                <option>Date Month, Year</option>
              </select>
            </div>
          </div>

          <div class="jbk-field">
            <label class="jbk-field__label">
              Timeslot
            </label>

            <div class="jbk-field__value">
              <select class="jbk-field__input">
                <option>HH:MM - HH:MM</option>
                <option>HH:MM - HH:MM</option>
                <option>HH:MM - HH:MM</option>
                <option>HH:MM - HH:MM</option>
              </select>
            </div>
          </div>

          <div class="jbk-field">
            <label class="jbk-field__label">
              (No Name) - you're currently editing this field
            </label>

            <div class="jbk-field__value">
              <select class="jbk-field__input">
              </select>
            </div>
          </div>
        </div>

        <div>
          Total: $0,000.00
        </div>

        <button type="button" class="button button-primary">
          Book
        </button>
      </div>
    </div>
  </div>

  <div class="jbk-filters__actions">
    <button
      @click="() => addNewFilter()"
      type="button"
      class="button"
    >
      Add Filter
    </button>
  </div>
</div>