<?php
	$empresa	=	$this->user->empresa;
	$row		=	$this->session->userdata('Encuesta');
?>
<script>
  $( function() {
    $( ".datepicker" ).datepicker({changeMonth: true,changeYear: true});
    $( ".datepicker" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
    $( ".datepicker" ).val("<?php echo @$row['FechaNacimiento']; ?>");
    $( ".datepicker" ).datepicker({changeMonth: true,changeYear: true,showOtherMonths: true,selectOtherMonths: true});
  });
</script>
<div class="form">
     <div class="form-group item">
          <div class="p-3">
               <h3><b>Información personal.</b></h3>
          </div>
     </div>
     <div class="row form-group">
          <div class="col-md-4">
               <b>Email</b>
          </div>
          <div class="col-md-4">
               	<?php 
			   		set_input("email",array("email"=>$this->user->email),$placeholder='Email',$require=true,"form-control",array("readonly"=>"readonly")); 
				?>
          </div>
          <div class="col-md-4"></div>
     </div>
     <div class="row form-group">
          <div class="col-md-4">
               <b>Nombre entrevistado (a)</b>
          </div>
          <div class="col-md-4">
               <?php set_input("NombreEntrevistado",@$row["PrimerNombre"].' '.@$row["SegundoNombre"],$placeholder='Nombres entrevistado',$require=true,"form-control",array("readonly"=>"readonly")) ?>
          </div>
          <div class="col-md-4">
               <?php set_input("ApellidoEntrevistado",@$row["PrimerApellido"].' '.@$row["SegundoApellido"],$placeholder='Apellidos Entrevistado',$require=true,"form-control",array("readonly"=>"readonly")) ?>
          </div>
     </div>
     <div class="row form-group">
          <div class="col-md-4">
               <b>Fecha de nacimiento</b>
          </div>
          <div class="col-md-4">
                <?php set_input("FechaNacimiento",@$row,$placeholder='AAAA-MM-DD',$require=true,"datepicker");?>
          </div>
          <div class="col-md-4"></div>
     </div>
     <div class="row form-group">
          <div class="col-md-4">
               <b>Ciudad de nacimiento</b>
          </div>
          <div class="col-md-4">
          		<?php echo lugar("CiudadNacimiento",@$row["CiudadNacimiento"]);?>
               	<?php //set_input("CiudadNacimiento",@$row,$placeholder="Ciudad de Nacimiento",$require=true,"form-control"); ?>
          </div>
          <div class="col-md-4"></div>
     </div>
     <div class="row form-group">
          <div class="col-md-4">
               <b>Estado Civil</b>
          </div>
          <div class="col-md-4">
               <?php echo MakeEstadoCivil("EstadoCivil",@$row["EstadoCivil"],array("Class"=>"form-control","require"=>true)); ?>
          </div>
          <div class="col-md-4"></div>
     </div>
     <div class="row form-group">
          <div class="col-md-4">
               <b>Dirección Domicilio</b>
          </div>
          <div class="col-md-8">
               <?php set_input("DirecciónDomicilio",@$row,$placeholder="Dirección Domicilio",$require=true,"form-control"); ?>
          </div>
     </div>
     <div class="row form-group">
          <div class="col-md-4"></div>                    
          <div class="col-md-3">  
               <?php echo ciudad(@$row["Ciudad"],"ciudad","Ciudad");?>
          </div>                    
          <div class="col-md-3">  
               <?php echo set_input("Region",@$row,$placeholder='departamento',$require=true,"firstLetterText",array("readonly"=>"readonly","id"=>"departamento"),false,false);?>
          </div>                  
          <div class="col-md-2">  
               <?php echo set_input("País",@$row,$placeholder='País',$require=true,"firstLetterText",array("readonly"=>"readonly","id"=>"pais"),false,false);?>
          </div>
     </div>
     <div class="row form-group">
          <div class="col-md-4"><b>Teléfono Celular</b></div>
          <div class="col-md-2">
               <?php set_input("Ind",@$row,$placeholder="#",$require=true,"form-control salto",array("maxlength"=>"3","data-salto"=>"Ind2")); ?>
          </div>
          <div class="col-md-2">
               <?php set_input("Ind2",@$row,$placeholder="#",$require=true,"form-control salto",array("maxlength"=>"3","id"=>"Ind2","data-salto"=>"NumCel")); ?>
          </div>
          <div class="col-md-4">
               <?php set_input("NumCel",@$row,$placeholder="#",$require=true,"form-control salto",array("maxlength"=>"4","id"=>"NumCel","data-salto"=>"end")); ?>
          </div>
     </div>
     <div class="row form-group">
          <div class="col-md-4"><b>Estrato Socioeconómico</b></div>
          <div class="col-md-4">
                <?php echo MakeEstrato("Estrato",@$row["Estrato"],array("Class"=>"form-control","require"=>true)); ?>
          </div>
          <div class="col-md-4"></div>
     </div>
     <div class="row form-group">
          <div class="col-md-4"><b>Teléfono Fijo</b></div>
          <div class="col-md-2">
               <?php set_input("IndF",@$row,$placeholder="#",$require=false,"form-control salto",array("maxlength"=>"3","data-salto"=>"Ind2F")); ?>
          </div>
          <div class="col-md-2">
               <?php set_input("Ind2F",@$row,$placeholder="#",$require=false,"form-control salto",array("maxlength"=>"3","data-salto"=>"NumFijo")); ?>
          </div>
          <div class="col-md-4">
               <?php set_input("NumFijo",@$row,$placeholder="#",$require=false,"form-control salto",array("maxlength"=>"4","data-salto"=>"end"));?>
          </div>
     </div>
     <div class="row form-group">
          <div class="col-md-4">
               <b class="pregunta">Turno en el cual transmitirás.</b>
          </div>
          <div class="row col-md-4">
               <div class="col-md-2"><?php echo set_input_radio("Turno","","Mañan (06:30 a.m. - 02:00 p.m.)",(@$row['Turno']=="Mañan (06:30 a.m. - 02:00 p.m.)")?true:false,"custom-control-input",""); ?></div>
               <h6 class="col-md-10">Mañana  </h6>
               <div class="col-md-2"><?php echo set_input_radio("Turno","","Tarde (01:30 p.m. - 10:00 p.m.)",(@$row['Turno']=="Tarde (01:30 p.m. - 10:00 p.m.)")?true:false,"custom-control-input",""); ?></div>
               <h6 class="col-md-10">Tarde   </h6>
               <div class="col-md-2"><?php echo set_input_radio("Turno","","Noche (09:30 p.m. - 06:00 a.m.)",(@$row['Turno']=="Noche (09:30 p.m. - 06:00 a.m.)")?true:false,"custom-control-input",""); ?></div>
               <h6 class="col-md-10">Noche   </h6>
          </div>
     </div>
</div>
<script>
     solonumeros(".salto");
</script>