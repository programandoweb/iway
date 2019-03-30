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
	$row		=	$this->$modulo->result;
    $pagado = false;
	$proveedor	=	@json_decode($row[0]->json);
    $cliente    =   centrodecostos($proveedor->cliente_id);
    $pagos      =   @pago_gasto($this->uri->segment(3));
    $observaciones = Observaciones(base_url("Reportes/VerDetalleGasto2/".$this->uri->segment(3)));
    $num = count($observaciones) - 1;
    $credito_pagos = 0;
    foreach ($pagos as $key => $value) {
        $credito_pagos +=$value->credito;
    }
?>
<table class="ancho cabecera" border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <td width="30%" colspan="2">
            <img src="<?php echo img_logo($empresa->user_id);?>" style="width:153px;height:90px;" />
        </td>
        <td style="text-align:right; font-size:12px; font-weight:bold;" valign="top" colspan="15">
            <?php echo $empresa->nombre_legal?><br/>
            Nit: <?php echo $empresa->identificacion;?> | <?php echo $empresa->tipo_empresa;?><br />
            <?php echo $empresa->direccion;?><br />               
            PBX: <?php echo $empresa->cod_telefono;?>-<?php echo $empresa->telefono?><br />
            <?php echo $empresa->website;?><br/>
            <?php #pre($empresa); ?>
        </td>
    </tr>
</table>
<div class="footer bordetop pie_de_pagina">
    <table>
        <tr>
            <td style="width:33%; text-align: left;font-size: 9px;color :black;">Fecha impresión documento <?php echo date('Y-m-d'); ?></td>
            <td style="text-align: center;font-size: 9px;"></td>
            <td style="width:33%; text-align: right;font-size: 9px;">Powered by LogicSoft&reg; | www.webcamplus.com.co</td>
        </tr>
    </table>
