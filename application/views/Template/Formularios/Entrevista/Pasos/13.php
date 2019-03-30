<?php
     $empresa  =    $this->user->empresa;
     $row      =    $this->session->userdata('Encuesta');
?>
<input type="hidden"  require="true" value="1"/>
<div class="row">
       <div class="form col-md-12">
            <div class="form-group item">
                 <h3><b>¿Qué estarías dispuesta (o) a hacer en cámara?</b></h3>
            </div>
       </div>
  </div>
  <div class=" row form-group">
       <div class="col-md-4">
            <b class="pregunta">¿Utilizar consolador? </b>
       </div>
       <div class="col-md-4">
            <h6>Si</h6>
            <?php echo set_input_radio("Consolador","","Si",(@$row['Consolador']=="Si")?true:false,"custom-control-input",""); ?>
       </div>
       <div class="col-md-4">
            <h6>No</h6>
            <?php echo set_input_radio("Consolador","","No",(@$row['Consolador']=="No")?true:false,"custom-control-input",""); ?>               
       </div>       
  </div>
  <div class=" row form-group">
       <div class="col-md-4">
            <b class="pregunta">¿Utilizar redes sociales con tu nombre artístico? </b>
       </div>
       <div class="col-md-4">
            <h6>Si</h6>
            <?php echo set_input_radio("NombreArtisticoRss","","Si",(@$row['NombreArtisticoRss']=="Si")?true:false,"custom-control-input",""); ?>
       </div>
       <div class="col-md-4">
            <h6>No</h6>
            <?php echo set_input_radio("NombreArtisticoRss","","No",(@$row['NombreArtisticoRss']=="No")?true:false,"custom-control-input",""); ?>               
       </div>       
  </div>
  <div class=" row form-group">
       <div class="col-md-4">
            <b class="pregunta">¿Transmitir con otra persona?  </b>
       </div>
       <div class="col-md-4">
            <h6>Si</h6>
            <?php echo set_input_radio("TransmitirConOtro","","Si",(@$row['TransmitirConOtro']=="Si")?true:false,"custom-control-input",""); ?>
       </div>
       <div class="col-md-4">
            <h6>No</h6>
            <?php echo set_input_radio("TransmitirConOtro","","No",(@$row['TransmitirConOtro']=="No")?true:false,"custom-control-input",""); ?>               
       </div>       
  </div>
  <div class=" row form-group">
       <div class="col-md-4">
            <b class="pregunta">¿Masturbarte?  </b>
       </div>
       <div class="col-md-4">
            <h6>Si</h6>
            <?php echo set_input_radio("Masturbarte","","Si",(@$row['Masturbarte']=="Si")?true:false,"custom-control-input",""); ?>
       </div>
       <div class="col-md-4">
            <h6>No</h6>
            <?php echo set_input_radio("Masturbarte","","No",(@$row['Masturbarte']=="No")?true:false,"custom-control-input",""); ?>               
       </div>       
  </div>
  <div class=" row form-group">
       <div class="col-md-4">
            <b class="pregunta">¿Sexo anal?   </b>
       </div>
       <div class="col-md-4">
            <h6>Si</h6>
            <?php echo set_input_radio("SexoAnal?","","Si",(@$row['SexoAnal?']=="Si")?true:false,"custom-control-input",""); ?>
       </div>
       <div class="col-md-4">
            <h6>No</h6>
            <?php echo set_input_radio("SexoAnal?","","No",(@$row['SexoAnal?']=="No")?true:false,"custom-control-input",""); ?>               
       </div>       
  </div>
  <div class=" row form-group">
       <div class="col-md-4">
            <b class="pregunta">¿Utilizar juguetería sexual?   </b>
       </div>
       <div class="col-md-4">
            <h6>Si</h6>
            <?php echo set_input_radio("Jugueteria_Sexual","","Si",(@$row['Jugueteria_Sexual']=="Si")?true:false,"custom-control-input",""); ?>
       </div>
       <div class="col-md-4">
            <h6>No</h6>
            <?php echo set_input_radio("Jugueteria_Sexual","","No",(@$row['Jugueteria_Sexual']=="No")?true:false,"custom-control-input",""); ?>               
       </div>       
  </div>
  <div class=" row form-group">
       <div class="col-md-4">
            <b class="pregunta">¿Baile erótico?   </b>
       </div>
       <div class="col-md-4">
            <h6>Si</h6>
            <?php echo set_input_radio("BaileErotico","","Si",(@$row['BaileErotico']=="Si")?true:false,"custom-control-input",""); ?>
       </div>
       <div class="col-md-4">
            <h6>No</h6>
            <?php echo set_input_radio("BaileErotico","","No",(@$row['BaileErotico']=="No")?true:false,"custom-control-input",""); ?>               
       </div>       
  </div>
  <div class=" row form-group">
       <div class="col-md-4">
            <b class="pregunta">¿Orgasmo online?   </b>
       </div>
       <div class="col-md-4">
            <h6>Si</h6>
            <?php echo set_input_radio("OrgasmoOnline","","Si",(@$row['OrgasmoOnline']=="Si")?true:false,"custom-control-input",""); ?>
       </div>
       <div class="col-md-4">
            <h6>No</h6>
            <?php echo set_input_radio("OrgasmoOnline","","No",(@$row['OrgasmoOnline']=="No")?true:false,"custom-control-input",""); ?>               
       </div>       
  </div>
  <div class=" row form-group">
       <div class="col-md-4">
            <b class="pregunta">¿Leche - MILF?  </b>
       </div>
       <div class="col-md-4">
            <h6>Si</h6>
            <?php echo set_input_radio("LecheMilf","","Si",(@$row['LecheMilf']=="Si")?true:false,"custom-control-input",""); ?>
       </div>
       <div class="col-md-4">
            <h6>No</h6>
            <?php echo set_input_radio("LecheMilf","","No",(@$row['LecheMilf']=="No")?true:false,"custom-control-input",""); ?>               
       </div>       
  </div>
  <div class=" row form-group">
       <div class="col-md-4">
            <b class="pregunta">¿Striptease?  </b>
       </div>
       <div class="col-md-4">
            <h6>Si</h6>
            <?php echo set_input_radio("Striptease","","Si",(@$row['Striptease']=="Si")?true:false,"custom-control-input",""); ?>
       </div>
       <div class="col-md-4">
            <h6>No</h6>
            <?php echo set_input_radio("Striptease","","No",(@$row['Striptease']=="No")?true:false,"custom-control-input",""); ?>               
       </div>       
  </div>
  <div class=" row form-group">
       <div class="col-md-4">
            <b class="pregunta">¿Juego de roles? </b>
       </div>
       <div class="col-md-4">
            <h6>Si</h6>
            <?php echo set_input_radio("Juego_de_Roles","","Si",(@$row['Juego_de_Roles']=="Si")?true:false,"custom-control-input",""); ?>
       </div>
       <div class="col-md-4">
            <h6>No</h6>
            <?php echo set_input_radio("Juego_de_Roles","","No",(@$row['Juego_de_Roles']=="No")?true:false,"custom-control-input",""); ?>               
       </div>       
  </div>
  <div class=" row form-group">
       <div class="col-md-4">
            <b class="pregunta">¿Disfraces? </b>
       </div>
       <div class="col-md-4">
            <h6>Si</h6>
            <?php echo set_input_radio("Disfraces","","Si",(@$row['Disfraces']=="Si")?true:false,"custom-control-input",""); ?>
       </div>
       <div class="col-md-4">
            <h6>No</h6>
            <?php echo set_input_radio("Disfraces","","No",(@$row['Disfraces']=="No")?true:false,"custom-control-input",""); ?>               
       </div>       
  </div>
  <div class=" row form-group">
       <div class="col-md-4">
            <b class="pregunta">¿Sexo salvaje? </b>
       </div>
       <div class="col-md-4">
            <h6>Si</h6>
            <?php echo set_input_radio("Sexo_Salvaje","","Si",(@$row['Sexo_Salvaje']=="Si")?true:false,"custom-control-input",""); ?>
       </div>
       <div class="col-md-4">
            <h6>No</h6>
            <?php echo set_input_radio("Sexo_Salvaje","","No",(@$row['Sexo_Salvaje']=="No")?true:false,"custom-control-input",""); ?>               
       </div>       
  </div>
  <div class=" row form-group">
       <div class="col-md-4">
            <b class="pregunta">¿CAM2CAM? </b><br/>
            Ver la cámara del miembro con el que se está chateando
       </div>
       <div class="col-md-4">
            <h6>Si</h6>
            <?php echo set_input_radio("Cam2Cam","","Si",(@$row['Cam2Cam']=="Si")?true:false,"custom-control-input",""); ?>
       </div>
       <div class="col-md-4">
            <h6>No</h6>
            <?php echo set_input_radio("Cam2Cam","","No",(@$row['Cam2Cam']=="No")?true:false,"custom-control-input",""); ?>               
       </div>       
  </div>
  <div class=" row form-group">
       <div class="col-md-4">
            <b class="pregunta">¿Show de aceite? </b>
       </div>
       <div class="col-md-4">
            <h6>Si</h6>
            <?php echo set_input_radio("ShowAceite","","Si",(@$row['ShowAceite']=="Si")?true:false,"custom-control-input",""); ?>
       </div>
       <div class="col-md-4">
            <h6>No</h6>
            <?php echo set_input_radio("ShowAceite","","No",(@$row['ShowAceite']=="No")?true:false,"custom-control-input",""); ?>               
       </div>       
  </div>
  <div class=" row form-group">
       <div class="col-md-4">
            <b class="pregunta">¿Nalgadas? </b>
       </div>
       <div class="col-md-4">
            <h6>Si</h6>
            <?php echo set_input_radio("Nalgadas","","Si",(@$row['Nalgadas']=="Si")?true:false,"custom-control-input",""); ?>
       </div>
       <div class="col-md-4">
            <h6>No</h6>
            <?php echo set_input_radio("Nalgadas","","No",(@$row['Nalgadas']=="No")?true:false,"custom-control-input",""); ?>               
       </div>       
  </div>
  <div class=" row form-group">
       <div class="col-md-4">
            <b class="pregunta">¿Doble penetración? </b>
       </div>
       <div class="col-md-4">
            <h6>Si</h6>
            <?php echo set_input_radio("Doble_Penetración","","Si",(@$row['Doble_Penetración']=="Si")?true:false,"custom-control-input",""); ?>
       </div>
       <div class="col-md-4">
            <h6>No</h6>
            <?php echo set_input_radio("Doble_Penetración","","No",(@$row['Doble_Penetración']=="No")?true:false,"custom-control-input",""); ?>               
       </div>       
  </div>
  <div class=" row form-group">
       <div class="col-md-4">
            <b class="pregunta">¿Orinar - Squirter? </b>
       </div>
       <div class="col-md-4">
            <h6>Si</h6>
            <?php echo set_input_radio("Orinar_Squirter","","Si",(@$row['Orinar_Squirter']=="Si")?true:false,"custom-control-input",""); ?>
       </div>
       <div class="col-md-4">
            <h6>No</h6>
            <?php echo set_input_radio("Orinar_Squirter","","No",(@$row['Orinar_Squirter']=="No")?true:false,"custom-control-input",""); ?>               
       </div>       
  </div>
  <div class=" row form-group">
       <div class="col-md-4">
            <b class="pregunta">¿Hablar sucio? </b>
       </div>
       <div class="col-md-4">
            <h6>Si</h6>
            <?php echo set_input_radio("Hablar_Sucio","","Si",(@$row['Hablar_Sucio']=="Si")?true:false,"custom-control-input",""); ?>
       </div>
       <div class="col-md-4">
            <h6>No</h6>
            <?php echo set_input_radio("Hablar_Sucio","","No",(@$row['Hablar_Sucio']=="No")?true:false,"custom-control-input",""); ?>               
       </div>       
  </div>
  <div class=" row form-group">
       <div class="col-md-4">
            <b class="pregunta">¿Fetiche de pies? </b>
       </div>
       <div class="col-md-4">
            <h6>Si</h6>
            <?php echo set_input_radio("Fetiche_de_Pies","","Si",(@$row['Fetiche_de_Pies']=="Si")?true:false,"custom-control-input",""); ?>
       </div>
       <div class="col-md-4">
            <h6>No</h6>
            <?php echo set_input_radio("Fetiche_de_Pies","","No",(@$row['Fetiche_de_Pies']=="No")?true:false,"custom-control-input",""); ?>               
       </div>       
  </div>
  <div class=" row form-group">
       <div class="col-md-4">
            <b class="pregunta">¿Fetiche de manos? </b>
       </div>
       <div class="col-md-4">
            <h6>Si</h6>
            <?php echo set_input_radio("Fetiche_de_Manos","","Si",(@$row['Fetiche_de_Manos']=="Si")?true:false,"custom-control-input",""); ?>
       </div>
       <div class="col-md-4">
            <h6>No</h6>
            <?php echo set_input_radio("Fetiche_de_Manos","","No",(@$row['Fetiche_de_Manos']=="No")?true:false,"custom-control-input",""); ?>         
       </div>       
  </div>
  <div class=" row form-group">
       <div class="col-md-4">
            <b class="pregunta">¿Show dedos vagina? </b>
       </div>
       <div class="col-md-4">
            <h6>Si</h6>
            <?php echo set_input_radio("Show_Dedos_Vagina","","Si",(@$row['Show_Dedos_Vagina']=="Si")?true:false,"custom-control-input",""); ?>
       </div>
       <div class="col-md-4">
            <h6>No</h6>
            <?php echo set_input_radio("Show_Dedos_Vagina","","No",(@$row['Show_Dedos_Vagina']=="No")?true:false,"custom-control-input",""); ?>         
       </div>       
  </div>
  <div class=" row form-group">
       <div class="col-md-4">
            <b class="pregunta">¿Show dedos anal? </b>
       </div>
       <div class="col-md-4">
            <h6>Si</h6>
            <?php echo set_input_radio("Show_Dedos_Anal","","Si",(@$row['Show_Dedos_Anal']=="Si")?true:false,"custom-control-input",""); ?>
       </div>
       <div class="col-md-4">
            <h6>No</h6>
            <?php echo set_input_radio("Show_Dedos_Anal","","No",(@$row['Show_Dedos_Anal']=="No")?true:false,"custom-control-input",""); ?>         
       </div>       
  </div>
  <div class=" row form-group">
       <div class="col-md-4">
            <b class="pregunta">¿Varias chicas en cámara? </b>
       </div>
       <div class="col-md-4">
            <h6>Si</h6>
            <?php echo set_input_radio("Varias_Chicas_Cam","","Si",(@$row['Varias_Chicas_Cam']=="Si")?true:false,"custom-control-input",""); ?>
       </div>
       <div class="col-md-4">
            <h6>No</h6>
            <?php echo set_input_radio("Varias_Chicas_Cam","","No",(@$row['Varias_Chicas_Cam']=="No")?true:false,"custom-control-input",""); ?>         
       </div>       
  </div>
  <div class=" row form-group">
       <div class="col-md-4">
            <b class="pregunta">¿Esclavitud o servidumbre? </b>
       </div>
       <div class="col-md-4">
            <h6>Si</h6>
            <?php echo set_input_radio("Esclavitud_Servidumbre","","Si",(@$row['Esclavitud_Servidumbre']=="Si")?true:false,"custom-control-input",""); ?>
       </div>
       <div class="col-md-4">
            <h6>No</h6>
            <?php echo set_input_radio("Esclavitud_Servidumbre","","No",(@$row['Esclavitud_Servidumbre']=="No")?true:false,"custom-control-input",""); ?>         
       </div>       
  </div>
  <div class=" row form-group">
       <div class="col-md-4">
            <b class="pregunta">¿Dominatriz? </b>
       </div>
       <div class="col-md-4">
            <h6>Si</h6>
            <?php echo set_input_radio("Dominatriz","","Si",(@$row['Dominatriz']=="Si")?true:false,"custom-control-input",""); ?>
       </div>
       <div class="col-md-4">
            <h6>No</h6>
            <?php echo set_input_radio("Dominatriz","","No",(@$row['Dominatriz']=="No")?true:false,"custom-control-input",""); ?>         
       </div>       
  </div>
  <div class=" row form-group">
       <div class="col-md-4">
            <b class="pregunta">¿Azote? </b>
       </div>
       <div class="col-md-4">
            <h6>Si</h6>
            <?php echo set_input_radio("Azote","","Si",(@$row['Azote']=="Si")?true:false,"custom-control-input",""); ?>
       </div>
       <div class="col-md-4">
            <h6>No</h6>
            <?php echo set_input_radio("Azote","","No",(@$row['Azote']=="No")?true:false,"custom-control-input",""); ?>         
       </div>       
  </div>
  <div class=" row form-group">
       <div class="col-md-4">
            <b class="pregunta">¿Pezones perforados? </b>
       </div>
       <div class="col-md-4">
            <h6>Si</h6>
            <?php echo set_input_radio("Pezones_Perforados","","Si",(@$row['Pezones_Perforados']=="Si")?true:false,"custom-control-input",""); ?>
       </div>
       <div class="col-md-4">
            <h6>No</h6>
            <?php echo set_input_radio("Pezones_Perforados","","No",(@$row['Pezones_Perforados']=="No")?true:false,"custom-control-input",""); ?>         
       </div>       
  </div>