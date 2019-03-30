<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
        	<div class="row filters">
            	<div class="col-md-6">
		            <h4 class="font-weight-700 text-uppercase orange"><?php echo $this->uri->segment(3);?>.</h4>
                </div>
                <div class="col-md-6 text-right">
                	<?php if($this->uri->segment(3)!='Plataforma'){?>
	                <a class="btn btn-primary btn-md" href="<?php echo base_url($this->uri->segment(1)."/Add_Todos/".$this->uri->segment(3))?>"><i class="fa fa-plus" aria-hidden="true"></i> Agregar</a>
                    <?php btn_export();?>
					<a class="btn btn-primary btn-md " href="<?php echo base_url();?>">
                    	<i class="fa fa-chevron-left" aria-hidden="true"></i> 
                        Volver
					</a>
                    <?php }?>
                </div>
            </div>
            <div class="row">
            	<div class="col-md-12">
					<?php	echo (isset($this->Listado))?$this->Listado:''; ?>
                </div>
            </div>
        </div>
    </div>
</div>
