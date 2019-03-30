<?php
     $empresa  =    $this->user->empresa;
     $row      =    $this->session->userdata('Encuesta');
?>
<input type="hidden"  require="true" value="1"/>
<div class="row">
   <div class="form col-md-12">
        <div class="form-group item">
             <h3><b>Aptitudes especifícas. </b></h3>
        </div>
   </div>
</div>
<div class="form-group">
   <div class="col-md-12">
        <b>Marca de uno (1) a diez (10) según consideres, siendo uno (1) muy poco y diez (10) muy bueno.</b>
   </div>
</div>
<div class="row form-group">
   <div class="col-xs-12 col-sm-12 col-md-4">
        <b class="pregunta">¿Cuánto sabes de digitación?</b>
   </div>
   <div class="row col-xs-12 col-sm-12 col-md-8 center-block">
        <div class="col-xs-1 col-sm-1 col-md-1"></div>
        <div class="col-xs-1 col-xs-1 col-md-1">
             <h6>1</h6>
           <input type="hidden" require="true" value="1" />  
        <?php echo set_input_radio("Digitacion","","1",(@$row['Digitacion']=="1")?true:false,"custom-control-input",""); ?>
        </div>
        <div class="col-xs-1 col-sm-1 col-md-1">
             <h6>2</h6>
        <?php echo set_input_radio("Digitacion","","2",(@$row['Digitacion']=="2")?true:false,"custom-control-input",""); ?>
        </div>
        <div class="col-xs-1 col-sm-1 col-md-1">
             <h6>3</h6>
        <?php echo set_input_radio("Digitacion","","3",(@$row['Digitacion']=="3")?true:false,"custom-control-input",""); ?>
        </div>
        <div class="col-xs-1 col-sm-1 col-md-1">
             <h6>4</h6>
        <?php echo set_input_radio("Digitacion","","4",(@$row['Digitacion']=="4")?true:false,"custom-control-input",""); ?>
        </div>
        <div class="col-xs-1 col-sm-1 col-md-1">
             <h6>5</h6>
        <?php echo set_input_radio("Digitacion","","5",(@$row['Digitacion']=="5")?true:false,"custom-control-input",""); ?>
        </div>
        <div class="col-xs-1 col-sm-1 col-md-1">
             <h6>6</h6>
        <?php echo set_input_radio("Digitacion","","6",(@$row['Digitacion']=="6")?true:false,"custom-control-input",""); ?>
        </div>
        <div class="col-xs-1 col-sm-1 col-md-1">
             <h6>7</h6>
        <?php echo set_input_radio("Digitacion","","7",(@$row['Digitacion']=="7")?true:false,"custom-control-input",""); ?>
        </div>
        <div class="col-xs-1 col-sm-1 col-md-1">
             <h6>8</h6>
        <?php echo set_input_radio("Digitacion","","8",(@$row['Digitacion']=="8")?true:false,"custom-control-input",""); ?>
        </div>
        <div class="col-xs-1 col-sm-1 col-md-1">
             <h6>9</h6>
        <?php echo set_input_radio("Digitacion","","9",(@$row['Digitacion']=="9")?true:false,"custom-control-input",""); ?>
        </div>
        <div class="col-xs-1 col-sm-1 col-md-1">
             <h6>10</h6>
        <?php echo set_input_radio("Digitacion","","10",(@$row['Digitacion']=="10")?true:false,"custom-control-input",""); ?>
        </div>
        <div class="col-xs-1 col-sm-1 col-md-1"></div>
   </div>
