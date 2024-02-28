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
  })

  app.component('jbk-items-list', JbkItemsList)
  app.component('jbk-field', JbkField)

  app.mount( '#jbk-filters' )
})()