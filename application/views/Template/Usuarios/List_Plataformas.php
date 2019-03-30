<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/
$modulo		=	$this->ModuloActivo;
//pre($this->$modulo->result);
?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
            <?php 
				echo TaskBar(array("name"		=>	array(	"title"	=>	"Plataformas de Trabajo.",
															"url"	=>	current_url()),
							)
						);
			?>
            <div class="row">
            	<div class="col-md-12">
                    <div class="bd-example bd-example-tabs" role="tabpanel">
    	                <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link <?php if($this->uri->segment(4)=='pvt'){echo ' active ';}?>" id="nacionales-tab" data-toggle="tab" href="#pvt" role="tab" aria-controls="pvt" aria-expanded="false">PVT</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php if($this->uri->segment(4)=='free' || !$this->uri->segment(4)){echo ' active ';}?>" id="free-tab" data-toggle="tab" href="#free" role="tab" aria-controls="free" aria-expanded="true">FREE</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php if($this->uri->segment(4)=='rss'){echo ' active ';}?>" id="rss-tab" data-toggle="tab" href="#rss" role="tab" aria-controls="rss" aria-expanded="true">RSS</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div role="tabpanel" class="tab-pane fade <?php if($this->uri->segment(4)=='pvt'){echo ' active show ';}?>" id="pvt" aria-labelledby="pvt-tab" aria-expanded="false">
                                <table class="display table table-hover">
                                    <thead>
                                        <tr>
                                            <th><b>Nombre</b></th>
                                            <th width="120" class="text-center" ><b>Moneda de Pago</b></th>
                                            <th width="120" class="text-center" ><b>Equivalencia</b></th>
                                            <th width="20" class="text-center" ><b>Acción</b></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            if(count($this->$modulo->result["PVT"])>0){
                                                foreach($this->$modulo->result["PVT"] as $v){
                                                    
                                        ?>
                                                    <tr>
                                                        <td>
                                                            <?php print_r($v->primer_nombre);?>
                                                        </td>	
                                                        <td  class="text-center" >
                                                            <?php print_r($v->moneda_de_pago);?>
                                                        </td>
                                                        <td  class="text-center" >
                                                            <?php print_r($v->equivalencia);?>
                                                        </td>	
                                                        <td class="text-center">
                                                            <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                                                <a <?php if(!get_rel_plataforma($v->user_id)){ echo 'href="'.base_url("Usuarios/ActivarPlataforma/".$v->user_id.'/1/pvt').'"';}else{echo 'href="'.base_url("Usuarios/ActivarPlataforma/".$v->user_id.'/0/pvt').'"';}?> title="<?php if(get_rel_plataforma($v->user_id)){echo 'Desactivar';}else{echo 'Activar';}?> Plataforma al Centro de costos" >
                                                                    <?php if(get_rel_plataforma($v->user_id)){?>
                                                                        <i class="fas fa-times" aria-hidden="true"></i>
                                                                    <?php }else{ ?>
                                                                        <i class="fas fa-check" aria-hidden="true"></i>
                                                                    <?php } ?>
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
                            <div role="tabpanel" class="tab-pane fade <?php if($this->uri->segment(4)=='free' || !$this->uri->segment(4)){echo ' active show ';}?> " id="free" aria-labelledby="free-tab" aria-expanded="false">
                            	<table class="display table table-hover">
                                    <thead>
                                        <tr>
                                            <th><b>Nombre</b></th>
                                            <th  width="120" class="text-center"><b>Moneda de Pago </b></th>
                                            <th  width="120" class="text-center"><b>Equivalencia</b></th>
                                            <th width="20" class="text-center" ><b>Acción</b></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            if(count($this->$modulo->result["Free"])>0){
                                                foreach($this->$modulo->result["Free"] as $v){
                                                    
                                        ?>
                                                    <tr>
                                                        <td>
                                                            <?php print_r($v->primer_nombre);?>
                                                        </td>	
                                                        <td  class="text-center">
                                                           <?php print_r($v->moneda_de_pago);?> 
                                                        </td>	
                                                        <td  class="text-center">
                                                           <?php print_r($v->equivalencia);?>
                                                        </td>	
                                                        <td class="text-center">
                                                            <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                                                <a <?php if(!get_rel_plataforma($v->user_id)){ echo 'href="'.base_url("Usuarios/ActivarPlataforma/".$v->user_id.'/1').'"';}else{echo 'href="'.base_url("Usuarios/ActivarPlataforma/".$v->user_id.'/0').'"';}?> title="<?php if(get_rel_plataforma($v->user_id)){echo 'Desactivar';}else{echo 'Activar';}?> Plataforma al Centro de costos" >
                                                                    <?php if(get_rel_plataforma($v->user_id)){?>
                                                                        <i class="fas fa-times" aria-hidden="true"></i>
                                                                    <?php }else{ ?>
                                                                        <i class="fas fa-check" aria-hidden="true"></i>
                                                                    <?php } ?>
                                                                </a>
                                                            </div>
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
                            <div role="tabpanel" class="tab-pane fade <?php if($this->uri->segment(4)=='rss'){echo ' active show ';}?>" id="rss" aria-labelledby="rss-tab" aria-expanded="false">
                            	<table class="display table table-hover">
                                    <thead>
                                        <tr>
                                            <th><b>Nombre</b></th>
                                            <th width="20" class="text-center" ><b>Acción</b></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            if(count($this->$modulo->result["RSS"])>0){
                                                foreach($this->$modulo->result["RSS"] as $v){
                                                    
                                        ?>
                                                    <tr>
                                                        <td>
                                                            <?php print_r($v->primer_nombre);?>
                                                        </td>
                                                        <td  class="text-center" >
                                                        <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                                                <a <?php if(!get_rel_plataforma($v->user_id)){ echo 'href="'.base_url("Usuarios/ActivarPlataforma/".$v->user_id.'/1/rss').'"';}else{echo 'href="'.base_url("Usuarios/ActivarPlataforma/".$v->user_id.'/0/rss').'"';}?> title="<?php if(get_rel_plataforma($v->user_id)){echo 'Desactivar';}else{echo 'Activar';}?> Plataforma al Centro de costos" >
                                                                    <?php if(get_rel_plataforma($v->user_id)){?>
                                                                        <i class="fas fa-times" aria-hidden="true"></i>
                                                                    <?php }else{ ?>
                                                                        <i class="fas fa-check" aria-hidden="true"></i>
                                                                    <?php } ?>
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
        </div>
    </div>
</div>
