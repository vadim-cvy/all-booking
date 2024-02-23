(()=>
{
  const app = Vue.createApp({
    data: () => ({
      filters: [],
    }),

    methods: {
      addFilter()
      {
        const filters = this.filters

        filters.push({
          label: null,
          itemsPerPage: 12,
          booking: {
            isTimeable: true,
            slots: [],
            customFields: [],
          }
        })

        this.addBookingSlot( filters.length - 1 )
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
        const slots = this.filters[ filterIndex ].booking.slots

        slots.push({
          startTime: {
            h: 0,
            m: 0,
          },
          repeat: [],
          durationOptions: [],
        })

        this.addBookingSlotDurationOption( slots.length - 1, filterIndex )
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
        return 'jbk-filter_' + filterIndex + '__' + baseId
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