/*MODAL */
var url = window.location;
function lightbox(){
	btns	=	$(".lightbox");
	btns.each(function(index,v){		
		var btn =	$(v);
		/*
		btn.bind('contextmenu', function(e) {
			return false;
		});
		*/ 
		btn.click(function(event){
			make_modal_ajax(btn);
			return false;	
		})
	});	
}

function make_modal_ajax(obj){
	var size		=	obj.data("size");if(!size){size='modal-lg';	}
	var height		=	obj.data("height");if(!height){height=450;	}
	$modal			=	modal.clone();	
	var contenido  	=	$modal.find(".modal-dialog").find(".modal-content");
		$modal.addClass("pgrw_modal_confirm_ajax").attr("aria-labelledby","modalLabel_confirm_ajax").find(".modal-dialog").addClass(size);
		if(size == "modal-sm"){
			$modal.addClass('modal_margin_top');
		}
		contenido.find(".modal-header").html("<h5>"+'<i class="fas fa-info-circle"></i> ' +obj.attr("title")+"</h5><button type='button' class='btn btn-warning cancelar' data-dismiss='modal'><b>x</b></button>");
		//contenido.find(".modal-footer").html('<button type="button" class="btn btn-warning cancelar" data-dismiss="modal"><i class="fas fa-window-close"></i> Cerrar</button>');
	$("body").append($modal);
	$modal.find(".modal-body").html('<div class="text-center"><i class="fa fa-cog fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span></div>');
	if(obj.data("type")=='iframe'){
		$iframe		=	$('<iframe src="'+obj.attr("href")+'" allowfullscreen="" frameborder="0" width="100%" height="100%" /><div class="col-md-12 text-center"><div id="message_iframe"></div></div>');
		$modal.find(".modal-body").height(height).html($iframe);
	}
	$modal.modal({ keyboard: true})	
	if(obj.data("event")=='reload'){
		$modal.on('hidden.bs.modal', function (e) {
			url.reload();
			//document.location.reload();
		})
		/*
		$modal.on("hide.bs.modal", function () {
			document.location.reload();
		})*/		
	}
}


/*MODAL END */

$(document).ready(function(){
	lightbox();
	//console.log(window.history);
	//history.pushState(null, "", " ");
	
	$("input[type='search']").on("keyup", function () {
		alert('keyup');
	});
	make_message("Bienbenido a tu asistente de configuracion",);
	/*table.on( 'search.dt', function () {
		recalcular($(this).find("tbody"));
	});*/

	$('#departamento').attr("readonly","readonly");
	$('#pais').attr("readonly","readonly");
	
	donde_debitar();
	money();
	//anular();
	id_equivalencia();
	pgrw_rooms();
	pgrw_ajax();
	pgrw_recharge();
	remove_flash();
	_confirm();
	getTime();
	input_dinamico();
	//validar_file_upload();
	upcase();
	clonar();
	printer();
	change_ciclos_id();
	Opciones_excel();
	salto();
	tabs();
	popup();
	identificacion();
	Info_Formulario_Dinamico();
	//check_email();
	validarExtension();
	meta_ideal();
	confirma_proveedor();
	configEmail();

	/*$(function () {
	    $("#fecha").datepicker({
	        closeText: 'Cerrar',
	        prevText: '<Ant',
	        nextText: 'Sig>',
	        currentText: 'Hoy',
	        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
	        monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
	        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
	        dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
	        dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
	        weekHeader: 'Sm',
	        dateFormat: 'dd/mm/yy',
	        firstDay: 1,
	        isRTL: false,
	        showMonthAfterYear: false,
	        yearSuffix: ''
	    });
	});*/
	var ordenar_tabla = $(".ordenar"); 
	if(ordenar_tabla.length){
		//ordenar_tabla();
		if($('.ordenar').attr("ordercol")){
			var ordercol	=	$('.ordenar').attr("ordercol");	
		}else{
			var ordercol	=	2;	
		}
		if($('.ordenar').attr("order")){
			var order	=	$('.ordenar').attr("order");	
		}else{
			var order	=	"asc";	
		}
		var table 		=	$('.ordenar').DataTable({
			"paging":   false,
			"pageLength": 50,
			"order": [[ ordercol, order ]],
			"language": {
				"url": "design/Spanish.json"
			},
			"initComplete": function(settings, json) {
				var obj = 	$(this);
				   $('#'+$(this).attr("id")+'_filter input').bind('keyup', function(e) {
					
					var trs	=	obj.find("tbody").find("tr");
					if(trs.length>0){
						var valor = 0;
						var valor2 = 0;
						var valor3 = 0;
						var cont = 0;
						trs.each(function(index,v){
							cont+1;
							var num3 = 	parseFloat($(v).find("td").find(".monto_oculto3").val());
							var num2 = 	parseFloat($(v).find("td").find(".monto_oculto2").val());	
							var num = 	parseFloat($(v).find("td").find(".monto_oculto").val());
							valor	=	valor + num;
							valor2	=	valor2 + num2;
							valor3	=	(valor3 + num3)/cont;							
	
							$("#total_general").html(valor.toFixed(2));
							$("#total_general2").html(valor2.toFixed(2));
							$("#total_general3").html(valor3.toFixed(2));
						})		
						//console.log(valor);
					}	
					
					//console.log(obj.find("tbody").find("tr").find("td:last").find(".monto_oculto").val())
				}); 
			}
		});
	}
});

