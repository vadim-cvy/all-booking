declare const jabFilterData: {
  id: number,
  ajaxUrl: string,
}

(() =>
{
  const filterIdDataPropName = 'data-jab-filter-id'

  document.querySelectorAll(`[${filterIdDataPropName}]`).forEach( element =>
  {
    const filterId = element.getAttribute( filterIdDataPropName )

    const app = Vue.createApp({
      data: () => ({
        startTime: Date.now(),
        // todo: endTime

        results: [],
        isLoadingResults: true,

        controlValues: {},

        bookingRequestData: {},
      }),

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

          Object.entries( this.controlValues ).forEach( val => requestData.append( val[0], String( val[1] ) ) )

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
          // todo
          .catch(() => alert( 'Something goes wrong' ) )
          .finally(() => this.isLoadingResults = false)
        },
      },

      watch: {
        controlValues: {
          handler()
          {
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