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
$hidden 	= 	array("redirect"=>base_url("Empresas/Listado"));
echo form_open(current_url(),array('ajax' => 'true'),$hidden);	
?>
<div class="container" style="margin-bottom:20px;">
	
	<div class="row justify-content-md-center">
    	<div class="col-md-8">
        	<div class="form">
	            <div class="row form-group item">
	                <div class="col-md-12 text-center" >
		            	<h3>Estatus Perfiles Activos o Inactivos</h3>
                    </div>
                </div>
                <div class="row form-group">
                	<input type="hidden" require="true" name="minactivos" value="1"/>
                	<?php if($this->user->mostrar_inactivos==1){?>
                        <div class="alert alert-info" role="alert" style="width:100%;">
                            <div class="col-md-12 text-center" >
                                <h4 class="alert-heading text-center">Estado de los perfiles a Mostrar, se encuentra activo</h4>
                                <p>En todos los módulos relacionados con perfiles, se podrá visualizar tanto los activos como inaactivos</p>
                            </div>
                        </div>
                    <?php }else{?>
                        <div class="alert alert-danger" role="alert" style="width:100%;">
                            <div class="col-md-12 text-center" >
                                <h4 class="alert-heading text-center">Estado de los perfiles a Mostrar, está inactivo</h4>
	                            <p>En todos los módulos relacionados con perfiles, se podrá visualizar tanto los activos como inaactivos</p>
                            </div>
                        </div>
					<?php }?>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary">Cambiar</button>
                            <a class="btn btn-warning" href="<?php echo base_url();?>"><i class="fas fa-times"></i> Cerrar y Volver</a>
                        </div>                        
                    </div>
                </div>                   
			</div>
        </div>
    </div>
</div>
<?php echo form_close();?>