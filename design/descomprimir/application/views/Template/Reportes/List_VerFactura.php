<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/?>
<?php
	$modulo		=	$this->ModuloActivo;
	if($this->user->type=='Modelos'){
		return;	
	}
	//pre($this->user);
?>
<div class="container text-center" id="pagado">
</div>
<div class="container" id="factura">
	<div class="row justify-content-md-center">
    	<div class="col">
       	 	<div class="row filters">
            	<div class="col-md-12">
		            <?php echo submenu('Datos del Cliente','Comprobante de Ingresos');?>
                </div>
            </div>
            <div class="section">
                <div class="row">
                    <div class="col-md-2">
                       Cliente
                    </div>
                    <div class="col-md-4">
                        <b>
                            <?php 
                                echo $this->$modulo->result->nombre_cliente;
                                //pre($this->$modulo->result->id);
                            ?>
                        </b>
                    </div>
                    <div class="col-md-3 ">
                       Factura de Venta No.
                    </div>
                    <div class="col-md-3 text-right">
                        <b>
                            <?php echo $this->$modulo->result->nro_documento;?>
                        </b>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                       Dirección
                    </div>
                    <div class="col-md-4">
                        <b>
                            <?php echo str_replace($this->$modulo->result->pais,"",$this->$modulo->result->direccion)?>
                        </b>
                    </div>
                    <div class="col-md-3 ">
                       Ciclo de producción
                    </div>
                    <div class="col-md-3 text-right">
                        <b>
                            <?php echo $this->$modulo->result->ciclo_de_produccion?>
                        </b>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                       País
                       <br />
                       ID Cliente
                    </div>
                    <div class="col-md-4 ">
                        <b>
                            <?php echo $this->$modulo->result->pais?>
                        </b>
                        <br />
                        <b>
                            <?php echo $this->$modulo->result->identificacion_empresa?>
                        </b>
                    </div>
                    <div class="col-md-3 ">
                       Expedida
                       <br />
                       Vence
                    </div>
                    <div class="col-md-3 text-right">
                        <b>
                            <?php echo $this->$modulo->result->fecha_emision?>
                        </b>
                        <br />
                        <b>
                            <?php echo calculo_fechas($this->$modulo->result->fecha_emision,'+5'); ?>
                        </b>
                    </div>
                </div>
			</div> 
			<div class="section">           
                <div class="row ">
                    <div class="col-md-12">
                        <div class="bd-example bd-example-tabs" role="tabpanel">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-expanded="false">Detalle Factura</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="procesador-tab" data-toggle="tab" href="#procesador" role="tab" aria-controls="procesador" aria-expanded="true">Procesador(es)</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="registrocontable-tab" data-toggle="tab" href="#registrocontable" role="tab" aria-controls="registrocontable" aria-expanded="true">Registro Contable</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="relacionpagos-tab" data-toggle="tab" href="#relacionpagos" role="tab" aria-controls="relacionpagos" aria-expanded="true">Relación Pago</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="movimientos-tab" data-toggle="tab" href="#movimientos" role="tab" aria-controls="movimientos" aria-expanded="true">Movimientos</a>
                                </li>                            
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div role="tabpanel" class="tab-pane fade active show" id="home" aria-labelledby="home-tab" aria-expanded="false">
                                    <table class="tablesorter table table-hover">
                                        <thead>
                                            <tr>
                                                <td width="100"><b>Sucursal</b></td>
                                                <td><b>Nickname</b></td>
                                                <td width="100" class="text-center"><b>Equivalencia</b></td>
                                                <td width="100" class="text-center"><b>TKS</b></td>
                                                <td width="100" class="text-right"><b>USD</b></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $plataformas_array	=	array();
                                                $items		=	items_factura($this->uri->segment(3));
                                                $tokens		=	0;
                                                foreach($items as $k =>$v){?>
                                                <tr>
                                                    <td>
                                                        <?php 
                                                            
                                                            print_r($v->abreviacion);
                                                            #pre($v);
                                                        ?>
                                                    </td>
                                                    <td >
                                                        <?php
                                                            //pre($items);
                                                            
                                                        ?>
                                                        <?php echo ' '.$v->primer_nombre_modelo.' '.$v->primer_apellido_modelo;?>
                                                        (
                                                            <?php print_r($v->nickname);?>
                                                        )
                                                    </td>
                                                    <td  class="text-center">
                                                        <?php print_r($v->equi);?>
                                                    </td>
                                                    <td  class="text-center">
                                                        <?php print_r(format($v->tokens,false));
                                                            $tokens		=	$tokens+$v->tokens;
                                                        ?>
                                                    </td>
                                                    <td width="100" class="text-right">
                                                        <?php print_r($v->usd);?>
                                                        <?php
                                                            $Cuenta_X_Master		=	get_Cuenta_X_Master($v->id_master);
                                                            //pre($Cuenta_X_Master);
                                                            $plataformas_array[$Cuenta_X_Master->nro_cuenta]['monto_dolares']			=	@$plataformas_array[$Cuenta_X_Master->nro_cuenta]['monto_dolares']+str_replace(",",".",$v->usd);
                                                            $plataformas_array[$Cuenta_X_Master->nro_cuenta]['monto_tokens']			=	@$plataformas_array[$Cuenta_X_Master->nro_cuenta]['monto_tokens']+$v->tokens;
                                                            $plataformas_array[$Cuenta_X_Master->nro_cuenta]['entidad_bancaria']		=	@$Cuenta_X_Master->entidad_bancaria;
                                                            $plataformas_array[$Cuenta_X_Master->nro_cuenta]['nro_cuenta']				=	@$Cuenta_X_Master->nro_cuenta;
                                                        ?>
                                                    </td>
                                                </tr>
                                            <?php }?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td class="text-right"><b>Total</b></td>
                                                <td class="text-center"><b><?php echo  format($tokens,false);?></b></td>
                                                <td class="text-right"><b><?php echo $this->$modulo->result->total_facturado_dolar;?></b></td>
                                            </tr>
                                        </tfoot>
                                    </table>                        
                                </div>
                                <div class="tab-pane fade" id="procesador" role="tabpanel" aria-labelledby="procesador-tab" aria-expanded="true">
                                    <?php 
                                        //pre($this->$modulo->result->items);return;
                                        $bancos			=	json_decode($this->$modulo->result->bancos);
                                        $banco_monto	=	0;
                                            foreach( $this->$modulo->result->items as $k => $v){
                                    ?>
                                                <div class="row">
                                                    <div class="col-md-9">
                                                        <?php print_r(entidadbancaria($v->entidad_bancaria));?> <b>(<?php print_r($v->nro_cuenta);?>)</b>
                                                    </div>
                                                    <!--div class="col-md-3 text-right">
                                                        Tokens <b> <?php #print_r(format(@$v->monto_tokens));?></b>
                                                    </div-->                                    
                                                    <div class="col-md-3 text-right">
                                                        Dólares <b> <?php print_r(format($v->usd,true)); //$banco_monto = $banco_monto + $v['monto_dolares'];?></b>
                                                    </div>
                                                </div>
                                    <?php					
                                            }
                                    ?>
                                    <input type="hidden" id="credito" value="<?php echo $this->$modulo->result->total_facturado_dolar;?><?php #echo $banco_monto;?>" />
                                    <input type="hidden" id="credito_cuenta_contable" value="<?php echo get_monto_codigo_contable_x_factura($this->$modulo->result->nro_documento)->credito;?>" />
                                </div>
                                <div class="tab-pane fade" id="registrocontable" role="tabpanel" aria-labelledby="registrocontable-tab" aria-expanded="true">
                                    <table class="tablesorter table table-hover">
                                        <thead>
                                            <tr>
                                                <td width="100"><b>Cuenta</b></td>
                                                <td><b>Descripción</b></td>
                                                <td width="100" class="text-center"><b>Débito</b></td>
                                                <td width="100" class="text-center"><b>Crédito</b></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $debito		=	0;
                                                $credito	=	0;
                                                foreach(get_registro_contable($this->uri->segment(3),'NOA',"'Factura Venta'") as $k =>$v){?>
                                            <tr>
                                                <td><?php print_r($v->codigo_contable);?></td>
                                                <td><?php print_r($v->cuenta_contable);?></td>
                                                <td class="text-center">
                                                    <?php 
                                                            $debito	=	$debito 	+ 	round($v->debito,2); 	
                                                            print_r(format($v->debito));
                                                    ?>
                                                </td>
                                                <td class="text-right">
                                                    <?php 	
                                                            $credito	=	$credito 	+ 	round($v->credito,2); 	
                                                            print_r(format($v->credito));
                                                    ?>
                                                </td>
                                            </tr>
                                            <?php }?>
                                            <tr>
                                                <td></td>
                                                <td class="text-right"><b>Sumas Iguales</b></td>
                                                <td class="text-center"><?php echo format($debito);?></td>
                                                <td class="text-right">
                                                    <?php echo format($credito);?> 
                                                </td>
                                            </tr>
                                        </tbody>                        
                                    </table>                                	
                                </div>
                                <div class="tab-pane fade" id="relacionpagos" role="tabpanel" aria-labelledby="relacionpagos-tab" aria-expanded="true">
                                    <table class="tablesorter table table-hover">
                                        <thead>
                                            <tr>
                                                <td width="150"><b>Fecha</b></td>
                                                 <td><b>Documento</b></td>
                                                <td class="text-center"><b>Consecutivo</b></td>
                                                <td width="100" class="text-center"><b>Valor</b></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                //$debito		=	0;
                                                $credito	=	0;
                                                foreach(get_registro_contable($this->uri->segment(3),'NOA',"'Comprobante Bancario'",NULL,"t1.consecutivo") as $k =>$v){
                                                    $credito	+=	$v->credito;									
                                            ?>
                                                    <tr>
                                                        <td width="150">
                                                            <?php print_r($v->fecha);?>
                                                        </td>
                                                        <td><?php print_r($v->tipo_documento);?></td>
                                                        <td class="text-center"><a class="nav-link lightbox"  data-type="iframe" title="Comprobante bancario No. <?php echo $v->consecutivo;?>" href="<?php echo base_url($this->uri->segment(1).'/'.$this->uri->segment(2).'/'.$v->consecutivo.'/detalle_contable/'.$this->uri->segment(3));?>"><?php print_r($v->consecutivo);?></a></td>
                                                        <td class="text-right"><?php print_r(format($v->credito,TRUE));?></td>
                                                    </tr>
                                             <?php }?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td></td>
                                                <td>Saldo Pendiente</td>
                                                <td></td>
                                                <td class="text-right"><?php echo format($debito - $credito,true);?></td>
                                            </tr>
                                        </tfoot>
                                    </table>                         	
                                </div>
                                <div class="tab-pane fade" id="movimientos" role="tabpanel" aria-labelledby="movimientos-tab" aria-expanded="true">
                                    <?php echo html_logs('rp_operaciones',$this->uri->segment(3));?>                	
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
			</div>                
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