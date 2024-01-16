(()=>
{
  const app = Vue.createApp({
    data: () => ({
      filters: [
        {
          label: 'Dummy Filter',
          itemsPerPage: 12,
          hasTimeSlots: false,
          popupFields: [
            {
              label: 'Dummy Field',
              type: 'pt',
              pt: 'dummy_pt_slug',
            }
          ],
        }
      ],
    }),

    methods: {
      addFilter()
      {
        this.filters.push({
          label: null,
          itemsPerPage: null,
          hasTimeSlots: false,
          popupFields: [],
        })
      },

      deleteFilter( index: number )
      {
        this.filters.splice( index, 1 )
      },

      addPopupField( filterIndex: number )
      {
        const filter = this.filters[ filterIndex ]

        filter.popupFields.push({
          label: null,
          type: null,
          pt: null,
        })

        filter.activePopupFieldIndex = filter.popupFields.length - 1
      },

      deletePopupField( fieldIndex: number, filterIndex: number )
      {
        this.filters[ filterIndex ].popupFields.splice( fieldIndex, 1 )
      },

      prefixInputId( baseId: string, filterIndex: number, fieldIndex?: number )
      {
        let prefix = 'jbk-filters-setting__filter_' + filterIndex + '__'

        if ( typeof fieldIndex !== undefined )
        {
          prefix += 'popup-field_' + fieldIndex + '__'
        }

        return prefix + baseId
      },
    }
  })

  app.mount( '#jbk-filters-setting' )
})()