/*function ordenar_tabla(){
	if($('.ordenar').attr("ordercol")){
		var ordercol	=	$('.ordenar').attr("ordercol");	
	}else{
		var ordercol	=	2;	
	}
	if($('.ordenar').attr("order")){
		var order	=	$('.ordenar').attr("order");	
	}else{
		var order	=	"asc";	
	}
	var table 		=	$('.ordenar').DataTable({
        "paging":   false,
		"pageLength": 50,
		"order": [[ ordercol, order ]],
		"language": {
			"url": "design/Spanish.json"
		},
		"initComplete": function(settings, json) {
			var obj = 	$(this);
           	$('#'+$(this).attr("id")+'_filter input').bind('keyup', function(e) {
				
				var trs	=	obj.find("tbody").find("tr");
				if(trs.length>0){
					var valor = 0;
					var valor2 = 0;
					var valor3 = 0;
					var cont = 0;
					trs.each(function(index,v){
						cont+1;
						var num3 = 	parseFloat($(v).find("td").find(".monto_oculto3").val());
						var num2 = 	parseFloat($(v).find("td").find(".monto_oculto2").val());	
						var num = 	parseFloat($(v).find("td").find(".monto_oculto").val());
						valor	=	valor + num;
						valor2	=	valor2 + num2;
						valor3	=	(valor3 + num3)/cont;							

						$("#total_general").html(valor.toFixed(2));
						$("#total_general2").html(valor2.toFixed(2));
						$("#total_general3").html(valor3.toFixed(2));
					})		
					//console.log(valor);
				}	
				
				//console.log(obj.find("tbody").find("tr").find("td:last").find(".monto_oculto").val())
            }); 
        }
	});
}*/

/*function validar_form_sin_require(selector){
    $('button[type="submit"]').click(function(event){
        var data = $(selector);
        event.preventDefault();
        var input = 0;
        data.each(function(index, el) {
            if(el.value.length > 0){
                if(el.value != "Seleccione"){
                    input += 1;
                    if(input == 3){
                        $('form').submit();
                    }
                }else{
                    $(this).parent("div").parent("div").find('.advertencia').html('<div class="alert alert-danger" role="alert"><strong>Importante!</strong> Este campo es obligatorio.</div>');
                }
            }else{
                $(this).parent("div").parent("div").find('.advertencia').html('<div class="alert alert-danger" role="alert"><strong>Importante!</strong> Este campo es obligatorio.</div>');
            }
        });
    });
}*/

function configEmail(){
	$('#configEmail').click(function(e){
		e.preventDefault();
		$('#OpcionesEmail').modal('toggle');
	});
}

function agregar_correo_tabla($obj){
	var fila = '<tr><td>'+$obj.correo+'</td><td class="text-center"><a href="'+$obj.url+'"><i class="fas fa-trash"></i></a></td></tr>';
	$('#correo').prepend(fila);
	$('input').val('');
}

