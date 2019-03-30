<?php
	$empresa	=	$this->user->empresa;
	$row		=	$this->session->userdata('Encuesta');
?>
<div class="form">
     <div class="form-group item">
          <div class="p-3">
               <h3><b>Información general.</b></h3>
          </div>
     </div>
</div>
<div class="row form-group col-md-12">
      <div class="col-md-4">
           <b class="pregunta">¿Cómo obtuviste información de la vacante?</b>
      </div>
      <div class="col-md-8"> 
      			<input type="hidden" require="true" id="next" value="1" />
                <div class="col-md-12"><?php echo set_input_radio("rss","","Facebook",(@$row['rss']=="Facebook")?true:false,"custom-control-input rssotra",""); ?>         
           <label for="">Facebook</label></div>
                <div class="col-md-12"><?php echo set_input_radio("rss","","OLX",(@$row['rss']=="OLX")?true:false,"custom-control-input rssotra",""); ?>  
           <label for="">OLX</label></div>
                <div class="col-md-12"><?php echo set_input_radio("rss","","Instagram",(@$row['rss']=="Instagram")?true:false,"custom-control-input rssotra",""); ?>
           <label for="">Instagram</label></div>
                <div class="col-md-12"><?php echo set_input_radio("rss","","Google",(@$row['rss']=="Google")?true:false,"custom-control-input rssotra",""); ?>
           <label for="">Google</label></div>
                <div class="col-md-12"><?php echo set_input_radio("rss","","Twitter",(@$row['rss']=="Twitter")?true:false,"custom-control-input rssotra",""); ?>
           <label for="">Twitter</label></div>
                <div class="col-md-12"><?php echo set_input_radio("rss","","Tinder",(@$row['rss']=="Tinder")?true:false,"custom-control-input rssotra",""); ?>
           <label for="">Tinder</label></div>
               <div class="col-md-12"><?php echo set_input_radio("rss","","Linkedln",(@$row['rss']=="Linkedln")?true:false,"custom-control-input rssotra",""); ?>
           <label for="">Linkedln</label></div>
           <div class="col-md-12"><?php echo set_input_radio("rss","","Otro",(@$row['rss']=="Otro")?true:false,"custom-control-input rssotra",""); ?>
           <label for="">Otro</label></div>
           	<div class="row col-md-12 no_mostrar" >
           		<h5 class="col-md-2"><b>Otro</b></h5>
           		<div class="col-md-6 md-push-4"> 
                	<?php set_input("OtraRss",@$row,$placeholder='Otra red Social',$require=false);?>
				</div>
			</div> 
      </div>
      <div class="row col-md-12 mt-3">
        <div class="col-md-6">
              <b class="pregunta">¿Te recomienda algún integrante de la empresa?</b>
        </div>
        <div class="row col-md-6"> 
                   <strong class="col-sm-2">Si </strong>
                   <div class="col-sm-4"><?php echo set_input_radio("Recomendado","","Si",(@$row['Recomendado']=="Si")?true:false,"custom-control-input Mostrar",""); ?></div> 
                  <strong class="col-sm-2">No </strong> 
                   <div class="col-sm-4"><?php echo set_input_radio("Recomendado","","No",(@$row['Recomendado']=="No")?true:false,"custom-control-input Mostrar",""); ?></div>
         </div>
      </div>
      <div class="row form-group col-md-12 Opcional">
           <div class="col-md-4">
                <b>Si tu respuesta anterior fue SI, por favor escribe su nombre.</b>
           </div>
           <div class="col-md-8">
                <div class="col-md-8 md-push-4">
                     <?php set_input("Intermediario",@$row,$placeholder='Nombre Completo',$require=false,"form-control");?>
                </div>
           </div>
      </div>
</div>
<script>
	$(document).ready(function() {
		var respuesta 			= 	$('.rssotra:checked').val();
		if(respuesta!='Otro'){
			$("#stop").val("");
			$(".continuar").attr("disabled","disabled");
			$(".no_mostrar").hide();	
		}
		$('.rssotra').click(function(){
			respuesta 			= 	$(this).val();
			if(respuesta!='Otro'){
				$("#stop").val("");
				$(".continuar").addClass("disabled");
				$(".continuar").attr("disabled","disabled");
				$(".no_mostrar").hide();	
			}else{
				$("#stop").val(1);
				$(".continuar").removeAttr("disabled");
				$(".continuar").removeClass("disabled");
				$(".no_mostrar").show();
			}	
		});
		
		$('input').click(function(){
			$("a.continuar").removeClass("disabled").click(function(){$("form").submit();});
		});
		$("a.continuar").click(function(){$("form").submit();});
		<?php echo (@$row['Recomendado']=="No")?"$('.Opcional').hide();":""?>
		<?php echo (!isset($row['Recomendado']))?"$('.Opcional').hide();":""?>
		
		$('.Mostrar').click(function(){
			if($(this).val()=="Si"){
				$('.Opcional').slideDown(1000);
				$('.Opcional').find('input').attr('require', true);
				$("a.continuar").removeClass("disabled");//.click(function(){$("form").submit();});
			}else{
				$('.Opcional').slideUp(1000);
				$('.Opcional').find('input').removeAttr('require');
			}
		});
	});
</script>