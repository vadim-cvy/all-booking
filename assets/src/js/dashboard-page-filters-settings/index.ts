import { JbkItemsList } from "./components/JbkItemsList"
import { JbkField } from "./components/JbkField"

declare const jbkDashboardPageFiltersSettingsIndexData: {
  filters: any[],
  pts: any[],
}

(()=>
{
  const app = Vue.createApp({
    data: () => ({
      filters: jbkDashboardPageFiltersSettingsIndexData.filters,
      pts: jbkDashboardPageFiltersSettingsIndexData.pts,
    }),

    watch: {
      filters: {
        deep: true,
        handler: function (newVal, oldVal)
        {
          for ( const [ filterIndex, filter ] of newVal.entries() )
          {
            if ( filter.source_pt !== oldVal[ filterIndex ].source_pt )
            {
              filter.popup.fields[0].pt = filter.source_pt
            }
          }
        },
      },
    },
  })

  app.component('jbk-items-list', JbkItemsList)
  app.component('jbk-field', JbkField)

  app.mount( '#jbk-filters' )
})()