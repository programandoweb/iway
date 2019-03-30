<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/
	$this->load->helper('numeros');
	setlocale(LC_ALL,"es_ES.UTF-8"); 
	$modulo		=	$this->ModuloActivo;
	$items		=	items_factura($this->uri->segment(3));
?>
<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
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
<div style="font-family:font-family: 'Montserrat', sans-serif; line-height:16px; font-size:12px; font-family:font-family: 'Montserrat', sans-serif; ">
    <?php 
        $reg=count($items);
        $num=$reg/5;
        $Pag=ceil($num);
        $plataformas_array  =   array();
                $tokens     =   0;       
        for($i=1;$i<=$Pag;$i++){?>   
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-top:20px;">
        <tr style="padding: 0;margin:0; width:100%;">
            <td style="padding: 0;margin:0;width:60%;">
               <div class="recuadro margen_derecha fondoCell">    
                  <div class="colorFondo">Datos Cliente </div>
                  <b><?php echo $this->$modulo->result->nombre_cliente?></b><br/> 
                  NIT (Id): <?php print ( $this->$modulo->result->Nit )?><br>
                  Dirección: <?php $Texto=$this->$modulo->result->direccion; $direccion = wordwrap($Texto, 45, "<br />\n");
                  echo $direccion; ?><br>
                  Ciudad: <?php echo ( $this->$modulo->result->Ciudad )?><br>
                  Telefono:<br/> 
               </div>            	    
            </td>        
            <td>
                <div class="recuadro fondoCell">
                    <div class="colorFondo">Datos documento</div>
                     <table>
                         <tr>
                             <td>Factura:</td>
                             <td><?php echo $this->$modulo->result->nro_documento;?></td>
                         </tr>
                         <tr>
                             <td>Fecha de Expedicion:</td>
                             <td><?php print ( $this->$modulo->result->fecha_emision )?></td>
                         </tr>
                         <tr>
                             <td>Fecha de Vencimiento:</td>
                             <td><?php echo calculo_fechas($this->$modulo->result->fecha_emision,'+5'); ?></td>
                         </tr>
                         <tr>
                             <td>Estado:</td>
                             <td></td>
                         </tr>
                         <tr>
                             <td>Sucursal:</td>
                             <td><?php print_r($items[0]->abreviacion);?></td>
                         </tr>
                     </table>
                </div>            	
            </td>
        </tr>
    </table>
    <div style="width:100%; height:40px;"></div>
    <table border="0" cellpadding="0" cellspacing="0" class="table" style="width:100%;">
        <thead style="text-align:center; color:white; font-weight:bold; background:#666;width: 100%;"> 
            <tr style="width:100%;">
                <td style="width: 240px;"><b>Descripción</b></td>
                <td style="width: 90px;"><b>Unidad</b></td>                
                <td style="width: 90px;" class="text-center"><b>Cantidad</b></td>
                <td style="width: 90px;" class="text-center"><b>Valor Unidad</b></td>
                <td style="width: 90px;" style="text-align:center;"><b>Valor Total</b></td>
            </tr>
        </thead>
        <tbody>
            <?php 
                $plataformas_array	=	array();
                $tokens		=	0;
                foreach($items as $k =>$v){?>
                <tr class="par">
                    <td >
                        <?php echo ' '.$v->primer_nombre_modelo.' '.$v->primer_apellido_modelo;?>
                        (
                            <?php print_r($v->nickname);?>
                        )
                    </td>
                    <td >
                        1
                    </td>
                    <td style="text-align:right;">
                        <?php print_r(format($v->tokens,false));
                            $tokens		=	$tokens+$v->tokens;
                        ?>
                    </td>
                    <td style="text-align:right;">
                        <?php print_r($v->equi);?>
                    </td>                    
                    <td width="100"  style="text-align:right;">
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
            <?php
                }
            ?>
				<tr valign="top">
					<td class="bordetop" colspan="3" rowspan="4"><b>Observaciones:</b></td>
                    <td class="bordetop">Subtotal</td>
                    <td class="bordetop"></td>
                </tr>
                <tr>    
                    <td>Descuento</td>
                    <td class="textRight"></td>
                </tr>
                <tr>
                    <td>IVA</td>
                    <td class="textRight"></td>
                </tr>
                <tr>
                    <td>Retefuente</td>					 
					<td class="textRight"></td>
				</tr>
        </tbody>
        <tfoot class="bordeAll">
            <tr>
                <td colspan="3"><b>Valor en letras</b></td>
                <td class="bordetop"><b>Total a Pagar:</b></td>
                <td class="textRight"><b><?php echo $this->$modulo->result->total_facturado_dolar;?></b></td>
            </tr>
        </tfoot>
    </table> 
</div>



// Respaldo


<!--<div><b>Registro Contable</b></div>
    <div style="height: 20px;"></div>
    <table border="0" cellpadding="0" cellspacing="0" width="540" class="table">
        <thead>
            <tr class="colorFondo bordeAll">
                <th width="100"><b>Cuenta</b></th>
                <th><b>Descripción</b></th>
                <th width="100" class="text-center"><b>Débito</b></th>
                <th width="100" class="text-center"><b>Crédito</b></th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $debito     =   0;
                $credito    =   0;
                foreach(get_registro_contable_new($this->uri->segment(3)) as $k =>$v){?>
            <tr>
                <td class="bordeAll"><?php print_r($v->codigo_contable);?></td>
                <td class="bordeAll"><?php print_r($v->cuenta_contable);?></td>
                <td class="bordeAll" style="text-align:right;">
                    <?php 
                            //pre($v);
                           $debito  =   $debito     +   round($v->debito,2);    
                           print_r(format($v->debito));
                    ?>
                </td>
                <td class="bordeAll" style="text-align:right;">
                    <?php   
                            $credito    =   $credito    +   round($v->credito,2);   
                            print_r(format($v->credito));
                    ?>
                </td>
            </tr>
            <?php }?>
            <tr>
                <td style="border:none;"></td>
                <td class="colorFondo" style="text-align:right;"><b>Sumas Iguales</b></td>
                <td class="colorFondo" style="text-align:right;"><?php echo format($debito);?></td>
                <td class="colorFondo" style="text-align:right;">
                    <?php echo format($credito);?> 
                </td>
            </tr>
        </tbody>                        
    </table>                                    
    <div><b>Relación Pago</b></div>
    <div style="height: 20px;"></div>
    <table border="0" cellpadding="0" cellspacing="0" width="540" class="table">
        <thead>
            <tr class="colorFondo bordeAll">
                <th width="150"><b>Fecha</b></th>
                 <th><b>Documento</b></td>
                <th class="text-center"><b>Consecutivo</b></th>
                <th width="100" class="text-center"><b>Valor</b></th>
            </tr>
        </thead>
        <tbody>
            <?php 
                //$debito       =   0;
                $credito    =   0;
                foreach(get_registro_contable($this->uri->segment(3),'NOA',"'5'",NULL,"t1.consecutivo") as $k =>$v){
                    $credito    +=  $v->credito;                                    
            ?>
                    <tr>
                        <td width="150" class="bordeAll">
                            <?php print_r($v->fecha);?>
                        </td>
                        <td class="bordeAll"><?php print_r(tipo_documento($v->tipo_documento));?></td>
                        <td class="bordeAll" style="text-align:center;">
                            <?php print_r($v->consecutivo);?>
                        </td>
                        <td class="bordeAll" style="text-align:right;"><?php print_r(format($v->credito,TRUE));?></td>
                    </tr>
             <?php }?>
        </tbody>
        <tfoot>
            <tr>
                <td style="border:none;"></td>
                <td class="colorFondo" style="text-align:right;"><b>Saldo Pendiente</b></td>
                <td class="colorFondo" style="text-align:center;"><?php echo $this->uri->segment(3); ?></td>
                <td class="colorFondo" style="text-align:right;"><?php echo format($debito - $credito,true);?></td>
            </tr>
        </tfoot>
    </table>                            
    <div><b>Movimientos</b></div>
    <div style="height: 20px;"></div>
    <table border="0" cellpadding="0" cellspacing="0" width="540" class="table">
        <thead>
            <tr class="colorFondo bordeAll">
                <th>Fecha</th>
                <th class="text-center">Operación</th>
                <th class="text-center">Documento</th>
                <th class="text-left">Responsable</th>
                <th class="text-right">Valor</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                foreach(getMovimientos($this->uri->segment(3),array("111010","130510")) as $k => $v){
            ?>                  
                    <tr>
                        <td class="bordeAll">
                            <?php 
                                //pre($v);
                                print($v->fecha);
                            ?>
                        </td>
                        <td class="bordeAll"><?php print(tipo_documento($v->tipo_documento));?></td>
                        <td class="bordeAll" style="text-align:center;">
                            <?php if($v->tipo_documento==5){?>
                            <a class="nav-link lightbox documentos"  data-type="iframe" title="Comprobante bancario No. <?php echo $v->consecutivo;?>" href="<?php echo base_url($this->uri->segment(1).'/'.$this->uri->segment(2).'/'.$v->consecutivo.'/detalle_contable/'.$this->uri->segment(3));?>">
                            <?php }?>
                                <?php print($v->consecutivo);?>
                            <?php if($v->tipo_documento==5){?>                                                                
                            </a>
                            <?php }?>
                        </td>
                        <td class="bordeAll"><?php print($v->primer_nombre);?> <?php print($v->primer_apellido);?></td>
                        <td class="bordeAll" style="text-align:right;">
                            <?php
                                if($v->codigo_contable=='111010'){
                                    echo format($v->debito,true);
                                }else if($v->codigo_contable=='130510'){
                                    echo format($v->debito,true);
                                } 
                            ?>
                        </td>
                    </tr>
            <?php
                }
            ?>
        </tbody>
    </table>--> 