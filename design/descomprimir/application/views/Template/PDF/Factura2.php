<?php
/* 
    DESARROLLO Y PROGRAMACIÓN
    PROGRAMANDOWEB.NET
    LCDO. JORGE MENDEZ
    info@programandoweb.net
*/
    $this->load->helper('numeros');
    setlocale(LC_ALL,"es_ES.UTF-8"); 
    $modulo     =   $this->ModuloActivo;
    $items      =   items_factura($this->uri->segment(3));
?>
<style>
    .firmas{
        font-family:font-family: 'Montserrat', sans-serif;line-height:16px; font-size:12px; font-family:font-family: 'Montserrat', sans-serif;
    }
    .firmas> .linea{
        margin-right: 60px;
        width: 250px;
    }
   .divicion{
        width:50%;
    }
   .ancho{
        width: 100%
        margin:0;
        padding: 0;
   }
   .textRight{
        text-align: right;
   }
   .textLeft{
        text-align: left;
   }
   .recuadro{
        background: #F2F2F2;
        padding: 15px;
        border-radius: 8px;
        height: 120px;
   }
   thead{
       text-align:center; color:white; font-weight:bold; background:#666;width: 100%;
   }
   .fondoCell{
    background: #FAFAFA;
   }
   .colorFondo{
        background:#666;
        margin-top: -15px;
        margin-left: -15px;
        margin-right: -15px;
        margin-bottom: 15px;
        color: white;
   }
   .bordetop{
        border-top:1px solid #D8D8D8;
   }
   .borderight: {
        border-right: 1px solid #D8D8D8;
   }
   .bordeAll{
        border: 1px solid #D8D8D8; 
   }
   .margen_derecha{
        margin-right: 30px;
        margin-left: 0;
   }
   .table> td {
        border-right: 1px solid #D8D8D8;
        border-left : 1px solid #D8D8D8;
    }
    .par:nth-child(odd) {
    background-color:#FAFAFA;
    }
    .par>td{
        padding:8px;
    }
    .footer{
        width:100%;
        font-size:10px;
        text-align:center;
        font-family:font-family: 'Montserrat', sans-serif;
    }
    .footer>table{
        width:100%;
        border-top: 1px solid #D8D8D8;
    }
    .footer>table>tr>td{
        width: 33%;
    }
