<?php
     $empresa  =    $this->user->empresa;
     $row      =    $this->session->userdata('Encuesta');
?>
<script>
  $( function() {
    $( ".datepicker" ).datepicker({changeMonth: true,changeYear: true});
    $( ".datepicker" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
    $( "#FechaIngreso" ).val("<?php echo @$row['FechaIngreso']; ?>");
    $( "#FechaRetiro" ).val("<?php echo @$row['FechaRetiro']; ?>");
    $( ".datepicker" ).datepicker({changeMonth: true,changeYear: true,showOtherMonths: true,selectOtherMonths: true});
  });
</script>
<input type="hidden"  require="true" value="1"/>
<div class="row"> 
     <div class="form col-md-12">
          <div class="form-group item">
                <h3><b> Experiencia específica .</b></h3>    
          </div>  
     </div>  
</div>
<div class=" row form-group">
     <div class="col-md-4">
          <label><b class="pregunta">¿Has sido modelo webcam?</b></label>
     </div>
     <div class="col-md-4">
          <h6>Si</h6>
          <?php echo set_input_radio("ModeloWeb","","Si",(@$row['ModeloWeb']=="Si")?true:false,"custom-control-input Mostrar",""); ?>
     </div>
     <div class="col-md-4">
          <h6>No</h6>
          <?php echo set_input_radio("ModeloWeb","","No",(@$row['ModeloWeb']=="No")?true:false,"custom-control-input Mostrar",""); ?>                  
     </div>  
</div>
<div class="row form-group Opcional">  
     <div class="col-md-4">
          <b>Nombre del estudio</b>   
     </div>
     <div class="col-md-4">
          <?php set_input("NombreEstudio",@$row,$placeholder="Nombre del Estudio",$require=false,"form-control"); ?>
     </div>
     <div class="col-md-4"></div>
</div>
<div class="row form-group Opcional">  
     <div class="col-md-4">
          <b>Plataformas trabajadas</b>   
     </div>
     <div class="col-md-4">
          <?php set_input("PaginasTrabajadas",@$row,$placeholder="Paginas Trabajadas",$require=false,"form-control"); ?>
     </div>
     <div class="col-md-4"></div>
</div>
<!--<div class="row form-group Opcional">  
     <div class="col-md-4">
          <b>Nombre de la última o actual empresa</b>   
     </div>
     <div class="col-md-4">
          <?php set_input("NombreúltimaEmpresa",@$row,$placeholder="Nombre de la última empresa",$require=false,"form-control"); ?>
     </div>
     <div class="col-md-4"></div>
</div>-->
<!--<div class="row form-group Opcional">  
     <div class="col-md-4">
          <b>Cargo desempeñado</b>   
     </div>
     <div class="col-md-4">
          <?php set_input("CargoDesempeñado",@$row,$placeholder="Cargo desempeñado",$require=false,"form-control"); ?>
     </div>
     <div class="col-md-4"></div>
</div>-->
<div class="row form-group Opcional">  
     <div class="col-md-4">
          <b>Fecha de ingreso</b>   
     </div>
     <div class="col-md-4">
          <?php set_input("FechaIngreso",@$row,$placeholder="AAAA-MM-DD",$require=false,"form-control datepicker"); ?>
     </div>
     <div class="col-md-4"></div>
</div>
<div class="row form-group Opcional">  
     <div class="col-md-4">
          <b>Fecha de retiro</b>   
     </div>
     <div class="col-md-4">
          <?php set_input("FechaRetiro",@$row,$placeholder="AAAA-MM-DD",$require=false,"form-control datepicker"); ?>
     </div>
     <div class="col-md-4"></div>
</div>
<script>
  $(document).ready(function() {
      <?php echo (@$row['ModeloWeb']=="No")?"$('.Opcional').hide();":""?>
    <?php echo (!isset($row['ModeloWeb']))?"$('.Opcional').hide();":""?>
    
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