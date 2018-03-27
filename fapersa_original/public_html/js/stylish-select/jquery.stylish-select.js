/*
Stylish Select 0.2.2 - jQuery plugin to replace a select drop down box with a stylable unordered list
http://scottdarby.com/

Copyright (c) 2009 Scott Darby

Requires: jQuery 1.3

Licensed under the GPL license:
http://www.gnu.org/licenses/gpl.html
*/

//create cross-browser indexOf
Array.prototype.indexOf = function (obj, start) {
	for (var i = (start || 0); i < this.length; i++) {
		if (this[i] == obj) {
			return i;
		}
	}
}

jQuery.fn.sSelect = function(options) {
	
  return this.each(function(){
	  
	var defaults = {
		defaultText: 'Please select'
	};

	//initial variables
	var opts = jQuery.extend(defaults, options),
		$input = jQuery(this),
		$containerDivText = jQuery('<div class="selectedTxt"></div>'),
		$newUl = jQuery('<ul class="newList"></ul>'),
		$containerDiv = jQuery('<div class="newListSelected" tabindex="0"></div>'),
		itemIndex = -1,
		currentIndex = -1,
		keys = [],
		prevKey = false,
		newListItems = '';

		//build new list
		$containerDiv.insertAfter($input);
		$containerDivText.prependTo($containerDiv);
		$newUl.appendTo($containerDiv);
		$input.hide();

	//test for optgroup
	if ($input.children('optgroup').length == 0){
		$input.children().each(function(i){
			var option = jQuery(this).text();
			//add first letter of each word to array
			keys.push(option.charAt(0).toLowerCase());
			if (jQuery(this).attr('selected') == true){
				opts.defaultText = option;
				currentIndex = i;
			}
			newListItems += '<li>'+option+'</li>';
		});
		//add new list items to ul
		$newUl.html(newListItems);
		//cache list items object
		var $newLi = $newUl.children();
	} else { //optgroup
		$input.children('optgroup').each(function(i){
		
			var optionTitle = jQuery(this).attr('label'),
				$optGroup = jQuery('<li class="newListOptionTitle">'+optionTitle+'</li>');
				
			$optGroup.appendTo($newUl);

			var $optGroupList = jQuery('<ul></ul>');

			$optGroupList.appendTo($optGroup);

			jQuery(this).children().each(function(){
				++itemIndex;
				var option = jQuery(this).text();
				//add first letter of each word to array
				keys.push(option.charAt(0).toLowerCase());
				if (jQuery(this).attr('selected') == true){
					opts.defaultText = option;
					currentIndex = itemIndex;
				}
				newListItems += '<li>'+option+'</li>';
			})
			//add new list items to ul
			$optGroupList.html(newListItems);
			newListItems = '';
		});
		//cache list items object
		var $newLi = $newUl.find('ul li');
	}

	//check if a value is selected
	if (currentIndex != -1){
		navigateList(currentIndex);
	} else {
		//set placeholder text
		$containerDivText.text(opts.defaultText);
	}

	var newLiLength = $newLi.length;

	//decide if to place the new list above or below the drop-down
	function newUlPos(){
		var containerPosY = $containerDiv.offset().top,
			containerHeight = $containerDiv.height()+3,
			scrollTop = jQuery(window).scrollTop(),
			docHeight = jQuery(window).height(),
			newUlHeight = $newUl.height()+3;
		
		containerPosY = containerPosY-scrollTop;
		if (containerPosY+newUlHeight >= docHeight){
			$newUl.css('top', '-'+newUlHeight+'px');
		} else {
			$newUl.css('top', containerHeight+'px');
		}
	}

	//run function on page load
	newUlPos();
	
	//run function on browser window resize
	jQuery(window).resize(function(e){
		newUlPos(e);
	});
	
	jQuery(window).scroll(function(e){
		newUlPos(e);
	});

	//positioning
	function positionFix(){
		$containerDiv.css('position','relative');
	}

	function positionHideFix(){
		$containerDiv.css('position','static');
	}
	
    $containerDivText.click(function(){
	
		if ($newUl.is(':visible')){
			$newUl.hide();
			positionHideFix()
			return false;
		}
		
		$containerDiv.focus();

		//show list
		$newUl.slideDown('fast');
		positionFix();
		
		//when keys are pressed
		document.onkeydown = function(e){
			if (e == null) { // ie
				var keycode = event.keyCode;
			} else { // everything else
				var keycode = e.which;
			}
			//enter key or esc key pressed, hide list
			if(keycode == 13 || keycode == 27){
				$newUl.hide();
				positionHideFix();
				return false;
			}
		}
	});
		
	//hide list on blur
    $containerDiv.blur(function(){
       $newUl.hide();
	   positionHideFix();
    });

    $containerDivText.hover(function(e) {
		var $hoveredTxt = jQuery(e.target);
        $hoveredTxt.addClass('newListSelHover');
      }, 
      function (e) {
		var $hoveredTxt = jQuery(e.target);
        $hoveredTxt.removeClass('newListSelHover');
      }
    );

    $newLi.hover(
      function (e) {
		var $hoveredLi = jQuery(e.target);
        $hoveredLi.addClass('newListHover');
      },
      function (e) {
		var $hoveredLi = jQuery(e.target);
        $hoveredLi.removeClass('newListHover');
      }
    );

    $newLi.click(function(e){
		var $clickedLi = jQuery(e.target),
			text = $clickedLi.text();
		
        //update counter
        currentIndex = $newLi.index($clickedLi);
        //remove all hilites, then add hilite to selected item
        $newLi.removeClass('hiLite');
        $clickedLi.addClass('hiLite');
        
		setSelectText(text);
        $newUl.hide();
		$containerDiv.css('position','static');//ie
    });

	function setSelectText(text){
		//set text of select box
        $input.val(text).change();	
        $containerDivText.text(text);
	}

    //handle up and down keys
    function keyPress(element) {
        //when keys are pressed
        element.onkeydown = function(e){
            if (e == null) { //ie
                var keycode = event.keyCode;
            } else { //everything else
                var keycode = e.which;
            }

            switch(keycode)
            {
            case 40: //down
			case 39: //right
				incrementList();
				return false;
				break;
			case 38: //up
			case 37: //left
				decrementList();
				return false;
				break;
			case 33: //page up
			case 36: //home
				gotoFirst();
				return false;
				break;
			case 34: //page down
			case 35: //end
				gotoLast();
				return false;
				break;
            }

			//check for keyboard shortcuts
			keyPressed = String.fromCharCode(keycode).toLowerCase();
			var currentKeyIndex = keys.indexOf(keyPressed);
			if (typeof currentKeyIndex != 'undefined') { //if key code found in array
				e.preventDefault();
				++currentIndex;
				currentIndex = keys.indexOf(keyPressed, currentIndex); //search array from current index
				if (currentIndex == -1 || currentIndex == null || prevKey != keyPressed) currentIndex = keys.indexOf(keyPressed); //if no entry was found or new key pressed search from start of array
				navigateList(currentIndex);
				//store last key pressed
				prevKey = keyPressed;
			}
        }
    }

	function incrementList(){
		if (currentIndex < (newLiLength-1)) {
			++currentIndex;
			navigateList(currentIndex);
		}
	}

	function decrementList(){
		if (currentIndex > 0) {
			--currentIndex;
			navigateList(currentIndex);
		}
	}

	function gotoFirst(){
		currentIndex = 0;
		navigateList(currentIndex);
	}
	
	function gotoLast(e){
		currentIndex = newLiLength-1;
		navigateList(currentIndex);
	}
	
	function navigateList(currentIndex){
		$newLi.removeClass('hiLite')
			.eq(currentIndex).addClass('hiLite');
        var text = $newLi.eq(currentIndex).text();
		setSelectText(text);
	}
	
    $containerDiv.focus(function(){
        keyPress(this);
    });

    $containerDiv.click(function(){
        keyPress(this);
    });

  });
};