/*
 * IE Alert! jQuery plugin
 * version 1
 * author: David Nemes http://nmsdvid.com
 * http://nmsdvid.com/iealert/
 */

(function($){
$("#goon").live("click", function(){
		$("#ie-alert-overlay").hide();	
		$("#ie-alert-panel").hide();						  
});
function initialize($obj, support, title, text){

		var panel = "<span>"+ title +"</span>"
				  + "<p> "+ text +"</p><span id='goon' style='font-size:20px; color:red;cursor:pointer;'>\u7EE7\u7EED\u8BBF\u95EE</span><br/><br/><br/><br/>"
			      + " <div class='browser'><div class='clear'></div>"
			      + "<ul>"
			      + "<li><a class='chrome' href='http://www.google.cn/intl/zh-CN/chrome/' target='_blank'></a></li>"
			      + "<li><a class='firefox' href='http://download.firefox.com.cn/releases/stub/official/zh-CN/Firefox-latest.exe' target='_blank'></a></li>"
			      + "<li><a class='ie9' href='http://windows.microsoft.com/en-US/internet-explorer/downloads/ie/' target='_blank'></a></li>"
			      + "<li><a class='safari' href='http://www.apple.com/safari/download/' target='_blank'></a></li>"
			      + "<li><a class='opera' href='http://www.opera.com/download/' target='_blank'></a></li>"
			      + "<ul>"
			      + "</div>"; 

		var overlay = $("<div id='ie-alert-overlay'></div>");
		var iepanel = $("<div id='ie-alert-panel'>"+ panel +"</div>");

		var docHeight = $(document).height();

		overlay.css("height", docHeight + "px"); 
		
		if (support === "ie8") { 			// shows the alert msg in IE8, IE7, IE6
		
			if ($.browser.msie  && parseInt($.browser.version, 10) < 9) {
				
				$obj.prepend(iepanel);
				$obj.prepend(overlay);
				
			}

			if ($.browser.msie  && parseInt($.browser.version, 10) === 6) {

				
				$("#ie-alert-panel").css("background-position","-626px -116px");
				$obj.css("margin","0");
  
			}
			
			
		} else if (support === "ie7") { 	// shows the alert msg in IE7, IE6
			
			if ($.browser.msie  && parseInt($.browser.version, 10) < 8) {
				
				$obj.prepend(iepanel);
				$obj.prepend(overlay);
			}
			
			if ($.browser.msie  && parseInt($.browser.version, 10) === 6) {
				
				$("#ie-alert-panel").css("background-position","-626px -116px");
				$obj.css("margin","0");
  
			}
			
		} else if (support === "ie6") { 	// shows the alert msg only in IE6
			
			if ($.browser.msie  && parseInt($.browser.version, 10) < 7) {
				
				$obj.prepend(iepanel);
				$obj.prepend(overlay);
				
  				$("#ie-alert-panel").css("background-position","-626px -116px");
				$obj.css("margin","0");
				
			}
		}

}; //end initialize function


	$.fn.iealert = function(options){
		var defaults = { 
			support: "ie8",  // ie8 (ie6,ie7,ie8), ie7 (ie6,ie7), ie6 (ie6)
			title: "\u8fd8\u4e0d\u77e5\u9053\u4f60\u7528\u7684\u0049\u006e\u0074\u0065\u0072\u006e\u0065\u0074\u0020\u0045\u0078\u0070\u006c\u006f\u0072\u0065\u0072\u662f\u592a\u8fc7\u65f6\u4e86\u5417\u003f", // title text
			text: "\u4e3a\u4e86\u4fdd\u8bc1\u826f\u597d\u7684\u4f53\u9a8c\u6548\u679c\u002c\u0055\u0045\u0044\u56e2\u961f\u5efa\u8bae\u60a8\u5347\u7ea7\u5230\u6700\u65b0\u7248\u672c\u7684\u0049\u006e\u0074\u0065\u0072\u006e\u0065\u0074\u0020\u0045\u0078\u0070\u006c\u006f\u0072\u0065\u0072\u6216\u8005\u9009\u62e9\u4e0b\u9762\u6240\u63a8\u8350\u7684\u6d4f\u89c8\u5668\u002e."
		};
		
		
		var option = $.extend(defaults, options); 
			return this.each(function(){
				if ( $.browser.msie ) {
					var $this = $(this);  
					initialize($this, option.support, option.title, option.text);
				} //if ie	
			});		       
	
	};
})(jQuery);
