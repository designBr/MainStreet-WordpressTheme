$(document).ready(function(){
	
	$('#searchIcon').bind('click', function(event) {
		$('#searchform').toggleClass('open');
	});
	
});
















//Set scroll location - this moves the page down to hide the browser url bar and such on load

//function hideAddressBar()
//{
//  if(!window.location.hash)
//  {
//      if(document.height < window.outerHeight)
//      {
//          document.body.style.height = (window.outerHeight + 50) + 'px';
//      }

//      setTimeout( function(){ window.scrollTo(0, 1); }, 50 );
//  }
//}

//window.addEventListener("load", function(){ if(!window.pageYOffset){ hideAddressBar(); } } );
//window.addEventListener("orientationchange", hideAddressBar );






