<?php
     $empresa  =    $this->user->empresa;
     $row      =    $this->session->userdata('Encuesta');
?>
<input type="hidden"  require="true" value="1"/>
<div class="row">
     <div class="form col-md-12">
          <div class="form-group item">
               <h3><b>Información seguridad social.</b></h3>     
          </div>
     </div>
</div>
<div class=" row form-group">
     <div class="col-md-4">
          <label><b class="pregunta">Tipo de seguridad social (EPS)</b></label>
     </div>    
     <div class="col-md-8">
          <h6>Subsidiado (SISBEN)</h6>
          <?php echo set_input_radio("TipoSeguridadSocial","","Subsidiado (SISBEN)",(@$row['TipoSeguridadSocial']=="Subsidiado (SISBEN)")?true:false,"custom-control-input",""); ?>
     </div>
     <div class="col-md-4"></div>
     <div class="col-md-8">
          <h6>Contributivo</h6>
          <?php echo set_input_radio("TipoSeguridadSocial","","Contributivo",(@$row['TipoSeguridadSocial']=="Contributivo")?true:false,"custom-control-input",""); ?>      
     </div>
     <div class="col-md-4"></div>
     <div class="col-md-8">
          <h6>Beneficiario</h6>
          <?php echo set_input_radio("TipoSeguridadSocial","","Beneficiario",(@$row['TipoSeguridadSocial']=="Beneficiario")?true:false,"custom-control-input",""); ?>                  
     </div>
     <div class="col-md-4"></div>     
     <div class="col-md-8">
          <h6>Ninguno</h6>
          <?php echo set_input_radio("TipoSeguridadSocial","","Ninguno",(@$row['TipoSeguridadSocial']=="Ninguno")?true:false,"custom-control-input",""); ?>                  
     </div>
</div>
<div class="row form-group Opcional">
     <div class="col-md-4">
          <b>Nombre de la entidad promotora de salud (EPS)</b>
     </div>
     <div class="col-md-4">
         <?php set_input("NombreEntidad",@$row,$placeholder="Nombre entidad de salud",$require=false,"form-control"); ?> 
     </div>
     <div class="col-md-4"></div>
</div>
<div class="row form-group Opcional">
     <div class="col-md-4">
          <b>Fondo de pensiones</b>
     </div>
     <div class="col-md-4">
         <?php set_input("FondoPensiones",@$row,$placeholder="Fondo de pensiones",$require=false,"form-control"); ?> 
     </div>
     <div class="col-md-4"></div>
</div>
<div class="row form-group Opcional">
     <div class="col-md-4">
          <b>Fondo de cesantías</b>
     </div>
     <div class="col-md-4">
         <?php set_input("FondoCesantías",@$row,$placeholder="Fondo de cesantías",$require=false,"form-control"); ?> 
     </div>
     <div class="col-md-4"></div>
</div>
<div class=" row form-group Opcional">
     <div class="col-md-4">
          <label><b class="pregunta">Sufres o has sufrido de alguna enfermedad importante</b></label>
     </div>
     <div class="col-md-4">
          <h6>Si</h6>
          <?php echo set_input_radio("Enfermedad","","Si",(@$row['Enfermedad']=="Si")?true:false,"custom-control-input Mostrar",""); ?>
     </div>
     <div class="col-md-4">
          <h6>No</h6>
          <?php echo set_input_radio("Enfermedad","","No",(@$row['Enfermedad']=="No")?true:false,"custom-control-input Mostrar",""); ?>                  
     </div>  
</div>
 <div id="enfermedad" class="row form-group" style="display: none;">
     <div class="col-md-4">
          <b></b>
     </div>
     <div class="col-md-4">
         <?php set_input("EnfermedadImportante",@$row,$placeholder="Sufres o has sufrido de alguna enfermedad importante",$require=false,"form-control"); ?> 
     </div>
     <div class="col-md-4"></div>
</div>
<script>
     $(document).ready(function(){
          $('.Mostrar').click(function(){
               if($(this).val() == "Si"){
                    $('#enfermedad').fadeIn();
                    $('#EnfermedadImportante').attr("required","required");
               }else{
                    $('#enfermedad').fadeOut();
                    $('#EnfermedadImportante').removeAttr("required");
               }
          });
     });
</script>