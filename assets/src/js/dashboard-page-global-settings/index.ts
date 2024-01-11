($ =>
{
  const bookablePtInputs = $( '.jbk-field_bookable-entities input[type="checkbox"]' )

  const entityConnectionsFildWrapper = $( '.jbk-field_entity-connections' )

  bookablePtInputs.on( 'change', function()
  {
    const entityConnectionsFieldRow = entityConnectionsFildWrapper.closest( 'tr' )

    const bookablePtCheckedInputs = bookablePtInputs.filter( ':checked' )

    bookablePtCheckedInputs.length >= 2 ? entityConnectionsFieldRow.show() : entityConnectionsFieldRow.hide()

    entityConnectionsFildWrapper.find( '.jbk-connection' ).each(function()
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