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
		            <h4 class="font-weight-700 text-uppercase orange"> Bancos.</h4>
                </div>
           	</div>
            <div class="row">
	            <div class="col-md-12">
                	<div class="bd-example bd-example-tabs" role="tabpanel">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link " id="nacionales-tab" data-toggle="tab" href="#nacionales" role="tab" aria-controls="nacionales" aria-expanded="false">Nacionales</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" id="internacionales-tab" data-toggle="tab" href="#internacionales" role="tab" aria-controls="internacionales" aria-expanded="true">Exterior</a>
                            </li>
                        </ul>
					</div> 
                    <div class="tab-content" id="myTabContent">
                    	<div role="tabpanel" class="tab-pane fade" id="nacionales" aria-labelledby="nacionales-tab" aria-expanded="false">                           
                            <table class="ordenar display table table-hover" data-url="<?php echo current_url()?>">
                                <thead>
                                    <tr>
                                        <th>Cuentas Bancarias</th>
                                        <th width="220" class="text-center">Tipo de Cuenta</th>
                                        <th width="150" class="text-right">Saldo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
										$sum=0;
                                        if(count($this->$modulo->result['Nacionales'])>0){
                                            foreach($this->$modulo->result['Nacionales'] as $v){
                                    ?>
                                                <tr>
                                                    <td><?php print($v->entidad_bancaria);?> (<b><?php print($v->nro_cuenta);?></b>)</td>
                                                    <td class="text-center">
                                                        <?php print($v->tipo_cuenta);?>
                                                        <?php //pre($v);?>
                                                    </td>
                                                    <td class="text-right">
                                                    	<a href="<?php echo base_url("Operaciones/BancosDetallesContable/".$v->id_cuenta)?>" class="lightbox" data-type="iframe" title="Detalle de Procesador <?php print($v->entidad_bancaria);?> (<b><?php print($v->nro_cuenta);?></b>)" >
															<?php $sum+=$v->total; print(format($v->total,true));?>
                                                        </a>
                                                    </td>
                                                </tr>
                                    <?php			
                                            }
                                        }else{
									?>
                                    	<tr>
                                        	<td colspan="3" class="text-center">
                                            	No existen Registros
                                            </td>
                                        </tr>
                                    <?php		
										}
                                    ?>
                                </tbody>
                                <tfoot>
                                	<tr>
                                    	<th></th>
                                        <th class="text-right">Total</th>
                                        <th class="text-right">
                                        	<?php echo format($sum,true);?>
                                        </th>
                                    </tr>
                                </tfoot>
                            </table> 
						</div>
                        <div role="tabpanel" class="tab-pane fade active show" id="internacionales" aria-labelledby="internacionales-tab" aria-expanded="false">
                        	<table class="ordenar display table table-hover" data-url="<?php echo current_url()?>">
                                <thead>
                                    <tr>
                                        <th>Cuentas Bancarias</th>
                                        <th width="220" class="text-center">Tipo de Cuenta</th>
                                        <th width="150" class="text-right">Saldo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
										$sum=0;
                                        if(count($this->$modulo->result['Exterior'])>0){
                                            foreach($this->$modulo->result['Exterior'] as $v){
                                    ?>
                                                <tr>
                                                    <td><?php print($v->entidad_bancaria);?> (<b><?php print($v->nro_cuenta);?></b>)</td>
                                                    <td class="text-center">
                                                        <?php print($v->tipo_cuenta);?>
                                                        <?php //pre($v);?>
                                                    </td>
                                                    <td class="text-right">
                                                    	<a href="<?php echo base_url("Operaciones/BancosDetallesContable/".$v->id_cuenta)?>" class="lightbox" data-type="iframe" title="Detalle de Procesador <?php print($v->entidad_bancaria);?> (<b><?php print($v->nro_cuenta);?></b>)" ><?php print(format($v->total,true));?>
                                                        	<?php $sum+=$v->total;?>
                                                        </a>
													</td>
                                                </tr>
                                    <?php			
                                            }
                                        }else{
									?>
                                    	<tr>
                                        	<td colspan="3" class="text-center">
                                            	No existen Registros
                                            </td>
                                        </tr>
                                    <?php		
										}
                                    ?>
                                </tbody>
                                <tfoot>
                                	<tr>
                                    	<th></th>
                                        <th class="text-right">Total</th>
                                        <th class="text-right">
                                        	<?php echo format($sum,true);?>
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
					</div>
    	        </div>
            </div>                
		</div>
	</div>
</div>                        