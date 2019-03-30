<?php
     $empresa  =    $this->user->empresa;
     $row      =    $this->session->userdata('Encuesta');
?>
<input type="hidden"  require="true" value="1"/>
<div class="row">
   <div class="form col-md-12">
        <div class="form-group item">
             <h3><b>¿De tu cuerpo te gusta?</b></h3>
        </div>
   </div>
</div>
<div class=" row form-group">
   <div class="col-md-4">
        <b class="pregunta">¿Pelo?</b>
   </div>
   <div class="col-md-4">
        <h6>Si</h6>
        <?php echo set_input_radio("Pelo","","Si",(@$row['Pelo']=="Si")?true:false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-4">
        <h6>No</h6>
        <?php echo set_input_radio("Pelo","","No",(@$row['Pelo']=="No")?true:false,"custom-control-input",""); ?> 
   </div>       
</div>
<div class=" row form-group">
   <div class="col-md-4">
        <b class="pregunta">¿Labios?</b>
   </div>
   <div class="col-md-4">
        <h6>Si</h6>
        <?php echo set_input_radio("Labios","","Si",(@$row['Labios']=="Si")?true:false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-4">
        <h6>No</h6>
        <?php echo set_input_radio("Labios","","No",(@$row['Labios']=="No")?true:false,"custom-control-input",""); ?>
   </div>       
</div>
<div class=" row form-group">
   <div class="col-md-4">
        <b class="pregunta">¿Cara?</b>
   </div>
   <div class="col-md-4">
        <h6>Si</h6>
        <?php echo set_input_radio("Cara","","Si",(@$row['Cara']=="Si")?true:false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-4">
        <h6>No</h6>
        <?php echo set_input_radio("Cara","","No",(@$row['Cara']=="No")?true:false,"custom-control-input",""); ?>
   </div>       
</div>
<div class=" row form-group">
   <div class="col-md-4">
        <b class="pregunta">¿Oídos?</b>
   </div>
   <div class="col-md-4">
        <h6>Si</h6>
        <?php echo set_input_radio("Oidos","","Si",(@$row['Oidos']=="Si")?true:false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-4">
        <h6>No</h6>
        <?php echo set_input_radio("Oidos","","No",(@$row['Oidos']=="No")?true:false,"custom-control-input",""); ?> 
   </div>       
</div>
<div class=" row form-group">
   <div class="col-md-4">
        <b class="pregunta">¿Cejas?</b>
   </div>
   <div class="col-md-4">
        <h6>Si</h6>
        <?php echo set_input_radio("Cejas","","Si",(@$row['Cejas']=="Si")?true:false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-4">
        <h6>No</h6>
        <?php echo set_input_radio("Cejas","","No",(@$row['Cejas']=="No")?true:false,"custom-control-input",""); ?> 
   </div>       
</div>
<div class=" row form-group">
   <div class="col-md-4">
        <b class="pregunta">¿Ojos?</b>
   </div>
   <div class="col-md-4">
        <h6>Si</h6>
        <?php echo set_input_radio("Ojos","","Si",(@$row['Ojos']=="Si")?true:false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-4">
        <h6>No</h6>
        <?php echo set_input_radio("Ojos","","No",(@$row['Ojos']=="No")?true:false,"custom-control-input",""); ?> 
   </div>       
</div>
<div class=" row form-group">
   <div class="col-md-4">
        <b class="pregunta">¿Nariz?</b>
   </div>
   <div class="col-md-4">
        <h6>Si</h6>
        <?php echo set_input_radio("Nariz","","Si",(@$row['Nariz']=="Si")?true:false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-4">
        <h6>No</h6>
        <?php echo set_input_radio("Nariz","","No",(@$row['Nariz']=="No")?true:false,"custom-control-input",""); ?> 
   </div>       
</div>
<div class=" row form-group">
   <div class="col-md-4">
        <b class="pregunta">¿Uñas?</b>
   </div>
   <div class="col-md-4">
        <h6>Si</h6>
        <?php echo set_input_radio("Uñas","","Si",(@$row['Uñas']=="Si")?true:false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-4">
        <h6>No</h6>
        <?php echo set_input_radio("Uñas","","No",(@$row['Uñas']=="No")?true:false,"custom-control-input",""); ?> 
   </div>       
</div>
<div class=" row form-group">
   <div class="col-md-4">
        <b class="pregunta">¿Senos?</b>
   </div>
   <div class="col-md-4">
        <h6>Si</h6>
        <?php echo set_input_radio("Senos","","Si",(@$row['Senos']=="Si")?true:false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-4">
        <h6>No</h6>
        <?php echo set_input_radio("Senos","","No",(@$row['Senos']=="No")?true:false,"custom-control-input",""); ?>
   </div>       
</div>
<div class=" row form-group">
   <div class="col-md-4">
        <b class="pregunta">¿Manos?</b>
   </div>
   <div class="col-md-4">
        <h6>Si</h6>
        <?php echo set_input_radio("Manos","","Si",(@$row['Manos']=="Si")?true:false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-4">
        <h6>No</h6>
        <?php echo set_input_radio("Manos","","No",(@$row['Manos']=="No")?true:false,"custom-control-input",""); ?> 
   </div>       
</div>
<div class=" row form-group">
   <div class="col-md-4">
        <b class="pregunta">¿Pies?</b>
   </div>
   <div class="col-md-4">
        <h6>Si</h6>
        <?php echo set_input_radio("Pies","","Si",(@$row['Pies']=="Si")?true:false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-4">
        <h6>No</h6>
        <?php echo set_input_radio("Pies","","No",(@$row['Pies']=="No")?true:false,"custom-control-input",""); ?>  
   </div>       
</div>
<div class=" row form-group">
   <div class="col-md-4">
        <b class="pregunta">¿Cintura?</b>
   </div>
   <div class="col-md-4">
        <h6>Si</h6>
        <?php echo set_input_radio("Cintura","","Si",(@$row['Cintura']=="Si")?true:false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-4">
        <h6>No</h6>
        <?php echo set_input_radio("Cintura","","No",(@$row['Cintura']=="No")?true:false,"custom-control-input",""); ?>
   </div>       
</div>
<div class=" row form-group">
   <div class="col-md-4">
        <b class="pregunta">¿Espalda?</b>
   </div>
   <div class="col-md-4">
        <h6>Si</h6>
        <?php echo set_input_radio("Espalda","","Si",(@$row['Espalda']=="Si")?true:false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-4">
        <h6>No</h6>
        <?php echo set_input_radio("Espalda","","No",(@$row['Espalda']=="No")?true:false,"custom-control-input",""); ?>
   </div>       
</div>
<div class=" row form-group">
   <div class="col-md-4">
        <b class="pregunta">¿Hombros?</b>
   </div>
   <div class="col-md-4">
        <h6>Si</h6>
        <?php echo set_input_radio("Hombros","","Si",(@$row['Hombros']=="Si")?true:false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-4">
        <h6>No</h6>
        <?php echo set_input_radio("Hombros","","No",(@$row['Hombros']=="No")?true:false,"custom-control-input",""); ?>
   </div>       
</div>
<div class=" row form-group">
   <div class="col-md-4">
        <b class="pregunta">¿Abdomen?</b>
   </div>
   <div class="col-md-4">
        <h6>Si</h6>
        <?php echo set_input_radio("Abdomen","","Si",(@$row['Abdomen']=="Si")?true:false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-4">
        <h6>No</h6>
        <?php echo set_input_radio("Abdomen","","No",(@$row['Abdomen']=="No")?true:false,"custom-control-input",""); ?>
   </div>       
</div>
<div class="row form-group">
   <div class="col-md-4">
        <b>¿Qué es lo que más te gusta de tu cuerpo?</b>
   </div>
   <div class="col-md-4">
        <?php set_input("Parte_que_mas_te_gusta_de_tu_cuerpo",@$row["Parte_que_mas_te_gusta_de_tu_cuerpo"],$placeholder='Lo que mas te gusta de tu cuerpo',$require=true,"firstLetterText");?>
   </div>
   <div class="col-md-4"></div>
</div>
<div class="row form-group">
   <div class="col-md-4">
        <b>¿Qué es lo que menos te gusta de tu cuerpo?</b>
   </div>
   <div class="col-md-4">
        <?php set_input("Parte_que_menos_te_gusta_de_tu_cuerpo",@$row["Parte_que_menos_te_gusta_de_tu_cuerpo"],$placeholder='Lo que menos te gusta de tu cuerpo',$require=true,"firstLetterText");?>
   </div>
   <div class="col-md-4"></div>
</div>