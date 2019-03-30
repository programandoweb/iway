<?php
/* 
    DESARROLLO Y PROGRAMACIÓN
    PROGRAMANDOWEB.NET
    LCDO. JORGE MENDEZ
    info@programandoweb.net
*/?>
<div style="font-family:font-family: 'Montserrat', sans-serif; line-height:16px; font-size:12px; font-family:font-family: 'Montserrat', sans-serif;margin-bottom: 100px;">
    <table class="ancho" border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td width="30%">
                <img src="<?php echo img_logo($empresa->user_id);?>" style="width:153px;height:55px;" />
            </td>
            <td style="text-align:right; font-size:12px; font-weight:bold;" valign="top" colspan="2">
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

                                        Discriminado de facturación por Plataforma
<?php
    $total_x_modelo     =   array();     
    foreach($this->$modulo->result["global"] as $k => $v){
        
        if(is_object($v) && isset($this->$modulo->result["detallado"][$v->id_plataforma])){
            if(count($this->$modulo->result["detallado"][$v->id_plataforma])>0){
           // pre(@$this->$modulo->result["detallado"][$v->id_plataforma]);
?>
                <div id="<?php echo $v->primer_nombre;?>">
                    <h3><?php print($v->primer_nombre);?></h3>
                    <table class="ancho" border="0" cellpadding="0" cellspacing="0" width="100%" >
                        <thead class="bordeAll">
                            <tr class="colorFondo">
                                <th width="200">Modelo</th>
                                <?php 
                                    $color_gris =   0;
                                    $trm->desde =   (int) $trm->desde;
                                    for($a=$trm->desde; $a<=$trm->hasta;$a++ ){
                                ?>
                                    <th class="dias <?php echo ($color_gris==0)?"gris":""; if($color_gris==0){$color_gris++;}else{$color_gris=0;}?>"><?php echo $a;?></th>
                                <?php   
                                    }
                                ?>
                                <th width="200" class="text-right">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <?php
                                foreach($this->$modulo->result["detallado"][$v->id_plataforma] as $v2){
                                    $tokens=get_reporte_quincenal_x_modelo($v2->id_modelo,$desde=false , $hasta=false);
                            ?>
                                <tr>
                                    <td class="bordeAll">
                                        <?php print($v2->modelo);?>         
                                    </td>
                                    <?php 
                                        $color_gris =   0;
                                        $trm->desde =   (int) $trm->desde;
                                        for($a=$trm->desde; $a<=$trm->hasta;$a++ ){
                                            if($a<10){
                                                $num    =   "0".$a; 
                                            }else{
                                                $num    =   $a; 
                                            }
                                    ?>
                                              <td class="bordeAll">
                                                <?php
                                                    echo format(@$tokens[$num]->tokens,false);
                                                ?>
                                              </td>
                                    <?php
                                        }
                                    ?>
                                    <td>
                                    
                                    </td>
                                </tr>
                            <?php       
                                }
                            ?>
                            
                        </tbody>
                    </table>                                                        
                </div>
        
<?php       }
        }
    }
?>
<div class="footer bordetop" style="position: absolute; bottom:5px; width: 100%">
    <table>
        <tr>
            <td style="width:33%; text-align: left;font-size: 9px;color :black;">Fecha impresión documento <?php //echo date('Y-m-d'); ?></td>
            <td style="text-align: center;font-size: 9px;">Página <?php //echo $numPag.' / '.($Pag+1); ?></td>
            <td style="width:33%; text-align: right;font-size: 9px;">Powered by LogicSoft&reg; | www.webcamplus.com.co</td>
        </tr>
    </table>
</div>