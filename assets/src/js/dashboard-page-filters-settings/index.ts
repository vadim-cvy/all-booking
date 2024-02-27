import { JbkItemsList } from "./components/JbkItemsList"
import { JbkField } from "./components/JbkField"

(()=>
{
  const app = Vue.createApp({
    data: () => ({
      filters: [],
      pts: [
        {
          slug: 'dummyPT',
          label: 'Dummy PT',
        }
      ]
    }),

    methods: {
      // createBookingFieldObject( fieldData = {} )
      // {
      //   return {
      //     label: null,
      //     type: null,
      //     pt: null,
      //     numeric: {
      //       isNumeric: true,
      //       default: 1,
      //       isEditable: false,
      //       min: 1,
      //       max: 100,
      //       step: 1,
      //       parent: 0,
      //       numericParentRelation: 'each',
      //     },

      //     ...fieldData,
      //   }
      // },
    }
  })

  app.component('jbk-items-list', JbkItemsList)
  app.component('jbk-field', JbkField)

  app.mount( '#jbk-filters' )
})()