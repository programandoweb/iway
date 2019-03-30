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
		            <h4 class="font-weight-700 text-uppercase orange">Centro de costos.</h4>
                </div>
                <div class="col-md-6 text-right">
                	<a class="btn btn-primary btn-md" href="<?php echo base_url($this->uri->segment(1)."/Add")?>">
                    	<i class="fa fa-plus" aria-hidden="true"></i> 
                        Agregar
					</a>
                    <a class="btn btn-primary btn-md " href="#">
                    	<i class="fa fa-download" aria-hidden="true"></i> 
						Exportar
					</a>
                    <a class="btn btn-primary btn-md " href="<?php echo ($this->agent->referrer())?$this->agent->referrer():base_url();?>">
                    	<i class="fa fa-chevron-left" aria-hidden="true"></i> 
                        Volver
					</a>
                </div>
            </div>
            <?php #print_r($this->agent->referrer());?>
            <div class="row">
            	<div class="col-md-12">
					<?php	echo (isset($this->Listado))?$this->Listado:''; ?>
                </div>
            </div>
        </div>
    </div>
</div>
