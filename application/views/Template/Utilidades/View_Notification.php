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
$modulo			=	$this->ModuloActivo;
$row			=	$this->$modulo->notificacion;
$Notificacion	=	Notificacion($row);
$hidden 		= 	array('user_id' => (isset($row->user_id))?$row->user_id:'');
echo form_open(current_url(),array('ajaxing' => 'true'),$hidden);	?><div class="container" style="margin-bottom:100px;">
	<div class="row justify-content-md-center">
    	<div class="col-md-12">
        	<div class="form">
	            <div class="row form-group item">
	                <div class="col-md-12 text-center">
		            	<h3>Información de Notificación</h3>
                    </div>
                </div>
                <div id="extra_datos">
                    <div class="row form-group">                    
                        <div class="col-md-6 text-right">   
                            <b>Fecha</b>
                        </div>
                        <div class="col-md-6"> 
	                        <?php print($row->fecha);?>
						</div>
                    </div>                    
                    <div class="row form-group">                    
                        <div class="col-md-6 text-right">   
                            <b>Notificación *</b>
                        </div>
                        <div class="col-md-6"> 
	                        <?php 
								print($Notificacion->tarea);
							?>
						</div>
                    </div>                    
                    <div class="row form-group">                    
                        <div class="col-md-6 text-right">	
                            <b>Observacion *</b>
                        </div>
                        <div class="col-md-6">	
                            <?php print($Notificacion->descripcion);?>
                        </div>
                    </div>
				</div>                    
			</div>
        </div>
    </div>
</div>
<?php echo form_close();?>