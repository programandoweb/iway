<?php
     $empresa  =    $this->user->empresa;
     $row      =    $this->session->userdata('Encuesta');
?>
<input type="hidden" require="true" value="1" id="stop" /> 
 <div class="row">
     <div class="form col-md-12">
          <div class="form-group item">
               <h3><b>Perfil socio sexual.</b></h3>
          </div>
     </div>
</div>
<div class=" row form-group">
     <div class="col-md-4">
          <b class="pregunta">¿Puedes sostener conversaciones sobre morbo?</b>
     </div>
     <div class="col-md-4">
          <h6>Si</h6>
          <?php echo set_input_radio("ConversacionMorbo","","Si",(@$row['ConversacionMorbo']=="Si")?true:false,"custom-control-input",""); ?>
     </div>
     <div class="col-md-4">
          <h6>No</h6>
          <?php echo set_input_radio("ConversacionMorbo","","No",(@$row['ConversacionMorbo']=="No")?true:false,"custom-control-input",""); ?>
     </div>  
</div>
<div class=" row form-group">
     <div class="col-md-4">
          <label><b class="pregunta">¿Te masturbas?</b></label>
     </div>
     <div class="col-md-4">
          <h6>Si</h6>
          <?php echo set_input_radio("TeMasturbas","","Si",(@$row['TeMasturbas']=="Si")?true:false,"custom-control-input Mostrar_masturbas",""); ?>
     </div>
     <div class="col-md-4">
          <h6>No</h6>
          <?php echo set_input_radio("TeMasturbas","","No",(@$row['TeMasturbas']=="No")?true:false,"custom-control-input Mostrar_masturbas",""); ?>       
     </div>  
</div>
<div id="masturbas" class=" row form-group" style="display: none;">
     <div class="col-md-4">
          <b class="pregunta">¿Con qué frecuencia?</b>
     </div>
     <div class="row col-md-8">
          <div class="col-md-4">
               <h6>Diariamente</h6>
               <?php echo set_input_radio("ConQueFrecuencia","","Diariamente",(@$row['ConQueFrecuencia']=="Diariamente")?true:false,"custom-control-input",""); ?>
          </div>
          <div class="col-md-4">
               <h6>Al menos una vez por semana</h6>
               <?php echo set_input_radio("ConQueFrecuencia","","Al menos una vez por semana",(@$row['ConQueFrecuencia']=="Al menos una vez por semana")?true:false,"custom-control-input",""); ?>                  
          </div>
          <div class="col-md-4">
               <h6>Al menos una vez al mes</h6>
               <?php echo set_input_radio("ConQueFrecuencia","","Al menos una vez al mes",(@$row['ConQueFrecuencia']=="Al menos una vez al mes")?true:false,"custom-control-input",""); ?>                  
          </div>
     </div>
</div>
<div class="row form-group">
     <div class="col-md-4">
          <label><b class="pregunta">¿Tendrías sexo anal?</b></label>
     </div>
     <div class="col-md-4">
          <h6>Si</h6>
          <?php echo set_input_radio("SexoAnal","","Si",(@$row['SexoAnal']=="Si")?true:false,"custom-control-input",""); ?>
     </div>
     <div class="col-md-4">
          <h6>No</h6>
          <?php echo set_input_radio("SexoAnal","","No",(@$row['SexoAnal']=="No")?true:false,"custom-control-input",""); ?>             
     </div>
</div>
<div class="row form-group">
     <div class="col-md-4">
          <b class="pregunta">¿Ves porno?</b>
     </div>
     <div class="col-md-4">
          <h6>Si</h6>
          <?php echo set_input_radio("VezPorno","","Si",(@$row['VezPorno']=="Si")?true:false,"custom-control-input Mostrar_porno",""); ?>
     </div>
     <div class="col-md-4">
          <h6>No</h6>
          <?php echo set_input_radio("VezPorno","","No",(@$row['VezPorno']=="No")?true:false,"custom-control-input Mostrar_porno",""); ?>          
     </div>  
</div>
<div id="porno" class="row form-group" style="display:none;">
     <div class="col-md-4">
          <b class="pregunta">¿Con qué frecuencia?</b>
     </div>
     <div class="row col-md-8">
          <div class="col-md-4">
               <h6>Diariamente</h6>
               <?php echo set_input_radio("FrecuenciaVezPorno","","Diariamente",(@$row['FrecuenciaVezPorno']=="Diariamente")?true:false,"custom-control-input",""); ?>
          </div>
          <div class="col-md-4">
               <h6>Al menos una vez por semana</h6>
               <?php echo set_input_radio("FrecuenciaVezPorno","","Al menos una vez por semana",(@$row['FrecuenciaVezPorno']=="Al menos una vez por semana")?true:false,"custom-control-input",""); ?>               
          </div>
          <div class="col-md-4">
               <h6>Al menos una vez al mes</h6>
               <?php echo set_input_radio("FrecuenciaVezPorno","","Al menos una vez al mes",(@$row['FrecuenciaVezPorno']=="Al menos una vez al mes")?true:false,"custom-control-input",""); ?>
          </div>  
     </div>     
