<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/?>
<?php 
	if(!centro_de_costos()){
		return;
	}
?>
<?php 
$modulo     =   $this->ModuloActivo;
$row        =   $this->$modulo->result;
$hidden     =   array('id' => $this->uri->segment(3));
echo form_open(current_url(),array('ajaxing' => 'true'),$hidden);  ?>
<div class="container" style="margin-bottom:100px;">
	<div class="row justify-content-md-center">
    	<div class="col-md-8">
        	<div class="form">
	            <div class="row form-group item">
	                <div class="col-md-12 text-center">
		            	<h3>Información</h3>
                    </div>
                </div>
                <div class="row form-group">
	                <div class="col-md-6 text-right">	
                    	<b>Empresa *</b>
                    </div>
                    <div class="col-md-6">	
                        <?php set_input("empresa",$row,$placeholder='Empresa',$require=true,"firstLetterText");?>
                    </div>
				</div>                    
                <div class="row form-group">
                    <div class="col-md-6 text-right">	
                    	<b>Persona de contacto</b>
                    </div>
                    <div class="col-md-6">	
	                    <?php set_input("persona_contacto",$row,$placeholder='Persona de Contacto',$require=false,"firstLetterText");?>
                    </div>
                </div>
                <div class="row form-group">
	                <div class="col-md-6 text-right">	
                    	<b>Telefono </b>
                    </div>
                    <div class="col-md-6">	
                        <?php set_input("telefono",$row,$placeholder='Telefono',$require=false,"firstLetterText");?>
                    </div>
				</div>                
                <div class="row form-group">                    
                    <div class="col-md-6 text-right">	
                    	<b>email </b>
                    </div>
                    <div class="col-md-6">	
	                    <?php set_input("email",$row,$placeholder='Email',$require=false);?>
                    </div>
                </div>
                <div class="row form-group">                    
                    <div class="col-md-6 text-right">   
                        <b>Ciudad </b>
                    </div>
                    <div class="col-md-6">  
                        <?php set_input("ciudad",$row,$placeholder='Ciudad',$require=false,"firstLetterText");?>
                    </div>
                </div>
                <div class="row form-group">                    
                    <div class="col-md-6 text-right">	
                    	<b>ASOSEA </b>
                    </div>
                    <div class="col-md-6">	
	                    <?php echo MakeSiNo("asocea",$row->asocea,array("class"=>"form-control",false));?>
                    </div>
                </div>
                <div class="row form-group">                    
                    <div class="col-md-6 text-right">	
                    	<b>Red|Ben </b>
                    </div>
                    <div class="col-md-6">	
	                    <?php echo MakeSiNo("redben",$row->redben,array("class"=>"form-control",false));?>
                    </div>
                </div>
                <div class="row form-group">                    
                    <div class="col-md-6 text-right">   
                        <b>Observaciones </b>
                    </div>
                    <div class="col-md-6">  
                        <?php echo form_textarea("observacion",@$row->observacion,array("class"=>"form-control",false));?>
                    </div>
                </div>
                <div class="text-center" id="btn-generar">
                        <button type="submit" class="btn btn-primary btn-md"> Actualizar</button>
                </div>                                     
			</div>
        </div>
    </div>
</div>
<?php echo form_close();?>