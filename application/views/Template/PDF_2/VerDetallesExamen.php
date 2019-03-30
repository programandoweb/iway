<?php
/* 
    DESARROLLO Y PROGRAMACIÓN
    PROGRAMANDOWEB.NET
    LCDO. JORGE MENDEZ
    info@programandoweb.nethygvjky
*/?>
<?php 
$OpcionesFactura    =   getOpcionesFactura($empresa->user_id);
$modulo     =   $this->ModuloActivo;
$pag = 0;
?>
<div style="font-family:font-family: 'Montserrat', sans-serif; line-height:16px; font-size:12px; font-family:font-family: 'Montserrat', sans-serif;">
    <table class="ancho" border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td width="30%">
                <img src="<?php echo img_logo($empresa->user_id);?>" style="width:153px;height:55px;" />
            </td>
            <td style="text-align:right; font-size:12px; font-weight:bold;" valign="top">
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
        foreach($this->$modulo->result as  $key => $v){
            $datos_entrevistado = json_decode($v->json_entrevista);
            $datos_examen =    json_decode($v->json_respuestas);
            //pre($datos_entrevistado);                                  
                                    
                    foreach ($datos_examen->pregunta as $indice => $valor) {
                       if(!empty($datos_examen->respuesta->$indice)){ 
                       $la_que_respondio   =   $datos_examen->respuesta->$indice;
                       if($indice==1){
    ?>
                                    <table width="540" style="margin-top: 30px;margin-bottom: 10px;">
                                        <tr>
                                            <td><b>Nombre Entrevistado:</b></td>
                                            <td colspan="4" class="bordeBottom">
                                                <?php 
                                                    if(!empty(@$datos_entrevistado->PrimerNombre)){
                                                        echo @$datos_entrevistado->PrimerNombre." ";
                                                    } 
                                                    if(!empty(@$datos_entrevistado->SegundoNombre)){
                                                        echo @$datos_entrevistado->SegundoNombre." ";
                                                    }
                                                    if(!empty(@$datos_entrevistado->PrimerApellido)){
                                                        echo @$datos_entrevistado->PrimerApellido." ";
                                                    } 
                                                    if(!empty(@$datos_entrevistado->SegundoApellido)){
                                                        echo @$datos_entrevistado->SegundoApellido." ";
                                                    }
                                                ?>
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td><b>Número de cédula:</b></td>
                                            <td colspan="4" class="bordeBottom">
                                             <?php 
                                                   echo $v->nro_piso_cedula;
                                             ?>
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td><b>Ciudad de Expedicion</b></td>
                                            <td colspan="4" class="bordeBottom">
                                                <?php 
                                                    if(!empty(@$datos_entrevistado->cedula_ciudad_expedicion)){
                                                        echo @$datos_entrevistado->cedula_ciudad_expedicion;
                                                    } 
                                                ?>
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td><b>Fecha presentación test:</b></td>
                                            <td colspan="4" class="bordeBottom">
                                                <?php 
                                                    if(!empty(@$datos_entrevistado->fecha_inicio_prueba)){
                                                        echo @$datos_entrevistado->fecha_inicio_prueba;
                                                    }
                                                 ?>
                                            </td>
                                            <td></td>
                                        </tr>
                                    </table>
                                    <table border="0" cellpadding="0" cellspacing="0" width="540" style="margin-top:30px;">
                       <?php } ?>
                       <?php
                            if($indice == 11 || $indice == 23 || $indice == 35 || $indice == 47 || $indice == 59 || $indice == 70 || $indice == 81){
                       ?>
                            <div style="page-break-after:always;"></div>
                            <table class="ancho" border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td width="30%">
                                        <img src="<?php echo img_logo($empresa->user_id);?>" style="width:153px;height:55px;" />
                                    </td>
                                    <td style="text-align:right; font-size:12px; font-weight:bold;" valign="top">
                                        <?php echo $empresa->nombre_legal?><br/>
                                        Nit: <?php echo $empresa->identificacion;?> | <?php echo $empresa->tipo_empresa;?><br />
                                        <?php echo $empresa->direccion;?><br />               
                                        PBX: <?php echo $empresa->cod_telefono;?>-<?php echo $empresa->telefono?><br/>
                                        <?php echo $empresa->website;?><br/>
                                        <?php #pre($empresa); ?>
                                    </td>
                                </tr>
                            </table>
                            <table border="0" cellpadding="0" cellspacing="0" width="540" style="margin-top:30px;"> 
                       <?php } ?>
                <?php
                       if ($indice%2==0){
                            echo '<tr class="claro">';
                       }else{
                            echo '<tr class="oscuro">';
                       }
                                                    
                ?>
                        <?php
                            foreach($valor as $key => $value){
                                if($key==0){
                                    echo '<td style="vertical-align: top;" width="240">'.$value.'</td>';
                                }else{
                                    if($key == 1){
                                        echo '<td width="240"><div class="col-md-12"><table>';
                                    }
                                    if($value==$la_que_respondio){
                                        echo '<tr><td><div style="color:green; width:13px; height:13px; text-align:center;vertical-align: middle;" class="bordeAll">X</div></td><td> '.$value.'</td></tr>';
                                    }else{
                                        echo '<tr><td><div style="color:green; width:13px; height:13px;" class="bordeAll"></div></td><td> '.$value.'</td></tr>';
                                    }
                                    if($key == 3){
                                        echo '</table></div></td>';
                                    }
                                }
                            }
                            if( $datos_examen->$indice == 0){
                                    echo '<td style="vertical-align: top; color:red;">Incorrecto</td>';
                                }else{
                                    echo '<td style="vertical-align: top;color: green;">Correcto</td>';
                                }
                            echo '</tr>';
                        if($indice == 10 || $indice == 22 || $indice == 34 || $indice == 46 || $indice == 58 || $indice == 69 || $indice == 80){
                            $pag++;
                    ?>
                        <div class="footer bordetop" style="position: absolute; bottom:5px; width: 100%">
                            <table>
                                <tr>
                                    <td style="width:33%; text-align: left;font-size: 9px;color :black;">Fecha impresión documento <?php echo date('Y-m-d'); ?></td>
                                    <td style="text-align: center;font-size: 9px;">Página <?php echo $pag.' / 8' ?></td>
                                    <td style="width:33%; text-align: right;font-size: 9px;">Powered by LogicSoft&reg; | www.webcamplus.com.co</td>
                                </tr>
                                <tr>
                                    <td colspan="3" style="text-align: center;font-size: 9px;"><?php if(!empty($OpcionesFactura->resolucionFac)){echo $OpcionesFactura->resolucionFac;}else{echo 'La presente resolución aplica únicamente a los documentos de venta que se registren después de grabados estos cambios.';} ?></td>
                                </tr>
                            </table>
                        </div>
                        </table>
                    <?php         
                        }
                        if($indice == 88){
                    ?>
                    <div class="firmas" style="position:absolute;bottom:100px;width: 100%;">
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
                                <tr>
                                    <td colspan="2" style="padding-top:15px;">
                                        <?php 
                                            if(!empty($OpcionesFactura->piePaginaFac)){
                                                echo $OpcionesFactura->piePaginaFac;
                                            }else{
                                                echo 'Esta factura se asimila en todos sus efectos a una letra de cambio, de conformidad con el articulo 774 del código de comercio. Autorizo que en caso de incumplimiento de esta obligación sea reportado a las centrales de riesgo, se cobraran intereses por concepto de mora.';
                                            }
                                        ?>
                                    </td>
                                </tr>
                        </table> 
                     </div>
                    <div class="footer bordetop" style="position: absolute; bottom:5px; width: 100%">
                        <table>
                            <tr>
                                <td style="width:33%; text-align: left;font-size: 9px;color :black;">Fecha impresión documento <?php echo date('Y-m-d'); ?></td>
                                <td style="text-align: center;font-size: 9px;">Página 8 / 8 </td>
                                <td style="width:33%; text-align: right;font-size: 9px;">Powered by LogicSoft&reg; | www.webcamplus.com.co</td>
                            </tr>
                            <tr>
                                <td colspan="3" style="text-align: center;font-size: 9px;"><?php if(!empty($OpcionesFactura->resolucionFac)){echo $OpcionesFactura->resolucionFac;}else{echo 'La presente resolución aplica únicamente a los documentos de venta que se registren después de grabados estos cambios.';} ?></td>
                            </tr>
                        </table>
                    </div>
                </table>
                    <?php
                        }
                    }    
                }
        } 
    ?>
</div>

