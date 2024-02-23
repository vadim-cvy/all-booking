<!-- <div class="jbk-filter__preview__section">
  <strong class="jbk-filter__preview__section__title">
    Popup Preview (dummy data)
  </strong>

  <div class="jbk-filter__settings__section__content">
    <div class="jbk-field">
      <label class="jbk-field__label">
        {{ filter.bookingFields[0].label }} (this is a main target object)
      </label>

      <div class="jbk-field__value">
        <p><i>You need to complete field setup to preview.</i></p>
      </div>
    </div>

    <div class="jbk-field" v-if="! filter.isCustomDuration || ( ( filter.minCustomDuration.days + filter.customDurationStep.days * filter.maxCustomDurationSteps ) + ( filter.minCustomDuration.hours + filter.customDurationStep.hours * filter.maxCustomDurationSteps ) / 24 + ( filter.minCustomDuration.minutes + filter.customDurationStep.minutes * filter.maxCustomDurationSteps ) / 60 / 24 ) < 1">
      <label class="jbk-field__label">
        Date
      </label>

      <div class="jbk-field__value">
        <select class="jbk-field__input">
          <option>Date Month, Year</option>
          <option>Date Month, Year</option>
        </select>
      </div>
    </div>

    <div class="jbk-field" v-else>
      <label class="jbk-field__label">
        Start Date
      </label>

      <div class="jbk-field__value">
        <select class="jbk-field__input">
          <option>Date Month, Year</option>
          <option>Date Month, Year</option>
        </select>
      </div>
    </div>

    <div class="jbk-field" v-show="filter.isTimeable">
      <label class="jbk-field__label">
        Start Time
      </label>

      <div class="jbk-field__value">
        <select class="jbk-field__input">
          <option>HH:MM</option>
          <option>HH:MM</option>
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
</div> -->