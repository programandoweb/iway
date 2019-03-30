<?php
	$modulo	=	$this->ModuloActivo;
	$general	=	@$this->$modulo->result['trm_general'];
	$Trm_cierre	=	@$this->$modulo->result['trm_cierre'];
?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
       	 	<?php 
				echo TaskBar(array("name"		=>	array(	"title"	=>	"TRM Histórico.",
															"icono"	=>	'<i class="fas fa-users"></i>',
															"url"	=>	current_url()),
                                                            "pdf"   =>  true,
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
                                <a class="nav-link active" id="item1-tab" data-toggle="tab" href="#item1" role="tab" aria-controls="item" aria-expanded="false">Actual</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="item3-tab" data-toggle="tab" href="#item2" role="tab" aria-controls="item" aria-expanded="false">General</a>
                            </li>
						</ul>
                        <div class="tab-content" id="myTabContent">
                          	<div role="tabpanel" class="tab-pane fade active show" id="item1" aria-labelledby="item-tab" aria-expanded="false">
								<table class="ordenar display table table-hover">
			                        <thead>
			                            <th>Fecha</th>
			                            <th style="50" class="text-right">TRM</th>
			                        </thead>
			                        <tbody>	
										<?php
										if(!empty($Trm_cierre)){ 
										foreach($Trm_cierre as $k => $v){?>
			                                <tr>
			                                	<td><?php print($v->ciclo_produccion_id)?></td>
			                                    <td class="text-right"><?php print(format($v->TRM_Liquidacion,false))?></td>
			                                </tr>
										<?php
											}
										}
										?>
			                         </tbody>
			                    </table>
							</div>
                            <div role="tabpanel" class="tab-pane fade" id="item2" aria-labelledby="item-tab" aria-expanded="false"> 
								<table class="ordenar display table table-hover">
			                        <thead>
			                            <th>Fecha</th>
			                            <th style="50" class="text-right">TRM</th>
			                        </thead>
			                        <tbody>	
										<?php
										if(!empty($Trm_cierre)){ 
											foreach($general as $k => $v){?>
				                                <tr>
				                                	<td><?php print($v->fecha)?></td>
				                                    <td class="text-right"><?php print(format($v->monto,false))?></td>
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
        </div>
    </div>
</div>