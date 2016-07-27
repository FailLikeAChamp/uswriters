$(document).ready(function() {
	$(".dismissable").click(function() {
		$(this).closest("div.row").remove();
	});
});