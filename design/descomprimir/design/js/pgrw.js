/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/
$(document).ready(function(){
	id_equivalencia();
	pgrw_rooms();
	pgrw_ajax();
	pgrw_recharge();
	remove_flash();
	_confirm();
	getTime();
	lightbox();
	input_dinamico();
	validar_file_upload();
	upcase();
	clonar();
});

function makeCanvas(ctx){
	eval('var objeto ='+ctx.data("objeto"));	
	
	var	andres			=	{	'Red':{"bg":"rgba(255, 99, 132, 0.2)","bd":"rgba(255,99,132,1)"}, 
								'Blue':{"bg":"rgba(54, 162, 235, 0.2)","bd":"rgba(54, 162, 235, 1)"}, 
								'Yellow':{"bg":"rgba(255, 206, 86, 0.2)","bd":"rgba(255, 206, 86, 1)"}, 
								'Green':{"bg":"rgba(75, 192, 192, 0.2)","bd":"rgba(75, 192, 192, 1)"}, 
								'Purple':{"bg":"rgba(153, 102, 255, 0.2)","bd":"rgba(153, 102, 255, 1)"}, 
								'Orange':{"bg":"rgba(255, 159, 64, 0.2)","bd":"rgba(255, 159, 64, 1)"}
								};
	
	
	var backgroundColor	=	[];
	var	borderColor		=	[];
	var	datos			=	[];
	$.each(objeto.colores,function(index,valor){
		backgroundColor[index]	= 	eval("andres."+valor+".bg");
		borderColor[index]		= 	eval("andres."+valor+".bd");
	})

	var myChart = new Chart(ctx, {
			type: objeto.type,
			data: {
				labels: objeto.colores,
				datasets: [{
					label: objeto.label,
					data: objeto.valores,
					backgroundColor: backgroundColor,
					borderColor: borderColor,
					borderWidth: 1
				}]
			},
			options: {
				title: {
					fontSize: 24,
					display: true,
					text: objeto.text
				},
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});
	
}

function dolar(){
	var valor_dolar	=	$("#get_datos_dolar").html();
		$("#deposita_aqui_dolar").html(valor_dolar);		
		$("#get_datos_dolar").remove();
}

function clonar(){
	var objetos		= 	$("[clonar]");
	objetos.each(function(index,v){
		var	elem	=	$(this);
		var add		=	$(this).find("div.clonar");	
		add.click(function(){
			var inputs		=	elem.find("input");
			var continue_	=	true;
			inputs.each(function(){
				var	input				=	$(this);
				var grand_contenedor	=	input.parent("div").parent("div.form-group");				
				if(input.val()==''){
					make_message("Error","Debe Completar todos los datos");
					continue_			=	false;
					return false;					
				}
			})
			if(continue_){
				var clon	=	elem.clone();
				clon.appendTo( "#"+elem.data("padre") );
				clon.find("input").removeAttr("type").attr("type","hidden");
				elem.find("input").val("");
				clon.find(".clonar").click(function(){
					clon.remove();	
				});
				clon.find(".clonar").find("i").removeClass("fa-plus").addClass("fa-trash");
				clon.find(".d-none").removeClass();
			}
		});
	})	
		
}

function upcase(){
	String.prototype.capitalize = function(){
		return this.toLowerCase().replace( /\b\w/g, function (m) {
			return m.toUpperCase();
		});
	};
	String.prototype.firstLetterUpper = function(){
		return this.charAt(0).toUpperCase() + this.slice(1).toLowerCase();
	};
	var myCapitalizeText = $('.capitalizeText');
	var myFirstLetterText = $('.firstLetterText');  
	myCapitalizeText.focusout(function(){
		$(this).val($(this).val().capitalize());
	});
	myFirstLetterText.focusout(function(){
		$(this).val($(this).val().firstLetterUpper());
	}); 
}

function validar_file_upload(){
	forms		=	$( "form" );
	forms.each(function(index,v){
		var _return = 	true;
		$(v).submit(function(){
			var inputs		=	$(v).find("input:file");
			inputs.each(function(index,v2){
				var v2	=	$(v2);
				if(v2.val()==''){
					_return	=	false;
					return false;
				}
				extensiones_permitidas 	= 	v2.data("filetype");
				eval(extensiones_permitidas);
				if(filtroExtensionPermitida(v2.val(),filestype)==false){
					_return	=	false;
					return false;
				}
				
				if(v2.val()!=''){
					if(window.File && window.FileReader && window.FileList && window.Blob){
						if(this.files[0].size > v2.data("sizemax")){
							make_message("Error en Formulario","El archivo supera el peso permitido");
							_return	=	false;
							return false;	
						}
					}else{
						// IE
						var Fs = new ActiveXObject("Scripting.FileSystemObject");
						var ruta = document.upload.file.value;
						var archivo = Fs.getFile(ruta);
						var size = archivo.size;
						if(size > v2.data("sizemax")){
							make_message("Error en Formulario","El archivo supera el peso permitido");
							_return	=	false;
							return false;	
						}
					}
				}
			
			});
			if(_return==false){
				return false;
			}else{
				return true;
			}
		});
	});
}

function filtroExtensionPermitida(archivo,extensiones_permitidas){
	var mierror		= 	"";
	var _return 	= 	false;
	var permitida 	= 	false;
	if(!extensiones_permitidas){
   		extensiones_permitidas 	= 	new Array(".gif", ".jpg", ".doc", ".pdf");
	}
	extension 		= 	(archivo.substring(archivo.lastIndexOf("."))).toLowerCase();
	if(extensiones_permitidas.length<1){
		return false;
	}
	for (var i = 0; i < extensiones_permitidas.length; i++) {
		 if (extensiones_permitidas[i] == extension) {
		 	permitida 	= true;
		 	break;
		 }
	  }
	if (!permitida) {
		mierror 	= 	"Comprueba la extensión de los archivos a subir. \nSólo se pueden subir archivos con extensiones: " + extensiones_permitidas.join();
		make_message("Error en Formulario",mierror);
		return false;
	}else{
		//alert ("Todo correcto. Voy a submitir el formulario.");
		return true;
	}
}

function comprueba_extension(formulario, archivo,extensiones_permitidas) {
	if(!extensiones_permitidas){
   		extensiones_permitidas 	= 	new Array(".gif", ".jpg", ".doc", ".pdf");
	}
   
   	mierror = "";
	if (!archivo) {
	  //Si no tengo archivo, es que no se ha seleccionado un archivo en el formulario
	   mierror = "No has seleccionado ningún archivo";
	}else{
	  //recupero la extensión de este nombre de archivo
	  extension = (archivo.substring(archivo.lastIndexOf("."))).toLowerCase();
	  //alert (extension);
	  //compruebo si la extensión está entre las permitidas
	  permitida = false;
	  for (var i = 0; i < extensiones_permitidas.length; i++) {
		 if (extensiones_permitidas[i] == extension) {
		 permitida = true;
		 break;
		 }
	  }
	  if (!permitida) {
		 mierror = "Comprueba la extensión de los archivos a subir. \nSólo se pueden subir archivos con extensiones: " + extensiones_permitidas.join();
	   }else{
		  //submito!
		 alert ("Todo correcto. Voy a submitir el formulario.");
		 formulario.submit();
		 return 1;
	   }
	}
	//si estoy aqui es que no se ha podido submitir
	alert (mierror);
	return 0;
}

function make_message(title,message){
	$modal			=	modal.clone();
	var contenido  	=	$modal.find(".modal-dialog").find(".modal-content");
		$modal.addClass("pgrw_modal_confirm_ajax").attr("aria-labelledby","modalLabel_confirm_ajax").find(".modal-dialog").addClass("modal-md");
		contenido.find(".modal-header").html("<h5>"+title+"</h5>");
		contenido.find(".modal-footer").html('<button type="button" class="btn btn-warning cancelar" data-dismiss="modal">Cerrar</button>');
	$("body").append($modal);
	$modal.find(".modal-body").html('<div class="text-center">'+message+'</div>');
	$modal.modal({ keyboard: false})			
}

function input_dinamico(){
	inputs	=	$("[input_dinamico]");	
	inputs.each(function(index,v){
		var input 		=	$(v);
		var default_	=	input.val();
		var form		=	input.parent( "form" );
		var send		=	true;
		input.dblclick(function(){
			send		=	true;
			$("[input_dinamico]").attr("readonly","readonly").unbind( "keypress" );
			$(this).removeAttr("readonly").keypress(function(e){
				if(e.which ==13){
					if(default_	!=$(this).val() && send==true){
						post_ajax(form);
						send	=	false;	
					}
				}
			});			
		});
		input.focusout(function(){
			$("[input_dinamico]").attr("readonly","readonly").unbind( "keypress" );
			if(default_	!=$(this).val() && send==true){
				post_ajax(form);
				send	=	false;	
			}
		});
	});
}

function post_ajax(form){
	$.post(form.attr("action"),form.serialize(),function(data){
	},'json').fail(function() {
		alert("Error consulte al administrador de sistemas");
	}).always(function(data) {
		if(data.message){						
			alert(data.message);
		}
		if(data.code==200){
			$("[input_dinamico]").attr("readonly","readonly").unbind( "keypress" );
			if( data.redirect ){
				setInterval(function(){ document.location.href	=	data.redirect.val(); }, 2000);					
			}
		}
		if(data.callback){
			eval(data.callback);
		}
	});	
}

var	modal	=	$('<div class="modal fade " tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"></div><div class="modal-body"></div><div class="modal-footer"></div></div></div></div>');
/*MODAL */
function lightbox(){
	btns	=	$(".lightbox");
	btns.each(function(index,v){		
		var btn =	$(v);
		btn.click(function(){
			make_modal_ajax(btn);
			return false;	
		})
	});
}

function make_modal_ajax(obj){
	$modal			=	modal.clone();
	var contenido  	=	$modal.find(".modal-dialog").find(".modal-content");
		$modal.addClass("pgrw_modal_confirm_ajax").attr("aria-labelledby","modalLabel_confirm_ajax").find(".modal-dialog").addClass("modal-lg");
		contenido.find(".modal-header").html("<h5>"+obj.attr("title")+"</h5>");
		contenido.find(".modal-footer").html('<button type="button" class="btn btn-warning cancelar" data-dismiss="modal">Cerrar</button>');
	$("body").append($modal);
	$modal.find(".modal-body").html('<div class="text-center"><i class="fa fa-cog fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span></div>');
	if(obj.data("type")=='iframe'){
		$iframe		=	$('<iframe src="'+obj.attr("href")+'" allowfullscreen="" frameborder="0" width="100%" height="100%" />');
		$modal.find(".modal-body").height(450).html($iframe);
	}
	$modal.modal({ keyboard: false})			
}


/*MODAL END */
function id_equivalencia(){
	$("#id_equivalencia").change(function(){
		if($(this).val()=='Otro'){
			$("#equivalencia").val("").attr("placeholder","Agregue otra equivalencia");
			$("#equivalencia").removeAttr("readonly");
		}else{
			$("#equivalencia").val($(this).val());
			$("#equivalencia").attr("readonly","readonly");
		}		
	});
}

function pgrw_rooms(){
	var main		=	$("#room_transmision").data("main");
	for (var i=1; i<=$("#room_transmision").data("nrooms"); i++) {
		if(main==i){
			$("#room_transmision").append("<option value='"+i+"' selected> Room "+i+"</option>");			
		}else{
			$("#room_transmision").append("<option value='"+i+"'> Room "+i+"</option>");			
		}
	}
	if(main=="1000000"){
		$("#room_transmision").append("<option value='1000000' selected> Satélite</option>");			
	}else{
		$("#room_transmision").append("<option value='1000000'> Satélite</option>");			
	}
}

function pgrw_recharge(){
	var elem	=	$("[pgrw-recharge]");	
	elem.each(function(index,v){
		var element		=	$(v);
		element.change(function(){
			$("form").submit();
		});
	})
}

function pgrw_ajax(){
	var elem	=	$("[pgrw-ajax]");	
	elem.each(function(index,v){
		var element		=	$(v);
		var atributos	=	element.attr("pgrw-ajax");
		atributos 		= 	eval("("+atributos+")");
		var contenedor	=	atributos.contenedor;
		var url			=	atributos.url;
		element.change(function(){
			$.post(url,{id:$(this).val()},function(data){
				$(contenedor).empty();
				$(contenedor).html(data);
				console.log(data);
			})
		})
	});
}

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

function _confirm(){
	var obj			=	$("[confirm='true']");
	obj.each(function(index,v){
		var elem	=	$(v);
		elem.click(function(){
			if(confirm("Está seguro de borrar este registro?")){
			}else{
				return false;
			}
		});
	});
}

function _post(){
	$.post(elem.attr("href"),function(data){
		
	},'json').fail(function() {
		alert("Error consulte al administrador de sistemas");
	}).always(function(data) {
		if(data.message){						
			alert(data.message);
		}
		if(data.code==200){
			var redirect = elem.find('[name="redirect"]');
			if( redirect.length >0){
				setInterval(function(){ document.location.href	=	redirect.val(); }, 2000);					
			}
		}
		if(data.callback){
			eval(data.callback);
		}
	});	
}

function reloader_iframe(){
	parent.location.reload();
	//window.opener.location.reload()
	//document.location.reload();
	
}

function remove_flash(){
	var elem		=	$("#flash");	
	var contenido	=	elem.find("div");
	if(elem.find("div").length>0){
		
		setTimeout(function(){contenido.addClass("animated fadeOutUp");elem.html("");}, 3500);
	}
}

function fx(obj,fx){
	if(!fx){fx	=	'bounceIn';}
	obj.addClass("animated animated "+fx+" active");
	setTimeout(function(){obj.removeClass("animated animated bounceIn");}, 1000);
}

function getTime() {
	if($("#dias").length==0){
		return false;
		return;	
	}
	var reloj 		=	$(".reloj");
	now 			= 	new Date();
	fecha 			= 	new Date(reloj.data("time"));
	days 			= 	(fecha - now) / 1000 / 60 / 60 / 24;
	daysRound 		=	Math.floor(days);
	hours 			= 	(fecha - now) / 1000 / 60 / 60 - (24 * daysRound);
	hoursRound 		= 	Math.floor(hours);
	minutes 		= 	(fecha - now) / 1000 /60 - (24 * 60 * daysRound) - (60 * hoursRound);
	minutesRound 	= 	Math.floor(minutes);
	seconds 		= 	(fecha - now) / 1000 - (24 * 60 * 60 * daysRound) - (60 * 60 * hoursRound) - (60 * minutesRound);
	secondsRound 	= 	Math.round(seconds);
	if (daysRound 	<= 	"-1") {
		//   IMPORTANTE  //
		//Si el conteo regresivo del script el valor de los días es mayor a -1 se para el script, 
		//ya que la fecha esperada se a cumplido, es necesaria este línea de código ya que si no se pone 
		//seguiria el conteo regresívo pero en valores negativos.
	}
	else{
		if(daysRound<10){
			daysRound	=	"0"+daysRound;
		}
		if(hoursRound<10){
			hoursRound	=	"0"+hoursRound;
		}
		if(minutesRound<10){
			minutesRound	=	"0"+minutesRound;
		}
		if(secondsRound<10){
			secondsRound	=	"0"+secondsRound;
		}
		document.getElementById('dias').innerHTML 	= 	daysRound;
		document.getElementById('horas').innerHTML 	= 	hoursRound;
		document.getElementById('min').innerHTML 	= 	minutesRound;
		document.getElementById('seg').innerHTML 	= 	secondsRound;
	}
	newtime = window.setTimeout("getTime();", 1000);
}