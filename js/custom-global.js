

// remove loading animation once document has loaded
function docLoaded() {
	$('body').removeClass('loading');
}

$(document).ready(function(){
	
	// set content area scrolling
	if (!$('body').hasClass('home')) {
		var pageScroll;
		setTimeout(function () {
			pageScroll = new iScroll("content", {checkDOMChanges: true});
		}, 100);
	}
	
	$('#searchsubmit').val('Go')
	
	// set up the search box text
	var searchDefault = "Search for...";
	var search = $('#s');
	search.bind('focus', function() {
		if (this.value == searchDefault) {this.value = ''; $(this).addClass("w-input");}
	}).bind('blur', function() {
		if (this.value == '') { this.value = searchDefault; $(this).removeClass("w-input");}
	});
	search[0].value = searchDefault;
	
}); // end doc ready