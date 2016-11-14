/*         ______________________________________
  ________|                                      |_______
  \       |           SmartAdmin WebApp          |      /
   \      |      Copyright © 2014 MyOrange       |     /
   /      |______________________________________|     \
  /__________)                                (_________\

 * The above copyright notice and this permission notice shall be
 * included in all copies or substantial portions of the Software.
 * =======================================================================
 * SmartAdmin is FULLY owned and LICENSED by MYORANGE INC.
 * This script may NOT be RESOLD or REDISTRUBUTED under any
 * circumstances, and is only to be used with this purchased
 * copy of SmartAdmin Template.
 * =======================================================================
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
 * MERCHANTABILITY, IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
 * LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
 * OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
 * WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 * =======================================================================
 * original filename: app.js
 * filesize: 50,499 bytes
 * author: Sunny (@bootstraphunt)
 * email: info@myorange.ca
 *
 * GLOBAL: Reference DOM
 */
	$.root_ = $('body');
/*
 * GLOBAL: interval array (to be used with jarviswidget in ajax and angular mode) to clear auto fetch interval
 */
	$.intervalArr = [];
/*
 * Calculate nav height
 */
var calc_navbar_height = function() {
		var height = null;
	
		if ($('#header').length)
			height = $('#header').height();
	
		if (height === null)
			height = $('<div id="header"></div>').height();
	
		if (height === null)
			return 49;
		// default
		return height;
	},
	
	navbar_height = calc_navbar_height, 
/*
 * APP DOM REFERENCES
 * Description: Obj DOM reference, please try to avoid changing these
 */	
	shortcut_dropdown = $('#shortcut'),
	
	bread_crumb = $('#ribbon ol.breadcrumb'),
/*
 * Top menu on/off
 */
	topmenu = false,
/*
 * desktop or mobile
 */
	thisDevice = null,
/*
 * JS ARRAY SCRIPT STORAGE
 * Description: used with loadScript to store script path and file name
 * so it will not load twice
 */	
	jsArray = {},	
/*
 * DETECT MOBILE DEVICES
 * Description: Detects mobile device - if any of the listed device is detected
 * a class is inserted to $.root_ and the variable thisDevice is decleard. 
 * (so far this is covering most hand held devices)
 */	
	ismobile = (/iphone|ipad|ipod|android|blackberry|mini|windows\sce|palm/i.test(navigator.userAgent.toLowerCase()));
/*
 * CHECK MOBILE VIEW
 */
	if (!ismobile) {
		// Desktop
		$.root_.addClass("desktop-detected");
		device = "desktop";
	} else {
		// Mobile
		$.root_.addClass("mobile-detected");
		device = "mobile";
		
		if (fastClick) {
			// Removes the tap delay in idevices
			// dependency: js/plugin/fastclick/fastclick.js 
			$.root_.addClass("needsclick");
			FastClick.attach(document.body); 
		}
		
	}
/*
 * CHECK FOR MENU POSITION
 */
if ($('body').hasClass("menu-on-top") || localStorage.getItem('sm-setmenu')=='top' ) { 
	topmenu = true;
	$('body').addClass("menu-on-top");
}


/*
* ADD CLASS WHEN BELOW CERTAIN WIDTH (MOBILE MENU)
* Description: changes the page min-width of #CONTENT and NAV when navigation is resized.
* This is to counter bugs for min page width on many desktop and mobile devices.
* Note: This script uses JSthrottle technique so don't worry about memory/CPU usage
*/

$('#main').resize(function() {
	check_if_mobile_width();
});


function check_if_mobile_width() {
	if ($(window).width() < 979) {
		$.root_.addClass('mobile-view-activated');
		$.root_.removeClass('minified');
	} else if ($.root_.hasClass('mobile-view-activated')) {
		$.root_.removeClass('mobile-view-activated');
	}
}

/*
 * INITIALIZE JARVIS WIDGETS
 */

// Setup Desktop Widgets
function setup_widgets_desktop() {

	if ($.fn.jarvisWidgets && enableJarvisWidgets) {

		$('#widget-grid').jarvisWidgets({

			grid : 'article',
			widgets : '.jarviswidget',
			localStorage : true,
			deleteSettingsKey : '#deletesettingskey-options',
			settingsKeyLabel : 'Reset settings?',
			deletePositionKey : '#deletepositionkey-options',
			positionKeyLabel : 'Reset position?',
			sortable : true,
			buttonsHidden : false,
			// toggle button
			toggleButton : true,
			toggleClass : 'fa fa-minus | fa fa-plus',
			toggleSpeed : 200,
			onToggle : function() {
			},
			// delete btn
			deleteButton : true,
			deleteClass : 'fa fa-times',
			deleteSpeed : 200,
			onDelete : function() {
			},
			// edit btn
			editButton : true,
			editPlaceholder : '.jarviswidget-editbox',
			editClass : 'fa fa-cog | fa fa-save',
			editSpeed : 200,
			onEdit : function() {
			},
			// color button
			colorButton : true,
			// full screen
			fullscreenButton : true,
			fullscreenClass : 'fa fa-expand | fa fa-compress',
			fullscreenDiff : 3,
			onFullscreen : function() {
			},
			// custom btn
			customButton : false,
			customClass : 'folder-10 | next-10',
			customStart : function() {
				alert('Hello you, this is a custom button...');
			},
			customEnd : function() {
				alert('bye, till next time...');
			},
			// order
			buttonOrder : '%refresh% %custom% %edit% %toggle% %fullscreen% %delete%',
			opacity : 1.0,
			dragHandle : '> header',
			placeholderClass : 'jarviswidget-placeholder',
			indicator : true,
			indicatorTime : 600,
			ajax : true,
			timestampPlaceholder : '.jarviswidget-timestamp',
			timestampFormat : 'Last update: %m%/%d%/%y% %h%:%i%:%s%',
			refreshButton : true,
			refreshButtonClass : 'fa fa-refresh',
			labelError : 'Sorry but there was a error:',
			labelUpdated : 'Last Update:',
			labelRefresh : 'Refresh',
			labelDelete : 'Delete widget:',
			afterLoad : function() {
			},
			rtl : false, // best not to toggle this!
			onChange : function() {
				
			},
			onSave : function() {
				
			},
			ajaxnav : $.navAsAjax // declears how the localstorage should be saved (HTML or AJAX page)

		});

	}

}

// Setup Desktop Widgets
function setup_widgets_mobile() {

	if (enableMobileWidgets && enableJarvisWidgets) {
		setup_widgets_desktop();
	}

}

function pageSetUp() {
    setTimeout(
        function()
        {

        if (device === "desktop"){

            // setup widgets
            setup_widgets_desktop();

        } else {

            // setup widgets
            setup_widgets_mobile();

        }

    }, 1000);
}