$(document).ready(function() {
	
/* submit selectbox on change
=============================*/

	$('form').on('change', 'select', function() {
		console.log('dsf');
		$(this).closest('form').submit();
	});
	
/* regex check for hexi code
===================================*/
	
	function hexiRegex(self, value) {
		hex_regexp = /^#([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$/;
		
		return hex_regexp.test(value);
	}
	
/* change background colour
===========================*/
	
	function containerHex(self) {
		var name = self.attr('name'),
			value = self.val();
		
		if(hexiRegex(self,value)) {
			switch (name) {
				case 'left-colour':
					$('div.white').css('background-color', value);
					break;
					
				case 'right-colour':
					$('div.black').css('background-color', value);
					break;
			}
		}
	}

	// on keyup of input
	$('form').on('keyup', 'input[rel="container-colour"]', function() {
		containerHex($(this));
	});

	// on refresh of page
	$('input[rel="container-colour"]').each(function() {
		containerHex($(this));
	});

/* show/hide colour hexi inputs
===============================*/
	
	function paraHex(self) {
		var name = self.attr('name'),
			value = self.val(),
			span = self.prev(),
			p = self.closest('p');
		
		if(hexiRegex(self,value)) {
			span.text(value);
			p.css('color', value);
		} 
		else if(!hexiRegex(self,value) && value == '') {
			span.text(self.data('value'));
			p.css('color', self.data('value'));
		}
	}
	
	// show input on hover of span
	$('.grayscale').on('mouseover', 'span', function() {
		var self = $(this),
			input = self.next();
		
		input.fadeIn(150).focus();
	});
	
	// fadeout on unfocus
	$('.grayscale').on('focusout', 'input', function() {
		var self = $(this);
		
		self.fadeOut(150);
	});

	// on keyup of input
	$('input[rel="para-colour"]').on('keyup', function() {
		paraHex($(this));
	});

	// on refresh of page
	$('input[rel="para-colour"]').each(function() {
		paraHex($(this));
	});
	
});