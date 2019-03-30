<?php
     $empresa  =    $this->user->empresa;
     $row      =    $this->session->userdata('Encuesta');
?>
<input type="hidden"  require="true" value="1"/>
<div class="row">
   <div class="form col-md-12">
        <div class="form-group item">
             <h3><b>Facultades personales.</b></h3>
        </div>
   </div>
</div>
<div class=" row form-group">
   <div class="col-md-4">
        <b class="pregunta">¿Aprendes fácilmente?</b>
   </div>
   <div class="col-md-4">
        <h6>Si</h6>
        <?php echo set_input_radio("AprendeFacil","","Si",(@$row['AprendeFacil']=="Si")?true:false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-4">
        <h6>No</h6>
        <?php echo set_input_radio("AprendeFacil","","No",(@$row['AprendeFacil']=="No")?true:false,"custom-control-input",""); ?>         
   </div>       
</div>
<div class=" row form-group">
   <div class="col-md-4">
        <b class="pregunta">¿Te gustan los retos?</b>
   </div>
   <div class="col-md-4">
        <h6>Si</h6>
        <?php echo set_input_radio("Retos","","Si",(@$row['Retos']=="Si")?true:false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-4">
        <h6>No</h6>
        <?php echo set_input_radio("Retos","","No",(@$row['Retos']=="No")?true:false,"custom-control-input",""); ?> 
   </div>       
</div>
<div class=" row form-group">
   <div class="col-md-4">
        <b class="pregunta">¿Puedes obedecer órdenes?</b>
   </div>
   <div class="col-md-4">
        <h6>Si</h6>
        <?php echo set_input_radio("Ordenes","","Si",(@$row['Ordenes']=="Si")?true:false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-4">
        <h6>No</h6>
        <?php echo set_input_radio("Ordenes","","No",(@$row['Ordenes']=="No")?true:false,"custom-control-input",""); ?>
   </div>       
</div>
<div class=" row form-group">
   <div class="col-md-4">
        <b class="pregunta">¿Rompes las reglas?</b>
   </div>
   <div class="col-md-4">
        <h6>Si</h6>
        <?php echo set_input_radio("RompesReglas","","Si",(@$row['RompesReglas']=="Si")?true:false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-4">
        <h6>No</h6>
        <?php echo set_input_radio("RompesReglas","","No",(@$row['RompesReglas']=="No")?true:false,"custom-control-input",""); ?>         
   </div>       
</div>
<div class=" row form-group">
   <div class="col-md-4">
        <b class="pregunta">¿Eres puntual?</b>
   </div>
   <div class="col-md-4">
        <h6>Si</h6>
        <?php echo set_input_radio("Puntual","","Si",(@$row['Puntual']=="Si")?true:false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-4">
        <h6>No</h6>
        <?php echo set_input_radio("Puntual","","No",(@$row['Puntual']=="No")?true:false,"custom-control-input",""); ?>
   </div>       
</div>
<div class=" row form-group">
   <div class="col-md-4">
        <b class="pregunta">¿Eres cumplido (a)? </b>
   </div>
   <div class="col-md-4">
        <h6>Si</h6>
        <?php echo set_input_radio("Cumplido","","Si",(@$row['Cumplido']=="Si")?true:false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-4">
        <h6>No</h6>
        <?php echo set_input_radio("Cumplido","","No",(@$row['Cumplido']=="No")?true:false,"custom-control-input",""); ?>         
   </div>       
</div>
<div class=" row form-group">
   <div class="col-md-4">
        <b class="pregunta">¿Eres responsable? </b>
   </div>
   <div class="col-md-4">
        <h6>Si</h6>
        <?php echo set_input_radio("Responsable","","Si",(@$row['Responsable']=="Si")?true:false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-4">
        <h6>No</h6>
        <?php echo set_input_radio("Responsable","","No",(@$row['Responsable']=="No")?true:false,"custom-control-input",""); ?>         
   </div>       
</div>
<div class=" row form-group">
   <div class="col-md-4">
        <b class="pregunta">¿Cumples horarios? </b>
   </div>
   <div class="col-md-4">
        <h6>Si</h6>
        <?php echo set_input_radio("CumplesHorarios","","Si",(@$row['CumplesHorarios']=="Si")?true:false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-4">
        <h6>No</h6>
        <?php echo set_input_radio("CumplesHorarios","","No",(@$row['CumplesHorarios']=="No")?true:false,"custom-control-input",""); ?>         
   </div>       
</div>
<div class=" row form-group">
   <div class="col-md-4">
        <b class="pregunta">¿Te gusta madrugar? </b>
   </div>
   <div class="col-md-4">
        <h6>Si</h6>
        <?php echo set_input_radio("Madrugar","","Si",(@$row['Madrugar']=="Si")?true:false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-4">
        <h6>No</h6>
        <?php echo set_input_radio("Madrugar","","No",(@$row['Madrugar']=="No")?true:false,"custom-control-input",""); ?>         
   </div>       
</div>
<div class=" row form-group">
   <div class="col-md-4">
        <b class="pregunta">¿Te gusta trasnochar?</b>
   </div>
   <div class="col-md-4">
        <h6>Si</h6>
        <?php echo set_input_radio("Trasnochar","","Si",(@$row['Madrugar']=="Si")?true:false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-4">
        <h6>No</h6>
        <?php echo set_input_radio("Trasnochar","","No",(@$row['Madrugar']=="No")?true:false,"custom-control-input",""); ?>         
   </div>       
</div>
<div class="form col-md-12">
	<h5><b class="pregunta">Certifico que todas las anteriores respuestas son veraces. </b></h5>
   	<div class="form-group row">
    	<div class="col-md-4">
        </div>
    	<div class="col-md-4">
            <h6>Si</h6>
	            <?php echo set_input_radio("AseptoTerminos","","Si",(@$row['AseptoTerminos']=="Si")?true:false,"custom-control-input AseptoTerminos",""); ?>
		</div>
        <div class="col-md-4">
            <h6>No</h6>
            <?php echo set_input_radio("AseptoTerminos","","No",(@$row['AseptoTerminos']=="No")?true:false,"custom-control-input AseptoTerminos",""); ?>         
        </div>  
   </div>
</div>
<script>
  $(document).ready(function(){
    $('.continuar').attr("disabled","disabled");
    $(".continuar").addClass("disabled");
    $('.AseptoTerminos').click(function(){
      if($(this).val() == "Si"){
          $(".continuar").removeAttr("disabled");
          $(".continuar").removeClass("disabled");
      }else{
          $('.continuar').attr("disabled","disabled");
          $(".continuar").addClass("disabled");
      }
    });
  });
</script>