$(document).ready(function() {
	
	$('form').on('change mousedown', 'option', function() {
		$(this).closest('form').submit();
	});
	
});