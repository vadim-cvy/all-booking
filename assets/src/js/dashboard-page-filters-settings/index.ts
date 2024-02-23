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
            fields: [
              this.createBookingFieldObject({
                label: 'Bookable Object (not visible to the user)',
                type: 'pt',
                isCustom: false,
                parent: null,
              })
            ],
          }
        })

        this.addBookingSlot( filters.length - 1 )
      },

      deleteFilter( index: number )
      {
        this.filters.splice( index, 1 )
      },

      addBookingField( filterIndex: number )
      {
        this.filters[ filterIndex ].booking.fields.push( this.createBookingFieldObject() )
      },

      createBookingFieldObject( fieldData = {} )
      {
        return {
          label: null,
          type: null,
          pt: null,
          isCustom: true,
          numeric: {
            isNumeric: true,
            default: 1,
            isEditable: false,
            min: 1,
            max: 100,
            step: 1,
            parent: 0,
            numericParentRelation: 'each',
          },

          ...fieldData,
        }
      },

      deleteBookingField( fieldIndex: number, filterIndex: number )
      {
        this.filters[ filterIndex ].booking.fields.splice( fieldIndex, 1 )
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

      prefixBookingFieldInputId( baseId: string, fieldIndex: number, filterIndex: number )
      {
        return this.prefixInputId( 'booking-custom-field_' + fieldIndex + '__' + baseId,
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