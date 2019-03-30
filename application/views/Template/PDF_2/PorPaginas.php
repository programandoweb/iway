<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/?>
<?php
    $OpcionesFactura    =   getOpcionesFactura($empresa->user_id);
	$modulo=$this->ModuloActivo;
	$fecha=get_cf_ciclos_pagos_new($this->user->id_empresa,0);
        $items = $this->$modulo->result;
        $reg=count($items);
        $num=$reg/12;
        $Pag=ceil($num)-1;
        $numPag=0;        
        for($i=0;$i<=$Pag;$i++){
        $numPag++; 
?> 
<div style="font-family:font-family: 'Montserrat', sans-serif; line-height:16px; font-size:12px; font-family:font-family: 'Montserrat', sans-serif;">
    <table class="ancho" border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td width="30%" colspan="2">
                <img src="<?php echo img_logo($empresa->user_id);?>" style="width:153px;height:55px;" />
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
<?php
    $modulo = $this->ModuloActivo;
    $trm    = get_cf_ciclos_pagos_new($this->user->id_empresa,0);   
?>
    <div style="height: 20px;"></div>
    <div style="text-align: center;">
        Discriminado de facturación por Plataforma
    </div>
    <div style="height: 20px;"></div>
    <?php
        
        $total_x_modelo     =   array();     
        foreach($this->$modulo->result["global"] as $k => $v){
            if(is_object($v) && isset($this->$modulo->result["detallado"][$v->id_plataforma])){
                if(count($this->$modulo->result["detallado"][$v->id_plataforma])>0){
    ?>
                    <div id="<?php echo $v->primer_nombre;?>">
                        <h3><?php print($v->primer_nombre);?></h3>
                        <table class="ancho" border="0" cellpadding="0" cellspacing="0" width="100%" >
                            <thead class="bordeAll">
                                <tr class="colorFondo">
                                    <th width="150">Modelo</th>
                                    <?php 
                                        $color_gris =   0;
                                        $trm->desde =   (int) $trm->desde;
                                        for($a=$trm->desde; $a<=$trm->hasta;$a++ ){
                                    ?>
                                        <th><?php echo $a;?></th>
                                    <?php   
                                        }
                                    ?>
                                    <th width="100" class="text-right">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $sum_x_modelos_total=0;
                                    foreach($this->$modulo->result["detallado"][$v->id_plataforma] as $v2){
                                        $tokens=get_reporte_quincenal_x_modelo($v2->id_modelo,$v->id_plataforma,$desde=false , $hasta=false);
                                ?>
                                    <tr>
                                        <td class="bordeAll">
                                            <?php print($v2->modelo);?>         
                                        </td>
                                        <?php 
                                            $sum_x_modelos=0;
                                            
                                            $color_gris=0;
                                            $trm->desde =   (int) $trm->desde;
                                            for($a=$trm->desde; $a<=$trm->hasta;$a++ ){
                                                if($a<10){
                                                    $num    =   "0".$a; 
                                                }else{
                                                    $num    =   $a; 
                                                }
                                        ?>
                                                  <td class="bordeAll" style="text-align: right;">
                                                    <?php
                                                        $sum_x_modelos += @$tokens[$num]->tokens;
                                                        echo format(@$tokens[$num]->tokens,false);
                                                        $sum_x_modelos_total+=@$tokens[$num]->tokens;
                                                    ?>
                                                  </td>
                                        <?php
                                            }
                                        ?>
                                        <td class="bordeAll" style="text-align: right;">
                                            <?php echo format($sum_x_modelos,false);?>
                                        </td>
                                    </tr>
                                <?php       
                                    }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <?php 
                                        $trm->desde =   (int) $trm->desde;
                                        for($a=$trm->desde; $a<$trm->hasta;$a++){
                                    ?>
                                              <th>
                                                
                                              </th>
                                    <?php
                                        }
                                    ?>
                                    <th class="colorFondo">Total:</th>
                                    <th class="colorFondo" style="text-align: right;">
                                        <?php 
                                            $sum_x_modelos_total2[$v->primer_nombre]    =   $sum_x_modelos_total;
                                            echo format($sum_x_modelos_total,false);
                                        ?>
                                    </th>
                                </tr>
                            </tfoot>
                        </table>                                                        
                    </div>
            
    <?php       }
            }
        }
    ?>
    <div style="height: 20px;"></div>
    <div style="text-align: center;"> Resumen de Facturación por Plataforma</div>
    <div style="height: 20px;"></div>
    <table class="ancho" border="0" cellpadding="0" cellspacing="0" width="100%">
        <thead class="bordeAll">
            <tr class="colorFondo">
                <th colspan="16">Plataforma</th>
                <th width="120"></th>
            </tr>
        </thead>
        <tbody>
            <?php 
                foreach($this->$modulo->result["global"] as $k => $v){
                    if(is_object($v) && isset($sum_x_modelos_total2[$v->primer_nombre])){
            ?>
                    <tr id="resumen<?php print($v->primer_nombre);?>">
                        <td class="bordeAll" colspan="15">
                                <?php print($v->primer_nombre);?>
                        </td>
                        <td class="bordeAll" style="text-align: right;" colspan="2">
                                <?php print(format(@$sum_x_modelos_total2[$v->primer_nombre],false));?>                                                
                        </td>
                    </tr>
            <?php       
                    }
                }
            ?>
        </tbody>
    </table>
    <?php
        if($this->uri->segment($this->uri->total_segments())!=="PDF"){?>
            <table>
                <tr>
                    <td colspan="4"></td>
                    <td colspan="7"></td>
                    <td colspan="6"></td>
                </tr>
                <tr>
                    <td colspan="4"></td>
                    <td colspan="7"></td>
                    <td colspan="6"></td>
                </tr>
                <tr>
                    <td colspan="4" rowspan="4"></td>
                    <td colspan="7"></td>
                    <td colspan="6" rowspan="4">
                        <?php
                            if(!empty($empresa->firma)){
                                    echo '<img src="'. img_firma($empresa->firma).'" style="width:153px;height:55px;" />';
                            }
                        ?>
                    </td> 
                </tr>
                <tr>
                    <td colspan="7"></td>
                </tr>
                <tr>
                    <td colspan="7"></td>
                </tr>
                <tr>
                    <td colspan="7"></td>
                </tr>
                <tr>
                    <td colspan="7"></td>
                </tr>
                <tr>
                    <td colspan="4" class="bordetop" width="200">
                        Aprobado:
                    </td>
                    <td colspan="7" width="100"></td>
                    <td colspan="6" class="bordetop" width="200">
                        <?php
                            if(@$OpcionesFactura->firmaFac==1){
                                echo $empresa->nombre_representante_legal.' C.C. '.$empresa->nro_identificacion_representante_legal;
                            }else{
                                echo 'Firma y sello autorizado';
                            }
                        ?> 
                    </td>    
                </tr>
                <tr></tr>
                <tr></tr>
                <tr>
                    <td colspan="6" class="bordetop">
                        Fecha impresión documento <?php echo date('Y-m-d'); ?>
                    </td>
                    <td colspan="5" class="bordetop">
                        Página <?php echo $numPag.' / '.($Pag+1); ?>
                    </td>
                    <td colspan="6" class="bordetop">
                        Powered by LogicSoft&reg; | www.webcamplus.com.co
                    </td>
                </tr>
                <tr>
                    <td colspan="17">
                        <?php if(!empty($OpcionesFactura->resolucionFac)){echo $OpcionesFactura->resolucionFac;}else{echo 'La presente resolución aplica únicamente a los documentos de venta que se registren después de grabados estos cambios.';} ?>
                    </td>
                </tr>
            </table>
        </div>
<?php 
    }else{
         if($i==$Pag){
             $position=count($items);
                if($position > 4){
                     $x=(30*12)/$position;
                     $m=ceil($x);
                }else{
                     $m=56;
                }
        }
?>
                <div class="firmas" style="position:absolute;bottom:<?php echo $m ?>;width: 100%;">
                    <table class="ancho" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td></td>
                                <td>
                                    <?php
                                        if(!empty($empresa->firma)){
                                                echo '<img src="'. img_firma($empresa->firma).'" style="width:153px;height:55px;" />';
                                        }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="bordetop linea">
                                        Aprobado:
                                    </div>
                                </td>
                                <td> 
                                    <div class="bordetop linea">
                                        <?php
                                            if(@$OpcionesFactura->firmaFac==1){
                                                echo $empresa->nombre_representante_legal.' C.C. '.$empresa->nro_identificacion_representante_legal;
                                            }else{
                                                echo 'Firma y sello autorizado';
                                            }
                                        ?> 
                                    </div>
                                </td>
                            </tr>
                    </table> 
                 </div>
<div class="footer bordetop" style="position: absolute; bottom:5px; width: 100%">
    <table>
        <tr>
            <td style="width:33%; text-align: left;font-size: 9px;color :black;">Fecha impresión documento <?php echo date('Y-m-d'); ?></td>
            <td style="text-align: center;font-size: 9px;">Página <?php echo $numPag.' / '.($Pag+1); ?></td>
            <td style="width:33%; text-align: right;font-size: 9px;">Powered by LogicSoft&reg; | www.webcamplus.com.co</td>
        </tr>
        <tr>
            <td colspan="3" style="text-align: center;font-size: 9px;"><?php if(!empty($OpcionesFactura->resolucionFac)){echo $OpcionesFactura->resolucionFac;}else{echo 'La presente resolución aplica únicamente a los documentos de venta que se registren después de grabados estos cambios.';} ?></td>
        </tr>
    </table>
</div>
</div><?php } } ?>