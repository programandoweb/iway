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
				echo TaskBar(array("name"		=>	array(	"title"	=>	"Resumen Seguridad Social.",
															"icono"	=>	'<i class="fas fa-users"></i>',
															"url"	=>	current_url()),
                                                            "pdf"   => true,
                                                            "excel"     =>  true,
                                                            "mail"      =>  array(  "id"    =>  "mail" ),
							)
						);
			?>

            <div class="row">
                <div class="col-md-12">
                    <div class="bd-example bd-example-tabs" role="tabpanel">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="Modelos-tab" data-toggle="tab" href="#modelos" role="tab" aria-controls="home" aria-expanded="false">Modelos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " id="Administrativos-tab" data-toggle="tab" href="#administrativos" role="tab" aria-controls="profile" aria-expanded="true">Administrativos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " id="profile-tab" data-toggle="tab" href="#monitores" role="tab" aria-controls="profile" aria-expanded="true">Monitores</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div role="tabpanel" class="tab-pane fade active show" id="modelos" aria-labelledby="home-tab" aria-expanded="false">
                                <table class="table table-hover ordenar">
                                    <thead>
                                        <tr>
                                            <th width="50"><b>Sucursal</b></th>
                                            <th class="text-left" width="75%"><b>Nombre</b></th>
                                            <th class="text-left" ><b>Seguridad Social</b></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            if(count($this->$modulo->result['Modelos'])>0){
                                                foreach($this->$modulo->result['Modelos'] as $v){
                                                    
                                        ?>
                                                    <tr>
                                                        <td class="text-center" style="vertical-align:middle">
                                                            <?php print_r($v->abreviacion);?>
                                                        </td>
                                                        <td class="text-left" style="vertical-align:middle">
                                                            <?php print_r(nombre($v));?>
                                                        </td>
                                                        <td class="text-left">
                                                        	<?php if(!empty($v->eps)){?>
	                                                        	<div> Eps: <b><?php echo $v->eps;?></b></div>
                                                            <?php }?>
                                                            <?php if(!empty($v->caja_de_compensacion)){?>
                                                            <div>
                                                            	Caja Comp:<b><?php echo $v->caja_de_compensacion;?></b>
                                                            </div>
                                                            <?php }?>
                                                            <?php if(!empty($v->pension)){?>
                                                            <div>
                                                            	Pensión: <b><?php echo $v->pension;?></b>
                                                            </div>
                                                            <?php }?>
                                                            <?php if(!empty($v->arl)){?>
                                                            <div>
                                                            	Arl: <b><?php echo $v->arl;?></b>
                                                            </div>
                                                            <?php }?>
															                                                            
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
                            <div class="tab-pane fade " id="administrativos" role="tabpanel" aria-labelledby="profile-tab" aria-expanded="true">
                            	<table class="table table-hover ordenar">
                                    <thead>
                                        <tr>
                                             <th width="50"><b>Sucursal</b></th>
                                            <th class="text-left" width="75%"><b>Nombre</b></th>
                                            <th class="text-left" ><b>Seguridad Social</b></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            if(count($this->$modulo->result['Administrativos'])>0){
                                                foreach($this->$modulo->result['Administrativos'] as $v){
                                                    
                                        ?>
                                                    <tr>
                                                        <td class="text-center" style="vertical-align:middle">
                                                            <?php print_r($v->abreviacion);?>
                                                        </td>
                                                        <td class="text-left" style="vertical-align:middle">
                                                            <?php print_r(nombre($v));?>
                                                        </td>
                                                        <td class="text-left">
                                                        	<?php if(!empty($v->eps)){?>
	                                                        	<div> Eps: <b><?php echo $v->eps;?></b></div>
                                                            <?php }?>
                                                            <?php if(!empty($v->caja_de_compensacion)){?>
                                                            <div>
                                                            	Caja Comp:<b><?php echo $v->caja_de_compensacion;?></b>
                                                            </div>
                                                            <?php }?>
                                                            <?php if(!empty($v->pension)){?>
                                                            <div>
                                                            	Pensión: <b><?php echo $v->pension;?></b>
                                                            </div>
                                                            <?php }?>
                                                            <?php if(!empty($v->arl)){?>
                                                            <div>
                                                            	Arl: <b><?php echo $v->arl;?></b>
                                                            </div>
                                                            <?php }?>
															                                                            
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
                            <div class="tab-pane fade " id="monitores" role="tabpanel" aria-labelledby="profile-tab" aria-expanded="true">
                                <table class="table table-hover ordenar">
                                    <thead>
                                        <tr>
                                             <th width="50"><b>Sucursal</b></th>
                                            <th class="text-left" width="75%"><b>Nombre</b></th>
                                            <th class="text-left" ><b>Seguridad Social</b></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
											 if(isset($this->$modulo->result['Monitores'])){
                                                foreach($this->$modulo->result['Monitores'] as $v){                                                    
                                        ?>
                                                    <tr>
                                                        <td class="text-center" style="vertical-align:middle">
                                                            <?php print_r($v->abreviacion);?>
                                                        </td>
                                                        <td class="text-left" style="vertical-align:middle">
                                                            <?php print_r(nombre($v));?>
                                                        </td>
                                                        <td class="text-left">
                                                        	<?php if(!empty($v->eps)){?>
	                                                        	<div> Eps: <b><?php echo $v->eps;?></b></div>
                                                            <?php }?>
                                                            <?php if(!empty($v->caja_de_compensacion)){?>
                                                            <div>
                                                            	Caja Comp:<b><?php echo $v->caja_de_compensacion;?></b>
                                                            </div>
                                                            <?php }?>
                                                            <?php if(!empty($v->pension)){?>
                                                            <div>
                                                            	Pensión: <b><?php echo $v->pension;?></b>
                                                            </div>
                                                            <?php }?>
                                                            <?php if(!empty($v->arl)){?>
                                                            <div>
                                                            	Arl: <b><?php echo $v->arl;?></b>
                                                            </div>
                                                            <?php }?>
															                                                            
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
