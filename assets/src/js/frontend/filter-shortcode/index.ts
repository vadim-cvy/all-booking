declare const jabFilterData: {
  id: number,
  ajaxUrl: string,
  maxEndDate: string,
}

const parseDate = ( strDate: string ) =>
{
  const date = new Date()

  date.setFullYear( Number( strDate.substring( 0, 4 ) ) )
  date.setMonth( Number( strDate.substring( 4, 6 ) ) - 1 )
  date.setDate( Number( strDate.substring( 6, 8 ) ) )

  return date
}

const stringifyDate = ( date: Date ) =>
{
  const y = String( date.getFullYear() )

  let
    m = String( date.getMonth() + 1 ),
    d = String( date.getDate() )

  m = m.length === 1 ? '0' + m : m
  d = d.length === 1 ? '0' + d : d

  return y + m + d
}

;(() =>
{
  const filterIdDataPropName = 'data-jab-filter-id'

  document.querySelectorAll(`[${filterIdDataPropName}]`).forEach( element =>
  {
    const filterId = element.getAttribute( filterIdDataPropName )

    const app = Vue.createApp({
      data: () =>
      {
        const controlValues: { [key: string]: string|number|Date } = {}

        const GETParams = (new URLSearchParams(window.location.search))

        GETParams.forEach((controlVal, controlKey) =>
        {
          switch ( controlKey )
          {
            case 'start_date':
            case 'end_date':
              controlValues[ controlKey ] = parseDate( controlVal )
              break

            default:
              controlValues[ controlKey ] = controlVal
              break
          }
        })

        controlValues.start_date = controlValues.start_date || new Date()
        controlValues.end_date = controlValues.end_date || parseDate( jabFilterData.maxEndDate )

        return {
          controlValues,

          results: [],
          isLoadingResults: true,

          bookingRequestData: {},
        }
      },

      computed: {
        filterId()
        {
          return filterId
        },
      },

      methods: {
        generateUniqueId()
        {
          return '' + Math.floor( Date.now() / 1000 ) + Math.floor( Math.random() * 100000 )
        },

        async updateResults()
        {
          this.isLoadingResults = true

          const requestData = new FormData()

          requestData.append('action', 'jab_filter_search')
          requestData.append('filter_id', String( jabFilterData.id ) )

          Object.entries( this.controlValues ).forEach( ([ controlKey, controlVal ]) =>
          {
            switch ( controlKey )
            {
              case 'start_date':
              case 'end_date':
                requestData.append( controlKey, stringifyDate( controlVal as Date ) )
                break

              default:
                requestData.append( controlKey, String( controlVal ) )
                break
            }
          })

          axios.post(jabFilterData.ajaxUrl, requestData )
          .then( (resp: {
            data: {
              success: boolean,
              data: {
                items: {}[],
                errMsg: string,
              },
            }
          }) =>
          {
            if ( ! resp.data.success )
            {
              // todo
              throw new Error( resp.data.data.errMsg )
            }

            this.results = resp.data.data.items
          })
          // todo: uncomment
          // .catch(() => alert( 'Something goes wrong' ) )
          .finally(() => this.isLoadingResults = false)
        },

        printDate( date: Date )
        {
          return date.getDate() + '/' + ( date.getMonth() + 1 ) + '/' + date.getFullYear()
        },
      },

      watch: {
        controlValues: {
          handler( controlValues )
          {
            const GETParams = new URLSearchParams(window.location.search);

            Object.entries( controlValues ).forEach( control =>
            {
              const [ key, val ] = control

              if ( val instanceof Date )
              {
                GETParams.set( key, stringifyDate( val ) )
              }
              else
              {
                GETParams.set( key, String( val ) )
              }
            })

            history.pushState(null, '', '?' + GETParams.toString())

            // todo: do with delay
            this.updateResults()
          },
          deep: true,
        },
      },

      created()
      {
        this.updateResults()
      },
    })

    app.mount( element )
  });
})()