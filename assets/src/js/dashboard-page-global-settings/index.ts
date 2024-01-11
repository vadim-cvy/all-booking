($ =>
{
  const bookablePtInputs = $( '.jbk-field_common__bookable-pts input[type="checkbox"]' )

  const ptConnectionsFildWrapper = $( '.jbk-field_common__pt-connections' )

  bookablePtInputs.on( 'change', function()
  {
    const ptConnectionsFieldRow = ptConnectionsFildWrapper.closest( 'tr' )

    const bookablePtCheckedInputs = bookablePtInputs.filter( ':checked' )

    bookablePtCheckedInputs.length >= 2 ? ptConnectionsFieldRow.show() : ptConnectionsFieldRow.hide()

    ptConnectionsFildWrapper.find( '.jbk-connection' ).each(function()
    {
      const div = $( this )

      div.show()

      for( const ptSlug of div.data( 'pts' ) )
      {
        if ( ! bookablePtCheckedInputs.filter( `[value="${ptSlug}"]` ).length )
        {
          div.hide()
        }
      }
    })
  })

  bookablePtInputs.trigger( 'change' )
})( jQuery )