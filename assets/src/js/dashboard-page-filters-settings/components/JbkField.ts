export const JbkField = Vue.defineComponent({
  props: {
    class: {
      type: String,
      required: true,
    },
    label: {
      type: String,
      required: true,
    },
    isLabelClickable: {
      type: Boolean,
      required: false,
      default: true,
    },
  },

  computed: {
    inputId()
    {
      return this.class + '__input';
    },

    wrapperClass()
    {
      return 'jbk-field ' + this.class
    }
  },

  template:
    `<div :class="wrapperClass">
      <label class="jbk-field__label" :for="isLabelClickable ? inputId : ''">
        {{ label }}
      </label>

      <div class="jbk-field__input-wrapper">
        <slot :input-id="isLabelClickable ? inputId : ''"></slot>
      </div>
    </div>`,
})