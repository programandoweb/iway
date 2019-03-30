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
		            	<h3>Sucursales</h3>
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
			</table>                
        </div>
	</div>
</div>            