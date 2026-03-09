( function( api ) {

	// Extends our custom "architecture-designer" section.
	api.sectionConstructor['architecture-designer'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );