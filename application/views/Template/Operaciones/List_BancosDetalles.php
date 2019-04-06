<?php
	$modulo		=	$this->ModuloActivo;
	if($this->user->type=='Modelos'){
		return;	
	}
    //pre($this->$modulo->result);
?>
<div class="container" id="factura">
    <div class="row filters">
                <div class="col-md-12">
                	<?php 
						if($this->uri->segment(4)=='111010'){
							echo TaskBar(array("name"       =>  array(  "title" =>  "Bancos del Exterior",
																		"url"   =>  current_url()),
																		"impresion" =>  true,
																		"pdf"       =>  array(  "title" =>  "PDF",
                                                                         "icono" =>  '<i class="fas fa-file-pdf"></i>',
                                                                            "url"   =>  current_url().'/PDF'), 

								)
							);
						}else{
							echo TaskBar(array("name"       =>  array(  "title" =>  "Bancos Nacionales",
																		"url"   =>  current_url()),
																		"impresion" =>  true,
																		"pdf"       =>  array(  "title" =>  "PDF",
                                                                            "icono" =>  '<i class="fas fa-file-pdf"></i>',
                                                                            "url"   =>  current_url().'/PDF'), 
								)
							);
						}
					?>
                </div>
            </div>
            <div style="height: 50px"></div>
	<div class="row justify-content-md-center" id="imprimeme">
        <div class="col-md-12">
            <table class="ordenar display table table-hover" data-url="<?php echo current_url()?>" ordercol="0" order="asc">
                <thead>
                    <tr>
                        <th class="text-left">Fecha</th>
                        <th class="text-left">Tipo Documento</th>
                        <th class="text-center">Documento</th>
                        <th class="text-right">Debito</th>
                        <th class="text-right">Crédito</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $rows = $this->$modulo->result;
                        //$pagos_honorarios = getMovimientosGeneral(NULL,NULL,14,$this->uri->segment(4));
                        //$array_result = array_merge($rows,$pagos_honorarios);
                        if(count($rows)>0){
							$debito		=	0;
							$credito	=	0;
                            foreach($rows as $v){
                    ?>
                    <tr>
                        <td><?php echo $v->fecha ?></td>
                        <td><?php echo tipo_documento($v->tipo_documento); ?></td>
                        <td class="text-center">
	                        <?php 
								if($v->tipo_documento=='5'){
							?>	
                                <a <?php echo ($this->uri->segment(8) !='iframe' && $this->uri->segment(7) !='iframe' )? 'class="nav-link vin lightbox" data-type="iframe"':'class="nav-link vin"';?> title="Comprobante bancario No. <?php echo $v->consecutivo;?>" href="<?php echo base_url('Reportes/VerFactura/'.$v->consecutivo.'/detalle_contable/'.$v->nro_documento.'/iframe');?>">
                                    <?php echo $v->consecutivo ?>
                                </a>
                            <?php }else if($v->tipo_documento=='6'){
							?>
                            	<a <?php echo ($this->uri->segment(8) !='iframe' && $this->uri->segment(7) !='iframe')? 'class="nav-link vin lightbox" data-type="iframe"':'class="nav-link vin"';?>  title="Comprobante bancario No. <?php echo $v->consecutivo;?>"  href="<?php echo base_url("Operaciones/RetirosTRMDetalles/".$v->consecutivo.'/iframe'); ?>">
									<?php echo $v->consecutivo; ?>
                                </a>   
                            <?php    
							}else if($v->tipo_documento=='10'){
							?>
                            	<a <?php echo ($this->uri->segment(8) !='iframe' && $this->uri->segment(7) !='iframe')? 'class="nav-link vin lightbox" data-type="iframe"':'class="nav-link vin"';?> title="Comprobante bancario No. <?php echo $v->consecutivo;?>" href="<?php echo base_url('Operaciones/RetirosTRMDetallesContable/'.$v->consecutivo.'/iframe');?>">
									<?php echo $v->consecutivo ?>
    	                        </a>
                            <?php	
							}else if($v->tipo_documento=='11'){
                            ?>
                                <a <?php echo ($this->uri->segment(8) !='iframe' && $this->uri->segment(7) !='iframe')? 'class="nav-link vin lightbox" data-type="iframe"':'class="nav-link vin"';?> title="Comprobante Transferencia No. <?php echo $v->consecutivo;?>" href="<?php echo base_url('Operaciones/Transferencia/'.$v->consecutivo.'/iframe');?>">
                            <?php
								echo $v->consecutivo;
							}else{
                            ?>
                            <a href="<?php echo base_url("Operaciones/transferencia_nacionales/".$v->nro_documento."/".$v->consecutivo."/".$v->tipo_documento."/iframe")?>" class="vin" title="Detalle de Procesador" >
                            <?php    echo $v->consecutivo;
                            ?>

                                </a>
                            <?php
                            }
								if($this->uri->segment(5)==10){
									$v->debito=$v->credito_nacional;	
								
								}
							?>
						</td>
                         <td class="text-right">
                            <?php
                                if(empty($v->debito)){
                                    echo format($v->debito_nacional,true); $debito+=$v->debito_nacional; 
                                }else{
                                    echo format($v->debito,true); $debito+=$v->debito;
                                }  
                            ?>   
                        </td>
                        <td class="text-right">
                            <?php
                                echo format(@$v->credito_nacional,true); $credito+=@$v->credito_nacional;  
                            ?>    
                        </td>
                    </tr>
                    <?php
                        }
                    }
                     ?>
                </tbody>
                <tfoot>
                	<tr>
                    	<th></th>
                        <th></th>
                        <th class="text-right">Total:</th>
                        
                        <th class="text-right"><?php echo format(@$debito,true);?></th>
                        <th class="text-right"><?php echo format(@$credito,true);?></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
<script>
	$(document).ready(function(){
		var	credito						=	parseFloat($("#credito").val()).toFixed(2);
		var	credito_cuenta_contable		=	parseFloat($("#credito_cuenta_contable").val()).toFixed(2);
		if(credito == credito_cuenta_contable){
			//console.log(credito + ' CREDITO');
			//console.log(credito_cuenta_contable + 'CONTABLE');
			$("#pagado").html('<h2 class="font-weight-700 text-uppercase orange">PAGADO</h2>');
			$(".recibir").remove();
			$(".anular").remove();	
		}
	});
</script>