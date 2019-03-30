<?php
	$modulo		=	$this->ModuloActivo;
	if($this->user->type=='Modelos'){
		return;	
	}
	$row		=	$this->$modulo->result;
	$proveedor	=	json_decode($row[0]->json);
    $pagos      =   @getMovimientosGeneral($this->uri->segment(3),NULL,"13",$proveedor->contrapartida,NULL,$proveedor->cliente_id);

?>
<div class="container" id="factura">
    <?php 
        if($row[0]->estatus == 9){
    ?>
        <div class="container text-center">
            <h2 class="font-weight-700 text-uppercase orange">
                Anulado    
            </h2>
        </div>
    <?php       
        }
    ?> 
   <div class="row justify-content-md-center">
    	<div class="col">
        	<div class="row filters">
            	<div class="col-md-12">
                    <?php   
                        $submenu = array("name"       =>  array(  "title" =>  "Detalle otros ingresos.",
                                                                        "url"   =>  current_url()),
                                               "back"      =>  ($this->uri->segment(4) == "iframe")?false:true,
                                               "pdf"       =>   array(  "title" =>  "PDF",
                                                                        "url"   =>  current_url()."/PDF/OtrosIngresos"),
                                               "config"    =>  array("title" =>  "Anular Ingreso",
                                                  "icono"  =>  '<i class="fas fa-trash"></i>',
                                                  "url"   =>  base_url("Usuarios/CancelarOtrosIngresos/".$row[0]->tipo_documento.'/'.$this->uri->segment(3))));
                        if($row[0]->estatus == 9 || count($pagos) > 0){
                            unset($submenu['config']);
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
                            if(isset($row[0]->nombre_cliente) && !empty($row[0]->nombre_cliente)){
                                echo $row[0]->nombre_cliente;
                            }else{
                                echo $proveedor->nombre_legal;
                                //print_r($row[0]->nombre_cliente);
                            }
                        ?>
                        <br/>
                        <?php echo $proveedor->identificacion_empresa;?>
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
                        echo $proveedor->fecha_emision;
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
																echo format($v2,true).'<br/>';
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
                                <th class="text-right">Total:</th>
                                <th class="text-right"><?php echo format(@$debito,true); ?></th>
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
                                $items		=	detalles_gastos_contable($this->uri->segment(3),true);
								
                                foreach($items as $k=>$v){
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
                                                $debito +=	@$v->total_debito;
                                                print(format(@$v->total_debito,true));
                                        ?>
                                    </td>
                                    <td  class="text-right">
                                        <?php
                                                $credito +=$v->total_credito;
                                                print(format($v->total_credito,true));
                                        ?>
                                    </td>
                                </tr>
                            <?php }?>
                        </tbody>  
                        <tfoot>
                            <tr>
                                <th width="100"></th>
                                <th><b>Sumas Iguales</b></th>
                                <th width="100" class="text-right"><b><?php echo format($debito,true); ?></b></th>
                                <th width="100" class="text-right"><b><?php echo format($debito,true); ?></b></th>
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
                                //$pagos      =   @pago_gasto($this->uri->segment(3),"Pasivo",NULL,13);
                                $debito_pagos = 0;
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
                                        <a class="documentos" title="Detalle Honorario?>" href="<?php echo base_url("Usuarios/HonorariosModeloAprobados/".$v->user_id."/".$v->documento."/".$v->estatus.'/Iframedes')?>">
                                            <?php
                                                echo $v->consecutivo;
                                            ?>
                                        </a>
                                    </td>
                                    <td  class="text-right">
                                        <?php
                                                $debito_pagos +=$v->debito;
                                                print(format($v->debito,true));
                                        ?>
                                    </td>
                                </tr>
                            <?php }?>
                        </tbody>   
                        <tfoot>
                            <tr>
                                <th width="100"></th>
                                <th><b>Saldo pendiente</b></th>
                                <th width="100" class="text-right"></th>
                                <th width="100" class="text-right"><b><?php echo @format(($debito - $debito_pagos),true); ?></b></th>
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
	});
</script>