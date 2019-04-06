<?php 

?>
<?php 
$modulo		=	$this->ModuloActivo;
$row		=	$this->$modulo->result;
$hidden     =   array('id' => $this->uri->segment(3));
echo form_open(current_url(),array(),$hidden);	?>
<div class="container" style="margin-bottom:20px;">
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
                        <?php //echo Clientes(@$row,"empresa",'Empresa',$require=true);?>
                    </div>
				</div>                    
                <div class="row form-group">
                    <div class="col-md-6 text-right">	
                    	<b>Persona de contacto</b>
                    </div>
                    <div class="col-md-6">	
	                    <?php set_input("persona_contacto",@$row,$placeholder='Persona de Contacto',$require=false,"firstLetterText");?>
                    </div>
                </div>
                <div class="row form-group">
	                <div class="col-md-6 text-right">	
                    	<b>Telefono </b>
                    </div>
                    <div class="col-md-6">	
                        <?php set_input("telefono",@$row,$placeholder='Telefono',$require=false,"firstLetterText");?>
                    </div>
				</div>                
                <div class="row form-group">                    
                    <div class="col-md-6 text-right">	
                    	<b>email </b>
                    </div>
                    <div class="col-md-6">	
	                    <?php //echo correo(@$row,"email",'email',$require=false);?>
                    </div>
                </div>
                <div class="row form-group">                    
                    <div class="col-md-6 text-right">   
                        <b>Ciudad </b>
                    </div>
                    <div class="col-md-6">  
                        <?php set_input("ciudad",@$row,$placeholder='Ciudad',$require=false,"firstLetterText");?>
                    </div>
                </div>
                <div class="row form-group">                    
                    <div class="col-md-6 text-right">	
                    	<b>ASOSEA </b>
                    </div>
                    <div class="col-md-6">	
	                    <?php echo MakeSiNo("asocea",array(),array("class"=>"form-control",false));?>
                    </div>
                </div>
                <div class="row form-group">                    
                    <div class="col-md-6 text-right">	
                    	<b>Red|Ben </b>
                    </div>
                    <div class="col-md-6">	
	                    <?php echo MakeSiNo("redben",array(),array("class"=>"form-control",false));?>
                    </div>
                </div>
                <div class="row form-group">                    
                    <div class="col-md-6 text-right">   
                        <b>Observaciones </b>
                    </div>
                    <div class="col-md-6">  
                        <?php 
                        if(!empty($row->observacion)){
                           $row = $row->observacion; 
                        }
                        echo form_textarea("observacion",$row,array("class"=>"form-control",false));?>
                    </div>
                </div>
                <div class="text-center" id="btn-generar">
                        <button type="submit" class="btn btn-primary btn-md"> Agregar</button>
                </div>                                     
			</div>
        </div>
    </div>
</div>
<?php echo form_close();?>