</style>
<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
<?php 
        $reg=count($items);
        $num=$reg/14;
        $Pag=ceil($num);
        $plataformas_array  =   array();
                $tokens     =   0;              
        for($i=1;$i<=$Pag;$i++){?> 
<div style="font-family:font-family: 'Montserrat', sans-serif; line-height:16px; font-size:12px; font-family:font-family: 'Montserrat', sans-serif;margin-bottom: 30px;">
    <table class="ancho" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td width="30%">
                <img src="<?php echo img_logo($empresa->user_id);?>" style="width:153px;height:55px;" />
            </td>
            <td style="text-align:right; font-size:12px; font-weight:bold;" valign="top">
                <?php echo $empresa->nombre_legal?><br />
                <?php echo $empresa->identificacion;?> | <?php echo $empresa->tipo_empresa;?><br />
                <?php echo $empresa->direccion;?>:<br />                
                PBX: <?php echo $empresa->cod_telefono;?>-<?php echo $empresa->telefono?><br />
                <?php echo $empresa->website;?><br />
                <?php #pre($empresa); ?>
            </td>
        </tr>
    </table>  
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-top:30px;">
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
        <thead"> 
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
                $plataformas_array  =   array();
                $tokens     =   0;
                $n=array_chunk($items,14);
                if(isset($key)){
                    $key++;
                }else{
                    $key=0;
                }
                foreach($n[$key] as $k =>$v){?>
                <tr class="par">
                    <td >
                        <?php echo ' '.$v->primer_nombre_modelo.' '.$v->primer_apellido_modelo;?>
                        (
                            <?php print_r($v->nickname);?>
                        )
                    </td>
                    <td style="text-align:center;">
                        <?php
                        	print_r($v->moneda_de_pago);
						?>
                    </td>
                    <td style="text-align:right;">
                        <?php print_r(format($v->tokens,false));
                            $tokens     =   $tokens+$v->tokens;
                        ?>
                    </td>
                    <td style="text-align:center;">
                        <?php print_r($v->equi);?>
                    </td>                    
                    <td width="100"  style="text-align:right;">
                        <?php print_r($v->usd);?>
                        <?php
                            $Cuenta_X_Master        =   get_Cuenta_X_Master($v->id_master);
                            //pre($Cuenta_X_Master);
                            $plataformas_array[$Cuenta_X_Master->nro_cuenta]['monto_dolares']           =   @$plataformas_array[$Cuenta_X_Master->nro_cuenta]['monto_dolares']+str_replace(",",".",$v->usd);
                            $plataformas_array[$Cuenta_X_Master->nro_cuenta]['monto_tokens']            =   @$plataformas_array[$Cuenta_X_Master->nro_cuenta]['monto_tokens']+$v->tokens;
                            $plataformas_array[$Cuenta_X_Master->nro_cuenta]['entidad_bancaria']        =   @$Cuenta_X_Master->entidad_bancaria;
                            $plataformas_array[$Cuenta_X_Master->nro_cuenta]['nro_cuenta']              =   @$Cuenta_X_Master->nro_cuenta;
                        ?>
                    </td>
                </tr>
            <?php }?>
                <tr valign="top">
                    <td class="bordetop" colspan="3" rowspan="4" style="padding-left: 10px;"><b>Observaciones:</b> <?php 
                            $t=Procesador_factura($this->uri->segment(3));
                            foreach ($t as $in => $Pro) { ?>
                            <div>
                                 <table width="100%">
                                     <tr>
                                         <td style="border:0;"><?php echo $Pro->entidad_bancaria; ?> <?php echo $Pro->nro_cuenta; ?></td>
                                         <td style="border:0; text-align:right;padding-right: 8px;"><?php echo $Pro->usd; ?></td>
                                     </tr>
                                 </table>                    
                            </div>                             
                               
                          <?php  } ?>
                    </td>
                    <td class="bordetop" style="padding-left: 10px;">Subtotal</td>
                    <td class="bordetop textRight"><b style="padding-right: 10px;"><?php echo $this->$modulo->result->total_facturado_dolar;?></b></td>
                </tr>
                <tr>    
                    <td style="padding-left: 10px;">Descuento</td>
                    <td class="textRight"><b style="padding-right: 10px;">0</b></td>
                </tr>
                <tr>
                    <td style="padding-left: 10px;">IVA</td>
                    <td class="textRight"><b style="padding-right: 10px;">0</b></td>
                </tr>
                <tr>
                    <td style="padding-left: 10px;">Retefuente</td>                  
                    <td class="textRight"><b style="padding-right: 10px;">0</b></td>
                </tr>
        </tbody>
        <tfoot class="bordeAll">
            <tr>
                <td colspan="3" style="padding-left: 10px;"><b>Valor en letras:</b><b style="font-size: 12px;"> <?php echo strtolower(num_to_letras($this->$modulo->result->total_facturado_dolar,'','dólares'))?></b></td>
                <td class="bordetop" style="padding-left: 10px;"><b>Total a Pagar:</b></td>
                <td class="textRight"><b style="padding-right: 10px;"><?php echo $this->$modulo->result->total_facturado_dolar;?></b></td>
            </tr>
        </tfoot>
    </table> 
</div>
     <?php 
         if($i==$Pag){
             $position=count($n[$key]);
                if($position > 6){
                     $x=(50*14)/$position;
                     $m=ceil($x);
                }else{
                     $m=116;
                }
                    echo '<div class="firmas" style="position:absolute;bottom:'.$m.';width: 100%;">
                    <table class="ancho" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td>
                                    <div class="bordetop linea">
                                        Elaboró:
                                    </div>
                                </td>
                                <td>
                                    <div class="bordetop linea">
                                       Aceptado, firmado y/o sello, fecha. 
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="padding-top:15px;">
                                    Esta factura se asimila en todos sus efectos a una letra de cambio, de conformidad con el articulo 774 del código de comercio. Autorizo que en caso de incumplimiento de esta obligación sea reportado a las centrales de riesgo, se cobraran intereses por concepto de mora. 
                                </td>
                            </tr>
                    </table> 
                 </div>';
                       }          

      ?>      
<div class="footer" style="position: absolute; bottom:10px; width: 100%">
    <table>
        <tr>
            <td style="width:33%; text-align: left;">Fecha generacion documento <?php print ( $this->$modulo->result->fecha_emision )?></td>
            <td style="text-align: center;">Página <?php echo $i.' / '.$Pag ?></td>
            <td style="width:33%; text-align: right;">Powered by LogicSoft&reg; | www.webcamplus.com.co</td>
        </tr>
    </table>
</div> <?php }?>  