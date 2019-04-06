<div id="container_iframe">
	<div class="card embed-responsive embed-responsive embed-responsive-16by91">
		<iframe id="iframe" src="" class="embed-responsive-item" scrolling="no" frameborder="0"></iframe>
	</div>
</div>
<script>
	$(document).ready(function($){
		$(".btn-link").click(function(event){
			history.pushState({"url":$(this).data("url")}, "url");
			$("#iframe").attr("src",$(this).data("url"));
			$.post('<?php echo base_url("Utilidades/links") ?>', {id: $(this).data("id")}, function(data){
				var links = "";
				$.each(data,function(index, el){
					links += '<li><div data-id="'+el.id_link+'" class="btn btn-link text-white" data-url="'+el.url+'">'+el.modulo+' ('+el.contador+')</div></li>';
				});
				$("#homeSubmenu").html($(links));
			},"Json");
		});
		if(history.state == undefined){
			url = '<?php echo base_url("Usuarios/welcome"); ?>';
		}else{
			url = history.state.url;
		}
		$("#iframe").attr("src",url);
		//$("#iframe").css("height",calcularAlturaIframe());
	});
<!--
/* *** iframes *** */
/* Mini-libreria que resuelve las acciones mas comunes con iframes */
/* siempre que los iframes sean del mismo dominio */

/*function getIframe(iframeElement){
	//devuelve el document de un iframe
	return iframeElement.contentDocument;
}
//uso
function calcularAlturaIframe(){
	var innerdoc = getIframe( document.getElementById('iframe') );
	//para saber la altura del contenido del documento del iframe:
	return innerdoc.body.scrollHeight;;
}*/
//-->
</script>
