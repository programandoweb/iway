(function ($, document, window, undefined ) {
	
	var 	pluginName 		= 	'pgrwForms',
			defaults 		= 	{
				message:{"form_require":'Este dato es requerido'},
				hasestatus:{"success":'has-success',"warning":'has-warning',"danger":'has-danger'},
				formcontrol:{"success":'form-control-success',"warning":'form-control-warning',"danger":'form-control-danger'},
				contenedor_message:$('<div class="form-control-feedback"/>')		
			},
			publicMethod,
			$forms,
			$submit,
			$modal;
	
	publicMethod 	=	$[pluginName]	=	function (options) {
		var $obj 	= 	this;
		if($.isFunction($obj)){
			$forms	=	publicMethod.formsAjax();
			publicMethod.formsFilters();
		}
    }
	
	publicMethod.formsFilters 	= 	function () {
		$forms=$("form");
		if($forms.length>0){
			make_modal_alert();
			$submit		=	false;
		}
		$forms.each(function(index,v){
			if($(v).attr("ajax")){
				return false;
			}else{
			}
			$(v).submit(function( event ) {
				if(inpustRequires($(v))){
					return true;
				}
				return false;	
			})
		});
	}
	
	publicMethod.formsAjax 		= 	function () {
		$forms=$("form[ajax]");
		if($forms.length>0){
			make_modal_alert();
			$submit		=	false;	
		}		
		$forms.each(function(index,v){
			require_complement($(this));
			$(v).submit(function( event ) {
				if(inpustRequires($(v))){
					post($(this));	
				}else{
					//post($(this));	
				}
				return false;	
			})
		});
	}
	
	function require_complement(form){
		var require		=	form.find('[require]');
		require.each(function(index,v){
			var obj					=		$(v);
			var require_selector	=		$(require[index-1]);
			if(index>0){
				if(require_selector.val()==''){
					$(v).attr("readonly","readonly"); 
				}
			}
			obj.keyup(function(){
				var require_selector	=		$(require[index+1]);
				if($(this).val()!=''){
					require_selector.removeAttr("readonly");
				}else{
					require_selector.attr("readonly","readonly");
				}				
			});
			obj.click(function(){
				if(index>0){
					if(require_selector.val()==''){
						callback_modal("Para liberar complete el campo anterior.");
						$(v).attr("readonly","readonly"); 
					}		
				}
			});			
		});
	}
	
	function inpustRequires(form) {
		var return_value	=	false;
		form.find('[require]').each(function(index,v){
			if($(v).val()==''){
				
				inpustRequireEmpty($(v));
				return_value	=	false;	
				callback_modal("Por favor complete los datos requeridos");
				return false;
			}else{
				return_value	=	true;
				//return false;	
			}
		});
		return return_value;
	}
	
	function inpustRequireEmpty(elem) {
		var feedback				=	{
											"clone":defaults.contenedor_message.clone(),
											"grand_contenedor":elem.parent("div").parent("div.form-group"),
											"form_control_feedback":"",
											"elem":elem
										}
		;

		if(feedback.grand_contenedor.find(".form-control-feedback").length==0){
			feedback.clone.html(defaults.message.form_require);
			//console.log(feedback.grand_contenedor),
			feedback.grand_contenedor.addClass(defaults.hasestatus.danger).find("div").append(feedback.clone);
			efx(feedback.clone);
			feedback.elem.focus().addClass(defaults.formcontrol.danger);
			feedback.form_control_feedback	=	feedback.grand_contenedor.find(".form-control-feedback");
			keychange(feedback);
		}
	}
	
	function keychange(obj){
		obj.elem.keyup(function(){
			if($(this).val()!=''){
				clear(obj);
			}
		});
		obj.elem.focusout(function(){
			if($(this).val()!=''){
				clear(obj);
			}
		});
	}
	
	function clear(obj){
		obj.form_control_feedback.remove();
		obj.elem.removeClass(defaults.formcontrol.success);
		obj.elem.removeClass(defaults.formcontrol.warning);
		obj.elem.removeClass(defaults.formcontrol.danger);
		obj.grand_contenedor.removeClass(defaults.hasestatus.success);
		obj.grand_contenedor.removeClass(defaults.hasestatus.warning);
		obj.grand_contenedor.removeClass(defaults.hasestatus.danger);
	}
	
	function efx(obj,fx) {
		if(!fx){fx	=	'bounceIn';}
		obj.addClass("animated animated "+fx+" active");
		setTimeout(function(){obj.removeClass("animated animated bounceIn");}, 1000);
	}
	
	function post(elem) {
		//console.log(elem.find('[name="redirect"]'));return;
		$.post(elem.attr("action"),elem.serialize(),function(data){
			
		},'json').fail(function() {
			callback_modal("Error consulte al administrador de sistemas");
		}).always(function(data) {
			if(data.message){						
				callback_modal(data.message);
			}
			if(data.code==200){
				var redirect = elem.find('[name="redirect"]');
				if( redirect.length >0){
					document.location.href	=	redirect.val(); 
					//setInterval(function(){ document.location.href	=	redirect.val(); }, 1000);					
				}
			}
			if(data.callback){
				eval(data.callback);
			}
		});
	}
	
	function make_modal_confirm(){
		$modal			=	modal.clone();
		var contenido  	=	$modal.find(".modal-dialog").find(".modal-content");
			$modal.addClass("pgrw_modal_confirm_"+pluginName).attr("aria-labelledby","modalLabel_confirm_"+pluginName).find(".modal-dialog").addClass("modal-md");
			contenido.find(".modal-header").html("<h5>Atención</h5>");
			contenido.find(".modal-footer").html('<button type="button" class="btn btn-primary aceptar" data-dismiss="modal">Aceptar</button><button type="button" class="btn btn-danger cancelar" data-dismiss="modal">Cancelar</button>');
		$("body").append($modal);			
	}
	
	function make_modal_alert(){
		$modal			=	modal.clone();
		var contenido  	=	$modal.find(".modal-dialog").find(".modal-content");
			$modal.addClass("pgrw_modal_alert_"+pluginName).attr("aria-labelledby","modalLabel_alert_"+pluginName).find(".modal-dialog").addClass("modal-md");
			contenido.find(".modal-header").html("<h5>Atención</h5>");
			contenido.find(".modal-footer").html('<button type="button" class="btn btn-primary aceptar" data-dismiss="modal">Aceptar</button>');
		$("body").append($modal);			
	}
	
	function callback_modal(message){
		$modal.find(".modal-body").html('<div class="text-center">'+message+'</div>');
		$modal.modal({ keyboard: false})
	}
	
	$(document).ready(function(){
		$.pgrwForms();	
	});	
	
}(jQuery, document, window));