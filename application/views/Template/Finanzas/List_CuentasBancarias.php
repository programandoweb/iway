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
				echo TaskBar(array("name"		=>	array(	"title"	=>	"Cuentas Bancarias.",
															"url"	=>	current_url()),
									"add"		=>	array(	"title"	=>	"Cuentas Bancarias.",
															"url"	=>	base_url($this->uri->segment(1)."/Add_CuentasBancarias"),
															"lightbox"=>true),	
							)
                        );
                        
			?>
            <div class="row">
            	<div class="col-md-12">
	                <div class="bd-example bd-example-tabs" role="tabpanel">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                                <a class="nav-link active" id="internacionales-tab" data-toggle="tab" href="#internacionales" role="tab" aria-controls="internacionales" aria-expanded="true">Activas</a>
                            </li> 
                            
                            <li class="nav-item">
                                <a class="nav-link " id="nacionales-tab" data-toggle="tab" href="#nacionales" role="tab" aria-controls="nacionales" aria-expanded="false">Inactivas</a>
                            </li>
                            
                        </ul>
					</div> 
                    <div class="tab-content" id="myTabContent">
                    	<div role="tabpanel" class="tab-pane fade" id="nacionales" aria-labelledby="nacionales-tab" aria-expanded="false">                           
                            <table class="table table-hover ordenar">
                                <thead>
                                    <tr>
                                        <th>Titular</th>
                                        <th>Datos de la Cuenta</th>
                                        <th width="60" class="text-center">Estado</th>
                                        <th class="text-right" width="20">Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        if(count($this->$modulo->result["inactivos"])>0){ 
                                            foreach($this->$modulo->result["inactivos"] as $k => $v){
												setSubfijoContable('fi_cuentas',$v->codigo_contable,array("id_cuenta"=>$v->id_cuenta));
                                                $campo	=	"CONCAT('<B>',Entidad,'</B><BR>',titular)";
                                    ?>
                                                <tr>
                                                    <td class="text-left" style="vertical-align:middle">
                                                    	<?php 
															echo $v->$campo;
														?>
                                                    </td>
                                                    <td class="text-left" style="vertical-align:middle">
                                                        <?php 
                                                            $campo	=	"CONCAT(tipo_cuenta,'<BR>',tipo_monedas,'<BR>',modo_cuenta,'<BR>',nro_cuenta)";
                                                            echo $v->$campo;
                                                        ?>
                                                    </td>
                                                    <td class="text-center" style="vertical-align: middle">
                                                        <?php $campo="CASE WHEN t1.estado=1 THEN 'Activo' ELSE 'Inactivo' END";print($v->$campo);?>
                                                    </td>
                                                    <td class="text-center" style="vertical-align:middle">
                                                        <?php print($v->edit);?>
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
                        <div role="tabpanel" class="tab-pane fade active show" id="internacionales" aria-labelledby="internacionales-tab" aria-expanded="false">
                    		<table class="table table-hover ordenar">
                                <thead>
                                    <tr>
                                        <th>Titular</th>
                                        <th>Datos de la Cuenta</th>
                                        <th width="60" class="text-center">Estado</th>
                                        <th class="text-right" width="20">Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        if(count($this->$modulo->result["activos"])>0){ 
                                            foreach($this->$modulo->result["activos"] as $k => $v){
                                                $campo	=	"CONCAT('<B>',Entidad,'</B><BR>',titular)";
                                    ?>
                                                <tr>
                                                    <td class="text-left" style="vertical-align:middle">
                                                        <?php echo $v->$campo;
															//pre($v);
															setSubfijoContable('fi_cuentas',$v->codigo_contable,array("id_cuenta"=>$v->id_cuenta));
														?>
                                                    </td>
                                                    <td class="text-left" style="vertical-align:middle">
                                                        <?php 
                                                            $campo	=	"CONCAT(tipo_cuenta,'<BR>',tipo_monedas,'<BR>',modo_cuenta,'<BR>',nro_cuenta)";
                                                            echo $v->$campo;
                                                        ?>
                                                    </td>
                                                    <td class="text-center" style="vertical-align: middle">
                                                        <?php $campo="CASE WHEN t1.estado=1 THEN 'Activo' ELSE 'Inactivo' END";print($v->$campo);?>
                                                    </td>
                                                    <td class="text-center" style="vertical-align:middle">
                                                        <?php print($v->edit);?>
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
