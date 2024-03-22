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

      copyTextOnClick( e: MouseEvent )
      {
        const target = e.target as HTMLElement;

        const textToCopy = target.innerText;

        const textArea = document.createElement('textarea');
        textArea.value = textToCopy;

        textArea.style.top = "0";
        textArea.style.left = "0";
        textArea.style.position = "fixed";

        document.body.appendChild(textArea);
        textArea.focus();
        textArea.select();

        try
        {
          document.execCommand('copy');
          alert('Copied successfully!');
        }
        catch (err)
        {
          alert('Failed to copy text.');
        }

        document.body.removeChild(textArea);
      },
    }
  })

  app.component('jab-items-list', JabItemsList)
  app.component('jab-field', JabField)

  app.mount( '#jab-global-settings-page-content' )
})()