function validar($identificador){
    var inputs = $($identificador);
    var index = []; 
    var container = $('<div id="advertencia_input"></div>');
    $('button[type="submit"]').parent('div').prepend(container);
    inputs.each(function(i, elem){
        index.push(elem.value);
    });
    var response = false;
    $('button[type="submit"]').click(function(e){
        e.preventDefault();
        inputs.each(function(k, v) {
            if(v.value != index[k]){
                response = true;
                return response;
            }
        });
        if(response){
        	$('#advertencia_input').html('');
            $(this).submit()
        }else{
            var contenedor = $('<div class="alert alert-danger col-md-12" role="alert"><strong>Importante: </strong> debe realizar un cambio para continuar, de lo contrario pulsar boton cerrar.</div>');
            $('#advertencia_input').html(contenedor);
        }
    })
}

 function solonumeros(selector){
      $(selector).keydown(function(e) {
         var key = e.charCode || e.keyCode || 0;
         // allow backspace, tab, delete, arrows, numbers and keypad numbers ONLY
         return (
           key == 8 ||
           key == 9 ||
           key == 46 ||
           (key >= 37 && key <= 40) ||
           (key >= 48 && key <= 57) ||
           (key >= 96 && key <= 105));
      });
 }

function validarExtension() {
    $('#file').click(function() {
        var e = $("#foto").click();
        e.change(function(img){
            var name = img.target.files[0];
            if(validarArchivo(this)){
                $("#file").html('<span> '+name["name"]+'</span>');

            }else{
                make_message("Error","Este tipo de archivo no es permitido");
            }
        });
    });

	function validarArchivo(datos){
	    var extensionesValidas = ".png, .gif, .jpeg, .jpg";
	    var ruta = datos.value;
	    var extension = ruta.substring(ruta.lastIndexOf('.') + 1).toLowerCase();
	    var extensionValida = extensionesValidas.indexOf(extension);
	    if(extensionValida < 0) {

	        return false;

	    }else{

	        return true;

	    }
	}
}

function diasEnUnMes(mes, año) {
	return new Date(año, mes, 0).getDate();
}

function recalcular(obj){
	//console.log(obj)
	console.log($('.monto_oculto'));
	var trs	=	obj.find("tr");
	if(trs.length>0){
		trs.each(function(index,v){
			console.log($(v).find("td:last").find(".monto_oculto").val())
		})		
	}	
}

function Info_Formulario_Dinamico(){

    /*$('.verificar').change(function() {
        var TipoMoto = $('#ddlTipoMoto').val();
        var TipoServicio = $('#ddlTipoServicio').val();
        var valSelector = $(this).val();
        var selector = $(this).attr("id");
        var CampoDinamico;
        if(selector == "ddlTipoRevision"){
            CampoDinamico = ["id_Tipo_Revision",valSelector];
        }else{
            CampoDinamico = ["id_Actividad_OT",valSelector];
        }
        $.post(uri+'/ordenTrabajo/VerificarOT',{TipoMoto:TipoMoto,TipoServicio:TipoServicio,CampoDinamico:CampoDinamico}, function($data){
            if($data === "true"){
                make_message("Error","Esta orden de trabajo ya existe");
                $("#boton").attr('disabled','disabled');
                alert("Esta orden de trabajo ya existe");
            }else{
                $("#boton").removeAttr('disabled');
            }
        });*/

}

	function makemail(data){
		var sucursal = $('#identificacion').data("sucursal");
		data	=	data.toLowerCase();
		data	=	getCleanedString(data);
		$("#contenedor_email").val(data);
		$("#email").html(data+'.'+sucursal);
	}

function identificacion(){
	elems	=	$("[data-dependiente]");
	elems.each(function() {
		var elem	=	$(this);
		elem.keyup(function(e){
			var code 	= 	(e.keyCode ? e.keyCode : e.which);
			if(elem.val().length>7 && elem.val().length<32){
					//$(".ocultar").fadeOut();
				 	$.post(elem.data("action"),{key:$(this).val()},function(data){
					},'json').fail(function() {
						make_message("Error","consulte al administrador de sistemas");
					}).done(function(data){
						if(data.code == 203){						
							$('#alert').html('');
							$('button[type="submit"]').removeAttr("disabled");
						}
						if(data.code==200){
							$('#alert').html('<div class="alert alert-danger offset-md-6" role="alert"><strong>Importante: </strong>Este Usuario '+ elem.val()+', '+data.message+'</div>');
							$('button[type="submit"]').attr("disabled","disabled");
						}
					});	
					return false; 
				//console.log(code);
			}else{
				if(elem.val().length<8){
					$('#alert').html('<div class="alert alert-danger offset-md-6" role="alert"><strong>Importante: </strong> Nombre de usuario debe ser mínimo de ocho (8) caracteres.</div>');
				}
				if(elem.val().length>32){
					$('#alert').html('<div class="alert alert-danger offset-md-6" role="alert"><strong>Importante: </strong> Nombre de usuario no debe superar los treinta y dos (32) caracteres</div>');
				}
			}
		})
	});
}

