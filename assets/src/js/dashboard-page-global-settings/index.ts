($ =>
{
  const bookablePtInputs = $( '.jbk-field_bookable_entities input[type="checkbox"]' );

  bookablePtInputs.on( 'change', function()
  {
    const entityConnectionsFieldRow = $( '.jbk-field_entity_connections' ).closest( 'tr' )

    const bookablePtCheckedInputs = bookablePtInputs.filter( ':checked' )

    bookablePtCheckedInputs.length >= 2 ? entityConnectionsFieldRow.show() : entityConnectionsFieldRow.hide()

    $( '.jbk-field_entity_connections .jbk-field__value > div' ).each(function()
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