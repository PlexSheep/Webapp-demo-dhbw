$( "#delForm" ).on( "submit", function( event ) {
alert( "Handler for `submit` called." );
event.preventDefault();
});

$( "#other" ).on( "click", function() {
$( "#target" ).trigger( "submit" );
} );


