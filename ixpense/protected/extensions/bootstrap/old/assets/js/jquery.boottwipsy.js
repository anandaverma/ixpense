/*!
 * Bootstrap Twipsy jQuery plugin file.
 * @author Christoffer Niska <ChristofferNiska@gmail.com>
 * @copyright  Copyright &copy; Christoffer Niska 2011-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @see http://twitter.github.com/bootstrap
 */

(function($) {

	/**
	 * Plugin default settings.
	 * @type Object
	 */
	var defaults = {
		placement: 'above',
		showEvent: 'mouseenter',
		hideEvent: 'mouseleave',
		live: false
	};

	/**
	 * Private plugin methods.
	 * @type Object
	 */
	var methods = {
		/**
		 * Initializes the plugin.
		 * @param {Object} options The plugin options.
		 * - placement: The placement of the tooltip, valid options are: 'above', 'right', 'below' and 'left'.
		 * - showEvent: The mouse event on which to show the tooltip. Defaults to 'mouseenter'.
		 * - hideEvent: The mouse event on which to hide the tooltip. Defaults to 'mouseleave'.
		 * - live: Whether to use the live or bind method. Defaults to false, meaning that 'bind' will be used.
		 */
		init: function( options ) {
			var settings = $.extend( defaults, options || {} ),
				twipsy = methods.createTwipsy( settings.placement );
			
			return this.each(function() {
				var element = $( this ),
					title = element.attr( 'title' );

				if ( title && title.length > 0 ) {
					var data = methods._data( element ),
						binder = settings.live ? 'live' : 'bind';

					element.removeAttr( 'title' ); // remove the title to prevent it being displayed
					element.attr( 'data-title', title);

					data.twipsy = twipsy;
					data.placement = settings.placement;
					data.visible = false;

					element[ binder ]( settings.showEvent, function( e ) {
						methods.show( element );
					});

					element[ binder ]( settings.hideEvent, function( e ) {
						methods.hide( element );
					});
				}
			});
		},
		/**
		 * Creates the twipsy element.
		 * We only need to create one because we re-use it over and over.
		 * @param {String} placement The placement for the tooltip.
		 */
		createTwipsy: function( placement ) {
			var twipsy = $( '<div class="twipsy ' + placement + '">' )
					.appendTo( 'body' )
					.hide();

			$( '<div class="twipsy-arrow">' )
					.appendTo( twipsy );

			$( '<div class="twipsy-inner">' )
					.appendTo( twipsy );

			return twipsy;
		},
		/**
		 * Shows the tooltip.
		 * @param {Object} element The element for which to show the tooltip.
		 */
		show: function( element ) {
			var data = methods._data( element );

			if ( !data.visible ) {
				var position;
				data.twipsy.find( '.twipsy-inner' ).html( element.attr( 'data-title' ) );
				position = methods._pos( element );
				data.twipsy.css( {
					top: position.top,
					left: position.left
				} ).show(); // todo: implement support for effects.

				data.visible = true;
			}
		},
		/**
		 * Hides the tooltip.
		 * @param {Object} element The element for which to hide the tooltip.
		 */
		hide: function( element ) {
			var data = methods._data( element );

			if ( data.visible ) {
				data.twipsy.hide(); // todo: implement support for effects.
				data.visible = false;
			}
		},
		/**
		 * Returns the offset for this tooltip.
		 * @param {Object} element The element for which to get the tooltip offset.
		 * @returns {Object} The offset.
		 */
		_pos: function( element ) {
			var data = methods._data( element ),
				offset = element.offset(),
				top = 0,
				left = 0;

			switch ( data.placement ) {
				case 'above':
					top = offset.top - data.twipsy.outerHeight(),
					left = offset.left + ( ( element.outerWidth() - data.twipsy.outerWidth() ) / 2 );
					break;

				case 'right':
					top = offset.top + ( ( element.outerHeight() - data.twipsy.outerHeight() ) / 2 );
					left = offset.left + element.outerWidth();
					break;

				case 'below':
					top = offset.top + element.outerHeight(),
					left = offset.left + ( ( element.outerWidth() - data.twipsy.outerWidth() ) / 2 );
					break;

				case 'left':
					top = offset.top + ( ( element.outerHeight() - data.twipsy.outerHeight() ) / 2 );
					left = offset.left - data.twipsy.outerWidth();
					break;
			}

			return {
				left: left,
				top: top
			};
		},
		/**
		 * Returns the data for the tooltip from a specific element.
		 * @param {Object} element The element for which to retrieve the data.
		 * @returns {Object} The data.
		 */
		_data: function( element ) {
			var data = $.data( element, 'twipsy' );

			if ( !data ) {
				data = $.data( element, 'twipsy', {} );
			}

			return data;
		},
		/**
		 * Destructs the plugin.
		 * Frees up all storage used and unbinds the events.
		 */
		destroy: function() {
			var window = $( window );

			return this.each(function() {
				window.unbind( '.twipsy' );
			});
		}
	};

	/**
	 * Bootstrap Twipsy jQuery plugin.
	 * @param method The method to call.
	 */
	$.fn.boottwipsy = function( method ) {
		if ( method instanceof String && method.indexOf( '_' ) !== 0 && methods[ method ] ) {
			return methods[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ) );
		} else if ( typeof method === 'object' || ! method ) {
			return methods.init.apply( this, arguments );
		} else {
			$.error( 'Method ' +  method + ' does not exist on jQuery.boottwipsy.' );
		}
	};

})(jQuery);