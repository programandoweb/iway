<?php
     $empresa  =    $this->user->empresa;
     $row      =    $this->session->userdata('Encuesta');
?>
<input type="hidden"  require="true" value="1"/>
<div class="row">
   <div class="form col-md-12">
        <div class="form-group item">
             <h3><b>Contratación.</b></h3>
        </div>
   </div>
</div>
<div class="row form-group">
   <div class="col-md-4">
        <b>¿Qué vas a decir en casa?</b>
   </div>
   <div class="col-md-4">
        <?php set_input("Qué_vas_a_decir_en_tu_casa",@$row["Qué_vas_a_decir_en_tu_casa"],$placeholder='Que vas a decir en Casa',$require=true,"firstLetterText");?>
   </div>
   <div class="col-md-4"></div>
</div>
<div class="row form-group">
   <div class="col-md-4">
        <b>¿Cómo te gustaría llamarte en las páginas?</b>
   </div>
   <div class="col-md-4">
        <?php set_input("Como_te_gustaría_llamarte_en_las_páginas",@$row['Como_te_gustaría_llamarte_en_las_páginas'],$placeholder='Cómo te gustaría llamarte en las páginas',$require=true,"firstLetterText");?>
   </div>
   <div class="col-md-4"></div>
</div>
<div class=" row form-group">
   <div class="col-md-4">
        <b class="pregunta">¿Estarías dispuesto (a) a firmar contrato por un año?</b>
   </div>
   <div class="col-md-4">
        <h6>Si</h6>
        <?php echo set_input_radio("Firmar_Contrato","","Si",(@$row['Firmar_Contrato']=="Si")?true:false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-4">
        <h6>No</h6>
        <?php echo set_input_radio("Firmar_Contrato","","No",(@$row['Firmar_Contrato']=="No")?true:false,"custom-control-input",""); ?>         
   </div>       
</div>