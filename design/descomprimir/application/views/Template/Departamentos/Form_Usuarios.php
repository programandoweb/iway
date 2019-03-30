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
$hidden 	= 	array('id_esquema' => $this->uri->segment(3),"redirect"=>base_url("Departamentos"));
echo form_open(current_url(),array('ajax' => 'true'),$hidden);	?>
<div class="container">
	
	<div class="row justify-content-md-center">
    	<div class="col-md-8">
	        <div class="form">
                <div class="row form-group item">
	                <div class="col-md-12 text-center">
		            	<h3>Accionistas</h3>
                    </div>
                </div>
                <div class="row form-group item">
                    <div class="col-md-6">	
                        <div class="input-group">
                            <?php echo MakeUsers("user_id",(isset($row->user_id))?$row->user_id:NULL,array("class"=>"form-control"),$this->users);?>
                            <span class="input-group-addon" id="btnGroupAddon"><i class="fa fa-id-badge" aria-hidden="true"></i></span>
                        </div>				
                    </div>
                    <div class="col-md-6">	
                        <div class="input-group">
                            <input type="text" name="participacion_accionaria" class="form-control" placeholder="Participación Accionaria" aria-describedby="btnGroupAddon" value="<?php echo (isset($row->participacion_accionaria))?$row->participacion_accionaria:''?>" require>
                            <span class="input-group-addon" id="btnGroupAddon"><i class="fa fa-percent" aria-hidden="true"></i></span>
                        </div>				
                    </div>
               	</div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
	                        <button type="submit" class="btn btn-primary">Guardar</button>
                            <a class="btn btn-warning" href="<?php echo base_url($this->uri->segment(1));?>">Cerrar y Volver</a>
                            <a class="btn btn-info" href="<?php echo base_url("Usuarios/Add/Departamentos/Usuario/1");?>">Crear Usuario</a>
                        </div>                        
                    </div>
                </div>   
			</div>                
        </div>
    </div>
</div>
<?php echo form_close();?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col-md-8">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nombre y Apellido</th>
                        <th width="50">Participación</th>
                        <th width="50">Acción</th>
                    </tr>
                </thead>
            	<tbody>
                	<?php foreach($this->dep_users as $v){?>
                        <tr>
                            <td><?php print_r($v->persona_contacto.' ('.$v->login.')');?></td>
                            <td class="text-center"><?php print_r($v->participacion_accionaria);?>%</td>
                            <td><a href="<?php echo base_url($this->uri->segment(1).'/Usuario_del/'.$this->uri->segment(3).'/'.$v->id_esquema_usuario)?>"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                        </tr>
                    <?php }?>
                </tbody>
                <tfoot>
	                <tr>
                        <th>Nombre y Apellido</th>
                        <th>Participación</th>
                        <th>Acción</th>
                    </tr>
                </tfoot>
			</table>                
        </div>
	</div>
</div>            