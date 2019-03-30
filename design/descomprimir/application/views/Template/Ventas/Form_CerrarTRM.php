<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/?>
<?php 
$hidden 	= 	array("ciclos_id"=>$this->uri->segment(3));
echo form_open(current_url(),array('aja' => 'true'),$hidden);	?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col-md-8">
        	<div class="form">
	            <div class="row form-group">
	                <div class="col-md-6 text-right">	
                    	<b>Período </b>
                    </div>
                    <div class="col-md-6">	
                       <?php $ciclos_pagos_now=get_ciclos_pagos_now();echo (!empty($ciclos_pagos_now))?$ciclos_pagos_now:'';?>
                    </div>
				</div> 
                <div class="row form-group">
	                <div class="col-md-6 text-right">	
                    	<b>TRM Liquidación *</b>
                    </div>
                    <div class="col-md-6">	
                       <?php set_input("TRM_Liquidacion",null,$placeholder='Ej: 15.52',$require=true);?>
                       <b style="font-size:11px;">Para valores decimales, favor ingresar punto(.) en lugar del signo coma(,)</b>
                    </div>
				</div> 
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary">Cerrar Período <?php echo (!empty($ciclos_pagos_now))?$ciclos_pagos_now:'';?></button>
                        </div>                        
                    </div>
                </div>                   
			</div>
        </div>
    </div>
</div>
<?php echo form_close();?>