</div> 
<div class=" row form-group">
     <div class="col-md-4">
          <b class="pregunta">¿Has tenido relaciones sexuales con personas de tu mismo sexo?</b>
     </div>
     <div class="col-md-4">
          <h6>Si</h6>
          <?php echo set_input_radio("RelacionesConMisnoGenero","","Si",(@$row['RelacionesConMisnoGenero']=="Si")?true:false,"custom-control-input",""); ?>
     </div>
     <div class="col-md-4">
          <h6>No</h6>
          <?php echo set_input_radio("RelacionesConMisnoGenero","","No",(@$row['RelacionesConMisnoGenero']=="No")?true:false,"custom-control-input",""); ?>               
     </div>     
</div>
<div class=" row form-group">
     <div class="col-md-4">
          <b class="pregunta">¿Tendrias relaciones sexuales con personas de tu mismo sexo?</b>
     </div>
     <div class="col-md-4">
          <h6>Si</h6>
          <?php echo set_input_radio("TenRelacionesMismoGenero","","Si",(@$row['TenRelacionesMismoGenero']=="Si")?true:false,"custom-control-input",""); ?>
     </div>
     <div class="col-md-4">
          <h6>No</h6>
          <?php echo set_input_radio("TenRelacionesMismoGenero","","No",(@$row['TenRelacionesMismoGenero']=="No")?true:false,"custom-control-input",""); ?>               
     </div>     
</div>
<div class=" row form-group">
     <div class="col-md-4">
          <b class="pregunta">¿Has realizado sexo oral?</b>
     </div>
     <div class="col-md-4">
          <h6>Si</h6>
          <?php echo set_input_radio("RealizaSexoOral","","Si",(@$row['RealizaSexoOral']=="Si")?true:false,"custom-control-input",""); ?>
     </div>
     <div class="col-md-4">
          <h6>No</h6>
          <?php echo set_input_radio("RealizaSexoOral","","No",(@$row['RealizaSexoOral']=="No")?true:false,"custom-control-input",""); ?>   
     </div>       
</div>
<div class=" row form-group">
     <div class="col-md-4">
          <b class="pregunta">¿Has salido con alguien por dinero?</b>
     </div>
     <div class="col-md-4">
          <h6>Si</h6>
          <?php echo set_input_radio("SalidoAlguienDinero","","Si",(@$row['SalidoAlguienDinero']=="Si")?true:false,"custom-control-input",""); ?>
     </div>
     <div class="col-md-4">
          <h6>No</h6>
          <?php echo set_input_radio("SalidoAlguienDinero","","No",(@$row['SalidoAlguienDinero']=="No")?true:false,"custom-control-input",""); ?> 
     </div>       
</div>
<div class=" row form-group">
     <div class="col-md-4">
          <b class="pregunta">¿Has tenido relaciones sexuales por dinero?</b>
     </div>
     <div class="col-md-4">
          <h6>Si</h6>
          <?php echo set_input_radio("SexoPorDinero","","Si",(@$row['SexoPorDinero']=="Si")?true:false,"custom-control-input",""); ?>
     </div>
     <div class="col-md-4">
          <h6>No</h6>
          <?php echo set_input_radio("SexoPorDinero","","No",(@$row['SexoPorDinero']=="No")?true:false,"custom-control-input",""); ?>     
     </div>       
</div>
<div class=" row form-group">
     <div class="col-md-4">
          <b class="pregunta">¿Actualmente tienes pareja sexual estable?</b>
     </div>
     <div class="col-md-4">
          <h6>Si</h6>
          <?php echo set_input_radio("ParejaSexual","","Si",(@$row['ParejaSexual']=="Si")?true:false,"custom-control-input",""); ?>
     </div>
     <div class="col-md-4">
          <h6>No</h6>
          <?php echo set_input_radio("ParejaSexual","","No",(@$row['ParejaSexual']=="No")?true:false,"custom-control-input",""); ?>       
     </div>       
</div>
<div class=" row form-group">
     <div class="col-md-4">
          <b class="pregunta">¿Tienes tatuajes?</b>
     </div>
     <div class="col-md-4">
          <h6>Si</h6>
          <?php echo set_input_radio("Tatuajes","","Si",(@$row['Tatuajes']=="Si")?true:false,"custom-control-input Mostrar",""); ?>
     </div>
     <div class="col-md-4">
          <h6>No</h6>
          <?php echo set_input_radio("Tatuajes","","No",(@$row['Tatuajes']=="No")?true:false,"custom-control-input Mostrar",""); ?>               
     </div>       
