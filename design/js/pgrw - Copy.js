$(document).ready(function(){
	form_ajax();
});

var message				=	{"form_require":'Este dato es requerido'};
var hasestatus			=	{"success":'has-success',"warning":'has-warning',"danger":'has-danger'};
var formcontrol			=	{"success":'form-control-success',"warning":'form-control-warning',"danger":'form-control-danger'};
var	contenedor_message	=	$('<div class="contenedor_message"><div class="form-control-feedback"></div></div>');

function form_ajax(){
	var elem	=	$("[ajax]");	
	elem.each(function(index,v){
		var form		=	$(v);
		form.submit(function( event ) {
			var feedback				=	contenedor_message.clone();
			form.find('[require]').each(function(indice,objeto){ 
				var	input				=	$(objeto);
				var grand_contenedor	=	input.parent("div").parent("div.form-group");				
				if(input.val()==''){
					if(grand_contenedor.find(".contenedor_message").length==0){
						feedback.find(".form-control-feedback").html(message.form_require);
						grand_contenedor.addClass(hasestatus.danger).find("div").append(feedback);
						fx(feedback);
						input.focus().addClass(formcontrol.danger);
					}
					return false;					
				}				
			});
			return false;
		});
	});	
}

function remove_message(){
	
}

function remove_message(){
	$("")
}

function fx(obj,fx){
	if(!fx){fx	=	'bounceIn';}
	obj.addClass("animated animated "+fx+" active");
	setTimeout(function(){obj.removeClass("animated animated bounceIn");}, 1000);
}