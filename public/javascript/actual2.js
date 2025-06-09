$(document).ready(function() {
	var $grid = $('.grid').packery({
	  itemSelector: '.grid-item',
	  // columnWidth helps with drop positioning
	  columnWidth: 100
	});

	// make all items draggable
	var $items = $grid.find('.grid-item').draggable();
	// bind drag events to Packery
	$grid.packery( 'bindUIDraggableEvents', $items );

	function orderItems() {
	  var itemElems = $grid.packery('getItemElements');
	  $( itemElems ).each( function( i, itemElem ) {
	    $( itemElem ).text( i + 1 );
	  });
	}

	$grid.on( 'layoutComplete', orderItems );
	$grid.on( 'dragItemPositioned', orderItems );
});
