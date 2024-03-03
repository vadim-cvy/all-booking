import { JabField } from "./components/JabField"
import { JabItemsList } from "./components/JabItemsList"

declare const jabFiltersSettingsPage: {
  filters: any[],
  pts: any[],
}

(()=>
{
  const app = Vue.createApp({
    data: () => ({
      filters: jabFiltersSettingsPage.filters,
      pts: jabFiltersSettingsPage.pts,
    }),
  })

  app.component('jab-items-list', JabItemsList)
  app.component('jab-field', JabField)

  app.mount( '#jab-filters' )
})()