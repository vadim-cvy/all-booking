import { JabField } from "../../components/JabField"

declare const jabMetaboxData: {
  overrides: any[],
  limit: any[],
}

(()=>
{
  const app = Vue.createApp({
    data: () => ({
      overrides: jabMetaboxData.overrides,
      limit: jabMetaboxData.limit,
    }),
  })

  app.component('jab-field', JabField)

  app.mount( '#jab' )
})()