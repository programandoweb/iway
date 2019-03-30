<?php
     $empresa  =    $this->user->empresa;
     $row      =    $this->session->userdata('Encuesta');
?>
<input type="hidden"  require="true" value="1"/>
<div class="row">
     <div class="form col-md-12">
          <div class="form-group item">
               <h3><b>Ciclo menstrual.</b></h3>
          </div>
     </div>
</div>
<div class=" row form-group">
     <div class="col-md-4">
          <b>¿Tu ciclo menstrual es?</b>
     </div>
     <div class="col-md-4">
          <?php echo MakeCicloMestrual("CicloMes",@$row["CicloMes"],array("Class"=>"form-control"));?>
     </div>
     <div class="col-md-4"></div>       
</div>
<div class=" row form-group">
     <div class="col-md-4">
          <b>Fechas aproximadas del Periodo</b>
     </div>
     <div class="col-md-4">
          <?php echo MakePeriodoMestruacion("Periodo_Mestruación",@$row["Periodo_Mestruación"],array("Class"=>"form-control"));?>
     </div>
     <div class="col-md-4"></div>       
</div>
<div class=" row form-group">
     <div class="col-md-4">
          <b>Cólicos</b>
     </div>
     <div class="col-md-4">
          <?php echo MakeDuracionPeriodo("Colicos",@$row["Colicos"],array("Class"=>"form-control"));?>
     </div>
     <div class="col-md-4"></div>       
</div>
<div class=" row form-group">
     <div class="col-md-4">
          <b>Duración del periodo</b>
     </div>
     <div class="col-md-4">
          <?php echo MakeColicos("Duración_Periodo",@$row["Duración_Periodo"],array("Class"=>"form-control"));?>
     </div>
     <div class="col-md-4"></div>       
</div>
<div class=" row form-group">
     <div class="col-md-4">
          <b>Talla de senos o tamaño del pene:</b>
     </div>
     <div class="col-md-8">
          <?php set_input("Tamaño_del_Miembro_o_senos",@$row["Tamaño_del_Miembro_o_senos"],$placeholder='Talla de senos o tamaño del pene:',$require=true,"firstLetterText");?>
     </div>    
</div>
<div class=" row form-group">
     <div class="col-md-4">
          <b>Cintura (según medida de jeans):</b>
     </div>
     <div class="col-md-8">
          <?php set_input("Medida_Cintura",@$row["Medida_Cintura"],$placeholder='Cintura (según medida de jeans):',$require=true,"firstLetterText");?>
     </div>    
</div>
<div class=" row form-group">
     <div class="col-md-4">
          <b>Estatura - metros:</b>
     </div>
     <div class="col-md-8">
          <?php set_input("Estatura_Metros",@$row["Estatura_Metros"],$placeholder='Estatura - metros:',$require=true,"firstLetterText");?>
     </div>    
</div>
<div class=" row form-group">
     <div class="col-md-4">
          <b>Peso – kilos:</b>
     </div>
     <div class="col-md-8">
          <?php set_input("Peso_Kilos",@$row['Peso_Kilos'],$placeholder='Peso – kilos:',$require=true,"firstLetterText");?>
     </div>    
</div>