<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/?>
<?php
	if(!@$this->user->id_empresa){
?>	
		<h3 class="text-center">Seleccione un Centro de Costos</h3>
<?php		
		return;	
	}		
	$modulo		=	$this->ModuloActivo;
	$row		=	$this->$modulo->result;
	
?>
<div class="container" style="margin-bottom:100px;" id="imprimeme">
	<div class="row justify-content-md-center">
    			<?php 
					if($this->$modulo->result[0]->estatus==9){
				?>
                    <div class="container text-center" id="pagado">
                        <h2 class="font-weight-700 text-uppercase orange">
	                        Anulado    
                        </h2>
                    </div>
                <?php		
					}
				?>	
    
    	<div class="col">
			<?php 
				if($this->$modulo->result[0]->estatus==9){
					echo TaskBar(array("name"		=>	array(	"title"	=>	"Comprobante bancario",
																"url"	=>	current_url()),
																"back"		=>	($this->uri->segment(6)=='iframe')?true:false,
										"pdf"		=>	array(  "url"   => 	current_url().'/PDF'),
	
						)
					);
				}else{
					echo TaskBar(array("name"		=>	array(	"title"	=>	"Comprobante bancario",
																"url"	=>	current_url()),
										"back"		=>	($this->uri->segment(6)=='iframe')?true:false,						
										"anular"	=>	array(	"title"	=>	"Anular Pagos",
																"confirm"=>true,
																"url"	=>	site_url($this->uri->segment(1).'/'.$this->uri->segment(2).'/'.$this->uri->segment(3).'/anular_detalle_contable/'.$this->uri->segment(5)),
																"icono"	=>	'<i class="fas fa-trash-alt"></i>'),															
										"pdf"		=>	array(  "url"   => 	current_url().'/PDF'),
	
						)
					);
				}
            ?>
        	<div class="row">
            	<div class="col-md-2">
		           	Cliente
                   	<br />
		         	ID Cliente
                </div>
                <div class="col-md-4">
                    <b>
	                    <?php 
							
							echo $this->$modulo->factura->nombre_cliente;
						?>
                    </b>
                    <br />
                    <b>
	                    <?php echo $this->$modulo->factura->Nit;?>
                    </b>
                </div>
                <div class="col-md-3">
                	Comprobante bancario
                	<br />
                	Fecha
                </div>
                <div class="col-md-3 text-right">
                	<b>
                	<?php 
						//pre($this->$modulo->factura->abreviacion);			
						echo $this->$modulo->factura->abreviacion.' BR '.$this->uri->segment(3);
					?>
                	</b>
	                <br />
                	<b><?php echo $row[0]->fecha;?></b>                	
                </div>
            </div>
            <div class="row">
            	<div class="col-md-2">
		           Dirección
                </div>
                <div class="col-md-4">
                    <b>
	                    <?php echo str_replace($this->$modulo->factura->Pais,"",$this->$modulo->factura->Direccion)?>
                    </b>
                </div>
                <div class="col-md-3 ">
		           Ciclo de producción
                </div>
                <div class="col-md-3 text-right">
	                <b>
						<?php echo $this->$modulo->factura->ciclo_de_produccion?>
                   	</b>
                </div>
            </div>
		</div>
	</div> 
    <div style=" width:100%; height:20px;"></div>
    	<div class="bd-example bd-example-tabs" role="tabpanel">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#Detalle" role="tab" style="margin:0px,padding:0px">
                        Detalle de Ingreso 
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#registro" role="tab">
                        Registro Contable
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="observaciones-tab" data-toggle="tab" href="#observaciones" role="tab" aria-controls="observaciones" aria-expanded="true">Observaciones</a>
                </li>
            </ul>
            <div class="tab-content col-md-12 ">
                <div id="Detalle" class="tab-pane active row justify-content-md-center" role="tabpanel">
                    <div class="col-md-12">
                        <table class="tablesorter table table-hover">
                            <thead>
                                <tr>
                                    <th ><b>Concepto</b></th>
                                    <th class="text-center"><b>Procesador</b></th>
                                    <th width="100" class="text-center"><b>Documento</b></th>
                                    <th width="100" class="text-center"><b>Monto</b></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $sum	=	0;
                                    //pre($this->$modulo->result);
                                    foreach($this->$modulo->result['detalle_ingreso'] as $k=>$v){
                                ?>
                                    <tr>
                                        <td>
                                            Cancelación / Abono Factura de Ventas
                                            <b><?php print(entidadbancaria($v->entidad_bancaria));?></b>
                                        </td>
                                        <td class="text-center">
                                            <?php
                                                print($v->nro_cuenta);
                                            ?>
                                        </td>
                                        <td  class="text-center">
                                            <a class="documentos" href="<?php echo base_url('Reportes/VerFactura/'.$this->$modulo->factura->consecutivo.'/sinmarco');?>">
                                                <?php print_r($this->$modulo->factura->consecutivo);?>
                                               
                                            </a>
                                        </td>
                                        <td  class="text-right creditos" ><?php print(format($v->debito,true));$sum+=$v->debito;?></td>
                                    </tr>                   
                                <?php }?>
                            </tbody>
                            <tfoot>
                                <th></th>
                                <th></th>
                                <th class="text-center">Total</th>
                                <th class="text-right"><?php echo format($sum,true);?></th>
                            </tfoot>  
                        </table> 
                    </div>    
                </div> 
                <div class="tab-pane row justify-content-md-center" role="tabpanel" id="registro">
                    <div class="col-md-12">
                        <table class="tablesorter table table-hover">
                            <thead>
                                <tr>
                                    <th width="100"><b>Cuenta</b></th>
                                    <th><b>Concepto Contable</b></th>
                                    <th class="text-center"><b>Moneda</b></th>
                                    <th class="text-center"><b>Procesador</b></th>
                                    <th width="100" class="text-center"><b>Débito</b></th>
                                    <th width="100" class="text-center"><b>Crédito</b></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $debito		=	0;
                                    $credito	=	0;
                                    $items		=	items_factura_contable($this->uri->segment(5),array("414580","130510"),array("tipo_documento"=>5),true);
                                    $sum1		=		$sum2		=	0;
                                    foreach($this->$modulo->result['registro_contable'] as $k=>$v){
                                        
                                ?>                       
                                    <tr>
                                        <td>
                                            <?php
                                                print($v->codigo_contable);
                                            ?>
                                        </td>
                                        <td>
                                            <?php 
                                                print(get_codigo_contable($v->codigo_contable)->cuenta_contable);
                                            ?>
                                        </td>
                                         <td class="text-center">
                                            <?php 
                                                //print(entidadbancaria($v->entidad_bancaria));                                            
                                                //echo entidad_bancaria($v);
                                                //pre($v);
                                            ?>
                                            USD
                                        </td>
                                        <td class="text-center">
                                            <?php
                                                print($v->nro_cuenta);
                                            ?>
                                        </td>
                                        <td class="text-right">
                                            <?php
                                                    $debito +=	@$v->debito;
                                                    print(format(@$v->debito,true));
                                                    $sum1	+=	@$v->debito;
                                            ?>
                                        </td>
                                        <td  class="text-right">
                                            <?php
                                                    $credito +=$v->credito;
                                                    print(format($v->credito,true));
                                                    $sum2	+=	@$v->credito;
                                            ?>
                                        </td>
                                    </tr>
                                <?php }?>
                            </tbody> 
                            <tfoot>
                                <th></th>
                                <th></th>
                                <th></th>                            
                                <th class="text-center">Sumas iguales</th>
                                <th class="text-right"><?php echo format($sum1,true);?></th>
                                <th class="text-right"><?php echo format($sum2,true);?></th>
                            </tfoot> 
                            <input type="hidden" id="credito" value="<?php echo format($credito,true);?>" />                    
                        </table> 
                    </div>    
                </div>
                <div class="tab-pane fade" id="observaciones" role="tabpanel" aria-labelledby="movimientos-tab" aria-expanded="true">
                    <div class="col-md-12">
                        <div style=" width:100%; height:20px;"></div>
                        <?php 
                            HtmlObservaciones();
                        ?>
                    </div>
                </div>
			</div>                
    	</div>
  	</div> 
</div>
<script>
	$(document).ready(function(){
		//$(".creditos").html($("#credito").val());
		$(".recibir").remove();
	});
</script>