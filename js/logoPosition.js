$(document).ready(function() {
	var button = $(".carousel-control-next-icon");
	var offset = button.offset();
	var topCal = offset.top - 0.5 * ($("#main-logo").height() - button.height());
	$("#main-logo").offset({top: topCal});
	
	$( window ).resize(function() {
	  $("#main-logo").offset({top: offset.top - 0.5 * ($("#main-logo").height() - button.height())});
	
	});
	//$("footer .container .m-0").html("Called! offset = " + top: offset.top - 0.5 * ($("#main-logo").height() - button.height()));
});