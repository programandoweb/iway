<?php
/* 
    DESARROLLO Y PROGRAMACIÓN
    PROGRAMANDOWEB.NET
    LCDO. JORGE MENDEZ
    info@programandoweb.net
*/?>
<?php
    $modulo = $this->ModuloActivo;
    $trm    = get_cf_ciclos_pagos_new($this->user->id_empresa,0);   
    $centro_de_costos=$this->$modulo->result["centro_de_costos"];
    $periodos=$this->$modulo->result["periodos"];
    $plataformas=$this->$modulo->result["Plataformas"];
    $modelos=$this->$modulo->result["modelos"];
    $modelos_nombres=$this->$modulo->result["modelos_nombres"]; 
    $periodos_de_pago   =   centrodecostos($this->user->id_empresa)->periodo_pagos;
    $cantidad_a_mostrar =   ($periodos_de_pago==2)?6:3;
    $inc_desde          =   (int)calculo_meses(date("Y-m-d"),'-'.$cantidad_a_mostrar,'m');
    $inc_hasta          =   $inc_desde  +   $cantidad_a_mostrar;
?>
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
    <div style="height: 30px;"></div>
    <table  border="0" cellpadding="0" cellspacing="0" width="100%">
        <thead>
            <tr class="colorFondo">
                <th width="200" style="text-align: left;">Sucursal</th>
                <?php 
                    
                    for($a=$inc_desde; $a<=$inc_hasta;$a++ ){
                ?>
                    <th class="dias" colspan="2"><?php echo mes($a);?></th>
                <?php   
                    }
                ?>
                <th width="100" class="text-right"></th>
            </tr>
            <tr class="colorFondo">
                <th width="200"></th>
                <?php 
                    
                    for($a=$inc_desde; $a<=$inc_hasta;$a++ ){
                        if($periodos_de_pago==2){
                ?>
                            <th class="dias">Q1</th>
                            <th class="dias">Q2</th>
                <?php   
                        }else{
                ?>
                            <th class="dias">S1</th>
                            <th class="dias">S2</th>
                            <th class="dias">S3</th>
                            <th class="dias">S4</th>
                <?php           
                        }
                    }
                ?>
                <th width="100" style="text-align: right;">Total</th>
            </tr>
        </thead>
        <tbody>
        <?php   $total=array();
            $total_x_modelo     =   array();     
            foreach($centro_de_costos as $k => $v){
        ?>                                                    
            <tr>
                <td class="bordeAll"><?php print($v->sucursal);?></td>
                <?php 
                    $fila   =   array();
                    for($a=$inc_desde; $a<=$inc_hasta;$a++ ){
                        /*
                            AQUI HACE ESTE INCREMENTO
                            PORQUE SI LLEGA A Q1 POR LÓGICA SE DETIENE
                            Y QUEDARÍA UN TD SIN LLENEAR
                        */
                        $incremento_x_vueltas=0;
                        if(isset($periodos[$k][$a])){
                            foreach($periodos[$k][$a] as $key =>$value){
                                @$fila[$a]      +=      $value->monto;  
                    ?>
                                    <td class="bordeAll" style="text-align: center;">
                                        <?php 
                                            if(isset($periodos[$k][$a])){
                                                print(format($value->monto,FALSE));
                                                @$total[$a][$incremento_x_vueltas]  +=  $value->monto;
                                                
                                            }else{
                                                echo '-';
                                            }
                                        ?>
                                    </td>
                <?php       
                                $incremento_x_vueltas++;
                            }
                            if($incremento_x_vueltas<$periodos_de_pago){
                ?>
                                <td class="bordeAll" style="text-align: center;">
                                    -
                                </td>
                <?php               
                            }
                        }else{
                ?>
                            <td class="bordeAll" style="text-align: center;">
                                -
                            </td>
                            <td class="bordeAll" style="text-align: center;">
                                -
                            </td>
                <?php
                            @$total[$a] +=  0;  
                        }
                    }
                ?>
                <td class="bordeAll" style="text-align: right;">
                    <?php 
                        $suma_totales   =0;
                        foreach($fila as $key =>$value){
                            $suma_totales+=$value;
                            print(format($value,false));
                        }
                    ?>
                </td>
            </tr>                
        <?php 
            }
        ?>
        </tbody>
        <tfoot>
            <tr>
                <th class="bordeAll" style="text-align: center;">Total</th>
                <?php 
                    $suma_horizontal    =   0;
                    for($a=$inc_desde; $a<=$inc_hasta;$a++ ){
                ?>
                        <th class="bordeAll" style="text-align: center;">
                            <?php $print    =   (isset($total[$a][0]))?$total[$a][0]:0; echo format($print,false); $suma_horizontal +=  $print;?>
                        </th>
                        <th class="bordeAll" style="text-align: center;">
                            <?php $print    =   (isset($total[$a][1]))?$total[$a][1]:0; echo format($print,false); $suma_horizontal +=  $print;?>
                        </th>
                <?php 
                        
                    }
                ?>
                <th class="bordeAll" style="text-align: right;">
                    <?php echo format($suma_horizontal,false);?>
                </th>
            </tr>
        </tfoot>
    </table> 
    <div style="height: 20px;"></div>   
    <table  border="0" cellpadding="0" cellspacing="0" width="100%">
        <thead>
            <tr class="colorFondo">
                <th width="200" style="text-align: left">Plataforma</th>
                <?php 
                    $total=array();
                    for($a=$inc_desde; $a<=$inc_hasta;$a++ ){
                ?>
                    <th class="dias" colspan="2"><?php echo mes($a);?></th>
                <?php   
                    }
                ?>
                <th width="100" class="text-right"></th>
            </tr>
            <tr class="colorFondo">
                <th width="200"></th>
                <?php 
                    
                    for($a=$inc_desde; $a<=$inc_hasta;$a++ ){
                        if($periodos_de_pago==2){
                ?>
                            <th class="dias">Q1</th>
                            <th class="dias">Q2</th>
                <?php   
                        }else{
                ?>
                            <th class="dias">S1</th>
                            <th class="dias">S2</th>
                            <th class="dias">S3</th>
                            <th class="dias">S4</th>
                <?php           
                        }
                    }
                ?>
                <th width="100" style="text-align: right;">Total</th>
            </tr>
        </thead>
        <tbody>
            <?php  
                foreach($plataformas as $k => $v){?>
                    <tr>
                        <td class="bordeAll">
                            <?php 
                                print($k);
                            ?>
                        </td>
                        <?php 
                            $fila   =   array();
                            for($a=$inc_desde; $a<=$inc_hasta;$a++ ){
                                /*
                                    AQUI HACE ESTE INCREMENTO
                                    PORQUE SI LLEGA A Q1 POR LÓGICA SE DETIENE
                                    Y QUEDARÍA UN TD SIN LLENEAR
                                */
                                $incremento_x_vueltas=0;
                                if(isset($v[$a])){
                                    foreach($v[$a] as $key =>$value){
                                        @$fila[$a]      +=      $value->tokens; 
                            ?>
                                            <td class="bordeAll" style="text-align: center;">
                                                <?php 
                                                    if(isset($v[$a])){
                                                        print(format($value->tokens,FALSE));
                                                        @$total[$a][$incremento_x_vueltas]  +=  $value->tokens;
                                                        
                                                    }else{
                                                        echo '-';
                                                    }
                                                ?>
                                            </td>
                        <?php       
                                        $incremento_x_vueltas++;
                                    }
                                    if($incremento_x_vueltas<$periodos_de_pago){
                        ?>
                                        <td class="bordeAll" style="text-align: center;">
                                            -
                                        </td>
                        <?php               
                                    }
                                }else{
                        ?>
                                    <td class="bordeAll" style="text-align: center;">
                                        -
                                    </td>
                                    <td class="bordeAll" style="text-align: center;">
                                        -
                                    </td>
                        <?php
                                    @$total[$a] +=  0;  
                                }
                            }
                        ?>
                        <td class="bordeAll" style="text-align: right;">
                            <?php 
                                $suma_totales   =0;
                                foreach($fila as $key =>$value){
                                    $suma_totales+=$value;
                                    print(format($value,false));
                                }
                            ?>
                        </td>
                    </tr>
            <?php 
                }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <th class="bordeAll">Total</th>
                <?php 
                    $suma_horizontal    =   0;
                    for($a=$inc_desde; $a<=$inc_hasta;$a++ ){
                ?>
                        <th class="bordeAll" style="text-align: center;">
                            <?php $print    =   (isset($total[$a][0]))?$total[$a][0]:0; echo format($print,false); $suma_horizontal +=  $print;?>
                        </th>
                        <th class="bordeAll" style="text-align: center;">
                            <?php $print    =   (isset($total[$a][1]))?$total[$a][1]:0; echo format($print,false); $suma_horizontal +=  $print;?>
                        </th>
                <?php 
                        
                    }
                ?>
                <th class="bordeAll" style="text-align: right;">
                    <?php echo format($suma_horizontal,false);?>
                </th>
            </tr>
        </tfoot>
    </table>
    <div style="height: 20px;"></div>  
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <thead>
            <tr class="colorFondo">
                <th width="200" style="text-align: left;">Plataforma</th>
                <?php 
                    $total=array();
                    for($a=$inc_desde; $a<=$inc_hasta;$a++ ){
                ?>
                    <th class="dias" colspan="2"><?php echo mes($a);?></th>
                <?php   
                    }
                ?>
                <th width="100" class="text-right"></th>
            </tr>
            <tr class="colorFondo">
                <th width="200"></th>
                <?php 
                    
                    for($a=$inc_desde; $a<=$inc_hasta;$a++ ){
                        if($periodos_de_pago==2){
                ?>
                            <th class="dias">Q1</th>
                            <th class="dias">Q2</th>
                <?php   
                        }else{
                ?>
                            <th class="dias">S1</th>
                            <th class="dias">S2</th>
                            <th class="dias">S3</th>
                            <th class="dias">S4</th>
                <?php           
                        }
                    }
                ?>
                <th width="100" style="text-align: right;">Total</th>
            </tr>
        </thead>
        <tbody>
            <?php  
                foreach($plataformas as $k => $v){?>
                    <tr>
                        <td class="bordeAll">
                            <?php 
                                print($k);
                            ?>
                        </td>
                        
                        <?php 
                            $fila   =   array();
                            for($a=$inc_desde; $a<=$inc_hasta;$a++ ){
                                /*
                                    AQUI HACE ESTE INCREMENTO
                                    PORQUE SI LLEGA A Q1 POR LÓGICA SE DETIENE
                                    Y QUEDARÍA UN TD SIN LLENEAR
                                */
                                $incremento_x_vueltas=0;
                                if(isset($v[$a])){
                                    foreach($v[$a] as $key =>$value){
                                        @$fila[$a]      +=      $value->usd;    
                            ?>
                                            <td class="bordeAll" style="text-align: center;">
                                                <?php 
                                                    if(isset($v[$a])){
                                                        print(format($value->usd,FALSE));
                                                        @$total[$a][$incremento_x_vueltas]  +=  $value->usd;
                                                        
                                                    }else{
                                                        echo '-';
                                                    }
                                                ?>
                                            </td>
                        <?php       
                                        $incremento_x_vueltas++;
                                    }
                                    if($incremento_x_vueltas<$periodos_de_pago){
                        ?>
                                        <td class="bordeAll" style="text-align: center;">
                                            -
                                        </td>
                        <?php               
                                    }
                                }else{
                        ?>
                                    <td class="bordeAll" style="text-align: center;">
                                        -
                                    </td>
                                    <td class="bordeAll" style="text-align: center;">
                                        -
                                    </td>
                        <?php
                                    @$total[$a] +=  0;  
                                }
                            }
                        ?>
                        <td class="bordeAll" style="text-align: right;">
                            <?php 
                                $suma_totales   =   0;
                                foreach($fila as $key =>$value){
                                    $suma_totales+=$value;
                                    print(format($value,false));
                                }
                            ?>
                        </td>
                    </tr>
            <?php 
                }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <th class="bordeAll" style="text-align: center;">Total</th>
                <?php 
                    $suma_horizontal    =   0;
                    for($a=$inc_desde; $a<=$inc_hasta;$a++ ){
                ?>
                        <th class="bordeAll" style="text-align: center;">
                            <?php $print    =   (isset($total[$a][0]))?$total[$a][0]:0; echo format($print,false); $suma_horizontal +=  $print;?>
                        </th>
                        <th class="bordeAll" style="text-align: center;">
                            <?php $print    =   (isset($total[$a][1]))?$total[$a][1]:0; echo format($print,false); $suma_horizontal +=  $print;?>
                        </th>
                <?php 
                        
                    }
                ?>
                <th class="bordeAll" style="text-align: right;">
                    <?php echo format($suma_horizontal,false);?>
                </th>
            </tr>
        </tfoot>
    </table>
    <div style="height: 20px;"></div>   
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <thead>
            <tr class="colorFondo">
                    <th width="200" style="text-align: left;">Plataforma</th>
                    <?php 
                        
                        for($a=$inc_desde; $a<=$inc_hasta;$a++ ){
                    ?>
                        <th class="dias" colspan="2"><?php echo mes($a);?></th>
                    <?php   
                        }
                    ?>
                    <th width="100" class="text-right"></th>
                </tr>
                <tr class="colorFondo">
                    <th width="200"></th>
                    <?php 
                        
                        for($a=$inc_desde; $a<=$inc_hasta;$a++ ){
                            if($periodos_de_pago==2){
                    ?>
                                <th class="dias">Q1</th>
                                <th class="dias">Q2</th>
                    <?php   
                            }else{
                    ?>
                                <th class="dias">S1</th>
                                <th class="dias">S2</th>
                                <th class="dias">S3</th>
                                <th class="dias">S4</th>
                    <?php           
                            }
                        }
                    ?>
                    <th width="100" style="text-align: right">Total</th>
                </tr>
        </thead>
        <tbody>
            <?php 
                 $total=array();
                $suma_totales   =   0;
                foreach($plataformas as $k => $v){?>
                    <tr>
                        <td class="bordeAll">
                            <?php 
                                print($k);
                            ?>
                        </td>
                        
                        <?php 
                            $fila   =   array();
                            for($a=$inc_desde; $a<=$inc_hasta;$a++ ){
                                /*
                                    AQUI HACE ESTE INCREMENTO
                                    PORQUE SI LLEGA A Q1 POR LÓGICA SE DETIENE
                                    Y QUEDARÍA UN TD SIN LLENEAR
                                */
                                $incremento_x_vueltas=0;
                                if(isset($v[$a])){
                                    foreach($v[$a] as $key =>$value){
                                        @$fila[$a]      +=      $value->monto;  
                            ?>
                                            <td class="bordeAll" style="text-align: center;">
                                                <?php 
                                                    if(isset($v[$a])){
                                                        print(format($value->monto,FALSE));
                                                        @$total[$a][$incremento_x_vueltas]  +=  $value->monto;
                                                        
                                                    }else{
                                                        echo '-';
                                                    }
                                                ?>
                                            </td>
                        <?php       
                                        $incremento_x_vueltas++;
                                    }
                                    if($incremento_x_vueltas<$periodos_de_pago){
                        ?>
                                        <td class="bordeAll" style="text-align: center;">
                                            -
                                        </td>
                        <?php               
                                    }
                                }else{
                        ?>
                                    <td class="bordeAll" style="text-align: center;">
                                        -
                                    </td>
                                    <td class="bordeAll" style="text-align: center;">
                                        -
                                    </td>
                        <?php
                                    @$total[$a] +=  0;  
                                }
                            }
                        ?>
                        <td class="bordeAll" style="text-align: right;">
                            <?php 
                               
                                foreach($fila as $key =>$value){
                                    $suma_totales+=$value;
                                    print(format($value,false));    
                                }
                            ?>
                        </td>
                    </tr>
            <?php 
                }
            ?>
        </tbody>
       <tfoot>
            <tr>
                <th class="bordeAll">Total</th>
                <?php 
                    $suma_horizontal    =   0;
                    for($a=$inc_desde; $a<=$inc_hasta;$a++ ){
                ?>
                        <th class="bordeAll" style="text-align: center;">
                            <?php $print    =   (isset($total[$a][0]))?$total[$a][0]:0; echo format($print,false); $suma_horizontal +=  $print;?>
                        </th>
                        <th class="bordeAll" style="text-align: center;">
                            <?php $print    =   (isset($total[$a][1]))?$total[$a][1]:0; echo format($print,false); $suma_horizontal +=  $print;?>
                        </th>
                <?php 
                        
                    }
                ?>
                <th class="bordeAll" style="text-align: right;">
                    <?php echo format($suma_horizontal,false);?>
                </th>
            </tr>
        </tfoot>
    </table>
    <div style="height: 20px;"></div>   
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <thead>
            <tr class="colorFondo">
                <th width="200" style="text-align: left">Modelo</th>
                <?php 
                    $fila   =   array(); 
                    for($a=$inc_desde; $a<=$inc_hasta;$a++ ){
                ?>
                    <th class="dias" colspan="2"><?php echo mes($a);?></th>
                <?php   
                    }
                ?>
                <th width="100" class="text-right"></th>
            </tr>
            <tr class="colorFondo">
                <th width="200"></th>
                <?php 
                    
                    for($a=$inc_desde; $a<=$inc_hasta;$a++ ){
                        if($periodos_de_pago==2){
                ?>
                            <th class="dias">Q1</th>
                            <th class="dias">Q2</th>
                <?php   
                        }else{
                ?>
                            <th class="dias">S1</th>
                            <th class="dias">S2</th>
                            <th class="dias">S3</th>
                            <th class="dias">S4</th>
                <?php           
                        }
                    }
                ?>
                <th width="100" style="text-align: right;">Total</th>
            </tr>
        </thead>
        <tbody>
            <?php  
                $total=array();
                foreach($modelos as $k => $v){?>
                    <tr>
                        <td class="bordeAll">
                            <?php 
                                print($modelos_nombres[$k]);
                            ?>
                        </td>
                        <?php 
                            $fila   =   array();
                            for($a=$inc_desde; $a<=$inc_hasta;$a++ ){
                                /*
                                    AQUI HACE ESTE INCREMENTO
                                    PORQUE SI LLEGA A Q1 POR LÓGICA SE DETIENE
                                    Y QUEDARÍA UN TD SIN LLENEAR
                                */
                                $incremento_x_vueltas=0;
                                if(isset($v[$a])){
                                    foreach($v[$a] as $key =>$value){
                                        @$fila[$a]      +=      $value->monto;  
                            ?>
                                            <td class="bordeAll">
                                                <?php 
                                                    if(isset($v[$a])){
                                                        print(format($value->monto,FALSE));
                                                        @$total[$a][$incremento_x_vueltas]  +=  $value->monto;
                                                        
                                                    }else{
                                                        echo '-';
                                                    }
                                                ?>
                                            </td>
                        <?php       
                                        $incremento_x_vueltas++;
                                    }
                                    if($incremento_x_vueltas<$periodos_de_pago){
                        ?>
                                        <td class="bordeAll" style="text-align: center;">
                                            -
                                        </td>
                        <?php               
                                    }
                                }else{
                        ?>
                                    <td class="bordeAll" style="text-align: center;">
                                        -
                                    </td>
                                    <td class="bordeAll" style="text-align: center;">
                                        -
                                    </td>
                        <?php
                                    @$total[$a] +=  0;  
                                }
                            }
                        ?>
                        
                        <td class="bordeAll" style="text-align: right;">
                            <?php 
                                $suma_totales   =0;
                                foreach($fila as $key =>$value){
                                    $suma_totales+=$value;
                                    print(format($value,false));
                                }
                            ?>
                        </td>
                    </tr>
            <?php 
                }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <th class="bordeAll" style="text-align: center;">Total</th>
                <?php 
                    $suma_horizontal    =   0;
                    for($a=$inc_desde; $a<=$inc_hasta;$a++ ){
                ?>
                        <th class="bordeAll" style="text-align: center;">
                            <?php $print    =   (isset($total[$a][0]))?$total[$a][0]:0; echo format($print,false); $suma_horizontal +=  $print;?>
                        </th>
                        <th class="bordeAll" style="text-align: center;">
                            <?php $print    =   (isset($total[$a][1]))?$total[$a][1]:0; echo format($print,false); $suma_horizontal +=  $print;?>
                        </th>
                <?php 
                        
                    }
                ?>
                <th class="bordeAll" style="text-align: right;">
                    <?php echo format($suma_horizontal,false);?>
                </th>
            </tr>
        </tfoot>
    </table>
<div class="footer bordetop" style="position: absolute; bottom:5px; width: 100%">
    <table>
        <tr>
            <td style="width:33%; text-align: left;font-size: 9px;color :black;">Fecha impresión documento <?php echo date('Y-m-d'); ?></td>
            <td style="text-align: center;font-size: 9px;">Página 1 / 1</td>
            <td style="width:33%; text-align: right;font-size: 9px;">Powered by LogicSoft&reg; | www.webcamplus.com.co</td>
        </tr>
    </table>
</div>  