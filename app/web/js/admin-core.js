(function ($) {
	$(function () {
		$(".cms-table tbody tr").hover(
			function () {
				$(this).addClass("hover");
			}, 
			function () {
				$(this).removeClass("hover");
			}
		);
		$(".button").hover(
			function () {
				$(this).addClass("button_hover");
			}, 
			function () {
				$(this).removeClass("button_hover");
			}
		);
		
		$.ajaxSetup({
			jsonp: null,
			jsonpCallback: null
		});
	});
	
	$("td.scms_item_name").live("click", function (e) {
		var edit_url = $(this).attr("axis");
		$(location).attr('href',edit_url);
	});
	
	
})(jQuery);