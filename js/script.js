$(document).ready(function() {
	var grid = $('.grid');

	grid.masonry({
		itemSelector: '.grid-item',
		columnWidth: 10,
		isFitWidth: true
		
		
	});

	grid.infinitescroll({
		// Pagination element that will be hidden
		navSelector: '#pagination',

		// Next page link
		nextSelector: '#next_page',

		// Selector of items to retrieve
		itemSelector: '.grid-item',

		// Loading message
		loadingText: 'Loading new items…'
	},

	// Function called once the elements are retrieved
	function(new_elts) {
		var elts = $(new_elts).css('opacity', 1);

		elts.animate({opacity: 1});
		grid.masonry('appended', elts);
	});
});
