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
        	<div class="row filters">
            	<div class="col-md-6">
		            <h4 class="font-weight-700 text-uppercase orange"><?php echo $this->ModuloActivo;?> Subir <?php echo $this->uri->segment(2);?>.</h4>
                </div>
                <div class="col-md-6 text-right">
                    <a class="btn btn-primary btn-md " href="<?php echo base_url();?>">
                    	<i class="fa fa-chevron-left" aria-hidden="true"></i> 
                        Volver
					</a>
                </div>
            </div>
            <div class="row">
            	<div class="col-md-12">
                    <table class="ordenar display table table-hover">
                    	<thead>
                    		<tr>
                                <th>Nombre Legal / Comercial</th>
                                <th class="text-center">Logotipo</th>
                                <th class="text-center">Estado</th>
                                <th class="text-center">Acción</th>
                            </tr>        
                        </thead>
                        <tbody>
                            <?php 
                                $sum=0;
                                if(count($this->$modulo->result)>0){
                                    foreach($this->$modulo->result as $v){
                            ?>
                            <tr>
                                <td><?php 	print($v->nombre_legal);?></td>
                                <td>
									<img style=" width:70px;" class="img rounded-circle mx-auto d-block" src="<?php 	echo img_logo($v->user_id);?>" />
								</td>
                                <td  class="text-center">
                                	<?php 	print($v->estado);?>
                                </td>
                                <td  class="text-center">
                                	<div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                    	<a class="btn btn-secondary " title="Cargar Archivo" data-type="iframe" href="<?php echo base_url("Configuracion/Add_Logo/".$v->user_id)?>">
                                        	<i class="fa fa-upload" aria-hidden="true"></i>
										</a>
									</div>
                                </td>
                            </tr>
                            <?php			
                                    }
                                }else{
                            ?>
                                <tr>
                                    <td colspan="4" class="text-center">
                                        No existen Registros
                                    </td>
                                </tr>
                            <?php		
                                }
                            ?>    
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