</div>
<div class="row form-group">
   <div class="col-xs-12 col-sm-12 col-md-4">
        <b class="pregunta">¿Cuánto sabes de inglés?</b>
   </div>
   <div class="row col-xs-12 col-sm-12 col-md-8">
        <div class="col-xs-1 col-sm-1 col-md-1"></div>
        <div class="col-xs-1 col-xs-1 col-md-1">
             <h6>1</h6>
        <?php echo set_input_radio("Ingles","","1",(@$row['Ingles']=="1")?true:false,"custom-control-input",""); ?>
        </div>
        <div class="col-xs-1 col-sm-1 col-md-1">
             <h6>2</h6>
        <?php echo set_input_radio("Ingles","","2",(@$row['Ingles']=="2")?true:false,"custom-control-input",""); ?>
        </div>
        <div class="col-xs-1 col-sm-1 col-md-1">
             <h6>3</h6>
        <?php echo set_input_radio("Ingles","","3",(@$row['Ingles']=="3")?true:false,"custom-control-input",""); ?>
        </div>
        <div class="col-xs-1 col-sm-1 col-md-1">
             <h6>4</h6>
        <?php echo set_input_radio("Ingles","","4",(@$row['Ingles']=="4")?true:false,"custom-control-input",""); ?>
        </div>
        <div class="col-xs-1 col-sm-1 col-md-1">
             <h6>5</h6>
        <?php echo set_input_radio("Ingles","","5",(@$row['Ingles']=="5")?true:false,"custom-control-input",""); ?>
        </div>
        <div class="col-xs-1 col-sm-1 col-md-1">
             <h6>6</h6>
        <?php echo set_input_radio("Ingles","","6",(@$row['Ingles']=="6")?true:false,"custom-control-input",""); ?>
        </div>
        <div class="col-xs-1 col-sm-1 col-md-1">
             <h6>7</h6>
        <?php echo set_input_radio("Ingles","","7",(@$row['Ingles']=="7")?true:false,"custom-control-input",""); ?>
        </div>
        <div class="col-xs-1 col-sm-1 col-md-1">
             <h6>8</h6>
        <?php echo set_input_radio("Ingles","","8",(@$row['Ingles']=="8")?true:false,"custom-control-input",""); ?>
        </div>
        <div class="col-xs-1 col-sm-1 col-md-1">
             <h6>9</h6>
        <?php echo set_input_radio("Ingles","","9",(@$row['Ingles']=="9")?true:false,"custom-control-input",""); ?>
        </div>
        <div class="col-xs-1 col-sm-1 col-md-1">
             <h6>10</h6>
        <?php echo set_input_radio("Ingles","","10",(@$row['Ingles']=="10")?true:false,"custom-control-input",""); ?>
        </div>
        <div class="col-xs-1 col-sm-1 col-md-1"></div>
   </div>
</div>
<div class="row form-group">
   <div class="col-xs-12 col-sm-12 col-md-4">
        <b class="pregunta">¿Tienes buena ortografía?</b>
   </div>
   <div class="row col-xs-12 col-sm-12 col-md-8">
        <div class="col-xs-1 col-sm-1 col-md-1"></div>
        <div class="col-xs-1 col-xs-1 col-md-1">
             <h6>1</h6>
        <?php echo set_input_radio("Ortografia","","1",(@$row['Ortografia']=="1")?true:false,"custom-control-input",""); ?>
        </div>
        <div class="col-xs-1 col-sm-1 col-md-1">
             <h6>2</h6>
        <?php echo set_input_radio("Ortografia","","2",(@$row['Ortografia']=="2")?true:false,"custom-control-input",""); ?>
        </div>
        <div class="col-xs-1 col-sm-1 col-md-1">
             <h6>3</h6>
        <?php echo set_input_radio("Ortografia","","3",(@$row['Ortografia']=="3")?true:false,"custom-control-input",""); ?>
        </div>
        <div class="col-xs-1 col-sm-1 col-md-1">
             <h6>4</h6>
        <?php echo set_input_radio("Ortografia","","4",(@$row['Ortografia']=="4")?true:false,"custom-control-input",""); ?>
        </div>
        <div class="col-xs-1 col-sm-1 col-md-1">
             <h6>5</h6>
        <?php echo set_input_radio("Ortografia","","5",(@$row['Ortografia']=="5")?true:false,"custom-control-input",""); ?>
        </div>
        <div class="col-xs-1 col-sm-1 col-md-1">
             <h6>6</h6>
        <?php echo set_input_radio("Ortografia","","6",(@$row['Ortografia']=="6")?true:false,"custom-control-input",""); ?>
        </div>
        <div class="col-xs-1 col-sm-1 col-md-1">
             <h6>7</h6>
        <?php echo set_input_radio("Ortografia","","7",(@$row['Ortografia']=="7")?true:false,"custom-control-input",""); ?>
        </div>
        <div class="col-xs-1 col-sm-1 col-md-1">
             <h6>8</h6>
        <?php echo set_input_radio("Ortografia","","8",(@$row['Ortografia']=="8")?true:false,"custom-control-input",""); ?>
        </div>
        <div class="col-xs-1 col-sm-1 col-md-1">
             <h6>9</h6>
        <?php echo set_input_radio("Ortografia","","9",(@$row['Ortografia']=="9")?true:false,"custom-control-input",""); ?>
        </div>
        <div class="col-xs-1 col-sm-1 col-md-1">
             <h6>10</h6>
        <?php echo set_input_radio("Ortografia","","10",(@$row['Ortografia']=="10")?true:false,"custom-control-input",""); ?>
        </div>
        <div class="col-xs-1 col-sm-1 col-md-1"></div>
   </div>
