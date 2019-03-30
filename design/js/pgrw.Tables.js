/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/
(function ($, document, window, undefined ) {
	
	var 	pluginName 		= 	'pgrwTables',
			defaults 		= 	{
			},
			publicMethod,
			$html,
			$element,
			$selector;
	
	publicMethod 	=	$[pluginName]	=	function (options) {
		var $obj 	= 	this;
		if($.isFunction($obj)){
			publicMethod.Constructor();
		}
    }
	
	publicMethod.Constructor 	= 	function () {
		$selector=$("table");
		$selector.each(function(index,v){
					
		});		
	}
	
	$(document).ready(function(){
		$.pgrwTables();	
	});	
	
}(jQuery, document, window));