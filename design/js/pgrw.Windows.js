/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/
(function ($, document, window, undefined ) {
	
	var 	pluginName 		= 	'pgrwWindows',
			defaults 		= 	{
				message:{"form_require":'Este dato es requerido'},
				content_Main:$('<div class="form-control-pgrw-content"><div class="triangulo triangulo-equilatero-bottom"></div></div>'),
				content_TOPBG:$('<div class="form-control-pgrw-topbackground"/>'),
				content_TOPIMG:$('<div class="form-control-pgrw-topimg"></div>'),
				content_HTMLIMG:$('<img class="align-middle rounded-circle d-block"/>'),
				content_TOPMENU:$('<div class="form-control-pgrw-topmenu"/>'),
				content_HTMLHEADER:$('<div class="form-control-pgrw-header"><div class="form-control-pgrw-title"></div><div class="form-control-pgrw-subtitle"></div><div class="form-control-pgrw-trmvigente"></div></div>'),
				content_HTMLBODY:$('<div class="form-control-pgrw-body"></div>')		
			},
			publicMethod,
			$modal,
			$html,
			$element,
			$img_perfil,
			$img_perfil_url,
			$selector;
	
	publicMethod 	=	$[pluginName]	=	function (options) {
		var $obj 	= 	this;
		if($.isFunction($obj)){
			publicMethod.Constructor();
		}
    }
	
	publicMethod.Constructor 	= 	function () {
		$selector=$(".pgrw_windows");
		defaults.content_Main.hide();
		$selector.each(function(index,v){
			$element	=	$(this);
			$content	=	$element.find(".contenido");			
			$element.find(".img").addClass("rounded-circle mx-auto d-block");
			$(defaults.content_Main).append(defaults.content_TOPBG);
			if($element.data("logo")){
				$img_perfil_url		=	$element.data("logo");	
				defaults.content_TOPBG.append(defaults.content_TOPIMG);
				defaults.content_TOPIMG.append(defaults.content_HTMLIMG.attr("src",$img_perfil_url));
				defaults.content_TOPIMG.append(defaults.content_HTMLHEADER);
				defaults.content_HTMLHEADER.find(".form-control-pgrw-title").html($element.data("nombre"));
				defaults.content_HTMLHEADER.find(".form-control-pgrw-subtitle").html($element.data("sucursal"));
				if($element.attr("data-trm") != undefined){
					defaults.content_HTMLHEADER.find(".form-control-pgrw-trmvigente").html("TRM Vigente: "+$element.attr("data-trm"));
				}
				defaults.content_HTMLBODY.html();
			}	
			$(defaults.content_Main).append(defaults.content_HTMLBODY.html($content));					
			$element.append(defaults.content_Main);
			$element.click(function(event){
				$content.show();
				defaults.content_Main.find(".triangulo").css({top: -12, right: event.pageY})
				publicMethod.Show($(this));
			});
		});		
	}
	
	publicMethod.Show 	= 	function (obj) {
		defaults.content_Main.toggle();
		var query		=	defaults.content_Main;
		var isVisible	=	query.is(':visible');
		if (isVisible === true) {
			query.mouseleave(function(){
				defaults.content_Main.hide();
			});
		} 
	}
	
	$(document).ready(function(){
		$.pgrwWindows();	
	});	
	
}(jQuery, document, window));