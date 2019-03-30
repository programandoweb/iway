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
$hidden 	= 	array("rel_plataforma_id"=>$this->uri->segment(3),"redirect"=>base_url("Usuarios/AsignarMaster"));
echo form_open(current_url(),array('ajaxing' => 'true'),$hidden);	?>
<div class="container" style="margin-bottom:100px;">
	<div class="row justify-content-md-center">
    	<div class="col-md-8">
        	<div class="form">
	            <div class="row form-group item">
	                <div class="col-md-12 text-center">
		            	<h3>Crear Master</h3>
                    </div>
                </div>
                <div class="row form-group">
	                <div class="col-md-4 text-right">	
                    	<b>Nombre página *</b>
                    </div>
                    <div class="col-md-8">	
                        <?php echo MakePlataformas("id_plataforma",@$row->id_plataforma,array("class"=>"form-control"),$this->Usuarios->get_plataformas_rel_master());?>
                    </div>
				</div>                    
                <div class="row form-group">
	                <div class="col-md-4 text-right">	
                    	<b>Nombre Master *</b>
                    </div>
                    <div class="col-md-8">	
                        <?php set_input("nombre_master",@$row,$placeholder='Nombre del Master',$require=true);?>
                    </div>
				</div>
                <div class="row form-group">
	                <div class="col-md-4 text-right">	
                    	<b>Cuentas Bancarias *</b>
                    </div>
                    <div class="col-md-8">	
                        <?php echo MakeCuentasBancarias("cuenta_id",@$row->cuenta_id,array("class"=>"form-control"),$this->Usuarios->get_CuentasBancarias());?>
                    </div>
				</div>
                <div class="row form-group item">
	                <div class="col-md-4 text-right">	
                    	<b>Estado</b>
                    </div>
                    <div class="col-md-3">	
                        <?php echo MakeEstado("estado",(isset($row->estado))?$row->estado:NULL,array("class"=>"form-control"));?>
                    </div>
				</div> 
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>                        
                    </div>
                </div>                   
			</div>
        </div>
    </div>
</div>
<?php echo form_close();?>