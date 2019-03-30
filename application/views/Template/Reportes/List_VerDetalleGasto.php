<?php
	$modulo		=	$this->ModuloActivo;
	if($this->user->type=='Modelos'){
		return;	
	}
	$row		=	$this->$modulo->result;
    $pagado = false;
	$proveedor	=	@json_decode($row[0]->json);
    $pagos      =   @pago_gasto($this->uri->segment(3));
    $credito_pagos = 0;
    foreach ($pagos as $key => $value) {
        $credito_pagos +=$value->credito;
    }
?>
<div class="container" id="factura">
    <?php
        if(@$this->$modulo->result['registro_contable'][1]->credito == $credito_pagos){
    ?>
    <div class="container text-center">
        <h2 class="font-weight-700 text-uppercase orange">
        <input id="nuevo_estatus" type="hidden" value="Pendiente">PAGADO</h2>
    </div>
    <?php
        $pagado = true;
        }else{
    ?>
    <div class="container text-center">
        <h2 class="font-weight-700 text-uppercase orange">
        <input id="nuevo_estatus" type="hidden" value="Pendiente">PENDIENTE</h2>
    </div>
    <?php
        }
    ?>
   <div class="row justify-content-md-center">
    	<div class="col">
        	<div class="row filters">
            	<div class="col-md-12">
                    <?php   
                        $submenu = array("name"       =>  array(  "title" =>  "Detalle de Gasto.",
                                                                        "url"   =>  current_url()),
                                            "back"      =>  ($this->uri->segment($this->uri->total_segments())=='iframe')?true:false,
                                            "config"    =>  array("title" =>  "Pagar gasto",
                                            "icono"  =>  '<i class="far fa-money-bill-alt"></i>',
                                            "url"   =>  current_url().'/Pagar'),
                                            "pdf"       =>   array(  "url"   =>  current_url().'/PDF' ),
                                            "Anular"    =>  array("title" =>  "Anular monetizacion",
                                                  "icono"  =>  '<i class="fas fa-trash"></i>',
                                            "url"   =>  base_url("Reportes/VerFactura/".$this->uri->segment(3)."/anulargasto")),         
                                    );
                        if($pagado){
                            unset($submenu['config']);
                            unset($submenu['Anular']);
                        }else if($credito_pagos > 0 ){
                            unset($submenu['Anular']);
                        }
                        echo TaskBar($submenu);
                    ?> 
                </div>
            </div>
        	<div class="row">
            	<div class="col-md-2">
		           Proveedor<BR /> ID Proveedor
                </div>
                <div class="col-md-4">
                    <b>
	                    <?php 
							if(empty($row[0]->nombre_cliente)){
								print_r(nombre($row[0]));
							}else{
								echo $proveedor->nombre_legal;
								//print_r($row[0]->nombre_cliente);
							}
						?>
                        <br />
                        <?php echo $row[0]->Nit;?>
                    </b>
                </div>
                <div class="col-md-2">
                	Fecha Expedición<br />
                    Fecha Vencimiento		         	
                </div>
                <div class="col-md-4 text-right">
                	 <b>
					 <?php 
					 	/*DAVID MANDÓ A CAMBIAR*/
						echo $proveedor->fecha_emision;
					 ?>
                	<br />
					<?php
	                    echo $proveedor->fecha_vencimiento;
                    ?>
                    </b>
                </div>
            </div>
            <div class="row">
            	<div class="col-md-2">
		           Dirección
                </div>
                <div class="col-md-4">
                    <b>
	                    <?php 
							echo $proveedor->direccion; //str_replace($row[0]->Pais,"",$row[0]->Direccion)
						?>
                    </b>
                </div>
                <div class="col-md-3 ">
		           Ciclo de producción
                </div>
                <div class="col-md-3 text-right">
	                <b>
						<?php echo $row[0]->ciclo_de_produccion?>
                   	</b>
                </div>
            </div>
		</div>
	</div>
	<div style=" width:100%; height:20px;"></div>
    <div class="bd-example bd-example-tabs" role="tabpanel">
        <ul class="nav nav-tabs" role="tablist">
             <li class="nav-item">
                <a id="Detalle-tab" class="nav-link <?php echo ($this->uri->segment(4)!='Observaciones')?"active":""?>" data-toggle="tab" href="#Detalle" role="tab" style="margin:0px,padding:0px">
                    Detalle de Ingreso 
                </a>
             </li>
             <li class="nav-item">
                <a id="registro-tab" class="nav-link" data-toggle="tab" href="#registro" role="tab">
                    Registro Contable
                </a>
             </li>
             <li class="nav-item">
                <a id="registro-tab" class="nav-link" data-toggle="tab" href="#relacion" role="tab">
                    Relación pago
                </a>
             </li>
             <li class="nav-item">
                <a id="observacion-tab"  class="nav-link <?php echo ($this->uri->segment(4)=='Observaciones')?"active":""?>" data-toggle="tab" href="#observacion" role="tab">
                    Observaciones
                </a>
             </li>
        </ul>
        <div class="tab-content col-md-12">
            <div id="Detalle" class="tab-pane <?php echo ($this->uri->segment(4)!='Observaciones')?"active":""?> row justify-content-md-center" role="tabpanel">
                <div class="col-md-12">
                    <table class="<?php if(!$this->uri->segment(3)){echo 'ordenar';}?>  display table table-hover">
                        <thead>
                            <tr>
                                <th class="text-left">Concepto</th>
                                <th class="text-center">Factura</th>
                                <th class="text-center">Sucursal</th>
                                <th width="100" class="text-center">Documento</th>
                                <th width="100" class="text-right">Monto</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                if(count($this->$modulo->result)>0){
                                    
                                    $debito=0;
                                    $credito=0;
                                    foreach($this->$modulo->result as $v){
										if(!empty($v->tipo_documento)){
											$decode=json_db($v->json,"decode");
                            ?>
                                            <tr>
                                                <td>
                                                    <?php 
														foreach($decode->descripcion2 as $v2){
															if(!empty($v2)){
																print($v2.'<br>');	
															}
														}
                                                        //print(get_codigo_contable($v->codigo_contable)->cuenta_contable);
                                                    ?>
                                                </td>
                                                <td class="text-center">
	                                                <?php 
														foreach($decode->valor as $v2){
															if(!empty($v2)){
																echo $decode->nro_documento_ext.'<br/>';
															}
														}														
													?>
                                                </td>
                                                <td class="text-center">
                                                	<?php 
														foreach($decode->valor as $v2){
															if(!empty($v2)){
																echo $v->abreviacion.'<br/>';
															}
														}														
													?>
                                                </td>
                                                <td class="text-center">
                                                    <?php 
														foreach($decode->valor as $v2){
															if(!empty($v2)){
																echo $v->consecutivo.'<br/>';
															}
														}														
													?>
                                                </td>
                                                <td class="text-right">
                                                    <?php 
														foreach($decode->valor as $v2){
															if(!empty($v2)){
																echo format($v2,false).'<br/>';
																$debito			+= 	$v2; 
															}
														}
													?>
                                                </td>
                                            </tr>
                            <?php
                                        }
                                    }
                                }else{ 
                             ?>
                             
                             <?php 
                                }
                             ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="text-right"></th>
                                <th></th>
                                <th></th>
                                <th class="text-right">Subtotal:</th>
                                <th class="text-right"><?php echo format(@$debito,true); ?></th>
                            </tr>
                            <?php
                                if(!empty($this->$modulo->result['registro_contable'][2])){
                            ?>
                            <tr>
                                <td class="text-right"></td>
                                <td></td>
                                <td></td>
                                <td class="text-right">Retención:</td>
                                <td class="text-right"><?php echo format(@$this->$modulo->result['registro_contable'][2]->credito,true); ?></td>
                            </tr>
                            <?php
                                }
                            ?>
                            <tr>
                                <th class="text-right"></th>
                                <th></th>
                                <th></th>
                                <th class="text-right">Total saldo:</th>
                                <th class="text-right"><?php echo @format(($this->$modulo->result['registro_contable'][1]->credito - $credito),true); ?></th>
                            </tr>
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
                                <th width="100" class="text-center"><b>Débito</b></th>
                                <th width="100" class="text-center"><b>Crédito</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $debito		=	0;
                                $credito	=	0;
                                $items		=	items_factura_contable($this->uri->segment(3),array(),array("tipo_documento"=>8));
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
                                    <td class="text-right">
                                        <?php
                                                $debito +=	@$v->debito;
                                                print(format(@$v->debito,true));
                                        ?>
                                    </td>
                                    <td  class="text-right">
                                        <?php
                                                $credito +=$v->credito;
                                                print(format($v->credito,true));
                                        ?>
                                    </td>
                                </tr>
                            <?php }?>
                        </tbody>  
                        <input type="hidden" id="credito" value="<?php echo format($credito,true);?>" />  
                        <tfoot>
                            <tr>
                                <th width="100"></th>
                                <th><b>Sumas Iguales</b></th>
                                <th width="100" class="text-right"><b><?php echo format($debito,true); ?></b></th>
                                <th width="100" class="text-right"><b><?php echo @format($debito,true); ?></b></th>
                            </tr>
                        </tfoot>                    
                    </table> 
                </div>
            </div> 
            <div class="tab-pane row justify-content-md-center" role="tabpanel" id="relacion">
                <div class="col-md-12">
                    <table class="tablesorter table table-hover">
                        <thead>
                            <tr>
                                <th width="100"><b>Fecha</b></th>
                                <th><b>Documento</b></th>
                                <th width="100" class="text-center"><b>Consecutivo</b></th>
                                <th width="100" class="text-center"><b>Valor</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $debito     =   0;
                                $credito    =   0;
                                $items      =   items_factura_contable($this->uri->segment(3),array(),array("tipo_documento"=>8));
                                foreach($pagos as $k=>$v){
                            ?>                       
                                <tr>
                                    <td>
                                        <?php
                                            print($v->fecha);
                                        ?>
                                    </td>
                                    <td>
                                        <?php 
                                            print(tipo_documento($v->tipo_documento));
                                        ?>
                                    </td>
                                    <td class="text-center">
                                        <a class="nav-link vin" title="Comprobante Transferencia No. <?php echo $v->consecutivo;?>" href="<?php echo base_url('Operaciones/transferencia_nacionales/'.$v->nro_documento.'/'.$v->consecutivo.'/'.$v->tipo_documento.'/iframe');?>">
                                            <?php
                                                echo $v->consecutivo;
                                            ?>
                                        </a>
                                    </td>
                                    <td  class="text-right">
                                        <?php
                                                $credito +=$v->credito;
                                                print(format($v->credito,true));
                                        ?>
                                    </td>
                                </tr>
                            <?php }?>
                        </tbody>  
                        <input type="hidden" id="credito" value="<?php echo format($credito,true);?>" />  
                        <tfoot>
                            <tr>
                                <th width="100"></th>
                                <th><b>Saldo pendiente</b></th>
                                <th width="100" class="text-right"></th>
                                <th width="100" class="text-right"><b><?php echo @format(($this->$modulo->result['registro_contable'][1]->credito - $credito),true); ?></b></th>
                            </tr>
                        </tfoot>                    
                    </table> 
                </div>
            </div>  
            <div class="tab-pane row justify-content-md-center <?php echo ($this->uri->segment(4)=='Observaciones')?"active":""?>" role="tabpanel" id="observacion">
                <div style=" width:100%; height:20px;"></div>
                <?php 
                    HtmlObservaciones();
                ?>
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
        $('.cancelar').click(function(){
            paren.reload.location();
        });
	});
</script>