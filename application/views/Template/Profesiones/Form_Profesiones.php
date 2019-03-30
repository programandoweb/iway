<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/?>
<?php 
$row	=	$this->Profesiones->result;
$hidden = array('id_profesion' => (isset($row->id_profesion))?$row->id_profesion:'',"redirect"=>base_url("Profesiones"));
echo form_open(current_url(),array('ajax' => 'true'),$hidden);	?>
<div class="container">
	
	<div class="row justify-content-md-center">
    	<div class="col">
        	<div class="row filters">
            	<div class="col-md-6">
		            <h4 class="font-weight-700 text-uppercase">Agregar <?php echo $this->ModuloActivo;?></h4>
                </div>
            </div>
            <div class="form">
                <div class="row">
                    <div class="col-md-4">	
                        <div class="input-group">
                            <input type="text" name="codigo" class="form-control" placeholder="Código" aria-describedby="btnGroupAddon" value="<?php echo (isset($row->id_profesion))?$row->id_profesion:''?>" require>
                            <span class="input-group-addon" id="btnGroupAddon"><i class="fa fa-code" aria-hidden="true"></i></span>
                        </div>				
                    </div>
                    <div class="col-md-4">	
                        <div class="input-group">
                            <input type="text" name="nombre" class="form-control" placeholder="Nombre de la Profesión" aria-describedby="btnGroupAddon" value="<?php echo (isset($row->nombre))?$row->nombre:''?>" require>
                            <span class="input-group-addon" id="btnGroupAddon"><i class="fa fa-id-badge" aria-hidden="true"></i></span>
                        </div>				
                    </div>
                    <div class="col-md-4">	
                        <?php echo MakeEstado("estado",(isset($row->estado))?$row->estado:NULL,array("class"=>"form-control"));?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <?php 
                                $data = array('descripcion' => 'descripcion','value' =>(isset($row->descripcion))?$row->descripcion:'', 'class' => 'form-control' ,'rows' => '3', 'cols' => '40','placeholder'=>'Descripción de la profesión',"require"=>"require");
                                echo form_textarea($data);
                            ?>
                        </div>                        
                    </div>
                </div> 
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                            <a class="btn btn-warning" href="<?php echo base_url($this->uri->segment(1));?>"><i class="fas fa-times"></i> Cerrar y Volver</a>
                        </div>                        
                    </div>
                </div>            
			</div>
        </div>
    </div>
</div>
<?php echo form_close();?>
