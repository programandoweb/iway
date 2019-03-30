<?php
	$empresa	=	$this->user->empresa;
	$row		=	$this->session->userdata('Encuesta');
  @$row['IngresosActuales']   = $row['IngresosActuales'].'00';
  @$row['Obligaciones']       = $row['Obligaciones'].'00';
  @$row['AspiracionSalarial'] = $row['AspiracionSalarial'].'00';
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
        <?php set_input("IngresosActuales",@$row,$placeholder="Ingresos Actuales",$require=false,"form-control money text-right");?>
   </div>
   <div class="col-md-4"></div>
</div>
<div class="row form-group Opcional">
   <div class="col-md-4">
        <b>¿Cuánto suman tus obligaciones mensuales? </b>
   </div>
   <div class="col-md-4">
        <?php set_input("Obligaciones",@$row,$placeholder="Obligaciones Actuales",$require=false,"form-control money text-right");?>
   </div>
   <div class="col-md-4"></div>
</div>
<div class="row form-group">
   <div class="col-md-4">
        <b>¿Cuánto requieres ganar  mensualmente?</b> 
   </div>
   <div class="col-md-4">
        <?php set_input("AspiracionSalarial",@$row,$placeholder="Aspiracion Salarial",$require=true,"form-control money text-right");?>
   </div>
   <div class="col-md-4"></div>
</div>
<div class="row form-group">
   <div class="col-md-4">
        <b class="pregunta">¿Tienes medio de transporte propio?</b>
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