</div>
<div class=" row form-group Opcional">
     <div class="col-md-4">
          <b>¿En que parte (s) de tu cuerpo? </b>
     </div>
     <div class="col-md-4">
          <?php set_input("TatuajeParteCuerpo",@$row['TatuajeParteCuerpo'],$placeholder="En que parte (s) de tu cuerpo tienes tatuajes",$require=false,"form-control"); ?>
     </div>
     <div class="col-md-4"></div>       
</div>
<div class=" row form-group">
     <div class="col-md-4">
          <b class="pregunta">¿Tienes pearcing?</b>
     </div>
     <div class="col-md-4">
          <h6>Si</h6>
          <?php echo set_input_radio("Pearcing","","Si",(@$row['Pearcing']=="Si")?true:false,"custom-control-input",""); ?>
     </div>
     <div class="col-md-4">
          <h6>No</h6>
          <?php echo set_input_radio("Pearcing","","No",(@$row['Pearcing']=="No")?true:false,"custom-control-input",""); ?>               
     </div>       
</div>
<div class=" row form-group">
     <div class="col-md-4">
          <b class="pregunta">¿Has practicado sexo con dolor? </b>
     </div>
     <div class="col-md-4">
          <h6>Si</h6>
          <?php echo set_input_radio("SexoConDolor","","Si",(@$row['SexoConDolor']=="Si")?true:false,"custom-control-input SexoDolor",""); ?>
     </div>
     <div class="col-md-4">
          <h6>No</h6>
          <?php echo set_input_radio("SexoConDolor","","No",(@$row['SexoConDolor']=="No")?true:false,"custom-control-input SexoDolor",""); ?>               
     </div>       
</div>
<div id="SexoDolor" class="no_mostrar" style="display: none;">
    <div class=" row form-group">
         <div class="col-md-4">
              <b class="pregunta">¿cómo has actuado? </b>
         </div>
         <div class="col-md-4">
              <h6>Dominante</h6>
              <?php echo set_input_radio("SexoDolorActuado","","Dominante",(@$row['SexoDolorActuado']=="Dominante")?true:false,"custom-control-input",""); ?>
         </div>
         <div class="col-md-4">
              <h6>Sumisa</h6>
              <?php echo set_input_radio("SexoDolorActuado","","Sumisa",(@$row['SexoDolorActuado']=="Sumisa")?true:false,"custom-control-input",""); ?>               
         </div>       
    </div>
</div>    
<div class=" row form-group">
     <div class="col-md-4">
          <b class="pregunta">¿Fumas?</b>
     </div>
     <div class="col-md-4">
          <h6>Si</h6>
          <?php echo set_input_radio("Fuma","","Si",(@$row['Fuma']=="Si")?true:false,"custom-control-input",""); ?>
     </div>
     <div class="col-md-4">
          <h6>No</h6>
          <?php echo set_input_radio("Fuma","","No",(@$row['Fuma']=="No")?true:false,"custom-control-input",""); ?>               
     </div>       
</div>
<div class=" row form-group">
     <div class="col-md-4">
          <b class="pregunta">¿Consumes actualmente Drogas?</b>
     </div>
     <div class="col-md-4">
          <h6>Si</h6>
          <?php echo set_input_radio("Drogas","","Si",(@$row['Drogas']=="Si")?true:false,"custom-control-input",""); ?>
     </div>
     <div class="col-md-4">
          <h6>No</h6>
          <?php echo set_input_radio("Drogas","","No",(@$row['Drogas']=="No")?true:false,"custom-control-input",""); ?>               
     </div>       
</div>
<script>
  $(document).ready(function() {
      <?php echo (@$row['ModeloWeb']=="No")?"$('.Opcional').hide();":""?>
    <?php echo (!isset($row['ModeloWeb']))?"$('.Opcional').hide();":""?>
    
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
    $('.Mostrar_masturbas').click(function(){
       if($(this).val() == "Si"){
            $('#masturbas').fadeIn();
       }else{
            $('#masturbas').fadeOut();
       }
    });
    $('.Mostrar_porno').click(function(){
       if($(this).val() == "Si"){
            $('#porno').fadeIn();
       }else{
            $('#porno').fadeOut();
       }
    });
    $('.SexoDolor').click(function(){
       if($(this).val() == "Si"){
            $('#SexoDolor').fadeIn();
       }else{
            $('#SexoDolor').fadeOut();
       }
    });
  });
</script> 