<?php

$modulo		=	$this->ModuloActivo;
//pre($this->$modulo->result);
?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
        	<?php 
				echo TaskBar(array("name"		=>	array(	"title"	=>	$this->uri->segment(3).".",
															"url"	=>	current_url()),
									"add"		=>	array(	"title"	=>	"Agregar ".$this->uri->segment(3),
															"url"	=>	base_url($this->uri->segment(1)."/Add_Todos/".$this->uri->segment(3)),
															"lightbox"=>true),						
							)
						);
			?>
            <div class="row">
            	<div class="col-md-12">
					<ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#activos" role="tab" style="margin:0px,padding:0px">
                                <i class="fas fa-angle-right"></i> Activos 
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#inactivos" role="tab">
                               <i class="fas fa-angle-right"></i>  Inactivos 
                            </a>
                        </li>
                    </ul>
                    <?php //pre($this->$modulo->result);?>
                    <div class="tab-content row">
    					<div class="tab-pane active col-md-12" id="activos" role="tabpanel">
                        	<table class="ordenar display table table-hover" ordercol=3 order="desc">
                                <thead>
                                    <tr>
                                       <th>Nombre</th>
                                       <th width="150" class="text-center">Tipo de Página</th>
                                       <th width="150" class="text-center">Moneda de Pago</th>
                                       <th width="150" class="text-right">Equivalencia</th>
                                       <th width="60" class="text-center">Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if(count($this->$modulo->result[1])>0){
                                            foreach($this->$modulo->result[1] as $v){
                                                echo '<tr>';	
                                                    foreach($v as $kk=>$vv){
                                                        if($kk=='edit' || $kk=="CASE estado WHEN estado=1 THEN 'Activo' ELSE 'Inactivo' END"){
                                                            $class	=	'class="text-center" width="20"';	
                                                        }else if($kk=='primer_nombre'){
															$class	=	'class="text-left"';
														}else if($kk=='CONCAT(t1.equivalencia)'){
															$class	=	'class="text-right"';
														}else{
                                                            $class	=	'class="text-center"';
                                                        }
                                                        if(($kk != "CASE WHEN t1.estado=1 THEN 'Activo' ELSE 'Inactivo' END") && ($kk != "user_id")){
                                                            echo '<td '.$class.' style="vertical-align:middle;">';
                                                                if($kk == "edit"){
                                                                    echo '<div class="btn-group btn-group-sm mr-1" role="group" aria-label="Small button group">
                                                                            <a href="" title="Ver Usuario">
                                                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                                                            </a>
                                                                        </div>';
                                                                }
                                                                echo $vv;
                                                            echo '</td>';
                                                        }
                                                    }
                                                echo '</tr>';	
                                            }
                                        }else{
                                    ?>
                                       
                                    <?php		
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-12 tab-pane" id="inactivos" role="tabpanel">
                            <table class="ordenar display table table-hover" ordercol=3 order="desc">
                                <thead>
                                    <tr>
                                      	<th>Nombre</th>
                                       <th width="150" class="text-center">Tipo de Página</th>
                                       <th width="150" class="text-center">Moneda de Pago</th>
                                       <th width="150" class="text-right">Equivalencia</th>
                                       <th width="60" class="text-center">Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if(count($this->$modulo->result[0])>0){
                                            foreach($this->$modulo->result[0] as $v){
                                                echo '<tr>';	
                                                    foreach($v as $kk=>$vv){
                                                        if($kk=='edit' || $kk=="CASE estado WHEN estado=1 THEN 'Activo' ELSE 'Inactivo' END"){
                                                            $class	=	'class="text-center" width="20"';	
                                                        }else if($kk=='primer_nombre'){
															$class	=	'class="text-left"';
														}else if($kk=='CONCAT(t1.equivalencia)'){
															$class	=	'class="text-right"';
														}else{
                                                            $class	=	'class="text-center"';
                                                        }
                                                        if(($kk != "CASE WHEN t1.estado=1 THEN 'Activo' ELSE 'Inactivo' END") && ($kk != "user_id")){
                                                            echo '<td '.$class.' style="vertical-align:middle;">';
                                                                if($kk == "edit"){
                                                                    echo '<div class="btn-group btn-group-sm mr-1" role="group" aria-label="Small button group">
                                                                            <a href="" title="Ver Usuario">
                                                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                                                            </a>
                                                                        </div>';
                                                                }
                                                                echo $vv;
                                                            echo '</td>';
                                                        }
                                                    }
                                                echo '</tr>';	
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
