<?php
	$empresa	=	$this->user->empresa;
	$row		=	$this->session->userdata('Encuesta');
?>
<input type="hidden"  require="true" value="1"/>
	<div class="row">
       <div class="form col-md-12">
            <div class="form-group item">
                 <h3>Información académica.</h3>
            </div>
       </div>
  	</div>
  <div class="row form-group">
       <div class="col-md-4">               
           <b>Nivel académico</b> 
       </div>
       <div class="col-md-4">
           <?php echo MakeNivelAcademico("NivelAcademico",@$row["NivelAcademico"],array("Class"=>"form-control")); ?> 
       </div>
  </div>
    <div class="row form-group">
       <div class="col-md-4">
            <b class="pregunta">¿Realizas estudios actualmente?  </b>
       </div>
       <div class="col-md-4"><?php echo set_input_radio("EstudioActual","","Si",(@$row['EstudioActual']=="Si")?true:false,"custom-control-input Mostrar",""); ?> Si</div>
       <div class="col-md-4"><?php echo set_input_radio("EstudioActual","","No",(@$row['EstudioActual']=="No")?true:false,"custom-control-input Mostrar",""); ?> No</div>
    </div>
  	<div class="row form-group">
        <div class="col-md-12 Opcional">
			<b>Si tu respuesta anterior fue SI, por favor escribe su informacion.</b>
        </div>
	</div>      
    <div class="row form-group Opcional">
        <div class="col-md-4">
             <b>Nombre institución educativa.</b>
        </div>
        <div class="col-md-4">
             <?php set_input("InsEdu",@$row,$placeholder="Nombre Institución educativa",$require=false,"form-control"); ?>
        </div>
        <div class="col-md-4"></div>
    </div>
    <div class="row form-group">
        <div class="col-md-12 Opcional">
           <div class="row form-group">
                <div class="col-md-4">
                     <b>Horario que estudias.</b>
                </div>
                <div class="col-md-4">
                    <div class="row">
						<div class="col-12">Desde las: </div> 
                        <div class="col-4">
                            <?php echo MakeHora("HoraEstudioDesde",@$row["HoraEstudioDesde"],array("class"=>"form-control")); ?>
                        </div>
                        <div class="col-4">
                            <?php echo MakeMinutos("MinutoEstudioDesde",@$row["MinutoEstudioDesde"],array("class"=>"form-control")); ?>
                        </div>
                        <div class="col-4">                                
                            <?php echo MakeMeridiano("Meridiano1",@$row["Meridiano1"],array("class"=>"form-control")); ?>
                        </div>                                
						<div class="col-12"> Hasta las: </div>
                        <div class="col-4">
							<?php echo MakeHora("HoraEstudioHasta",@$row["HoraEstudioHasta"],array("class"=>"form-control")); ?>
						</div>                         
                        <div class="col-4">
                         	<?php echo MakeMinutos("MinutoEstudioHasta",@$row["MinutoEstudioHasta"],array("class"=>"form-control")); ?>
						</div>                         
                        <div class="col-4">
                         	<?php echo MakeMeridiano("Meridiano2",@$row["Meridiano2"],array("class"=>"form-control")); ?>
						</div>                            
                     </div>
                </div>
                <div class="col-md-4"></div>
            </div>
      	</div>
	</div>
<script>
  $(document).ready(function() {
    <?php echo (@$row['EstudioActual']=="No")?"$('.Opcional').hide();":""?>
    <?php echo (!isset($row['EstudioActual']))?"$('.Opcional').hide();":""?>    
      $('.Mostrar').click(function(){
        if($(this).val()=="Si"){
          $('.Opcional').slideDown(1000);
          $('.Opcional').find('input').attr('require', true);
          $("a.continuar").removeClass("disabled");//.click(function(){$("form").submit();});
        }else{
          $('.Opcional').slideUp(1000);
          $('.Opcional').find('input').removeAttr('require');
        }
      });
    });
</script>      