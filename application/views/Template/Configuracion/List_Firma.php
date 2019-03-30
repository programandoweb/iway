<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/
$modulo		=	$this->ModuloActivo;
?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
        	<?php 
    				echo TaskBar(array("name"		=>	array(	"title"	=>	"Subir " .$this->uri->segment(2),
    													 "url"	=>	current_url()),
    							)
    						);
    			?>
        	<div class="row">
            	<?php //pre($this->$modulo->result)?>
            	<div class="col-md-12">
					<table class="ordenar display table table-hover">
                        <thead>
                            <tr>
                               <th>Nombre Legal / Comercial</th>
                               <th>Logotipo</th>
                               <th>Estado</th>
                               <th class="text-right" width="20">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                        	<?php 	if(count($this->$modulo->result)>0){
			                        	foreach($this->$modulo->result as $v){?>
                                            <tr>
                                               <td><?php echo $v->nombre_legal;?></td>
                                               <td><?php echo $v->imagen;?></td>
                                               <td><?php echo $v->estado;?></td>
                                               <td class="text-center"><?php echo $v->edit;?></td>
                                            </tr>
                            <?php 
										}
									}
							?>
                        </tbody>
					</table>                        
                </div>
            </div>
        </div>
    </div>
</div>
