<?php
     $empresa  =    $this->user->empresa;
     $row      =    $this->session->userdata('Encuesta');
?>
<input type="hidden"  require="true" value="1"/>
<div class="row">
     <div class="form col-md-12">
          <div class="form-group item">
               <h3><b>Tipo de música preferida.</b></h3>
          </div>
     </div>
</div>
<div class=" row form-group">
     <div class="col-md-4">
          <b class="pregunta">Inglés </b>
     </div>
     <div class="col-md-4">
          <h6>Si</h6>
          <?php echo set_input_radio("Inglés","","Si",(@$row['Inglés']=="Si")?true:false,"custom-control-input",""); ?>
     </div>
     <div class="col-md-4">
          <h6>No</h6>
          <?php echo set_input_radio("Inglés","","No",(@$row['Inglés']=="No")?true:false,"custom-control-input",""); ?>
     </div>       
</div>
<div class=" row form-group">
     <div class="col-md-4">
          <b class="pregunta">Electrónica </b>
     </div>
     <div class="col-md-4">
          <h6>Si</h6>
          <?php echo set_input_radio("Electrónica","","Si",(@$row['Electrónica']=="Si")?true:false,"custom-control-input",""); ?>
     </div>
     <div class="col-md-4">
          <h6>No</h6>
          <?php echo set_input_radio("Electrónica","","No",(@$row['Electrónica']=="No")?true:false,"custom-control-input",""); ?>         
     </div>       
</div>
<div class=" row form-group">
     <div class="col-md-4">
          <b class="pregunta">Vallenatos </b>
     </div>
     <div class="col-md-4">
          <h6>Si</h6>
          <?php echo set_input_radio("Vallenatos","","Si",(@$row['Vallenatos']=="Si")?true:false,"custom-control-input",""); ?>
     </div>
     <div class="col-md-4">
          <h6>No</h6>
          <?php echo set_input_radio("Vallenatos","","No",(@$row['Vallenatos']=="No")?true:false,"custom-control-input",""); ?>         
     </div>       
</div>
<div class=" row form-group">
     <div class="col-md-4">
          <b class="pregunta">Rancheras </b>
     </div>
     <div class="col-md-4">
          <h6>Si</h6>
          <?php echo set_input_radio("Rancheras","","Si",(@$row['Rancheras']=="Si")?true:false,"custom-control-input",""); ?>
     </div>
     <div class="col-md-4">
          <h6>No</h6>
          <?php echo set_input_radio("Rancheras","","No",(@$row['Rancheras']=="No")?true:false,"custom-control-input",""); ?>         
     </div>       
</div>
<div class=" row form-group">
     <div class="col-md-4">
          <b class="pregunta">Baladas </b>
     </div>
     <div class="col-md-4">
          <h6>Si</h6>
          <?php echo set_input_radio("Baladas","","Si",(@$row['Baladas']=="Si")?true:false,"custom-control-input",""); ?>
     </div>
     <div class="col-md-4">
          <h6>No</h6>
          <?php echo set_input_radio("Baladas","","No",(@$row['Baladas']=="No")?true:false,"custom-control-input",""); ?>
     </div>       
</div>
<div class=" row form-group">
     <div class="col-md-4">
          <b class="pregunta">Popular </b>
     </div>
     <div class="col-md-4">
          <h6>Si</h6>
          <?php echo set_input_radio("Popular","","Si",(@$row['Popular']=="Si")?true:false,"custom-control-input",""); ?>
     </div>
     <div class="col-md-4">
          <h6>No</h6>
          <?php echo set_input_radio("Popular","","No",(@$row['Popular']=="No")?true:false,"custom-control-input",""); ?>
     </div>       
</div>
<div class=" row form-group">
     <div class="col-md-4">
          <b class="pregunta">Pop en español </b>
     </div>
     <div class="col-md-4">
          <h6>Si</h6>
          <?php echo set_input_radio("Pop_Español","","Si",(@$row['Pop_Español']=="Si")?true:false,"custom-control-input",""); ?>
     </div>
     <div class="col-md-4">
          <h6>No</h6>
          <?php echo set_input_radio("Pop_Español","","No",(@$row['Pop_Español']=="No")?true:false,"custom-control-input",""); ?>         
     </div>       
</div>
<div class=" row form-group">
     <div class="col-md-4">
          <b class="pregunta">¿Pop en inglés? </b>
     </div>
     <div class="col-md-4">
          <h6>Si</h6>
          <?php echo set_input_radio("Pop_Inglés","","Si",(@$row['Pop_Inglés']=="Si")?true:false,"custom-control-input",""); ?>
     </div>
     <div class="col-md-4">
          <h6>No</h6>
          <?php echo set_input_radio("Pop_Inglés","","No",(@$row['Pop_Inglés']=="No")?true:false,"custom-control-input",""); ?>         
     </div>      
</div>
<div class=" row form-group">
     <div class="col-md-4">
          <b class="pregunta">Rock en español </b>
     </div>
     <div class="col-md-4">
          <h6>Si</h6>
          <?php echo set_input_radio("Rock_Español","","Si",(@$row['Rock_Español']=="Si")?true:false,"custom-control-input",""); ?>
     </div>
     <div class="col-md-4">
          <h6>No</h6>
          <?php echo set_input_radio("Rock_Español","","No",(@$row['Rock_Español']=="No")?true:false,"custom-control-input",""); ?>         
     </div>       
</div>
<div class=" row form-group">
     <div class="col-md-4">
          <b class="pregunta">Rock en inglés</b>
     </div>
     <div class="col-md-4">
          <h6>Si</h6>
          <?php echo set_input_radio("Rock_Inglés","","Si",(@$row['Rock_Inglés']=="Si")?true:false,"custom-control-input",""); ?>
     </div>
     <div class="col-md-4">
          <h6>No</h6>
          <?php echo set_input_radio("Rock_Inglés","","No",(@$row['Rock_Inglés']=="No")?true:false,"custom-control-input",""); ?>         
     </div>       
</div>