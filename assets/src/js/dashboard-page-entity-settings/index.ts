($ =>
{
  $( '#jbk-input_filter__has-filter' )
    .on( 'change', function()
    {
      const input = $( this )

      const hasFilter = input.is( ':checked' )

      input.closest( 'tr' ).nextAll().each(function()
      {
        const filterSettingRow = $( this )

        hasFilter ? filterSettingRow.show() : filterSettingRow.hide()
      })
    })
    .trigger( 'change' )
})( jQuery )