/* function check_email(){
	$("#correo").focusout(function(){
		var correo = $(this).val();
		var url = $(this).data("url");
		$.post(url,{email:correo},function(data){
			},'json').fail(function(){
				make_message("Error Critico","Por favor consulte al administrador del sistema");
				//$(".form").remove();
			}).done(function(data){
				console.log(data);
				if(data.code==200){
					make_message("Importante","Este correo electronico : "+correo+", ya fue registrado en el sistema por favor elija otro.");
					$("#correo").val('');
				}
			});
	});
}*/


function windows_reload(){
	parent.location.reload();
}

function set_inputs(objs){
	var obj	=	JSON.parse(objs.data);
	$.each(obj, function(k,v){
		$('[name="'+k+'"]').val(v);
	});
	$("#dependiente2").fadeIn();		
}

function getCleanedString(cadena){
   // Definimos los caracteres que queremos eliminar
   var specialChars = "!@#$^&%*()+=-[]\/{}|:<>?,.";

   // Los eliminamos todos
   for (var i = 0; i < specialChars.length; i++) {
       cadena= cadena.replace(new RegExp("\\" + specialChars[i], 'gi'), '');
   }   

   // Lo queremos devolver limpio en minusculas
   cadena = cadena.toLowerCase();

   // Quitamos espacios y los sustituimos por _ porque nos gusta mas asi
   cadena = cadena.replace(/ /g,"_");

   // Quitamos acentos y "ñ". Fijate en que va sin comillas el primer parametro
   cadena = cadena.replace(/á/gi,"a");
   cadena = cadena.replace(/é/gi,"e");
   cadena = cadena.replace(/í/gi,"i");
   cadena = cadena.replace(/ó/gi,"o");
   cadena = cadena.replace(/ú/gi,"u");
   cadena = cadena.replace(/ñ/gi,"n");
   return cadena;
}

function popup(){
	$(".popup").click(function(event){
		window.open($(this).attr("href"));		
		event.preventDefault();
	});	
}

function historyback(){
	$(".historyback").click(function(){
		window.history.back();
	});	
	if($(".historyback").length>0){
		$("input[name='redirect']").val(document.referrer);
	}
}

