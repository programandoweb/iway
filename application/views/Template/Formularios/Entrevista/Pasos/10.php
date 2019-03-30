<?php
     $empresa  =    $this->user->empresa;
     $row      =    $this->session->userdata('Encuesta');
?>
<input type="hidden" require="true" value="1" />  
<div class="row">
     <div class="form col-md-12">
          <div class="form-group item">
               <h3><b>Presentación personal.</b></h3>
          </div>
     </div>
</div>
<div class="form-group">
     <div class="col-md-12">
          <b>Queremos recordarte que el modelaje webcam es un trabajo de elegancia y Profesionalismo, por lo cual la presentación personal es fundamental para nuestra empresa, te informamos que está prohibido transmitir con la misma ropa que llegas a nuestras instalaciones, tampoco el uso de Jeans frente a cámara.</b>
     </div>  
</div>
<div class="form-group">
     <div class="col-md-12">

          <b>De igual manera para el caso de las chicas deberán presentarse siempre maquilladas y con las uñas en perfecto estado, igualmente deberás estar con un mínimo de treinta (30) minutos antes, recuerda llevar tu cabello y lencería siempre en perfecto estado y completamente aseado.</b>

     </div>
</div>
 <div class=" row form-group">
     <div class="col-md-4">
          <label><b class="pregunta">¿Utilizas maquillaje?</b></label>
     </div>
     <div class="col-md-4">
          <h6>Si</h6>
          <?php echo set_input_radio("Maquillaje","","Si",(@$row['Maquillaje']=="Si")?true:false,"custom-control-input",""); ?>
     </div>
     <div class="col-md-4">
          <h6>No</h6>
          <?php echo set_input_radio("Maquillaje","","No",(@$row['Maquillaje']=="No")?true:false,"custom-control-input",""); ?>        
     </div>  
</div>
<div class="row form-group">
       <div class="col-md-4">
            <b>Color del cabello </b>
       </div>
       <div class="col-md-4">
            <?php echo MakePelo("ColorPelo",@$row["ColorPelo"],array("Class"=>"form-control")); ?>
       </div>
       <div class="col-md-4"></div>  
</div>
 <div class="row form-group">
       <div class="col-md-4">
            <b>Longitud del Cabello </b>
       </div>
       <div class="col-md-4">
            <?php echo MakeLargoPelo("ColorLargoPelo",@$row["ColorLargoPelo"],array("Class"=>"form-control")); ?>
       </div>
       <div class="col-md-4"></div>  
</div>
<div class=" row form-group">
     <div class="col-md-4">
          <label><b class="pregunta">¿Utilizas accesorios?</b></label>
     </div>
     <div class="col-md-4">
          <h6>Si</h6>
          <?php echo set_input_radio("Accesorios","","Si",(@$row['Accesorios']=="Si")?true:false,"custom-control-input Mostrar",""); ?>
     </div>
     <div class="col-md-4">
          <h6>No</h6>
          <?php echo set_input_radio("Accesorios","","No",(@$row['Accesorios']=="No")?true:false,"custom-control-input Mostrar",""); ?>
     </div>  
</div>
<div class="row form-group Opcional">
       <div class="col-md-4">
            <b>Tamaño de tus accesorios </b>
       </div>
       <div class="col-md-4">
            <?php echo Accesorios("TamAccesorios",@$row["TamAccesorios"],array("Class"=>"form-control")); ?>
       </div>
       <div class="col-md-4"></div>  
</div>
<div class="row form-group">
       <div class="col-md-4">
            <b>Estado de las uñas de tus manos. </b>
       </div>
       <div class="col-md-4">
            <?php echo TamAccesorios("TamAccesoriosManos",@$row["TamAccesoriosManos"],array("Class"=>"form-control")); ?>
       </div>
       <div class="col-md-4"></div>  

</div>
<div class="row form-group">
       <div class="col-md-4">
            <b>Estado de las uñas de tus pies. </b>
       </div>
       <div class="col-md-4">
            <?php echo TamAccesorios("EstadoUñasPies",@$row["EstadoUñasPies"],array("Class"=>"form-control")); ?>
       </div>
       <div class="col-md-4"></div>  
</div>
<script>
  $(document).ready(function() {
    $('input').click(function(){
      $("a.continuar").removeClass("disabled").click(function(){$("form").submit();});
    });
    $("a.continuar").click(function(){$("form").submit();});
    <?php echo (@$row['Accesorios']=="No")?"$('.Opcional').hide();":""?>
    <?php echo (!isset($row['Accesorios']))?"$('.Opcional').hide();":""?>
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