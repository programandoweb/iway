<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/
$modulo	= $this->ModuloActivo;
?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
        	<?php 
				echo TaskBar(array("name"		=>	array(	"title"	=>	"Cajas.",
															"url"	=>	current_url()),
									"add"		=>	array(	"title"	=>	"Agregar Cajas.",
															"url"	=>	base_url($this->uri->segment(1)."/Add_Cajas"),
                                                            "lightbox"=>true),	
							)
						);
			?>
            <div class="row">
            	<div class="col-md-12">
                    <div class="bd-example bd-example-tabs" role="tabpanel">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="nacionales-tab" data-toggle="tab" href="#nacionales" role="tab" aria-controls="nacionales" aria-expanded="true">Activas</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " id="internacionales-tab" data-toggle="tab" href="#internacionales" role="tab" aria-controls="internacionales" aria-expanded="false">Inactivas</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div role="tabpanel" class="tab-pane fade active show" id="nacionales" aria-labelledby="nacionales-tab" aria-expanded="false">
                                <table class="table table-hover ordenar">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th class="text-center">Saldo</th>
                                            <th class="text-center">Tipo de caja</th>
                                            <th class="text-right" width="20">Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            if(count(ResumenCajas(array('110510','110505'),array("6","14"),1))>0){ 
                                                foreach(ResumenCajas(array('110510','110505'),array("6","14"),1)  as $k => $v){
                                                    /*setSubfijoContable('fi_cajas',$v->codigo_contable,$extra=array("id_caja"=>$v->id_caja));*/
                                                   
                                                    if($v->total_COP != 0){
                                                        $accion = 1;
                                                    }else{
                                                        $accion = 0;
                                                    }
                                        ?>
                                                  
                                                   
                                                    <tr>
                                                        <td class="text-left" style="vertical-align:middle">
                                                            <?php print_r($v->real_nombre_caja);?> (<?php echo $v->codigo_contable_subfijo; ?>)
                                                        </td>
                                                        <td class="text-center">
                                                           <?php echo format($v->total_COP,false); ?> 
                                                        </td>
                                                        <td class="text-center">
                                                        <?php 
                                                            if ($v->codigo_contable=='110505'){
                                                                echo 'Caja principal';
                                                            }else{
                                                                echo $v->tipo_caja;
                                                            }
                                                         ?>
                                                        </td>
                                                        <td class="text-center" style="vertical-align:middle" max-width="20">
                                                            <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                                                <a class="lightbox" title="Editar Caja" data-type="iframe" href="<?php echo base_url($this->uri->segment(1).'/Add_Cajas/'.$accion.'/'.$v->id_caja); ?>">
                                                                        <i class="fas fa-edit" aria-hidden="true"></i>
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
                            <div role="tabpanel" class="tab-pane fade " id="internacionales" aria-labelledby="internacionales-tab" aria-expanded="false">
                                <table class="table table-hover ordenar">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th class="text-center">Saldo</th>
                                            <th class="text-center">Tipo de caja</th>
                                            <th class="text-right" width="20">Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            if(count(ResumenCajas(array('110510','110505'),array("6","14"),0))>0){ 
                                                foreach(ResumenCajas(array('110510','110505'),array("6","14"),0)  as $k1 => $v1){
                                                    /*setSubfijoContable('fi_cajas',$v1->codigo_contable,$extra=array("id_caja"=>$v1->id_caja));*/
                                                    if($v1->total_COP != 0){
                                                        $accion = 1;
                                                    }else{
                                                        $accion = 0;
                                                    }
                                        ?>
                                                    <tr>
                                                        <td class="text-left" style="vertical-align:middle">
                                                            <?php print_r($v1->real_nombre_caja);?> (<?php echo $v1->codigo_contable_subfijo; ?>)
                                                        </td>
                                                        <td class="text-center">
                                                           <?php echo format($v1->total_COP,false); ?> 
                                                        </td>
                                                        <td class="text-center">
                                                            <?php 
                                                            if ($v1->codigo_contable=='110505'){
                                                                echo 'Caja principal';
                                                            }else{
                                                                echo $v1->tipo_caja;
                                                            }
                                                         ?>
                                                        </td>
                                                        <td class="text-center" style="vertical-align:middle" width="20">
                                                            <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                                                <a class="lightbox" title="Editar Caja" data-type="iframe" href="<?php echo base_url($this->uri->segment(1).'/Add_Cajas/'.$accion.'/'.$v1->id_caja); ?>">
                                                                        <i class="fas fa-edit" aria-hidden="true"></i>
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
