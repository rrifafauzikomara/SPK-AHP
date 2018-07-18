/**
 * jQuery PrintMe v.1.0
 * 
 * A jquery plugin that prints the given element
 *
 * Copyright 2014, Daniel Arlandis <daniarlandis@gmail.com> www.daniarlandis.es
 * Released under the WTFPL license
 * http://sam.zoy.org/wtfpl/
 *
 * Date: Mon Feb 10 19:23:00 2014
 */
jQuery.fn.printMe = function(options){

	// Setup options
	var settings = $.extend({
		// These are the defaults options.
		path: "",
		title: "",
	}, options );

	return this.each(function(){

		// Store the object
		var $this = $(this);

		// Validates that the element has content to print
		if ($this.size() > 1){
			$this.eq( 0 ).print();
			return;
		} else if (!$this.size()){
			return;
		}
		 
		// Create a random name for the iframe.
		var iframeName = ("printer-" + (new Date()).getTime());
		 
		// Create an iFrame
		var iFrame = $( "<iframe name='" + iframeName + "'>" );
		 
		// Hide the iframe and add it to the body
		iFrame
			.css( "width", "1px" )
			.css( "height", "1px" )
			.css( "position", "absolute" )
		    .css( "left", "-9999px" )
			.appendTo( $( "body:first" ) );

		var objIframe = window.frames[ iframeName ];
		var objPrint = objIframe.document;

		// Write the HTML for the document. In $this, we will
		// write out the HTML of the current element.
		objPrint.open();
		objPrint.write( "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">" );
		objPrint.write( "<html>" );
		objPrint.write( "<head>" );
		objPrint.write( "<meta charset='utf-8'>" );

		
		// Loads the external css file when not is empty
		if (settings.path != "")
			objPrint.write( "<link href='" + settings.path + "' rel='stylesheet'>" );
		
		objPrint.write( "<title>" );
		objPrint.write( document.title );
		objPrint.write( "</title>" );
		objPrint.write( "</head>" );
		objPrint.write( "<body>" );
			
		// Add a header when the title not is empty
		if (settings.title != "")
			objPrint.write( "<h1>" + settings.title + "<\/h1>" );

		objPrint.write( $this.html() );
		objPrint.write( "<\/body>" );
		objPrint.write( "<\/html>" );
		objPrint.close();
		 
		// Print the document.
		objIframe.focus();
		objIframe.print();
		 
		// The iframe is destroyed in a minute and a half, I think it is enough time to press the print button
		setTimeout(
			function(){
				iFrame.remove();
			},(60 * 1000)
		);
	});
}