</div>
<div style="font-family:font-family: 'Montserrat', sans-serif; line-height:16px; font-size:12px; font-family:font-family: 'Montserrat', sans-serif;margin-top: -20px;">
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-top:30px;">
        <tr style="padding: 0;margin:0; width:100%;">
            <td style="padding: 0;margin:0;width:60%;">
               <div class="recuadro margen_derecha bordeAll">    
                  <div class="colorFondo"><b>Tercero</b></div>
                  <table>
                      <tr>
                        <td colspan="2">
                            <b>
                                <?php 
                                    if(!empty($row[0]->nombre_cliente)){
                                        echo $row[0]->nombre_cliente;
                                    }else{
                                        echo $proveedor->nombre_legal;
                                        //print_r($row[0]->nombre_cliente);
                                    }
                                ?>           
                            </b>
                        </td>
                      </tr>
                      <tr>
                          <td>ID Tercero:</td>
                          <td>
                            <b>
                                <?php echo $proveedor->identificacion_empresa;?>
                                <?php
                                    if(!empty($cliente->identificacion_ext)){
                                        echo ' - '.$cliente->identificacion_ext;
                                    } 
                                ?>
                            </b>
                          </td>
                      </tr>
                      <tr width="100%">
                          <td width="100%">Dirección:</td>
                          <td>
                                <b><?php echo @$proveedor->direccion;; ?></b>
                          </td>
                      </tr>
                      <tr>
                          <td>Ciudad: </td>
                          <td>
                            <b>                       
                                <?php echo $cliente->ciudad; //str_replace($row[0]->Pais,"",$row[0]->Direccion) ?>
                            </b>
                          </td>
                      </tr>
                      <tr>
                          <td>Teléfono: </td>
                          <td>
                             <b><?php if(!empty($cliente->cod_telefono) && !empty($cliente->telefono)){ echo $cliente->cod_telefono.' '.$cliente->telefono; }else{echo "N.A.";}; ?></b>
                          </td>
                      </tr>
                  </table>
               </div>                   
            </td>        
            <td>
                <div class="recuadro bordeAll">
                    <div class="colorFondo"><b>Datos documento</b></div>
                     <table>
                         <tr>
                             <td width="120">
                                Otros Ingresos: 
                             </td>
                             <td>
                                <b>
                                    <?php echo @$row[0]->abreviacion.' '.tipo_documento($row[0]->tipo_documento,true).' '.ceros($this->uri->segment(3)); ?>
                                </b> 
                             </td>
                         </tr>
                         <tr>
                             <td>Fecha de Expedicion:</td>
                             <td><b><?php /*DAVID MANDÓ A CAMBIAR*/echo $proveedor->fecha_emision;?></b></td>
                         </tr>
                         <tr>
                             <td>Fecha de Vencimiento:</td>
                             <td><b><?php echo $proveedor->fecha_emision; ?></b></td>
                         </tr>
                         <tr>
                             <td>Estado:</td>
                             <td>
                                <b>
                                    <?php 
                                        if(@$row[0]->estatus==9){
                                    ?>
                                        Anulado    
                                    <?php       
                                        }else{
                                    ?>
                                        Pendiente
                                    <?php
                                        }
                                    ?>      
                                </b>
                            </td>
                         </tr>
                         <tr>
                             <td>Ciclo de producción:</td>
                             <td></b><?php echo $row[0]->ciclo_de_produccion?></b></td>
                         </tr>
                     </table>
                </div>              
            </td>
        </tr>
    </table>
    <div style="height: 20px;"></div>
    <div><b>Detalle Otros Ingresos: </b><b></b></div>
    <div style="height: 20px;"></div>
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <thead>
            <tr class="colorFondo">
                <th>Concepto</th>
                <th>Factura</th>
                <th>Sucursal</th>
                <th>Documento</th>
                <th>Monto</th>
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
                                <td class="bordeAll">
                                    <?php 
                                        foreach($decode->descripcion2 as $v2){
                                            if(!empty($v2)){
                                                print($v2.'<br>');  
                                            }
                                        }
                                        //print(get_codigo_contable($v->codigo_contable)->cuenta_contable);
                                    ?>
                                </td>
                                <td class="bordeAll center">
                                    <b>N.A.</b>
                                </td>
                                <td class="bordeAll center">
                                    <?php 
                                        foreach($decode->valor as $v2){
                                            if(!empty($v2)){
                                                echo $v->abreviacion.'<br/>';
                                            }
                                        }                                                       
                                    ?>
                                </td>
                                <td class="bordeAll center">
                                    <?php 
                                        foreach($decode->valor as $v2){
                                            if(!empty($v2)){
                                                echo $v->consecutivo.'<br/>';
                                            }
                                        }                                                       
                                    ?>
                                </td>
                                <td class="bordeAll right">
                                    <?php 
                                        foreach($decode->valor as $v2){
                                            if(!empty($v2)){
                                                echo format($v2,true).'<br/>';
                                                $debito         +=  $v2; 
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
            <tr>
                <td colspan="3" class="bordeAll colorFondo">Son: <?php echo num_to_letras($debito, 'PESOS','CENTAVOS') ?></td>
                <td class="bordeAll colorFondo right" >Total Saldo:</td>
                <td class="bordeAll colorFondo right"><?php echo format(@$debito,true); ?></td>
            </tr>
        </tbody>
    </table>
    <div style="height: 20px;"></div>
    <div><b>Registro contable:</b></div>
    <div style="height: 20px;"></div>
    <table border="0" cellpadding="0" cellspacing="0" width="100%" class="table">
        <thead>
            <tr class="colorFondo">
                <th width="100"><b>Cuenta</b></th>
                <th><b>Concepto Contable</b></th>
                <th width="100" class="text-center"><b>Débito</b></th>
                <th width="100" class="text-center"><b>Crédito</b></th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $debito     =   0;
                $credito    =   0;
                $items      =   detalles_gastos_contable($this->uri->segment(3),true);
                
                foreach($items as $k=>$v){
            ?>                       
                <tr>
                    <td class="bordeAll">
                        <?php
                            print($v->codigo_contable);
                        ?>
                    </td>
                    <td class="bordeAll">
                        <?php 
                            print(get_codigo_contable($v->codigo_contable)->cuenta_contable);
                        ?>
                    </td>
                    <td class="bordeAll right">
                        <?php
                                $debito +=  @$v->total_debito;
                                print(format(@$v->total_debito,true));
                        ?>
                    </td>
                    <td  class="bordeAll right">
                        <?php
                                $credito +=$v->total_credito;
                                print(format($v->total_credito,true));
                        ?>
                    </td>
                </tr>
            <?php }?>
        </tbody>
        <tfoot>
            <tr class="colorFondo">
                <td width="100"></td>
                <td><b>Sumas Iguales</b></td>
                <td width="100" class="right"><b><?php echo format(($debito),true); ?></b></td>
                <td width="100" class="right"><b><?php echo @format($debito,true); ?></b></td>
            </tr>
        </tfoot>                       
    </table> 
        <?php if(!empty($observaciones)){ ?>
        <div style="height: 20px;"></div>
        <div><b>Observación:</b></div>
        <div style="height: 20px;"></div>
         <table border="0" cellpadding="0" cellspacing="0" width="100%" class="table">
            <thead>
                <tr class="colorFondo">
                    <th width="100"><b>Nombre</b></th>
                    <th><b>Observación</b></th>
                    <th width="100" class="text-center"><b>Fecha</b></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $debito     =   0;
                    $credito    =   0;
                    $items      =   items_factura_contable($this->uri->segment(3),array(),array("tipo_documento"=>8));
                ?>                       
                    <tr>
                        <td class="bordeAll">
                            <?php
                                echo nombre($observaciones[$num]);
                            ?>
                        </td>
                        <td class="bordeAll">
                            <?php 
                                echo $observaciones[$num]->observacion;
                            ?>
                        </td>
                        <td class="bordeAll right">
                            <?php
                                echo $observaciones[$num]->fecha;
                            ?>
                        </td>
                    </tr>
                    <?php
                        }
                    ?>
            </tbody>                      
        </table>
    <div style="height:20px; "></div>
    <div class="recuadro fondoCell bordeAll">    
        <div class="colorFondo">
            <b>Importante:</b>
        </div>
        <table>
            <tr>
                <td style="text-align: justify;">
                    Certifico (certificamos) que esta operación ha sido verificada de manera detallada antes de su respectivo procesamiento,
                    <?php echo(!empty($row[0]->responsable_id))?" Documento elaborado por <b>".nombre(centrodecostos($row[0]->responsable_id)).'</b>':''; ?>
                </td>
            </tr>
        </table>
        <div style="width: 100%;">
            <div style="height: 40px;"></div>
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td width="45%">
                            <div class="bordetop linea">
                                Elaboró:
                            </div>
                        </td>
                        <td width="10%"> </td>
                        <td width="45%"> 
                            <div class="bordetop linea"> 
                                Revisó:
                            </div>
                        </td>
                    </tr>
            </table> 
        </div>
    </div> 
</div>