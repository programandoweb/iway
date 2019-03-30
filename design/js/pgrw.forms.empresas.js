(function ($, document, window, undefined ) {
	
	var 	pluginName 		= 	'pgrwEmpresas',
			defaults 		= 	{
			},
			publicMethod,
			$elements,
			$submit,
			$modal;
	
	publicMethod 	=	$[pluginName]	=	function (options) {
		var $obj 	= 	this;
		if($.isFunction($obj)){
			$elements	=	publicMethod.elements();
			publicMethod.ext();
		}
    }
	
	publicMethod.ext 		= 	function () {

	}
	
	publicMethod.show			=	function(bool){
		if(bool){
			$("#identificacion_ext").show();
			$("#tipo_identificacion").find("option").each(function(){
				if($(this).attr("value")!='NIT'){
					$(this).hide();
				}else{
					$(this).show();
					$(this).attr("selected","selected");
				}
			});
		}else{
			$("#identificacion_ext").hide();
			$("#tipo_identificacion").find("option").each(function() {
				$(this).removeAttr("selected");
				if($(this).attr("value")=='NIT'){
					$(this).hide();
				}else{
					$(this).show();
				}
			});
		}
	}
	
	publicMethod.elements 		= 	function(){
		$elements	=	$("[pgrw-dependency]");
		$elements.each(function(index,v){
			var element		=	$(v);
			var dependency	=	element.attr("pgrw-dependency");
			dependency 		= 	eval("("+dependency+")");
			if(element.val()==dependency.option){
				change_class(dependency,"desactivar_campo_solo");	
			}
			if(element.val()==dependency.generate){
				Change_index(dependency,true);	
			}
			element.change(function(){
				if(element.val()== dependency.generate){
					Change_index(dependency,true);
				}else{
					Change_index(dependency,false);
				}
				if(element.val()==dependency.option){
					change_class(dependency,"desactivar_campo_solo");
				}else{
					change_class(dependency,"activar_campo_solo");
				}
			});
		});
	}

	function Change_index(dependency,bool){
		if(bool){
			$.each(dependency.options,function(index, el){
				$("#"+el.name).val(el.settrue);
			});
		}else{
			$.each(dependency.options,function(index, el){
				$("#"+el.name).val(el.setfalse);
			});
		}
	}
	
	function change_class(dependency,bool){
		if(bool=='activar_campo_solo'){
			$("#"+dependency.secundary).addClass("animated fadeOutUp");
			$("#"+dependency.primary).removeClass().addClass("form-control col-md-12");			
		}else{
			$("#"+dependency.primary).removeClass().addClass("form-control col-md-9");
			$("#"+dependency.secundary).removeClass().addClass("animated fadeInUp");
		}		
	}
	
	function efx(obj,fx) {
		if(!fx){fx	=	'bounceIn';}
		obj.addClass("animated animated "+fx+" active");
		setTimeout(function(){obj.removeClass("animated animated bounceIn");}, 1000);
	}
	
	function callback_modal(message){
		$modal.find(".modal-body").html('<div class="text-center">'+message+'</div>');
		$modal.modal({ keyboard: false})
	}
	
	$(document).ready(function(){
		$.pgrwEmpresas();	
	});	
	
}(jQuery, document, window));