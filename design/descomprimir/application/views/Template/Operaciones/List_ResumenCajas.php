<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/
	$modulo         =   $this->ModuloActivo;
    $row            =   $this->$modulo->result;
?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
        	<div class="row filters">
            	<div class="col-md-6">
		            <h4 class="font-weight-700 text-uppercase orange"> Cajas.
                    </h4>
                </div>
           	</div>
            <div class="row">
	            <div class="col-md-12">
                    <table class="ordenar display table table-hover">
                        <thead>
                            <tr>
								<th>Descripción</th>
                                <th width="150" class="text-right">
                                	Saldo
								</th>
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
                                            	<?php print($v->nombre_caja); ?>
											</td>
                                            <td class="text-right">
                                            	<a class="lightbox" data-type="iframe" title="Detalle de Caja <?php print($v->nombre_caja); ?>" href="<?php echo base_url("Operaciones/DetallesCajas/".$v->procesador_id)?>">
													<?php print(format($v->total_COP,true)); $sum+=$v->total_COP;?>
                                                </a>
											</td>
                                        </tr>
                            <?php			
                                    }
                                }else{
                            ?>
                                <tr>
                                    <td colspan="2" class="text-center">
                                        No existen Registros
                                    </td>
                                </tr>
                            <?php		
                                }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="text-right">Total</th>
                                <th class="text-right"><?php echo format($sum,true);?></th>
                            </tr>
                        </tfoot>
                    </table> 
    	        </div>
            </div>                
		</div>
	</div>
</div>                        