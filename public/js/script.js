"use strict";
var vswpssSlideIndex = 1;
var vswpssSlides;
var vswpssDots;
var vswpssI;
var vswpssDots;
(function($) {
	jQuery(document).ready(function() {
		jQuery('.vswpss-paint').each(function (key) {
			vswpssShowvswpssSlides(vswpssSlideIndex, key);
		});

		//view next pre
		jQuery('.vswpssnumber').click(function() {
			//slideshow
			vswpssShowvswpssSlides(vswpssSlideIndex = parseInt(jQuery(this).attr('vswpssnumber')), jQuery(this).attr('vswpssid'));
		});
		jQuery('.vswpssnumberpre').click(function() {
			//slideshow
			vswpssShowvswpssSlides(vswpssSlideIndex = parseInt(vswpssSlideIndex) + parseInt(jQuery(this).attr('vswpssnumber')), jQuery(this).attr('vswpssid'));
		});	

		function vswpssShowvswpssSlides(n, id) {
			vswpssSlides = document.getElementsByClassName('vswpss-slides-' + id);
			vswpssDots = document.getElementsByClassName('vswpss-dot-' + id);
			if(n > vswpssSlides.length) {
				vswpssSlideIndex = 1;
			}    
			if(n < 1) {
				vswpssSlideIndex = vswpssSlides.length;
			}
			for(vswpssI = 0; vswpssI < vswpssSlides.length; vswpssI++) {
				vswpssSlides[vswpssI].style.display = 'none';  
			}
			for(vswpssI = 0; vswpssI < vswpssDots.length; vswpssI++) {
				vswpssDots[vswpssI].className = vswpssDots[vswpssI].className.replace(' vswpss-active', '');
			}
			vswpssSlides[vswpssSlideIndex-1].style.display = 'block';  
			vswpssDots[vswpssSlideIndex-1].className += ' vswpss-active';
		}
	});	
})(jQuery);