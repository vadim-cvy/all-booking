export const JbkItemsList = Vue.defineComponent({
  props: {
    items: {
      type: Array,
      required: true,
    },
    itemGeneralLabel: {
      type: String,
      required: true,
    },
    itemCssClass: {
      type: String,
      required: false,
    },
    newItemDataCb: {
      type: Function,
      required: true,
    },
  },

  methods: {
    deleteItem( itemIndex: number )
    {
      const confirmMsg = `Are you sure you want to delete this ${this.itemGeneralLabel.toLocaleLowerCase()}?`

      if ( confirm( confirmMsg ) )
      {
        this.items.splice( itemIndex, 1 )
      }
    },
  },

  template:
    `<div class="jbk-items-list">
      <div class="jbk-items-list__items" v-show="items.length !== 0">
        <div
          :class="[
            'jbk-items-list__item',
            itemCssClass,
            itemCssClass + '_' + itemIndex
          ]"
          v-for="(item, itemIndex) in items"
          :key="itemIndex"
        >
          <div class="jbk-items-list__item__content">
            <slot :item="item" :itemIndex="itemIndex"></slot>
          </div>

          <div class="jbk-items-list__item__actions">
            <button
              type="button"
              class="button jbk-button_danger"
              @click="() => deleteItem( itemIndex )"
            >
              Remove this {{ itemGeneralLabel }}
            </button>

            <slot name="item-actions" :item="item" :itemIndex="itemIndex"></slot>
          </div>
        </div>
      </div>

      <div class="jbk-items-list__actions">
        <button
          @click="() => items.push(newItemDataCb())"
          type="button"
          class="button"
        >
          Add {{ itemGeneralLabel }}
        </button>
      </div>
    </div>`,
})