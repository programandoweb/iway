<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
	
	Agregar
	<i class="fa fa-plus" aria-hidden="true"></i>
	Ver
	<i class="fa fa-search" aria-hidden="true"></i>
	Editar
	<i class="fas fa-edit" aria-hidden="true"></i>
*/?>
<?php  
$modulo		=	$this->ModuloActivo;
$row		=	$this->$modulo->result[0];
$registro_contable	=	getMovimientosGeneral($this->uri->segment(3),NULL,array(12,14),array("138020","111005"));
$registro_cuotas	=	getMovimientosGeneral(NULL,$this->uri->segment(3),array(12),array("138020"));
$procesador = centrodecostos($row->user_id);
$empresa = centrodecostos($this->user->id_empresa);
$observacion = getObservaciones(base_url("Usuarios/VerDescuentos/".$this->uri->segment(3)."/View#observaciones"));
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
<?php $empresa = centrodecostos($row->centro_de_costos); ?>
<div style="font-family:font-family: 'Montserrat', sans-serif; line-height:16px; font-size:12px; font-family:font-family: 'Montserrat', sans-serif;margin-top: -50px;">
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
                                    echo @nombre($procesador);
                                ?>        
                            </b>
                        </td>
                      </tr>
                      <tr>
                          <td>Id tercero:</td>
                          <td><b><?php echo @$procesador->identificacion; ?></b></td>
                      </tr>
                      <tr>
                          <td>Dirección:</td>
                          <td><b><?php echo @$procesador->direccion;; ?></b></td>
                      </tr>
                      <tr>
                          <td>Ciudad:</td>
                          <td><b><?php echo @$procesador->ciudad; ?></b></td>
                      </tr>
                      <tr>
                          <td>Teléfono:</td>
                          <td><b><?php echo (!empty($procesador->telefono)?$procesador->telefono:"N.A."); ?></b></td>
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
                                Descuento: 
                             </td>
                             <td>
                                <b>
                                    <?php echo @$empresa->abreviacion.' '.tipo_documento(12,true).' '.ceros($this->uri->segment(3)); ?>
                                </b> 
                             </td>
                         </tr>
                         <tr>
                             <td>Fecha de Expedición:</td>
                             <td><b><?php echo $row->fecha;?></b></td>
                         </tr>
                         <tr>
                             <td>Fecha de Vencimiento:</td>
                             <td><b><?php echo $row->fecha;?></b></td>
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
                             <td>Sucursal:</td>
                             <td></b><?php echo $empresa->abreviacion; ?></b></td>
                         </tr>
                     </table>
                </div>              
            </td>
        </tr>
    </table>
    <div style="height: 20px;"></div>
    <div><b>Detalle Descuento: </b><b></b></div>
    <div style="height: 20px;"></div>
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <thead>
            <tr class="colorFondo">
                <th>Descripción</th>
                <th>Monto</th>
                <th>Cuotas</th>
                <th>Valor </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="bordeAll" style="text-align: justify;">Descuento a favor de: <b><?php echo $row->Proveedor?></b> por concepto de <b><?php echo $row->concepto; ?></b></td>
                <td class="bordeAll right"><?php echo format($row->valor,true)?></td>
                <td class="bordeAll center"><?php echo $row->nro_quincenas; ?> </td>
                <td class="bordeAll right"><?php echo format(($row->valor/$row->nro_quincenas),true)?></td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2" class="bordeAll colorFondo">Son: <?php echo num_to_letras($row->valor, 'PESOS','CENTAVOS') ?></td>
                <td class="bordeAll colorFondo right" >Total Saldo:</td>
                <td class="bordeAll colorFondo right"><?php echo format(@$row->valor,true); ?></td>
            </tr>
        </tfoot>
    </table>
    <div style="height: 20px;"></div>
    <div><b>Registro Contables: </b><b></b></div>
    <div style="height: 20px;"></div>
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
        <thead>
            <tr class="colorFondo">
                <th width="100"><b>Cuenta</b></th>
                <th><b>Descripción</b></th>
                <th width="100" class="center"><b>Débito</b></th>
                <th width="100" class="center"><b>Crédito</b></th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $debito		=	0;
                $credito	=	0;
				
				
               	foreach($this->$modulo->result as $k => $v){?>
            <tr>
                <td class="bordeAll"><?php print_r($v->codigo_contable);?></td>
                <td class="bordeAll"><?php echo get_codigo_contable($v->codigo_contable)->cuenta_contable;?></td>
                <td class="bordeAll right">
                    <?php 
                            //pre($v);
                           $debito	=	$debito 	+ 	round($v->debito,2); 	
                           print_r(format($v->debito));
                    ?>
                </td>
                <td class="bordeAll right">
                    <?php 	
                            $credito	=	$credito 	+ 	round($v->credito,2); 	
                            print_r(format($v->credito));
                    ?>
                </td>
            </tr>
            <?php }?>
        </tbody> 
        <tfoot>
            <tr class="colorFondo">
                <th width="100"></th>
                <th><b>Sumas Iguales</b></th>
                <th width="100" class="right"><b><?php echo format(($debito),true); ?></b></th>
                <th width="100" class="right"><b><?php echo @format($credito,true); ?></b></th>
            </tr>
        </tfoot>                        
    </table>
    <?php if(!empty($observacion[0]->observacion)){ ?>
    <div style="height: 20px;"></div>
    <div><b>Observación: </b></div>
    <div style="height: 20px;"></div>
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
       <thead>
         <tr class="colorFondo">
           <th>Nombre</th>
           <th>Observación</th>
           <th>Fecha</th>
         </tr>
       </thead>
       <tbody>
          <tr>
            <td class="bordeAll"><?php echo nombre(centrodecostos($observacion[0]->user_id)); ?></td>
            <td class="bordeAll"><?php echo $observacion[0]->observacion; ?></td>
            <td class="bordeAll center"><?php echo $observacion[0]->fecha; ?></td>
         </tr>
       </tbody>
     </table> 
       <?php } ?>
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
          Autorizo de manera voluntaria e irrevocable el presente descuento, para que sea descontado de cualquier suma de dinero que se genere a mi favor, en un total de <b><?php echo '('.$row->nro_quincenas.')'; ?></b> cuotas y sean estos dineros reintegrados a favor de <b><?php echo $row->Proveedor?></b>.          
        </div>
        <div style="width: 100%;">
            <div style="height: 40px;"></div>
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td width="45%">
                            <div class="bordetop linea">
                              <?php
                                  echo @nombre($procesador);
                              ?> 
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
