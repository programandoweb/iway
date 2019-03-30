<?php
	$empresa	=	$this->user->empresa;
	$row		=	$this->session->userdata('Encuesta');
?>
<div class="row">
   <div class="form col-md-12">
        <div class="form-group item">
             <h3><b>Información financiera.</b></h3>
        </div>
   </div>
</div>
<div class="row form-group">
   <div class="col-md-4">
        <b class="pregunta">¿Estás trabajando actualmente?</b>
   </div>
   <div class="col-md-4">
        <h6>Si</h6>
        <?php echo set_input_radio("TrabajoActual","","Si",(@$row['TrabajoActual']=="Si")?true:false,"custom-control-input Mostrar TrabajoActual",""); ?>
   </div>
   <div class="col-md-4">
        <h6>No</h6>
        <?php echo set_input_radio("TrabajoActual","","No",(@$row['TrabajoActual']=="No")?true:false,"custom-control-input Mostrar TrabajoActual",""); ?>                  
   </div>  
</div>
<div class="row form-group Opcional">
   <div class="col-md-4">
        <b>¿Cuánto suman tus ingresos actuales? </b>
   </div>
   <div class="col-md-4">
        <?php set_input("IngresosActuales",@$row,$placeholder="Ingresos Actuales",$require=false,"form-control");?>
   </div>
   <div class="col-md-4"></div>
</div>
<div class="row form-group Opcional">
   <div class="col-md-4">
        <b>¿Cuánto suman tus obligaciones mensuales? </b>
   </div>
   <div class="col-md-4">
        <?php set_input("Obligaciones",@$row,$placeholder="Obligaciones Actuales",$require=false,"form-control");?>
   </div>
   <div class="col-md-4"></div>
</div>
<div class="row form-group">
   <div class="col-md-4">
        <b>¿Cuánto requieres ganar  mensualmente?</b> 
   </div>
   <div class="col-md-4">
        <?php set_input("AspiracionSalarial",@$row,$placeholder="Aspiracion Salarial",$require=true,"form-control");?>
   </div>
   <div class="col-md-4"></div>
</div>
<div class="row form-group">
   <div class="col-md-4">
        <b class="pregunta">¿Tienes vehículo?</b>
   </div>
   <div class="col-md-4">
        <h6>Si</h6>
        <?php echo set_input_radio("Vehiculo","","Si",(@$row['Vehiculo']=="Si")?true:false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-4">
        <h6>No</h6>
        <?php echo set_input_radio("Vehiculo","","No",(@$row['Vehiculo']=="No")?true:false,"custom-control-input",""); ?> 
   </div>  
</div>
<script>
  $(document).ready(function() {
	  var respuesta 			= 	$('.TrabajoActual:checked').val();
    	if(respuesta=='No'){
    		$('.Opcional').hide();
    	}else{
        $('.Opcional').show();
      }
    $('.Mostrar').click(function(){
      if($(this).val()=="Si"){
        $('.Opcional').slideDown(250);
        $('.Opcional').find('input').attr('require', true);
        $("a.continuar").removeClass("disabled");//.click(function(){$("form").submit();});
      }else{
        $('.Opcional').slideUp(250);
        $('.Opcional').find('input').removeAttr('require');
      }
    });
  });
</script> 