function tabs(){
	var hashValue 	= 	location.hash;
	hashValue		= 	hashValue.replace(/^#/, ''); 
	$("input[name='url']").val(window.location.href); 
	$(".bd-example-tabs .nav-link").click(function(){
		window.location.hash = $(this).attr("href");
		$("input[name='url']").val(window.location.href)
	});
	if(hashValue!=''){
		$(".bd-example-tabs .nav-link").removeClass("active");
		$(".bd-example-tabs .tab-pane").removeClass("active");
		$("#"+hashValue+"-tab").addClass("active");
		$("#"+hashValue).addClass("active show");
	}else{
		if($( ".bd-example-tabs .nav-item .nav-link" ).hasClass("active")){
		}else{
			$( ".bd-example-tabs .nav-item:first .nav-link" ).addClass("active show");
			$( ".bd-example-tabs .tab-content:first .tab-pane" ).addClass("active show");	
		}
		
		/*
		var nav_link	=	$( ".bd-example-tabs .nav-item .nav-link" );
		var tab_pane	=	$( ".bd-example-tabs .tab-content .tab-pane" );
		
		if(nav_link.length>0){
			nav_link.each(function(index,v){
				console.log($(this));
			})
		}
		//$( ".bd-example-tabs .nav-item .nav-link" ).addClass("active show");
		//$( ".bd-example-tabs .tab-content .tab-pane" ).addClass("active show");	
		*/
	}	
}

jQuery.fn.SoloNumeros =
  function() {
    return this.each(function() {
      $(this).keydown(function(e) {
        var key = e.charCode || e.keyCode || 0;
        // allow backspace, tab, delete, arrows, numbers and keypad numbers ONLY
        return (
          key == 8 ||
          key == 9 ||
          key == 46 ||
          (key >= 37 && key <= 40) ||
          (key >= 48 && key <= 57) ||
          (key >= 96 && key <= 105));
      });
    });
  };  

function salto(){
	var obj_salto	=	$(".salto");
	if(obj_salto.length>0){
		obj_salto.each(function(index,v){
			var size	=	$(this).attr("maxlength");
			var next	=	$(this).data("salto");
			$(this).keyup(function(){
				if(size==$(this).val().length){
					$("#"+next).focus();
				}
			});
		})
	}
}

function Opciones_excel(){
	$('#submenu').find('.pdf').attr('target', '_blank');
	var url 	= $('#submenu').find('.excel').attr('href');
	var tablas 	= $('.table').parent('div');
	var email = '';
	var html 	= [];
	tablas.each(function(index, el) {
		html += $(this).html();	
	});

	var form = '<div id="excel" class="nav-link" title="Descargar Excel" style="cursor:pointer;"><i class="fa fa-file-excel" aria-hidden="true"></i><div style="display:none;"><form id="downloadexcel" action="'+url+'" method="post"> <input type="hidden" name="filename" value="'+$("#filename").val()+'"/><textarea name="html" id="html" cols="30" rows="10" require="true">'+html+'</textarea></form></div></div>';
	$('#submenu').find('.excel').replaceWith(form);
	$('#mail').click(function(e){
		e.preventDefault();
		if($('#Opciones_excel').is(":visible") ){
		    $('#Opciones_excel').hide();
		}else{
		    $('#Opciones_excel').show();
		}
	});
	$('#email').keyup(function() {
		email = $(this).val();
		if(email != ''){
			$('#enviar').removeAttr('disabled');
		}else{
			$('#enviar').attr('disabled','disabled');
		}
	});
	$('#enviar').click(function(event) {
		event.preventDefault();
		email = $('#email').val();
		var url 	= $('#Opciones_excel>form').attr('action');
	    var caract = new RegExp(/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/);

	    if (caract.test(email) == false){
	        make_message('Fatal Error','El correo que intentas ingresar no es valido por favor intentalo de nuevo con un formato como el siguiente info@webcamplus.com.co')

	        return false;
	    }else{
			var html 	= [];
			tablas.each(function(index, el) {
				html += $(this).html();	
			});
			var contenido = new Array(html,email);
			$.post(url,{html:html,email:email}, function() {
				make_message('felicitaciones','El documento ha sido enviado con exito');
			});
			contenido[0] = null;
			contenido[1] = null;
			html = null;
			url = null;
			email = null;
		}
	});

	$('#excel').click(function() {
		$('#downloadexcel').submit();
	});

}


function change_ciclos_id(){
	$("#change_ciclos_id").change(function(){
		var form =$(this).parent("form");
		if($(this).val()!=''){
			form.submit();
		}
	});	
}

function donde_debitar(){
	var div	= $('<div><select class="form-control" disabled require=true name="value"></select><input type="hidden" name="procesador_destino_codigo_contable" id="procesador_destino_codigo_contable"/><input type="hidden" name="procesador_destino_codigo_contable_subfijo" id="procesador_destino_codigo_contable_subfijo"/></div>');
	if($("#donde_debitar").length>0){
		$("#donde_debitar").parent("div").append(div.addClass("mt-3"));
	}
	$("#donde_debitar").change(function(){
		
		if($(this).val()!=''){
			$.post($(this).data("href"),{value:$(this).val()},function(data){
				var html='';
				$.each(data.response, function (index, v) {
					html	+=	'<option data-cc="'+v.codigo_contable+'" data-ccsf="'+v.codigo_contable_subfijo+'" value="'+v.value+'">'+v.title+'</option>';
				})
				if(html!=''){
					div.find("select").html(html).removeAttr("disabled").change(function(){
						div.find("#procesador_destino_codigo_contable").val(div.find("select option:selected").data("cc"));
						div.find("#procesador_destino_codigo_contable_subfijo").val(div.find("select option:selected").data("ccsf"));	
					});
					div.find("#procesador_destino_codigo_contable").val(div.find("select option:selected").data("cc"));
					div.find("#procesador_destino_codigo_contable_subfijo").val(div.find("select option:selected").data("ccsf"));
				}else{
					div.find("select").html("").attr("disabled","disabled");
				}
				//console.log(data.response);
				//console.log(data);
			},'json');
		}else{
			return false;	
		}
	});	
}

function makemoney(obj){
	var clonar	=	$('<input type="hidden" />');
	obj.mask("#,##0.00", {reverse: true});
	var clon	=	clonar.clone();
	clon.attr("name",obj.attr("name"));
	obj.removeAttr("name");
	obj.parent("div").append(clon);
	clon.val(circumference(obj.val()));
	obj.keyup(function(e){
		clon.val(circumference($(this).val()));
	});	
}

function money(){
	var inputs	=	$('.money');
	var clonar	=	$('<input type="hidden" class="sumar" />');
	inputs.each(function(index,v){
		$(this).mask("#,##0.00", {reverse: true});
		var clon	=	clonar.clone();
		clon.attr("name",$(this).attr("name"));
		clon.val(circumference($(this).val()));
		if($(this).attr("monto_oculto")=="true"){
			clon.attr("class","monto_oculto");
		}
		if($(this).attr("data-remove")=="undefined"){
			$(this).removeAttr("name");
		}else{
			$(this).removeAttr("name");
		}
		$(this).parent("div,td").append(clon);
		$(this).keyup(function(e){
			clon.val(circumference($(this).val()));
		});		
	})
}

function meta_ideal(){
	var enviar = false;
	var val = 0;
	$('[meta_ideal]').dblclick(function(){
		val = $(this).val();
		$(this).removeAttr('readonly');
		var input = $(this);
		var form  = $(this).parent('form');
		var input_oculto = $(this).parent('form').find(".monto_oculto");
		$(this).keypress(function(e){
			if(e.which ==13){
				e.preventDefault();
				$(this).focusout();
			}
		});
		input.keyup(function(){
			input_oculto.val(circumference($(this).val()));
		});
		input.focusout(function(){
			if($(this).val() == ''){
				$(this).val(0);
			}
			if(val != $(this).val()){
				enviar = true;
			}
			if(enviar){
				post_ajax(form);
				enviar = false;
				val = $(this).val();
				return true
			}
		});
	});
}

function circumference(r) {
  if (Number.isNaN(Number.parseFloat(r))) {
    return 0;
  }
  return  parseFloat(r.replace(/,/g, ''));
}

function CalcularDv(){ 
     var arreglo, x, y, z, i, nit1, dv1;
        nit1= $('#identificacion').val();
        if (isNaN(nit1))
        {
        $('#identificacion_ext').val("X");
          make_message('Importante','Número del Nit no valido, ingrese un número sin puntos, ni comas, ni guiones, ni espacios');       
        }else{
        arreglo = new Array(16); 
        x=0 ; y=0 ; z=nit1.length ;
        arreglo[1]=3;   arreglo[2]=7;   arreglo[3]=13; 
        arreglo[4]=17;  arreglo[5]=19;  arreglo[6]=23;
        arreglo[7]=29;  arreglo[8]=37;  arreglo[9]=41;
        arreglo[10]=43; arreglo[11]=47; arreglo[12]=53;  
        arreglo[13]=59; arreglo[14]=67; arreglo[15]=71;
      for(i=0 ; i<z ; i++)
        { 
         y=(nit1.substr(i,1));
         x+=(y*arreglo[z-i]);
        } 
      y=x%11
      if (y > 1){ dv1=11-y; } else { dv1=y; }
        $('#identificacion_ext').val(dv1);
        console.log(dv1);
        }
    }

function notificaciones(){
	var num_intentos_fallidos=0;
	var url_notificaciones	=	$("body").data("notificaciones");
	if(url_notificaciones!='undefined'){
		var interval	=	setInterval(function(){ $.post(url_notificaciones,{token:$("body").data("token")},function(data){
			if(data.code==203){
				if(num_intentos_fallidos>=3){
					clearInterval(interval);
					return false;
				}else{
					num_intentos_fallidos++;
				}
			}else if(data.code==200){
				if(data.rows.length>0){
					var resumen='';
					$.each(data, function (index, value) {
						resumen += value;
					});
					make_message("Notificaciones","Tienes nuevas actividades qué realizar<br><a href='Utilidades/List_Notificaciones'> Ver </a>");				
				}
			}
		},'json');}, 10000);			
	}
}

function printer(){
	$(".fa-print").parent("a").click(function(event){
		printDiv();
		event.preventDefault();
	});
}
function printDiv() {
	var contenido= document.getElementById("imprimeme").innerHTML;
	var contenidoOriginal= document.body.innerHTML;
	document.body.innerHTML = contenido;
	window.print();
	document.body.innerHTML = contenidoOriginal;
}

function format_num(){
	$(".format_num").number( true, 2 );	
}

function anular(){
	$(".anular").click(function(){
		make_message($(this).data("title"),$(this).data("message"));
		return false;	
	})	
}

function error(title,message){
	make_message(title,message);
	return false;	
}

function makeCanvas(ctx){
	eval('var objeto ='+ctx.data("objeto"));	
	
	var	andres			=	{	'Red':{"bg":"rgba(255, 99, 132, 0.2)","bd":"rgba(255,99,132,1)"}, 
								'Blue':{"bg":"rgba(54, 162, 235, 0.2)","bd":"rgba(54, 162, 235, 1)"}, 
								'Yellow':{"bg":"rgba(255, 206, 86, 0.2)","bd":"rgba(255, 206, 86, 1)"}, 
								'Green':{"bg":"rgba(75, 192, 192, 0.2)","bd":"rgba(75, 192, 192, 1)"}, 
								'Purple':{"bg":"rgba(153, 102, 255, 0.2)","bd":"rgba(153, 102, 255, 1)"}, 
								'Orange':{"bg":"rgba(255, 159, 64, 0.2)","bd":"rgba(255, 159, 64, 1)"},
								'Agua_Amarilla':{"bg":"rgba(152, 102, 255, 0.2)","bd":"rgba(153, 102, 255, 1)"},
								'b':{"bg":"rgba(151, 102, 255, 0.2)","bd":"rgba(153, 102, 255, 1)"},
								'c':{"bg":"rgba(150, 102, 255, 0.2)","bd":"rgba(153, 102, 255, 1)"},
								'e':{"bg":"rgba(149, 102, 255, 0.2)","bd":"rgba(153, 102, 255, 1)"}
							};
	
	
	var backgroundColor	=	[];
	var	borderColor		=	[];
	var	datos			=	[];
	
	console.log(objeto);
	
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
	var myCapitalizeText = $('.MayusculasTodas');
	var myFirstLetterText = $('.PrimeraMayuscula');  
	myCapitalizeText.keyup(function(){
		$(this).val($(this).val().toUpperCase());
	});
	myFirstLetterText.keyup(function(){
		$(this).val($(this).val().firstLetterUpper());
	}); 
}

/*function validar_file_upload(){
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
}*/

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
		 alert ("Todo correcto. Voy a enviar el formulario.");
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
		contenido.find(".modal-header").html('<h5>'+title+'</h5><button type="button" class="btn btn-warning cancelar" data-dismiss="modal">Cerrar</button>');
		//contenido.find(".modal-footer").html('<button type="button" class="btn btn-warning cancelar" data-dismiss="modal">Cerrar</button>');
	$("body").append($modal);
	$modal.find(".modal-body").html('<div class="text-center"> '+message+'</div>');
	$modal.modal({ keyboard: false})			
}

