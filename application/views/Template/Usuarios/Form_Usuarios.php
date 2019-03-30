<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/?>
<?php 
$modulo		=	$this->ModuloActivo;
$row		=	$this->$modulo->result;
$hidden 	= 	array('user_id' => (isset($row->user_id))?$row->user_id:'',"redirect"=>base_url("Usuarios"));
echo form_open(current_url(),array('ajax' => 'true'),$hidden);	?>

<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col-md-8">
	        <div class="form">
                <div class="row form-group item">
	                <div class="col-md-12 text-center">
		            	<h3>Usuario</h3>
                    </div>
                </div>
                <div class="row form-group item">
                    <div class="col-md-6">	
                        <div class="input-group">
                            <input type="text" name="persona_contacto" class="form-control" placeholder="Nombre y Apellido accionista" aria-describedby="btnGroupAddon" value="<?php echo (isset($row->persona_contacto))?$row->persona_contacto:''?>" require size="3">
                            <span class="input-group-addon" id="btnGroupAddon"><i class="fa fa-code" aria-hidden="true"></i></span>
                        </div>				
                    </div>
                    <div class="col-md-6">	
                        <div class="input-group">
                            <?php echo MakeTipoPersona("tipo_persona",(isset($row->tipo_persona))?$row->tipo_persona:NULL,array("class"=>"form-control"));?>
                        </div>				
                    </div>
               	</div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>                        
                    </div>
                </div>            
			</div>                
        </div>
    </div>
</div>
<?php echo form_close();?>