</div>
<div class="row form-group">
   <div class="col-xs-12 col-sm-12 col-md-4">
        <b class="pregunta">¿Sabes bailar?</b>
   </div>
   <div class="row col-xs-12 col-sm-12 col-md-8">
        <div class="col-xs-1 col-sm-1 col-md-1"></div>
        <div class="col-xs-1 col-xs-1 col-md-1">
             <h6>1</h6>
        <?php echo set_input_radio("Baile","","1",(@$row['Baile']=="1")?true:false,"custom-control-input",""); ?>
        </div>
        <div class="col-xs-1 col-sm-1 col-md-1">
             <h6>2</h6>
        <?php echo set_input_radio("Baile","","2",(@$row['Baile']=="2")?true:false,"custom-control-input",""); ?>
        </div>
        <div class="col-xs-1 col-sm-1 col-md-1">
             <h6>3</h6>
        <?php echo set_input_radio("Baile","","3",(@$row['Baile']=="3")?true:false,"custom-control-input",""); ?>
        </div>
        <div class="col-xs-1 col-sm-1 col-md-1">
             <h6>4</h6>
        <?php echo set_input_radio("Baile","","4",(@$row['Baile']=="4")?true:false,"custom-control-input",""); ?>
        </div>
        <div class="col-xs-1 col-sm-1 col-md-1">
             <h6>5</h6>
        <?php echo set_input_radio("Baile","","5",(@$row['Baile']=="5")?true:false,"custom-control-input",""); ?>
        </div>
        <div class="col-xs-1 col-sm-1 col-md-1">
             <h6>6</h6>
        <?php echo set_input_radio("Baile","","6",(@$row['Baile']=="6")?true:false,"custom-control-input",""); ?>
        </div>
        <div class="col-xs-1 col-sm-1 col-md-1">
             <h6>7</h6>
        <?php echo set_input_radio("Baile","","7",(@$row['Baile']=="7")?true:false,"custom-control-input",""); ?>
        </div>
        <div class="col-xs-1 col-sm-1 col-md-1">
             <h6>8</h6>
        <?php echo set_input_radio("Baile","","8",(@$row['Baile']=="8")?true:false,"custom-control-input",""); ?>
        </div>
        <div class="col-xs-1 col-sm-1 col-md-1">
             <h6>9</h6>
        <?php echo set_input_radio("Baile","","9",(@$row['Baile']=="9")?true:false,"custom-control-input",""); ?>
        </div>
        <div class="col-xs-1 col-sm-1 col-md-1">
             <h6>10</h6>
        <?php echo set_input_radio("Baile","","10",(@$row['Baile']=="10")?true:false,"custom-control-input",""); ?>
        </div>
        <div class="col-xs-1 col-sm-1 col-md-1"></div>
   </div>
</div>