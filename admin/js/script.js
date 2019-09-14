"use strict";
var vswpssArrayStart = [];
vswpssArrayStart['vswpssDataImg'] = [];
vswpssArrayStart['vswpssDataColor'] = [];
vswpssArrayStart['vswpssDataColorText'] = [];
vswpssArrayStart['vswpssDataBackgroundColorText'] = [];
vswpssArrayStart['vswpssDataText'] = [];
vswpssArrayStart['vswpssDataImg'][0] = '';
vswpssArrayStart['vswpssDataColor'][0] = '';
vswpssArrayStart['vswpssDataColorText'][0] = '';
vswpssArrayStart['vswpssDataBackgroundColorText'][0] = '';
vswpssArrayStart['vswpssDataText'][0] = '';
var vswpssCount = 0;
var vswpssCountNew;
var vswpTotalSlides;
var vswpssArrayImg = [];
var vswpssArrayColorText = [];
var vswpssArrayBackgroundColorText = [];
var vswpssArrayText = [];
var vswpssDataSaveImg = [];
var vswpssDataSaveColorText = [];
var vswpssDataSaveText = [];
var vswpssArraySaved;
var vswpssSavedTitle;
var vswpssSavedHeight;
var vswpssSavedWidth;
var vswpssSavedImg;
var vswpssSavedcolorText;
var vswpssSavedText;
var vswpssHeight;
var vswpssTitle;
var vswpssTitleHeightWidth = [];
var vswpssNSlides;
var vswpssSlideIndex;
var vswpssI;
var vswpssSlides;
var vswpssDot;
var vswpssHtml;
var vswpNumber;
var vswpssWidthSlides;
var vswpssAddBackgroundColorText;
var vswpssSavedBackground;
(function($) {
	jQuery(document).ready(function() {
		//reset form
		vswpssStart();
		//reset form function
		function vswpssReboot(id, vswpssCountTotal) {
			//delete form
			vswpssDeleteSlides();
			vswpssCountNew = 1;
			for(vswpssCount = 0; vswpssCount < vswpssCountTotal; vswpssCount++) {
				if(id['vswpssDataText'][vswpssCount] == undefined) {
					id['vswpssDataText'][vswpssCount] = '';
				}
				if(!id['vswpssDataColorText'][vswpssCount]) {
					id['vswpssDataColorText'][vswpssCount] = '#ffffff';
				}
				if(!id['vswpssDataBackgroundColorText'][vswpssCount]) {
					id['vswpssDataBackgroundColorText'][vswpssCount] = '#000000';
				}
				jQuery('#vswpss-add-img').append('<p>' + vswpssCountNew + ' <input class="vswpss-add-img-new" type="text" required /></p>');
				jQuery('#vswpss-add-color-text').append('<p>' + vswpssCountNew + ' <input class="vswpss-add-color-text-new" type="color" value="' + id['vswpssDataColorText'][vswpssCount] + '" required /></p>');
				jQuery('#vswpss-add-background-color-text').append('<p>' + vswpssCountNew + ' <input class="vswpss-add-background-color-text-new" type="color" value="' + id['vswpssDataBackgroundColorText'][vswpssCount] + '" required /></p>');
				jQuery('#vswpss-add-text').append('<p>' + vswpssCountNew + ' <input class="vswpss-add-text-new" type="text" value=\'' + id['vswpssDataText'][vswpssCount] + '\' required /></p>');
				vswpssCountNew++;
			}
		}
		//reset form
		function vswpssStart() {
			vswpssReboot(vswpssArrayStart, 1);	
		}
		//if you change number of slides
		jQuery('#vswpss-n-slides').change(function () {
			vswpTotalSlides = jQuery(this).val();
			//reiniciar formulario
			vswpssReboot(vswpssArrayStart, vswpTotalSlides);
		});
		//delete form function
		function vswpssDeleteSlides() {
			jQuery('#vswpss-add-img').html('');
			jQuery('#vswpss-add-color-text').html('');
			jQuery('#vswpss-add-background-color-text').html('');
			jQuery('#vswpss-add-text').html('');
		}
		//saving saves data
		jQuery('#vswpss-add-slideshow').on('submit', function() {
			//post values ​​in array
			vswpssPostValues();
		});
		//post variable load
		function vswpssPostValues() {
			//delete post array values
			vswpssDeleteValues();
			jQuery('.vswpss-add-img-new').each(function () {
				vswpssArrayImg.push(jQuery(this).val());
			});
			jQuery('#vswpss-data-save-img').val(vswpssArrayImg);			
			
			jQuery('.vswpss-add-color-text-new').each(function () {
				vswpssArrayColorText.push(jQuery(this).val());
			});
			jQuery('#vswpss-data-save-color-text').val(vswpssArrayColorText);
			
			jQuery('.vswpss-add-background-color-text-new').each(function () {
				vswpssArrayBackgroundColorText.push(jQuery(this).val());
			});
			jQuery('#vswpss-data-save-background-color-text').val(vswpssArrayBackgroundColorText);
			
			jQuery('.vswpss-add-text-new').each(function () {
				vswpssArrayText.push(jQuery(this).val());
			});
			jQuery('#vswpss-data-save-text').val(vswpssArrayText);		
		}
		//delete post array values function
		function vswpssDeleteValues() {
			vswpssArrayImg = [];
			vswpssArrayColorText = [];
			vswpssArrayBackgroundColorText = [];
			vswpssArrayText = [];
			jQuery('#vswpss-data-save-img').val('');
			jQuery('#vswpss-data-save-color').val('');
			jQuery('#vswpss-data-save-color-text').val('');
			jQuery('#vswpss-data-save-background-color-text').val('');
			jQuery('#vswpss-data-save-text').val('');
		}
		//preview
		jQuery('#vswpss-link-data-slideshow').click(function () {
			jQuery('#vswpss-paint').html('');
			vswpssPreView(1);
		});		
		//reset
		jQuery('#vswpss-reset').click(function () {
			location.reload();
		});	
		//html load
		function vswpssPreView(id) {
			if(id == 1) {
				vswpssHeight = jQuery('#vswpss-height-slides').val();
				vswpssWidthSlides = jQuery('#vswpss-width-slides').val();
				vswpssTitle = jQuery('#vswpss-title').val();
				vswpssNSlides = jQuery('#vswpss-n-slides').val();
				//post array values
				vswpssPostValues();
			} else {
				vswpssHeight = id[1];
				vswpssWidthSlides = id[3]
				vswpssTitle = id[0];
				vswpssNSlides = id[2];
				jQuery('#vswpss-id-slideshow-edit').val(id[4]);
			}
			//arrays values
			vswpssDataSaveImg = jQuery('#vswpss-data-save-img').val().split(',');
			vswpssDataSaveColorText = jQuery('#vswpss-data-save-color-text').val().split(',');
			vswpssDataSaveText = jQuery('#vswpss-data-save-text').val().split(',');
			vswpssAddBackgroundColorText = jQuery('#vswpss-data-save-background-color-text').val().split(',');
			jQuery('#vswpss-title').val(vswpssTitle);
			jQuery('#vswpss-width-slides').val(vswpssWidthSlides);
			jQuery('#vswpss-height-slides').val(vswpssHeight);
			jQuery('#vswpss-n-slides').val(vswpssDataSaveImg.length);
			vswpssArrayStart['vswpssDataImg'] = vswpssDataSaveImg;
			vswpssArrayStart['vswpssDataColorText'] = vswpssDataSaveColorText;
			vswpssArrayStart['vswpssDataText'] = vswpssDataSaveText;
			vswpssArrayStart['vswpssAddBackgroundColorText'] = vswpssAddBackgroundColorText;
			vswpssSlideIndex = 1;
			vswpssHtml = '<p style="text-align:center">' + vswpssTitle + '</p>' +
				'<div class="vswpss-slideshow-container" style="width:' + vswpssWidthSlides + '%; height:' + vswpssHeight + 'px">' +
					'<a class="vswpss-prev vswpnumberpre" vswpnumber="-1">&#10094;</a>' +
					'<a class="vswpss-next vswpnumberpre" vswpnumber="1">&#10095;</a>' +
				'</div>' +
				'<div style="text-align:center"></div>' +
				'<br><div id="vswpss-current-slide" style="text-align:center"></div>';
			jQuery('#vswpss-paint').append(vswpssHtml);
			for(vswpssCount = 0; vswpssCount < vswpssNSlides; vswpssCount++) {
				vswpNumber = parseInt(vswpssCount) + parseInt(1);
				jQuery('.vswpss-slideshow-container').append('<div id="vswpss-slide-new" class="vswpss-slides vswpss-fade">' +
						'<div class="vswpss-numbertext" style="color:' + 
							vswpssDataSaveColorText[vswpssCount] + 
							';background-color:' + 
							vswpssAddBackgroundColorText[vswpssCount] + 
							';opacity: 0.7;">' + 
							vswpNumber + ' / ' + vswpssNSlides + '</div>' +
						'<img class="vswpss-img" src="' + vswpssDataSaveImg[vswpssCount] + 
							'" style="width:100%; height:' + vswpssHeight + 'px;" />' +
						'<div class="vswpss-text" style="width:100%;color:' 
							+ vswpssDataSaveColorText[vswpssCount] + 
							';background-color:' + 
							vswpssAddBackgroundColorText[vswpssCount] + 
							';opacity: 0.7;">' + 
							vswpssDataSaveText[vswpssCount] + 
							'</div>' +
					'</div>');
				jQuery('#vswpss-current-slide').append('<span class="vswpss-dot vswpnumber" vswpnumber="' + vswpNumber + '"></span>');
			}
			jQuery('#vswpss-paint').fadeIn(3000);
			vswpssShowSlides(vswpssSlideIndex);
		}		
		//slideshow
		function vswpssShowSlides(n) {
			vswpssSlides = document.getElementsByClassName('vswpss-slides');
			vswpssDot = document.getElementsByClassName('vswpss-dot');
			if(n > vswpssSlides.length) {
				vswpssSlideIndex = 1;
			}    
			if(n < 1) {
				vswpssSlideIndex = vswpssSlides.length;
			}
			for (vswpssI = 0; vswpssI < vswpssSlides.length; vswpssI++) {
				vswpssSlides[vswpssI].style.display = 'none';  
			}
			for (vswpssI = 0; vswpssI < vswpssDot.length; vswpssI++) {
				vswpssDot[vswpssI].className = vswpssDot[vswpssI].className.replace(' vswpss-active', '');
			}
			vswpssSlides[vswpssSlideIndex-1].style.display = 'block';  
			vswpssDot[vswpssSlideIndex-1].className += ' vswpss-active';
		}
		//view next pre
		jQuery(document).on('click', '.vswpnumber', function() {
			//slideshow
			vswpssShowSlides(vswpssSlideIndex = jQuery(this).attr('vswpnumber'));
		});
		jQuery(document).on('click', '.vswpnumberpre', function() {
			//slideshow
			vswpssShowSlides(vswpssSlideIndex += parseInt(jQuery(this).attr('vswpnumber')));
		});		


		//view saved
		jQuery('.vswpss-view-input').click(function() {
			jQuery('#vswpss-paint').html('');
			vswpssArraySaved = jQuery('#' + jQuery(this).attr('vswpssId')).attr('viewSlideShow').split('vswpslideshow')[1];
			vswpssSavedTitle = vswpssArraySaved.split(',')[1].split('title=')[1];
			vswpssSavedWidth = vswpssArraySaved.split(',')[2].split('width=')[1];
			vswpssSavedHeight = vswpssArraySaved.split(',')[3].split('height=')[1];
			vswpssSavedImg = vswpssArraySaved.split(',')[4].split('images=')[1].split('vswpss');
			vswpssSavedcolorText = vswpssArraySaved.split(',')[5].split('color=')[1].split('vswpss');
			vswpssSavedBackground = vswpssArraySaved.split(',')[6].split('background=')[1].split('vswpss');
			vswpssSavedText = vswpssArraySaved.split(',')[7].split('text=')[1].split('vswpss');
			jQuery('#vswpss-data-save-img').val(vswpssSavedImg);
			jQuery('#vswpss-data-save-color-text').val(vswpssSavedcolorText);
			jQuery('#vswpss-data-save-background-color-text').val(vswpssSavedBackground);
			jQuery('#vswpss-data-save-text').val(vswpssSavedText);
			vswpssTitleHeightWidth[0] = vswpssSavedTitle;
			vswpssTitleHeightWidth[1] = vswpssSavedHeight;
			vswpssTitleHeightWidth[2] = vswpssSavedImg.length;
			vswpssTitleHeightWidth[3] = vswpssSavedWidth;
			vswpssTitleHeightWidth[4] = jQuery(this).attr('vswpssId');
			//html load
			vswpssPreView(vswpssTitleHeightWidth);
			//delete form
			vswpssDeleteSlides();
			jQuery('#vswpss-title').val(vswpssSavedTitle);
			jQuery('#vswpss-n-slides').val(vswpssSavedImg.length);
			jQuery('#vswpss-width-slides').val(vswpssSavedWidth);
			jQuery('#vswpss-height-slides').val(vswpssSavedHeight);
			vswpssCountNew = 1;
			for(vswpssCount = 0; vswpssCount < vswpssSavedImg.length; vswpssCount++) {
				jQuery('#vswpss-add-img').append('<p>' + vswpssCountNew + ' <input class="vswpss-add-img-new" value="' + vswpssSavedImg[vswpssCount] + '" type="text" required /></p>');
				jQuery('#vswpss-add-color-text').append('<p>' + vswpssCountNew + ' <input class="vswpss-add-color-text-new" type="color" value="' + vswpssSavedcolorText[vswpssCount] + '" required /></p>');
				jQuery('#vswpss-add-background-color-text').append('<p>' + vswpssCountNew + ' <input class="vswpss-add-background-color-text-new" type="color" value="' + vswpssSavedBackground[vswpssCount] + '" required /></p>');
				jQuery('#vswpss-add-text').append('<p>' + vswpssCountNew + ' <input class="vswpss-add-text-new" type="text" value=\'' + vswpssSavedText[vswpssCount] + '\' required /></p>');
				vswpssCountNew++;				
			}
			jQuery('.vswpss-help-slideshow').fadeIn('slow');
			jQuery('body, html').animate({
				scrollTop: '0px'
			}, 300);
			jQuery('.vswpss-help-slideshow').delay(3000).fadeOut();
		});
		//copy code shortcodes
		jQuery('.vswpss-copy-slideshow').on('click', function() {
			var aux = document.createElement('input');
			jQuery(aux).val(jQuery(this).attr('copy'));
			document.body.appendChild(aux);
			aux.select();
			document.execCommand('copy');
			document.body.removeChild(aux);
		});
	});
})(jQuery);