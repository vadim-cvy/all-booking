(()=>
{
  const app = Vue.createApp({
    data: () => ({
      filters: [
        {
          label: 'Dummy Filter',
          itemsPerPage: 12,
          booking: {
            isTimeable: true,
            slots: [
              {
                startTime: {
                  h: 15,
                  m: 30,
                },
                durationOptions: [],
              },
            ],
            customFields: [
              {
                label: 'Dummy Field',
                type: 'pt',
                pt: 'dummy_pt_slug',
              }
            ],
          }
        }
      ],
    }),

    methods: {
      addFilter()
      {
        this.filters.push({
          label: null,
          itemsPerPage: 12,
          booking: {
            isTimeable: true,
            slots: [],
            customFields: [],
          }
        })
      },

      deleteFilter( index: number )
      {
        this.filters.splice( index, 1 )
      },

      addBookingCustomField( filterIndex: number )
      {
        this.filters[ filterIndex ].booking.customFields.push({
          label: null,
          type: null,
          pt: null,
        })
      },

      deleteBookingCustomField( fieldIndex: number, filterIndex: number )
      {
        this.filters[ filterIndex ].booking.customFields.splice( fieldIndex, 1 )
      },

      addBookingSlot( filterIndex: number )
      {
        this.filters[ filterIndex ].booking.slots.push({
          startTime: {
            h: 0,
            m: 0,
          },
          durationOptions: [],
        })
      },

      deleteBookingSlot( slotIndex: number, filterIndex: number )
      {
        this.filters[ filterIndex ].booking.slots.splice( slotIndex, 1 )
      },

      addBookingSlotDurationOption( slotIndex: number, filterIndex: number )
      {
        this.filters[ filterIndex ].booking.slots[ slotIndex ].durationOptions.push({
          label: '',
          time: {
            d: 0,
            h: 0,
            m: 0,
          },
        })
      },

      deleteBookingSlotDurationOption( optionIndex: number, slotIndex: number, filterIndex: number )
      {
        this.filters[ filterIndex ].booking.slots[ slotIndex ].durationOptions.splice( optionIndex, 1 )
      },

      prefixInputId( baseId: string, filterIndex: number )
      {
        return 'jbk-filters__filter_' + filterIndex + '__' + baseId
      },

      prefixBookingCustomFieldInputId( baseId: string, customFieldIndex: number, filterIndex: number )
      {
        return this.prefixInputId( 'booking-custom-field_' + customFieldIndex + '__' + baseId,
          filterIndex )
      },

      prefixBookingSlotInputId( baseId: string, slotIndex: number, filterIndex: number )
      {
        return this.prefixInputId( 'booking-slot_' + slotIndex + '__' + baseId,
          filterIndex )
      },

      prefixBookingSlotDurationOptionInputId(
        baseId: string,
        durationOptionIndex: number,
        slotIndex: number,
        filterIndex: number
      )
      {
        return this.prefixBookingSlotInputId( 'duration_' + durationOptionIndex + '__' + baseId,
          slotIndex, filterIndex )
      },
    }
  })

  app.mount( '#jbk-filters' )
})()