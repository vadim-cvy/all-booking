import { JabField } from "../../components/JabField"
import { JabItemsList } from "../../components/JabItemsList"

declare const jabGlobalSettingsPage: {
  settings: {
    filters: any[],
  },
  pts: any[],
}

(()=>
{
  const app = Vue.createApp({
    data: () => ({
      settings: jabGlobalSettingsPage.settings,
      pts: jabGlobalSettingsPage.pts,
    }),

    methods: {
      generateUniqueId()
      {
        return '' + Math.floor( Date.now() / 1000 ) + Math.floor( Math.random() * 100000 )
      },
    }
  })

  app.component('jab-items-list', JabItemsList)
  app.component('jab-field', JabField)

  app.mount( '#jab-global-settings-page-content' )
})()