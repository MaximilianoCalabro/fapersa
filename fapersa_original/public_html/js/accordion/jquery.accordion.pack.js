/*
 * Accordion 1.4 - jQuery menu widget
 *
 * Copyright (c) 2007 Jörn Zaefferer, Frank Marcia
 *
 * http://bassistance.de/jquery-plugins/jquery-plugin-accordion/
 *
 * Dual licensed under the MIT and GPL licenses:
 *   http://www.opensource.org/licenses/mit-license.php
 *   http://www.gnu.org/licenses/gpl.html
 *
 * Revision: $Id: jquery.accordion.js 2296 2007-07-09 17:58:04Z joern.zaefferer $
 *
 */
jQuery.fn.extend({
	// nextUntil is necessary, would be nice to have this in jQuery core
	nextUntil: function(expr) {
	    var match = [];
	
	    // We need to figure out which elements to push onto the array
	    this.each(function(){
	        // Traverse through the sibling nodes
	        for( var i = this.nextSibling; i; i = i.nextSibling ) {
	            // Make sure that we're only dealing with elements
	            if ( i.nodeType != 1 ) continue;
	
	            // If we find a match then we need to stop
	            if ( jQuery.filter( expr, [i] ).r.length ) break;
	
	            // Otherwise, add it on to the stack
	            match.push( i );
	        }
	    });
	
	    return this.pushStack( match );
	},
	// the plugin method itself
	Accordion: function(settings) {
		// setup configuration
		settings = jQuery.extend({}, jQuery.Accordion.defaults, {
			// define context defaults
			header: jQuery(':first-child', this)[0].tagName // take first childs tagName as header
		}, settings);
		
		if ( settings.navigation ) {
			var current = this.find("a").filter(function() {
				if (location.href.indexOf('?') >= 0) {
					var href = location.href.substring(0, location.href.indexOf('?'));
				}else{
					var href = location.href;
				}
				return this.href == href;
			});
			if ( current.length ) {
				settings.active = current.parent().parent().prev();
				current.addClass("current");
			}
		}

		// calculate active if not specified, using the first header
		var container = this,
			active = settings.active
				? jQuery(settings.active, this)
				: settings.active === false
					? jQuery("<div>")
					: jQuery(settings.header, this).eq(0),
			running = 0;

		var headers = container.find(settings.header);

		headers
			.not(active || "")
			.nextUntil(settings.header)
			.hide();
		active.addClass(settings.selectedClass);
		
		function toggle(toShow, toHide, data, clickedActive) {
			var finished = function(cancel) {
				running = cancel ? 0 : --running;
				if ( running )
					return;

				// trigger custom change event
				container.trigger("change", data);
			};
			
			// count elements to animate
			running = toHide.size() + toShow.size();
			
			if ( settings.animated ) {
				if ( !settings.alwaysOpen && clickedActive ) {
					toShow.slideToggle(settings.showSpeed);
					finished(true);
				} else {
					toHide.filter(":hidden").each(finished).end().filter(":visible").slideUp(settings.hideSpeed, finished);
					toShow.slideDown(settings.showSpeed, finished);
				}
			} else {
				if ( !settings.alwaysOpen && clickedActive ) {
					toShow.toggle();
				} else {
					toHide.hide();
					toShow.show();
				}
				finished(true);
			}
		}
		
		function clickHandler(event) {
			if ( !event.target && !settings.alwaysOpen ) {
				active.toggleClass(settings.selectedClass);
				var toHide = active.nextUntil(settings.header);
				var toShow = active = jQuery([]);
				toggle( toShow, toHide );
			}
			// get the click target
			var clicked = jQuery(event.target);
			
			// due to the event delegation model, we have to check if one
			// of the parent elements is our actual header, and find that
			// TODO replace with parentUntil!
			if ( clicked.parents(settings.header).length )
				while ( !clicked.is(settings.header) )
					clicked = clicked.parent();
			
			var clickedActive = clicked[0] == active[0];
			
			// if animations are still active, or the active header is the target, ignore click
			if(running || (settings.alwaysOpen && clickedActive) || !clicked.is(settings.header))
				return;

			// switch classes
			active.toggleClass(settings.selectedClass);
			if ( !clickedActive ) {
				clicked.addClass(settings.selectedClass);
			}

			// find elements to show and hide
			var toShow = clicked.nextUntil(settings.header),
				toHide = active.nextUntil(settings.header),
				data = [clicked, active, toShow, toHide];

			active = clickedActive ? jQuery([]) : clicked;
			
			toggle( toShow, toHide, data, clickedActive );

			return !toShow.length;
		};
		function activateHandler(event, index) {
			if ( index == null )
				return;
			// call clickHandler with custom event
			clickHandler({
				target: index >= 0
					? jQuery(settings.header, this)[index]
					: typeof index == "string"
						? jQuery(index, this)[0]
						: null
			});
		};

		container.bind("activate", activateHandler);
		return container.bind(settings.event, clickHandler)
	},
	// programmatic triggering
	activate: function(index) {
		return this.trigger('activate', [index]);
	}
});

jQuery.Accordion = {};
jQuery.extend(jQuery.Accordion, {
	defaults: {
		selectedClass: "selected",
		showSpeed: 'fast',
		hideSpeed: 'fast',
		alwaysOpen: true,
		animated: true,
		event: "click"
	}
});