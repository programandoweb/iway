<?php
	if(!@$this->user->id_empresa){
?>	
		<h3 class="text-center">Seleccione un Centro de Costos</h3>
<?php		
		return;	
	}		
	$modulo		=	$this->ModuloActivo;
    //pre(json_decode($this->$modulo->result[0]->data));
    $row        =   $this->$modulo->result;
    //pre($row);
    $json2      =   @json_decode($row[0]->data);
    if(@$json2->Tipo_transaccion == "Efectivo"){
        $caja_id = explode("/-/",$json2->caja_id);
        $nombre_caja = getCaja($caja_id[0]);
    }
    $banco      =   @explode("/-/",$json2->Banco_destino);   
    $proveedor =   @centrodecostos($this->uri->segment(5));
    $abreviacion = @centrodecostos($json2->centro_de_costos)->abreviacion;
    //pre($empresa);
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
                  <div class="colorFondo"><b>Cuenta origen</b></div>
                  <table>
                      <tr>
                        <td>
                            <b>
                                <?php 
                                    echo @nombre($proveedor);
                                ?>
                            </b>
                        </td>
                      </tr>
                      <tr>
                        <td>Documento: 
                            <b>
                                <?php echo @$proveedor->identificacion; ?>
                            </b>
                        </td>
                      </tr>
                      <tr>
                        <td>Dirección: 
                            <b>
                                <?php 
                                    echo @$proveedor->direccion; //str_replace($row[0]->Pais,"",$row[0]->Direccion)
                                ?>
                            </b>
                        </td>
                      </tr>
                      <tr>
                          <td>Ciudad: <b><?php echo @$proveedor->ciudad; ?> (<?php echo $proveedor->departamento; ?>)</td>
                      </tr>
                      <tr>
                          <td>Teléfono: <b><?php echo (!empty($proveedor->telefono)?$proveedor->telefono:"N.A."); ?></b></td>
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
                                Pago honorarios: 
                             </td>
                             <td>
                                <b>
                                    <?php 
                                        echo @$abreviacion.' '.@tipo_documento($row[0]->tipo_documento,true).' '.@ceros($this->uri->segment(4)); 
                                    ?>
                                </b> 
                             </td>
                         </tr>
                         <tr>
                             <td>Fecha de Expedición:</td>
                             <td><b><?php echo @$row[0]->fecha; ?></b></td>
                         </tr>
                         <tr>
                             <td>Fecha de Vencimiento:</td>
                             <td><b><?php echo @$row[0]->fecha;?></b></td>
                         </tr>
                         <tr>
                             <td>Estado:</td>
                             <td>
                                <b>
                                    <?php 
                                        if($this->$modulo->result[0]->estatus==9){
                                    ?>
                                        Anulado    
                                    <?php       
                                        }else{
                                    ?>
                                        Procesado
                                    <?php
                                        }
                                    ?>        
                                </b>
                            </td>
                         </tr>
                         <tr>
                             <td>Ciclo de producción:</td>
                             <td>
                                </b>
                                    <?php echo (empty($json->ciclo_de_produccion))?$row[0]->ciclo_produccion_id:$json->ciclo_de_produccion; ?>
                                </b>
                            </td>
                         </tr>
                     </table>
                </div>              
            </td>
        </tr>
    </table>
    <div style="height: 20px;"></div>
    <div><b>Detalle: </b><b></b></div>
    <div style="height: 20px;"></div>
    <table border="0" cellpadding="0" cellspacing="0" width="100%" class="table">
        <thead>
            <tr class="colorFondo">
                <th ><b>Concepto</b></th>
                <?php
                    if(@$json2->Tipo_transaccion == "Efectivo"){
                ?>
                <th class="center"><b>Caja</b></th>
                <?php
                    }else{
                ?>
                <th class="center"><b>Procesador</b></th>
                <?php
                    }
                ?>
                <th class="center"><b>Documento</b></th>
                <th class="center"><b>Monto</b></th>
            </tr>
        </thead>
        <tbody>
            <?php
                $sum	=	0;
                //pre($this->$modulo->result);
            ?>
                <tr>
                    <td class="bordeAll" style="text-align: justify;">
                        Cancelación / Abono de honorarios y/o cuentas en participación por concepto de contrato de mandato y/o cuentas en participación
                    </td>
                    <td class="bordeAll center">
                    <?php
                        if(@$json2->Tipo_transaccion == "Efectivo"){
                            echo $nombre_caja; 
                        }else{
                            echo entidadbancaria($banco[0]);
                        }
                    ?>
                    </td>
                    <td  class="bordeAll center">
                        <a class="vin" href="<?php echo base_url("Usuarios/HonorariosModeloAprobados/".$this->uri->segment(5).'/'.$this->uri->segment(3).'/1'); ?>" title="Cancelacion abono a proveedor">
                            <?php echo $this->uri->segment(3); ?>
                        </a>           
                    </td>
                    <td  class="right creditos bordeAll" >
                        <?php echo format($json2->monto,true);?>
                    </td>
                </tr>                   
        </tbody>
        <tfoot>
            <tr class="colorFondo">
                <th></th>
                <th></th>
                <th class="center">Total</th>
                <th class="right"><?php echo format($json2->monto,true);?></th>
            </tr>
        </tfoot>  
    </table> 
    <div style="height: 20px;"></div>
    <div><b>Registro Contable: </b><b></b></div>
    <div style="height: 20px;"></div>
    <table border="0" cellpadding="0" cellspacing="0" width="100%" class="table">
        <thead>
            <tr class="colorFondo">
                <th width="100"><b>Cuenta</b></th>
                <th><b>Concepto Contable</b></th>
                <th width="100" class="center"><b>Débito</b></th>
                <th width="100" class="center"><b>Crédito</b></th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $debito		=	0;
                $credito	=	0;
                $sum1		=		$sum2		=	0;
                foreach($row as $k=>$v){
                    
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
                                $debito +=	@$v->debito;
                                print(format(@$v->debito,true));
                                $sum1	+=	@$v->debito;
                        ?>
                    </td>
                    <td  class="bordeAll right">
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
            <tr class="colorFondo">
                <th></th>                            
                <th class="center">Sumas iguales</th>
                <th class="right"><?php echo format($sum1,true);?></th>
                <th class="right"><?php echo format($sum2,true);?></th>
            </tr>
        </tfoot>                     
    </table>
    <div style="height:20px; "></div>
    <div class="recuadro fondoCell bordeAll">    
        <div class="colorFondo">
            <b>Importante:</b>
        </div>
        <table>
            <tr>
                <td style="text-align: justify;">
                    Certifico (certificamos) que esta operación ha sido verificada de manera detallada antes de su respectivo procesamiento.
                    <?php echo(!empty($row->responsable_id))?" Documento elaborado por <b>".nombre(centrodecostos($row->responsable_id)).'</b>':''; ?>
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
        <div style="margin-top: 20px;text-align: justify;">
           <b><?php echo $empresa->nombre_comercial; ?></b> y en su nombre su representante <b><?php echo $empresa->nombre_representante_legal; ?></b>, asume como cesada la obligación o acreencia generada por concepto de contrato de mandato y/o cuentas en participación, acuerdan las partes aceptar como documento valido este recibo de caja para cualquier reclamación de indole comercial, civil y/o tributario, estipula <b><?php echo @nombre($proveedor); ?></b> (quién ha recibido el dinero) que durante el tiempo laborado jamás sufrio daño alguno contra su integridad, buen nombre, ni integridad personal, fisica o corporal.</b>          
        </div>
        <div style="width: 100%;">
            <div style="height: 40px;"></div>
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td width="45%">
                            <div class="bordetop linea">
                                <b>
                                  <?php
                                      echo @nombre($proveedor);
                                  ?>
                                </b>   
                            </div>
                        </td>
                        <td width="10%"> </td>
                        <td width="45%"> 
                        </td>
                    </tr>
            </table> 
        </div>
    </div>   
</div>