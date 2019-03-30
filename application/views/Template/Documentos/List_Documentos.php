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
		            <h4 class="font-weight-700 text-uppercase"><?php echo $this->ModuloActivo;?></h4>
                </div>
                <div class="col-md-4 text-right">
                	<?php
						$hidden = array('id_profesion' => (isset($row->id_profesion))?$row->id_profesion:'',"redirect"=>base_url("Profesiones"));
						echo form_open(base_url($this->uri->segment(1)."/".$this->uri->segment(2)),array(),$hidden);	
					?>
                    	<div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Buscar" aria-describedby="btnGroupAddon" value="<?php echo post("search")?>" require>
                            <button type="submit" class="input-group-addon btn btn-primary">
	                            <i class="fa fa-eye" aria-hidden="true"></i>
                            </button>
                            <a href="<?php echo current_url();?>"  class="input-group-addon">
	                            Limpiar
                            </a>
                    	</div>
                    <?php 
						echo form_close();
					?>
                </div>
                <div class="col-md-2 text-right">
                	<a class="btn btn-primary btn-md btn-block" href="<?php echo base_url($this->uri->segment(1)."/Add")?>"><i class="fa fa-plus" aria-hidden="true"></i> Agregar</a>
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
