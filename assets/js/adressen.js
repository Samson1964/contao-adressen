(function($) {
	$(document).ready(function() {

		function copy() {
			// Die markierten Elemente selektieren
			var elements = $("input.email_aktiv:checked");
			
			// Schleife über die einzelnen Elemente
			$.each(elements, function(index, item) 
			{
				alert("Value:" + $(this).val());
			});
		}

	});
})(jQuery);
