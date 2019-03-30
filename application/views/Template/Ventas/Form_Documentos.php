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
$hidden = array('id_documento' => (isset($row->id_documento))?$row->id_documento:'',"redirect"=>base_url("Documentos/Listado"));
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
                            <input type="text" name="dias_vencimiento" class="form-control" placeholder="Días vencimiento" aria-describedby="btnGroupAddon" value="<?php echo (isset($row->dias_vencimiento))?$row->dias_vencimiento:''?>" require>
                            <span class="input-group-addon" id="btnGroupAddon">Días<i class="fa fa-calendar" aria-hidden="true"></i></span>
                        </div>				
                    </div>
                    <div class="col-md-4">	
                        <div class="input-group">
                            <input type="text" name="nombre" class="form-control" placeholder="Nombre del Documento" aria-describedby="btnGroupAddon" value="<?php echo (isset($row->nombre))?$row->nombre:''?>" require>
                            <span class="input-group-addon" id="btnGroupAddon">Documento<i class="fa fa-file-text" aria-hidden="true"></i></span>
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
                                $data = array('descripcion' => 'descripcion','value' =>(isset($row->descripcion))?$row->descripcion:'', 'class' => 'form-control' ,'rows' => '3', 'cols' => '40','placeholder'=>'Descripción del documento',"require"=>"require");
                                echo form_textarea($data);
                            ?>
                        </div>                        
                    </div>
                </div> 
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                            <a class="btn btn-warning" href="<?php echo base_url($this->uri->segment(1));?>">Cerrar y Volver</a>
                        </div>                        
                    </div>
                </div>            
			</div>
        </div>
    </div>
</div>
<?php echo form_close();?>