function input_dinamico(){
	inputs	=	$("[input_dinamico]");	
	inputs.each(function(index,v){
		console.log(v);
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

function confirma_proveedor(){
	var url	=	$("[data-proveedor]").data('proveedor');
	var input = $("[data-proveedor]");
	input.keyup(function(){
		var parametro = $(this).val();
		$.post(url,{proveedor:parametro},function(data){
		},'json').fail(function() {
			//alert("Error consulte al administrador de sistemas");
		}).always(function(data) {
			if(data.code==200){
				console.log('Exito');
				$('#mesagge').html('');
			}
			if(data.code == 203){
				$('#mesagge').html('<div class="alert alert-danger col-md-12" role="alert"><strong>Importante:</strong> Este proveedor no existe.</div>');
				input.focusout(function(){
					$(this).val('');
				});
			}
			if(data.callback){
				eval(data.callback);
			}
		});
	});
	return;		
}

function post_ajax(form){
	$.post(form.attr("action"),form.serialize(),function(data){
	},'json').fail(function() {
		alert("Error consulte al administrador de sistemas");
	}).always(function(data) {
		if(data.message){						
			make_message("Felicitaciones",data.message);
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

function closeAll(){
	$(document).keyup(function (event) {
		if (event.which === 27) {
			
		}
	});
}

var	modal	=	$('<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"></div><div class="modal-body"></div><div class="modal-footer"></div></div></div></div>');

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
	$("#room_transmision").html("");
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
		console.log(v)
		var elem	=	$(v);
		elem.click(function(){
			if(confirm("Está seguro de anular este registro?")){
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

function reloader_page(){
	location.reload();
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