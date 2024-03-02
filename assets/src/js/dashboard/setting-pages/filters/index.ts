import { JabField } from "./components/JbkField"
import { JabItemsList } from "./components/JbkItemsList"

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