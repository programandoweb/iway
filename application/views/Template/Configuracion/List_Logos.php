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
		            <h4 class="font-weight-700 text-uppercase orange">Subir <?php echo $this->uri->segment(2);?>.</h4>
                </div>
            </div>
            <div class="row">
            	<div class="col-md-12">
                    <table class="ordenar display table table-hover" data-url="<?php echo current_url()?>">
                    	<thead>
                    		<tr>
                                <th>Nombre Legal / Comercial</th>
                                <th class="text-center">Logotipo</th>
                                <!--<th class="text-center">Estado</th>-->
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
                                <td>
                                <p style=" margin-top:15px;" >
                                <?php 	print($v->nombre_legal);?>
                                </p>
                                </td>
                                <td>
									<img style=" width:70px;" class="img rounded-circle mx-auto d-block" src="<?php 	echo img_logo($v->user_id);?>" />
								</td>
                                <!--<td  class="text-center">
                                	<?php 	print($v->estado);?>
                                </td>-->
                                <td  class="text-center">
                                	<div role="group" aria-label="Small button group">
                                    	<a class="lightbox" title="Cargar Archivo" data-type="iframe" href="<?php echo base_url("Configuracion/Add_Logo/".$v->user_id)?>">
                                        	<i class="fa fa-upload" aria-hidden="true"></i>
										</a>
									</div>
                                </td>
                            </tr>
                            <?php			
                                    }
                                }else{
                            ?>
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
